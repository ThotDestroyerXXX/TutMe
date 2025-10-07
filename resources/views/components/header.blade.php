<nav class="navbar navbar-expand-lg bg-white border-bottom border-muted " id="navbar" style="padding-bottom: 0;">
    <div class="container px-4 d-flex flex-column gap-2" style="max-width: 80rem; width: 100%;">
        <div class="d-flex align-items-center w-100 justify-content-between">
            <a class="navbar-brand" href="{{ url('/') }}">
                TutMe
            </a>
            <div class="d-flex align-items-center">
                <ul class="navbar-nav rightSide ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item login-btn  bg-primary">
                                <a class="nav-link " href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item register-btn bg-white border border-primary rounded-3 ms-2">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="{{ Auth::user()->image_url }}" alt="{{ Auth::user()->name }}"
                                    class="rounded-circle" width="30" height="30" />
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
        <div class="w-100">
            <ul class="nav nav-underline">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
