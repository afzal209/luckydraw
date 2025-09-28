@extends('layout')
@section('title', 'Report Manager Home')
@section('content')
<ul class="breadcrumb">
    <li><a href="{{route('dashboard')}}" class="active">Dashboard</a></li>
    <li><a href="#" class="active">Reports Manager</a></li>
    <li><a href="#" class="active">Report Generator Home</a></li>
</ul>
<div class="row-fluid">
    <div class="span12">
        <div class="grid simple">
            <div class="grid-title">
                <h3>
                    <i class="fa fa-map-signs"></i>
                    <span class="semi-bold">
                        Report Manager
                    </span>
                </h3>
            </div>
            <div class="grid-body">
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-4 mb-4">
                        <a href="{{ route('reports.customers') }}" class="btn btn-primary w-100" style="border-radius:25px">
                            Customer Report
                        </a>
                    </div>
                    <div class="col-md-4 mb-4">
                        <a href="{{ route('reports.business_partners') }}" class="btn btn-success w-100" style="border-radius:25px">
                            Business Partner Report
                        </a>
                    </div>
                    <div class="col-md-4 mb-4">
                        <a href="{{ route('wallet.report') }}" class="btn btn-danger w-100" style="border-radius:25px">
                            Business Partners Wallet Report
                        </a>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-4 mb-4">
                        <a href="{{ route('sales.report') }}" class="btn btn-warning w-100" style="border-radius:25px">
                            Luckydraw Sales Report
                        </a>
                    </div>
                    <div class="col-md-4 mb-4">
                        <a href="{{ route('luckydraw.report') }}" class="btn btn-info w-100" style="border-radius:25px">
                            Luckydraw Template wise Report
                        </a>
                    </div>
                    <div class="col-md-4 mb-4">
                        <a href="{{route('overallSales.report') }}" class="btn btn-secondary w-100" style="border-radius:25px">
                            Overall Sales Report
                        </a>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>    
@endsection