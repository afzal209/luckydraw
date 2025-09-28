@extends('layout')
@section('title','Add Business Partner')
@section('content')

               <ul class="breadcrumb">
                  <li><p>Dashboard</p></li>
                  <li><a href="#" class="active">Business Partners</a> </li>
                  <li><a href="#" class="active">Add Business Partner</a> </li>
               </ul>
               <div class="row">
                  <div class="col-md-12">
                     <div class="grid simple form-grid">
                        <div class="grid-title no-border">
                           <h3><i class="fa fa-user-secret"></i><span class="semi-bold">@if(isset($business_edit)) Update @else Add @endif Business Partner</span></h3>
                        </div>
                        <div class="grid-body no-border">
                           <form class="form-no-horizontal-spacing" id="form-condensed" action="{{ isset($business_edit) ? route('business_partners.partner.update', $business_edit->id) : route('business_partners.partner.create') }}" method="POST" enctype="multipart/form-data">
                               @csrf
                              <div class="row column-seperation">
                                 <div class="col-md-12">
                                    <h4>Basic Information</h4>
                                    <div class="row form-row">
                                       <div class="col-md-2">
										    <select name="prefix" id="prefix" style="wiidth:100%" required>
											  <option value="">Choose Prefix</option>
											  <option value="1" @if(isset($business_edit) && $business_edit->prefix == 1) selected @endif>Mr.</option>
											  <option value="2" @if(isset($business_edit) && $business_edit->prefix == 2) selected @endif>Ms.</option>
										    </select>
                                       </div>
                                       <div class="col-md-4">
                                          <input name="poc_first_name" id="first_name" type="text" class="form-control" placeholder=" POC First Name" value="{{$business_edit->poc_first_name ?? ''}}" required>
                                       </div>
                                       <div class="col-md-6">
                                          <input name="poc_last_name" id="last_name" type="text" class="form-control" placeholder=" POC Last Name" value="{{$business_edit->poc_last_name ?? ''}}" required>
                                       </div>
                                    </div>
                                    <div class="row form-row">
                                       <div class="col-md-6">
                                          <input name="poc_email" id="poc_email" type="email" class="form-control" placeholder="POC Email" value="{{$business_edit->poc_email ?? ''}}" required>
                                          <label style="color:red;display:none;" class="error_log_email"></label>
                                       </div>
                                       <div class="col-md-6">
                                          <input name="poc_mobile" id="poc_mobile" type="text" class="form-control" placeholder="POC Phone number" value="{{$business_edit->poc_mobile ?? ''}}" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                                          <label style="color:red;display:none;" class="error_log_mobile"></label>
                                       </div>
                                    </div>
                                    <h4>Business Information</h4>
                                    <div class="row form-row">
                                       <div class="col-md-3">
										   <select name="business_area_id" id="business_area_id" style="width:100%" required>
											  <option>Choose Business Area</option>
											  @foreach($business_area as $business)
											  @if(isset($business_edit) && $business_edit->business_area_id == $business->id)
											  <option value="{{$business->id}}" selected>{{$business->area_name}}-{{$business->area_code}}</option>
											  @else
											  <option value="{{$business->id}}" >{{$business->area_name}}-{{$business->area_code}}</option>
											  @endif
											  @endforeach
										   </select>
                                       </div>
									   <div class="col-md-9">
                                          <input name="business_name" id="business_name" type="text" class="form-control" placeholder="Business Partner" value="{{$business_edit->business_name ?? ''}}" required>
                                       </div>
                                    </div>
									<div class="row form-row">
									   <div class="col-md-6">
                                          <input name="address_line_1" id="business_address_1" type="text" class="form-control" placeholder="Address Line#1" value="{{$business_edit->address_line_1 ?? ''}}">
                                       </div>
									   <div class="col-md-6">
                                          <input name="address_line_2" id="business_address_2" type="text" class="form-control" placeholder="Address Line#2" value="{{$business_edit->address_line_2 ?? ''}}">
                                       </div>
                                    </div>
                                    <div class="row form-row">
                                       <div class="col-md-3">
										   <select name="region_id" id="region_id" style="width:100%" onchange="get_region($(this),{{$business_edit->country_id ?? ''}});" required>
											  <option value="">Choose Region</option>
											  @foreach($region as $regions)
    											  @if(isset($business_edit) && $business_edit->region_id == $regions->id)
    											    <option value="{{$regions->id}}" selected>{{$regions->region_name}}</option>
    											  @else
    											    <option value="{{$regions->id}}" >{{$regions->region_name}}</option>
    											  @endif
											  @endforeach
										   </select>
                                       </div>
									   <div class="col-md-3">
										   <select name="country_id" id="country_id" style="width:100%" onchange="get_country($(this),{{$business_edit->state_id ?? ''}});" required>
											  <option value="">Choose Country</option>
											 
										   </select>
                                       </div>
                                       <div class="col-md-3">
                                           <select name="state_id" id="state_id" style="width:100%" onchange="get_state($(this),{{$business_edit->city_id ?? ''}});" required>
											  <option value="">Choose State</option>
										   </select>
                                          <!--<input name="state" id="state" type="text" class="form-control" placeholder="State">-->
                                       </div>
									   <div class="col-md-3">
									       <select name="city_id" id="city_id" style="width:100%" required>
											  <option value="">Choose City</option>
											 
										   </select>
                                          <!--<input name="city" id="city" type="text" class="form-control" placeholder="City">-->
                                       </div>
                                    </div>
                                     <input type="hidden" name="hidden_region" id="hidden_region" value="{{$business_edit->region_id ?? ''}}"/>
                                       <input type="hidden" name="hidden_country" id="hidden_country" value="{{$business_edit->country_id ?? ''}}"/>
                                       <input type="hidden" name="hidden_state" id="hidden_state" value="{{$business_edit->state_id ?? ''}}"/>
                                       <input type="hidden" name="hidden_city" id="hidden_city" value="{{$business_edit->city_id ?? ''}}"/>
                                    <div class="row form-row">
                                       <div class="col-md-5">
                                          <input name="zip_code" id="zip_code" type="text" class="form-control" placeholder="PIN / ZIP Code" required value="{{$business_edit->zip_code ?? ''}}" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                       </div>
                                       <div class="col-md-7">
										 <input type="file" name="profile_image" id="profile_image" >
                                           <p class="col-md-12">
                                              NOTE - Upload Business Logo
                                           </p>										 
                                           @if(isset($business_edit))
        								    <img src="{{URL::asset($business_edit->profile_image)}}" style="width:100px;height:100px;">
        								   @endif
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              
                              <div class="form-actions">
                                 <div class="pull-left">
                                    <div class="luckydraw_checkbox">
                                    </div>
                                 </div>
                                 <div class="pull-right">
                                    @if(isset($business_edit))
                                        <input name="action_status" id="action_status" type="hidden" value="update" >
                                        <input name="b_partner_id" id="b_partner_id" type="hidden" value="{{$business_edit->id ?? ''}}" >                                     
                                        <button class="btn btn-success btn-cons" type="submit"><i class="icon-ok"></i> Update Business Parner</button>
                                    @else
                                        <input name="action_status" id="action_status" type="hidden" value="add" >
                                        <input name="b_partner_id" id="b_partner_id" type="hidden" value="" >
                                        <button class="btn btn-success btn-cons" type="submit"><i class="icon-ok"></i> Create Business Partner</button>
                                    @endif
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
    
    // $('input[type=checkbox][name="luckydraw_id[]"]:checked').each(function(key,val){
    //     // console.log($(val));
    //     get_luckydraw_check($(val));
    // })
    // get_country($('#hidden_country'),$('#hidden_state'));
    // $('#city_id').on('change',function(){
    // console.log($(this).val());
   get_region($('#hidden_region'),$('#hidden_country').val());
   get_country($('#hidden_country'),$('#hidden_state').val())
    get_state($('#hidden_state'),$('#hidden_city').val());
