@extends('layout')
@section('title','Price Manager')
@section('content')


				  <ul class="breadcrumb">
					 <li><p>Dashboard</p></li>
					  <li><a href="#" class="active">Information Manager</a></li> 
					 <li><a href="#" class="active">Manage Prizes</a> </li>
				  </ul>
				  <!-- END FORM OPTIONS-->
				  <!-- BEGIN DROPDOWN CONTROLS-->
				  <div class="row form-row">
				      @if (session('error_count7'))
                            
                               <div class="alert alert-danger" role="alert">
                                   <form method="POST" action="{{ route('price_manager.clear') }}">
                                    @csrf
                                   <button type="submit" class='close'></button>
                                   </form>
            				{{ session('error_count7') }}
            			</div>
                            @endif
					 <form action="{{ isset($prize_manager_edit) ? route('price_manager.update', $prize_manager_edit->id) : route('price_manager.create') }}" method="POST"  id="form_traditional_validation" name="form_traditional_validation" role="form" autocomplete="off" class="validate" enctype="multipart/form-data">
					     @csrf
						<div class="col-md-12">
						   <div class="grid simple">
								<div class="grid-title">
								   <h3><i class="fa fa-flag"></i><span class="semi-bold">@if(isset($prize_manager_edit)) Update @else Add @endif Prize</span></h3>
								</div>
							  <div class="grid-body">
								 <div class="row form-row">
									<div class="col-md-3">
									   <p>Name of the Luckydraw</p>
									   <select name="template_id" id="template_id" style="width:100%" required>
										  <option>Choose Luckydraw</option>
										  @foreach($luckydraw as $luckydraws)
										    @if(isset($prize_manager_edit) && $luckydraws->id == $prize_manager_edit->template_id)
										        <option value="{{$luckydraws->id}}" selected>{{$luckydraws->luckydraw_name}}</option>
										    @else
										        <option value="{{$luckydraws->id}}">{{$luckydraws->luckydraw_name}}</option>
										    @endif
										  @endforeach 
									   </select>
									</div>
									<div class="col-md-3">
									   <p>Name of the Prize</p>
									   <input name="prize_name" id="prize_name" value="{{$prize_manager_edit->prize_name ?? ''}}" type="text" class="form-control" placeholder="Enter Luckydraw Prize Name. Ex: Benz Car" required>
									<label style="color:red;display:none;" class="error_log_name"></label>
									</div>
									<div class="col-md-3">
									   <p>Prize Code</p>
									   <input name="prize_code" id="prize_code" value="{{$prize_manager_edit->prize_code ?? ''}}" type="text" class="form-control" placeholder="Prize Code. Ex: ABC123" required>
									<label style="color:red;display:none;" class="error_log_code"></label>
									</div>
								    <div class="col-md-3">
										<p>Upload Prize Image</p>
										<input type="file" name="image" id="image">
										@if(isset($prize_manager_edit))
										    <img src="{{URL::asset($prize_manager_edit->prize_image)}}" style="width:100px;height:100px;">
										@endif
									</div>
								 </div>
								 @if(isset($prize_manager_edit))
                                    <input name="action_status" id="action_status" type="hidden" value="update" >
                                    <input name="b_area_id" id="b_area_id" type="hidden" value="{{$price_manager_edit->id ?? ''}}" >
                                    @else
                                    <input name="action_status" id="action_status" type="hidden" value="add" >
                                     <input name="b_area_id" id="b_area_id" type="hidden" value="" >
                                    @endif
								 <div class="form-actions">
									<div class="pull-right">
										 @if(isset($prize_manager_edit))
										    <button class="btn btn-success btn-cons" type="submit"><i class="icon-ok"></i> Update Prize</button>
										 @else 
										    <button class="btn btn-success btn-cons" type="submit"><i class="icon-ok"></i> Create Prize</button>
										 @endif
									     <button class="btn btn-warning btn-cons cancel-btn" type="reset" id="clear-btn"><i class="fa fa-eraser"></i> Clear</button>
									</div>
								 </div>
							  </div>
						   </div>
						</div>
					 </form>
				  </div>
				  <!-- END DROPDOWN CONTROLS-->
               <div class="row-fluid">
                  <div class="span12">
                     <div class="grid simple ">
                        <div class="grid-title">
                           <h3><i class="fa fa-flag-checkered"></i><span class="semi-bold"> View & Manage Prizes</span></h3>
                        </div>
                        <div class="grid-body ">
                           <table class="table table-striped" id="example">
                              <thead>
                                 <tr>
                                    <th>S.No</th>
                                    <th>Luckydraw Name</th>
                                    <th>Prize Name</th>
									<th>Prize Code</th>
                                    <th>Image</th>
									<th>Status</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                  @php 
                                  $sn = 1;
                                  @endphp
                                  @foreach($prize_manager as $price_managers)
                                 <tr>
                                    <td>{{$sn++}}</td>
									<td>{{$price_managers->luckydraw_name}}</td>
									<td>{{$price_managers->prize_name}}</td>
									<td>{{$price_managers->prize_code}}</td>
									<td><img src="{{URL::asset($price_managers->prize_image)}}" style="width:100px;height:100px;"></td>
									<td>
									    @if($price_managers->status == 1)
									    {{'Active'}}
									    @else
									    {{'Inactive'}}
									    @endif
									</td>
									
                                    <td class="center">
										<a href="{{ route('price_manager.edit', $price_managers->id) }}" class="btn btn-info" style="background:#885df1; border-radius:50px;"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
										@if($price_managers->status)
											<a href="{{ route('price_manager.status', ['id' => $price_managers->id, 'actions' => 1]) }}" class="btn btn-warning" style="border-radius:50px;"> <i class="fa fa-pause"></i>&nbsp;Suspend </a>
										@else
											<a href="{{ route('price_manager.status', ['id' => $price_managers->id, 'actions' => 0]) }}" class="btn btn-success" style="border-radius:50px;"> <i class="fa fa-play"></i>&nbsp;Unsuspend </a>
										@endif
										<a href="{{ route('price_manager.delete', $price_managers->id) }}" type="button" class="btn btn-danger" style="border-radius:50px;"><i class="fa fa-trash"></i>&nbsp;Delete</a>
									</td>
                                 </tr>
                                 @endforeach
							  </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
			

