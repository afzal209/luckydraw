@extends('layout')
@section('title','User Referral')
@section('content')

@php 
    $user = Session::get('user');
    
@endphp
<div class="inner-hero-section style--five">
         </div>
           <!-- inner-hero-section end -->
         <!-- user section start -->
         <div class="mt-minus-150 pb-120">
            <div class="container">
               <div class="row">
                  @include('user_card')
                  <div class="col-lg-8 mt-lg-0 mt-4">
                     <div class="referral-link-wrapper">
                        <h3 class="title">Referral</h3>
                        <div class="copy-link">
                           <span class="copy-link-icon"><i class="las la-link"></i></span>
                           <span class="label">Referral Link :</span>
                           <div class="copy-link-inner">
                              <form data-copy=true>
                                 <input type="text" value="https://ubglottery.com/?ref={{$user['customer_id']}}" data-click-select-all>
                                 <input type="submit" value="Copy Link">
                              </form>
                           </div>
                        </div>
                     </div>
                     <div class="referral-transaction">
                        <div class="all-transaction__header">
                           <h3 class="title">All Agencies/Ticket Sellers:</h3>
                           <div class="date-range">
                              <input type="text" data-range="true" data-multiple-dates-separator=" - " data-language="en" class="datepicker-here form-control" data-position='top left' placeholder="min - max date">
                              <i class="las la-calendar-alt"></i>
                           </div>
                        </div>
                        <div class="table-responsive-lg">
                           <table>
                              <thead>
                                 <tr>
                                    <th>Sl.No</th>
                                    <th>Agency</th>
                                    <th>Address</th>
                                    <th>Contact Details</th>
                                 </tr>
                              </thead>
                              <tbody>
                                  @php
                                  $sno = 1;
                                  @endphp
                                  @foreach($business_partner as $business_partners)
                                 <tr>
                                    <td><div class="date"><span>{{$sno++}}</span></div></td>
                                    <td>{{$business_partners->business_name}}</td>
                                    <td>{{$business_partners->address_line_1}}<br>{{$business_partners->address_line_2}}</td>
                                    <td>{{$business_partners->poc_first_name}} {{$business_partners->poc_last_name}} <br>{{$business_partners->poc_email}}<br>{{$business_partners->poc_mobile}}</td>
                                 </tr>
                                 @endforeach
                                 <!--<tr>-->
                                 <!--   <td><div class="date"><span>1</span></div></td>-->
                                 <!--   <td>XYZ Lottery</td>-->
                                 <!--   <td>3 Eastbourne Rd, Burwick, UK</td>-->
                                 <!--   <td>+070 1234 5678 <br>xyz.lottery@Ukemail.uk</td>-->
                                 <!--</tr>-->
                              </tbody>
                           </table>
                        </div>
                        <div class="load-more">
                           <button type="button">Show More Lotteries <i class="las la-angle-down ml-2"></i></button>
                        </div>
                     </div>
                     <div class="referral-transaction">
                        <div class="all-transaction__header">
                           <h3 class="title">My Agencies/Ticket Sellers:</h3>
                           <div class="date-range">
                              <input type="text" data-range="true" data-multiple-dates-separator=" - " data-language="en" class="datepicker-here form-control" data-position='top left' placeholder="min - max date">
                              <i class="las la-calendar-alt"></i>
                           </div>
                        </div>
                        <div class="table-responsive-lg">
                           <table>
                              <thead>
                                 <tr>
                                    <th>Sl.No</th>
                                    <th>Agency</th>
                                    <th>Address</th>
                                    <th>Contact Details</th>
                                 </tr>
                              </thead>
                              <tbody>
                                  @php
                                  $sno = 1;
                                  @endphp
                                  @foreach($results as $result)
                                 <tr>
                                    <td><div class="date"><span>{{$sno++}}</span></div></td>
                                    <td>{{$result->business_name}}</td>
                                    <td>{{$result->address_line_1}}<br>{{$result->address_line_2}}</td>
                                    <td>{{$result->poc_first_name}} {{$result->poc_last_name}} <br>{{$result->poc_email}}<br>{{$result->poc_mobile}}</td>
                                 </tr>
                                 @endforeach
                                 <!--<tr>-->
                                 <!--   <td><div class="date"><span>1</span></div></td>-->
                                 <!--   <td>XYZ Lottery</td>-->
                                 <!--   <td>3 Eastbourne Rd, Burwick, UK</td>-->
                                 <!--   <td>+070 1234 5678 <br>xyz.lottery@Ukemail.uk</td>-->
                                 <!--</tr>-->
                              </tbody>
                           </table>
                        </div>
                        <div class="load-more">
                           <button type="button">Show More Lotteries <i class="las la-angle-down ml-2"></i></button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- user section end -->
      </div>
@endsection