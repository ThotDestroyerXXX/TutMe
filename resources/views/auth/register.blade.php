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
                                    <p class="mt-2 small opacity-75">{{ __('messages.register_subtitle') }}</p>
                                </div>
                            </div>
                            <div class="col-md-7 p-4">
                                <div class="p-3 auth-form">
                                    <h5 class="card-title text-center mb-0">{{ __('messages.register_title') }}</h5>
                                    <p class="text-center text-muted small mb-3">{{ __('messages.register_subtitle') }}</p>

                                    <form method="POST" action="{{ route('register.post') }}" class="mt-3" novalidate>
                                        @csrf

                                        <div class="mb-3">
                                            <label for="name" class="form-label">{{ __('messages.name') }}</label>
                                            <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">{{ __('messages.email_address') }}</label>
                                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="password" class="form-label">{{ __('messages.password') }}</label>
                                            <input id="password" type="text" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                            @error('password')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="password-confirm" class="form-label">{{ __('messages.confirm_password') }}</label>
                                            <input id="password-confirm" type="text" class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">{{ __('messages.select_role') }} <span class="text-danger">*</span></label>
                                            <div class="btn-group d-flex role-btn" role="group" aria-label="Role selection">
                                                <input type="radio" class="btn-check" name="role" id="roleStudent" value="Student" autocomplete="off" {{ old('role') == 'Student' ? 'checked' : '' }} required>
                                                <label class="btn btn-outline-primary" for="roleStudent">{{ __('messages.student') }}</label>

                                                <input type="radio" class="btn-check" name="role" id="roleTutor" value="Tutor" autocomplete="off" {{ old('role') == 'Tutor' ? 'checked' : '' }}>
                                                <label class="btn btn-outline-primary" for="roleTutor">{{ __('messages.tutor') }}</label>

                                                <input type="radio" class="btn-check" name="role" id="roleDonator" value="Donator" autocomplete="off" {{ old('role') == 'Donator' ? 'checked' : '' }}>
                                                <label class="btn btn-outline-primary" for="roleDonator">{{ __('messages.donator') }}</label>
                                            </div>
                                            @error('role')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill">{{ __('messages.register') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .auth-visual{ background: linear-gradient(135deg, rgba(99,102,241,1) 0%, rgba(79,70,229,1) 100%); }
        </style>

        @section('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function(){
                    const t1 = document.getElementById('togglePasswordReg');
                    const p1 = document.getElementById('password');
                    const t2 = document.getElementById('togglePasswordConfirm');
                    const p2 = document.getElementById('password-confirm');
                    if(t1 && p1){ t1.addEventListener('click', ()=>{ p1.type = p1.type === 'password' ? 'text' : 'password'; t1.textContent = p1.type === 'password' ? 'Show' : 'Hide'; }); }
                    if(t2 && p2){ t2.addEventListener('click', ()=>{ p2.type = p2.type === 'password' ? 'text' : 'password'; t2.textContent = p2.type === 'password' ? 'Show' : 'Hide'; }); }
                });
            </script>
        @endsection
    </div>

    <style>
        .auth-visual{ background: linear-gradient(135deg,#3a7bd5 0%,#3a60e6 100%); color:#fff; }
        .auth-card{ border-radius:.75rem; overflow:hidden; }
        .auth-form .form-control{ height:calc(1.5em + 1rem); padding:.5rem .75rem; }
        .role-btn .btn{ flex:1; }
        @media (max-width:767px){ .auth-page{ padding-top:2.5rem; padding-bottom:2.5rem; } }
    </style>

@endsection
