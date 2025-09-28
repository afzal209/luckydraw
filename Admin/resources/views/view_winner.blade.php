@extends('layout')
@section('title','View Winners & Prizes')
@section('content')
<style>
.modal {
    z-index: 9999 !important;
}
.modal-backdrop {
    z-index: 9998 !important;
}
</style>
<ul class="breadcrumb">
    <li><a href="{{route('dashboard')}}" class="active">Dashboard</a> </li>
    <li><a href="{{route('luckydraws')}}" class="active">Manage Luckydraws</a> </li>
    <li><p>View Winners & Prizes</p></li>
</ul>
<div class="row-fluid">
   <div class="span12">
      <div class="grid simple ">
         <div class="grid-title">
            <h3><i class="fa fa-users"></i><span class="semi-bold"> Manage Winners & Prizes Transactions</span></h3>
         </div>
         <div class="grid-body ">
            <table class="table table-striped" id="example">
               <thead>
                  <tr>
                     <th>Sl.No</th>
                     <th>Ticket Id</th>
                     <th>Customer Details</th>
                     <th>Business Partner Details</th>
                     <th>Prize Deatils</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
@php $sn = 1; @endphp
@foreach($prize_distributions as $prize_distribution)
<tr class="odd gradeX">
    <td>{{ $sn++ }}</td>
    <td>{{ $prize_distribution->ticket_id }}</td>
    <td>
        {{ $prize_distribution->customer_first_name }} {{ $prize_distribution->customer_last_name }}
        {{ $prize_distribution->customer_email }} <br>
        {{ $prize_distribution->customer_mobile }} <br>
    </td>
    <td>
        {{ $prize_distribution->partner_first_name }} {{ $prize_distribution->partner_last_name }} <br>
        {{ $prize_distribution->partner_email }} <br>
        {{ $prize_distribution->partner_mobile }} <br>
    </td>
    <td>
        {{ $prize_distribution->amount }}
        {{ $prize_distribution->item }}
        @if($prize_distribution->image)
            <img src="{{ request()->getSchemeAndHttpHost() }}/uploads/luckydraw/prizes/{{ $prize_distribution->image }}" style="width:100px;height:100px;">
        @endif
    </td>
    <td>
        @if($prize_distribution->status == 1)
            Active
        @else
            Inactive
        @endif
        <br>
        @if($prize_distribution->tx_status == 1)
            <b>Transaction Details:</b><br>
            @if($prize_distribution->tx_remarks)
                {{ $prize_distribution->tx_remarks }}<br>
            @endif
            @if($prize_distribution->tx_proof)
                <img src="{{ request()->getSchemeAndHttpHost() }}/uploads/luckydraw/prizetransactions/{{ $prize_distribution->tx_proof }}" style="width:100px;height:100px;">
            @endif
        @endif
    </td>
    <td>
        @if($prize_distribution->tx_status == 0)
            <!-- Button to trigger modal -->
            <button class="btn btn-success" data-toggle="modal" data-target="#modal_{{ $prize_distribution->id }}">
                <i class="fa fa-file"></i>&nbsp;Update Prize Tx
            </button>
        @endif
    </td>
</tr>

<!-- Modal for this winner -->
<div class="modal fade" id="modal_{{ $prize_distribution->id }}" tabindex="-1" aria-labelledby="modalLabel_{{ $prize_distribution->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    Luckydraw Winner : <span class="luckydraw_manager_name">{{ $prize_distribution->customer_first_name }} {{ $prize_distribution->customer_last_name }}</span>
                </h4>
                <div style="text-align:center;"><h4 style="display:inline; color:blue;">Prize Distribution Transaction</h4></span>
        </div>
                
            </div>

            <div class="modal-body">
                <form class="form-no-horizontal-spacing" action="{{ route('luckydraw.update_prize_tx') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="view_winner_hidden_id" value="{{ $prize_distribution->id }}" />
                    <div class="row column-seperation">
                        <div class="col-md-12">
                            <h4>Transaction Proof Details</h4>
                            <div class="row form-row">
                                <div class="col-md-12">
                                    <textarea id="tx_remarks" name="tx_remarks" rows="4" cols="50" class="form-control"></textarea>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <input type="file" name="tx_proof" id="tx_proof" class="form-control-file" required>
                                    <p class="col-md-12">NOTE - Upload Transaction Proof</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" >
                        <div class="pull-right">
                            <button class="btn btn-success btn-cons" type="submit">
                                <i class="icon-ok"></i> Update Prize Tx
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach




@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    // Prize Distribution Proof
    $(document).ready(function() {
        $(".update-btn").click(function() {
            var recordId = $(this).data("id")
        
           // $("#myModal").modal("show")
        //alert(recordId);
        $.ajax({
                url: "{{ url('luckydraw/get_view_winner') }}",
                type: "GET",
                data: {
                    "token": "{{ csrf_token() }}",
                    "recordId": recordId,
                },
                success: function(response)
                {
                // alert(response.winner.id);
                $('.view_winner_hidden_id').val(response.winner.id);
                }
            });
          $("#myModal").modal("show");
           });
 
   }); 
</script>    