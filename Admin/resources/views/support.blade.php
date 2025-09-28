@extends('layout')
@section('title','Manage Tech Support')
@section('content')
<style>
    .select2-container--default .select2-results__option {
        padding-left: 25px;
        position: relative;
    }
    .select2-container--default .select2-results__option::before {
        content: "";
        display: inline-block;
        position: absolute;
        left: 5px;
        top: 7px;
        width: 14px;
        height: 14px;
        border: 1px solid #ccc;
        background-color: #fff;
    }
    .select2-container--default .select2-results__option[aria-selected=true]::before {
        background-color: #007bff;
        border-color: #007bff;
    }
</style>

<ul class="breadcrumb">
    <li><p>Dashboard</p></li>
    <li><a href="#" class="active">Manage Support</a> </li>
</ul>
					
<!-- END DROPDOWN CONTROLS-->
<div class="row-fluid">
    <div class="span12">
        <div class="grid simple ">
            <div class="grid-title">
            	<h3><i class="fa fa-file"></i><span class="semi-bold"> View & Manage Support Tickets</span></h3>
            </div>
            <div class="grid-body ">
            	<table class="table table-striped" id="example">
            		<thead>
            			<tr>
                            <th>Ticket Details</th>
                            <th>Dates</th>
                            <th>Owner</th>
                            <th>Subject</th>
                            <th>Message</th>							  
                            <th>Status</th>
                            <th>Action</th>
            			</tr>
            		</thead>
            		<tbody>
                        @foreach($support_category_view as $support_categorys)
                        @php 
                        $business_partner = App\Models\Business_Partner::find($support_categorys->raised_by_id)
                    
                        @endphp
                            <tr>
                                <td><span class="badge border border-primary text-primary">{{$support_categorys->support_ticket_id}}</span><br>Category: {{$support_categorys->category_name}}</td>
                                <td>Created On : {{$support_categorys->created_at}}<br>Updated On : {{$support_categorys->updated_at}}</td>
                                <td>
                                    @if($support_categorys->raised_by == 1)
                                        {{$business_partner->poc_first_name}}<br>
    						            {{$business_partner->poc_email}}<br>
    						            {{$business_partner->poc_mobile}}<br>
    						            {{$business_partner->business_name}}
						           @else
						                @php 
						                $customer = App\Models\Customer::where('customer_id',$support_categorys->raised_by_id)->first();
						                @endphp
						                {{$customer->first_name	}}
						                {{$customer->email}}
						                {{$customer->mobile}}
						            @endif
						        </td>
                                <td>{{$support_categorys->subject}}</td>
                                <td>{{$support_categorys->description}}</td>
                                <td>
                                    @if($support_categorys->status  == 0)
                                        {{'Open'}}
                                    @elseif($support_categorys->status  == 1)
                                        {{'Under Process'}}
                                    @else
                                        {{'Closed'}}
                                    @endif
                                </td>
                                <td>
                                    @if($support_categorys->status  == 0 OR $support_categorys->status  == 1)
                                        <button class="btn btn-success btn-cons update-btn" id="icon" type="submit" data-id="{{ $support_categorys->id }}" data-status="{{ $support_categorys->status }}"><i class="icon-ok" ></i> Update</button>
                                    @endif
                                    <a href="{{ route('support.delete', $support_categorys->id) }}" type="button" class="btn btn-danger" style="border-radius:50px;"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                                </td>
                            </tr>
                        @endforeach
            		</tbody>
            	</table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Ticket Status</h4>
      </div>
      <div class="modal-body">
        <form id="statusUpdateForm">
          @csrf
          <input type="hidden" name="record_id" id="record_id">
          <input type="hidden" name="updated_by" id="updated_by" value="admin">
            <div class="mb-6">
                <div class="form-group">
                  <label for="sel1">Reply Message for Ticket</label>
                    <textarea id="reply" name="reply" rows="4" style="width: 100%;" placeholder="Write the proper reply here for the ticket"></textarea>
                </div> 
            </div>
            <div class="mb-6">
                <label for="status" class="form-label">Select Status</label>
                <select class="form-control" name="status" id="status">
                  <option value="0">Open</option>
                  <option value="1">Under Process</option>
                  <option value="2">Closed</option>
                </select>
            </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function () {
    $(".update-btn").click(function () {
        var recordId = $(this).data("id");
        var currentStatus = $(this).data("status");

        $("#record_id").val(recordId);
        $("#status").val(currentStatus);
        $("#updateStatusModal").modal("show");
    });
    
    
     $("#statusUpdateForm").submit(function (e) {
        e.preventDefault();
        var recordId = $("#record_id").val();
        var status = $("#status").val();
        var reply = $("#reply").val();
        var updatedBy = $("#updated_by").val();

        $.ajax({
            url: "support/update_support/" + recordId,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                status: status,
                reply: reply,
                updated_by: updatedBy
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

});
</script>



