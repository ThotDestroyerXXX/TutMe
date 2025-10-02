@extends('layouts.app')

@section('content')
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
                    <button type="submit">
                        Register
                    </button>
                </form>
            </div>
        </div>
    @endsection
