@extends('layouts.app')
@section('title', 'Osing Guide | Login')
@section('main')
<div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
    style="background-image: url('{{ asset('assets/img/landing-page/ijen-photo.jpeg') }}'); background-position: top;">
    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 text-center mx-auto">
                <a href="/">
                    <img src="{{ asset('assets/img/landing-page/osingguide-whitelogo.PNG') }}" alt="logo" width="30%">
                </a>
                <h1 class="text-white mb-2">Welcome!</h1>
                <p class="text-lead text-white">Sign in to your account to started our platform.</p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
                <div class="card-header text-center pt-4">
                    <h4 class="font-weight-bolder">Sign In</h4>
                    <p class="mb-0">Enter your email and password to sign in</p>
                </div>

                <div class="card-body">
                    {{-- Session status (success messages) --}}
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{-- General auth error (optional) --}}
                    @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif
                    {{-- Laravel login form --}}
                    <form method="POST" action="{{ route('login') }}" role="form">
                        @csrf

                        {{-- Email --}}
                        <div class="mb-3">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                autocomplete="username"
                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                placeholder="Email" aria-label="Email">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <input id="password" type="password" name="password" required
                                autocomplete="current-password"
                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                placeholder="Password" aria-label="Password">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Remember me --}}
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="rememberMe" name="remember" {{
                                old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>

                        {{-- Submit --}}
                        <div class="text-center mb-3">
                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                        </div>

                        {{-- Forgot password link --}}
                        <div class="card-footer text-center pt-0 px-lg-2 px-1">
                            <p class="mb-1 text-sm mx-auto">
                                Forgot you password? Reset your password
                                @if (Route::has('password.request'))
                                <a class="text-sm" href="{{ route('password.request') }}">
                                    here
                                </a>
                                @endif
                            </p>
                        </div>
                        <div class="card-footer text-center pt-0 px-lg-2 px-1">
                            <p class="mb-4 text-sm mx-auto">
                                Don't have an account?
                                @if (Route::has('register'))
                                <a class="text-sm" href="{{ route('register') }}">Sign up</a>
                                @endif
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
