<!DOCTYPE html>
<html>
<head>
    <title>Overall Sales Report PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h2>Overall Sales Report</h2>
    <table>
        <thead>
            <tr>
                <th>Sl.No</th>
                <th>Ticket ID</th>
                <th>Luckydraw Name</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $index => $sale)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $sale->ticket_id }}</td>
                <td>{{ $sale->luckydraw->luckydraw_name }}</td>
                <td>{{ $sale->price }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total Sales Amount</th>
                <th>{{ $totalAmount }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
