<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{
    public function dashboard()
    {
        $data = [];

        $data['total_pengaduan'] = Pengaduan::count();
        $data['total_pengaduan_diproses'] = Pengaduan::whereStatus('pending');
        $data['total_pengaduan_selesai'] = Pengaduan::whereStatus('diterima');
        $data['total_pengaduan_ditolak'] = Pengaduan::whereStatus('ditolak');
        $data['total_pengaduan_belum_verif'] = Pengaduan::whereStatus('belum diverifikasi');

        if(Auth::user()->role == 'masyarakat'){
            $data['total_pengaduan'] = Pengaduan::whereMasyarakatId(Auth::user()->id)->count();
            $data['total_pengaduan_diproses'] = Pengaduan::whereStatus('pending')->whereMasyarakatId(Auth::user()->id);
            $data['total_pengaduan_selesai'] = Pengaduan::whereStatus('diterima')->whereMasyarakatId(Auth::user()->id);
            $data['total_pengaduan_ditolak'] = Pengaduan::whereStatus('ditolak')->whereMasyarakatId(Auth::user()->id);
            $data['total_pengaduan_belum_verif'] = Pengaduan::whereStatus('belum diverifikasi')->whereMasyarakatId(Auth::user()->id);
        }

        $data['total_pengaduan_diproses'] = $data['total_pengaduan_diproses']->count();
        $data['total_pengaduan_selesai'] = $data['total_pengaduan_selesai']->count();
        $data['total_pengaduan_ditolak'] = $data['total_pengaduan_ditolak']->count();
        $data['total_pengaduan_belum_verif'] = $data['total_pengaduan_belum_verif']->count();

        return view('dashboard.index', compact('data'));
    }

    public function landing()
    {
        return view('landing.index');
    }
}
