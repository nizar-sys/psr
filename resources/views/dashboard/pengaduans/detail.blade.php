@extends('layouts.app')
@section('title', 'Detail Data Pengaduan')

@section('title-header', 'Detail Data Pengaduan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('pengaduan.index') }}">Data Pengaduan</a></li>
    <li class="breadcrumb-item active">Detail Data Pengaduan</li>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="text-center">
                            Pengaduan Masyarakat
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>NIK</th>
                                    <td>:</td>
                                    <td>{{ $pengaduan->masyarakat->nik ?? 'Tidak ada.' }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Masyarakat</th>
                                    <td>:</td>
                                    <td>{{ $pengaduan->masyarakat->name }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Pengaduan</th>
                                    <td>:</td>
                                    <td>{{ date('D, d M Y', strtotime($pengaduan->created_at)) }}</td>
                                </tr>
                                <tr>
                                    <th>Foto</th>
                                    <td>:</td>
                                    <td><img src="{{ asset('/uploads/images/' . $pengaduan->foto_bukti ?? 'no-image.png') }}"
                                            alt="Foto Pengaduan" class="embed-responsive"></td>
                                </tr>
                                <tr>
                                    <th>Isi Laporan</th>
                                    <td>:</td>
                                    <td>{{ $pengaduan->isi_laporan }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>:</td>
                                    <td>
                                        @if ($pengaduan->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($pengaduan->status == 'ditolak')
                                            <span class="badge badge-danger">Ditolak</span>
                                        @else
                                            <span class="badge badge-success">{{ $pengaduan->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if (Auth::user()?->role != 'masyarakat')

                <div class="col-lg-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-center">
                                Tanggapan Petugas
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('pengaduan.store-tanggapan', ['pengaduanId' => $pengaduan->id]) }}"
                                method="POST">
                                @csrf
                                <select class="form-control @error('status') is-invalid @enderror mb-3" id="status"
                                    name="status">
                                    @php
                                        $roles = ['pending', 'diterima', 'ditolak'];
                                    @endphp
                                    <option value="" selected>Status</option>
                                    @foreach ($roles as $status)
                                        <option value="{{ $status }}"
                                            @if (old('status', $pengaduan->status) == $status) selected @endif>
                                            {{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>

                                <div class="form-group mb-3">
                                    <textarea class="form-control @error('tanggapan') is-invalid @enderror" id="tanggapan" placeholder="Isi Tanggapan"
                                        name="tanggapan" cols="30" rows="4">{{ old('tanggapan', $pengaduan->tanggapan()?->first()?->tanggapan) }}</textarea>

                                    @error('tanggapan')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-default">KIRIM</button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-lg-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-center">
                                Tanggapan Petugas
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('pengaduan.store-tanggapan', ['pengaduanId' => $pengaduan->id]) }}"
                                method="POST">
                                @csrf
                                <select class="form-control @error('status') is-invalid @enderror mb-3" id="status"
                                    name="status" disabled>
                                    <option value="" selected>{{ ucfirst($pengaduan->status) }}</option>
                                </select>

                                <div class="form-group mb-3">
                                    <textarea class="form-control @error('tanggapan') is-invalid @enderror" id="tanggapan" placeholder="Isi Tanggapan"
                                        name="tanggapan" cols="30" rows="4" disabled>{{ old('tanggapan', $pengaduan->tanggapan()?->first()?->tanggapan) }}</textarea>

                                    @error('tanggapan')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
