@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/homepage/style.css') }}">
<script src="{{ asset('script/homepage/script.js') }}"></script>

@section('content')
    <style>
        .back-link { cursor: pointer; }
        .back-link .badge {
            transition: background-color .15s ease, color .15s ease, transform .12s ease;
        }
        .back-link:hover .badge {
            background-color: #d3d3d3 !important;
            color: #000 !important;
            transform: translateY(-1px);
        }
        .enrollment-wrapper { max-width: 900px; margin: 2.5rem auto; }
        .enrollment-card { border: none; border-radius: 12px; }
        .meta small { color: #6c757d; }
        @media (max-width: 576px) {
            .enrollment-wrapper { margin: 1rem; }
            .avatar { width:64px; height:64px; }
        }
    </style>
    <div class="enrollment-wrapper">
        <a href="{{ url()->previous() }}" class="text-decoration-none d-inline-flex align-items-center mb-3 back-link">
            <span class="badge bg-light text-dark me-2">&larr; {{ __('messages.back') ?? 'Back' }}</span>
        </a>
        <div class="card shadow-sm enrollment-card">
            <div class="card-body p-4">
                <div class="row g-3 align-items-center">
                    <div class="col-auto d-flex flex-column align-items-center text-center">
                        <div class="mt-2">
                            <strong class="d-block">@if(Auth::user()->role === 'Mentor'){{ $tutee->name }}@else{{ $mentor->name }}@endif</strong>
                            <small class="meta">{{ __('messages.level') }} • @if(Auth::user()->role === 'Mentor'){{ $tutee->education_level }}@else{{ $mentor->education_level }}@endif</small>
                            <small class="d-block text-muted">{{ __('messages.enrollment_date') }}: {{ date('l, F j, Y', strtotime($enrollment->date)) }}</small>
                        </div>
                    </div>

                    <div class="col">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="mb-1">{{ $course->title }}</h5>
                                <div class="text-muted small">{{ $course->subject }} • {{ $course->session }} {{ __('messages.session') }}</div>
                            </div>

                            <div class="text-end">
                                @php $status = $enrollment->status ?? 'N/A'; @endphp
                                <span class="badge bg-{{ $status === 'PENDING' ? 'warning text-dark' : ($status === 'DONE' ? 'success' : 'secondary') }}">{{ $status }}</span>
                            </div>
                        </div>

                        <hr>

                        <div class="mb-2">
                            <div class="small text-muted">{{ __('messages.meet_link') }}</div>
                            @if($course->meet_link)
                                <a href="{{ $course->meet_link }}" target="_blank">{{ $course->meet_link }}</a>
                            @else
                                <div class="text-muted">—</div>
                            @endif
                        </div>

                        <div class="d-flex gap-2">
                            @if(Auth::user()->role === 'Mentor')
                                @if($enrollment->status === 'PENDING')
                                    <a href="{{ route('acceptEnrollment', ['id' => $enrollment->id, 'bool' => 'true']) }}" class="btn btn-success btn-sm">{{ __('messages.accept') }}</a>
                                    <a href="{{ route('acceptEnrollment', ['id' => $enrollment->id, 'bool' => 'false']) }}" class="btn btn-outline-danger btn-sm">{{ __('messages.reject') }}</a>
                                @else
                                    @php $today = strtotime(date('Y-m-d')); $enrollDate = strtotime($enrollment->date); @endphp
                                    @if($today > $enrollDate && $enrollment->status !== 'DONE')
                                        <a href="{{ route('finishMentoring', ['id' => $enrollment->id, 'userId' => $course->instructor_id]) }}" class="btn btn-primary btn-sm">{{ __('messages.finish_mentoring') }}</a>
                                    @endif
                                @endif
                            @else
                                @php $today = strtotime(date('Y-m-d')); $enrollDate = strtotime($enrollment->date); @endphp
                                @if($today > $enrollDate && $enrollment->status === 'DONE')
                                    <a href="{{ route('finishMentoring', ['id' => $enrollment->id, 'userId' => $enrollment->user_id]) }}" class="btn btn-primary btn-sm">{{ __('messages.finish_mentoring') }}</a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection