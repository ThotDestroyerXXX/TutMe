@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/homepage/style.css') }}">
<script src="{{ asset('script/homepage/script.js') }}"></script>

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <div class="container py-5">
        <div class="row mb-4 align-items-center">
            <div class="col-md-8">
                <h3 class="mb-0">{{ __('messages.hi') }}, {{ optional(Auth::user())->name ?? 'Friend' }}!</h3>
                <p class="text-muted">{{ __('messages.budget_overview') ?? __('messages.budget_summary') }}</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <h4 class="card-title fs-4">{{ __('messages.budget_summary') }}</h4>
                        <div class="d-flex gap-4 align-items-center my-3">
                            <div style="width:220px; height:220px;">
                                <canvas id="donationChart" width="220" height="220"></canvas>
                            </div>
                            <div>
                                <p class="mb-1 fs-5"><strong>{{ __('messages.total') }}:</strong>
                                    {{ $formattedTotal ?? 'Rp 0' }}</p>
                                <p class="mb-1"><strong>{{ __('messages.used') }}:</strong> {{ $formattedUsed ?? 'Rp 0' }}
                                </p>
                                <p class="mb-1"><strong>{{ __('messages.remaining') }}:</strong>
                                    {{ number_format(($donation ?? 0) - ($usedPoint ?? 0), 0, ',', '.') }}</p>
                                <div class="progress mt-3" style="height:14px; border-radius:8px; overflow:hidden;">
                                    <div class="progress-bar bg-primary" role="progressbar"
                                        style="width: {{ round($percentage ?? 0, 2) }}%"
                                        aria-valuenow="{{ round($percentage ?? 0, 2) }}" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                <small class="text-muted d-block mt-2">{{ round($percentage ?? 0, 2) }}%
                                    {{ __('messages.of_total_funds') }}</small>
                            </div>
                        </div>
                        <div class="mt-auto">
                            <p class="small text-muted mb-0">
                                {{ __('messages.donation_insight') ?? 'Funds are used for supporting learners.' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ __('messages.donate_now') }}</h5>
                        <form id="donationForm" action="{{ route('transaction.donate') }}" method="POST" class="mt-3"
                            novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="amount" class="form-label">{{ __('messages.donation_amount') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" id="amount" name="amount" required
                                        min="1000" step="1000" placeholder="{{ __('messages.enter_amount') }}">
                                    @error('amount')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-2 d-flex gap-2 flex-wrap">
                                    <button type="button" class="btn btn-sm btn-outline-secondary quick-amount"
                                        data-amount="50000">50k</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary quick-amount"
                                        data-amount="100000">100k</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary quick-amount"
                                        data-amount="250000">250k</button>
                                </div>
                            </div>
                            <div class="d-flex gap-2 align-items-center">
                                <button type="submit" class="btn btn-primary">{{ __('messages.donate') }}</button>
                            </div>
                        </form>

                        <div class="mt-2 d-flex gap-2 justify-content-center flex-wrap">
                            @if (Route::has('transactions.export'))
                                <a href="{{ route('transactions.export') }}"
                                    class="btn btn-sm btn-outline-primary">{{ __('messages.export_transactions') }}</a>
                            @endif
                            @if (Route::has('transactionPoints.export'))
                                <a href="{{ route('transactionPoints.export') }}"
                                    class="btn btn-sm btn-outline-primary">{{ __('messages.export_transaction_points') }}</a>
                            @endif
                        </div>

                        <div class="mt-4">
                            <h6 class="mb-2">{{ __('messages.recent_transactions') }}</h6>
                            @if (empty($transactions) || $transactions->isEmpty())
                                <p class="text-muted">{{ __('messages.no_transactions_yet') }}</p>
                            @else
                                <ul class="list-group list-group-flush">
                                    @foreach ($transactions->take(5) as $tx)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <div class="fw-medium">{{ $tx->description ?? __('messages.donation') }}
                                                </div>
                                                <small
                                                    class="text-muted">{{ optional($tx->transaction_date)->diffForHumans() ?? '' }}</small>
                                            </div>
                                            <div class="text-end">
                                                <div class="fw-semibold">{{ number_format($tx->amount, 0, ',', '.') }}
                                                </div>
                                                <small class="text-muted">{{ $tx->status ?? '' }}</small>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const total = {{ $donation ?? 0 }};
        const used = {{ $usedPoint ?? 0 }};
        const remaining = total - used;
        const percentage = total > 0 ? (used / total) * 100 : 0;

        const ctx = document.getElementById('donationChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['{{ __('messages.used') }}', '{{ __('messages.remaining') }}'],
                datasets: [{
                    data: [used, remaining],
                    backgroundColor: ['#007bff', '#6aff7eff'],
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let value = context.parsed;
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    }
                }
            },
            plugins: [{
                id: 'textCenter',
                beforeDraw: (chart) => {
                    const ctx = chart.ctx;
                    ctx.save();
                    const text = percentage.toFixed(2) + '%';
                    ctx.font = 'bold 26px sans-serif';
                    ctx.fillStyle = '#333';
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    let centerX = chart.width / 2;
                    let centerY = chart.height / 2;
                    if (chart.chartArea) {
                        const {
                            left,
                            right,
                            top,
                            bottom
                        } = chart.chartArea;
                        centerX = (left + right) / 2;
                        centerY = (top + bottom) / 2;
                    }

                    ctx.fillText(text, centerX, centerY);
                    ctx.restore();
                }
            }]
        });
    </script>

    <script>
        // quick amount buttons
        document.querySelectorAll('.quick-amount').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const amount = e.currentTarget.getAttribute('data-amount');
                const input = document.getElementById('amount');
                if (input) input.value = amount;
            });
        });
    </script>
@endsection
