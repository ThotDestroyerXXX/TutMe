@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/homepage/style.css') }}">
<script src="{{ asset('script/homepage/script.js') }}"></script>

@section('content')
<div class="homepage" style="max-width: 80rem; margin: 2rem auto;">
    <div class="content">
        <div class="title">
            <h3>Hi, {{ optional(Auth::user())->name ?? 'Siapa anda, login dulu!' }}!</h3>
            <h6>Mau apa hari ini?</h6>
        </div>
        <div class="courseList">
            @if ($courses->isEmpty())
            <p style="text-align:center;">Belum ada course yang tersedia.</p>
            @endif
        <div style="display: flex; gap: 20px; overflow-x: auto; padding: 20px;">
                @foreach ($courses->where('instructor_id', '01k779rrr9xc2pjgsdsg4pxqw8') as $course)
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
                                @foreach ($course->topics as $topic)
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