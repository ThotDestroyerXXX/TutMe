@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/homepage/style.css') }}">

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
        </div>
    </div>
@endsection
