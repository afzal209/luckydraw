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
                  <div class="col-lg-9 mt-lg-0 mt-4">
                     <div class="transaction-balance-wrapper">
                        <div class="left">
                            @php
                            $user = Session::get('user')
                            @endphp
                            <ul class="user-info-card__list">
                                <form action ="{{route('insert_support')}}" method="POST">
                                    <font color="white">Please raise a ticket and our support team will ectify your issue asap.</font>
                                    @csrf
                                    <input type="hidden" name="customer_id" id="customer_id" value="{{$user['customer_id']}}" />
                                   <li>
                                      <span class="caption">Category</span>
                                      <span class="value">
                                          <!--<input type="text" name="subject" id="subject" placeholder="Enter Subject">-->
                                          <select id="categoryid" name="categoryid">
                                              <option></option>
                                              @foreach($support_categories as $support_category)
                                              <option value="{{$support_category->id}}">{{$support_category->name}}</option>
                                              @endforeach
                                          </select>
                                          
                                          </span>
                                   </li>
                                   <li>
                                      <span class="caption">Subject</span>
                                      <span class="value"><input type="text" name="subject" id="subject" placeholder="Enter Subject"></span>
                                   </li>
                                   <li>
                                      <span class="caption">Description</span>
                                      <span class="value"><textarea name="description" id="description" placeholder="Enter Description"></textarea></span>
                                   </li>                                       
                                   <li>
                                       <input type="submit" name="submit" id="submit" value="Submit" />
                                   </li>
                                </form>
                            </ul>
                        </div>
                        <div class="right">
                           <a href="#" class="transaction-action-btn">
                           <img src="{{URL::asset('images/icon/transaction/1.png') }}" alt="image">
                           <span>Total Tickets {{$total_ticket}}</span>
                           </a>
                           <a href="#" class="transaction-action-btn ms-4">
                           <img src="{{URL::asset('images/icon/transaction/2.png') }}" alt="image">
                           <span>Closed Tickets {{$close_ticket}}</span>
                           </a>
                        </div>
                     </div>
                     <!-- transaction-balance-wrapper end -->
                     <div class="all-transaction">
                        <div class="all-transaction__header">
                           <h3 class="title">All Support Tickets</h3>
                        </div>
                        <div class="table-responsive-xl">
                           <table>
                              <thead>
                                 <tr>
                                    <th>Sl.No</th>
                                    <th>Category</th>
                                    <th>Subject</th>
                                    <th>Description</th>
                                    <th>Dates</th>
                                    <th>Status</th>
                                 </tr>
                              </thead>
                              <tbody>
                                  @php
                                  $sno = 1;
                                  @endphp
                                  @foreach($support_data as $support_dt)
                                 <tr>
                                    <td><p>{{$sno++}}</p></td>
                                    <td>
                                        <span class="amount minus-amount"><p>{{$support_dt->category_name}}</p></span>
                                    </td>
                                    <td>
                                       
                                        <span class="amount minus-amount"><p>{{$support_dt->subject}}</p></span>
                                    </td>
                                    <td>
                                        <span class="amount minus-amount"><p>{{$support_dt->description}}</p></span>
                                    </td>
                                    <td>
                                        <span class="amount minus-amount">Raised On {{\Carbon\Carbon::parse($support_dt->created_at)->format('d M Y') }}</span><br>
                                        <span class="amount minus-amount">Updated On {{\Carbon\Carbon::parse($support_dt->updated_at)->format('d M Y') ?? '' }}</span>
                                    </td>
                                    <td>
                                        @if($support_dt->status == 0)
                                        Open
                                        @elseif($support_dt->status == 1)
                                        Assigned
                                        @else
                                        Closed
                                        @endif
                                        <!--<div class="status-pending"><i class="fas fa-ellipsis-h"></i></div>-->
                                    </td>
                                 </tr>
                                 @endforeach
                              </tbody>
                           </table>
                        </div>
                        <!--<div class="load-more">-->
                        <!--   <button type="button">Show All Transactions<i class="las la-angle-down ml-2"></i></button>-->
                        <!--</div>-->
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- user section end -->
@endsection