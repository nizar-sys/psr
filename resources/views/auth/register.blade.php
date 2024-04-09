@extends('layouts.auth')
@section('title', env('APP_NAME') . ' | Register')

@section('content')
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h4">{{ env('APP_NAME') }}</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register a new membership</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <div class="input-group">
                            <input class="form-control" name="nik" placeholder="nik" type="number"
                            value="{{ old('nik') }}" required type="number">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                            </div>
                        </div>
                        @error('nik')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <div class="input-group">
                            <input class="form-control" name="no_telp" placeholder="no_telp" type="number"
                            value="{{ old('no_telp') }}" required type="number">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                            </div>
                        </div>
                        @error('no_telp')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <div class="input-group">
                            <input class="form-control" name="name" placeholder="Full Name" type="name"
                            value="{{ old('name') }}" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                            </div>
                        </div>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <div class="input-group">
                            <input class="form-control" name="email" placeholder="Email" type="email"
                                value="{{ old('email') }}" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <div class="input-group">
                            <input class="form-control" name="password" placeholder="Password" type="password"
                                required>
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <div class="input-group">
                            <input class="form-control" name="password_confirmation" placeholder="Password Confirmation" type="password"
                                required>
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                        </div>
                        @error('password_confirmation')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <div class="input-group">
                            <input class="form-control" name="alamat" placeholder="Alamat" type="text"
                                required>
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-map"></i></span>
                            </div>
                        </div>
                        @error('alamat')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="row">
                        <div class="col-8">
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <a href="{{ url('login', []) }}" class="text-center">I already have an account</a>
                <p class="mb-0">
                    <a href="{{ url('/', []) }}" class="text-center">Kembali ke beranda</a>
                </p>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
@endsection

@error('terms')
    @section('script')
    <script>
        Snackbar.show({
            text: 'Anda harus menyetujui syarat dan ketentuan kami.',
            showAction: false,
            duration: 3000,
            textColor: '#fff',
            backgroundColor: '#dc3545'
        });
    </script>
    @endsection
@enderror
