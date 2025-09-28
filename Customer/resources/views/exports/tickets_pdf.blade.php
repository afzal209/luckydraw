<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Download My Tickets</title>
        <style>
            body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
            th { background: #f0f0f0; }
        </style>
    </head>
    <body>
        <h2>My Purchased Tickets</h2>
        <table>
            <thead>
                <tr>
                    <th>Business Partner</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Ticket ID</th>
                    <th>Lucky Draw</th>
                    <th>Draw Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $sale)
                <tr>
                    <td>{{ $sale->business_name }}</td>
                    <td>{{ $sale->poc_mobile }}</td>
                    <td>{{ $sale->poc_email }}</td>
                    <td>{{ $sale->address_line_1 }} {{ $sale->address_line_2 }}</td>
                    <td>{{ $sale->ticket_id }}</td>
                    <td>{{ $sale->luckydraw_name }}</td>
                    <td>{{ $sale->draw_date }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>