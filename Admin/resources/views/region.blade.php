@extends('layout')
@section('title','Region')
@section('content')


               <ul class="breadcrumb">
                  <li><p>Dashboard</p></li>
                   <li><a href="#" class="active">Information Manager</a></li>
				  <li><a href="#" class="active">Manage Region</a> </li>
               </ul>
               <div class="row-fluid">
                  <div class="span12">
                     <div class="grid simple ">
                        <div class="grid-title">
                           <h3><i class="fa fa-map-pin"></i><span class="semi-bold"> @if(isset($region_edit)) Update @else Add @endif Region</span></h3>
                        </div>
                        <div class="grid-body ">
                             @if (session('error_count2'))
                            
                               <div class="alert alert-danger" role="alert">
                                   <form method="POST" action="{{ route('region.clear') }}">
                                    @csrf
                                   <button type="submit" class='close'></button>
                                   </form>
            				{{ session('error_count2') }}
            			</div>
                            @endif
                           <form class="form-no-horizontal-spacing" id="form-condensed" action="{{ isset($region_edit) ? route('region.update', $region_edit->id) : route('region.create') }}" method="POST">
                              @csrf
                              <div class="row column-seperation">
                                 <div class="col-md-6">
                                    <div class="row form-row">
                                       <div class="col-md-6">
                                          <input name="region_name" id="region_name" type="text" class="form-control" value="{{$region_edit->region_name ?? '' }}" placeholder="Enter Region Name" required>
                                          <label style="color:red;display:none;" class="error_log_name"></label>
                                       </div>
                                       <div class="col-md-6">
                                          <input name="region_code" id="region_code" type="text" class="form-control" value="{{$region_edit->region_code ?? '' }}" placeholder="Enter Region Code" required>
                                          <label style="color:red;display:none;" class="error_log_code"></label>
                                       </div>
                                    </div>
                                     @if(isset($region_edit))
                                    <input name="action_status" id="action_status" type="hidden" value="update" >
                                    <input name="b_area_id" id="b_area_id" type="hidden" value="{{$region_edit->id ?? ''}}" >
                                    @else
                                    <input name="action_status" id="action_status" type="hidden" value="add" >
                                     <input name="b_area_id" id="b_area_id" type="hidden" value="" >
                                    @endif
                                 </div>
                                 <div class="col-md-6">
                                      @if(isset($region_edit))
										<button class="btn btn-danger btn-cons" type="submit" name="action" value="update" ><i class="fa fa-refresh"></i> Update Region</button>
                                     @else
										<button class="btn btn-danger btn-cons" type="submit" name="action" value="save" ><i class="fa fa-map"></i> Create Region</button>
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
                           <h3><i class="fa fa-map-pin"></i><span class="semi-bold"> View & Manage Region</span></h3>
                        </div>
                        <div class="grid-body ">
                           <table class="table table-striped" id="example">
                              <thead>
                                 <tr>
                                    <th>Sl.No</th>
									<th>Region Name</th>
									<th>Region Code</th>
									<th>Status</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                  @php 
                                  $sn = 1;
                                  @endphp
                                  @foreach($region as $regions)
                                 <tr>
                                    <td>{{$sn++}}</td>
									<td>{{$regions->region_name}}</td>
									<td>{{$regions->region_code}}</td>
									<td>@if($regions->status == 1) Active @else In-Active @endif</td>
                                    <td class="center">
										<a href="{{ route('region.edit', $regions->id) }}" class="btn btn-info" style="background:#885df1; border-radius:50px;" onclick="return confirm('Do you want to Edit Region?')"><i class="fa fa-pencil"></i>&nbsp;Edit</a>										
										@if($regions->status)
											<a href="{{ route('region.status', ['id' => $regions->id, 'actions' => 1]) }}"  class="btn btn-warning" style="border-radius:50px;"><i class="fa fa-pause"></i>&nbsp;Suspend</a>
										@else
										<a href="{{ route('region.status', ['id' => $regions->id, 'actions' => 0]) }}"  class="btn btn-success" style="border-radius:50px;"> <i class="fa fa-play"></i>&nbsp;Unsuspend </a>
										@endif
										<a href="{{ route('region.delete', $regions->id) }}" type="button" class="btn btn-danger" style="border-radius:50px;" onclick="return confirm('Do you want to Delete Region?')"><i class="fa fa-trash"></i>&nbsp;Delete</a>
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
        var region_name = $('#region_name').val(); 
        var region_code = $('#region_code').val();
        var action_status = $('#action_status').val();
        var b_area_id = $('#b_area_id').val();
        if(region_name.length > 2 ){
             $.ajax({
            url: "{{ url('region/validation') }}",
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
                "region_name" :  region_name,
                "region_code" : region_code,
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
    
    $('#region_name, #region_code').on('keyup',check_val);
    
})
    $('.cancel-btn').on('click', function(e) {
        e.preventDefault();
        if (confirm("Do you want to Cancel this Edit?")) {
            $('#form-condensed')[0].reset();
            $('.error_log_name, .error_log_code').hide().text('');
        }
    });
// });
</script>