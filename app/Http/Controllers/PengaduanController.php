<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RequestStoreOrUpdatePengaduan;
use App\Http\Requests\RequestStoreTanggapan;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengaduans = Pengaduan::orderByDesc('id');

        if(Auth::user()->role == 'masyarakat'){
            $pengaduans = $pengaduans->where("masyarakat_id", Auth::id());
        }else{
            $pengaduans = $pengaduans->where('status', '!=', 'belum diverifikasi');
        }

        $pengaduans = $pengaduans->paginate(50);


        return view('dashboard.pengaduans.index', compact('pengaduans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pengaduans.create');
    }

    /**
     * Store a newly created resource in storage.RequestStoreOrUpdatePengaduan
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStoreOrUpdatePengaduan $request)
    {
        $validated = $request->validated() + [
            'masyarakat_id' => Auth::id(),
            'created_at' => now(),
        ];

        if($request->hasFile('foto_bukti')){
            $fileName = time() . '.' . $request->foto_bukti->extension();
            $validated['foto_bukti'] = $fileName;

            // move file
            $request->foto_bukti->move(public_path('uploads/images'), $fileName);
        }
        $user = Pengaduan::create($validated);

        return redirect(route('pengaduan.index'))->with('success', 'Pengaduan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        return view('dashboard.pengaduans.detail', compact('pengaduan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Pengaduan::findOrFail($id);

        return view('dashboard.pengaduans.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestStoreOrUpdatePengaduan $request, $id)
    {
        $validated = $request->validated() + [
            'updated_at' => now(),
        ];

        $user = Pengaduan::findOrFail($id);

        $validated['avatar'] = $user->avatar;

        if($request->hasFile('avatar')){
            $fileName = time() . '.' . $request->avatar->extension();
            $validated['avatar'] = $fileName;

            // move file
            $request->avatar->move(public_path('uploads/images'), $fileName);

            // delete old file
            $oldPath = public_path('/uploads/images/'.$user->avatar);
            if(file_exists($oldPath) && $user->avatar != 'avatar.png'){
                unlink($oldPath);
            }
        }

        $user->update($validated);

        return redirect(route('pengaduans.index'))->with('success', 'Pengaduan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Pengaduan::findOrFail($id);
        // delete old file
        $oldPath = public_path('/uploads/images/'.$user->foto_bukti);
        if($user->foto_bukti && file_exists($oldPath) && $user->foto_bukti != 'avatar.png'){
            unlink($oldPath);
        }
        $user->delete();

        return redirect(route('pengaduan.index'))->with('success', 'Pengaduan berhasil dihapus.');
    }

    public function storeTanggapan(RequestStoreTanggapan $request, $pengaduanId)
    {
        $validatedPayload = $request->validated();

        $pengaduan = Pengaduan::findOrFail($pengaduanId);
        $pengaduan->update($validatedPayload);

        $payloadTanggapan = [
            'petugas_id' => Auth::id(),
            'pengaduan_id' => $pengaduanId,
            'tanggapan' => $validatedPayload['tanggapan'],
            'updated_at' => now()
        ];

        Tanggapan::updateOrCreate([
            'pengaduan_id' => $pengaduanId,
        ], $payloadTanggapan);

        return redirect()->route('pengaduan.show', $pengaduanId)->with('success', 'Tanggapan berhasil dikirim ke pengadu.');
    }
}
