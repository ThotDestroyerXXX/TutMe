@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center w-100 m-auto card p-2" style="max-width: 420px;">
            <div class="card-body ">

                <form method="POST" action="{{ route('login') }}" class="d-flex gap-3 flex-column" novalidate>
                    <div>
                        <h5 class="card-title text-center">Login to TutMe</h5>
                        <p class="text-center">Welcome back! Sign in to continue</p>
                    </div>
                    @csrf

                    <div class="row gap-2">
                        <label for="email" class="col-12 ">Email Address</label>

                        <div class="col">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

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
            </div>
        </div>
    </div>
@endsection