@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
   function check_val(){
       $('.error_log_name').text('');
        // console.log($(val).val());
        var prize_name = $('#prize_name').val(); 
        var prize_code = $('#prize_code').val();
        var action_status = $('#action_status').val();
        var b_area_id = $('#b_area_id').val();
        if(prize_name.length > 2 ){
             $.ajax({
            url: "{{ url('price_manager/validation') }}",
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
                "prize_name" :  prize_name,
                "prize_code" : prize_code,
                 "action_status" : action_status,
                "b_area_id" : b_area_id
            },
            success: function(data) {
                // console.log(data.action['field']);
                
                // if(data.action['field'] == 'name'){
                //     if(data.action['status'] == 1){
                //         $('.error_log_name').show();
                //         $('.error_log_name').text('This name is already exixts');
                        
                //         $('.btn-cons').prop('disabled', true);
                //     }
                //     else{
                //         $('.error_log_name').hide();
                //         $('.error_log_name').text('');
                //         $('.btn-cons').prop('disabled', false);
                //     }
                    
                // }
                
                // if(data.action1['field'] == 'code'){
                //     if(data.action1['status'] == 1){
                //         $('.error_log_code').show();
                //         $('.error_log_code').text('This code is already exixts');
                //         $('.btn-cons').prop('disabled', true);
                //     }
                //     else{
                //         $('.error_log_code').hide();
                //         $('.error_log_code').text('');
                //         $('.btn-cons').prop('disabled', false);
                //     }
                // }
                
                let isNameValid = true;
                let isCodeValid = true;
                
                // Check name validation
                if(data.action['field'] == 'name'){
                    if(data.action['status'] == 1){
                        $('.error_log_name').show();
                        $('.error_log_name').text('This name is already exists');
                        isNameValid = false;
                    } else {
                        $('.error_log_name').hide();
                        $('.error_log_name').text('');
                    }
                }
                
                // Check code validation
                if(data.action1['field'] == 'code'){
                    if(data.action1['status'] == 1){
                        $('.error_log_code').show();
                        $('.error_log_code').text('This code is already exists');
                        isCodeValid = false;
                    } else {
                        $('.error_log_code').hide();
                        $('.error_log_code').text('');
                    }
                }
                
                // Enable button only if both name and code are valid (status 0)
                $('.btn-cons').prop('disabled', !(isNameValid && isCodeValid));
             
               
             

            }
        });
        }
        
    }
    
    $('#prize_name, #prize_code').on('keyup',check_val);
    
})

 
</script>