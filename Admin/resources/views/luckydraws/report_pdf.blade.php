<!DOCTYPE html>
<html>
<head>
    <title>Luckydraw Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        th {
            background: #ddd;
        }
        tr:nth-child(even) td {
            background: #f9f9f9;
        }
        .total-row td {
            font-weight: bold;
            background: #eee;
        }
    </style>
</head>
<body>
    <h3>Luckydraw Report</h3>

    <table>
        <thead>
            <tr>
                <th>Luckydraw</th>
                <th>Template</th>
                <th>Sales Count</th>
                <th>Total (Per Luckydraw)</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @foreach($grouped as $ldId => $templates)
                @php 
                    $ld = $luckydraws->firstWhere('id', $ldId);
                    $rowCount = $templates->count();
                    $luckydrawTotal = $templates->sum();
                    $firstRow = true;
                    $grandTotal += $luckydrawTotal;
                @endphp
                @foreach($templates as $tId => $count)
                    @php $template = \App\Models\LuckydrawTemplate::find($tId); @endphp
                    <tr>
                        @if($firstRow)
                            <td rowspan="{{ $rowCount }}">{{ $ld->luckydraw_name }}</td>
                            @php $firstRow = false; @endphp
                        @endif
                        <td>{{ $template->template_name ?? '-' }}</td>
                        <td>{{ $count }}</td>
                        @if($loop->first)
                            <td rowspan="{{ $rowCount }}">{{ $luckydrawTotal }}</td>
                        @endif
                    </tr>
                @endforeach
            @endforeach
            <tr class="total-row">
                <td colspan="3">Grand Total</td>
                <td>{{ $grandTotal }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
