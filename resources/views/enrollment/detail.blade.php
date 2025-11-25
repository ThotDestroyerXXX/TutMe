@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/homepage/style.css') }}">
<script src="{{ asset('script/homepage/script.js') }}"></script>

@section('content')
<div class="homepage" style="max-width: 80rem; margin: 2rem auto;">
    <a href="{{ '/' }}">
        <button type="button"
            class="btn btn-primary mt-2 rounded-5"
            style="width: 3rem; background-color: gray; border-color: gray;">
            <
        </button>
    </a>
    <br><br><br>
    <div class="content">
        <div class="userData">
            <div style="display: flex;">
                <p>Tutee Name :</p>&nbsp;&nbsp;<p>{{ $tutee->name }}</p>
            </div>
            <div style="display: flex;">
                <p>Level :</p>&nbsp;&nbsp;<p>{{ $tutee->education_level }}</p>
            </div><br>
            <div>
                {{date('l, F jS, Y', strtotime($enrollment->date))}}
            </div>
        </div><br>
        @if ($enrollment->status === 'PENDING')
        <a href="{{ route('acceptEnrollment', ['id' => $enrollment->id, 'bool' => true]) }}" class="btn btn-primary bg-white border border-primary rounded-3 ms-2 text-decoration: none;" style="color: #363636ff;">
            accept
        </a>
        <a href="{{ route('acceptEnrollment', ['id' => $enrollment->id, 'bool' => 'false']) }}" class="btn btn-primary bg-white border border-primary rounded-3 ms-2 text-decoration: none;" style="color: #363636ff;">
            reject
        </a>
        @endif
    </div>
</div>

@endsection