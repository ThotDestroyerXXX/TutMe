@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/homepage/style.css') }}">
<script src="{{ asset('script/homepage/script.js') }}"></script>

@section('header')
    <div class="bg-primary h-100 w-100 p-4 text-white mb-4 rounded-bottom ">
        <div style="padding: 0 1rem 0.5rem 1rem; max-width: 1200px; margin: auto; position: relative;">
            <h4 class="fw-bold">Hi, Tutee!</h4>
            <p>Mau Belajar Apa Hari Ini?</p>
            <div class="d-flex gap-2 bg-white p-2 rounded w-100 position-absolute top-80" style="height: 4rem">
                <div class="input-group ">
                    <input type="text" class="form-control" placeholder="Search..." aria-label="Search">

                </div>
                <div class="w-100 text-dark">
                    <p>kelas</p>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('content')
    <div class="homepage">
        <div class="content">
            <div class="title">
                <h3>Hi, {{ optional(Auth::user())->name ?? 'Tutee' }}!</h3>
                <h6>Mau belajar apa hari ini?</h6>
            </div>
            <div class="inputGroup mb-3">
                <input type="text" class="form-control" placeholder="Search" id="Search">
                <button type="button" class="btn btn-primary modalBtn" data-bs-toggle="modal" data-bs-target="#myModal">Modal</button>
                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <button type="button" class="btn btn-secondary col-md-6" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-secondary col-md-6 ms-auto" data-bs-dismiss="modal">Close</button>
                                    </div>
                                    <div class="row">
                                        <button type="button" class="btn btn-secondary col-md-6" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-secondary col-md-6 ms-auto" data-bs-dismiss="modal">Close</button>
                                    </div>
                                    <div class="row">
                                        <button type="button" class="btn btn-secondary col-md-6" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-secondary col-md-6 ms-auto" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel" style="margin-top: 65px;">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button style="background-color: black;" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button style="background-color: black;" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button style="background-color: black;" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="..." class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>First slide label</h5>
                                <p>Some representative placeholder content for the first slide.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="..." class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Second slide label</h5>
                                <p>Some representative placeholder content for the second slide.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="..." class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Third slide label</h5>
                                <p>Some representative placeholder content for the third slide.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
