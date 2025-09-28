@extends('layout')
@section('title','City')
@section('content')


               <ul class="breadcrumb">
                  <li><p>Dashboard</p></li>
                   <li><a href="#" class="active">Information Manager</a></li>
                  <li><a href="#" class="active">View Cities</a> </li>
               </ul>
               <div class="row-fluid">
                  <div class="span12">
                     <div class="grid simple ">
                        <div class="grid-title">
                           <h3><i class="fa fa-map-o"></i><span class="semi-bold">@if(isset($city_edit)) Update @else Add @endif City</span></h3>
                        </div>
                        <div class="grid-body ">
                            @if (session('error_count5'))
                            
                               <div class="alert alert-danger" role="alert">
                                   <form method="POST" action="{{ route('city.clear') }}">
                                    @csrf
                                   <button type="submit" class='close'></button>
                                   </form>
            				{{ session('error_count5') }}
            			</div>
                            @endif
                           <form class="form-no-horizontal-spacing" id="form-condensed" action="{{ isset($city_edit) ? route('city.update', $city_edit->id) : route('city.create') }}" method="POST">
                              @csrf
                              <div class="row column-seperation">
                                 <div class="col-md-6">
                                    <div class="row form-row">
                                       <div class="col-md-4">
										   <select name="country_id" id="country_id" style="width:100%" onchange="get_country($(this),{{$city_edit->state_id ?? ''}})" required>
											  <option value="">Choose Country</option>
											  @foreach($country as $countrys)
											  @if(isset($city_edit) && $countrys->id == $city_edit->country_id)
											  <option value="{{$countrys->id}}" selected>{{$countrys->country_name}}</option>
											  @else
											  <option value="{{$countrys->id}}">{{$countrys->country_name}}</option>
											  @endif
											  
											  @endforeach
										   </select>
                                       </div>
                                       <input type="hidden" name="hidden_country" id="hidden_country" value="{{$city_edit->country_id ?? ''}}"/>
                                       <input type="hidden" name="hidden_state" id="hidden_state" value="{{$city_edit->state_id ?? ''}}"/>
                                       <div class="col-md-4">
										   <select name="state_id" id="state_id" style="width:100%" required>
											  <option value="">Choose State</option>
										   </select>
                                       </div>
                                       <div class="col-md-4">
                                          <input name="name" id="name" type="text" class="form-control" value="{{$city_edit->name ?? ''}}" placeholder="Enter City Name" required>
                                          <label style="color:red;display:none;" class="error_log_name"></label>
                                       </div>
                                    </div>
                                 </div>
                                  @if(isset($city_edit))
                                    <input name="action_status" id="action_status" type="hidden" value="update" >
                                    <input name="b_area_id" id="b_area_id" type="hidden" value="{{$city_edit->id ?? ''}}" >
                                    @else
                                    <input name="action_status" id="action_status" type="hidden" value="add" >
                                     <input name="b_area_id" id="b_area_id" type="hidden" value="" >
                                    @endif
                                 <div class="pull-right">
                                     @if(isset($city_edit))
                                        <button class="btn btn-primary btn-cons" type="submit"><i class="fa fa-refresh"></i> Update</button>
                                     @else
                                        <button class="btn btn-info btn-cons" type="submit"><i class="fa fa-building"></i> Create City</button>
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
                           <h3><i class="fa fa-map-o"></i><span class="semi-bold"> View & Manage Cities</span></h3>
                        </div>
                        <div class="grid-body ">
                           <table class="table table-striped" id="example">
                              <thead>
                                 <tr>
                                     <th>S.No</th>
                                    <th>Country Name</th>
									<th>State</th>
									<th>City</th>
									<th>Status</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                    @php 
                                  $sn = 1;
                                  @endphp
                                  @foreach($city as $citys)
                                 <tr>
                                    <td>{{$sn++}}</td>
									<td>{{$citys->country_name}}</td>
									<td>{{$citys->state_title}}</td>
									<td>{{$citys->name}}</td>
									<td>
									    @if($citys->status == 1)
											{{'Active'}}
									    @else
										    {{'Inactive'}}
									    @endif
									</td>
                                    <td class="center">
										<a href="{{ route('city.edit', $citys->id) }}" class="btn btn-info" style="background:#885df1; border-radius:50px;" onclick="return confirm('Do you want to Edit City?')"> <i class="fa fa-pencil"></i>&nbsp;Edit</a>
										@if($citys->status)
										    <a href="{{ route('city.status', ['id' => $citys->id, 'actions' => 1]) }}" class="btn btn-warning" style="border-radius:50px;"><i class="fa fa-pause"></i>&nbsp;Suspend</a>
										@else
										    <a href="{{ route('city.status', ['id' => $citys->id, 'actions' => 0]) }}" class="btn btn-success" style="border-radius:50px;"><i class="fa fa-play"></i>&nbsp;Unsuspend</a>
										@endif
										<a href="{{ route('city.delete', $citys->id) }}" type="button" class="btn btn-danger" style="border-radius:50px;" onclick="return confirm('Do you want to Delete City?')"><i class="fa fa-trash"></i>&nbsp;Delete</a>
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
    get_country($('#hidden_country'),$('#hidden_state'));
    // $('#city_id').on('change',function(){
    // console.log($(this).val());
   function check_val(){
       $('.error_log_name').text('');
        // console.log($(val).val());
        var country_id = $('#country_id').val(); 
        var state_id = $('#state_id').val();
        var name = $('#name').val();
        var action_status = $('#action_status').val();
        var b_area_id = $('#b_area_id').val();
        if(name.length > 2 ){
             $.ajax({
            url: "{{ url('city/validation') }}",
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
                "country_id" :  country_id,
                "state_id" :  state_id,
                "name" :  name,
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
    
    $('#name').on('keyup',check_val);
    
    $('.cancel-btn').on('click', function(e) {
        e.preventDefault();
        if (confirm("Do you want to Cancel this Edit?")) {
            $('#form-condensed')[0].reset();
            $('.error_log_name, .error_log_code').hide().text('');
        }
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
                 $('#state_id').append('<option value="">Choose State</option>')
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