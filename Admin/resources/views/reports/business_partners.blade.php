@extends('layout')
@section('title', 'Business Partners Report')
@section('content')
<ul class="breadcrumb">
    <li><a href="{{route('dashboard')}}" class="active">Dashboard</a></li>
    <li><a href="{{route('reports.index') }}" class="active">Reports Manager</a></li>
    <li><a href="#" class="active">Business Partner Report</a></li>
</ul>
<div class="row-fluid">
    <div class="span12">
        <div class="grid simple">
            <div class="grid-title">
                <h3><i class="fa fa-map-signs"></i> Business Partner Report Generator Filters</h3>
                <form method="GET" class="row g-3 mb-3">
                    <div class="col-md-2">
                        <label>Country</label>
                        <select name="coutnry_id" id="coutnry" class="form-control">
                            <option value="">-- Select Coutnry --</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ request('region_id')==$country->id?'selected':'' }}>
                                    {{ $country->country_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="col-md-2">
                        <label>State</label>
                        <select name="state_id" id="state" class="form-control">
                            <option value="">-- Select State --</option>
                        </select>
                    </div>
            
                    <div class="col-md-2">
                        <label>City</label>
                        <select name="city_id" id="city" class="form-control">
                            <option value="">-- Select City --</option>
                        </select>
                    </div>
            
                    <div class="col-md-2">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="">-- All --</option>
                            <option value="1" {{ request('status')==1?'selected':'' }}>Active</option>
                            <option value="0" {{ request('status')==='0'?'selected':'' }}>Inactive</option>
                        </select>
                    </div>
            
                    <div class="col-md-2">
                        <label>Start Date</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                    </div>
            
                    <div class="col-md-2">
                        <label>End Date</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                    </div>
            
                    <div class="col-md-12 mt-2">
                        <button type="submit" class="btn btn-primary"></i> Generate Report</button>
                    </div>
                </form>
            </div>
            <div class="grid-body">
                <div class="container">
                  <div class="row">
                    <div class="col-md-6"><h3><i class="fa fa-user-secret"></i> Business Partners Report</h3></div>
                    <div class="col-md-6"><span class="pull-right">
                        <a href="{{ route('reports.business_partners.export.csv', request()->all()) }}" class="btn btn-success">Export CSV</a>
                        <a href="{{ route('reports.business_partners.export.pdf', request()->all()) }}" class="btn btn-danger">Export PDF</a>
                    </span></div>
                  </div>
                </div>                

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Region</th>
                            <th>State</th>
                            <th>City</th>
                            <th>Status</th>
                            <th>Joined On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($businessPartners as $bp)
                            <tr>
                                <td>{{ $bp->poc_first_name }} {{ $bp->poc_last_name }}</td>
                                <td>{{ $bp->poc_email }}</td>
                                <td>{{ $bp->poc_mobile }}</td>
                                <td>{{ $bp->country->country_name ?? '' }}</td>
                                <td>{{ $bp->state->state_title ?? '' }}</td>
                                <td>{{ $bp->city->name ?? '' }}</td>
                                <td>{{ $bp->status == 1 ? 'Active' : 'Inactive' }}</td>
                                <td>{{ $bp->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>                
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    $('#region').on('change', function(){
        var countryId = $(this).val();
        $('#state').html('<option value="">-- Select State --</option>');
        $('#city').html('<option value="">-- Select City --</option>');

        if(countryId){
            $.get('/get-states/' + countryId, function(data){
                $.each(data, function(id,title){
                    $('#state').append('<option value="'+id+'">'+title+'</option>');
                });
            });
        }
    });

    $('#state').on('change', function(){
        var stateId = $(this).val();
        $('#city').html('<option value="">-- Select City --</option>');

        if(stateId){
            $.get('/get-cities/' + stateId, function(data){
                $.each(data, function(id,name){
                    $('#city').append('<option value="'+id+'">'+name+'</option>');
                });
            });
        }
    });

});
</script>
@endsection