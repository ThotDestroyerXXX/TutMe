@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/homepage/style.css') }}">
<script src="{{ asset('script/homepage/script.js') }}"></script>

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <div class="homepage" style="max-width: 80rem; margin: 2rem auto;">
        <div class="content">
            <div class="title">
                <h3>Hi, {{ optional(Auth::user())->name ?? 'Tutee' }}!</h3>
            </div>
            <div class="py-5" style="display: flex;">
                <div class="col-4">
                    <h2>Budget Summary</h2>
                    <div class="col-4" style="margin: 3rem 0;">
                        <div class="col-md-6" style="width: 250px; height: 250px;">
                            <canvas id="donationChart"></canvas>
                        </div>
                    </div>
                    <h2>Total Donation</h2>
                    <p class="mt-3 mb-0">
                        <strong>Total:</strong> {{ $formattedTotal }} <br>
                        <strong>Terpakai:</strong> {{ $formattedUsed }} <br>
                        <strong>{{ round($percentage, 2) }}%</strong> dari total dana
                    </p>
                </div>
                <div class="d-flex flex-column gap-3">
                    <div>
                        <form id="donationForm" action="{{ route('transaction.donate') }}" method="POST">
                            @csrf
                            <h4>Donasi Sekarang</h4>
                            <div class="mb-3">
                                <label for="amount" class="form-label">Jumlah Donasi (Rp)</label>
                                <input type="number" class="form-control" id="amount" name="amount" required
                                    min="1000" step="1000" placeholder="Masukkan nominal">
                            </div>
                            <button type="submit" class="btn btn-primary">Donasi</button>
                        </form>
                    </div>
                    <div>
                        <form id="exportTransactionForm" action="{{ route('transactions.export') }}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-primary">Export Transaksi</button>
                        </form>
                        <form id="exportTransactionPointForm" action="{{ route('transactionPoints.export') }}"
                            method="GET">
                            @csrf
                            <button type="submit" class="btn btn-primary">Export Transaction Points</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const total = {{ $donation }};
        const used = {{ $usedPoint }};
        const remaining = total - used;
        const percentage = total > 0 ? (used / total) * 100 : 0;

        const ctx = document.getElementById('donationChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Terpakai', 'Tersisa'],
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
                    const {
                        ctx,
                        width,
                        height
                    } = chart;
                    ctx.save();
                    const text = percentage.toFixed(2) + '%';
                    ctx.font = 'bold 18px sans-serif';
                    ctx.fillStyle = '#333';
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.fillText(text, width / 2, height / 2);
                }
            }]
        });
    </script>
@endsection
