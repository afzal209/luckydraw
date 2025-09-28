@extends('layout')
@section('title','Add Business Partner')
@section('content')

               <ul class="breadcrumb">
                  <li><p>Dashboard</p></li>
                  <li><a href="#" class="active">Manage BP Wallet</a> </li>
               </ul>
               <div class="row">
                  <div class="col-md-12">
                     <div class="grid simple form-grid">
                        <div class="grid-title no-border">
                           <h3><span class="semi-bold"><i class="fa fa-user"></i> Add Amount to Business Partner</span></h3>
                        </div>
                        <div class="grid-body no-border">
                           <form class="form-no-horizontal-spacing" id="form-condensed" action="{{ isset($business_edit) ? route('business_partners.partner.update', $business_edit->id) : route('business_partners.partner.create') }}" method="POST" enctype="multipart/form-data">
                               @csrf
                              <div class="row column-seperation">
                                 <div class="col-md-12">
                                    <h4>Transaction Details</h4>
                                    <div class="row form-row">
                                       <div class="col-md-4">
                                          <input name="	tx_date" id="	tx_date" type="text" class="form-control" placeholder="Transaction Date" value="{{$business_edit->tx_date ?? ''}}" required>
                                       </div>
                                       <div class="col-md-4">
                                          <input name="amount" id="amount" type="text" class="form-control" placeholder="Enter Amount Figures in Euros" value="{{$business_edit->amount ?? ''}}" required>
                                       </div>
                                       <div class="col-md-4">
										   <select name="business_area_id" id="business_area_id" style="width:100%" required>
    											<option>Choose Tx Mode</option>
    										    <option value="0" selected>Cash</option>
    										    <option value="2">Offline</option>
    										    <option value="1">Online</option>
										   </select>
                                       </div>
									   <div class="col-md-12">
                                          <textarea name="remarks" id="remarks" type="text" class="form-control" placeholder="Write some Internal Notes" value="{{$business_edit->remarks ?? ''}}" required>
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
                                        <button class="btn btn-success btn-cons" type="submit"><i class="icon-ok"></i> Accept Tx</button>
                                        <button class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i> Reject Tx</button>
                                    @else
                                        <button class="btn btn-info btn-cons" type="submit"><i class="icon-ok"></i> Add Money to Wallet</button>
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