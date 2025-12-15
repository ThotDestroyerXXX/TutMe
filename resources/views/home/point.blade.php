@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/homepage/style.css') }}">
<script src="{{ asset('script/homepage/script.js') }}"></script>

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="homepage" style="max-width: 80rem; margin: 2rem auto;">
    <div class="myPointPage" style="margin: auto; text-align: center; display: flex;">
        <div class="userPoint bg-white" style="border-radius: 2rem; padding: 2rem; display: flex; justify-content: space-between; width: 30rem; margin: auto;">
            <h4>Your Point :</h4>
            <h5 style="transform: translateY(5px);">{{ $availPoint }}</h5>
        </div>
        @if ($userRole === 'Mentor')
            <div class="userPoint bg-white" style="border-radius: 2rem; padding: 2rem; display: flex; justify-content: space-between; width: 30rem; margin: auto;">
                <h4>Available Point to Transfer :</h4>
                <h5 style="transform: translateY(5px);">{{ $availPoint }}</h5>
            </div>
        @else
            <div class="userPoint bg-white" style="border-radius: 2rem; padding: 2rem; display: flex; justify-content: space-between; width: 30rem; margin: auto;">
                <h4>Point Spent :</h4>
                <h5 style="transform: translateY(5px);">{{ $pointSpent }}</h5>
            </div>
        @endif
    </div>
</div>
@endsection