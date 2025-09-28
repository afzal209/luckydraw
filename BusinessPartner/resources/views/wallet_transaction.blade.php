@extends('layout')
@section('title','Wallet Transaction')
@section('content')

     <div class="row gx-4">
                     <div class="col-xl-12 col-sm-12">
                        <!-- Card start -->
                        <div class="card">
                           <div class="card-header">
                            <div class="container">
                              <div class="row">
                                <div class="col-md-6"><h5 class="card-title">Wallet Transaction History</h5></div>
                                <div class="col-md-6"><span class="pull-right"><a href="{{route('wallet')}}"  class="btn btn-xs btn-success"><i class="bi bi-currency-euro"></i> Add Money to Wallet</a></span></div>
                              </div>
                            </div>
                           <div class="card-body">
                              <!-- Table start -->
                              <div class="table-outer">
                                 <div class="table-responsive">
                                    <table class="table truncate align-middle">
                                       <thead>
                                          <tr>
                                             <th>#</th>
                                             <th>Transaction ID</th>
                                             <th>Tx. Date</th>
											 <th>Tx. Type</th>
                                             <th>Amount</th>
                                             <th>Updated Date</th>
                                             <th>Status</th>
                                             <th>Remarks</th>
                                             <th>Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                            @php 
                                                $sn=1;
                                            @endphp
                                            @foreach($wallet as $wallets)
                                            
                                                @php 
                                                    $difference = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($wallets->created_at))
                                                  
                                                    
                                                                                          
                                                @endphp
                                                <tr>
                                                    <td>{{$sn++}}</td>
                                                    <td><img src="@if($wallets->tx_mode == 1) {{ str_replace("../../", request()->getSchemeAndHttpHost().'/',  \App\Models\Payment_Gateway::first()->paypal_preview_logo) }} @else {{$url}}/uploads/businesspartners/payment_proofs/{{$wallets->tx_proof}} @endif" style="width:100px;height:100px;"><br>{{$wallets->tx_id}}</td>
        											<td>{{$wallets->tx_date}}</td>
                                                    <td><span class="badge bg-primary">@if($wallets->tx_type == 1)Online @else Offline @endif</span></td>
                                                    <td><span class="badge border border-primary text-primary">Є{{$wallets->amount}}/-</span></td>
                                                    <td>{{$wallets->updated_at}}</td>
                                                    <td>@if($wallets->status == 1)<span class="badge bg-success"> Success @else <span class="badge bg-danger"> Pending @endif</span></td>
                                                    <td>
                                                        @php
                                                            $parts = mb_split("\s", $wallets->remarks);
                                                            $final_remarks = "";
                                                            $newLineCount = 10;
                                                            $wordsCount = 0;
                                                            foreach ($parts as $part) {
                                                                if($wordsCount < $newLineCount){
                                                                    $final_remarks = $final_remarks . " ". $part;
                                                                    $wordsCount +=1;
                                                                }else{
                                                                    $final_remarks = $final_remarks . "<br>". $part;
                                                                    $wordsCount = 0;
                                                                }
                                                            }
                                                            echo $final_remarks ;
                                                        @endphp
                                                    </td>
                                                    <td>
                                                         @if($wallets->status == 0)
                                                            @if($difference > 2)
                                                                <a type="button" class="btn btn-xs btn-warning" href="{{route('support')}}"><i class="bi bi-hand-thumbs-up"></i>  Raise a Dispute</a>
                                                            @else
                                                                <h5 style="color:red">Wait for Approval</h5> 
                                                            @endif
                                                         @endif
                                                    </td>
                                                </tr>
                                            @endforeach
			                           </tbody>
                                    </table>
                                 </div>
                              </div>
                              <!-- Table end -->
                           </div>
                        </div>
                        <!-- Card end -->
                     </div>
                  </div>
                  </div>


@endsection