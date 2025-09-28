@extends('layout')
@section('title','View Luckydraw')
@section('content')
    <style>
        .select2-container--default .select2-results__option {
            padding-left: 25px;
            position: relative;
        }
        .select2-container--default .select2-results__option::before {
            content: "";
            display: inline-block;
            position: absolute;
            left: 5px;
            top: 7px;
            width: 14px;
            height: 14px;
            border: 1px solid #ccc;
            background-color: #fff;
        }
        .select2-container--default .select2-results__option[aria-selected=true]::before {p
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
    <ul class="breadcrumb">
        <li><p>Business Partner</p></li>
        <li><a href="#" class="active">View  Luckydraw</a> </li>
    </ul>
	
    <!-- END DROPDOWN CONTROLS-->
	<div class="row-fluid">
		<div class="span12">
			<div class="grid simple ">
				<div class="grid-title">
					<h3><i class="fa fa-file"></i><span class="semi-bold"> View  Luckydraws</span></h3>
				</div>
				<div class="grid-body ">
					<table class="table table-striped" id="example">
						<thead>
							<tr>
								<th>Luckydraw Name</th>
								<th>Template</th>
								<th>Price</th>
								<th>Countries</th>
								<th>No.Of Prizes</th>
								<th>Prizes</th>
								<!--<th>Action</th>-->
							</tr>
						</thead>
						<tbody>
						    @foreach($luckydraws as $luckydraw)
							    @php
							        $luckydraw_sale = App\Models\Sale::where('luckydraw_id','=',$luckydraw->id)->count('luckydraw_id');
							    @endphp
							    @if($luckydraw->winner_status == 1)
								    @php 
									    $luckydraw_sale_customer = App\Models\Sale::select('sales.ticket_id','customers.first_name','customers.email','customers.mobile','business_partners.poc_first_name','business_partners.poc_mobile')
                                        ->join('business_partners', 'business_partners.id', '=', 'sales.partner_id')
                                        ->join('customers', 'customers.customer_id', '=', 'sales.customer_id')->where('sales.ticket_id','=',$luckydraw->ticket_id)
                                        ->first();  
								    @endphp
								@endif
								<tr>
									<td>
									    {{$luckydraw->luckydraw_name}}<br>Start Date : {{$luckydraw->start_date}}<br>End Date : {{$luckydraw->end_date}}
									    <br>
									    @if($luckydraw->status == 0)
								            <b>{{'Inactive'}}</b>
										@else
										    <b>{{'Active'}}</b>
										@endif
									    <br><br>
									    <h4 style="color:blue;"><b>
										    @if($luckydraw->frequency == 1)
										        {{'Daily'}}
										    @elseif($luckydraw->frequency == 2)
										        {{'Weekly'}}
										    @elseif($luckydraw->frequency == 3)
										        {{'Monthly'}}
										    @elseif($luckydraw->frequency == 4)
										        {{'Yearly'}}
										    @else
										        {{'N/A'}}
										    @endif
									    </b></h4>
									</td>
									@php
    $template_ids = [];
    $template_names = [];
@endphp

@if($luckydraw->template_id == 'all')
    @if($luckydraw->template_option == 1)
    @php
        $template_ids = $luckydraw->template_luckydraw_id ? explode(',', $luckydraw->template_luckydraw_id) : [];
        $template_names = \App\Models\Template_Manager::whereIn('id', $template_ids)
                            ->pluck('template_name as names')
                            ->toArray();
    @endphp
    @else
    $template_ids = $luckydraw->template_group_id ? explode(',', $luckydraw->template_group_id) : [];
        $template_names = \App\Models\Template_group::whereIn('id', $template_ids)
                            ->pluck('group_name as names')
                            ->toArray();
    @endif
@else
    @if($luckydraw->template_option == 1)
    @php
        $template_ids = $luckydraw->template_id ? explode(',', $luckydraw->template_id) : [];
        $template_names = \App\Models\Template_Manager::whereIn('id', $template_ids)
                            ->pluck('template_name as names')
                            ->toArray();
    @endphp
    @else
     @php
    $template_ids = $luckydraw->template_group_id ? explode(',', $luckydraw->template_group_id) : [];
        $template_names = \App\Models\Template_group::whereIn('id', $template_ids)
                            ->pluck('group_name as names')
                            ->toArray();
                             @endphp

    @endif
    
@endif

								<td>
                                       <ul class="nameList">
    @foreach($template_names as $index => $name)
        <li class="{{ $index >= 3 ? 'extra' : '' }}">{{ $name }}</li>
    @endforeach
</ul>
@if(count($template_names) > 3)
    <span class="toggleLink" style="cursor:pointer; color:blue;">More...</span>
@endif
                                    </td>

									<td><i class="fa fa-euro"></i>{{$luckydraw->price}}/-</td>
									<td>
									    @if($luckydraw->region_id == 'all')
									    All
									    @else
									    {{$luckydraw->region_names}}
									    @endif
									    @if($luckydraw->country_id ==  'all')
									        All
									    @else
									    ,{{$luckydraw->country_names}}
									    @endif
									    
									    </td>
									<td>{{$luckydraw->no_of_prizes ?? ''}}</td>
									<td>
                                        @php 
                                            $prize = App\Models\Prize::where('luckydraw_id', $luckydraw->id)->get();
                                        @endphp
                                    
                                        @if($prize->isNotEmpty())
                                            @foreach($prize as $prizes)
                                                <div>
                                                    {{ $loop->iteration }}. 
                                                    @if($prizes->prize_type == 1)
                                                        {{ $prizes->amount }}
                                                    @else
                                                        {{ $prizes->item }}
                                                        <br>
                                                        <img src="{{request()->getSchemeAndHttpHost()}}/uploads/luckydraw/prizes/{{ $prizes->image }}" style="width:100px; height:100px;">
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <span>No prize available</span>
                                        @endif
                                    </td>
								
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
  
@endsection

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 
 
 
 

 
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




