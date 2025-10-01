<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Header -->
    <!-- <header style="background:#333; color:white; padding:15px;">
        <h1>My Laravel App</h1>
        <nav>
            <a href="{{ url('/dashboard') }}" style="color:white; margin-right:10px;">Dashboard</a>
            <a href="{{ url('/profile') }}" style="color:white; margin-right:10px;">Profile</a>
            <a href="{{ url('/registrasi') }}" style="color:white;">Registrasi</a>
        </nav>
    </header> -->

    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav w-100 gap-2  justify-content-end mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="btn btn-outline-dark" href="{{ url('/login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-dark" href="{{ url('/logout') }}">Sign Up</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="bg-light min-vh-100">
        @yield('header')
        <div style="padding: 1rem; max-width: 1200px; margin: auto;">
            @yield('content')

            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
