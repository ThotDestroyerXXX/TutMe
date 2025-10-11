@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/homepage/style.css') }}">
<script src="{{ asset('script/homepage/script.js') }}"></script>

@section('content')
<div class="homepage" style="max-width: 80rem; margin: 2rem auto;">
    <div class="content">
        <div class="title">
            <h3>Hi, {{ optional(Auth::user())->name ?? 'Tutee' }}!</h3>
            <h6>Mau belajar apa hari ini?</h6>
        </div>
        <div class="inputGroup mb-3">
            <input type="text" class="form-control" placeholder="Search" id="Search">
            <button type="button" class="btn btn-primary modalBtn" data-bs-toggle="modal" data-bs-target="#myModal" id="modalLevel">Level All</button>
            <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Select Level</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <button type="button" class="btn btn-secondary col-md-6" onclick="selectLevel('7')" data-bs-dismiss="modal">Kelas 7</button>
                                    <button type="button" class="btn btn-secondary col-md-6 ms-auto" data-bs-dismiss="modal" onclick="selectLevel('8')">Kelas 8</button>
                                </div>
                                <div class="row">
                                    <button type="button" class="btn btn-secondary col-md-6" data-bs-dismiss="modal" onclick="selectLevel('9')">Kelas 9</button>
                                    <button type="button" class="btn btn-secondary col-md-6 ms-auto" data-bs-dismiss="modal" onclick="selectLevel('10')">Kelas 10</button>
                                </div>
                                <div class="row">
                                    <button type="button" class="btn btn-secondary col-md-6" data-bs-dismiss="modal" onclick="selectLevel('11')">Kelas 11</button>
                                    <button type="button" class="btn btn-secondary col-md-6 ms-auto" data-bs-dismiss="modal" onclick="selectLevel('12')">Kelas 12</button>
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
                    <button style="background-color: white;" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button style="background-color: white;" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button style="background-color: white;" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('Resources/slide1.png') }}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <!-- <h5>First slide label</h5>
                                <p>Some representative placeholder content for the first slide.</p> -->
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('Resources/slide2.png') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('Resources/slide3.png') }}" class="d-block w-100" alt="...">
                    </div>
                </div>
            </div>
        </div>
        @if (Auth::user() != null)
        <div class="enrollmentHistory" style="margin-top: 3rem;">
            <div class="historyTitle" style="display: flex;">
                <h6>History</h6>&nbsp;&nbsp;&nbsp;&nbsp;
                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#000000ff">
                    <path d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                </svg>
            </div>
            <div class="courseList">
                @if ($courses->isEmpty())
                <p style="text-align:center;">Belum ada course yang tersedia.</p>
                @endif
                <div style="display: flex; gap: 20px; overflow-x: auto; padding: 20px;">
                    @foreach ($courses as $course)
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
        @endif
        <div class="newEnrollment" style="margin-top: 3rem;">
            <div class="enrollTitle" style="display: flex;">
                <h6>New Enrollment</h6>&nbsp;&nbsp;&nbsp;&nbsp;
                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#000000ff">
                    <path d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                </svg>
            </div>
            <div class="courseList">
                @if ($courses->isEmpty())
                <p style="text-align:center;">Belum ada course yang tersedia.</p>
                @endif
                <div style="display: flex; gap: 20px; overflow-x: auto; padding: 20px;">
                    @foreach ($courses as $course)
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
</div>

<script>
    function selectLevel(level) {
        document.querySelectorAll('.course-card').forEach(card => {
            card.style.display = card.dataset.level === level ? 'block' : 'none';
        });
        document.getElementById('modalLevel').innerText = 'Kelas ' + level;
    }
</script>
@endsection