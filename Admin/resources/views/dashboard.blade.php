@extends('layout')
@section('title','Admin Dashboard')
@section('content')
	
	   <div class="page-title">
		  <h3>Dashboard </h3>
	   </div>
	   <div id="container">
		  <div class="row">
			 <div class="col-md-3 col-sm-6 spacing-bottom-sm spacing-bottom">
				<div class="tiles blue added-margin">
				   <div class="tiles-body">
					  <div class="controller">
						 <a href="javascript:;" class="reload"></a>
						 <a href="javascript:;" class="remove"></a>
					  </div>
					  <div class="tiles-title"><h4><b>Total Business Partners</b></h4></div>
					  <div class="heading"><i class="fa fa-group fa-2x"></i> <span class="animate-number" data-value="{{$business_partner ?? ''}}" data-animation-duration="1200"></span></div>
				   </div>
				</div>
			 </div>
			 <div class="col-md-3 col-sm-6 spacing-bottom-sm spacing-bottom">
				<div class="tiles green added-margin">
				   <div class="tiles-body">
					  <div class="controller">
						 <a href="javascript:;" class="reload"></a>
						 <a href="javascript:;" class="remove"></a>
					  </div>
					  <div class="tiles-title"><h4><b>Total Customers</b></h4></div>
					  <div class="heading"><i class="fa fa-group fa-2x"></i> <span class="animate-number" data-value="{{ $customer ?? ''}}" data-animation-duration="1000">0</span> </div>
				   </div>
				</div>
			 </div>
			 <div class="col-md-3 col-sm-6 spacing-bottom">
				<div class="tiles red added-margin">
				   <div class="tiles-body">
					  <div class="controller">
						 <a href="javascript:;" class="reload"></a>
						 <a href="javascript:;" class="remove"></a>
					  </div>
					  <div class="tiles-title"><h4><b>Total Luckydraws</b></h4></div>
					  <div class="heading"><i class="fa fa-credit-card fa-2x"></i> <span class="animate-number" data-value="{{ $luckydraw?? ''}}" data-animation-duration="1000">0</span> </div>
				   </div>
				</div>
			 </div>
			 <div class="col-md-3 col-sm-6">
				<div class="tiles purple added-margin">
				   <div class="tiles-body">
					  <div class="controller">
						 <a href="javascript:;" class="reload"></a>
						 <a href="javascript:;" class="remove"></a>
					  </div>
					  <div class="tiles-title"><h4><b>Total Sales</b></h4></div>
					  <div class="heading"><i class="fa fa-euro fa-2x"></i> <span class="animate-number" data-value="{{ $luckydraw_sum ?? '' }}" data-animation-duration="1000">0</span> </div>
				   </div>
				</div>
			 </div>
		  </div>
		   <div class="row">
			  <div class="col-md-4 col-vlg-3 col-sm-6">
				 <div class="tiles green m-b-10">
					<div class="tiles-body">
					   <div class="controller">
						  <a href="javascript:;" class="reload"></a>
						  <a href="javascript:;" class="remove"></a>
					   </div>
					   <div class="tiles-title text-black">OVERALL SALES </div>
					   <div class="widget-stats">
						  <div class="wrapper transparent">
						      <span class="item-title">Today's</span>    <span class="item-count animate-number semi-bold" data-value="{{$sale_today ?? ''}}" data-animation-duration="1000">{{$sale_today ?? ''}}</span>
						  </div>
					   </div>
					   <div class="widget-stats">
						  <div class="wrapper transparent">
							 <span class="item-title">This Month</span> <span class="item-count animate-number semi-bold" data-value="{{$sale_month ?? ''}}" data-animation-duration="1000">{{$sale_month ?? ''}}</span>
						  </div>
					   </div>
					   <div class="widget-stats ">
						  <div class="wrapper last">
							 <span class="item-title">This Year</span> <span class="item-count animate-number semi-bold" data-value="{{$sale_year ?? ''}}" data-animation-duration="1000">{{$sale_year ?? ''}}</span>
						  </div>
					   </div>
					   <div class="progress transparent progress-small no-radius m-t-20" style="width:90%">
						  <div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="64.8%"></div>
					   </div>
					   <div class="description"> <span class="text-white mini-description "><div class="status-icon red"></div> 4% higher <span class="blend">than last month</span></span></div>
					   <div class="description"> <span class="text-white mini-description "><div class="status-icon red"></div> 5% higher <span class="blend">than last year</span></span></div>
					</div>
				 </div>
			  </div>
			  <div class="col-md-4 col-vlg-3 col-sm-6">
				 <div class="tiles purple m-b-10">
					<div class="tiles-body">
					   <div class="controller">
						  <a href="javascript:;" class="reload"></a>
						  <a href="javascript:;" class="remove"></a>
					   </div>
					   <div class="tiles-title text-black">OVERALL Business Partners</div>
					   <div class="widget-stats">
						  <div class="wrapper transparent">
							 <span class="item-title">Today's</span> <span class="item-count animate-number semi-bold" data-value="{{$business_today ?? ''}}" data-animation-duration="1000">{{$business_today ?? ''}}</span>
						  </div>
					   </div>
					   <div class="widget-stats">
						  <div class="wrapper transparent">
							 <span class="item-title">This Month</span> <span class="item-count animate-number semi-bold" data-value="{{$business_month ?? ''}}" data-animation-duration="1000">{{$business_month ?? ''}}</span>
						  </div>
					   </div>
					   <div class="widget-stats ">
						  <div class="wrapper last">
							 <span class="item-title">This Year</span> <span class="item-count animate-number semi-bold" data-value="{{$business_year ?? ''}}" data-animation-duration="1000">{{$business_year ?? ''}}</span>
						  </div>
					   </div>
					   <div class="progress transparent progress-small no-radius m-t-20" style="width:90%">
						  <div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="64.8%"></div>
					   </div>
					   <div class="description"> <span class="text-white mini-description ">2% higher <span class="blend">than last month</span></span></div>
					   <div class="description"> <span class="text-white mini-description "><div class="status-icon green"></div>9% higher <span class="blend">than last year</span></span></div>
					</div>
				 </div>
			  </div>
			  <div class="col-md-4 col-vlg-3 col-sm-6">
				 <div class="tiles blue m-b-10">
					<div class="tiles-body">
					   <div class="controller">
						  <a href="javascript:;" class="reload"></a>
						  <a href="javascript:;" class="remove"></a>
					   </div>
					   <div class="tiles-title text-black">OVERALL Customers</div>
					   <div class="widget-stats">
						  <div class="wrapper transparent">
							 <span class="item-title">Today's</span> <span class="item-count animate-number semi-bold" data-value="{{$customer_today ?? ''}}" data-animation-duration="1000">{{$customer_today ?? ''}}</span>
						  </div>
					   </div>
					   <div class="widget-stats">
						  <div class="wrapper transparent">
							 <span class="item-title">Monthly</span> <span class="item-count animate-number semi-bold" data-value="{{$customer_month ?? ''}}" data-animation-duration="1000">{{$customer_month ?? ''}}</span>
						  </div>
					   </div>
					   <div class="widget-stats ">
						  <div class="wrapper last">
							 <span class="item-title">Yearly</span> <span class="item-count animate-number semi-bold" data-value="{{$customer_year ?? ''}}" data-animation-duration="1000">{{$customer_year ?? ''}}</span>
						  </div>
					   </div>
					   <div class="progress transparent progress-small no-radius m-t-20" style="width:90%">
						  <div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="64.8%"></div>
					   </div>
					   <div class="description"> <span class="text-white mini-description ">7% higher <span class="blend">than last month</span></span></div>
					   <div class="description"> <span class="text-white mini-description "><div class="status-icon green"></div>20% higher <span class="blend">than last year</span></span></div>
					</div>
				 </div>
			  </div>
			  <div class="col-md-4 col-vlg-3 visible-xlg visible-sm col-sm-6">
				 <div class="tiles red m-b-10">
					<div class="tiles-body">
					   <div class="controller">
						  <a href="javascript:;" class="reload"></a>
						  <a href="javascript:;" class="remove"></a>
					   </div>
					   <div class="tiles-title text-black">OVERALL SALES </div>
					   <div class="widget-stats">
						  <div class="wrapper transparent">
							 <span class="item-title">Overall Sales</span> <span class="item-count animate-number semi-bold" data-value="5669" data-animation-duration="700">0</span>
						  </div>
					   </div>
					   <div class="widget-stats">
						  <div class="wrapper transparent">
							 <span class="item-title">Today's</span> <span class="item-count animate-number semi-bold" data-value="751" data-animation-duration="700">0</span>
						  </div>
					   </div>
					   <div class="widget-stats ">
						  <div class="wrapper last">
							 <span class="item-title">Monthly</span> <span class="item-count animate-number semi-bold" data-value="1547" data-animation-duration="700">0</span>
						  </div>
					   </div>
					   <div class="progress transparent progress-small no-radius m-t-20" style="width:90%">
						  <div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="64.8%"></div>
					   </div>
					   <div class="description"> <span class="text-white mini-description ">4% higher <span class="blend">than last month</span></span>
					   </div>
					</div>
				 </div>
			  </div>
		   </div>
		  <div class="row">
			 <div class="col-md-12 spacing-bottom">
				<div class="row tiles-container tiles white spacing-bottom">
				   <div class="row-fluid">
					  <div class="span12">
						 <div class="grid simple ">
							<div class="grid-title">
							   <h3><i class="fa fa-users"></i><span class="semi-bold"> View Latest Luckydraw Sales</span> <button type="button" class="btn btn-primary" style="border-radius:25px;"><i class="fa fa-exchange"></i>&nbsp;View All Transactions</button></h3>
							</div>
							<div class="grid-body ">
							   <table class="table table-striped" id="example">
								  <thead>
									 <tr>
										<th>Customer Details</th>
										<th>BP Details</th>
										<th>Luckydraw Details</th>
										<th>Location</th>
										<th>Luckydraw Number</th>
									 </tr>
								  </thead>
								  <tbody>
								      @foreach($sale as $sales)
									 <tr>
										<td>@if($sales->cust_perfix = 1) Mr @else Ms @endif. {{$sales->first_name}}<br>{{$sales->email}}<br>{{$sales->mobile}}</td>
										<td>@if($sales->bp_perfix = 1) Mr @else Ms @endif. {{$sales->poc_first_name}}<br>pr{{$sales->poc_email}}<br>{{$sales->poc_mobile}}</td>
										<td>{{$sales->luckydraw_name}} <br>@if($sales->frequency = 1) Daily @elseif($sales->frequency = 2) Weekly @elseif($sales->frequency = 3) Monthly @elseif($sales->frequency = 4) Fortnight @else Yearly @endif<br><i class="fa fa-euro"></i>{{$sales->price}}/-</td>
										<td>{{\App\Models\City::select('name')->where('id', $sales->city_id)->first()}} , {{\App\Models\State::select('state_title')->where('id', $sales->state_id)->first()}}<br> {{\App\Models\Country::select('country_name')->where('id', $sales->country_id)->first()}} , {{$sales->zip_code}}</td>
										<td>{{$sales->ticket_id}}<br>Draw Date : </td>
										
									 </tr>
									 @endforeach
								  </tbody>
							   </table>
							</div>
						 </div>
					  </div>
				   </div>
				</div>
			 </div>
			 <!--<div class="col-md-4">-->
				<!--<div class="row spacing-bottom ">-->
				<!--   <div class="col-md-12">-->
				<!--	  <div class="tiles white added-margin">-->
				<!--		 <div class="tiles-body">-->
				<!--			<div class="controller">-->
				<!--			   <a href="javascript:;" class="reload"></a>-->
				<!--			   <a href="javascript:;" class="remove"></a>-->
				<!--			</div>-->
				<!--			<div class="tiles-title"> SERVER LOAD </div>-->
				<!--			<div class="heading text-black "> SSD Space 3.87GB</div>-->
				<!--			<div class="progress  progress-small no-radius">-->
				<!--			   <div class="progress-bar progress-bar-success animate-progress-bar" data-percentage="25%"></div>-->
				<!--			</div>-->
				<!--			<div class="description"> <span class="mini-description"><span class="text-black">Y GB</span> of <span class="text-black">1,024GB</span> used</span>-->
				<!--			</div>-->
				<!--		 </div>-->
				<!--	  </div>-->
				<!--	  <div class="tiles white added-margin">-->
				<!--		 <div id="charts"> Live Chart code will goes here</div>-->
				<!--	  </div>-->
				<!--   </div>-->
				<!--</div>-->
			 </div>
		  </div>
	   </div>
	   <!-- END PAGE -->
	
@endsection