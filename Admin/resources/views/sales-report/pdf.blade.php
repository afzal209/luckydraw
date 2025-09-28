<h2>Sales Report</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>Sl. No</th>
            <th>Luckydraw Name</th>
            <th>Tickets Sold</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sales as $index => $sale)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $sale->luckydraw->luckydraw_name ?? '' }}</td>
                <td>{{ $sale->tickets_sold }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h4>Total Tickets Sold: {{ $totalTickets }}</h4>
