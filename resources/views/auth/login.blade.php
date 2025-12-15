@extends('layouts.app')

@section('content')
    <div class="auth-page d-flex align-items-center min-vh-100 py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="card auth-card shadow-sm">
                        <div class="row g-0">
                            <div class="col-md-5 d-none d-md-flex auth-visual align-items-center justify-content-center">
                                <div class="text-center px-3 text-white">
                                    <h3 class="fw-bold">TutMe</h3>
                                    <p class="mt-2 small opacity-75">{{ __('messages.login_subtitle') }}</p>
                                </div>
                            </div>
                            <div class="col-md-7 p-4">
                                <div class="p-3 auth-form">
                                    <h5 class="card-title text-center mb-0">{{ __('messages.login_title') }}</h5>
                                    <p class="text-center text-muted small mb-3">{{ __('messages.login_subtitle') }}</p>

                                    <form method="POST" action="{{ route('login.authenticate') }}" class="mt-3" novalidate>
                                        @csrf

                                        <div class="mb-3">
                                            <label for="email" class="form-label">{{ __('messages.email_address') }}</label>
                                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label d-flex justify-content-between">
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
            </div>
        </div>
    </div>

    <style>
        .auth-visual{ background: linear-gradient(135deg,#3a7bd5 0%,#3a60e6 100%); color:#fff; }
        .auth-card{ border-radius:.75rem; overflow:hidden; }
        .auth-form .form-control{ height:calc(1.5em + 1rem); padding:.5rem .75rem; }
        .auth-form .btn-outline-secondary{ border-radius:.375rem 0 .375rem 0; }
        @media (max-width:767px){ .auth-page{ padding-top:2.5rem; padding-bottom:2.5rem; } }
    </style>

@endsection

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
