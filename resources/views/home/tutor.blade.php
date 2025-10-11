@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/homepage/style.css') }}">
<script src="{{ asset('script/homepage/script.js') }}"></script>

@section('content')
<div class="homepage" style="max-width: 80rem; margin: 2rem auto;">
    <div class="content">
        <div class="title">
            <h3>Hi, {{ optional(Auth::user())->name ?? 'Siapa anda, login dulu!' }}!</h3>
            <h6>Mau mengajar apa hari ini?</h6>
        </div>
        <div style="display: flex; margin-top: 5rem;">
            <h6>Your Course(s)</h6>&nbsp;&nbsp;&nbsp;&nbsp;
            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#000000ff">
                <path d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
            </svg>
            <div style="margin-left: auto;">
                <form action="{{ route('newCourse') }}" method="GET">
                    <button type="submit" class="btn btn-primary bg-white border border-primary rounded-3 ms-2" style="color: #363636ff;">New Course</button>
                </form>
            </div>
        </div>
        <div class="courseList">
            @if ($courses->isEmpty())
            <p style="text-align:center;">Belum ada course yang dibuat.</p>
            @endif
            <div style="display: flex; gap: 20px; overflow-x: auto; padding: 20px;">
                @foreach ($courses->where('instructor_id', Auth::user()->id) as $course)
                <div class="course-card" data-level="{{ $course->level }}" style="background-color: #f3f3f3; border: 1px solid #ccc; border-radius: 12px; padding: 12px; width: 240px;  min-width: 240px; flex-shrink: 0; position: relative;">
                    {{-- Gambar Preview --}}
                    <div style="position: relative; border-radius: 10px; overflow: hidden;">
                        <img
                            src="{{ asset('Resources/' . $course->image) }}"
                            alt="{{ $course->title }}"
                            style="width: 100%; height: 140px; object-fit: cover;">

                        {{-- Overlay info soal & menit --}}
                        <div style="position: absolute; top: 8px; left: 8px; background-color: rgba(255, 255, 255, 0.85); border-radius: 6px; padding: 3px 8px; font-size: 11px; font-weight: 500;">
                            {{ $course->session }} 1 Sesi | {{ $course->duration }} 60 Menit
                        </div>
                    </div>
                    {{-- Informasi Mata Pelajaran --}}
                    <div style="display: flex; align-items: center; gap: 8px; margin-top: 10px;">
                        <div style="width: 12px; height: 12px; background-color: #ddd; border-radius: 50%;"></div>
                        <span style="font-size: 14px; color: #555;">{{ $course->subject }}</span>
                    </div>

                    {{-- Judul dan Topik --}}
                    <div style="margin-top: 8px;">
                        <strong style="display: block; font-size: 16px; margin-bottom: 4px;">{{ $course->title }}</strong>
                        <ul style="font-size: 13px; color: #444;">
                            @foreach (json_decode($course->topics, true) as $topic)
                            <li>{{ $topic }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection