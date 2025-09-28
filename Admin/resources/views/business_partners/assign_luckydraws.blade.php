@extends('layout')
@section('title','Assign Luckydraws')
@section('content')

               <ul class="breadcrumb">
                  <li><p>Dashboard</p></li>
                  <li><a href="#" class="active">Business Partners</a> </li>
                  <li><a href="#" class="active">View Business Partner</a> </li>
                  <li><a href="#" class="active">Assign Luckydraws</a> </li>
               </ul>
               <div class="row">
                  <div class="col-md-12">
                     <div class="grid simple form-grid">
                        <div class="grid-title no-border">
                           <h3><span class="semi-bold"><i class="fa fa-user"></i> Assign Luckydraws</span></h3>
                        </div>
                        <div class="grid-body no-border">
                           <form class="form-no-horizontal-spacing" id="form-condensed" action="{{route('business_partners.assign_luckydraws.update', $business_edit->id)}}" method="POST" enctype="multipart/form-data">
                               @csrf
                              <div class="row column-seperation">
                                 <div class="col-md-12">
                                    <h4>Basic Information</h4>
                                    
                                    <div class="row form-row">
                                       <div class="col-md-6">
                                           <label>Region</label>
										   <select name="region_id[]" id="region_id" class="select2" style="width:100%" onchange="get_region($(this),{{$business_edit->country_id ?? ''}});" multiple required>
											 
											  <option value="all">All Regions</option>
											  @foreach($region as $regions)
        <option value="{{ $regions->id }}"
            @if(isset($business_edit) && in_array($regions->id, explode(',', $business_edit->region_id ?? '')))
                selected
            @endif
        >{{ $regions->region_name }}</option>
    @endforeach
										   </select>
                                       </div>
									   <div class="col-md-6">
									       <label>Country</label>
										   <select name="country_id[]" id="country_id" class="select2" style="width:100%" onchange="get_country($(this));" multiple required>
											 
											 
										   </select>
                                       </div>
                                       
                                    </div>
                                     <input type="hidden" name="hidden_region" id="hidden_region" value="{{$business_edit->region_id ?? ''}}"/>
                                       <input type="hidden" name="hidden_country" id="hidden_country" value="{{$business_edit->country_id ?? ''}}"/>
                                       <input type="hidden" name="hidden_state" id="hidden_state" value="{{$business_edit->state_id ?? ''}}"/>
                                       <input type="hidden" name="hidden_city" id="hidden_city" value="{{$business_edit->city_id ?? ''}}"/>
                                    
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-12">
                                    <input type="hidden" name="luckydraw_edit_id" id="luckydraw_edit_id" value="{{$business_edit->luckydraw_id ?? ''}}" />
                                 </div>
								<div class="col-md-12">
								  <div class="grid simple ">
									<div class="grid-title no-border">
									<div class="grid-body no-border">
									  <h3>Assign / Allocate <span class="semi-bold">Luckydraws</span> {{$business_edit->poc_first_name}}</h3>
									  <br>
									  <table class="table table-bordered no-more-tables" id="example">
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
										    @foreach($luckydraw as $luckydraws)
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
                                     <label style="color:red;display:none" id="error_msg">You cannot assign Luckydraws because none have been selected</label>
                                     @if(isset($business_edit))
                                    <button class="btn btn-success btn-cons" id="btn-cons" type="submit"><i class="icon-ok"></i> Assign Luckydraws</button>
                                    @else
                                    <button class="btn btn-success btn-cons" type="submit"><i class="icon-ok"></i> Create Business Partner</button>
                                    @endif
                                    <button class="btn btn-white btn-cons" type="reset" onclick="history.back()">Cancel</button>
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
$('.select2').select2();    



function toggleButton() {
    if ($("input[name='luckydraw_id[]'][value!='']:checked").length > 0) {
        $("#btn-cons").prop("disabled", false);
        $('#error_msg').hide();
    } else {
        $('#error_msg').show();
        $("#btn-cons").prop("disabled", true);
    }
}

