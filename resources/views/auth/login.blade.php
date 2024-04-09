@extends('layouts.auth')
@section('title', env('APP_NAME') . ' | Login')

@section('content')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h4">{{ env('APP_NAME') }}</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form role="form" action="{{ route('login.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <div class="input-group">
                            <input class="form-control" name="email" placeholder="Email" type="email"
                            value="{{ old('email') }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block">*{{ $message }} <i
                                    class="fas fa-arrow-up"></i></div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <input class="form-control" name="password" placeholder="Password" type="password"
                                value="{{ old('password') }}" id="password">
                            <div class="input-group-prepend">
                                <button type="button" onclick="seePassword(this)" class="input-group-text"
                                    id="seePass"><i class="fas fa-eye"></i></button>
                            </div>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">*{{ $message }} <i
                                    class="fas fa-arrow-up"></i></div>
                        @enderror
                    </div>


                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>

                <p class="mb-0">
                    <a href="{{ url('register', []) }}" class="text-center">Register a new membership</a>
                </p>
                <p class="mb-0">
                    <a href="{{ url('/', []) }}" class="text-center">Kembali ke beranda</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
