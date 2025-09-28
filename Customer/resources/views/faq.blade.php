@extends('layout')
@section('title','Faq')
@section('content')


 <div class="inner-hero-section style--five">
         </div>
           <div class="mt-minus-150 pb-120">
            <div class="container">
               <div class="row">
                  @include('user_card')
                  <div class="col-lg-8 mt-lg-0 mt-4">
                    <h3 class="title"><Customer Name></h3>
                     
                     <!-- upcoming-draw-wrapper end -->
                     <div class="past-draw-wrapper">
                        <h3 class="title">My Loteery Ticket History</h3>
                        <div class="table-responsive-lg">
                           <table>
                              <thead>
                                 <tr>
                                    <th>Sl.No</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>for</th>
                                    <th>Status</th>
                                 </tr>
                              </thead>
                              <tbody>
                                  @php 
                                  $sno = 1;
                                  @endphp
                                @foreach($faqs as $faq)  
                            
                                 <tr>
                                    <td>{{$sno++}}</td>
									<td><span class="contest-no">{{$faq->question}}</span></td>
									<td><span class="date"> <p>{{$faq->answer}}</p></span></td>
                                          
                                          <td>@if($faq->for == 1) BP  @elseif($faq->for) Customer @elseif($faq->for) staff @else Other @endif</td>
                                    <td><span class="fail">@if($faq->status == 1) Active @else In-Active @endif</span></td>
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