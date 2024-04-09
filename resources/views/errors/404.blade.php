@extends('layouts.auth')
@section('title', env('APP_NAME') . ' | Not Found')

@section('content')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h4">{{ env('APP_NAME') }}</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Not Found</p>
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('home') }}" class="btn btn-primary btn-block">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
