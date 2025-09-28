@extends('layout')
@section('title','User Transaction')
@section('content')
        <div class="inner-hero-section style--five">
         </div>
          <!-- inner-hero-section end -->
         <!-- user section start -->
         <div class="mt-minus-150 pb-120">
            <div class="container">
               <div class="row">
                  @include('user_card')
                  
                    @php 
                                
                                  @endphp
                  <div class="col-lg-8 mt-lg-0 mt-4">
                     <div class="transaction-balance-wrapper">
                        <div class="left">
                           <div class="transaction-balance">
                              <h4 class="balance">{{ $customer->created_at->format('d-M-Y') ?? '' }}</h4>
                              <span>Joining Date</span>
                           </div>
                        </div>
                        <div class="right">
                           <a href="#" class="transaction-action-btn">
                           <img src="{{URL::asset('images/icon/transaction/1.png') }}" alt="image">
                           <span>Amount Spent {{$sale_cal}}</span>
                           </a>
                           <a href="#" class="transaction-action-btn ms-4">
                           <img src="{{URL::asset('images/icon/transaction/2.png') }}" alt="image">
                           <span>No.Of Tickets {{$sale ?? '0'}}</span>
                           </a>
                        </div>
                     </div>
                     <!-- transaction-balance-wrapper end -->
                     <div class="all-transaction">
                        <div class="all-transaction__header">
                           <h3 class="title">All Transactions History</h3>
                           <div class="date-range">
                              Please raise a <a href="{{route('user_support')}}">Support</a> ticket if you find any missing data
                           </div>
                        </div>
                        <div class="table-responsive-xl">
                           <table>
                              <thead>
                                 <tr>
                                    <th>Sl.No</th>
                                    <th>Lottery Name</th>
                                    <th>Data</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                 </tr>
                              </thead>
                              <tbody>
                                  @php 
                                  $sno = 1;
                                  @endphp
                                  @foreach($results as $result)
                                @php
                                $ticket_cost = $result->price * $result->qty;
                                $ticket_cost = $ticket_cost - $result->discount;
                                $ticket_total_price = $ticket_cost + $result->tax;
                                @endphp
                                
                                 <tr>
                                    <td><p>{{$sno++}}</p></td>
                                    <td>
                                        <p>{{$result->lottery_name}}<br>{{$result->ticket_id}}</p>
                                    </td>
                                    <td>
                                        <p>{{$result->business_name}}</p>
                                        <p>{{$result->poc_first_name}}</p>
                                         <p>{{$result->poc_email}}</p>
                                          <p>{{$result->poc_mobile}}</p>
                                    </td>
                                    <td><span class="amount minus-amount">{{$ticket_total_price}}</span></td>
                                    <td><div class="status-pending">@if($result->status == 1) Active @else In-Active @endif</div></td>
                                 </tr>
                                 @endforeach
                              </tbody>
                           </table>
                        </div>
                        <div class="load-more">
                           <button type="button">Show All Transactions<i class="las la-angle-down ml-2"></i></button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- user section end -->
@endsection