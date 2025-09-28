@extends('layout')
@section('title','Business Partners Wallet')
@section('content')


               <ul class="breadcrumb">
                  <li><p>Dashboard</p></li>
                   <li><a href="#" class="active">Business Partners</a></li>
                  <li><a href="#" class="active">Manage Wallet</a> </li>
               </ul>
               
			   <div class="row-fluid">
                  <div class="span12">
                     <div class="grid simple ">
                        <div class="grid-title">
                            <div class="row">
                                <div class="col-md-6"><h5 class="card-title">Wallet Transaction History</h5></div>
                                <div class="col-md-6"><span class="pull-right"><a href="{{route('wallet')}}"  class="btn btn-xs btn-success"><i class="bi bi-currency-euro"></i> Add Money to Wallet</a></span></div>
                            </div>
                        </div>
                        <div class="grid-body ">
                                    <table class="table truncate align-middle">
                                       <thead>
                                          <tr>
                                             <th>#</th>
                                             <th>Transaction ID</th>
                                             <th>BP Details</th>
											 <th>Dates</th>
                                             <th>Amount</th>
                                             <th>Tx. Type</th>
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
                                                
                                                    $business_partner = App\Models\Business_Partner::find($wallets->bp_id);                                                
                                                    $difference = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($wallets->created_at))
                                                @endphp
                                                <tr>
                                                    <td>{{$sn++}}</td>
                                                    <td><img src="{{$url}}/uploads/businesspartners/payment_proofs/{{$wallets->tx_proof}}" style="width:100px;height:100px;"><br>{{$wallets->tx_id}}</td>
        									        <td>
        									            {{$business_partner->poc_first_name ?? ''}}<br>
        									            {{$business_partner->poc_email ?? ''}}<br>
        									            {{$business_partner->poc_mobile ?? ''}}<br>
        									            {{$business_partner->business_name ?? ''}}
        									        </td>
        											<td>
        											    Tx Date : {{$wallets->tx_date ?? ''}}<br>
        											    Tx Date : {{$wallets->updated_at ?? ''}}
        											</td>
                                                    <td><span class="badge border border-primary text-primary">Є{{$wallets->amount}}/-</span></td>
                                                    <td><span class="badge bg-primary">@if($wallets->tx_type == 1)Online @else Offline @endif</span></td>
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
                                                        @if($wallets->tx_type == 2)
                                                            @if($wallets->status == 0)
                                                                <a href="{{ route('wallet_transaction.approve_wallet',$wallets->id) }}"  class="btn btn-xs btn-success" ><i class="bi bi-hand-thumbs-up"></i>Approve</a>
                                                                <button  type="button" class="btn btn-xs btn-warning update-btn" data-id="{{ $wallets->id }}" data-status="0" data-toggle="modal" data-target="#myModal"><i class="bi bi-hand-thumbs-up"></i>Reject</a>
                                                            
                                                            @elseif($wallets->status == 2)
                                                            <h5 style="color:red">Rejected</h5>
                                                            @else
                                                                <h5 style="color:green">Approved</h5> 
                                                            @endif
                                                        @else
                                                            @if($wallets->status == 0)
                                                            <h5 style="color:green">Pending</h5> 
                                                            @elseif($wallets->status == 1) 
                                                            <h5 style="color:red">Approved</h5>
                                                            @else
                                                            <h5 style="color:red">Rejected</h5>
                                                            @endif
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
            

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
          <form id="statusUpdateForm">
              
          @csrf
           <input type="hidden" name="record_id" id="record_id">
        <div class="form-group">
          <label for="sel1">Remarks for Rejection<font color="red">*</font></label>
            <textarea id="remarks" name="remarks" rows="4" style="width: 100%;" placeholder="Write here why do you reject the transaction. Ex: Wrong TX slip shared." required></textarea>
        </div>        
        <!--<div class="form-group">-->
        <!--  <label for="sel1">Select list<font color="red">*</font></label>-->
        <!--  <select class="form-control" name="status" id="status" required>-->
        <!--    <option>Choose Status</option>-->
        <!--    <option value="0">Pending</option>-->
        <!--    <option value="1">Approved</option>-->
        <!--  </select>-->
        <!--</div>        -->
        <button type="submit" class="btn btn-success" >Update</button>
        </form>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
          
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
   
    $(".update-btn").click(function () {
        var recordId = $(this).data("id");
        var currentStatus = $(this).data("status");

        $("#record_id").val(recordId);
        $("#status").val(currentStatus);
      
    });
    
   
   
    $("#statusUpdateForm").submit(function (e) {
        e.preventDefault();
        var recordId = $("#record_id").val();
        var status = $("#status").val();
        var remarks = $("#remarks").val();
        

        $.ajax({
            url: "wallet_transaction/reject_wallet/" + recordId,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                status: status,
                remarks: remarks,
               
            },
            success: function (response) {
                if (response.success) {
                    alert("Status updated successfully!");
                    location.reload();
                } else {
                    alert("Error updating status!");
                }
            }
        });
    });
   
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