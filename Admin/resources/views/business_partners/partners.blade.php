@extends('layout')
@section('title','View Business Partners')
@section('content')
   <ul class="breadcrumb">
      <li><p>Dashboard</p></li>
      <li><a href="#" class="active">Business Partners</a> </li>
      <li><a href="#" class="active">View Business Partners</a> </li>
   </ul>
   <div class="row-fluid">
      <div class="span12">
         <div class="grid simple ">
            <div class="grid-title">
                <div class="row">
                    <div class="col-md-6"><h3><i class="fa fa-users"></i><span class="semi-bold"> Manage Business Partners</span></h3></div>
                    <div class="col-md-6"><span class="pull-right"><a href="{{ route('business_partners.assign_luckydraws.bulk') }}" class="btn btn-xs btn-success"><i class="fa fa-tasks"></i> Bulk Assign Luckydraws</a></span></div>
                </div>
            </div>
            <div class="grid-body ">
               <table class="table table-striped" id="example">
                  <thead>
                     <tr>
                        <th>BP Details</th>
			            <th>Business Area</th>
			            <th>Region/Country</th>
						<th>Address</th>
						<th>Wallet</th>
						<th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                    @foreach($business_Partner as $business)
                        <tr>
                            <td>{{$business->business_name}}<br>@if($business->prefix == '1') Mr @else Ms @endif. {{$business->poc_first_name}} {{$business->poc_last_name}}<br>{{$business->poc_email}}<br>+{{$business->poc_mobile}}</td>
							<td>{{$business->area_name}}</td>
							<td>{{$business->region_name}}/{{$business->country_name}}</td>
							<td>{{$business->address_line_1}}<br> {{$business->address_line_2}},<br>{{$business->zip_code}} {{$business->state_title}}, {{$business->country_name}}</td>
                            <td><i class="fa fa-euro"></i>{{$business->wallet_amount}}/-</td>
							<td>
							    @if($business->status == 1)
								    Active
								@else
								    Inactive
								@endif
							</td>
                            <td class="center">
                                <a href="{{ route('business_partners.partner.edit', $business->id) }}" class="btn btn-info" style="background:#885df1; border-radius:50px;"><i class="fa fa-paste"></i>&nbsp;Edit</a>
								<a href="{{ route('business_partners.partner.view_luckydraw', $business->id) }}"  type="button" class="btn btn-primary" style="border-radius:50px;"><i class="fa fa-paste"></i>&nbsp;View</a>
								@if($business->status)
									<a href="{{ route('business_partners.partner.status', ['id' => $business->id, 'actions' => 1]) }}" class="btn btn-warning" style="border-radius:50px;">
                                        <i class="fa fa-paste"></i>&nbsp;Suspend
                                    </a>
								@else
									<a href="{{ route('business_partners.partner.status', ['id' => $business->id, 'actions' => 0]) }}" class="btn btn-success" style="border-radius:50px;">
                                        <i class="fa fa-paste"></i>&nbsp;Unsuspend
                                    </a>
                                @endif
                                	<a href="{{ route('business_partners.delete', $business->id) }}" type="button" class="btn btn-danger" style="border-radius:50px;"><i class="fa fa-trash"></i>&nbsp;Delete</a>
								<br><br>
								<button type="button" class="btn btn-warning" style="border-radius:50px;"><i class="fa fa-paste"></i>&nbsp;Load Wallet</button>
								
								<a href="{{ route('business_partners.assign_luckydraws.edit', $business->id) }}"  class="btn btn-success" style="border-radius:50px;"><i class="fa fa-paste"></i>&nbsp;Assign-Luckydraws</a>
							   
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