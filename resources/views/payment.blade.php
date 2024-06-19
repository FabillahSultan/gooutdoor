<!DOCTYPE html>
<html>

<head>
    <title>Pembayaran</title>
</head>

<body>
    <h1>Proses Pembayaran</h1>
    <button id="pay-button">Bayar</button>

    <form action="{{ route('payment.callback') }}" id="submit_form" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="json" id="json_callback">
    </form>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    send_response_to_form(result);
                    console.log(result)
                },
                onPending: function(result) {
                    send_response_to_form(result);
                },
                onError: function(result) {
                    send_response_to_form(result);
                },
                onClose: function() {
                    alert('You closed the popup without finishing the payment');
                }
            });
        };

        function send_response_to_form(result) {
            document.getElementById('json_callback').value = JSON.stringify(result);
            document.getElementById('submit_form').submit();
        }
    </script>
</body>

</html>
