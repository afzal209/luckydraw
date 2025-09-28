@extends('layout')
@section('title','Template Manager')
@section('content')


				  <ul class="breadcrumb">
					 <li><p>Dashboard</p></li>
					  <li><a href="#" class="active">Information Manager</a></li>
					 <li><a href="#" class="active">Create a New Luckydraw Template</a> </li>
				  </ul>
				  <!-- END FORM OPTIONS-->
				  <!-- BEGIN DROPDOWN CONTROLS-->
				  <div class="row form-row">
				      @if (session('error_count6'))
                            
                               <div class="alert alert-danger" role="alert">
                                   <form method="POST" action="{{ route('template_manager.clear') }}">
                                    @csrf
                                   <button type="submit" class='close'></button>
                                   </form>
            				{{ session('error_count6') }}
            			</div>
                            @endif
				      
					 <form action="{{ isset($template_manager_edit) ? route('template_manager.update', $template_manager_edit->id) : route('template_manager.create') }}" method="POST" id="form_traditional_validation" name="form_traditional_validation" role="form" autocomplete="off" class="validate" enctype="multipart/form-data">
						@csrf
						<div class="col-md-12">
						   <div class="grid simple">
								<div class="grid-title">
								    <h3><i class="fa fa-file"></i><span class="semi-bold">@if(isset($template_manager_edit)) Update @else Add @endif Luckydraw Template</span></h3>
								</div>
							  <div class="grid-body">
								 <div class="row form-row">
									<div class="col-md-3">
									   <p>Name of the Luckydraw Template<font color="red">*</font></p>
									   <input name="template_name" id="template_name" type="text" value="{{$template_manager_edit->template_name ?? ''}}" class="form-control" placeholder="Luckydraw Template Name. Ex: New Year" required>
									<label style="color:red;display:none;" class="error_log_name"></label>
									</div>
									<div class="col-md-3">
									   <p>Template Code<font color="red">*</font></p>
									   <input name="template_code" id="template_code" type="text" value="{{$template_manager_edit->template_code ?? ''}}" class="form-control" placeholder="Template Code. Ex: ABC123" required>
									    <label style="color:red;display:none;" class="error_log_code"></label>
									</div>
								    <div class="col-md-6">
										<p>Upload Template Image<font color="red">*</font></p>
										<input type="file" name="image" id="image" required>
										@if(isset($template_manager_edit))
										<img src="{{request()->getSchemeAndHttpHost()}}/uploads/luckydraw/templates/{{$template_manager_edit->template_image}}" style="width:100px;height:100px;">
										@endif
									</div>
								 </div>
								  @if(isset($template_manager_edit))
                                    <input name="action_status" id="action_status" type="hidden" value="update" >
                                    <input name="b_area_id" id="b_area_id" type="hidden" value="{{$template_manager_edit->id ?? ''}}" >
                                    @else
                                    <input name="action_status" id="action_status" type="hidden" value="add" >
                                     <input name="b_area_id" id="b_area_id" type="hidden" value="" >
                                    @endif
								 <div class="form-actions">
									<div class="pull-right">
									    @if(isset($template_manager_edit))
											<button class="btn btn-success btn-cons" type="submit"><i class="fa fa-refresh"></i> Update Luckydraw Template</button>
									    @else
											<button class="btn btn-success btn-cons" type="submit"><i class="fa fa-gift"></i> Create Luckydraw Template</button>
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
                           <h3><i class="fa fa-file-text"></i><span class="semi-bold"> View & Manage Luckydraw's Templates</span></h3>
                        </div>
                        <div class="grid-body ">
                           <table class="table table-striped" id="example">
                              <thead>
                                 <tr>
                                     <th>S.No</th>
                                    <th>Template Name</th>
									<th>Template Code</th>
                                    <th>Image</th>
									<th>Status</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                    @php 
                                  $sn = 1;
                                  @endphp
                                  @foreach($template_manager as $template_managers)
                                 <tr>
                                    <td>{{$sn++}}</td>
									<td>{{$template_managers->template_name}}</td>
									<td>{{$template_managers->template_code}}</td>
									<td><img src="{{request()->getSchemeAndHttpHost()}}/uploads/luckydraw/templates/{{$template_managers->template_image}}" style="width:100px;height:100px;"></td>
									<td>
									    @if($template_managers->status == 1)
											{{'Active'}}
									    @else
											{{'Inactive'}}
									    @endif
									</td>
									
                                    <td class="center">
										<a href="{{ route('template_manager.edit', $template_managers->id) }}" class="btn btn-info" style="background:#885df1; border-radius:50px;"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
										@if($template_managers->status)
											<a href="{{ route('template_manager.status', ['id' => $template_managers->id, 'actions' => 1]) }}"  class="btn btn-warning" style="border-radius:50px;"> <i class="fa fa-pause"></i>&nbsp;Suspend</a>
										@else
											<a href="{{ route('template_manager.status', ['id' => $template_managers->id, 'actions' => 0]) }}" class="btn btn-success" style="border-radius:50px;"><i class="fa fa-play"></i>&nbsp;Unsuspend</a>
										@endif
										<a href="{{ route('template_manager.delete', $template_managers->id) }}" type="button" class="btn btn-danger" style="border-radius:50px;"><i class="fa fa-trash"></i>&nbsp;Delete</a>
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
        var template_name = $('#template_name').val(); 
        var template_code = $('#template_code').val();
        var action_status = $('#action_status').val();
        var b_area_id = $('#b_area_id').val();
        if(template_name.length > 2 ){
             $.ajax({
            url: "{{ url('template_manager/validation') }}",
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
                "template_name" :  template_name,
                "template_code" : template_code,
                "action_status" : action_status,
                "b_area_id" : b_area_id
            },
            success: function(data) {
                
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
    
    $('#template_name, #template_code').on('keyup',check_val);
    
})

 
</script>