//     if($('#luckydraw_edit_id').val() > 0){
//          var region_id = $('#hidden_region').val();
//     var country_id = $('#hidden_country').val();
// // })
// $('#allocate_div').html('');
//          $.ajax({
//             url: "{{ url('business_partners/partner/get_luckydraw_data') }}",
//             type: "GET",
//             data: {
//                 "_token": "{{ csrf_token() }}",
//                 "region_id" :  region_id,
//                 "country_id" : country_id
                
//             },
//             success: function(data) {
//                 // console.log(data);
//                 // console.log(data['doneMessage']);
//                 var tr= '';
//               $(data).each(function(key, value) {
//                   tr += `<tr>
//                   <td>
// 											  <div class="checkbox check-default" >
// 												<input id="checkbox${value['id']}" type="checkbox" value="${value['id']}" name="luckydraw_id[]"  ${value['status'] == 0 ? '' : 'disabled'} >
// 												<label for="checkbox${value['id']}"></label>
// 											  </div>
// 											</td>
// 											<td class="text-center">${value['luckydraw_name']}</td>
// 											<td class="text-right">${value['region_name']}</td>
// 											<td class="text-right">${value['country_name']}</td>
// 											<td class="text-right"><i class="fa fa-euro"></i>${value['price']}</td>
// 											<td class="text-center">
//                                                 <span class="label ${value['status'] == 0 ? 'label-success' : 'label-important'}">
//                                                     ${value['status'] == 0 ? 'Active' : 'In-Active'}
//                                                 </span>
//                                             </td>
//                   </tr>`;
//               })
              
