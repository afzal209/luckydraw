@extends('layout')
@section('title','Products')
@section('content')
    <h1>Current Luckydraws</h1>
    <div class="row gx-4">
        @foreach($luckydraw as $luckydraws)
            @if(date('Y-m-d') >= $luckydraws->start_date AND date('Y-m-d') <= $luckydraws->end_date)
				<div class="col-sm-4 col-12">
					<div class="card mb-4">
						<div class="card-header">
							<h5 class="card-title">{{$luckydraws->luckydraw_name}}</h5>
						</div>
						<div class="card-body">
							<div class="card-img">
							</div>
							<a href="#" class="btn btn-warning">€{{$luckydraws->price}}/-</a>
							<a href="#" class="btn btn-info">Last Date : {{$luckydraws->end_date}}</a>
							<a href="#" class="btn btn-success">
								@if($luckydraws->frequency == 1)
									{{'Daily'}}
								@elseif($luckydraws->frequency == 2)
									{{'Weekly'}}
								@elseif($luckydraws->frequency == 3)
									{{'Monthly'}}
								@elseif($luckydraws->frequency == 4)
									{{'Yearly'}}
								@endif
							</a>
						</div>
					</div>
				</div>
            @endif
        @endforeach
    </div>
	<h1>Future Luckydraws</h1>
    <div class="row gx-4">
        @foreach($luckydraw as $luckydraws)
            @if(date('Y-m-d') < $luckydraws->start_date AND date('Y-m-d') <= $luckydraws->end_date)
				<div class="col-sm-4 col-12">
					<div class="card mb-4">
						<div class="card-header">
							<h5 class="card-title">{{$luckydraws->luckydraw_name}}</h5>
						</div>
						<div class="card-body">
							<div class="card-img">
							
							</div>
							<a href="#" class="btn btn-warning">€{{$luckydraws->price}}/-</a>
							<a href="#" class="btn btn-info">Start Date : {{$luckydraws->start_date}}</a>
							<a href="#" class="btn btn-success">
								@if($luckydraws->frequency == 1)
									{{'Daily'}}
								@elseif($luckydraws->frequency == 2)
									{{'Weekly'}}
								@elseif($luckydraws->frequency == 3)
									{{'Monthly'}}
								@elseif($luckydraws->frequency == 4)
									{{'Yearly'}}
								@endif
							</a>
						</div>
					</div>
				</div>
            @endif
        @endforeach
    </div>
@endsection