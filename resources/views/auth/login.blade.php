<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/landing-page/osingguide-logo.svg') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/landing-page/osingguide-logo.svg') }}">
    <title>Osing Guide - Login</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- CSS Argon -->
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />
</head>

<body class="">

    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        {{-- LEFT: card form --}}
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <a href="/">
                                        <img src="{{ asset('assets/img/landing-page/osingguide-logo.svg') }}" alt="logo"
                                            width="50%" class="mb-3">
                                    </a>
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
                                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                                required autofocus autocomplete="username"
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
                                            <input class="form-check-input" type="checkbox" id="rememberMe"
                                                name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>

                                        {{-- Submit --}}
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                                        </div>

                                        {{-- Forgot password link --}}
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            @if (Route::has('password.request'))
                                            <a class="text-sm" href="{{ route('password.request') }}">
                                                {{ __('Forgot your password?') }}
                                            </a>
                                            @endif
                                            @if (Route::has('register'))
                                            <a class="text-sm" href="{{ route('register') }}">Sign up</a>
                                            @endif
                                        </div>
                                    </form>
                                </div>

                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        {{-- alternatively keep other messages here --}}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- RIGHT: illustration --}}
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 pt-5 border-radius-lg d-flex flex-column justify-content-start overflow-hidden"
                                style="
                                        background-image: url('{{ asset('assets/img/landing-page/osingguide-logo.svg') }}');
                                        background-repeat: no-repeat;
                                        background-position: center;
                                        background-size: contain;
                                        background-position: center;
                                    ">
                                <span class="mask bg-gradient-primary opacity-6"></span>
                            </div>
                        </div>
                        {{-- end right --}}
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Core JS -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = { damping: '0.5' }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
    </script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('assets/js/argon-dashboard.min.js') }}"></script>
</body>

</html>
