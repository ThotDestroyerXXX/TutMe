@extends('layouts.app')

@section('content')
<div class="homepage" style="max-width: 80rem; margin: 2rem auto;">
    <a href="{{ '/' }}">
        <button type="button"
            class="btn btn-primary mt-2 rounded-5"
            style="width: 3rem; background-color: gray; border-color: gray;">
            <
        </button>
    </a>
    <div class="content" style="display: flex; gap: 3rem; justify-content: space-between;">
        <form id="enrollCourse-{{ $data->id }}"
            action="{{ route('enrollCourse', ['idCourse' => $data->id, 'idUser' => Auth::id()]) }}"
            method="POST"
            style="margin-top: 1rem;">
            @csrf

            <div class="availableDay">
                Mentor only available on <br>
                <div style="display: flex;">
                    @foreach (json_decode($data->day, true) as $days)
                        <h5>|{{ $days }}</h5>&nbsp;&nbsp;
                    @endforeach
                </div>
            </div>
            <br>
            <div class="mb-3" style="width: 200px;">
                <label>Select Date</label>
                <input type="date" name="date" id="date" class="form-control" min="<?= date('Y-m-d'); ?>">
            </div>

            <div class="mb-3">
                <div style="display: flex;">
                    <div class="startTime">
                        <label>Start Time</label>
                        <input type="time" name="timeInput" id="timeInput" style="width: fit-content;" class="form-control" placeholder="Enter course title" value="{{ $data->start_time }}" disabled>
                    </div>
                </div>
            </div>

            <button class="button btn btn-primary" type="button"
                data-bs-toggle="modal" data-bs-target="#modalDelete"
                id={{ $data->id }} disabled>
                <span class="button__text">Enroll</span>
                <span class="button__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                        <path d="M480-120 200-272v-240L40-600l440-240 440 240v320h-80v-276l-80 44v240L480-120Zm0-332 274-148-274-148-274 148 274 148Zm0 241 200-108v-151L480-360 280-470v151l200 108Zm0-241Zm0 90Zm0 0Z" />
                    </svg>
                </span>
            </button>
            <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="display: flex;">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalDeleteLabel">Enroll {{ $data->title }}?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure to select this course?<br>
                            We will infrom the Mentor to accept your request
                        </div>
                        <div class="modal-footer" style="display: block;">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="width: 48%;">Cancel</button>
                            <button type="submit" class="btn btn-primary" style="width: 48%; float: right;">Enroll</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    .button {
        position: relative;
        width: 150px;
        height: 40px;
        cursor: pointer;
        display: flex;
        align-items: center;
        /* border: 1px solid #17795E;
        background-color: #209978; */
        overflow: hidden;
    }

    .button,
    .button__icon,
    .button__text {
        transition: all 0.3s;
    }

    .button .button__text {
        color: #fff;
        font-weight: 600;
    }

    .button .button__icon {
        position: absolute;
        transform: translateX(109px);
        height: 100%;
        width: 39px;
        /* background-color: #17795E; */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .button .svg {
        width: 20px;
        fill: #fff;
    }

    /* 
    .button:hover {
        background: #17795E;
    } */

    .button:hover .button__text {
        color: transparent;
    }

    .button:hover .button__icon {
        width: 148px;
        transform: translateX(0);
    }

    /* 
    .button:active .button__icon {
        background-color: #146c54;
    }

    .button:active {
        border: 1px solid #146c54;
    } */
</style>

<script>
    let data = {!! json_encode($data->toArray()) !!};
    allowedDays = JSON.parse(data.day);
    const inputDate = document.getElementById("date");

    inputDate.addEventListener("change", function () {
        const chosenDate = new Date(this.value).getDay();;
        const dayNames = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
        
        const isValidDay = allowedDays.some(day => day === dayNames[chosenDate]);
        console.log(allowedDays.some(day => day === dayNames[chosenDate]));
        if (isValidDay) {
            document.getElementById(data.id).removeAttribute('disabled');
        } else {
            document.getElementById(data.id).disabled = true;
        }
    });
</script>

@endsection