@extends('layouts.app')

@section('content')
<<<<<<< Updated upstream
<div class="container">
    <div class="d-flex justify-content-center w-100 m-auto card p-2" style="max-width: 420px;">
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}" class="d-flex gap-3 flex-column" novalidate>
                <div>
                    <h5 class="card-title text-center">Create an Account</h5>
                    <p class="text-center">Welcome! Create an account to get started</p>
                </div>
                @csrf

                <div class="row gap-2">
                    <label for="name" class="col-12">Name</label>

                    <div class="col">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row gap-2">
                    <label for="email" class="col-12">Email Address</label>

                    <div class="col">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row gap-2">
                    <label for="password" class="col-12">Password</label>

                    <div class="col">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row gap-2">
                    <label for="password-confirm" class="col-12">Confirm Password</label>

                    <div class="col">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password">
                    </div>
                </div>
                <div class="radio-btn" style="display: flex; gap: 2rem;">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="Student" onMouseOver="this.style.cursor='pointer'" name="role" value="Student" required>
                        <label class="form-check-label" for="Student" onMouseOver="this.style.cursor='pointer'">
                            Student
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="Tutor" onMouseOver="this.style.cursor='pointer'" name="role" value="Tutor">
                        <label class="form-check-label" for="Tutor" onMouseOver="this.style.cursor='pointer'">
                            Tutor
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="Donator" onMouseOver="this.style.cursor='pointer'" name="role" value="Donator">
                        <label class="form-check-label" for="Donator" onMouseOver="this.style.cursor='pointer'">
                            Donator
                        </label>
                    </div>
                </div>
                <button type="submit">
                    Register
                </button>
            </form>
=======
    <div class="auth-page d-flex align-items-center min-vh-100 py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="card shadow-sm overflow-hidden rounded-4">
                        <div class="row g-0">
                            <div class="col-md-6 d-none d-md-flex bg-secondary text-white align-items-center justify-content-center p-4 auth-visual">
                                <div class="text-center px-3">
                                    <h3 class="fw-bold">{{ __('messages.register_title') }}</h3>
                                    <p class="mt-3">{{ __('messages.register_subtitle') }}</p>
                                    <svg width="140" height="140" viewBox="0 0 24 24" fill="none" class="mt-4" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="10" fill="rgba(255,255,255,0.08)"/></svg>
                                </div>
                            </div>
                            <div class="col-md-6 p-4">
                                <div class="p-3">
                                    <h5 class="card-title text-center mb-0">{{ __('messages.register_title') }}</h5>
                                    <p class="text-center text-muted small">{{ __('messages.register_subtitle') }}</p>

                                    <form method="POST" action="{{ route('register.post') }}" class="mt-4" novalidate>
                                        @csrf

                                        <div class="mb-3">
                                            <label for="name" class="form-label">{{ __('messages.name') }}</label>
                                            <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">{{ __('messages.email_address') }}</label>
                                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="password" class="form-label">{{ __('messages.password') }}</label>
                                            <div class="input-group">
                                                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                <button class="btn btn-outline-secondary" type="button" id="togglePasswordReg" tabindex="-1">Show</button>
                                            </div>
                                            @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="password-confirm" class="form-label">{{ __('messages.confirm_password') }}</label>
                                            <div class="input-group">
                                                <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password">
                                                <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm" tabindex="-1">Show</button>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label d-block">{{ __('messages.select_role') }} <span class="text-danger">*</span></label>
                                            <div class="btn-group" role="group" aria-label="roles">
                                                <input type="radio" class="btn-check" name="role" id="roleStudent" value="Student" autocomplete="off" {{ old('role') == 'Student' ? 'checked' : '' }} required>
                                                <label class="btn btn-outline-primary" for="roleStudent">{{ __('messages.student') }}</label>

                                                <input type="radio" class="btn-check" name="role" id="roleTutor" value="Tutor" autocomplete="off" {{ old('role') == 'Tutor' ? 'checked' : '' }}>
                                                <label class="btn btn-outline-primary" for="roleTutor">{{ __('messages.tutor') }}</label>

                                                <input type="radio" class="btn-check" name="role" id="roleDonator" value="Donator" autocomplete="off" {{ old('role') == 'Donator' ? 'checked' : '' }}>
                                                <label class="btn btn-outline-primary" for="roleDonator">{{ __('messages.donator') }}</label>
                                            </div>
                                            @error('role')<div class="invalid-feedback d-block mt-2">{{ $message }}</div>@enderror
                                        </div>

                                        <button type="submit" class="btn btn-success btn-lg w-100 rounded-pill">{{ __('messages.register') }}</button>

                                        <div class="text-center mt-3">
                                            <small class="text-muted">{{ __('messages.have_account') ?? 'Already have an account?' }} <a href="{{ route('login') }}">{{ __('messages.login') }}</a></small>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
>>>>>>> Stashed changes
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
@endsection