toggleButton();

$(document).on("change", "input[name='luckydraw_id[]']", function () {
    toggleButton();
});


    // $('input[type=checkbox][name="luckydraw_id[]"]:checked').each(function(key,val){
    //     // console.log($(val));
    //     get_luckydraw_check($(val));
    // })
    // get_country($('#hidden_country'),$('#hidden_state'));
    // $('#city_id').on('change',function(){
    // console.log($(this).val());
   get_region($('#hidden_region'),$('#hidden_country').val());
  get_country($('#hidden_country'));
//     get_state($('#hidden_state'),$('#hidden_city'));
  if ($('#luckydraw_edit_id').val() > 0) {
        var region_ids = $('#hidden_region').val() ? $('#hidden_region').val().split(',') : []; // Split or empty array
        var country_ids = $('#hidden_country').val(); // Keep as string or undefined
        $('#region_id').val(region_ids).trigger('change'); // Set and trigger select2 for regions
        get_region($('#region_id'), country_ids); // Pass region dropdown and country IDs

        // Fetch lucky draw data for edit mode
        var region_id = $('#hidden_region').val();
        var country_id = $('#hidden_country').val();
        $('#allocate_div').html('');
        $.ajax({
            url: "{{ url('business_partners/partner/get_luckydraw_data') }}",
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
                "region_ids": region_id, // Send as comma-separated string or array
                "country_ids": country_id // Send as comma-separated string or array
            },
            success: function(data) {
                var tr = '';
                $(data).each(function(key, value) {
                    tr += `<tr>
                        <td>
                            <div class="checkbox check-default">
                                <input id="checkbox${value['id']}" type="checkbox" value="${value['id']}" name="luckydraw_id[]" >
                                <label for="checkbox${value['id']}"></label>
                            </div>
                        </td>
                        <td class="text-center">${value['luckydraw_name']}</td>
                        <td class="text-right">${value['region_name']}</td>
                        <td class="text-right">${value['country_name']}</td>
                        <td class="text-right"><i class="fa fa-euro"></i>${value['price']}</td>
                        <td class="text-center">
                            <span class="label label-success">
                                Active
                            </span>
                        </td>
                    </tr>`;
                });

                $('#allocate_div').append(tr);

                // Pre-check checkboxes based on luckydraw_edit_id
                var selectedIds = $("input[name='luckydraw_edit_id']").val().split(',');
                $("input[name='luckydraw_id[]']").each(function() {
                    if (selectedIds.includes($(this).val())) {
                        $(this).prop("checked", true);
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching lucky draw data:', error);
            }
        });
    }
   


function get_luckydraw_data() {
    var region_ids = $('#region_id').val(); // Array of region IDs
    var country_ids = $('#country_id').val(); // Array of country IDs

    $('#allocate_div').html(''); // Clear table body

    $.ajax({
        url: "{{ url('business_partners/partner/get_luckydraw_data') }}",
        type: "GET",
        data: {
            "_token": "{{ csrf_token() }}",
            "region_ids": region_ids, // Send array of region IDs
            "country_ids": country_ids // Send array of country IDs
        },
        success: function(data) {
            var tr = '';
            $(data).each(function(key, value) {
                tr += `<tr>
                    <td>
                        <div class="checkbox check-default">
                            <input id="checkbox${value['id']}" type="checkbox" value="${value['id']}" name="luckydraw_id[]" >
                            <label for="checkbox${value['id']}"></label>
                        </div>
                    </td>
                    <td class="text-center">${value['luckydraw_name']}</td>
                    <td class="text-right">${value['region_name']}</td>
                    <td class="text-right">${value['country_name']}</td>
                    <td class="text-right"><i class="fa fa-euro"></i>${value['price']}</td>
                    <td class="text-center">
                        <span class="label label-success">
                            Active
                        </span>
                    </td>
                </tr>`;
            });

            $('#allocate_div').append(tr);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching lucky draw data:', error);
        }
    });
}

    $('#region_id, #country_id').on('change', function() {
        // console.log('Change event detected'); // Debugging log
        get_luckydraw_data();
    });
    
    
    
      $('.checkall').on('change', function () {
            let isChecked = $(this).is(':checked');
            
            // Loop through each checkbox inside the table (excluding disabled ones)
            $('input[name="luckydraw_id[]"]').each(function () {
                if (!$(this).is(':disabled')) {
                    $(this).prop('checked', isChecked);
                    toggleButton();
                }
            });
        });
});

    // function get_luckydraw_data(){
    //     console.log('test');
    // }
