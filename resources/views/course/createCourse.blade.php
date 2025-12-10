@extends('layouts.app')

@section('content')
    <div class="homepage" style="max-width: 80rem; margin: 2rem auto;">
        <a href="{{ '/' }}">
            <button type="button" class="btn btn-primary mt-2 rounded-5"
                style="width: 3rem; background-color: gray; border-color: gray;">
                < </button>
        </a>
        <div class="content" style="display: flex; gap: 3rem; justify-content: space-between;">
            <div class="preview-wrapper" style="flex: 1; display: flex; justify-content: center; align-items: center;">
                <div class="course-card"
                    style="background-color: #f3f3f3; border: 1px solid #ccc; border-radius: 12px; padding: 12px; width: 240px; min-width: 240px; position: relative;">
                    <h4 style="position: relative;">{{ __('messages.preview') }}</h4>
                    <div style="position: relative; border-radius: 10px; overflow: hidden;">
                        <img id="subjectImage"
                            src="{{ isset($data) ? asset('Resources/' . $data->image) : asset('Resources/') }}"
                            style="width: 100%; height: 140px; object-fit: cover;">

                        <div id="previewSession"
                            style="position: absolute; top: 8px; left: 8px; background-color: rgba(255, 255, 255, 0.85); border-radius: 6px; padding: 3px 8px; font-size: 11px; font-weight: 500;">
                            {{ isset($data) ? $data->session . ' Sesi / ' . $data->session * 60 . ' Menit' : 'Sesi / Menit' }}
                        </div>
                    </div>

                    <div style="display: flex; align-items: center; gap: 8px; margin-top: 10px;">
                        <div
                            style="width:12px; height:12px; border-radius:50%; background-color: #ddd;
                                @if ($data) @if ($data->is_active)
                                        background-color: #00ff6aff; @endif
                                @endif
                                ">
                        </div>
                        <span id="previewSubject"
                            style="font-size: 14px; color: #555;">{{ isset($data) ? $data->subject : 'Subject' }}</span>
                    </div>

                    <div style="margin-top: 8px;">
                        <strong id="previewTitle"
                            style="display: block; font-size: 16px; margin-bottom: 4px;">{{ isset($data) ? $data->title : 'Title' }}</strong>
                        <ul id="previewTopics" style="font-size: 13px; color: #444;">
                            @if ($data)
                                @foreach (json_decode($data->topics, true) as $topic)
                                    <li>{{ $topic }}</li>
                                @endforeach
                            @else
                                <li>Topic 1</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="form-wrapper" style="flex: 1; display: flex; justify-content: flex-end;">
                <form action="{{ route('saveCourse', $data ? $data->id : null) }}" method="POST" style="width: 100%;">
                    @csrf
                    @if (isset($data))
                        @method('PUT')
                    @endif
                    <div class="mb-3">
                        <label>{{ __('messages.course_subject') }}</label>
                        <p style="color: red; display: inline;">*</p> <br>
                        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                            @foreach (['Matematika', 'Bahasa Inggris', 'Biologi', 'Fisika', 'Ilmu Pengetahuan Sosial', 'Informatika', 'Bahasa Indonesia'] as $subject)
                                <button type="button"
                                    class="btn btn-outline-secondary subject-btn {{ isset($data) && $data->subject === $subject ? 'btn-active' : '' }}"
                                    style="width: fit-content;" data-subject="{{ $subject }}"
                                    {{ isset($data) && $data->subject !== $subject ? 'disabled' : '' }}>{{ $subject }}</button>
                            @endforeach

                            <input type="hidden" name="subject" id="subjectInput">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>{{ __('messages.course_title') }}</label>
                        <p style="color: red; display: inline;">*</p>
                        <input type="text" name="title" id="titleInput" class="form-control"
                            placeholder="{{ __('messages.enter_course_title') }}" value="{{ $data->title ?? '' }}"
                            {{ isset($data->id) ? 'disabled' : '' }}>
                    </div>

                    <div class="mb-3">
                        <label>{{ __('messages.course_topics') }} <p style="color: red; display: inline;">*</p>
                            ({{ __('messages.max_topics') }})</label>
                        <div id="topicsContainer">
                            @if ($data != null)
                                @foreach (json_decode($data->topics, true) as $topic)
                                    <input type="text" name="topics[]" class="form-control topicInput"
                                        style="margin-bottom: 0.5rem;" value="{{ $topic ?? '' }}" disabled>
                                @endforeach
                            @else
                                <input type="text" name="topics[]" class="form-control topicInput"
                                    placeholder="Enter topic 1" style="margin-bottom: 0.5rem;">
                            @endif
                        </div>
                        <div style="display: flex; gap: 1rem;">
                            @if ($data == null)
                                <button type="button" id="addTopic" class="btn btn-sm btn-light"
                                    style="width: 5rem;">+</button>
                                <button type="button" id="removeTopic" class="btn btn-sm btn-light"
                                    style="width: 5rem;">-</button>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>{{ __('messages.session') }}</label>
                        <p style="color: red; display: inline;">*</p> <br>
                        <div style="display: flex; gap: 0.5rem; width: fit-content;">
                            @foreach ([1, 2] as $session)
                                <button type="button"
                                    class="btn btn-outline-secondary session-btn {{ isset($data) && $data->session === $session ? 'btn-active' : '' }}"
                                    data-session="{{ $session }}"
                                    {{ isset($data) && $data->session !== $session ? 'disabled' : '' }}>{{ $session }}</button>
                            @endforeach
                        </div>
                        <input type="hidden" name="session" id="sessionInput">
                    </div>

                    <div class="mb-3">
                        <label>{{ __('messages.level') }}</label>
                        <p style="color: red; display: inline;">*</p> <br>
                        <div style="display: flex; gap: 0.5rem; width: fit-content;">
                            @foreach (['7', '8', '9', '10', '11', '12'] as $level)
                                <button type="button"
                                    class="btn btn-outline-secondary level-btn {{ isset($data) && $data->level === $level ? 'btn-active' : '' }}"
                                    data-level="{{ $level }}" style="width: fit-content;"
                                    {{ isset($data) && $data->level !== $level ? 'disabled' : '' }}>{{ $level }}</button>
                            @endforeach
                        </div>
                        <input type="hidden" name="level" id="levelInput">
                    </div>

                    <div class="mb-3">
                        <label>{{ __('messages.time') }}</label>
                        <p style="color: red; display: inline;">*</p>
                        <input type="time" name="timeInput" id="timeInput" style="width: fit-content;"
                            class="form-control" placeholder="{{ __('messages.enter_course_title') }}"
                            value="{{ $data->start_time ?? '' }}" {{ isset($data->id) ? 'disabled' : '' }}>
                    </div>

                    <div class="mb-3">
                        <label>{{ __('messages.day') }}</label>
                        <p style="color: red; display: inline;">*</p>
                        <div style="display: flex; gap: 0.5rem; width: fit-content;">
                            @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
                                <label
                                    class="btn btn-outline-secondary day-btn {{ isset($data) && in_array($day, json_decode($data->day, true) ?? []) ? 'btn-active locked' : '' }} {{ isset($data) ? 'locked' : '' }}">
                                    <input type="checkbox" name="day[]" value="{{ $day }}"
                                        class="d-none day-checkbox"
                                        {{ isset($data) && in_array($day, json_decode($data->day, true) ?? []) ? 'checked disabled' : '' }}>
                                    {{ __('messages.' . strtolower($day)) }}
                                </label>
                            @endforeach
                        </div>
                    </div>


                    <div class="mb-3">
                        <label>{{ __('messages.meet_link') }}</label>
                        <p style="color: red; display: inline;">*</p><br>
                        @if (isset($data))
                            <a href="{{ $data->meet_link }}" target="_blank">{{ $data->meet_link }}</a>
                        @else
                            <input type="text" name="link" id="link" style="width: fit-content;"
                                class="form-control" placeholder="{{ __('messages.must_contain_https') }}">
                        @endif

                    </div>

                    @if ($data)
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="is_active" id="checkChecked"
                                style="cursor: pointer;" {{ $data->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="checkChecked" style="cursor: pointer;">
                                {{ __('messages.active') }}
                            </label>
                        </div>
                    @endif

                    <button id="createNewCourseBtn" class="btn btn-primary mt-2" style="width: 10rem;"
                        {{ isset($data) ? '' : 'disabled' }}>{{ __('messages.submit') }}</button>
                </form>
                @if (isset($data))
                    <form id="deleteForm-{{ $data->id }}" action="{{ route('course.delete', $data->id) }}"
                        method="POST" style="margin-top: 1rem;">
                        @csrf
                        @method('DELETE')
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modalDelete"
                            class="btn btn-primary mt-2 rounded-5"
                            style="width: 3rem; background-color: red; border-color: red;" id={{ $data->id }}>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                width="24px" fill="#e3e3e3">
                                <path
                                    d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                            </svg>
                        </button>
                        <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content" style="display: flex;">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modalDeleteLabel">Delete {{ $data->title }}?
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="preview-wrapper"
                                            style="flex: 1; display: flex; justify-content: center; align-items: center;">
                                            <div class="course-card"
                                                style="background-color: #f3f3f3; border: 1px solid #ccc; border-radius: 12px; padding: 12px; width: 240px; min-width: 240px; position: relative;">
                                                <div style="position: relative; border-radius: 10px; overflow: hidden;">
                                                    <img id="subjectImage"
                                                        src="{{ isset($data) ? asset('Resources/' . $data->image) : asset('Resources/') }}"
                                                        style="width: 100%; height: 140px; object-fit: cover;">

                                                    <div id="previewSession"
                                                        style="position: absolute; top: 8px; left: 8px; background-color: rgba(255, 255, 255, 0.85); border-radius: 6px; padding: 3px 8px; font-size: 11px; font-weight: 500;">
                                                        {{ isset($data) ? $data->session . ' Sesi / ' . $data->session * 60 . ' Menit' : 'Sesi / Menit' }}
                                                    </div>
                                                </div>

                                                <div
                                                    style="display: flex; align-items: center; gap: 8px; margin-top: 10px;">
                                                    <div
                                                        style="width:12px; height:12px; border-radius:50%; background-color: #ddd;
                                @if ($data) @if ($data->is_active)
                                        background-color: #00ff6aff; @endif
                                @endif
                                ">
                                                    </div>
                                                    <span id="previewSubject"
                                                        style="font-size: 14px; color: #555;">{{ isset($data) ? $data->subject : 'Subject' }}</span>
                                                </div>

                                                <div style="margin-top: 8px;">
                                                    <strong id="previewTitle"
                                                        style="display: block; font-size: 16px; margin-bottom: 4px;">{{ isset($data) ? $data->title : 'Title' }}</strong>
                                                    <ul id="previewTopics" style="font-size: 13px; color: #444;">
                                                        @if ($data)
                                                            @foreach (json_decode($data->topics, true) as $topic)
                                                                <li>{{ $topic }}</li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer" style="display: block;">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                            style="width: 48%;">{{ __('messages.cancel') }}</button>
                                        <button type="submit" class="btn btn-primary"
                                            style="width: 48%; float: right;">{{ __('messages.delete') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    {{-- CSS --}}
    <style>
        .btn-active {
            background-color: #007bff !important;
            color: white !important;
            border-color: #007bff !important;
        }

        .btn-outline-secondary {
            transition: all 0.2s ease;
        }

        .btn-outline-secondary:hover {
            background-color: #e9ecef;
        }

        .day-btn.locked {
            pointer-events: none;
        }
    </style>

    <script src="{{ asset('js/createCourse/script.js') }}"></script>
@endsection
