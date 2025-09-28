<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Business Partners Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h2>Business Partners Report</h2>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Region</th>
                <th>State</th>
                <th>City</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $bp)
                <tr>
                    <td>{{ $bp->name }}</td>
                    <td>{{ $bp->email }}</td>
                    <td>{{ $bp->country->country_name ?? '' }}</td>
                    <td>{{ $bp->state->state_title ?? '' }}</td>
                    <td>{{ $bp->city->name ?? '' }}</td>
                    <td>{{ $bp->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td>{{ $bp->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
