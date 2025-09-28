@extends('layout')
@section('title', 'Business Partner Wallet Report')
@section('content')
<ul class="breadcrumb">
    <li><p>Dashboard</p></li>
    <li><a href="{{route('dashboard')}}" class="active">Dashboard</a></li>
    <li><a href="{{route('reports.index') }}" class="active">Reports Manager</a></li>
    <li><a href="#" class="active">Business Partner Wallet Report</a></li>
</ul>
<div class="row-fluid">
    <div class="span12">
        <div class="grid simple">
            <div class="grid-title">
                <h3><i class="fa fa-map-signs"></i> Business Partners Wallet Report Generator Filters</h3>
                <form method="POST" action="{{ route('wallet.report.filter') }}" class="mb-4">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <label>Business Partner</label>
                            <select name="bp_id" class="form-control">
                                <option value="all">All</option>
                                @foreach($partners as $p)
                                    <option value="{{ $p->id }}" {{ ($filters['bp_id'] ?? '') == $p->id ? 'selected' : '' }}>
                                        {{ $p->business_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Start Date</label>
                            <input type="date" name="start_date" class="form-control" value="{{ $filters['start_date'] ?? '' }}">
                        </div>
                        <div class="col-md-3">
                            <label>End Date</label>
                            <input type="date" name="end_date" class="form-control" value="{{ $filters['end_date'] ?? '' }}">
                        </div>
                        <div class="col-md-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="all">All</option>
                                <option value="1" {{ ($filters['status'] ?? '') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ ($filters['status'] ?? '') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-primary w-100"></i> Generate Report</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="grid-body">
                <div class="container">
                  <div class="row">
                    <div class="col-md-6"><h3><i class="fa fa-user-secret"></i> Business Wallet Filtered Data</h3></div>
                    <div class="col-md-6"><span class="pull-right">
                        <a href="{{ route('wallet.report.export.csv', $filters ?? []) }}" class="btn btn-success">Download CSV</a>
                        <a href="{{ route('wallet.report.export.pdf', $filters ?? []) }}" class="btn btn-danger">Download PDF</a>
                    </span></div>
                  </div>
                </div>            
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Business Partner</th>
                            <th>Tx ID</th>
                            <th>Tx Date</th>
                            <th>Amount</th>
                            <th>Tx Type</th>
                            <th>Tx Mode</th>
                            <th>Created At</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $grouped = $wallets->groupBy('bp_id');
                            $grandTotal = 0;
                        @endphp
                        @foreach($grouped as $bpId => $partnerWallets)
                            @php 
                                $partnerName = $partnerWallets->first()->businessPartner->business_name ?? 'Unknown';
                                $rowCount = $partnerWallets->count();
                                $partnerTotal = $partnerWallets->sum('amount');
                                $grandTotal += $partnerTotal;
                                $firstRow = true;
                            @endphp
                            @foreach($partnerWallets as $w)
                            <tr>
                                @if($firstRow)
                                    <td rowspan="{{ $rowCount+1 }}">{{ $partnerName }}</td>
                                    @php $firstRow = false; @endphp
                                @endif
                                <td>{{ $w->tx_id }}</td>
                                <td>{{ $w->tx_date }}</td>
                                <td>{{ $w->amount }}</td>
                                <td>{{ $w->tx_type == 1 ? 'Online' : 'Offline' }}</td>
                                <td>{{ app('App\Http\Controllers\WalletReportController')->txModeLabel($w->tx_mode) }}</td>
                                <td>{{ $w->created_at }}</td>
                                <td>{{ $w->status == 1 ? 'Active' : 'Inactive' }}</td>
                            </tr>
                            @endforeach
                            <tr class="table-secondary">
                                <td colspan="7"><strong>Total for {{ $partnerName }}</strong></td>
                                <td><strong>{{ $partnerTotal }}</strong></td>
                            </tr>
                        @endforeach
                        <tr class="table-dark">
                            <td colspan="7"><strong>Grand Total</strong></td>
                            <td><strong>{{ $grandTotal }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $('#country').on('change', function () {
        var countryId = $(this).val();

        $('#state').html('<option value="">-- Select State --</option>');
        $('#city').html('<option value="">-- Select City --</option>');

        if (countryId) {
            $.get('/get-states/' + countryId, function (data) {
                $.each(data, function (id, title) {
                    $('#state').append('<option value="'+id+'">'+title+'</option>');
                });
            });
        }
    });

    $('#state').on('change', function () {
        var stateId = $(this).val();

        $('#city').html('<option value="">-- Select City --</option>');

        if (stateId) {
            $.get('/get-cities/' + stateId, function (data) {
                $.each(data, function (id, name) {
                    $('#city').append('<option value="'+id+'">'+name+'</option>');
                });
            });
        }
    });
});
</script>

@endsection
