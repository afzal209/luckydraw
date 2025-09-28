@extends('layout')
@section('title','Add Business Partner')
@section('content')

               <ul class="breadcrumb">
                  <li><p>Dashboard</p></li>
                  <li><a href="#" class="active">Add Business Partner</a> </li>
               </ul>
               <div class="row">
                  <div class="col-md-12">
                     <div class="grid simple form-grid">
                        <div class="grid-title no-border">
                           <h3><span class="semi-bold"><i class="fa fa-user"></i> Add Business Partner</span></h3>
                        </div>
                        <div class="grid-body no-border">
                           <form class="form-no-horizontal-spacing" id="form-condensed" action="{{ isset($business_edit) ? route('business_partners.partner.update', $business_edit->id) : route('business_partners.partner.create') }}" method="POST" enctype="multipart/form-data">
                               @csrf
                              <div class="row column-seperation">
                                 <div class="col-md-12">
                                    <h4>Basic Information</h4>
                                    <div class="row form-row">
                                       <div class="col-md-2">
										    <select name="prefix" id="prefix" style="width:100%" required>
											  <option>Choose Prefix</option>
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
                                          <input name="poc_email" id="poc_email" type="text" class="form-control" placeholder="POC Email" value="{{$business_edit->poc_email ?? ''}}" required>
                                       </div>
                                       <div class="col-md-6">
                                          <input name="poc_mobile" id="mobile" type="text" class="form-control" placeholder="POC Phone number" value="{{$business_edit->poc_mobile ?? ''}}" required>
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
											  <option>Choose Region</option>
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
											  <option>Choose Country</option>
											 
										   </select>
                                       </div>
                                       <div class="col-md-3">
                                           <select name="state_id" id="state_id" style="width:100%" onchange="get_state($(this),{{$business_edit->city_id ?? ''}});" required>
											  <option>Choose State</option>
											 
										   </select>
                                          <!--<input name="state" id="state" type="text" class="form-control" placeholder="State">-->
                                       </div>
                                      
									   <div class="col-md-3">
									       
									       <select name="city_id" id="city_id" style="width:100%" required>
											  <option>Choose State</option>
											 
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
                                          <input name="zip_code" id="zip_code" type="text" class="form-control" placeholder="PIN / ZIP Code" required value="{{$business_edit->zip_code ?? ''}}">
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
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="grid simple">
                                       <div class="grid-body no-border">
                                          <div class="row">
                                             <div class="col-md-3">
                                                <h3>Wallet <span class="semi-bold"> Money</span></h3>
                                                <p>Either you have collected this amount or giving the free amount to the Business partner as a welcome bonus.</p>
                                                <br>
												 <div class="input-group transparent">
													<span class="input-group-addon "><i class="fa fa-euro"></i></span>
													<input type="text" name="initial_deposit" id="initial_deposit" class="form-control" placeholder="Initial Depoit" value="{{$business_edit->initial_deposit ?? ''}}" required>
												 </div>
                                                <br>
                                                <br>
                                                <div class="clearfix"></div>
                                             </div>
                                             <div class="col-md-3">
                                                <h3><span class="semi-bold">Transaction Detail</span></h3>
                                                <p>Please mention the Transaction / UTR number for the amount which you have received</p>
                                                <br>
												 <div class="input-group transparent">
													<span class="input-group-addon "><i class="fa fa-file"></i></span>
													<input type="text" name="initial_tx_id" id="initial_tx_id" class="form-control" placeholder="Initial Depoit Tx ID" value="{{$business_edit->initial_tx_id ?? ''}}" required>
												 </div>
                                             </div>
                                             <div class="col-md-3">
                                                <h3><span class="semi-bold">Transaction Date</span></h3>
                                                <p>Please mention the Transaction / UTR date<br><br><br></p>
                                                <br>
												 <div class="input-group transparent">
													<span class="input-group-addon "><i class="fa fa-calendar"></i></span>
													<input type="datetime-local" name="initial_tx_date" id="initial_tx_date" class="form-control" placeholder="Initial Depoit Tx Date" value="{{$business_edit->initial_tx_date ?? ''}}" required>
												 </div>
                                             </div>
                                             <div class="col-md-3">
                                                <h3><span class="semi-bold">Transaction Proof</span></h3>
                                                <p>Please upload the Transaction screenshot for the future reference.<br><br></p>
                                                <br>
												 <div class="input-group transparent">
													<span class="input-group-addon "><i class="fa fa-file"></i></span>
													<input type="file" name="initial_tx_image" id="initial_tx_image" >
												
												 </div>
												 	@if(isset($business_edit))
        										<img src="{{URL::asset($business_edit->initial_tx_image)}}" style="width:100px;height:100px;">
        										@endif
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <input type="hidden" name="luckydraw_edit_id" id="luckydraw_edit_id" value="{{$business_edit->luckydraw_id ?? ''}}" />
                                 </div>
								<div class="col-md-12">
								  <div class="grid simple ">
									<div class="grid-title no-border">
									<div class="grid-body no-border">
									  <h3>Assign / Allocate <span class="semi-bold">Luckydraws</span></h3>
									  <br>
									  <table class="table table-bordered no-more-tables">
										<thead>
										  <tr>
											<th style="width:1%">
											  <div class="checkbox check-default">
												<input id="checkbox20" type="checkbox" value="1" class="checkall">
												<label for="checkbox20"></label>
											  </div>
											</th>
											<th class="text-center" style="width:8.5%">Luckydraw Name</th>
											<th class="text-center" style="width:8.5%">Region</th>
											<th class="text-center" style="width:8.5%">Country</th>
											<th class="text-center" style="width:8.5%">Price</th>
											<th class="text-center" style="width:6%">Status</th>
										  </tr>
										</thead>
										<tbody id="allocate_div">
										    @foreach($luckydrawas $luckydraws)
										    @php
										    $selectedLuckydraw = explode(',', $business_edit->luckydraw_id ?? ''); // Convert to array
										    @endphp
										  <tr>
											<td>
											  <div class="checkbox check-default">
												<input id="checkbox{{$luckydraws->id}}" type="checkbox" name="luckydraw_id[]" value="{{$luckydraws->id}}" @if($luckydraws->status == 0) disabled @endif   {{ in_array($luckydraws->id, $selectedLuckydraw) ? 'checked' : '' }}>
												<label for="checkbox{{$luckydraws->id}}"></label>
											  </div>
											</td>
											<td class="text-center">{{$luckydraws->luckydraw_name}}</td>
											<td class="text-right">{{$luckydraws->region_name}}</td>
											<td class="text-right">{{$luckydraws->country_name}}</td>
											<td class="text-right"><i class="fa fa-euro"></i>{{$luckydraws->price}}</td>
											<td class="text-center">@if($luckydraws->status == 0)<span class="label label-important"> {{'In-Active'}} @else <span class="label label-success"> {{'Active'}} @endif</span></td>
										  </tr>
										  @endforeach
										</tbody>
									  </table>
									</div>
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
										<button class="btn btn-info btn-cons" type="submit"><i class="fa fa-user-secret"></i> Update Business Parner</button>
                                    @else
										<button class="btn btn-info btn-cons" type="submit"><i class="fa fa-user-secret"></i> Create Business Partner</button>
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

   get_region($('#hidden_region'),$('#hidden_country'));
   get_country($('#hidden_country'),$('#hidden_state'))
    get_state($('#hidden_state'),$('#hidden_city'));
    if($('#luckydraw_edit_id').val() > 0){
         var region_id = $('#hidden_region').val();
    var country_id = $('#hidden_country').val();
// })
$('#allocate_div').html('');
         $.ajax({
            url: "{{ url('business_partners/partner/get_luckydraw_data') }}",
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
                "region_id" :  region_id,
                "country_id" : country_id
                
            },
            success: function(data) {
                // console.log(data);
                // console.log(data['doneMessage']);
                var tr= '';
              $(data).each(function(key, value) {
                  tr += `<tr>
                  <td>
											  <div class="checkbox check-default" >
												<input id="checkbox${value['id']}" type="checkbox" value="${value['id']}" name="luckydraw_id[]"  ${value['status'] == 0 ? '' : 'disabled'} >
												<label for="checkbox${value['id']}"></label>
											  </div>
											</td>
											<td class="text-center">${value['luckydraw_name']}</td>
											<td class="text-right">${value['region_name']}</td>
											<td class="text-right">${value['country_name']}</td>
											<td class="text-right"><i class="fa fa-euro"></i>${value['price']}</td>
											<td class="text-center">
                                                <span class="label ${value['status'] == 0 ? 'label-success' : 'label-important'}">
                                                    ${value['status'] == 0 ? 'Active' : 'In-Active'}
                                                </span>
                                            </td>
                  </tr>`;
              })
              
               $('#allocate_div').append(tr);
var selectedIds = $("input[name='luckydraw_edit_id']").val().split(',');
console.log(selectedIds);
        // Loop through each checkbox and check if its value is in the array
        $("input[name='luckydraw_id[]']").each(function() {
            if (selectedIds.includes($(this).val())) {
                $(this).prop("checked", true);
            }
        });
            }
        });
    }
   


 function get_luckydraw_data() {
     var region_id = $('#region_id').val();
     var country_id = $('#country_id').val();
        // console.log('Luckydraw data function triggered');
        $('#allocate_div').html('');
         $.ajax({
            url: "{{ url('business_partners/partner/get_luckydraw_data') }}",
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
                "region_id" :  region_id,
                "country_id" : country_id
                
            },
            success: function(data) {
                // console.log(data);
                // console.log(data['doneMessage']);
                var tr= '';
              $(data).each(function(key, value) {
                  tr += `<tr>
                  <td>
											  <div class="checkbox check-default" >
												<input id="checkbox${value['id']}" type="checkbox" value="${value['id']}" name="luckydraw_id[]"  ${value['status'] == 0 ? '' : 'disabled'} >
												<label for="checkbox${value['id']}"></label>
											  </div>
											</td>
											<td class="text-center">${value['luckydraw_name']}</td>
											<td class="text-right">${value['region_name']}</td>
											<td class="text-right">${value['country_name']}</td>
											<td class="text-right"><i class="fa fa-euro"></i>${value['price']}</td>
											<td class="text-center">
                                                <span class="label ${value['status'] == 0 ? 'label-success' : 'label-important'}">
                                                    ${value['status'] == 0 ? 'Active' : 'In-Active'}
                                                </span>
                                            </td>
                  </tr>`;
              })
              
               $('#allocate_div').append(tr);

            }
        });
    }

    $('#region_id, #country_id').on('change', function() {
        // console.log('Change event detected'); // Debugging log
        get_luckydraw_data();
    });
});

    // function get_luckydraw_data(){
    //     console.log('test');
    // }
