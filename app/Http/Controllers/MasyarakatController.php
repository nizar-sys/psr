<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RequestStoreOrUpdateMasyarakat;
use Illuminate\Support\Facades\Hash;

class MasyarakatController extends Controller
{

    public function __construct()
    {
        $this->middleware(['roles:admin'])->except(['index', 'show', 'userDataTable']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $masyarakats = User::where('role', 'masyarakat')->orderByDesc('id');
        $masyarakats = $masyarakats->paginate(50);

        return view('dashboard.masyarakats.index', compact('masyarakats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.masyarakats.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStoreOrUpdateMasyarakat $request)
    {
        $validated = $request->validated() + [
            'created_at' => now(),
        ];

        $masyarakat = User::create($validated);

        return redirect(route('masyarakat.index'))->with('success', 'Data masyarakat berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $masyarakat = User::findOrFail($id);

        return view('dashboard.masyarakats.edit', compact('masyarakat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestStoreOrUpdateMasyarakat $request, $id)
    {
        $validated = $request->validated() + [
            'updated_at' => now(),
        ];

        $masyarakat = User::findOrFail($id);

        $masyarakat->update($validated);

        return redirect(route('masyarakat.index'))->with('success', 'Data masyarakat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $masyarakat = User::findOrFail($id);
        $masyarakat->delete();

        return redirect(route('masyarakat.index'))->with('success', 'Data masyarakat berhasil dihapus.');
    }

    public function userDataTable()
    {
        return view('dashboard.masyarakats.index-data');
    }
}