//               $('#allocate_div').append(tr);
// var selectedIds = $("input[name='luckydraw_edit_id']").val().split(',');
// console.log(selectedIds);
//         // Loop through each checkbox and check if its value is in the array
//         $("input[name='luckydraw_id[]']").each(function() {
//             if (selectedIds.includes($(this).val())) {
//                 $(this).prop("checked", true);
//             }
//         });
//             }
//         });
//     }
   


//  function get_luckydraw_data() {
//      var region_id = $('#region_id').val();
//      var country_id = $('#country_id').val();
//         // console.log('Luckydraw data function triggered');
//         $('#allocate_div').html('');
//          $.ajax({
//             url: "{{ url('business_partners/partner/get_luckydraw_data') }}",
//             type: "GET",
//             data: {
//                 "_token": "{{ csrf_token() }}",
//                 "region_id" :  region_id,
//                 "country_id" : country_id
                
//             },
//             success: function(data) {
//                 // console.log(data);
//                 // console.log(data['doneMessage']);
//                 var tr= '';
//               $(data).each(function(key, value) {
//                   tr += `<tr>
//                   <td>
// 											  <div class="checkbox check-default" >
// 												<input id="checkbox${value['id']}" type="checkbox" value="${value['id']}" name="luckydraw_id[]"  ${value['status'] == 0 ? '' : 'disabled'} >
// 												<label for="checkbox${value['id']}"></label>
// 											  </div>
// 											</td>
// 											<td class="text-center">${value['luckydraw_name']}</td>
// 											<td class="text-right">${value['region_name']}</td>
// 											<td class="text-right">${value['country_name']}</td>
// 											<td class="text-right"><i class="fa fa-euro"></i>${value['price']}</td>
// 											<td class="text-center">
//                                                 <span class="label ${value['status'] == 0 ? 'label-success' : 'label-important'}">
//                                                     ${value['status'] == 0 ? 'Active' : 'In-Active'}
//                                                 </span>
//                                             </td>
//                   </tr>`;
//               })
              
//               $('#allocate_div').append(tr);

//             }
//         });
//     }

//     $('#region_id, #country_id').on('change', function() {
//         // console.log('Change event detected'); // Debugging log
//         get_luckydraw_data();
//     });
});

    // function get_luckydraw_data(){
    //     console.log('test');
    // }
