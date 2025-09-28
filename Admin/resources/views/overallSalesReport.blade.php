@extends('layout')
@section('title', 'Overall Sales Report')
@section('content')
<ul class="breadcrumb">
    <li><a href="{{route('dashboard')}}" class="active">Dashboard</a></li>
    <li><a href="{{route('reports.index') }}" class="active">Reports Manager</a></li>
    <li><a href="#" class="active">Sales Report</a></li>
</ul>
<div class="row-fluid">
    <div class="span12">
        <div class="grid simple">
            <div class="grid-title">
                <h3><i class="fa fa-map-signs"></i> Sales Report Generator Filters</h3>
                <form method="POST" action="{{ route('overallSales.generateReport') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="date" name="start_date" class="form-control" placeholder="Start Date">
                        </div>
                        <div class="col-md-4">
                            <input type="date" name="end_date" class="form-control" placeholder="End Date">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" name="submit" class="btn btn-primary"></i> Generate Report</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="grid-body">
                <div class="container">
                  <div class="row">
                    <div class="col-md-6"><h3><i class="fa fa-user-secret"></i> Overall Sales Data</h3></div>
                    <div class="col-md-6"><span class="pull-right">
                        <button type="submit" name="download_excel" class="btn btn-success">Download Excel</button>
                        <button type="submit" name="download_pdf" class="btn btn-danger">Download PDF</button>
                    </span></div>
                  </div>
                </div>
                @isset($sales)
                    <table class="table table-bordered mt-4">
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
                                <th colspan="3" class="text-end">Total Sales Amount</th>
                                <th>{{ $totalAmount }}</th>
                            </tr>
                        </tfoot>
                    </table>
                @endisset
            </div>
        </div>
    </div>    
</div>
@endsection