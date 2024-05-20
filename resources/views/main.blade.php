@extends('layouts.app')

@section('content')
<div class="text-center">
    <a href="{{ route('redirect') }}" class="btn btn-danger">
        <i class="fa fa-google"> </i> Login with Google 
    </a>
</div>

<hr style=" border-top: 1px solid black;">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    @if(session('registered'))
                        <div class="alert alert-success">
                            Selamat, akun Anda telah berhasil didaftarkan dengan email: {{ session('email') }}
                        </div>
                    @endif

                    <h4 class="card-title">Login</h4>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                        <div class="mb-3">
                            <span>Don't have an account? <a href="{{ route('register.form') }}"> Register</a> here</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection