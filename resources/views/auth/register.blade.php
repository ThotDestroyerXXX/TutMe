@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center w-100 m-auto card p-2" style="max-width: 420px;">
            <div class="card-body">
                <form method="POST" action="{{ route('register.post') }}" class="d-flex gap-3 flex-column" novalidate>
                    <div>
                        <h5 class="card-title text-center">{{ __('messages.register_title') }}</h5>
                        <p class="text-center">{{ __('messages.register_subtitle') }}</p>
                    </div>
                    @csrf

                    <div class="row gap-2">
                        <label for="name" class="col-12">{{ __('messages.name') }}</label>

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
                        <label for="email" class="col-12">{{ __('messages.email_address') }}</label>

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
                        <label for="password" class="col-12">{{ __('messages.password') }}</label>

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
                        <label for="password-confirm" class="col-12">{{ __('messages.confirm_password') }}</label>

                        <div class="col">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row gap-2">
                        <label class="col-12">{{ __('messages.select_role') }} <span class="text-danger">*</span></label>

                        <div class="col">
                            <div class="radio-btn d-flex gap-3 @error('role') is-invalid @enderror">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="Student" style="cursor: pointer;"
                                        name="role" value="Student" {{ old('role') == 'Student' ? 'checked' : '' }}
                                        required>
                                    <label class="form-check-label" for="Student" style="cursor: pointer;">
                                        {{ __('messages.student') }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="Tutor" style="cursor: pointer;"
                                        name="role" value="Tutor" {{ old('role') == 'Tutor' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="Tutor" style="cursor: pointer;">
                                        {{ __('messages.tutor') }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="Donator" style="cursor: pointer;"
                                        name="role" value="Donator" {{ old('role') == 'Donator' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="Donator" style="cursor: pointer;">
                                        {{ __('messages.donator') }}
                                    </label>
                                </div>
                            </div>

                            @error('role')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit">
                        {{ __('messages.register') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
