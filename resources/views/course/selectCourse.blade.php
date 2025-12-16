@extends('layouts.app')

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
        .select-wrapper { max-width: 1000px; margin: 2.5rem auto; }
        .select-grid { display: grid; grid-template-columns: 1fr 360px; gap: 1.5rem; align-items: start; }
        .course-card { border-radius: 12px; overflow: hidden; box-shadow: 0 6px 18px rgba(0,0,0,0.06); }
        .course-media { height: 220px; object-fit: cover; width: 100%; display:block; }
        .course-body { padding: 1.25rem; }
        .topic-badge { background:#f1f3f5; padding: 6px 10px; border-radius: 6px; margin-right: 6px; font-size: .85rem; }
        .instructor { display:flex; gap:12px; align-items:center; }
        .form-card { border-radius:12px; padding:1rem; box-shadow: 0 6px 18px rgba(0,0,0,0.04); }
        .muted { color:#6c757d; font-size:.9rem; }
        .days { display:flex; gap:.5rem; flex-wrap:wrap; }
        .day-pill { padding:6px 10px; background:#fff3bf; border-radius:999px; font-size:.85rem; }
        @media (max-width: 768px) { .select-grid { grid-template-columns: 1fr; } }
    </style>

    <div class="select-wrapper">
        <a href="{{ url()->previous() }}" class="text-decoration-none d-inline-flex align-items-center mb-3 back-link">
            <span class="badge bg-light text-dark me-2">&larr; {{ __('messages.back') ?? 'Back' }}</span>
        </a>
        <div class="select-grid">
            <div class="course-card bg-white">
                @php $img = $data->image ?? null; $imgSrc = ($img && strpos($img, 'http') === 0) ? $img : ($img ? asset('Resources/' . $img) : 'https://picsum.photos/800/450'); @endphp
                <img src="{{ $imgSrc }}" class="course-media" alt="{{ $data->title }}">
                <div class="course-body">
                    <h4 class="mb-1">{{ $data->title }}</h4>
                    <div class="muted mb-2">{{ $data->subject }} • {{ $data->session }} {{ __('messages.session') }}</div>

                    <div class="instructor mb-3">
                        <div>
                            @php $instr = $data->instructor; @endphp
                        </div>
                        <div>
                            <div><strong>{{ $instr?->name ?? __('messages.mentor_name') }}</strong></div>
                            <div class="muted">{{ __('messages.level') }}: {{ $data->level }}</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="muted small mb-2">{{ __('messages.course_topics') }}</div>
                        <div>
                            @php
                                $topics = is_string($data->topics) ? (json_decode($data->topics, true) ?? []) : ($data->topics ?? []);
                            @endphp
                            @foreach($topics as $topic)
                                <span class="topic-badge">{{ $topic }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-2">
                        <div class="muted small">{{ __('messages.mentor_available_on') }}</div>
                        <div class="days mt-2">
                            @php
                                $days = is_string($data->day) ? (json_decode($data->day, true) ?? []) : ($data->day ?? []);
                            @endphp
                            @foreach($days as $d)
                                <div class="day-pill">{{ __('messages.' . strtolower($d)) }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-card bg-white">
                <form id="enrollCourse-{{ $data->id }}" action="{{ route('enrollCourse', ['idCourse' => $data->id, 'idUser' => Auth::id()]) }}" method="POST">
                    @csrf
                    <h5 class="mb-3">{{ __('messages.enroll_confirmation') }} {{ $data->title }}</h5>

                    <div class="mb-3">
                        <label class="form-label">{{ __('messages.select_date') }}</label>
                        <input type="date" name="date" id="date" class="form-control" min="{{ date('Y-m-d') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('messages.start_time') }}</label>
                        <input type="text" class="form-control" value="{{ date('H:i', strtotime($data->start_time)) }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('messages.points_spent') }}</label>
                        <div class="fw-bold">{{ ($data->session * 25) ?? 0 }} pts</div>
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-primary" type="button" id="enrollBtn" data-bs-toggle="modal" data-bs-target="#confirmEnroll" disabled>{{ __('messages.enroll') }}</button>
                    </div>

                    <!-- Confirmation Modal -->
                    <div class="modal fade" id="confirmEnroll" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ __('messages.enroll_confirmation') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ __('messages.are_you_sure_select_course') }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                                    <button type="submit" class="btn btn-primary">{{ __('messages.enroll') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const course = {!! json_encode($data->toArray()) !!};
        const rawDays = course.day;
        const allowedDays = Array.isArray(rawDays) ? rawDays : (rawDays ? JSON.parse(rawDays) : []);
        const inputDate = document.getElementById('date');
        const enrollBtn = document.getElementById('enrollBtn');

        function isAllowed(dateStr){
            if(!dateStr) return false;
            const dayNames = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
            const chosen = new Date(dateStr).getDay();
            return allowedDays.includes(dayNames[chosen]);
        }

        inputDate.addEventListener('change', function(){
            if(isAllowed(this.value)) enrollBtn.removeAttribute('disabled');
            else enrollBtn.setAttribute('disabled','');
        });
    </script>
@endsection
