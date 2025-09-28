@extends('layout')
@section('title','State')
@section('content')

   <ul class="breadcrumb">
      <li><p>Dashboard</p></li>
       <li><a href="#" class="active">Information Manager</a></li>
      <li><a href="#" class="active">Manage States</a> </li>
   </ul>
   <div class="row-fluid">
      <div class="span12">
         <div class="grid simple ">
            <div class="grid-title">
               <h3><i class="fa fa-map-o"></i><span class="semi-bold">@if(isset($business_area_edit)) Update @else Add @endif State</span></h3>
            </div>
            <div class="grid-body ">
                 @if (session('error_count4'))
                            
                               <div class="alert alert-danger" role="alert">
                                   <form method="POST" action="{{ route('state.clear') }}">
                                    @csrf
                                   <button type="submit" class='close'></button>
                                   </form>
            				{{ session('error_count4') }}
            			</div>
                            @endif
               <form class="form-no-horizontal-spacing" id="form-condensed" action="{{ isset($state_edit) ? route('state.update', $state_edit->id) : route('state.create') }}" method="POST" id="form_traditional_validation" name="form_traditional_validation" role="form" autocomplete="off" class="validate">
                  @csrf
                  <div class="row column-seperation">
                     <div class="col-md-6">
                        <div class="row form-row">
                           <div class="col-md-6">
							   <select name="country_id" id="country_id" class="select2" style="width:100%" required>
								  <option value="">Choose Country</option>
                                    @foreach($country as $countrys)
                                        @if(isset($state_edit) && $countrys->id == $state_edit->country_id)
                                            <option value="{{$countrys->id}}" selected>{{$countrys->country_name}}</option>
                                        @else
                                            <option value="{{$countrys->id}}">{{$countrys->country_name}}</option>
                                        @endif
                                    @endforeach
							   </select>
                           </div>
                           <div class="col-md-6">
                              <input name="state_title" id="state_title" type="text" class="form-control" placeholder="Enter State Name" value="{{$state_edit->state_title ?? ''}}" required>
                            <label style="color:red;display:none;" class="error_log_name"></label>
                           </div>
                        </div>
                     </div>
                     
                      @if(isset($state_edit))
                        <input name="action_status" id="action_status" type="hidden" value="update" >
                        <input name="b_area_id" id="b_area_id" type="hidden" value="{{$state_edit->id ?? ''}}" >
                        @else
                        <input name="action_status" id="action_status" type="hidden" value="add" >
                         <input name="b_area_id" id="b_area_id" type="hidden" value="" >
                        @endif
                     <div class="pull-right">
                          @if(isset($state_edit))
							<button class="btn btn-danger btn-cons" type="submit"><i class="fa fa-refresh"></i> Update</button>
                          @else
							<button class="btn btn-danger btn-cons" type="submit"><i class="fa fa-flag"></i> Create State</button>
                          @endif
						  <button class="btn btn-warning btn-cons cancel-btn" type="reset" id="clear-btn"><i class="fa fa-eraser"></i> Clear</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <div class="row-fluid">
      <div class="span12">
         <div class="grid simple ">
            <div class="grid-title">
               <h3><i class="fa fa-map-o"></i><span class="semi-bold"> View & Manage States</span></h3>
            </div>
            <div class="grid-body ">
               <table class="table table-striped" id="example">
                  <thead>
                     <tr>
                        <th>S.No</th>
                        <th>Country Name</th>
						<th>State</th>
						<th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                    @php 
                      $sn = 1;
                      @endphp
                    @foreach($state as $states)
                     <tr>
                        <td>{{$sn++}}</td>
						<td>{{$states->country_name}}</td>
						<td>{{$states->state_title}}</td>
						<td>
						    @if($states->status == 1)
						    {{'Active'}}
						    @else
						    {{'Inactive'}}
						    @endif
						</td>
						
                        <td class="center">
							<a href="{{ route('state.edit', $states->id) }}" class="btn btn-info" style="background:#885df1; border-radius:50px;"onclick="return confirm('Do you want to Edit State?')"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
							@if($states->status)
							    <a href="{{ route('state.status', ['id' => $states->id, 'actions' => 1]) }}" class="btn btn-warning" style="border-radius:50px;"><i class="fa fa-pause"></i>&nbsp;Suspend</a>
							@else
							    <a href="{{ route('state.status', ['id' => $states->id, 'actions' => 0]) }}" class="btn btn-success" style="border-radius:50px;"><i class="fa fa-play"></i>&nbsp;Unsuspend</a>
							@endif
						    <a href="{{ route('state.delete', $states->id) }}" type="button" class="btn btn-danger" style="border-radius:50px;"onclick="return confirm('Do you want to Delete State?')"><i class="fa fa-trash"></i>&nbsp;Delete</a>
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
        var state_title = $('#state_title').val(); 
        var action_status = $('#action_status').val();
        var b_area_id = $('#b_area_id').val();
        
        if(state_title.length > 2 ){
             $.ajax({
            url: "{{ url('state/validation') }}",
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
                "state_title" :  state_title,
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
                
                
                // Enable button only if both name and code are valid (status 0)
                $('.btn-cons').prop('disabled', !(isNameValid));
             
               
             

            }
        });
        }
        
    }
    
    $('#state_title').on('keyup',check_val);
    
})
    $('.cancel-btn').on('click', function(e) {
        e.preventDefault();
        if (confirm("Do you want to Cancel this Edit?")) {
            $('#form-condensed')[0].reset();
            $('.error_log_name, .error_log_code').hide().text('');
        }
    });

</script>