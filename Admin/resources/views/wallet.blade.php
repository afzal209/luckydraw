@extends('layout')
@section('title','Manage Business Partner Wallet')
@section('content')


               <ul class="breadcrumb">
                  <li><p>Dashboard</p></li>
                   <li><a href="#" class="active">Business Partners Wallet</a></li>
                  <li><a href="{{route('wallet_transaction')}}" class="active">View Transactions</a> </li>
               </ul>
               <div class="row-fluid">
                  <div class="span12">
                     <div class="grid simple ">
                        <div class="grid-title">
                           <h3><i class="fa fa-users"></i><span class="semi-bold"> Add Money to Business Partner Wallets</span></h3>
                        </div>
                        <div class="grid-body ">
                            <form class="row g-3 needs-validation" novalidate method="POST" action="{{route('wallet.add')}}" enctype="multipart/form-data">
                                  @csrf
                              <div class="row column-seperation">
                                 <div class="col-md-12">
                                    <div class="row form-row">
                                       <div class="col-md-3">
                                           <!--<input class="form-check-input" hidden name="tx_type" id="tx_type" value="2">-->
										   <select name="business_id" id="business_id" style="width:100%" required>
											  <option>Choose Business Partner</option>
											  @foreach($business_partner as $business_partners)
											  <option value="{{$business_partners->id}}">{{$business_partners->poc_first_name}}</option>
											  @endforeach
										   </select>
                                       </div>
                                       <div class="col-md-3">
                                          <input name="tx_date" id="tx_date" type="date" class="form-control" placeholder="Enter Tx Date" required>
                                       </div>
                                       <div class="col-md-3">
                                          <input name="amount" id="amount" type="text" class="form-control" placeholder="Enter Amount" required>
                                       </div> 
                                       <div class="col-md-3">
                                          <input name="tx_id" id="tx_id" type="text" class="form-control" placeholder="Tx ID" required>
                                       </div>
                                       <div class="col-md-4">
                                           <select name="tx_mode" id="tx_mode" style="width:100%" required>
											  <option>Mode of Transaction</option>
											  <option value="1">Paypal</option>
											  <option value="2">Skrill</option>
											  <option value="3">Bank</option>
											  <option value="4">Other</option>
										   </select>
                                       </div>
                                       <div class="col-md-4">
                                           <select name="tx_type" id="tx_type" style="width:100%" required>
											  <option>Type of Transaction</option>
											  <option value="1">Online</option>
											  <option value="2">Offline</option>
										   </select>
                                       </div>
                                       <div class="col-md-4">
                                           <select name="status" id="status" style="width:100%" required>
											  <option>Update Payment</option>
											  <option value="1">Success</option>
											  <option value="0">Under Process</option>
										   </select>
                                       </div>
                                        <div class="col-md-3">
                                          <input name="tx_proof" id="tx_proof" type="file" class="form-control" placeholder="Tx ID">
                                       </div>
                                       <div class="col-md-9">
                                          <input name="remarks" id="remarks" type="text" class="form-control" placeholder="Enter some information">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                                 <div class="pull-right">
                                    <button class="btn btn-success btn-cons" type="submit"><i class="fa fa-euro"></i> Add to Wallet</button>
                                 </div>                              
                              </form>
                        </div>
                     </div>
                  </div>
               </div>

@endsection

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    get_country($('#hidden_country'),$('#hidden_state'));
    // $('#city_id').on('change',function(){
    // console.log($(this).val());
   
// })
});

    function get_country(val,id){
     console.log(id)
     $('#state_id').html('');
    var country_id = $(val).val();
    var state_id = $(id).val();
    console.log(state_id);
   
    $.ajax({
            url: "{{ url('city/get_country') }}",
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
                "country_id" :  country_id,
                
            },
            success: function(data) {
                console.log(data);
                // console.log(data['doneMessage']);
                 $('#state_id').append('<option>Select State</option>')
                 $(data).each(function(key, value) {
                      var select = '';
                      if(state_id == value.id){
                          select = 'selected';
                      }
                      else{
                          select = '';
                      }
                    // console.log(value.address);
                    $('#state_id').append('<option value='+value.id+' '+select+'>'+value.state_title+'</option>')
                });
              

            }
        });
    }
</script>