@extends('layout')
@section('title', 'Customers Report')
@section('content')
<ul class="breadcrumb">
    <li><a href="{{route('dashboard')}}" class="active">Dashboard</a></li>
    <li><a href="{{route('reports.index') }}" class="active">Reports Manager</a></li>
    <li><a href="#" class="active">Customer Report</a></li>
</ul>
<div class="row-fluid">
    <div class="span12">
        <div class="grid simple">
            <div class="grid-title">
                <h3><i class="fa fa-map-signs"></i> Customer Report Generator Filters</h3>
                <form method="GET" action="{{ route('reports.customers') }}" id="filterForm">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Country</label>
                            <select name="country_id" id="country" class="form-control">
                                <option value="">-- Select Country --</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>State</label>
                            <select name="state_id" id="state" class="form-control">
                                <option value="">-- Select State --</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>City</label>
                            <select name="city_id" id="city" class="form-control">
                                <option value="">-- Select City --</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="">All</option>
                                <option value="Active" {{ request('status')=='Active'?'selected':'' }}>Active</option>
                                <option value="Inactive" {{ request('status')=='Inactive'?'selected':'' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-3 mt-2">
                            <label>Start Date</label>
                            <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                        </div>
                        <div class="col-md-3 mt-2">
                            <label>End Date</label>
                            <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                        </div>
                        <div class="col-md-3 mt-2">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-primary mt-4"></i> Generate Report</button>
                            
                        </div>
                    </div>
                </form>    
            </div>
            <div class="grid-body">
                <div class="container">
                  <div class="row">
                    <div class="col-md-6"><h3><i class="fa fa-user-secret"></i> Customers Filtered Data</h3></div>
                    <div class="col-md-6"><span class="pull-right">
                        <a href="{{ route('reports.customers.export',['type'=>'csv'] + request()->all()) }}" class="btn btn-success mt-4">Export CSV</a>
                        <a href="{{ route('reports.customers.export',['type'=>'pdf'] + request()->all()) }}" class="btn btn-danger mt-4">Export PDF</a>
                    </span></div>
                  </div>
                </div>
                <table class="table table-bordered mt-4">
                    <thead>
                        <tr>
                            <th>Name</th><th>Email</th><th>Phone</th><th>Country</th><th>State</th><th>City</th><th>Status</th><th>Joined On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $c)
                            <tr>
                                <td>{{ $c->first_name }}{{ $c->last_name }}</td>
                                <td>{{ $c->email }}</td>
                                <td>{{ $c->mobile }}</td>
                                <td>{{ $c->country->country_name ?? '' }}</td>
                                <td>{{ $c->state->state_title ?? '' }}</td>
                                <td>{{ $c->city->name ?? '' }}</td>
                                <td>{{ $c->status == 1 ? 'Active' : 'Inactive' }}</td>
                                <td>{{ $c->created_at }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center">No Customers Found</td></tr>
                        @endforelse
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
