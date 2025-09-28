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
                                    <th>Lottery</th>
                                    <th>Tx Details</th>
                                    <th>Status</th>
                                 </tr>
                              </thead>
                              <tbody>
                                  @php use Carbon\Carbon; @endphp
                                @php
                                $sn = 1;
                                @endphp
                                @foreach($customer_lottery as $customer_lott)  
                                 <tr>
                                    <td>{{$sn++}}</td>
									<td><span class="contest-no">{{$customer_lott->lottery_name}}</span></td>
									<td><span class="date">{{ Carbon::parse($customer_lott->created_at)->format('d-m-y') }}</span></td>
                                    <td><span class="fail">@if($customer_lott->winner_status ==1) WON @else NO WIN @endif</span></td>
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