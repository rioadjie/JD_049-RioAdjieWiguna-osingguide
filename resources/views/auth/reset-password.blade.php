@extends('layouts.app')
@section('title', 'Osing Guide | Reset Password')
@section('main')
<div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
    style="background-image: url('{{ asset('assets/img/landing-page/ijen-photo.jpeg') }}'); background-position: top;">
    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 text-center mx-auto">
                <h2 class="text-white mb-2 mt-5">Reset your Password</h2>
                <p class="text-lead text-white">don't worry if you forget your password.</p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card mb-md-8">
                <div class="card-header">
                    <div class="d-flex">
                        <div class="icon icon-shape bg-primary shadow text-center border-radius-md">
                            <i class="bi bi-person-circle text-white text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="mb-0">Can't log in?</h5>
                            <p class="text-sm mb-0">Restore access to your account now.</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Notifikasi sukses kalau email terkirim --}}
                    @if (session('status'))
                    <div class="alert alert-success text-white">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form role="form" method="POST" action="{{ route('password.store') }}">
                        @csrf
                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        {{-- Email --}}
                        <div class="mb-3">
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Email" required
                                autofocus>
                            @error('email')
                            <div class="text-danger text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                required required autocomplete="new-password">
                            @error('password')
                            <div class="text-danger text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-3">
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Confirm Password" required required autocomplete="new-password">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary w-100 mt-4 mb-0">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
