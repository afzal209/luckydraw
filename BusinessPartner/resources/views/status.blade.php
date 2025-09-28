<!DOCTYPE html>
<html>
<head>
    <title>Payment Status</title>
</head>
<body>
    <h1>Payment Status</h1>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @else
        <p style="color: red;">{{ session('error') ?? 'No payment processed.' }}</p>
    @endif
    <a href="{{ route('wallet') }}">Back to Payment</a>
</body>
</html>