// $('#region_id, #country_id').on('change', get_luckydraw_data);
    // $('#region_id,#country_id').on('change',get_luckydraw_data);

//   function get_region(val, selected_country_ids) {
//     // Get multiple region IDs from the select2 dropdown
//     var region_ids = $(val).val(); // Returns an array if multiple selections are made
//     var country_ids = selected_country_ids ? selected_country_ids.split(',') : []; // Convert comma-separated string to array

//     $('#country_id').html(''); // Clear existing options

//     $.ajax({
//         url: "{{ url('business_partners/partner/get_region') }}",
//         type: "GET",
//         data: {
//             "_token": "{{ csrf_token() }}",
//             "region_ids": region_ids // Send array of region IDs
//         },
//         success: function(data) {
//             console.log(data);

//             $('#country_id').empty(); // Clear options
//             $('#country_id').append('<option>Select Country</option><option value="all">All Country</option>');

//             // Populate countries
//             $(data).each(function(key, value) {
//                 var select = country_ids.includes(value.id.toString()) ? 'selected' : '';
//                 $('#country_id').append('<option value="' + value.id + '" ' + select + '>' + value.country_name + '</option>');
//             });

//             $('#country_id').select2(); // Reinitialize select2
//         },
//         error: function(xhr, status, error) {
//             console.error('Error fetching countries:', error);
//         }
//     });
// }
    
    
    function get_region(val, selected_country_ids) {
    // Get multiple region IDs from the select2 dropdown
    var region_ids = $(val).val() || []; // Fallback to empty array if null/undefined
    var country_ids = Array.isArray(selected_country_ids) 
        ? selected_country_ids 
        : (selected_country_ids && typeof selected_country_ids === 'string') 
            ? selected_country_ids.split(',') 
            : []; // Handle string or fallback to empty array


 // If "All" is selected, disable other options
        $('#region_id option').prop('disabled', false);
    
    // If "All" is selected, disable all other options
    if (region_ids.includes("all")) {
        $('#region_id option').each(function () {
            if ($(this).val() !== "all") {
                $(this).prop('disabled', true).prop('selected', false); // Disable and deselect others
            }
        });
    } else if (region_ids.length > 0) {
        // If any other option is selected, disable the "All" option
        $('#region_id option[value="all"]').prop('disabled', true).prop('selected', false);
    }

    $('#country_id').html(''); // Clear existing options

    $.ajax({
        url: "{{ url('business_partners/partner/get_region') }}",
        type: "GET",
        data: {
            "_token": "{{ csrf_token() }}",
            "region_ids": region_ids // Send array of region IDs
        },
        success: function(data) {
            console.log('Countries received:', data);

            $('#country_id').empty(); // Clear options
            $('#country_id').append('<option value="all">All Counties</option>');

            // Populate countries
            $(data).each(function(key, value) {
                var select = country_ids.includes(value.id.toString()) ? 'selected' : '';
                $('#country_id').append('<option value="' + value.id + '" ' + select + '>' + value.country_name + '</option>');
            });

            $('#country_id').select2(); // Reinitialize select2
            
            
            get_country('#country_id');
        },
        error: function(xhr, status, error) {
            console.error('Error fetching countries:', error);
        }
    });
}


