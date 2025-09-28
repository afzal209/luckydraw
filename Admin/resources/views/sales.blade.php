@extends('layout')
@section('title','View Customer')
@section('content')
<ul class="breadcrumb">
   <li>
      <p>Dashboard</p>
   </li>
   <li><a href="#" class="active">View Sales</a> </li>
</ul>
<div class="row-fluid">
   <div class="span12">
      <div class="grid simple ">
         <div class="grid-title">
            <h3><i class="fa fa-files"></i><span class="semi-bold"> View All Luckydraw Ticket Sales</span></h3>
         </div>
         <div class="grid-body ">
            <table class="table table-striped" id="example">
               <thead>
                  <tr>
                     <th>Sl.No</th>
                     <th>Customer</th>
                     <th>Business Partner</th>
                     <th>Luckydraw</th>
                     <th>Ticket Details</th>
                     <th>Status</th>
                  </tr>
               </thead>
               <tbody>
                    @php 
                        $row = 0;
                    @endphp
                    @foreach($sale as $sales)
    				    <tr>
        					<td>{{ ++$row; }}</td>
        					<td>@if($sales->cust_perfix = 1) Mr @else Ms @endif. {{$sales->first_name}}<br>{{$sales->email}}<br>{{$sales->mobile}}</td>
        					<td>@if($sales->bp_perfix = 1) Mr @else Ms @endif. {{$sales->poc_first_name}}<br>pr{{$sales->poc_email}}<br>{{$sales->poc_mobile}}</td>
        					<td>{{$sales->luckydraw_name}} <br>@if($sales->frequency = 1) Daily @elseif($sales->frequency = 2) Weekly @elseif($sales->frequency = 3) Monthly @elseif($sales->frequency = 4) Fortnight @else Yearly @endif<br><i class="fa fa-euro"></i>{{$sales->price}}/-</td>
        					<td>{{$sales->ticket_id}}<br>Purchased Date: {{$sales->created_at}}</td>
        					<!-- <td>{{\App\Models\City::select('name')->where('id', $sales->city_id)->first()}} , {{\App\Models\State::select('state_title')->where('id', $sales->state_id)->first()}}<br> {{\App\Models\Country::select('country_name')->where('id', $sales->country_id)->first()}} , {{$sales->zip_code}}</td> -->
        					<td>Active</td>
    				    </tr>
    				 @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
@endsection