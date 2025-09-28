@extends('layout')
@section('title', 'Luckydraw Template Report')
@section('content')
<ul class="breadcrumb">
    <li><a href="{{route('dashboard')}}" class="active">Dashboard</a></li>
    <li><a href="{{route('reports.index') }}" class="active">Dashboard</a></li>
    <li><a href="#" class="active">Manage Luckydraw Template Report</a></li>
</ul>
<div class="row-fluid">
    <div class="span12">
        <div class="grid simple">
            <div class="grid-title">
                <h3><i class="fa fa-map-signs"></i><span class="semi-bold">Luckydraw Template Report Filters</span></h3>
                <form method="POST" action="{{ route('luckydraw.report.filter') }}">
                    @csrf
                    <div class="row">                    
                        <div class="col-md-3">
                            <label>Luckydraw</label>
                            <select name="luckydraw_id" id="luckydraw_id" class="form-control">
                                <option value="all">All</option>
                                @foreach($luckydraws as $ld)
                                    <option value="{{ $ld->id }}">{{ $ld->luckydraw_name }}</option>
                                @endforeach
                            </select>
                        </div>
            
                        <div class="col-md-3">
                            <label>Template</label>
                            <select name="template_id" id="template_id" class="form-control">
                                <option value="all">All</option>
                            </select>
                        </div>
            
                        <div class="col-md-3">
                            <label>Start Date</label>
                            <input type="date" name="start_date" class="form-control">
                        </div>
            
                        <div class="col-md-3">
                            <label>End Date</label>
                            <input type="date" name="end_date" class="form-control">
                        </div>
            
                        <div class="col-md-3">
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
                    <div class="col-md-6"><span class="pull-right"><h3 class="mb-0"><b>Total Tickets: {{ $totalTickets ?? ($sales->count() ?? 0) }}</b></h3></span></div>
                  </div>
                </div>                
                <table class="table table-bordered">                
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
                        <tr>
                            <td colspan="3"><strong>Grand Total (All Selected Luckydraws):</strong></td>
                            <td><strong>{{ $grandTotal ?? 0 }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>            
        </div>
    </div> 
</div>
<script>
document.getElementById('luckydraw_id').addEventListener('change', function(){
    var luckydrawId = this.value;
    fetch('/api/templates-by-luckydraw/' + luckydrawId)
        .then(res => res.json())
        .then(data => {
            let select = document.getElementById('template_id');
            select.innerHTML = '<option value="all">All</option>';
            data.forEach(t => {
                select.innerHTML += `<option value="${t.id}">${t.template_name}</option>`;
            });
        });
});
</script>
@endsection