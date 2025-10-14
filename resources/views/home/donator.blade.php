@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/homepage/style.css') }}">
<script src="{{ asset('script/homepage/script.js') }}"></script>

@section('content')
<div class="homepage" style="max-width: 80rem; margin: 2rem auto;">
    <div class="content">
        <div class="title">
            <h3>Hi, {{ optional(Auth::user())->name ?? 'Tutee' }}!</h3>
        </div>
        <div class="">

        </div>
    </div>
</div>
@endsection