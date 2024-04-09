@extends('layouts.app')
@section('title', 'Laporan Data Pengaduan')

@section('title-header', 'Laporan Data Pengaduan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Laporan Data Pengaduan</li>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <div class="table-responsive">
                        <table class="table table-flush table-hover" id="laporan-pengaduan">
                            <thead>
                                <tr>
                                    <th colspan="9" class="text-center">Laporan Data Pengaduan</th>
                                </tr>
                                {{-- buat filter range date --}}
                                <form action="" method="get">
                                    @csrf
                                    <tr>
                                        <td><input type="date" name="from" class="form-control"></td>
                                        <td><input type="date" name="to" class="form-control"></td>
                                        <td>
                                            <select name="status" class="form-control">
                                                <option value="">Semua Status</option>
                                                <option value="belum diverifikasi">Belum Diverifikasi</option>
                                                <option value="pending">Pending</option>
                                                <option value="proses">Proses</option>
                                                <option value="selesai">Selesai</option>
                                            </select>
                                        </td>
                                        <td class="d-flex justify-content-center">
                                            <button name="validate" type="submit" class="btn-sm btn-primary mr-3">Cari</button>
                                            <a href="{{ route('laporan-pengaduan.index', []) }}" class="btn-sm btn-secondary">Reset</a>

                                            @if (!is_null($pengaduans))
                                                <a target="_blank" href="?export=true&from={{ request()->from }}&to={{ request()->to }}&status={{ request()->status }}"
                                                    class="btn-sm btn-danger ml-3">Export</a>
                                            @endif
                                        </td>
                                    </tr>
                                </form>
                            </thead>
                            <div class="divider"></div>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama Pelapor</th>
                                    <th>Isi Laporan</th>
                                    <th>Status</th>
                                    <th>Foto Bukti</th>
                                    <th>Tanggapan</th>
                                    <th>Tanggal Ditanggapi</th>
                                    <th>Tanggal Pengaduan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pengaduans as $pengaduan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pengaduan->masyarakat->nik ?? 'Tidak ada data.' }}</td>
                                        <td>{{ $pengaduan->masyarakat->name }}</td>
                                        <td>{{ str()->words($pengaduan->isi_laporan, 5) }}</td>
                                        <td>{{ ucfirst($pengaduan->status) }}</td>
                                        <td>
                                            <img src="{{ asset('/uploads/images/' . $pengaduan->foto_bukti) }}"
                                                alt="{{ $pengaduan->foto_bukti }}" width="100">
                                        </td>
                                        <td>
                                            @if (!is_null($pengaduan->tanggapan()->first()))
                                                {{ $pengaduan->tanggapan()->first()->tanggapan }}
                                            @else
                                                Belum ada tanggapan
                                            @endif
                                        </td>
                                        <td>
                                            @if (!is_null($pengaduan->tanggapan()->first()))
                                                {{ date('Y-m-d', strtotime($pengaduan->tanggapan()->first()->tgl_tanggapan)) }}
                                            @else
                                                Belum ada tanggapan
                                            @endif
                                        </td>
                                        <td>
                                            {{ $pengaduan->created_at->format('Y-m-d') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
