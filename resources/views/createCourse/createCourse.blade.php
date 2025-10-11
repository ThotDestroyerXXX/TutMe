@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/homepage/style.css') }}">
<script src="{{ asset('script/homepage/script.js') }}"></script>

@section('content')
<div class="homepage" style="max-width: 80rem; margin: 2rem auto;">
    <div class="content" style="display: flex; gap: 3rem; justify-content: space-between;">
        {{-- ========== PREVIEW CARD ========== --}}
        <div class="preview-wrapper" style="flex: 1; display: flex; justify-content: center; align-items: center;">
            <div class="course-card" style="background-color: #f3f3f3; border: 1px solid #ccc; border-radius: 12px; padding: 12px; width: 240px; min-width: 240px; position: relative;">
                {{-- Gambar Preview --}}
                <div style="position: relative; border-radius: 10px; overflow: hidden;">
                    <img id="subjectImage" src="{{ asset('Resources/') }}"
                        style="width: 100%; height: 140px; object-fit: cover;">

                    {{-- Overlay info soal & menit --}}
                    <div id="previewSession" style="position: absolute; top: 8px; left: 8px; background-color: rgba(255, 255, 255, 0.85); border-radius: 6px; padding: 3px 8px; font-size: 11px; font-weight: 500;">
                        Sesi / Menit
                    </div>
                </div>

                {{-- Informasi Mata Pelajaran --}}
                <div style="display: flex; align-items: center; gap: 8px; margin-top: 10px;">
                    <div style="width: 12px; height: 12px; background-color: #ddd; border-radius: 50%;"></div>
                    <span id="previewSubject" style="font-size: 14px; color: #555;">Subject</span>
                </div>

                {{-- Judul dan Topik --}}
                <div style="margin-top: 8px;">
                    <strong id="previewTitle" style="display: block; font-size: 16px; margin-bottom: 4px;">Title</strong>
                    <ul id="previewTopics" style="font-size: 13px; color: #444;">
                        <li>Topic 1</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- ========== FORM INPUT ========== --}}
        <div class="form-wrapper" style="flex: 1; display: flex; justify-content: flex-end;">
            <form style="width: 100%;" action="{{ route('courses.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Course Subject</label><br>
                    <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                        @foreach(['Matematika', 'Bahasa Inggris', 'Ilmu Pengetahuan Alam', 'Fisika'] as $subject)
                        <button type="button" class="btn btn-outline-secondary subject-btn" style="width: fit-content;"
                            data-subject="{{ $subject }}">{{ $subject }}</button>
                        @endforeach

                        <input type="hidden" name="subject" id="subjectInput">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Course Title</label>
                    <input type="text" name="title" id="titleInput" class="form-control" placeholder="Enter course title">
                </div>

                <div class="mb-3">
                    <label>Course Topics (Max 4)</label>
                    <div id="topicsContainer">
                        <input type="text" name="topics[]" class="form-control topicInput" placeholder="Enter topic 1" style="margin-bottom: 0.5rem;">
                    </div>
                    <div style="display: flex; gap: 1rem;">
                        <button type="button" id="addTopic" class="btn btn-sm btn-light" style="width: 5rem;">+</button>
                        <button type="button" id="removeTopic" class="btn btn-sm btn-light" style="width: 5rem;">-</button>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Session</label><br>
                    <div style="display: flex; gap: 0.5rem; width: fit-content;">
                        <button type="button" class="btn btn-outline-secondary session-btn" data-session="1">1</button>
                        <button type="button" class="btn btn-outline-secondary session-btn" data-session="2">2</button>
                    </div>
                    <input type="hidden" name="session" id="sessionInput">
                </div>

                <div class="mb-3">
                    <label>Level (Kelas)</label><br>
                    <div style="display: flex; gap: 0.5rem; width: fit-content;">
                        <button type="button" class="btn btn-outline-secondary level-btn" data-level="7">7</button>
                        <button type="button" class="btn btn-outline-secondary level-btn" data-level="8">8</button>
                    </div>
                    <input type="hidden" name="level" id="levelInput">
                </div>

                <button type="submit" class="btn btn-primary mt-2" style="width: 10rem;">Submit</button>
            </form>
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

{{-- SCRIPT --}}
<script>
    const subjectButtons = document.querySelectorAll('.subject-btn');
    const subjectImage = document.getElementById('subjectImage');
    const previewSubject = document.getElementById('previewSubject');
    const previewTitle = document.getElementById('previewTitle');
    const previewTopics = document.getElementById('previewTopics');
    const previewSession = document.getElementById('previewSession');
    const titleInput = document.getElementById('titleInput');
    const addTopic = document.getElementById('addTopic');
    const removeTopic = document.getElementById('removeTopic');
    const topicsContainer = document.getElementById('topicsContainer');
    const sessionButtons = document.querySelectorAll('.session-btn');
    const levelButtons = document.querySelectorAll('.level-btn');
    let topicCount = 1;

    function setActiveButton(group, clickedButton) {
        group.forEach(btn => btn.classList.remove('btn-active'));
        clickedButton.classList.add('btn-active');
    }

    subjectButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const subject = btn.dataset.subject;
            previewSubject.innerText = subject;
            subjectImage.src = `/Resources/${subject.toLowerCase()}.png`;
            setActiveButton(subjectButtons, btn);
        });
    });

    titleInput.addEventListener('input', () => {
        previewTitle.innerText = titleInput.value || 'Title';
    });

    topicsContainer.addEventListener('input', () => {
        previewTopics.innerHTML = '';
        document.querySelectorAll('.topicInput').forEach(input => {
            if (input.value.trim() !== '') {
                const li = document.createElement('li');
                li.textContent = input.value;
                previewTopics.appendChild(li);
            }
        });
    });

    addTopic.addEventListener('click', () => {
        if (topicCount < 4) {
            topicCount++;
            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'topics[]';
            input.classList.add('form-control', 'topicInput');
            input.placeholder = `Enter topic ${topicCount}`;
            input.style.marginBottom = '0.5rem';
            topicsContainer.appendChild(input);
        }
    });

    removeTopic.addEventListener('click', () => {
        if (topicCount > 1) {
            topicsContainer.removeChild(topicsContainer.lastElementChild);
            topicCount--;

            previewTopics.innerHTML = '';
            document.querySelectorAll('.topicInput').forEach(input => {
                if (input.value.trim() !== '') {
                    const li = document.createElement('li');
                    li.textContent = input.value;
                    previewTopics.appendChild(li);
                }
            });
        }
    });

    sessionButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const session = btn.dataset.session;
            previewSession.innerText = `${session} Sesi / ${60*session} Menit`;
            setActiveButton(sessionButtons, btn);
        });
    });

    levelButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            setActiveButton(levelButtons, btn);
        });
    });

    subjectButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('subjectInput').value = btn.dataset.subject;
        });
    });

    sessionButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('sessionInput').value = btn.dataset.session;
        });
    });

    levelButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('levelInput').value = btn.dataset.level;
        });
    });
</script>
@endsection