// $('#region_id, #country_id').on('change', get_luckydraw_data);
    // $('#region_id,#country_id').on('change',get_luckydraw_data);

    function get_region(val,id){
     console.log(id)
     $('#country_id').html('');
      $('#state_id').html('');
      $('#city_id').html('');
    var region_id = $(val).val();
    var country_id = $(id).val();
    // console.log(country_id);
   
   
   
    $.ajax({
            url: "{{ url('business_partners/partner/get_region') }}",
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
                "region_id" :  region_id,
                
            },
            success: function(data) {
                // console.log(data);
                // console.log(data['doneMessage']);
                 $('#country_id').append('<option>Select Country</option>')
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
    //  console.log(id)
     $('#state_id').html('');
      $('#city_id').html('');
    var country_id = $(val).val();
    var state_id = $(id).val();
    console.log(state_id);
   
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
                 $('#state_id').append('<option>Select State</option>')
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
        // console.log($(id).val());
        $('#city_id').html('');
         var state_id = $(val).val();
         var city_id = $(id).val();
             $.ajax({
            url: "{{ url('business_partners/partner/get_state') }}",
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
                "state_id" :  state_id,
                
            },
            success: function(data) {
                console.log(data);
                // console.log(data['doneMessage']);
                 $('#city_id').append('<option>Select City</option>')
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