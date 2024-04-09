<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanPengaduanController extends Controller
{
    public function index(Request $request)
    {
        $pengaduans = Pengaduan::orderByDesc('id');

        if($request->has('validate') || !is_null($request->from) || !is_null($request->to) || !is_null($request->status)) {
            $from = $request->from . ' 00:00:00';
            $to = $request->to . ' 23:59:59';
            $status = $request->status;

            if($from != ' 00:00:00' && $to != ' 23:59:59' && $status == '') { // cari berdasarkan tanggal
                $pengaduans->whereBetween('created_at', [$from, $to]);
            }

            if($from != ' 00:00:00' && $to != ' 23:59:59' && $status != '') { // cari berdasarkan tanggal dan status
                $pengaduans->whereBetween('created_at', [$from, $to])->whereStatus($status);
            }

            if($from == ' 00:00:00' && $to == ' 23:59:59' && $status != '') { // cari berdasarkan status
                $pengaduans->whereStatus($status);
            }
        }

        $pengaduans = $pengaduans->get();

        if($request->has('export')) {
            return Pdf::loadView('dashboard.laporan-pengaduan.cetak_pdf', compact('pengaduans'))->stream('laporan-pengaduan.pdf');
        }



        return view('dashboard.laporan-pengaduan.index', compact('pengaduans'));
    }

    public function exportPdf(Request $request)
    {
        dd($request->all());
    }
}
