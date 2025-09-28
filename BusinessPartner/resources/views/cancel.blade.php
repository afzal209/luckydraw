<!DOCTYPE html>
<html>
<head>
    <title>Payment Cancelled</title>
</head>
<body>
    <h1>Payment Cancelled</h1>
    <p style="color: red;">{{ session('error') }}</p>
    <a href="{{ route('payment.pay') }}">Try Again</a>
</body>
</html>