@extends('layout')
@section('title','Country')
@section('content')


               <ul class="breadcrumb">
                  <li><p>Dashboard</p></li>
                  <!--<li><p>Information Manager</p></li>-->
                   <li><a href="#" class="active">Information Manager</a></li>
                  <li><a href="#" class="active">Manage Countries</a> </li>
               </ul>
			   <div class="row-fluid">
                  <div class="span12">
                     <div class="grid simple ">
                        <div class="grid-title">
                           <h3><i class="fa fa-map"></i><span class="semi-bold"> @if(isset($country_edit)) Update @else Add @endif Country</span></h3>
                        </div>
                        <div class="grid-body ">
                            
                            
                   
                            <!-- Display Error Message -->
                            @if(session('error_count3'))
                            
                            
                               <div class="alert alert-danger" role="alert" id="success-alert">
                                   <form method="POST" action="{{ route('country.clear') }}">
                                    @csrf
                                   <button type="submit" class='close'></button>
                                   </form>
            				{{ session('error_count3') }}
            			</div>
                            @endif
                           <form class="form-no-horizontal-spacing" id="form-condensed" action="{{ isset($country_edit) ? route('country.update', $country_edit->id) : route('country.create') }}" method="POST" id="form_traditional_validation" name="form_traditional_validation" role="form" autocomplete="off" class="validate">
                              @csrf
                              <div class="row column-seperation">
                                 <div class="col-md-6">
                                    <div class="row form-row">
                                       <div class="col-md-6">
										   <select name="region_id" id="region_id" style="width:100%" required>
											  <option value="">Choose Region</option>
											    @foreach($region as $regions)
                                                    @if(isset($country_edit) && $regions->id == $country_edit->region_id)
                                                        <option value="{{$regions->id}}" selected>{{$regions->region_name}}</option>
                                                    @else
                                                        <option value="{{$regions->id}}">{{$regions->region_name}}</option>
                                                    @endif
                                                @endforeach
										   </select>
                                       </div>
                                       <div class="col-md-6">
											<input name="country_name" id="country_name" type="text" class="form-control" placeholder="Enter Country Name" value="{{$country_edit->country_name ?? ''}}" required>
											<label style="color:red;display:none;" class="error_log_name"></label>
                                       </div>
                                    </div>
                                 </div>
								 @if(isset($country_edit))
									<input name="action_status" id="action_status" type="hidden" value="update" >
									<input name="b_area_id" id="b_area_id" type="hidden" value="{{$country_edit->id ?? ''}}" >
								 @else
									<input name="action_status" id="action_status" type="hidden" value="add" >
									<input name="b_area_id" id="b_area_id" type="hidden" value="" >
								 @endif
                                 <div class="col-md-6">
									@if(isset($country_edit))
										<button class="btn btn-info btn-cons" type="submit"><i class="fa fa-refresh"></i> Update</button>
                                    @else
										<button class="btn btn-info btn-cons" type="submit" disabled id="btn-cons"><i class="fa fa-globe"></i> Create Country</button>
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
                           <h3><i class="fa fa-map"></i><span class="semi-bold"> Manage Countries</span></h3>
                        </div>
                        <div class="grid-body ">
                           <table class="table table-striped" id="example">
                              <thead>
                                 <tr>
                                    <th>S.No</th>
                                    <th>Country Name</th>
									<th>Region</th>
									<th>Status</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                  @php 
                                  $sn = 1;
                                  @endphp
                                  @foreach($country as $countrys)
                                 <tr>
                                    <td class="">{{$sn++}}</td>
									<td>{{$countrys->country_name}}</td>
									<td>{{$countrys->region_name}}</td>
									<td>
									    @if($countrys->status == 1)
											{{'Active'}}
									    @else
											{{'Inactive'}}
									    @endif
									</td>
									
                                    <td class="center">
										<a href="{{ route('country.edit', $countrys->id) }}" class="btn btn-info" style="background:#885df1; border-radius:50px;" onclick="return confirm('Do you want to Edit Country?')"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
										@if($countrys->status)									
											<a href="{{ route('country.status', ['id' => $countrys->id, 'actions' => 1]) }}"  class="btn btn-warning" style="border-radius:50px;"> <i class="fa fa-pause"></i>&nbsp;Suspend</a>
										@else
											<a href="{{ route('country.status', ['id' => $countrys->id, 'actions' => 0]) }}" class="btn btn-success" style="border-radius:50px;"><i class="fa fa-play"></i>&nbsp;Unsuspend</a>
										@endif
										<a href="{{ route('country.delete', $countrys->id) }}" type="button" class="btn btn-danger" style="border-radius:50px;" onclick="return confirm('Do you want to Delete Country?')"><i class="fa fa-trash"></i>&nbsp;Delete</a>
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
        var country_name = $('#country_name').val(); 
        var action_status = $('#action_status').val();
        var b_area_id = $('#b_area_id').val();
        
        if(country_name == ''){
            $('.btn-cons').prop('disabled', true);
        }
        else{
            if(country_name.length > 2 ){
             $.ajax({
            url: "{{ url('country/validation') }}",
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
                "country_name" :  country_name,
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
        
    }
    $('#country_name').on('keyup',check_val);
})

// $('#btn id="btn-cons"-cons"').on('click',function(key,$value)){
//      var country_name = $('#country_name').val(); 
//         var region_id = $('#region_id').val();
        
//           $.ajax({
//             url: "{{ url('country/validation') }}",
//             type: "GET",
//             data: {
//                 "_token": "{{ csrf_token() }}",
//                 "country_name" :  country_name,
//                 "region_id" : region_id
                
//             },
//             success: function(data) {
                
                
//                 // Check name validation
                
//                     if(data == 1){
//                         $('.error_log_name').show();
//                         $('.error_log_name').text('This name is already exists');
//                         isNameValid = false;
//                     } else {
//                         $('.error_log_name').hide();
//                         $('.error_log_name').text('');
//                     }
                
//             }
//         });
// }

$("#alert-danger").fadeTo(2000, 500).slideUp(500, function() {
    $("#success-alert").slideUp(500);

});
    $('.cancel-btn').on('click', function(e) {
        e.preventDefault();
        if (confirm("Do you want to Cancel this Edit?")) {
            $('#form-condensed')[0].reset();
            $('.error_log_name, .error_log_code').hide().text('');
        }
    });
</script>