// $('#region_id, #country_id').on('change', get_luckydraw_data);
    // $('#region_id,#country_id').on('change',get_luckydraw_data);

    function get_region(val,id){
    //  console.log(id)
     $('#country_id').html('');
      $('#state_id').html('');
      $('#city_id').html('');
    var region_id = $(val).val();
    var country_id = id;
    // console.log(country_id);
   
   
   
    $.ajax({
            url: "{{ url('business_partners/partner/get_region') }}",
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
                "region_ids" :  region_id,
                
            },
            success: function(data) {
                // console.log(data);
                // console.log(data['doneMessage']);
                 $('#country_id').append('<option value="">Select Country</option>')
                 $(data).each(function(key, value) {
                      var select = '';
                      if(country_id == value.id){
                          select = 'selected';
                      }
                      else{
                          select = '';
                      }
                //     // console.log(value.address);
                    $('#country_id').append('<option value='+value.id+' '+select+'>'+value.country_name+'</option>')
                });
              

            }
        });
    }
    
     function get_country(val,id){
     console.log(id)
     $('#state_id').html('');
      $('#city_id').html('');
    var country_id = $(val).val();
    var state_id = id;
    // console.log(state_id);
   
    $.ajax({
            url: "{{ url('business_partners/partner/get_country') }}",
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
                "country_id" :  country_id,
                
            },
            success: function(data) {
                // console.log(data);
                // console.log(data['doneMessage']);
                 $('#state_id').append('<option value="">Select State</option>')
                 $(data).each(function(key, value) {
                      var select = '';
                      if(state_id == value.id){
                          select = 'selected';
                      }
                      else{
                          select = '';
                      }
                //     // console.log(value.address);
                    $('#state_id').append('<option value='+value.id+' '+select+'>'+value.state_title+'</option>')
                });
              

            }
        });
    }
    
    function get_state(val,id){
        // console.log($(id));
        $('#city_id').html('');
         var state_id = $(val).val();
         var city_id =id;
             $.ajax({
            url: "{{ url('business_partners/partner/get_state') }}",
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
                "state_id" :  state_id,
                
            },
            success: function(data) {
                // console.log(data);
                // console.log(data['doneMessage']);
                 $('#city_id').append('<option value="">Select City</option>')
                 $(data).each(function(key, value) {
                      var select = '';
                      if(city_id == value.id){
                          select = 'selected';
                      }
                      else{
                          select = '';
                      }
                //     // console.log(value.address);
                    $('#city_id').append('<option value='+value.id+' '+select+'>'+value.name+'</option>')
                });
              

            }
        });

    }
    
    
//     function get_luckydraw_check(val) {
//     let value = $(val).val(); // Get checkbox value
//     let name = $(val).attr('name'); // Get checkbox name

//     if ($(val).is(':checked')) {
//         // Add hidden input with the same value
//         $('<input>').attr({
//             type: 'hidden',
//             name: name, // Keep the same name
//             value: value,
//             class: 'hidden-luckydraw-' + value // Unique class for removal
//         }).appendTo('.luckydraw_checkbox');
//     } else {
//         // Remove hidden input if checkbox is unchecked
//         $('.hidden-luckydraw-' + value).remove();
//     }
// }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
   function check_val(){
       $('.error_log_email').text('');
       $('.error_log_mobile').text('');
        // console.log($(val).val());
        var poc_email = $('#poc_email').val(); 
        var poc_mobile = $('#poc_mobile').val();
        var action_status = $('#action_status').val();
        var b_partner_id = $('#b_partner_id').val();
        if(poc_email.length > 2 ){
             $.ajax({
            url: "{{ url('business_partners/validation') }}",
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
                "poc_email" :  poc_email,
                "poc_mobile" : poc_mobile,
                "action_status" : action_status,
                "b_partner_id" : b_partner_id
            },
            success: function(data) {
                let isMailValid = true;
                let isMobileValid = true;
                
                // Check name validation
                if(data.action['field'] == 'name'){
                    if(data.action['status'] == 1){
                        $('.error_log_email').show();
                        $('.error_log_email').text('This Email is already exists');
                        isMailValid = false;
                    } else {
                        $('.error_log_email').hide();
                        $('.error_log_email').text('');
                    }
                }
                // Check code validation
                if(data.action1['field'] == 'code'){
                    if(data.action1['status'] == 1){
                        $('.error_log_mobile').show();
                        $('.error_log_mobile').text('This Mobile Number is already exists');
                        isMobileValid = false;
                    } else {
                        $('.error_log_mobile').hide();
                        $('.error_log_mobile').text('');
                    }
                }
                // Enable button only if both name and code are valid (status 0)
                $('.btn-cons').prop('disabled', !(isMailValid && isMobileValid));
            }
        });
        }
    }
    $('#poc_email, #poc_mobile').on('keyup',check_val);
})
</script>