@extends('layouts.app')
@section('title', 'Ubah Data Masyarakat')

@section('title-header', 'Ubah Data Masyarakat')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('masyarakat.index') }}">Data Masyarakat</a></li>
    <li class="breadcrumb-item active">Ubah Data Masyarakat</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Ubah Data Masyarakat</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('masyarakat.update', $masyarakat->id) }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="nik">Nik</label>
                                    <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik"
                                        placeholder="Nik Masyarakat" value="{{ old('nik', $masyarakat->nik) }}" name="nik">

                                    @error('nik')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                        placeholder="Nama Masyarakat" value="{{ old('name', $masyarakat->name) }}" name="name">

                                    @error('name')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                        placeholder="Email Masyarakat" value="{{ old('email', $masyarakat->email) }}" name="email">

                                    @error('email')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="no_telp">No Telp</label>
                                    <input type="number" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp"
                                        placeholder="No Telp Masyarakat" value="{{ old('no_telp', $masyarakat->no_telp) }}" name="no_telp">

                                    @error('no_telp')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                    placeholder="Alamat Masyarakat" name="alamat" cols="30" rows="10">{{ old('alamat', $masyarakat->alamat) }}</textarea>

                                    @error('alamat')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-sm btn-primary">Ubah</button>
                                <a href="{{ route('masyarakat.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
