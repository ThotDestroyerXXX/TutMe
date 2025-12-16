@extends('layouts.app')

@section('content')
    <style>
            .card{ border: none; }
            .auth-card, .card{ border-radius: .75rem; }
            @media (max-width:767px){ .d-flex.align-items-center.justify-content-between.mb-4{ flex-direction: column; gap:.75rem; align-items:flex-start; } }
        </style>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h2 class="h4 mb-0">{{ __('messages.your_points') ?? 'My Points' }}</h2>
                        <p class="text-muted small mb-0">{{ __('messages.points_subtitle') ?? 'Overview of your points' }}</p>
                    </div>
                    <div>
                        @if($userRole === 'Mentor')
                            <a href="#" class="btn btn-outline-primary">{{ __('messages.transfer_points') ?? 'Transfer' }}</a>
                        @endif
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="card shadow-sm rounded-4 h-100">
                            <div class="card-body d-flex flex-column justify-content-center align-items-start">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <div>
                                        <small class="text-muted">{{ __('messages.available_points') ?? 'Available Points' }}</small>
                                        <h3 class="mb-0 mt-1">{{ $availPoint }}</h3>
                                    </div>
                                    <div class="text-primary fs-3">⚡</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="card shadow-sm rounded-4 h-100">
                            <div class="card-body d-flex flex-column justify-content-center align-items-start">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <div>
                                        @if ($userRole === 'Mentor')
                                            <small class="text-muted">{{ __('messages.available_to_transfer') ?? 'Available to Transfer' }}</small>
                                            <h3 class="mb-0 mt-1">{{ $availPoint }}</h3>
                                        @else
                                            <small class="text-muted">{{ __('messages.points_spent') ?? 'Points Spent' }}</small>
                                            <h3 class="mb-0 mt-1">{{ $pointSpent }}</h3>
                                        @endif
                                    </div>
                                    <div class="text-secondary fs-3">🔁</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection