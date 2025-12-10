@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/homepage/style.css') }}">
<script src="{{ asset('script/homepage/script.js') }}"></script>

@section('content')
    <div class="homepage" style="max-width: 80rem; margin: 2rem auto;">
        <a href="{{ '/' }}">
            <button type="button" class="btn btn-primary mt-2 rounded-5"
                style="width: 3rem; background-color: gray; border-color: gray;">
                < </button>
        </a>
        <br><br><br>
        <div class="content">
            @if (Auth::user()->role === 'Mentor')
                <div class="userData">
                    <div style="display: flex;">
                        <p>{{ __('messages.tutee_name') }} :</p>&nbsp;&nbsp;<p>{{ $tutee->name }}</p>
                    </div>
                    <div style="display: flex;">
                        <p>{{ __('messages.level') }} :</p>&nbsp;&nbsp;<p>{{ $tutee->education_level }}</p>
                    </div><br>
                    <div>
                        {{ date('l, F jS, Y', strtotime($enrollment->date)) }}
                    </div>
                </div><br>
                @if ($enrollment->status === 'PENDING')
                    <a href="{{ route('acceptEnrollment', ['id' => $enrollment->id, 'bool' => 'true']) }}"
                        class="btn btn-primary bg-white border border-primary rounded-3 ms-2 text-decoration: none;"
                        style="color: #363636ff;">
                        {{ __('messages.accept') }}
                    </a>
                    <a href="{{ route('acceptEnrollment', ['id' => $enrollment->id, 'bool' => 'false']) }}"
                        class="btn btn-primary bg-white border border-primary rounded-3 ms-2 text-decoration: none;"
                        style="color: #363636ff;">
                        {{ __('messages.reject') }}
                    </a>
                @else
                    <a href="{{ $course->meet_link }}" target="_blank">{{ $course->meet_link }}</a>
                    @php
                        $today = strtotime(date('Y-m-d'));
                        $enrollDate = strtotime($enrollment->date);
                    @endphp
                    @if ($today > $enrollDate && $enrollment->status !== 'DONE')
                        <br><br><br>
                        <a
                            href="{{ route('finishMentoring', ['id' => $enrollment->id, 'userId' => $course->instructor_id]) }}">
                            <button type="submit"
                                class="btn btn-primary bg-white border border-primary rounded-3 ms-2 text-decoration: none;"
                                style="color: #363636ff;">
                                {{ __('messages.finish_mentoring') }}
                            </button>
                        </a>
                    @endif
                @endif
            @else
                <div class="userData">
                    <div style="display: flex;">
                        <p>{{ __('messages.mentor_name') }} :</p>&nbsp;&nbsp;<p>{{ $mentor->name }}</p>
                    </div>
                    <div style="display: flex;">
                        <p>{{ __('messages.level') }} :</p>&nbsp;&nbsp;<p>{{ $mentor->education_level }}</p>
                    </div><br>
                    <div>
                        {{ date('l, F jS, Y', strtotime($enrollment->date)) }}
                    </div>
                </div><br>
                <a href="{{ $course->meet_link }}" target="_blank">{{ $course->meet_link }}</a>
                @php
                    $today = strtotime(date('Y-m-d'));
                    $enrollDate = strtotime($enrollment->date);
                @endphp
                @if ($today > $enrollDate && $enrollment->status === 'DONE')
                    <br><br><br>
                    <a href="{{ route('finishMentoring', ['id' => $enrollment->id, 'userId' => $enrollment->user_id]) }}">
                        <button type="submit"
                            class="btn btn-primary bg-white border border-primary rounded-3 ms-2 text-decoration: none;"
                            style="color: #363636ff;">
                            {{ __('messages.finish_mentoring') }}
                        </button>
                    </a>
                @endif
            @endif
        </div>
    </div>

@endsection
