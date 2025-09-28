@extends('layout')
@section('title', 'Luckydraw Sales Report')
@section('content')
<ul class="breadcrumb">
    <li><p>Dashboard</p></li>
    <li><a href="#" class="active">Report Manager</a></li>
    <li><a href="#" class="active">Luckydraw Sales Report</a></li>
</ul>
<div class="row-fluid">
    <div class="span12">
        <div class="grid simple">
            <div class="grid-title">
                <div class="container">
                  <div class="row">
                    <div class="col-md-6"><h3><i class="fa fa-map-signs"></i><span class="semi-bold">Luckydraw Sales Report Filters</span></h3></div>
                    <div class="col-md-6"><span class="pull-right">
                        <a href="{{ route('sales.report.export', ['type' => 'csv'] + request()->all()) }}" class="btn btn-success">Export CSV</a>
                        <a href="{{ route('sales.report.export', ['type' => 'pdf'] + request()->all()) }}" class="btn btn-danger">Export PDF</a>
                    </span></div>
                  </div>
                </div>                

                <form method="GET" action="{{ route('sales.report') }}" class="mb-4">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Luckydraw</label>
                            <select name="luckydraw_id" class="form-control">
                                <option value="">-- All --</option>
                                @foreach($luckydraws as $draw)
                                    <option value="{{ $draw->id }}" {{ request('luckydraw_id') == $draw->id ? 'selected' : '' }}>
                                        {{ $draw->luckydraw_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
            
                        <div class="col-md-3">
                            <label>Start Date</label>
                            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                        </div>
            
                        <div class="col-md-3">
                            <label>End Date</label>
                            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                        </div>
            
                        <div class="col-md-2 mt-4">
                            <label>&nbsp;</label>
                            <button class="btn btn-primary w-100" type="submit"></i> Generate Report</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="grid-body">
                <div class="container">
                  <div class="row">
                    <div class="col-md-6"><h3 class="mb-0"><i class="fa fa-map-signs"></i><span class="semi-bold">Luckydraw Sales Results</span></h3></div>
                    <div class="col-md-6"><span class="pull-right"><h3 class="mb-0">Total Tickets Sold: <b>{{ $totalTickets }}</b></h3></span></div>
                  </div>
                </div>                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sl. No</th>
                            <th>Luckydraw Name</th>
                            <th>Tickets Sold</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $index => $sale)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $sale->luckydraw->luckydraw_name ?? '' }}</td>
                                <td>{{ $sale->tickets_sold }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No Records Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
