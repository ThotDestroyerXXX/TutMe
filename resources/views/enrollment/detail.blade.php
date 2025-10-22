@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/homepage/style.css') }}">
<script src="{{ asset('script/homepage/script.js') }}"></script>

@section('content')
<div class="homepage" style="max-width: 80rem; margin: 2rem auto;">
    <div class="content">
    {{ $data }}
        <a href="{{ route('acceptEnrollment', ['id' => $data->id]) }}" class="btn btn-primary bg-white border border-primary rounded-3 ms-2 text-decoration: none;" style="color: #363636ff;">
            accept
        </a>
    </div>
</div>

@endsection