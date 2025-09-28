@extends('layout')
@section('title','Customer Edit')
@section('content')
<ul class="breadcrumb">
  <li><p>Dashboard</p></li>
   <li><a href="#" class="active">Information Manager</a></li>
  <li><a href="#" class="active"> Edit Customer</a> </li>
</ul>
<div class="row-fluid">
  <div class="span12">
	 <div class="grid simple ">
		<div class="grid-title">
		   <h3><i class="fa fa-users"></i><span class="semi-bold">Edit Customer</span></h3>
		</div>
		<div class="grid-body ">
		   <form class="form-no-horizontal-spacing" id="form-condensed" action="{{route('customer.update', $customer_edit->id) }}" method="POST">
			  @csrf
			  <div class="row column-seperation">
				 <div class="col-md-6">
					<div class="row form-row">
					   <div class="col-md-4">
						   <input name="first_name" id="first_name" type="text" class="form-control" value="{{$customer_edit->first_name ?? ''}}" placeholder="Enter City Name">
					   </div>   
					   <div class="col-md-4">
						   <input name="email" id="email" type="text" class="form-control" value="{{$customer_edit->email ?? ''}}" placeholder="Enter City Name">
					   </div>
					   <div class="col-md-4">
						  <input name="mobile" id="mobile" type="text" class="form-control" value="{{$customer_edit->mobile ?? ''}}" placeholder="Enter City Name">
					   </div>
					</div>
				 </div>
				 <div class="pull-right">
					<button class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i> Update</button>
					<button class="btn btn-warning btn-cons cancel-btn" type="reset" id="clear-btn"><i class="fa fa-eraser"></i> Clear</button>
				 </div>
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