function get_country(val) {
    console.log('yes');
if ($('#country_id option').length === 0) return;
    var countryIds = $(val).val() || [];
    console.log(countryIds);
    
    if (!Array.isArray(countryIds)) {
        countryIds = countryIds ? [countryIds] : [];
    }

    // Filter out undefined/null values just in case
    countryIds = countryIds.filter(Boolean);

    var regionIds = $('#region_id').val() || [];

    // Handle option disabling
    if (countryIds.includes("all")) {
        console.log('yes');
        $('#country_id option').prop('disabled', true);
        $('#country_id option[value="all"]').prop('disabled', false);
    } else {
        console.log('no');
        $('#country_id option').prop('disabled', false);
        if (countryIds.length > 0) {
            $('#country_id option[value="all"]').prop('disabled', true);
        }
    }
    
    
    
}
    
    //  function get_country(){
         
    //      console.log('yes');
    //       var countryIds = $(this).val() || [];
    // var regionIds = $('#region_id').val() || []; // get selected region(s)

    // // Convert countryIds to array if it's a string (for single-select)
    // if (!Array.isArray(countryIds)) {
    //     countryIds = countryIds ? [countryIds] : [];
    // }

    // // Handle option disabling
    // if (countryIds.includes("all")) {
    //     console.log('yes');
    //     // If "all" is selected, disable all other options
    //     $('#country_id option').prop('disabled', true);
    //     $('#country_id option[value="all"]').prop('disabled', false);
    // } else {
    //     console.log('no');
    //     // If specific countries are selected, disable "all" option
    //     $('#country_id option').prop('disabled', false);
    //     if (countryIds.length > 0) {
    //         $('#country_id option[value="all"]').prop('disabled', true);
    //     }
    // }
    // //  console.log(id)
    // //  $('#state_id').html('');
    // //   $('#city_id').html('');
    // // var country_id = $(val).val();
    // // var state_id = $(id).val();
    // // // console.log(state_id);
   
    // // $.ajax({
    // //         url: "{{ url('business_partners/partner/get_country') }}",
    // //         type: "GET",
    // //         data: {
    // //             "_token": "{{ csrf_token() }}",
    // //             "country_id" :  country_id,
                
    // //         },
    // //         success: function(data) {
    // //             // console.log(data);
    // //             // console.log(data['doneMessage']);
    // //              $('#state_id').append('<option>Select State</option>')
    // //              $(data).each(function(key, value) {
    // //                   var select = '';
    // //                   if(state_id == value.id){
    // //                       select = 'selected';
    // //                   }
    // //                   else{
    // //                       select = '';
    // //                   }
    // //             //     // console.log(value.address);
    // //                 $('#state_id').append('<option value='+value.id+' '+select+'>'+value.state_title+'</option>')
    // //             });
              

    // //         }
    // //     });
    // }
    
    // function get_state(val,id){
    //     // console.log($(id).val());
    //     $('#city_id').html('');
    //      var state_id = $(val).val();
    //      var city_id = $(id).val();
    //          $.ajax({
    //         url: "{{ url('business_partners/partner/get_state') }}",
    //         type: "GET",
    //         data: {
    //             "_token": "{{ csrf_token() }}",
    //             "state_id" :  state_id,
                
    //         },
    //         success: function(data) {
    //             // console.log(data);
    //             // console.log(data['doneMessage']);
    //              $('#city_id').append('<option>Select City</option>')
    //              $(data).each(function(key, value) {
    //                   var select = '';
    //                   if(city_id == value.id){
    //                       select = 'selected';
    //                   }
    //                   else{
    //                       select = '';
    //                   }
    //             //     // console.log(value.address);
    //                 $('#city_id').append('<option value='+value.id+' '+select+'>'+value.name+'</option>')
    //             });
              

    //         }
    //     });

    // }
    
    
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