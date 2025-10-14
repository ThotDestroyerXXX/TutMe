<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Midtrans Payment</title>
    <!-- PENTING: gunakan client-key kamu -->
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>
<body>
    <h2>Pembayaran Midtrans</h2>

    <button id="pay-button">Bayar Sekarang</button>

    <script type="text/javascript">
        document.getElementById('pay-button').addEventListener('click', function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    console.log('Success:', result);
                    alert('Pembayaran sukses!');
                    window.location.href = '/'; // redirect kalau mau
                },
                onPending: function(result){
                    console.log('Pending:', result);
                    alert('Menunggu pembayaran!');
                },
                onError: function(result){
                    console.error('Error:', result);
                    alert('Pembayaran gagal!');
                },
                onClose: function(){
                    alert('Kamu menutup popup tanpa menyelesaikan pembayaran.');
                }
            });
        });
    </script>
</body>
</html>
