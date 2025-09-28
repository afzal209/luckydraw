@extends('layout') @section('title','Assign Bulk Luckydraws') @section('content')
<ul class="breadcrumb">
  <li> <p>Dashboard</p> </li>
  <li><a href="#" class="active">Business Partners</a></li>b
  <li><a href="#" class="active">View Business Partner</a></li>
  <li><a href="#" class="active">Assign Bulk Luckydraws</a></li>
</ul>
<div class="row">
  <div class="col-md-12">
    <div class="grid simple form-grid">
      <div class="grid-body no-border">
        <form class="form-no-horizontal-spacing" id="form-condensed" action="{{route('business_partners.assign_luckydraws.bulk.update')}}" method="post" enctype="multipart/form-data" name="form-condensed" >
          @csrf
          <div class="row column-seperation">
            <div class="col-md-6">
              <h3><span class="semi-bold">Filters for Business Partners</span></h3>    
              <div class="row form-row">
                <div class="col-md-4">
                    <lable>Business Area<font color="red">*</font></lable>
                  <select name="area_name[]" id="area_name" class="select2" style="width:100%"   multiple onchange="get_area_business($(this))">
                    <option value="all">All Business Areas</option>
                    @foreach($business_area as $business_areas)
                    <option value="{{$business_areas->id}}">{{$business_areas->area_name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-4">
                    <lable>Region<font color="red">*</font></lable>
                  <select name="region_id[]" id="region_id" class="select2" style="width:100%"  multiple onchange="get_region_business($(this))">
                    <option value="all">All Regions</option>
                    @foreach($region as $regions)
                    <option value="{{$regions->id}}" >{{$regions->region_name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-4">
                    <lable>Country</lable>
                  <select name="country_id[]" id="country_id" class="select2" style="width:100%" multiple onchange="get_country_business($(this));">
                    <option value="all">All Countries</option>
                  </select>
                </div>
              </div>
              <input type="hidden" name="hidden_region" id="hidden_region" value=""> 
              <input type="hidden" name="hidden_country" id="hidden_country" value="{{$business_edit->country_id ?? ''}}"> 
              <input type="hidden" name="hidden_state" id="hidden_state" value="{{$business_edit->state_id ?? ''}}"> 
              <input type="hidden" name="hidden_city" id="hidden_city" value="{{$business_edit->city_id ?? ''}}">
            </div>
            <div class="col-md-6">
              <h3><span class="semi-bold">Filters for Bulk Luckydraws</span></h3>    
              <div class="row form-row">
                <div class="col-md-6">
                    <lable>Region<font color="red">*</font></lable>
                    <select name="region_id[]" id="region_ly_id" class="select2" style="width:100%"  multiple onchange="get_region_luckydraw($(this))">
                        <option value="all">All Regions</option>
                        @foreach($region as $regions)
                            <option value="{{$regions->id}}" >{{$regions->region_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <lable>Country</lable>
                    <select name="country_id[]" id="country_ly_id" class="select2" style="width:100%" multiple onchange="get_country_luckydraw($(this))">
                        <option value="all">All Countries</option>
                    </select>
                </div>
              </div>
             <input type="hidden" name="hidden_region" id="hidden_region" value=""> 
             <input type="hidden" name="hidden_country" id="hidden_country" value="{{$business_edit->country_id ?? ''}}"> 
             <input type="hidden" name="hidden_state" id="hidden_state" value="{{$business_edit->state_id ?? ''}}"> 
             <input type="hidden" name="hidden_city" id="hidden_city" value="{{$business_edit->city_id ?? ''}}">              
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <input type="hidden" name="luckydraw_edit_id" id="luckydraw_edit_id" value="{{$business_edit->luckydraw_id ?? ''}}">
            </div>
            <div class="col-md-12">
              <div class="grid simple">
                <div class="grid-title no-border">
                  <div class="grid-body no-border">
                    <h3>Assign / Allocate <span class="semi-bold">Luckydraws</span> </h3><br>
                   
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered no-more-tables" id="example">
                      <thead>
                        <tr>
                          <th style="width:1%">
                            <div class="checkbox check-default">
                              <input id="checkbox_bp0" type="checkbox" value="1" class="checkall">
                              <label for="checkbox_bp0"></label>
                            </div>
                          </th>
                          <th class="text-center" style="width:8.5%">Business Partners</th>
                          
                        </tr>
                      </thead>
                      <tbody id="allocate_div_bp">
                        <tr>
                          <td>
                            <div class="checkbox check-default_bp0">
                              <input id="business_partner_id" type="checkbox" name="business_partner_id[]" value="">
                            </div>
                          </td>
                          <td class="text-center"></td>
                         
                        </tr>
                      </tbody>
                    </table>
            </div>
            
            <div class="col-md-6">
                <table class="table table-bordered no-more-tables" id="example1">
                      <thead>
                        <tr>
                          <th style="width:1%">
                            <div class="checkbox check-default">
                              <input id="checkbox_ly0" type="checkbox" value="1" class="checkall1">
                              <label for="checkbox_ly0"></label>
                            </div>
                          </th>
                          <th class="text-center" style="width:8.5%">Luckydraw Name</th>
                          
                        </tr>
                      </thead>
                      <tbody id="allocate_div_ly">
                        <tr>
                          <td>
                            <div class="checkbox check-default_ly0">
                              <input id="luckydraw_id" type="checkbox" name="luckydraw_id[]" value="">
                            </div>
                          </td>
                          <td class="text-center"></td>
                         
                        </tr>
                      </tbody>
                    </table>
            </div>
          </div>
          <div class="form-actions">
            <div class="pull-left">
              <div class="luckydraw_checkbox"></div>
            </div>
            <div class="pull-right">
                <label style="color:red;display:none" id="error_msg">You cannot assign Luckydraws because none have been selected</label>
                <button class="btn btn-success btn-cons" id="btn-cons" type="submit"><i class="icon-ok"></i> Add Bulk Luckydraw</button>
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
<script >
    $(document).ready(function() {
        
        $('.select2').select2();  
        
        
      function toggleButton() {
    // Check if any checkbox (with real value) is selected
    if ($("input[name='business_partner_id[]'][value!='']:checked").length > 0 && 
        $("input[name='luckydraw_id[]'][value!='']:checked").length > 0) {
        
        $("#btn-cons").prop("disabled", false); // enable
        $('#error_msg').hide();
    } else {
        $('#error_msg').show();
        $("#btn-cons").prop("disabled", true);  // disable
    }
}

// Initial state on page load
toggleButton();

// Delegate event listener because checkboxes are dynamic
$(document).on("change", "input[name='business_partner_id[]'], input[name='luckydraw_id[]']", function () {
    toggleButton();
});


        
        
        // $('input[type=checkbox][name="luckydraw_id[]"]:checked').each(function(key,val){
        //     // console.log($(val));
        //     get_luckydraw_check($(val));
        // })
        // get_country($('#hidden_country'),$('#hidden_state'));
        // $('#city_id').on('change',function(){
        // console.log($(this).val());
        // get_region($('#hidden_region'), $('#hidden_country').val());
        // get_country($('#hidden_country'), $('#hidden_state'))
        // get_state($('#hidden_state'), $('#hidden_city'));
        // if ($('#luckydraw_edit_id').val() > 0) {
        //     var region_id = $('#hidden_region').val();
        //     var country_id = $('#hidden_country').val();
        //     // })
        //     $('#allocate_div').html('');
        //     $.ajax({
        //         url: "{{ url('business_partners/partner/get_bp_luckydraw_data') }}",
        //         type: "GET",
        //         data: {
        //             "_token": "{{ csrf_token() }}",
        //             "region_id": region_id,
        //             "country_id": country_id
        //         },
        //         success: function(data) {
        //             // console.log(data);
        //             // console.log(data['doneMessage']);
        //             var tr = '';
        //             $(data).each(function(key, value) {
        //                 tr += `<tr>
        //                 <td>
        //                     <div class="checkbox check-default" >
        //                         <input id="checkbox${value['id']}" type="checkbox" value="${value['id']}" name="luckydraw_id[]"  ${value['status'] == 0 ? '' : 'disabled'} >
        //                         <label for="checkbox${value['id']}"></label>
        //                     </div>
        //                 </td>
        //                 <td class="text-center">${value['luckydraw_name']}</td>
        //                 <td class="text-right">${value['region_name']}</td>
        //                 <td class="text-right">${value['country_name']}</td>
        //                 <td class="text-right"><i class="fa fa-euro"></i>${value['price']}</td>
        //                 <td class="text-center">
        //                     <span class="label ${value['status'] == 0 ? 'label-success' : 'label-important'}">
        //                         ${value['status'] == 0 ? 'In-Active' : 'Active'}
        //                     </span>
        //                 </td>
        //             </tr>`;
        //             })
        //             $('#allocate_div').append(tr);
        //             var selectedIds = $("input[name='luckydraw_edit_id']").val().split(',');
        //             // console.log(selectedIds);
        //             // Loop through each checkbox and check if its value is in the array
        //             $("input[name='luckydraw_id[]']").each(function() {
        //                 if (selectedIds.includes($(this).val())) {
        //                     $(this).prop("checked", true);
        //                 }
        //             });
        //         }
        //     });
        // }
        // function get_bp_luckydraw_data() {
        //     var area_name = $('#area_name').val();
        //     var region_id = $('#region_id').val();
        //     var country_id = $('#country_id').val();
            
        //     // console.log('Luckydraw data function triggered');
        //     $('#allocate_div_bp').html('');
        //     $('#allocate_div_ly').html('');
        //     $.ajax({
        //         url: "{{ url('business_partners/partner/get_bp_luckydraw_data') }}",
        //         type: "GET",
        //         data: {
        //             "_token": "{{ csrf_token() }}",
        //             "area_name": area_name,
        //             "region_id" : region_id,
        //             "country_id" : country_id
        //         },
        //         success: function(data) {
        //             // console.log(data);
        //             // console.log(data['doneMessage']);
        //             var tr = '';
        //             $(data.Business_Partner).each(function(key, value) {
        //                 tr += `<tr>
        //           <td>
        //                                                                                   <div class="checkbox check-default" >
        //                                                                                         <input id="checkbox_bp${value['id']}" type="checkbox" value="${value['id']}" name="business_partner_id[]"   >
        //                                                                                         <label for="checkbox_bp${value['id']}"></label>
        //                                                                                   </div>
        //                                                                                 </td>
        //                                                                                 <td class="text-center">${value['poc_first_name']}</td>
                                                                        
                                            
        //           </tr>`;
        //             })
        //             $('#allocate_div_bp').append(tr);
                    
                    
        //              var tr = '';
        //             $(data.Luckydraw).each(function(key, value1) {
        //                 tr += `<tr>
        //           <td>
        //                                                                                   <div class="checkbox check-default" >
        //                                                                                         <input id="checkbox_ly${value1['id']}" type="checkbox" value="${value1['id']}" name="luckydraw_id[]"   >
        //                                                                                         <label for="checkbox_ly${value1['id']}"></label>
        //                                                                                   </div>
        //                                                                                 </td>
        //                                                                                 <td class="text-center">${value1['luckydraw_name']}</td>
                                                                        
                                            
        //           </tr>`;
        //             })
        //             $('#allocate_div_ly').append(tr);
        //         }
        //     });
        // }
        
        
        
        
        
        
        function get_bp_business_data() {
        var area_name = $('#area_name').val() || [];
        var region_id = $('#region_id').val() || [];
        var country_id = $('#country_id').val() || [];

        $('#allocate_div_bp').html('');
        // $('#allocate_div_ly').html('');

        $.ajax({
            url: "{{ url('business_partners/partner/get_bp_business_data') }}",
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
                "area_name": area_name,
                "region_id": region_id,
                "country_id": country_id,
            },
            success: function (data) {
                 $('#allocate_div_bp').html('');
        // $('#allocate_div_ly').html('');
                var bp_rows = '';
                $.each(data.Business_Partner, function (key, value) {
                    bp_rows += `<tr>
                        <td>
                            <div class="checkbox check-default_bp${value.id}">
                                <input id="checkbox_bp${value.id}" type="checkbox" value="${value.id}" name="business_partner_id[]">
                                <label for="checkbox_bp${value.id}"></label>
                            </div>
                        </td>
                        <td class="text-center">${value.poc_first_name}</td>
                    </tr>`;
                });
                $('#allocate_div_bp').append(bp_rows);

                // var ly_rows = '';
                // $.each(data.Luckydraw, function (key, value) {
                //     ly_rows += `<tr>
                //         <td>
                //             <div class="checkbox check-default">
                //                 <input id="checkbox_ly${value.id}" type="checkbox" value="${value.id}" name="luckydraw_id[]">
                //                 <label for="checkbox_ly${value.id}"></label>
                //             </div>
                //         </td>
                //         <td class="text-center">${value.luckydraw_name}</td>
                //     </tr>`;
                // });
                // $('#allocate_div_ly').append(ly_rows);
            },
            error: function (xhr, status, error) {
                console.error('Error fetching data:', error);
                alert('Failed to load data. Please try again.');
            },
        });
    }
    
    
    
      function get_bp_luckydraw_data() {
        
        var region_ly_id = $('#region_ly_id').val() || [];
        var country_ly_id = $('#country_ly_id').val() || [];

        // $('#allocate_div_bp').html('');
        $('#allocate_div_ly').html('');

        $.ajax({
            url: "{{ url('business_partners/partner/get_bp_luckydraw_data') }}",
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
                "region_ly_ids": region_ly_id,
                "country_ly_ids": country_ly_id,
            },
            success: function (data) {
                //  $('#allocate_div_bp').html('');
        $('#allocate_div_ly').html('');
                

                var ly_rows = '';
                $.each(data.Luckydraw, function (key, value) {
                    ly_rows += `<tr>
                        <td>
                            <div class="checkbox check-default_ly${value.id}">
                                <input id="checkbox_ly${value.id}" type="checkbox" value="${value.id}" name="luckydraw_id[]">
                                <label for="checkbox_ly${value.id}"></label>
                            </div>
                        </td>
                        <td class="text-center">${value.luckydraw_name}</td>
                    </tr>`;
                });
                $('#allocate_div_ly').append(ly_rows);
            },
            error: function (xhr, status, error) {
                console.error('Error fetching data:', error);
                alert('Failed to load data. Please try again.');
            },
        });
    }
        
        
        $('#area_name, #region_id, #country_id').on('change', function() {
            // console.log('Change event detected'); // Debugging log
            if ($(this).is('#area_name')) {
                $('#region_id option').prop('select',false);
                $('#country_id option').prop('select',false);
            }
            get_bp_business_data();
        });
        
        $('#region_ly_id, #country_ly_id').on('change', function() {
            // console.log('Change event detected'); // Debugging log
           
            get_bp_luckydraw_data();
        });
        
        $('.checkall').on('change', function() {
            let isChecked = $(this).is(':checked');
            // Loop through each checkbox inside the table (excluding disabled ones)
            $('input[name="business_partner_id[]"]').each(function() {
                if (!$(this).is(':disabled')) {
                    $(this).prop('checked', isChecked);
                    toggleButton()
                }
            });
        });
        $('.checkall1').on('change', function() {
            let isChecked = $(this).is(':checked');
            // Loop through each checkbox inside the table (excluding disabled ones)
            $('input[name="luckydraw_id[]"]').each(function() {
                if (!$(this).is(':disabled')) {
                    $(this).prop('checked', isChecked);
                    toggleButton()
                }
            });
        });
    });
// function get_bp_luckydraw_data(){
//     console.log('test');
// }
// $('#region_id, #country_id').on('change', get_bp_luckydraw_data);
// $('#region_id,#country_id').on('change',get_bp_luckydraw_data);
// function get_region(val, id) {
//     //  console.log(id)
//     $('#country_id').html('');
//     var region_id = $(val).val();
//     var country_id = id;
//     console.log(country_id);
//     $.ajax({
//         url: "{{ url('business_partners/partner/get_region') }}",
//         type: "GET",
//         data: {
//             "_token": "{{ csrf_token() }}",
//             "region_id": region_id,
//         },
//         success: function(data) {
//             console.log(data);
//             // console.log(data['doneMessage']);
//             $('#country_id').append('<option>Select Country</option> <option value="all">All Countries</option>')
//             $(data).each(function(key, value) {
//                 var select = '';
//                 if (country_id == value.id) {
//                     select = 'selected';
//                 }
//                 $('#country_id').append('<option value="' + value.id + '" ' + select + '>' + value.country_name + '</option>');
//             });
//         }
//     });
// }


$('#area_name, #region_id, #country_id').on('change', function () {
        if ($(this).is('#area_name')) {
            $('#region_id').val(null).trigger('change'); // Clear region
            $('#country_id').val(null).trigger('change'); // Clear country
        } else if ($(this).is('#region_id')) {
            $('#country_id').val(null).trigger('change'); // Clear country
        }
        get_bp_business_data();
    });

$('#region_ly_id, #country_ly_id').on('change', function () {
        if ($(this).is('#area_name')) {
            $('#region_ly_id').val(null).trigger('change'); // Clear region
            $('#region_ly_id').val(null).trigger('change'); // Clear country
        } else if ($(this).is('#region_id')) {
            $('#region_ly_id').val(null).trigger('change'); // Clear country
        }
        get_bp_luckydraw_data();
    });


    // Check all checkboxes for Business Partners
    $('.checkall').on('change', function () {
        let isChecked = $(this).is(':checked');
        $('input[name="business_partner_id[]"]').not(':disabled').prop('checked', isChecked);
    });

    // Check all checkboxes for Lucky Draws
    $('.checkall1').on('change', function () {
        let isChecked = $(this).is(':checked');
        $('input[name="luckydraw_id[]"]').not(':disabled').prop('checked', isChecked);
    });

    function get_area_business(val){
      
        var area_name = $(val).val() || [];
          console.log(area_name);
        // $('#country_id').html('<option>Select Country</option><option value="all">All Countries</option>');
        
        
         // If "All" is selected, disable other options
        $('#area_name option').prop('disabled', false);
    
    // If "All" is selected, disable all other options
    if (area_name.includes("all")) {
        $('#area_name option').each(function () {
            if ($(this).val() !== "all") {
                $(this).prop('disabled', true).prop('selected', false); // Disable and deselect others
            }
        });
    } else if (area_name.length > 0) {
        // If any other option is selected, disable the "All" option
        $('#area_name option[value="all"]').prop('disabled', true).prop('selected', false);
    }

    }


    // Fetch regions based on area
    function get_region_business(element) {
        var region_id = $(element).val() || [];
        // $('#country_id').html('<option>Select Country</option><option value="all">All Countries</option>');
        
        
         // If "All" is selected, disable other options
        $('#region_id option').prop('disabled', false);
    
    // If "All" is selected, disable all other options
    if (region_id.includes("all")) {
        $('#region_id option').each(function () {
            if ($(this).val() !== "all") {
                $(this).prop('disabled', true).prop('selected', false); // Disable and deselect others
            }
        });
    } else if (region_id.length > 0) {
        // If any other option is selected, disable the "All" option
        $('#region_id option[value="all"]').prop('disabled', true).prop('selected', false);
    }
 $('#country_id').html('').val(null).trigger('change');
      

        $.ajax({
            url: "{{ url('business_partners/partner/get_region') }}",
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
                "region_ids": region_id,
            },
            success: function (data) {
                $('#country_id').append(`<option value="all">All</option>`);
                $.each(data, function (key, value) {
                    $('#country_id').append(`<option value="${value.id}">${value.country_name}</option>`);
                });
                $('#country_id').trigger('change'); // Trigger change to refresh dependent data
                //  get_country('#country_id');
            },
            error: function (xhr, status, error) {
                console.error('Error fetching regions:', error);
            },
        });
    }
    
    
    
    
     // Fetch regions based on area
    function get_region_luckydraw(element) {
        var region_ly_id = $(element).val() || [];
        // $('#country_id').html('<option>Select Country</option><option value="all">All Countries</option>');
        
        
         // If "All" is selected, disable other options
        $('#region_ly_id option').prop('disabled', false);
    
    // If "All" is selected, disable all other options
    if (region_ly_id.includes("all")) {
        $('#region_ly_id option').each(function () {
            if ($(this).val() !== "all") {
                $(this).prop('disabled', true).prop('selected', false); // Disable and deselect others
            }
        });
    } else if (region_ly_id.length > 0) {
        // If any other option is selected, disable the "All" option
        $('#region_ly_id option[value="all"]').prop('disabled', true).prop('selected', false);
    }
 $('#country_ly_id').html('').val(null).trigger('change');
      

        $.ajax({
            url: "{{ url('business_partners/partner/get_region_luckydraw') }}",
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
                "region_ly_ids": region_ly_id,
            },
            success: function (data) {
                $('#country_ly_id').append(`<option value="all">All</option>`);
                $.each(data, function (key, value) {
                    
                    $('#country_ly_id').append(`<option value="${value.id}">${value.country_name}</option>`);
                });
                $('#country_ly_id').trigger('change'); // Trigger change to refresh dependent data
                //  get_country('#country_id');
            },
            error: function (xhr, status, error) {
                console.error('Error fetching regions:', error);
            },
        });
    }





function get_country_luckydraw(val) {
    console.log('yes');
if ($('#country_ly_id option').length === 0) return;
    var countryIds = $(val).val() || [];
    console.log(countryIds);
    
    if (!Array.isArray(countryIds)) {
        countryIds = countryIds ? [countryIds] : [];
    }

    // Filter out undefined/null values just in case
    countryIds = countryIds.filter(Boolean);

    var regionIds = $('#region_ly_id').val() || [];

    // Handle option disabling
    if (countryIds.includes("all")) {
        console.log('yes');
        $('#country_ly_id option').prop('disabled', true);
        $('#country_ly_id option[value="all"]').prop('disabled', false);
    } else {
        console.log('no');
        $('#country_ly_id option').prop('disabled', false);
        if (countryIds.length > 0) {
            $('#country_ly_id option[value="all"]').prop('disabled', true);
        }
    }
    
    
    
}



// function get_country(val, id) {
//     //  console.log(id)
//     $('#state_id').html('');
//     $('#city_id').html('');
//     var country_id = $(val).val();
//     var state_id = $(id).val();
//     // console.log(state_id);
//     $.ajax({
//         url: "{{ url('business_partners/partner/get_country') }}",
//         type: "GET",
//         data: {
//             "_token": "{{ csrf_token() }}",
//             "country_id": country_id,
//         },
//         success: function(data) {
//             // console.log(data);
//             // console.log(data['doneMessage']);
//             $('#state_id').append('<option>Select State</option>')
//             $(data).each(function(key, value) {
//                 var select = '';
//                 if (state_id == value.id) {
//                     select = 'selected';
//                 } else {
//                     select = '';
//                 }
//                 //     // console.log(value.address);
//                 $('#state_id').append('<option value=' + value.id + ' ' + select + '>' + value.state_title + '</option>')
//             });
//         }
//     });
// }

function get_country_business(val) {
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



// function get_country(element, selected_state_id) {
//     var country_ids = $(element).val() || []; // Get array of selected country IDs
//     $('#state_id').html('<option>Select State</option>'); // Clear state dropdown
//     $('#city_id').html('<option>Select City</option>'); // Clear city dropdown for consistency

//     $.ajax({
//         url: "{{ url('business_partners/partner/get_country') }}",
//         type: "GET",
//         data: {
//             "_token": "{{ csrf_token() }}",
//             "country_id": country_ids, // Send array of country IDs
//         },
//         beforeSend: function () {
//             $('#loading').show(); // Show loading indicator (add to HTML if needed)
//         },
//         success: function (data) {
//             $.each(data, function (key, value) {
//                 var selected = selected_state_id && selected_state_id.includes(value.id.toString()) ? 'selected' : '';
//                 $('#state_id').append(`<option value="${value.id}" ${selected}>${value.state_title}</option>`);
//             });
//             $('#state_id').trigger('change'); // Trigger change to refresh dependent dropdowns (e.g., cities)
//         },
//         error: function (xhr, status, error) {
//             console.error('Error fetching states:', error);
//             alert('Failed to load states. Please try again.');
//         },
//         complete: function () {
//             $('#loading').hide(); // Hide loading indicator
//         }
//     });
// }
// function get_state(val, id) {
//     // console.log($(id).val());
//     $('#city_id').html('');
//     var state_id = $(val).val();
//     var city_id = $(id).val();
//     $.ajax({
//         url: "{{ url('business_partners/partner/get_state') }}",
//         type: "GET",
//         data: {
//             "_token": "{{ csrf_token() }}",
//             "state_id": state_id,
//         },
//         success: function(data) {
//             // console.log(data);
//             // console.log(data['doneMessage']);
//             $('#city_id').append('<option>Select City</option>')
//             $(data).each(function(key, value) {
//                 var select = '';
//                 if (city_id == value.id) {
//                     select = 'selected';
//                 } else {
//                     select = '';
//                 }
//                 //     // console.log(value.address);
//                 $('#city_id').append('<option value=' + value.id + ' ' + select + '>' + value.name + '</option>')
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