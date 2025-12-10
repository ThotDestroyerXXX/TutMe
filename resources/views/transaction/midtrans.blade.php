@extends('layouts.app')

@section('content')
    <div class="container text-center" style="margin-top: 100px;">
        <h3>{{ __('messages.processing_donation') }}</h3>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script>
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                const url =
                    `/transactions/store?order_id=${result.order_id}&amount=${result.gross_amount}&status=${result.transaction_status}`;
                window.location.href = url;
            },

            onPending: function(result) {
                alert("{{ __('messages.payment_pending') }}");
                console.log(result);
            },

            onError: function(result) {
                alert("{{ __('messages.payment_failed') }}");
                console.log(result);
            }
        });
    </script>
@endsection
<!--
    VISA    : 4811 1111 1111 1114
    EXP     : 12/25
    CVV     : 123
    PASS    : 112233
-->
