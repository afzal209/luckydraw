@extends('layout')
@section('title','User')
@section('content')


 <div class="inner-hero-section style--five">
         </div>
           <div class="mt-minus-150 pb-120">
            <div class="container">
               <div class="row">
                  @include('user_card')
                  <div class="col-lg-8 mt-lg-0 mt-4">
                    <h3 class="title"><Customer Name></h3>
                     <div class="transaction-balance-wrapper">
                        <div class="left">
                           <div class="transaction-balance">
                              <h4 class="balance">{{ $customer->created_at->format('d-M-Y') ?? '' }}</h4>
                              <span>Joining Date</span>
                           </div>
                        </div>
                        @php
                        
                        @endphp

                        <div class="right">
                           <a href="#" class="transaction-action-btn">
                           <img src="{{URL::asset('images/icon/transaction/1.png') }}" alt="image">
                           <span>Amount Spent : {{$sale_cal}}</span>
                           </a>
                           <a href="#" class="transaction-action-btn ms-4">
                           <img src="{{URL::asset('images/icon/transaction/2.png') }}" alt="image">
                           <span>No.Of Ticket : {{$sale ?? '0'}}</span>
                           </a>
                        </div>
                     </div>
                     <!-- upcoming-draw-wrapper end -->
                     <div class="past-draw-wrapper">
                        <h3 class="title">My Loteery Ticket History</h3>
                        <div class="table-responsive-lg">
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
                                @foreach($customer_lottery as $customer_lott)  
                                @php
                                $ticket_cost = $customer_lott->price * $customer_lott->qty;
                                $ticket_cost = $ticket_cost - $customer_lott->discount;
                                $ticket_total_price = $ticket_cost + $customer_lott->tax;
                                @endphp
                                 <tr>
                                    <td>{{$sno++}}</td>
									<td><span class="contest-no">{{$customer_lott->lottery_name}}</span></td>
									<td><span class="date"> <p>{{$customer_lott->business_name}}</p>
                                        <p>{{$customer_lott->poc_first_name}}</p>
                                         <p>{{$customer_lott->poc_email}}</p>
                                          <p>{{$customer_lott->poc_mobile}}</p></span></td>
                                          
                                          <td>{{$ticket_total_price}}</td>
                                    <td><span class="fail">@if($customer_lott->status == 1) Active @else In-Active @endif</span></td>
                                 </tr>
                                @endforeach
                              </tbody>
                           </table>
                        </div>
                        <div class="load-more">
                           <button type="button">Show All My Lotteries <i class="las la-angle-down ml-2"></i></button>
                        </div>
                     </div>
                     <!-- past-draw-wrapper end -->
                  </div>
               </div>
            </div>
         </div>
            
         


@endsection