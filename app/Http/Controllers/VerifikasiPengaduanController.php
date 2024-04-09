<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifikasiPengaduanController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::orderByDesc('id');
        if(Auth::user()->role == 'masyarakat'){
            $pengaduans = $pengaduans->where("masyarakat_id", Auth::id());
        }

        $pengaduans = $pengaduans->whereStatus('belum diverifikasi')->paginate(50);

        return view('dashboard.verifikasi-pengaduan.index', compact('pengaduans'));
    }

    public function update($pengaduanId)
    {
        $pengaduan = Pengaduan::findOrFail($pengaduanId);

        $pengaduan->update([
            'status' => 'pending',
            'updated_at' => now()
        ]);

        return redirect(route('verifikasi-pengaduan.index'))->with('success', 'Pengaduan berhasil diverifikasi');
    }
}
