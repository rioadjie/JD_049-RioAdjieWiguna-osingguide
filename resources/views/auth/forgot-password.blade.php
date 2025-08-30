@extends('layouts.app')
@section('title', 'Osing Guide | Forgot Password')
@section('main')
<div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
    style="background-image: url('{{ asset('assets/img/landing-page/ijen-photo.jpeg') }}'); background-position: top;">
    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 text-center mx-auto">
                <h2 class="text-white mb-2 mt-5">Forgot your Password?</h2>
                <p class="text-lead text-white">You will receive an e-mail in maximum 3 minutes.</p>
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
                            <p class="text-sm mb-0">Restore access to your account</p>
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
                    <form role="form" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <label>We will send a recovery link to</label>
                        <input type="email" class="form-control" placeholder="Your e-mail" aria-label="Email"
                            name="email" value="{{ old('email') }}" required autofocus>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary w-100 mt-4 mb-0">Email Password Reset
                                Link</button>
                            <p class="text-sm mt-3 mb-0">remember your account?
                                <a href="{{ route('login') }}" class="text-dark font-weight-bolder">Let's Sign in</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
