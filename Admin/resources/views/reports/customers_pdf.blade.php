<!DOCTYPE html>
<html>
<head>
    <title>Customer Report</title>
</head>
<body>
    <h2>Customer Report</h2>
    <table border="1" cellpadding="5" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Name</th><th>Email</th><th>Country</th><th>State</th><th>City</th><th>Status</th><th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $c)
                <tr>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->email }}</td>
                    <td>{{ $c->country->country_name ?? '' }}</td>
                    <td>{{ $c->state->state_title ?? '' }}</td>
                    <td>{{ $c->city->name ?? '' }}</td>
                    <td>{{ $c->status }}</td>
                    <td>{{ $c->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
