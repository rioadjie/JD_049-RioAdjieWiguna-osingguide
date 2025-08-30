@extends('layouts.app')
@section('title', 'Osing Guide | Verification Email')
@section('main')
<div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
    style="background-image: url('{{ asset('assets/img/landing-page/ijen-photo.jpeg') }}'); background-position: top;">
    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 text-center mx-auto">
                <h2 class="text-white mb-2 mt-5">Verification Your Email!</h2>
                <p class="text-lead text-white">check your email and klik verification link.</p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
                <div class="card-body px-lg-5 py-lg-5 text-center">
                    <div class="text-center text-muted mb-3">
                        <h2>Verification</h2>
                    </div>
                    @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success">
                        A new verification link has been sent to your email.
                    </div>
                    @endif
                    <div class="text-center text-muted mb-1">
                        <h5>Thank you for registering. Before continuing, please verify your email address by clicking the link we sent to your email.</h5>
                    </div>
                    <div class="text-center">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100 mt-2 mb-0">
                                Resend Verification Email
                            </button>
                        </form>
                        <form method="POST" action="{{ route('logout') }}" class="mt-3">
                            @csrf
                            <button type="submit" class="btn btn-danger w-50 mt-2 mb-0">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
