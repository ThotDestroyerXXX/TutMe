@extends('layouts.app')

@section('content')
<div class="homepage" style="max-width: 80rem; margin: 2rem auto;">
    <div class="content" style="display: flex; gap: 3rem; justify-content: space-between;">
        <div class="preview-wrapper" style="flex: 1; display: flex; justify-content: center; align-items: center;">
            <div class="course-card" style="background-color: #f3f3f3; border: 1px solid #ccc; border-radius: 12px; padding: 12px; width: 240px; min-width: 240px; position: relative;">
                <h4 style="position: relative;">Preview</h4>
                <div style="position: relative; border-radius: 10px; overflow: hidden;">
                    <img id="subjectImage" src="{{ isset($course) ? asset('Resources/' . $course->image) : asset('Resources/') }}"
                        style="width: 100%; height: 140px; object-fit: cover;">

                    <div id="previewSession" style="position: absolute; top: 8px; left: 8px; background-color: rgba(255, 255, 255, 0.85); border-radius: 6px; padding: 3px 8px; font-size: 11px; font-weight: 500;">
                        {{ isset($course) ? $course->session . ' Sesi / ' . $course->session*60 . ' Menit' : 'Sesi / Menit' }}
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 8px; margin-top: 10px;">
                    <div style="width:12px; height:12px; border-radius:50%; background-color: #ddd;
                                @if($course)
                                    @if($course->is_active)
                                        background-color: #00ff6aff;
                                    @endif
                                @endif
                                ">
                    </div>
                    <span id="previewSubject" style="font-size: 14px; color: #555;">{{ isset($course) ? $course->subject : 'Subject' }}</span>
                </div>

                <div style="margin-top: 8px;">
                    <strong id="previewTitle" style="display: block; font-size: 16px; margin-bottom: 4px;">{{ isset($course) ? $course->title : 'Title' }}</strong>
                    <ul id="previewTopics" style="font-size: 13px; color: #444;">
                        @if ($course)
                        @foreach ($course->topics as $topic)
                        <li>{{$topic}}</li>
                        @endforeach
                        @else
                        <li>Topic 1</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <div class="form-wrapper" style="flex: 1; display: flex; justify-content: flex-end;">
            <form action="{{ isset($course) ? route('courses.update', $course->id) : route('courses.store') }}" method="POST" style="width: 100%;">
                @csrf
                @if(isset($course))
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label>Course Subject</label><br>
                    <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                        @foreach(['Matematika', 'Bahasa Inggris', 'Biologi', 'Fisika', 'Ilmu Pengetahuan Sosial', 'Informatika', 'Bahasa Indonesia'] as $subject)
                        <button type="button" class="btn btn-outline-secondary subject-btn {{ isset($course) && $course->subject === $subject ? 'btn-active' : '' }}" style="width: fit-content;"
                            data-subject="{{ $subject }}" {{ isset($course) && $course->subject !== $subject ? 'disabled' : '' }}>{{ $subject }}</button>
                        @endforeach

                        <input type="hidden" name="subject" id="subjectInput">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Course Title</label>
                    <input type="text" name="title" id="titleInput" class="form-control" placeholder="Enter course title" value="{{ $course->title ?? '' }}" {{ isset($course->id) ? 'disabled' : '' }}>
                </div>

                <div class="mb-3">
                    <label>Course Topics (Max 4)</label>
                    <div id="topicsContainer">
                        @if($course != null)
                        @foreach ($course->topics as $topic)
                        <input type="text" name="topics[]" class="form-control topicInput" style="margin-bottom: 0.5rem;" value="{{ $topic ?? '' }}" disabled>
                        @endforeach
                        @else
                        <input type="text" name="topics[]" class="form-control topicInput" placeholder="Enter topic 1" style="margin-bottom: 0.5rem;">
                        @endif
                    </div>
                    <div style="display: flex; gap: 1rem;">
                        @if ($course == null)
                        <button type="button" id="addTopic" class="btn btn-sm btn-light" style="width: 5rem;">+</button>
                        <button type="button" id="removeTopic" class="btn btn-sm btn-light" style="width: 5rem;">-</button>
                        @endif
                    </div>
                </div>

                <div class="mb-3">
                    <label>Session</label><br>
                    <div style="display: flex; gap: 0.5rem; width: fit-content;">
                        @foreach([1, 2] as $session)
                        <button type="button" class="btn btn-outline-secondary session-btn {{ isset($course) && $course->session === $session ? 'btn-active' : '' }}"
                            data-session="{{ $session }}" {{ isset($course) && $course->session !== $session ? 'disabled' : '' }}>{{ $session }}</button>
                        @endforeach
                    </div>
                    <input type="hidden" name="session" id="sessionInput">
                </div>

                <div class="mb-3">
                    <label>Level (Kelas)</label><br>
                    <div style="display: flex; gap: 0.5rem; width: fit-content;">
                        @foreach(['7', '8', '9', '10', '11', '12'] as $level)
                        <button type="button" class="btn btn-outline-secondary level-btn {{ isset($course) && $course->level === $level ? 'btn-active' : '' }}"
                            data-level="{{ $level }}" style="width: fit-content;" {{ isset($course) && $course->level !== $level ? 'disabled' : '' }}>{{ $level }}</button>
                        @endforeach
                    </div>
                    <input type="hidden" name="level" id="levelInput">
                </div>

                @if ($course)
                <div class="form-check mb-3">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="is_active"
                        id="checkChecked"
                        style="cursor: pointer;"
                        {{ $course->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="checkChecked" style="cursor: pointer;">
                        Active
                    </label>
                </div>
                @endif

                <button type="submit" class="btn btn-primary mt-2" style="width: 10rem;">Submit</button>
            </form>
            @if (isset($course))
            <form id="deleteForm-{{ $course->id }}"
                action="{{ route('course.delete', $course->id) }}"
                method="POST"
                style="display: none;">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="btn btn-danger mt-2"
                    style="width: 10rem;"
                    id={{ $course->id }}
                    onclick="deleteBtn(id)">
                    Delete
                </button>
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
</style>

<script src="{{ asset('js/createCourse/script.js') }}"></script>
@endsection