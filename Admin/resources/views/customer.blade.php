@extends('layout')
@section('title','Edit Customer')
@section('content')
<ul class="breadcrumb">
    <li><p>Dashboard</p></li>
    <li><a href="#" class="active">Edit Customer</a> </li>
</ul>

<div class="row-fluid">
  <div class="span12">
     <div class="grid simple ">
        <div class="grid-title">
           <h3><i class="fa fa-users"></i><span class="semi-bold"> Manage Customers</span></h3>
        </div>
        <div class="grid-body ">
           <table class="table table-striped" id="example">
              <thead>
                 <tr>
                    <th>Customer Name</th>s
                    <th>Details</th>
                    <th>Address</th>
					<th>Revenue</th>
					<th>Status</th>
                    <th>Action</th>
                 </tr>
              </thead>
              <tbody>
                @php 
                  $sn = 1;
                @endphp
                @foreach($customer as $customers)
                <tr class="odd gradeX">
					<td>@if($customers->prefix == 1) {{'Mr'}} @else {{'Ms'}} @endif.{{$customers->first_name}}</td>
				    <td>{{$customers->email}}<br>{{$customers->mobile}}</td>
					<td>
                        {{ \App\Models\City::where('id', $customers->city_id)->value('name') ?? 'N/A' }} ,
                        {{ \App\Models\State::where('id', $customers->state_id)->value('state_title') ?? 'N/A' }}<br>
                        {{ \App\Models\Country::where('id', $customers->country_id)->value('country_name') ?? 'N/A' }},
                        {{ $customers->zip_code ?? 'N/A' }}
                    </td>
				    <td><i class="fa fa-euro"></i>{{\App\Models\Sale::where('customer_id', $customers->customer_id)->sum('price')}}</td>
					<td>
					    @if($customers->status == 1)
					    {{'Active'}}
					    @else
					    {{'Inactive'}}
					    @endif
					</td>
                     <td class="center">
						<a href="{{route('customer.edit',$customers->id)}}"  class="btn btn-info" style="border-radius:50px;"><i class="fa fa-pencil"></i> Edit</a>
						@if($customers->status)
							<a href="{{ route('customer.status', ['id' => $customers->id, 'actions' => 1]) }}" class="btn btn-warning" style="border-radius:50px;">
                               <i class="fa fa-pause"></i>&nbsp;Suspend
                            </a>
						@else
							<a href="{{ route('customer.status', ['id' => $customers->id, 'actions' => 0]) }}"  class="btn btn-success" style="border-radius:50px;">
                               <i class="fa fa-play"></i>&nbsp;Unsuspend
                            </a>
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