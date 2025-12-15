@extends('layouts.app')

@section('content')
    <div class="auth-page d-flex align-items-center min-vh-100 py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="card shadow-sm overflow-hidden rounded-4">
                        <div class="row g-0">
                            <div class="col-md-6 d-none d-md-flex bg-primary text-white align-items-center justify-content-center p-4 auth-visual">
                                <div class="text-center px-3">
                                    <h3 class="fw-bold">TutMe</h3>
                                    <p class="mt-3">{{ __('messages.login_subtitle') }}</p>
                                    <svg width="140" height="140" viewBox="0 0 24 24" fill="none" class="mt-4" xmlns="http://www.w3.org/2000/svg"><path d="M12 2L20 8V16L12 22L4 16V8L12 2Z" fill="rgba(255,255,255,0.12)"/></svg>
                                </div>
                            </div>
                            <div class="col-md-6 p-4">
                                <div class="p-3">
                                    <h5 class="card-title text-center mb-0">{{ __('messages.login_title') }}</h5>
                                    <p class="text-center text-muted small">{{ __('messages.login_subtitle') }}</p>

<<<<<<< Updated upstream
                <form method="POST" action="{{ route('login') }}" class="d-flex gap-3 flex-column" novalidate>
                    <div>
                        <h5 class="card-title text-center">Login to TutMe</h5>
                        <p class="text-center">Welcome back! Sign in to continue</p>
                    </div>
                    @csrf

                    <div class="row gap-2">
                        <label for="email" class="col-12 ">Email Address</label>
=======
                                    <form method="POST" action="{{ route('login.authenticate') }}" class="mt-4" novalidate>
                                        @csrf

                                        <div class="mb-3">
                                            <label for="email" class="form-label">{{ __('messages.email_address') }}</label>
                                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
>>>>>>> Stashed changes

                                        <div class="mb-3">
                                            <label for="password" class="form-label d-flex justify-content-between">
                                                <span>{{ __('messages.password') }}</span>
                                                @if (Route::has('password.request'))
                                                    <a href="{{ route('password.request') }}" class="small">{{ __('messages.forgot_password') }}</a>
                                                @endif
                                            </label>
                                            <div class="input-group">
                                                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                <button class="btn btn-outline-secondary" type="button" id="togglePassword" tabindex="-1">Show</button>
                                            </div>
                                            @error('password')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label small" for="remember">{{ __('messages.remember_me') }}</label>
                                            </div>
                                        </div>

<<<<<<< Updated upstream
                    <div class="row gap-2">
                        <div class="col-12 justify-content-between d-flex">
                            <label for="password">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    <span>
                                        Forgot Your Password?
                                    </span>
                                </a>
                            @endif
                        </div>
                        <div class="col">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                    </div>

                    <button type="submit">
                        Login
                    </button>


                </form>
=======
                                        <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill">{{ __('messages.login') }}</button>

                                        <div class="text-center mt-3">
                                            <small class="text-muted">{{ __('messages.no_account_yet') ?? "Don't have an account?" }} <a href="{{ route('register') }}">{{ __('messages.register') }}</a></small>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
>>>>>>> Stashed changes
            </div>
        </div>

        <style>
            .auth-visual{ background: linear-gradient(135deg, rgba(58,123,213,1) 0%, rgba(58,96,230,1) 100%); }
            .auth-visual h3{ font-family: 'Inter', sans-serif; }
            @media (max-width: 767px){ .auth-page{ padding-top: 3rem; padding-bottom: 3rem; } }
        </style>

        @section('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function(){
                    const toggle = document.getElementById('togglePassword');
                    const pwd = document.getElementById('password');
                    if(toggle && pwd){
                        toggle.addEventListener('click', function(){
                            if(pwd.type === 'password'){ pwd.type = 'text'; toggle.textContent = 'Hide'; }
                            else{ pwd.type = 'password'; toggle.textContent = 'Show'; }
                        });
                    }
                });
            </script>
        @endsection
@endsection
