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
        <a href="{{ route('acceptEnrollment', ['id' => $enrollment->id, 'bool' => 'false']) }}" class="btn btn-primary bg-white border border-primary rounded-3 ms-2 text-decoration: none;" style="color: #363636ff;">
            reject
        </a>
        @else
        <a href="{{ $course->meet_link }}" target="_blank">{{ $course->meet_link }}</a>
        <br><br>
        <div style="border: 2px solid #ddd; padding: 20px; background-color: #f9f9f9; border-radius: 8px;">
            <h5>Upload Video Mentoring</h5>
            <form id="videoForm">
                <input type="file" id="videoInput" accept=".mp4,video/mp4" class="form-control" style="margin: 10px 0;">
                <small id="fileInfo" style="color: #666;"></small>
                <button type="button" id="uploadBtn" class="btn btn-primary" style="margin-top: 10px; width: 100%;" disabled>Upload Video</button>
            </form>
        </div>
        @php
            $today = strtotime(date('Y-m-d')); 
            $enrollDate = strtotime($enrollment->date);
        @endphp
        @if ($today > $enrollDate && $enrollment->status !== 'DONE')
            <br><br><br>
            <a disabled aria-disabled="true" href="{{ route('finishMentoring', ['id' => $enrollment->id, 'userId' => $course->instructor_id]) }}">
                <button disabled type="submit" class="btn btn-primary bg-white border border-primary rounded-3 ms-2 text-decoration: none;" style="color: #363636ff;">
                    Finish Mentoring
                </button>
            </a>
        @endif
        @endif
        @endif
    </div>
</div>
@endsection

<script>
    const videoInput = document.getElementById('videoInput');
    const uploadBtn = document.getElementById('uploadBtn');
    const fileInfo = document.getElementById('fileInfo');
    const videoForm = document.getElementById('videoForm');

    videoInput.addEventListener('change', function() {
        if (this.files.length > 0) {
            uploadBtn.disabled = false;
            fileInfo.textContent = `File: ${this.files[0].name} (${(this.files[0].size / 1024 / 1024).toFixed(2)} MB)`;
        } else {
            uploadBtn.disabled = true;
            fileInfo.textContent = '';
        }
    });

    uploadBtn.addEventListener('click', function(e) {
        e.preventDefault();
        if (videoInput.files.length === 0) {
            alert('Pilih file terlebih dahulu');
            return false;
        }
        // Implementasi upload di sini
        console.log('Upload:', videoInput.files[0].name);
    });

    videoForm.addEventListener('submit', function(e) {
        e.preventDefault();
    });
</script>
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
