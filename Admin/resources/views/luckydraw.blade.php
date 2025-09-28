@extends('layout')
@section('title','Manage Luckydraw')
@section('content')
    <style>
        .select2-container--default .select2-results__option {
            padding-left: 25px;
            position: relative;
        }
        .select2-container--default .select2-results__option::before {
            content: "";
            display: inline-block;
            position: absolute;
            left: 5px;
            top: 7px;
            width: 14px;de
            height: 14px;
            border: 1px solid #ccc;
            background-color: #fff;
        }
        .select2-container--default .select2-results__option[aria-selected=true]::before {p
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
    <ul class="breadcrumb">
        <li><p>Dashboard</p></li>
        <li><a href="#" class="active">View  Luckydraw</a> </li>
    </ul>
    <!-- END DROPDOWN CONTROLS-->
	<div class="row-fluid">
		<div class="span12">
			<div class="grid simple ">
				<div class="grid-title">
					<h3><i class="fa fa-file"></i><span class="semi-bold"> View  Luckydraws</span></h3>
				</div>
				<div class="grid-body ">
					<table class="table table-striped" id="example">
						<thead>
							<tr>
								<th>Luckydraw Name</th>
								<th>Template</th>
								<th>Price</th>
								<th>Regions</th>
								<th>Countries</th>
								<th>No.Of Prizes</th>
								<th>Prizes</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						    @foreach($luckydraws as $luckydraw)
							    @php
							        $luckydraw_sale = App\Models\Sale::where('luckydraw_id','=',$luckydraw->id)->count('luckydraw_id');
							    @endphp
							    @if($luckydraw->winner_status == 1)
								    @php 
									    $luckydraw_sale_customer = App\Models\Sale::select('sales.ticket_id','customers.first_name','customers.email','customers.mobile','business_partners.poc_first_name','business_partners.poc_mobile')
                                        ->join('business_partners', 'business_partners.id', '=', 'sales.partner_id')
                                        ->join('customers', 'customers.customer_id', '=', 'sales.customer_id')->where('sales.ticket_id','=',$luckydraw->ticket_id)
                                        ->first();  
								    @endphp
								@endif
								<tr>
									<td>
									    {{$luckydraw->luckydraw_name}}<br>Start Date : {{$luckydraw->start_date}}<br>End Date : {{$luckydraw->end_date}}
									    <br>
									    @if($luckydraw->status == 0)
								            <b>{{'Inactive'}}</b>
										@else
										    <b>{{'Active'}}</b>
										@endif
									    <br><br>
									    <h4 style="color:blue;"><b>
										    @if($luckydraw->frequency == 1)
										        {{'Daily'}}
										    @elseif($luckydraw->frequency == 2)
										        {{'Weekly'}}
										    @elseif($luckydraw->frequency == 3)
										        {{'Monthly'}}
										    @elseif($luckydraw->frequency == 4)
										        {{'Yearly'}}
										    @else
										        {{'N/A'}}
										    @endif
									    </b></h4>
									</td>
									@php
                                        $template_ids = [];
                                        $template_names = [];
                                    @endphp
                                    @if($luckydraw->template_id == 'all')
                                        @if($luckydraw->template_option == 1)
                                            @php
                                                $template_ids = $luckydraw->template_luckydraw_id ? explode(',', $luckydraw->template_luckydraw_id) : [];
                                                $template_names = \App\Models\Template_Manager::whereIn('id', $template_ids)
                                                ->pluck('template_name as names')
                                                ->toArray();
                                            @endphp
                                        @else
                                            @php
                                                $template_ids = $luckydraw->template_group_id ? explode(',', $luckydraw->template_group_id) : [];
                                                $template_names = \App\Models\Template_group::whereIn('id', $template_ids)
                                                ->pluck('group_name as names')
                                                ->toArray();
                                            @endphp
                                        @endif
                                    @else
                                        @if($luckydraw->template_option == 1)
                                            @php
                                                $template_ids = $luckydraw->template_id ? explode(',', $luckydraw->template_id) : [];
                                                $template_names = \App\Models\Template_Manager::whereIn('id', $template_ids)
                                                ->pluck('template_name as names')
                                                ->toArray();
                                            @endphp
                                        @else
                                            @php
                                                $template_ids = $luckydraw->template_group_id ? explode(',', $luckydraw->template_group_id) : [];
                                                $template_names = \App\Models\Template_group::whereIn('id', $template_ids)
                                                ->pluck('group_name as names')
                                                ->toArray();
                                            @endphp
                                        @endif
                                    @endif
								    <td>
                                        <ul class="nameList">
                                            @foreach($template_names as $index => $name)
                                                <li class="{{ $index >= 3 ? 'extra' : '' }}">{{ $name }}</li>
                                            @endforeach
                                        </ul>
                                        @if(count($template_names) > 3)
                                            <span class="toggleLink" style="cursor:pointer; color:blue;">More...</span>
                                        @endif
                                    </td>
									<td><i class="fa fa-euro"></i>{{$luckydraw->price}}/-</td>
									<td>
									    @if($luckydraw->region_id == 'all')
									        All
									    @else
									        {{$luckydraw->region_names}}
									    @endif
									</td>
                                    <td>
									    @if($luckydraw->country_id ==  'all')
									        All
									    @else
									        {{$luckydraw->country_names}}
									    @endif
									</td>									
									<td>{{$luckydraw->no_of_prizes ?? ''}}</td>
									<td>
                                        @php 
                                            $prize = App\Models\Prize::where('luckydraw_id', $luckydraw->id)->get();
                                        @endphp
                                        @if($prize->isNotEmpty())
                                            @foreach($prize as $prizes)
                                                <div>
                                                    {{ $loop->iteration }}. 
                                                    @if($prizes->prize_type == 1)
                                                        {{ $prizes->amount }}
                                                    @else
                                                        {{ $prizes->item }}
                                                        <br>
                                                        <img src="{{request()->getSchemeAndHttpHost()}}/uploads/luckydraw/prizes/{{ $prizes->image }}" style="width:100px; height:100px;">
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <span>No prize available</span>
                                        @endif
                                    </td>
									<td class="center">
										<a href="{{ route('luckydraw.edit', $luckydraw->id) }}" class="btn btn-info" style="background:#885df1; border-radius:50px;"  onclick="return confirm('Do you want to Edit Luckydraw?')"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
										<a href="{{ route('luckydraw.view_sale', $luckydraw->id)}}" class="btn btn-primary" style="border-radius:50px;"><i class="fa fa-line-chart"></i>&nbsp;View Sales</a>
										<a href="{{ route('luckydraw.delete', $luckydraw->id) }}" type="button" class="btn btn-danger" style="border-radius:50px;" onclick="return confirm('Do you want to Edit Delete Luckydraw?')"><i class="fa fa-trash"></i>&nbsp;Delete</a>
										<br>
										@if($luckydraw->status)
											<a href="{{ route('luckydraw.status', ['id' => $luckydraw->id, 'actions' => 1]) }}"  class="btn btn-warning" style="border-radius:50px;"><i class="fa fa-pause"></i>&nbsp;Suspend</a>
										@else
										    <a href="{{ route('luckydraw.status', ['id' => $luckydraw->id, 'actions' => 0]) }}" class="btn btn-success" style="border-radius:50px;"><i class="fa fa-play"></i>&nbsp;Unsuspend</a>
										@endif
										@php
											$winner_now = \Carbon\Carbon::now()->format('Y-m-d');
											$show_time = \Carbon\Carbon::now();
										@endphp
									    @if($luckydraw_sale >= 1 && $luckydraw->c == 0) <!-- Verifies sales is Happen or NOT -->
									        @php
									            /*
										        echo $luckydraw_sale;
										        echo "<br>";
										        echo $luckydraw->c;
                                                if ($show_time->between($luckydraw->start_date, $luckydraw->end_date)) {
                                                    echo "Current date is between the two dates.";
                                                } else {
                                                    echo "Current date is NOT between the two dates.";
                                                }
                                                */
                                                $currentTime = \Carbon\Carbon::now();
                                                $currentTime;  //2025-08-14 19:29:35
                                                //echo $luckydraw->frequency;
                                                $luckydraw_enable_startTime = \Carbon\Carbon::createFromTime(0, 01); // 5:31 PM
                                                $luckydraw_enable_endTime = \Carbon\Carbon::createFromTime(23, 59);   // 9:30 PM
									        @endphp
										    @if($luckydraw->frequency == 1)
											    @if($show_time->between($luckydraw->start_date, $luckydraw->end_date))
												    @if($currentTime->between($luckydraw_enable_startTime, $luckydraw_enable_endTime))
												        <button class="btn btn-success update-btn" style="border-radius:50px;" type="submit" data-id="{{ $luckydraw->id }}" data-status="{{ $luckydraw->status }}" data-sold="{{ $luckydraw_sale ?? '' }}" onclick="update_btn($(this))"><i class="fa fa-user-secret"></i>&nbsp;Declare Winner</button>
												    @else
												        <button class="btn btn-warning update-btn" style="border-radius:50px;" type="submit" data-id="{{ $luckydraw->id }}" data-status="{{ $luckydraw->status }}" data-sold="{{ $luckydraw_sale ?? '' }}" disabled><i class="fa fa-user-secret"></i>&nbsp;Declare Winner</button>
												    @endif
											    @else
                                                    <button class="btn btn-warning update-btn" style="border-radius:50px;" type="submit" data-id="{{ $luckydraw->id }}" data-status="{{ $luckydraw->status }}" data-sold="{{ $luckydraw_sale ?? '' }}" disabled><i class="fa fa-user-secret"></i>&nbsp;Declare Winner</button>
                                                @endif
											@elseif($luckydraw->frequency == 2)
                                                @if($show_time->between($luckydraw->start_date, $luckydraw->end_date))
                                                    @if($show_time->format('D') == 'Mon')
                                                        @if($currentTime->between($luckydraw_enable_startTime, $luckydraw_enable_endTime) )
                                                            <button class="btn btn-success update-btn" style="border-radius:50px;" type="submit" data-id="{{ $luckydraw->id }}" data-status="{{ $luckydraw->status }}" data-sold="{{ $luckydraw_sale ?? '' }}" onclick="update_btn($(this))"><i class="fa fa-user-secret"></i>&nbsp;Declare Winner</button>
                                                        @else
                                                            <button class="btn btn-warning update-btn" style="border-radius:50px;" type="submit" data-id="{{ $luckydraw->id }}" data-status="{{ $luckydraw->status }}" data-sold="{{ $luckydraw_sale ?? '' }}" disabled><i class="fa fa-user-secret"></i>&nbsp;Declare Winner</button>
                                                        @endif
                                                    @else
                                                        <button class="btn btn-warning update-btn" style="border-radius:50px;" type="submit" data-id="{{ $luckydraw->id }}" data-status="{{ $luckydraw->status }}" data-sold="{{ $luckydraw_sale ?? '' }}" disabled><i class="fa fa-user-secret"></i>&nbsp;Declare Winner</button>
                                                    @endif
                                                @else
                                                    <button class="btn btn-warning update-btn" style="border-radius:50px;" type="submit" data-id="{{ $luckydraw->id }}" data-status="{{ $luckydraw->status }}" data-sold="{{ $luckydraw_sale ?? '' }}" disabled><i class="fa fa-user-secret"></i>&nbsp;Declare Winner</button>
                                                @endif
                                            @elseif($luckydraw->frequency == 3)
                                                @php
                                                    // Get current date and time
                                                    $now = now();
                                                    // Check if today is the last day of the month
                                                    $isLastDayOfMonth = $now->isLastOfMonth();
                                                    // Check if current time is between 5:31 PM and 11:59 PM
                                                    $currentTime = $now->format('H:i');
                                                    $isTimeInRange = $currentTime >= '05:31 PM' && $currentTime <= '09:30 PM'; 
                                                @endphp
                                                @if($show_time->between($luckydraw->start_date, $luckydraw->end_date) && $isLastDayOfMonth && $currentTime->between($luckydraw_enable_startTime, $luckydraw_enable_endTime))
                                                    <!-- Your button or logic for when the condition is met -->
                                                    <button class="btn btn-success update-btn" style="border-radius:50px;" type="submit" data-id="{{ $luckydraw->id }}" data-status="{{ $luckydraw->status }}" data-sold="{{ $luckydraw_sale ?? '' }}" onclick="update_btn($(this))"><i class="fa fa-user-secret"></i> Declare Winner</button>
                                                @else
                                                    <button class="btn btn-warning update-btn" style="border-radius:50px;" type="submit" data-id="{{ $luckydraw->id }}" data-status="{{ $luckydraw->status }}" data-sold="{{ $luckydraw_sale ?? '' }}" disabled><i class="fa fa-user-secret"></i> Declare Winner</button>
                                                @endif
                                            @elseif($luckydraw->frequency == 4)
                                                @php
                                                    // Get current date and time
                                                    $now = now();
                                                    // Check if today is December 31st
                                                    $isDec31 = $now->month == 12 && $now->day == 31;
                                                    // Check if current time is between 5:31 PM and 11:59 PM
                                                    $currentTime = $now->format('H:i');
                                                    $isTimeInRange = $currentTime >= '05:31 PM' && $currentTime <= '09:30 PM';
                                                @endphp
                                                @if($show_time->between($luckydraw->start_date, $luckydraw->end_date) && $isDec31 && $currentTime->between($luckydraw_enable_startTime, $luckydraw_enable_endTime))
                                                    <button class="btn btn-success update-btn" style="border-radius:50px;" type="submit" data-id="{{ $luckydraw->id }}" data-status="{{ $luckydraw->status }}" data-sold="{{ $luckydraw_sale ?? '' }}" onclick="update_btn($(this))"><i class="fa fa-user-secret"></i> Declare Winner</button>
                                                @else
                                                    <button class="btn btn-warning update-btn" style="border-radius:50px;" type="submit" data-id="{{ $luckydraw->id }}" data-status="{{ $luckydraw->status }}" data-sold="{{ $luckydraw_sale ?? '' }}" disabled><i class="fa fa-user-secret"></i> Declare Winner</button>
                                                @endif
											@endif
                                        @else
                                            <button class="btn btn-primary update-btn" style="border-radius:50px;" disabled><i class="fa fa-file"></i> No Sales No Winner</button>
                                        @endif
                                        <a href="{{ route('luckydraw.view_winner', $luckydraw->id) }}" class="btn btn-info" style="background:#885df1; border-radius:50px;"><i class="fa fa-users"></i>&nbsp;View Winners</a>
									    @php
                                            $today = \Carbon\Carbon::now();
                                            $timeThreshold = \Carbon\Carbon::today()->setTime(17, 30,0);
                                            $displayDate = ($today->isMonday() && $today->lessThanOrEqualTo($timeThreshold))
                                                ? $today->format('d-m-Y')
                                                : $today->next(\Carbon\Carbon::MONDAY)->format('d-m-Y');
                                                $now = \Carbon\Carbon::now();
                                                $isDec31 = $now->month === 12 && $now->day === 31;
                                                $timeThreshold1 = \Carbon\Carbon::today()->setTime(17, 30,0);
                                                $displayYear = ($isDec31 && $now->greaterThan($timeThreshold1))
                                                    ? $now->addYear()->year
                                                    : $now->year;
                                                    $now = \Carbon\Carbon::now();
                                                    $timeThreshold = \Carbon\Carbon::today()->setTime(17, 30 ,0);
                                                    $displayMonthEnd = $now->lessThanOrEqualTo($timeThreshold)
                                                    ? $now->endOfMonth()->format('d-m-Y')
                                                    : $now->addMonth()->endOfMonth()->format('d-m-Y');
                                                    $currentTime1 = \Carbon\Carbon::now();
                                                    $checkTime1 = \Carbon\Carbon::today()->setTime(17, 30, 0); // 5:30:00 PM
                                                    $isAfter1 = $currentTime1->greaterThan($checkTime1);
                                                    $displayDate1 = $isAfter1 
                                                    ? $currentTime1->copy()->addDay()->format('d-m-Y') 
                                                    : $currentTime1->format('d-m-Y');
                                        @endphp
										<br><br>
										@if($luckydraw->frequency == 1)
									        Cutoff Date : {{$displayDate1}} 5:30pm
									        <br>
                                        	Next Draw Date : {{$displayDate1}} 9:30pm
									    @elseif($luckydraw->frequency == 2)
									        Cutoff Date : {{$displayDate}} with 5:30pm
									        <br>
                                            Next Draw Date : {{$displayDate}} with 9:30pm
									    @elseif($luckydraw->frequency == 3)
									        Cutoff Date : {{ $displayMonthEnd }} 5:30pm
									        <br>
                                            Next Draw Date : {{ $displayMonthEnd }} 9:30pm
									    @elseif($luckydraw->frequency == 4)
									        Cutoff Date : 31-12-{{$displayYear}} 5:30pm
									        <br>
                                            Next Draw Date : 31-12-{{$displayYear }} 9:30pm
									    @endif
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
    <!-- The Modal -->
    <div class="modal" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title"><span class="luckydraw_manager_name"></span> - Luckydraw Winner Manager</h4>
            <div style="text-align:center;">
                <h4 style="display:inline; color:blue;" class="luckydraw_frequent"></h4>- <span class="luckydraw_no_of_prizes" style="color:darkblue;"></span> Prizes
            </div>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
            <form id="statusUpdateForm">
            @csrf
                <input type="hidden" name="record_id" id="record_id">
                <div class="form-group">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="25%">Luckydraw<br>Start Date</th>
                                <th width="25%">Luckydraw<br>End Date</th>
                                <th width="25%">Total No.of.<br>Tickets Sold</th>
                                <th width="25%">Drawable<br>Tickets</th>
                            </tr>
                        </thead>
                        <tbody id="luckydraw_data">
                        </tbody>
                    </table>
                </div>
                <div class="hidden_feild_data"></div>
                <input type="hidden" value="" name="sale_hidden_count" class="sale_hidden_count" />
                <input type="hidden" value="" name="sale_hidden_prize" class="sale_hidden_prize" />
                <input type="hidden" value="" name="luckydraw_hidden_id" class="sale_luckydraw_hidden_id" />
                <input type="hidden" value="" name="luckydraw_hidden_frequency" class="luckydraw_hidden_frequency" />
                <div class="form-group">
                    <label for="sel1">Choose Winning Logic<font color="red">*</font></label>
                    <select class="form-control" name="status" id="status" required onchange="get_declare_status($(this))">
                        <option>Choose Logic</option>
                        <option value="1">Logic#1 - Random</option>
                        <option value="2" disabled>Logic#2 - Jumble</option>
                        <option value="3" disabled>Logic#3 - NOT Coded</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success declare_winner" disabled>Declare the Winner</button> <span><b class="winner_span"></b></span> 
                <div id="message_process">Click to Start...</div>
            </form>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
              <div class="col-md-12 luckydraw_ticket_id">
              </div>
            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="close_data()">Close</button>
          </div>
        </div>
      </div>
    </div>
@endsection
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggleLink').forEach(function (toggleLink) {
        // console.log('yes');
        const nameList = toggleLink.previousElementSibling;
        const extraItems = nameList.querySelectorAll('.extra');
        let expanded = false;
        // hide initially
        extraItems.forEach(item => item.style.display = 'none');
        toggleLink.addEventListener('click', function () {
            expanded = !expanded;
            extraItems.forEach(item => {
                item.style.display = expanded ? 'list-item' : 'none';
            });
            toggleLink.textContent = expanded ? 'Less...' : 'More...';
        });
    });
});
$(document).ready(function () {
     $('.select2').select2();
     $('#prizeRowsContainer .prize-row').each(function(index) {
        let selectElement = $(this).find('select[name="prize_type[]"]');
        get_prize_type(selectElement, index + 1);
    });
    
})
    // console.log($('#region_hidden_id').val());
</script>
 <script>
    // luckydraw_end_date_label
    $(document).ready(function() {
        // get_prize_type
        get_luckydraw_template(('#template_id'));
        $('#frequency').on('change',function(){
            var value = $(this).val();
            // console.log(value);
            $('#luckydraw_end_date_label').text('');
            if(value == 2){
                $('#luckydraw_end_date_label').show();
                $('#luckydraw_end_date_label').text('End Date should be Friday');
            }else if(value == 3){
                $('#luckydraw_end_date_label').show();
                $('#luckydraw_end_date_label').text('End Date should be Last day of the Month');
            }else if(value == 4){
                $('#luckydraw_end_date_label').show();
                $('#luckydraw_end_date_label').text('End Date should be Dec 31st');
            }
        })
        if ($('#region_hidden_id').val() != '') {
    // Restore saved region(s)
    var selectedRegions = $('#region_hidden_id').val();
    try {
        selectedRegions = JSON.parse(selectedRegions);
    } catch (e) {
        selectedRegions = selectedRegions ? selectedRegions.split(',') : [];
    }
    $('#region').val(selectedRegions).trigger('change');
    // Restore saved countries
    var selectedCountrys = $('#country_hidden_id').val();
    try {
        selectedCountrys = JSON.parse(selectedCountrys);
    } catch (e) {
        selectedCountrys = selectedCountrys ? selectedCountrys.split(',') : [];
    }
    // Disable logic for "All" in region
    $('#region option').prop('disabled', false);
    if (selectedRegions.includes("all")) {
        $('#region option').each(function () {
            if ($(this).val() !== "all") {
                $(this).prop('disabled', true).prop('selected', false);
            }
        });
    } else if (selectedRegions.length > 0) {
        $('#region option[value="all"]').prop('disabled', true).prop('selected', false);
    }
    // Reset and fetch countries
    $('#country').html('').val(null).trigger('change');
    $('#state').html('').val(null).trigger('change');
    $.ajax({
        url: "{{ url('luckydraw/get_country') }}",
        type: "GET",
        data: {
            "_token": "{{ csrf_token() }}",
            "region_id": selectedRegions,
        },
        success: function(data) {
            $(data.countries).each(function(key, value) {
                $('#country').append('<option value=' + value.id + '>' + value.country_name + '</option>');
            });
            $('#country').val(selectedCountrys).trigger('change');
        }
    });
}
    if ($('#country_hidden_id').val() != '') {
            // $('#state').empty().append('<option value="">Select State</option>');
    // console.log('yes in');
    // Restore saved states
    var selectedStates = $('#state_hidden_id').val();
    try {
        selectedStates = JSON.parse(selectedStates);
    } catch (e) {
        selectedStates = selectedStates ? selectedStates.split(',') : [];
    }
    // Restore saved countries
    var selectedCountries = $('#country_hidden_id').val();
    try {
        selectedCountries = JSON.parse(selectedCountries);
    } catch (e) {
        selectedCountries = selectedCountries ? selectedCountries.split(',') : [];
    }
    $('#country').val(selectedCountries).trigger('change'); // Set countries before checking "all"
    // Handle option disabling for "All"
    $('#country option').prop('disabled', false);
    if (selectedCountries.includes("all")) {
        $('#country option').each(function () {
            if ($(this).val() !== "all") {
                $(this).prop('disabled', true).prop('selected', false);
            }
        });
    } else if (selectedCountries.length > 0) {
        $('#country option[value="all"]').prop('disabled', true).prop('selected', false);
    }
    // Reset and load states
    $('#state').val(null).trigger('change');
    $('#state').html('');
    $.ajax({
        url: "{{ url('luckydraw/get_state') }}",
        type: "GET",
        data: {
            "_token": "{{ csrf_token() }}",
            "country_id": selectedCountries,
        },
        success: function (data) {
              $(data.states).each(function (key, value) {
        $('#state').append('<option value=' + value.id + '>' + value.state_title + '</option>');
    });
    // Restore saved states from hidden input
    $('#state').val(selectedStates).trigger('change');
    // Disable other options if "all" is selected
    $('#state option').prop('disabled', false);
    if (selectedStates.includes("all")) {
        $('#state option').each(function () {
            if ($(this).val() !== "all") {
                $(this).prop('disabled', true).prop('selected', false);
            }
        });
    } else if (selectedStates.length > 0) {
        $('#state option[value="all"]').prop('disabled', true).prop('selected', false);
    }
    // Call existing function
    // get_state('#state');
        }
    });
}
          $('#no_of_prizes').on('keyup', function() {
        let number = parseInt($(this).val());
        if (!isNaN(number)) {
            generatePrizeRows(number);
        }
    });
         $(".declare_winner").click(function(e) {
        e.preventDefault(); // Prevent form submission
        const messages = [
            "Tickets random Processing",
            "Winner Selection is Under Processing",
            "Records are updating",
            "Process completed"
        ];
        var index = 0;
        var messageDiv = document.getElementById("message_process");
        // Show the first message immediately
        messageDiv.textContent = messages[index];
        // Show next messages every 10 seconds
        let interval = setInterval(() => {
            index = (index + 1) % messages.length;
            messageDiv.textContent = messages[index];
            if (messages[index] === "Winner Selection is Under Processing") {
                runWinnerSelectionProcess(); // Get winner ticket IDs
            }
            if (messages[index] === "Records are updating") {
                saveWinnerDataToDatabase(); // Save to DB before process completes
            }
            if (messages[index] === "Process completed") {
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }
        }, 10000);
         });
    })
    function get_region(val){
     var region_id = $(val).val() || [];
            $('#region option').prop('disabled', false);
    // If "All" is selected, disable all other options
    if (region_id.includes("all")) {
        $('#region option').each(function () {
            if ($(this).val() !== "all") {
                $(this).prop('disabled', true).prop('selected', false); // Disable and deselect others
            }
        });
    } else if (region_id.length > 0) {
        // If any other option is selected, disable the "All" option
        $('#region option[value="all"]').prop('disabled', true).prop('selected', false);
    }
            // console.log(selectedRegions)   
            $('#country').html('');
            $('#state').html('');
            $('#country').val(null).trigger('change');
            $('#state').val(null).trigger('change');
            $('#country').html('');
            $.ajax({
                url: "{{ url('luckydraw/get_country') }}",
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "region_id": region_id,
                },
                success: function(data) {
                    // console.log(data);
                    // console.log(data['doneMessage']);
                    //  $('#country').append('<option>Select Country</option>')
                    $(data.countries).each(function(key, value) {
                        $('#country').append('<option value=' + value.id + '>' + value.country_name + '</option>')
                    });
                }
            });     
    }
    function get_country(val){
        var country_id = $(val).val()  || [];
           // // Convert countryIds to array if it's a string (for single-select)
    if (!Array.isArray(country_id)) {
        country_id = country_id ? [country_id] : [];
    }
    // Handle option disabling
    if (country_id.includes("all")) {
        // If "all" is selected, disable all other options
        $('#country option').prop('disabled', true);
        $('#country option[value="all"]').prop('disabled', false);
    } else {
        // If specific countries are selected, disable "all" option
        $('#country option').prop('disabled', false);
        if (country_id.length > 0) {
            $('#country option[value="all"]').prop('disabled', true);
        }
    }
            // console.log(selectedRegions)   
            $('#state').html('');
            $('#state').val(null).trigger('change');
            $('#state').html('');
            $.ajax({
                url: "{{ url('luckydraw/get_state') }}",
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "country_id": country_id,
                },
                success: function(data) {
                    // console.log(data);
                    // console.log(data['doneMessage']);
                    //  $('#state').append('<option>Select State</option>')
                    $(data.states).each(function(key, value) {
                        $('#state').append('<option value=' + value.id + '>' + value.state_title + '</option>')
                    });
                    // $('#state').val(selectedStates).trigger('change');
                }
            });
    }
    function get_state(val){
        if ($('#state option').length === 0) return;
    var state_id = $(val).val() || [];
    console.log(state_id);
    if (!Array.isArray(state_id)) {
        state_id = state_id ? [state_id] : [];
    }
    // Filter out undefined/null values just in case
    state_id = state_id.filter(Boolean);
    // var regionIds = $('#region').val() || [];
    // Handle option disabling
    if (state_id.includes("all")) {
        console.log('yes');
        $('#state option').prop('disabled', true);
        $('#state option[value="all"]').prop('disabled', false);
    } else {
        console.log('no');
        $('#state option').prop('disabled', false);
        if (state_id.length > 0) {
            $('#state option[value="all"]').prop('disabled', true);
        }
    }
    }
     let prizeGroup = {!! json_encode($prize_group ?? []) !!};
    console.log(prizeGroup);
    function generatePrizeRows(count) {
        let container = $('#prizeRowsContainer');
        container.empty(); // Clear old fields
        for (let i = 0; i < count; i++) {
            let prize = prizeGroup[i] || {};
            let selectedType1 = prize.prize_type == 1 ? 'selected' : '';
            let selectedType2 = prize.prize_type == 2 ? 'selected' : '';
            let amountDisplay = selectedType1 ? 'block' : 'none';
            let itemDisplay = selectedType2 ? 'block' : 'none';
            let amount = prize.amount || '';
            let item = prize.item || '';
            let id = prize.id || '';
            let imageHTML = prize.image 
                ? `<img src="{{request()->getSchemeAndHttpHost()}}/uploads/luckydraw/prizes/${prize.image}" style="width:100px;height:100px;">` 
                : '';
            container.append(`
                <div class="col-md-12 prize-row">
                    <div class="row">
                        <input type="hidden" name="prize_id[]" value="${id}" id="prize_id${i + 1}" />
                        <div class="col-md-3" id="prize_type_div${i + 1}">
                            <p>Choose Type Of Prize <font color="red">*</font></p>
                            <select name="prize_type[]" class="select2 form-control" required onchange="get_prize_type($(this),${i + 1})">
                                <option value="1" ${selectedType1}>Cash Prize</option>
                                <option value="2" ${selectedType2}>Item/Product</option>
                            </select>
                        </div>
                        <div class="col-md-3" id="amount_div${i + 1}" style="display: ${amountDisplay};">
                            <p>Prize Amount <font color="red">*</font></p>
                            <input name="amount[]" type="text" class="form-control" placeholder="Enter Prize Amount" value="${amount}">
                        </div>
                        <div class="col-md-3" id="currency_div${i + 1}">
                            <p>Currency  <font color="red">*</font></p>
                            <select name="currency[]" class="select2 form-control" >
                                <option value="">Choose Currency</option>
                                <option value="؋">Afghani (AFN) – ؋</option>
                                <option value="L">Albanian Lek (ALL) – L</option>
                                <option value="د.ج">Algerian Dinar (DZD) – د.ج</option>
                                <option value="$">US Dollar (USD) – $</option>
                                <option value="€">Euro (EUR) – €</option>
                                <option value="Kz">Kwanza (AOA) – Kz</option>
                                <option value="$">Argentine Peso (ARS) – $</option>
                                <option value="֏">Armenian Dram (AMD) – ֏</option>
                                <option value="ƒ">Aruban Florin (AWG) – ƒ</option>
                                <option value="$">Australian Dollar (AUD) – $</option>
                                <option value="₼">Azerbaijani Manat (AZN) – ₼</option>
                                <option value="$">Bahamian Dollar (BSD) – $</option>
                                <option value="ب.د">Bahraini Dinar (BHD) – ب.د</option>
                                <option value="৳">Bangladeshi Taka (BDT) – ৳</option>
                                <option value="$">Barbados Dollar (BBD) – $</option>
                                <option value="Br">Belarusian Ruble (BYN) – Br</option>
                                <option value="$">Belize Dollar (BZD) – $</option>
                                <option value="Fr">CFA Franc BCEAO (XOF) – Fr</option>
                                <option value="$">Bermudian Dollar (BMD) – $</option>
                                <option value="Nu.">Bhutan Ngultrum (BTN) – Nu.</option>
                                <option value="Bs.">Boliviano (BOB) – Bs.</option>
                                <option value="BOV">Bolivian Mvdol (BOV) – BOV</option>
                                <option value="KM">Convertible Mark (BAM) – KM</option>
                                <option value="P">Botswana Pula (BWP) – P</option>
                                <option value="R$">Brazilian Real (BRL) – R$</option>
                                <option value="$">Brunei Dollar (BND) – $</option>
                                <option value="лв.">Bulgarian Lev (BGN) – лв.</option>
                                <option value="Fr">CFA Franc BEAC (XAF) – Fr</option>
                                <option value="៛">Cambodian Riel (KHR) – ៛</option>
                                <option value="$">Canadian Dollar (CAD) – $</option>
                                <option value="Esc">Cape Verde Escudo (CVE) – Esc</option>
                                <option value="$">Cayman Islands Dollar (KYD) – $</option>
                                <option value="$">Chilean Peso (CLP) – $</option>
                                <option value="UF">Chile UF (CLF) – UF</option>
                                <option value="¥">Chinese Yuan (CNY) – ¥</option>
                                <option value="$">Colombian Peso (COP) – $</option>
                                <option value="COU">Colombia Real Value Unit (COU) – COU</option>
                                <option value="Fr">Comoro Franc (KMF) – Fr</option>
                                <option value="Fr">Congolese Franc (CDF) – Fr</option>
                                <option value="$">New Zealand Dollar (NZD) – $</option>
                                <option value="₡">Costa Rican Colón (CRC) – ₡</option>
                                <option value="kn">Croatian Kuna (HRK) – kn</option>
                                <option value="₱">Cuban Peso (CUP) – ₱</option>
                                <option value="CUC">Cuban Convertible Peso (CUC) – CUC</option>
                                <option value="ƒ">Netherlands Antillean Guilder (ANG) – ƒ</option>
                                <option value="Kč">Czech Koruna (CZK) – Kč</option>
                                <option value="kr">Danish Krone (DKK) – kr</option>
                                <option value="Fr">Djibouti Franc (DJF) – Fr</option>
                                <option value="$">Dominican Peso (DOP) – $</option>
                                <option value="£">Egyptian Pound (EGP) – £</option>
                                <option value="₡">El Salvador Colón (SVC) – ₡</option>
                                <option value="Nfk">Eritrean Nakfa (ERN) – Nfk</option>
                                <option value="Br">Ethiopian Birr (ETB) – Br</option>
                                <option value="£">Falkland Islands Pound (FKP) – £</option>
                                <option value="$">Fiji Dollar (FJD) – $</option>
                                <option value="Fr">CFP Franc (XPF) – Fr</option>
                                <option value="D">Gambian Dalasi (GMD) – D</option>
                                <option value="₾">Georgian Lari (GEL) – ₾</option>
                                <option value="₵">Ghana Cedi (GHS) – ₵</option>
                                <option value="£">Gibraltar Pound (GIP) – £</option>
                                <option value="Q">Guatemalan Quetzal (GTQ) – Q</option>
                                <option value="Fr">Guinea Franc (GNF) – Fr</option>
                                <option value="$">Guyana Dollar (GYD) – $</option>
                                <option value="G">Haitian Gourde (HTG) – G</option>
                                <option value="L">Honduran Lempira (HNL) – L</option>
                                <option value="$">Hong Kong Dollar (HKD) – $</option>
                                <option value="Ft">Hungarian Forint (HUF) – Ft</option>
                                <option value="kr">Iceland Krona (ISK) – kr</option>
                                <option value="₹">Indian Rupee (INR) – ₹</option>
                                <option value="Rp">Indonesian Rupiah (IDR) – Rp</option>
                                <option value="﷼">Iranian Rial (IRR) – ﷼</option>
                                <option value="ع.د">Iraqi Dinar (IQD) – ع.د</option>
                                <option value="₪">Israeli Shekel (ILS) – ₪</option>
                                <option value="$">Jamaican Dollar (JMD) – $</option>
                                <option value="¥">Japanese Yen (JPY) – ¥</option>
                                <option value="د.ا">Jordanian Dinar (JOD) – د.ا</option>
                                <option value="₸">Kazakhstani Tenge (KZT) – ₸</option>
                                <option value="Sh">Kenyan Shilling (KES) – Sh</option>
                                <option value="₩">North Korean Won (KPW) – ₩</option>
                                <option value="₩">South Korean Won (KRW) – ₩</option>
                                <option value="د.ك">Kuwaiti Dinar (KWD) – د.ك</option>
                                <option value="som">Kyrgyzstani Som (KGS) – som</option>
                                <option value="₭">Lao Kip (LAK) – ₭</option>
                                <option value="ل.ل">Lebanese Pound (LBP) – ل.ل</option>
                                <option value="L">Lesotho Loti (LSL) – L</option>
                                <option value="$">Liberian Dollar (LRD) – $</option>
                                <option value="ل.د">Libyan Dinar (LYD) – ل.د</option>
                                <option value="P">Macanese Pataca (MOP) – P</option>
                                <option value="ден">North Macedonian Denar (MKD) – ден</option>
                                <option value="Ar">Malagasy Ariary (MGA) – Ar</option>
                                <option value="MK">Malawian Kwacha (MWK) – MK</option>
                                <option value="RM">Malaysian Ringgit (MYR) – RM</option>
                                <option value="ރ">Maldives Rufiyaa (MVR) – ރ</option>
                                <option value="UM">Mauritanian Ouguiya (MRU) – UM</option>
                                <option value="₨">Mauritian Rupee (MUR) – ₨</option>
                                <option value="XUA">ADB Unit of Account (XUA) – XUA</option>
                                <option value="$">Mexican Peso (MXN) – $</option>
                                <option value="MXV">Mexican Unidad de Inversion (MXV) – MXV</option>
                                <option value="L">Moldovan Leu (MDL) – L</option>
                                <option value="د.م.">Moroccan Dirham (MAD) – د.م.</option>
                                <option value="MTn">Mozambican Metical (MZN) – MTn</option>
                                <option value="K">Myanmar Kyat (MMK) – K</option>
                                <option value="$">Namibian Dollar (NAD) – $</option>
                                <option value="₨">Nepalese Rupee (NPR) – ₨</option>
                                <option value="C$">Nicaraguan Córdoba (NIO) – C$</option>
                                <option value="₦">Nigerian Naira (NGN) – ₦</option>
                                <option value="﷼">Omani Rial (OMR) – ﷼</option>
                                <option value="₨">Pakistani Rupee (PKR) – ₨</option>
                                <option value="B/.">Panamanian Balboa (PAB) – B/.</option>
                                <option value="K">Papua New Guinean Kina (PGK) – K</option>
                                <option value="₲">Paraguayan Guarani (PYG) – ₲</option>
                                <option value="S/.">Peruvian Sol (PEN) – S/.</option>
                                <option value="₱">Philippine Peso (PHP) – ₱</option>
                                <option value="zł">Polish Zloty (PLN) – zł</option>
                                <option value="﷼">Qatari Riyal (QAR) – ﷼</option>
                                <option value="lei">Romanian Leu (RON) – lei</option>
                                <option value="₽">Russian Ruble (RUB) – ₽</option>
                                <option value="Fr">Rwandan Franc (RWF) – Fr</option>
                                <option value="£">Saint Helena Pound (SHP) – £</option>
                                <option value="T">Samoan Tala (WST) – T</option>
                                <option value="Db">São Tomé & Príncipe Dobra (STN) – Db</option>
                                <option value="﷼">Saudi Riyal (SAR) – ﷼</option>
                                <option value="дин">Serbian Dinar (RSD) – дин</option>
                                <option value="₨">Seychellois Rupee (SCR) – ₨</option>
                                <option value="Le">Sierra Leone Leone (SLL) – Le</option>
                                <option value="$">Singapore Dollar (SGD) – $</option>
                                <option value="XSU">Sucre (XSU) – XSU</option>
                                <option value="$">Solomon Islands Dollar (SBD) – $</option>
                                <option value="Sh">Somali Shilling (SOS) – Sh</option>
                                <option value="R">South African Rand (ZAR) – R</option>
                                <option value="£">South Sudanese Pound (SSP) – £</option>
                                <option value="₨">Sri Lankan Rupee (LKR) – ₨</option>
                                <option value="£">Sudanese Pound (SDG) – £</option>
                                <option value="$">Surinamese Dollar (SRD) – $</option>
                                <option value="L">Swazi Lilangeni (SZL) – L</option>
                                <option value="kr">Swedish Krona (SEK) – kr</option>
                                <option value="Fr">Swiss Franc (CHF) – Fr</option>
                                <option value="£">Syrian Pound (SYP) – £</option>
                                <option value="NT$">New Taiwan Dollar (TWD) – NT$</option>
                                <option value="ЅМ">Tajikistani Somoni (TJS) – ЅМ</option>
                                <option value="Sh">Tanzanian Shilling (TZS) – Sh</option>
                                <option value="฿">Thai Baht (THB) – ฿</option>
                                <option value="T$">Tongan Paʻanga (TOP) – T$</option>
                                <option value="$">Trinidad & Tobago Dollar (TTD) – $</option>
                                <option value="د.ت">Tunisian Dinar (TND) – د.ت</option>
                                <option value="₺">Turkish Lira (TRY) – ₺</option>
                                <option value="T">Turkmenistan Manat (TMT) – T</option>
                                <option value="Sh">Ugandan Shilling (UGX) – Sh</option>
                                <option value="₴">Ukrainian Hryvnia (UAH) – ₴</option>
                                <option value="د.إ">UAE Dirham (AED) – د.إ</option>
                                <option value="£">Pound Sterling (GBP) – £</option>
                                <option value="USN">US Dollar (Next day) (USN) – USN</option>
                                <option value="$">Uruguayan Peso (UYU) – $</option>
                                <option value="лв">Uzbekistan Som (UZS) – лв</option>
                                <option value="Vt">Vanuatu Vatu (VUV) – Vt</option>
                                <option value="Bs.">Venezuelan Bolívar Digital (VED) – Bs.</option>
                                <option value="₫">Vietnamese Dong (VND) – ₫</option>
                                <option value="XDR">IMF Special Drawing Rights (XDR) – XDR</option>
                                <option value="﷼">Yemeni Rial (YER) – ﷼</option>
                                <option value="ZK">Zambian Kwacha (ZMW) – ZK</option>
                                <option value="Z$">Zimbabwe Dollar (ZWL) – Z$</option>
                            </select>
                        </div>
                        <div class="col-md-3" id="item_div${i + 1}" style="display: ${itemDisplay};">
                            <p>Item/Product Name <font color="red">*</font></p>
                            <input type="text" name="item[]" class="form-control" placeholder="Enter Item/Product Name" value="${item}">
                        </div>
                        <div class="col-md-3" id="image_div${i + 1}">
                            <p>Upload Prize Image</p>
                            <input type="file" name="image[]" class="form-control">
                            ${imageHTML}
                        </div>
                    </div>
                </div>
            `);
            // Call get_prize_type for the newly created row
            get_prize_type($(`#prize_type_div${i + 1} select`), i + 1);
        }
        container.find('select.select2').select2(); // Reinitialize select2
    }
    // Trigger get_prize_type for existing rows on page load (edit mode)
    let editMode = <?php echo isset($luckydraws_edit) ? "true" : "false"; ?>;
    if (editMode) {
        $('#prizeRowsContainer .prize-row').each(function(index) {
            let selectElement = $(this).find('select[name="prize_type[]"]');
            get_prize_type(selectElement, index + 1);
        });
    }
    $('#no_of_prizes').on('keyup', function() {
        let number = parseInt($(this).val());
        if (!isNaN(number)) {
            generatePrizeRows(number);
        }
    });
    // Trigger once on page load if value is already set
    let initialPrizes = parseInt($('#no_of_prizes').val());
    if (!isNaN(initialPrizes) && initialPrizes > 0 && !editMode) {
        generatePrizeRows(initialPrizes);
    }
    $('#start_date').on('change', function() {
        var selectedDate = $(this).val();
        $('#end_date').attr('min', selectedDate);
    });
    function runWinnerSelectionProcess() {
            var sale_count = $('.sale_hidden_count').val();
            var sale_prize = $('.sale_hidden_prize').val();
            var luckydraw_frequency = $('.luckydraw_hidden_frequency').val();
            $('.luckydraw_ticket_id').html('');
            var sale_luckydraw_hidden_id = $('.sale_luckydraw_hidden_id').val();
            var compare_value = '';
            if (sale_count < sale_prize) {
                compare_value = sale_count;
            } else if (sale_prize < sale_count) {
                compare_value = sale_prize;
            } else {
                compare_value = sale_count;
            }
            $.ajax({
                url: "{{ url('luckydraw/get_luckydraw_sale') }}",
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "compare_value": compare_value,
                    "luckydraw_id": sale_luckydraw_hidden_id,
                    "luckydraw_frequency": luckydraw_frequency,
                },
                success: function(data) {
                    let ticketIds = [];
                    $(data).each(function(key, value) {
                        // $('.hidden_feild_data').html('<input type="hidden" name="luckydraw_id_multi[]" class="luckydraw_id_multi" value="' + value.ticket_id + '"/>')
                        $('.hidden_feild_data').append(`<input type="hidden" name="luckydraw_id_multi[]" class="luckydraw_id_multi" value="${value.ticket_id}" />`);
                    ticketIds.push(value.ticket_id);
                    });
                    $('.luckydraw_ticket_id').html(ticketIds.join(', '));
                }
            });
        }
        function saveWinnerDataToDatabase() {
            // Get all hidden inputs with name luckydraw_id_multi[]
            let ticketIds = [];
            $('input[name="luckydraw_id_multi[]"]').each(function() {
                ticketIds.push($(this).val());
            });
            let luckydrawId = $('.sale_luckydraw_hidden_id').val();
            // Send to server via AJAX POST
            $.ajax({
                url: "{{ url('luckydraw/save_winner_data') }}", // Change to your actual route
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "ticket_ids": ticketIds,
                    "luckydraw_id": luckydrawId,
                },
                success: function(response) {
                    console.log("Winner data saved successfully");
                },
                error: function(xhr) {
                    console.error("Error saving winner data", xhr.responseText);
                }
            });
        }
        // get_name_total('LuckydrawName', 'Total')
        //  get_luckydraw_template($('luckydraw_hidden_id'));
        //  for on load
        var selectedRegions = $('#region_hidden_id').val(); // Convert stored regions to array
        try {
            selectedRegions = JSON.parse(selectedRegions); // Try to parse if it's a JSON string
        } catch (e) {
            selectedRegions = selectedRegions ? selectedRegions.split(',') : []; // Fallback to split if not JSON
        }
        var selectedCountrys = $('#country_hidden_id').val(); // Convert stored regions to array
        try {
            selectedCountrys = JSON.parse(selectedCountrys); // Try to parse if it's a JSON string
        } catch (e) {
            selectedCountrys = selectedCountrys ? selectedCountrys.split(',') : []; // Fallback to split if not JSON
        }
        var selectedStates = $('#state_hidden_id').val(); // Convert stored regions to array
        try {
            selectedStates = JSON.parse(selectedStates); // Try to parse if it's a JSON string
        } catch (e) {
            selectedStates = selectedStates ? selectedStates.split(',') : []; // Fallback to split if not JSON
        }
        var selectedTemplate = $('#luckydraw_hidden_id').val(); // Convert stored regions to array
        try {
            selectedTemplate = JSON.parse(selectedTemplate); // Try to parse if it's a JSON string
        } catch (e) {
            selectedTemplate = selectedTemplate ? selectedTemplate.split(',') : []; // Fallback to split if not JSON
        }
        var selectedLuckydrawAllocation = $('#luckydraw_wise_allocation_hidden_id').val(); // Convert stored regions to array
        try {
            selectedLuckydrawAllocation = JSON.parse(selectedLuckydrawAllocation); // Try to parse if it's a JSON string
        } catch (e) {
            selectedLuckydrawAllocation = selectedLuckydrawAllocation ? selectedLuckydrawAllocation.split(',') : []; // Fallback to split if not JSON
        }
        var selectedCountryLuckydraw = $('#country_luckydraw_id_hidden_id').val(); // Convert stored regions to array
        try {
            selectedCountryLuckydraw = JSON.parse(selectedCountryLuckydraw); // Try to parse if it's a JSON string
        } catch (e) {
            selectedCountryLuckydraw = selectedCountryLuckydraw ? selectedCountryLuckydraw.split(',') : []; // Fallback to split if not JSON
        }
        var selectedStateLuckydraw = $('#state_luckydraw_id_hidden_id').val(); // Convert stored regions to array
        try {
            selectedStateLuckydraw = JSON.parse(selectedStateLuckydraw); // Try to parse if it's a JSON string
        } catch (e) {
            selectedStateLuckydraw = selectedStateLuckydraw ? selectedStateLuckydraw.split(',') : []; // Fallback to split if not JSON
        }
        let templateDropdown = $('#template_id');
        if (templateDropdown.length > 0) { // Ensure the element exists
            // Run get_luckydraw_template on page load if there are already selected values
            if (templateDropdown.val() && templateDropdown.val().length > 0) {
                get_luckydraw_template(templateDropdown, selectedLuckydrawAllocation, selectedCountryLuckydraw, selectedStateLuckydraw);
            }
            // Also trigger the function when the dropdown changes
            templateDropdown.on('change', function() {
                get_luckydraw_template(this, selectedLuckydrawAllocation, selectedCountryLuckydraw, selectedStateLuckydraw);
            });
        }
        console.log(selectedStateLuckydraw);
        $('#template_id').val(selectedTemplate).trigger('change');
        // Set selected values for region dropdown
        $('#region').val(selectedRegions).trigger('change');
    function get_luckydraw_template(element) {
    var template_id = $(element).val() || [];
    // Convert to array if single value
    if (!Array.isArray(template_id)) {
        template_id = template_id ? [template_id] : [];
    }
    if (template_id.includes("all") && template_id.length > 1) {
        template_id = template_id.filter(v => v !== "all");
        $(element).val(template_id).trigger("change"); // update select2 UI also
    }
    // Handle option disabling (keep your logic unchanged)
    if (template_id.includes("all")) {
        $('#template_id option').prop('disabled', true);
        $('#template_id option[value="all"]').prop('disabled', false);
    } else {
        $('#template_id option').prop('disabled', false);
        if (template_id.length > 0) {
            $('#template_id option[value="all"]').prop('disabled', true);
        }
    }
    let selectedOptions = $(element).find(':selected');
    let selectedValues = $(element).val();
    $('#heading_div').html('');
    $('#message').html('');
    $('.luckydraw_template').empty();
    $("#luckydraw_wise_allocation\\[\\]-error").remove();
    if (selectedValues && selectedValues.length > 0) {
        if (selectedValues.includes("all")) {
            selectedOptions = $('#template_id option:not([value="all"])'); 
            selectedValues = selectedOptions.map(function () {
                return $(this).val();
            }).get();
        }
        selectedValues.forEach((templateValue, index) => {
            let templateText = selectedOptions.eq(index).text();
            let allocations = String($(element).attr('data-luckydraw-allocation') || '').split(',');
            let countryLuckydraws = String($(element).attr('data-country-luckydraw') || '').split(',');
            let stateLuckydraws = String($(element).attr('data-state-luckydraw') || '').split(',');
            let allocationValue = allocations[index] || '';
            let countryValue = countryLuckydraws[index] || '';
            let stateValue = stateLuckydraws[index] || '';
            $('.luckydraw_template').append(`
                <input type="hidden" name="template_luckydraw_id[]" value="${templateValue}" />
                <div class="row form-row">
                    <div class="col-md-3">
                        <p>Template</p>
                        <input name="template_luckydraw_name[]" type="text" class="form-control template_luckydraw_name" value="${templateText}" readonly>
                    </div>
                    <div class="col-md-3">
                        <p>Tickets Allocation (in %)</p>
                        <input name="luckydraw_wise_allocation[]" type="text" min="0" max="100" class="form-control luckydraw_wise_allocation" placeholder="Ticket Allocation in %" value="${allocationValue}" onkeyup="get_number($(this))" >
                    </div>
                </div>
            `);
            // get_luckydraw_country(`${templateValue}_${index}`, countryValue);
            // get_luckydraw_state($(`#country${templateValue}_${index}`), `${templateValue}_${index}`, stateValue);
        });
        setTimeout(() => {
            $('.country-select, .state-select').select2();
        }, 100);
    }
}
    function get_number(val) {
        var name = $('#luckydraw_name').val();
        // console.log(name)
        // $('#total_hidden').val('');
        var sum = 0;
        $('#message').html('');
        // Loop through all elements with name "country_allocation[]"
        $('input[name="luckydraw_wise_allocation[]"]').each(function() {
            var value = parseFloat($(this).val()) || 0;
            sum += value;
        });
        // Update total sum
        $('#total').val(sum + '%');
        // Disable button if sum exceeds 100%
        if (sum > 100) {
            $('#icon').prop('disabled', true);
            $('#message').append('<b style="color:red">NOTE:</b> Allocation should NOT more than 100%. Adjust the allocation before proceeding.');
        } else {
            $('#icon').prop('disabled', false);
            $('#message').html('');
        }
        $('#total_hidden').val(sum)
        // get_name_total(name, sum);
    }
    function calculateTotal() {
        var total = 0;
        $(".allocation").each(function() {
            var value = parseFloat($(this).val()) || 0;
            total += value;
        });
        $("#total_allocation").val(total);
    }
    function get_name_total(name, number) {
        $('#heading_div').html('');
        // console.log(name);
        $('#heading_div').append(`<div class="col-md-12">
		<p> ${name}'s template ${number}% allocated</p>
		</div>`)
    }
    function get_declare_status(val) {
        // console.log(val);
        var id = $(val).val();
        var sale_count = $('.sale_hidden_count').val();
        var sale_prize = $('.sale_hidden_prize').val();
        var luckydraw_frequency = $('.luckydraw_hidden_frequency').val();
        $('.luckydraw_ticket_id').html('');
        var sale_luckydraw_hidden_id = $('.sale_luckydraw_hidden_id').val();
        var compare_value = '';
        if (sale_count == 0) {
            $('.declare_winner').prop('disabled', true);
        } else {
            console.log(id);
            if (id == 'Choose Logic') {
                $('.declare_winner').prop('disabled', true);
            } else {
                $('.declare_winner').prop('disabled', false);
            }
        }
    }
    function get_prize_type(element, index) {
        console.log(element);
        let selectedVal = element.val();
        if (selectedVal == "1") {
            $(`#amount_div${index}`).show();
            $(`#item_div${index}`).hide();
            $(`#image_div${index}`).hide();
            $(`#currency_div${index}`).show();
        } else if (selectedVal == "2") {
            $(`#amount_div${index}`).hide();
            $(`#item_div${index}`).show();
            $(`#image_div${index}`).show();
            $(`#currency_div${index}`).hide();
            if($('#hidden_image').val() == 'save'){
                $('[id^="image_div"] input[type="file"]').attr('required', true);
            }
            else{
                $('[id^="image_div"] input[type="file"]').attr('required', false);
            }
        } else {
            // If nothing is selected, hide both
            $(`#amount_div${index}`).hide();
            $(`#item_div${index}`).hide();
            $(`#image_div${index}`).hide();
            $(`#currency_div${index}`).hide();
        }
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
       function check_val(){
           $('.error_log_name').text('');
            // console.log($(val).val());
            var luckydraw_name = $('#luckydraw_name').val(); 
            if(luckydraw_name.length > 2 ){
                 $.ajax({
                url: "{{ url('luckydraw/validation') }}", 
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "luckydraw_name" :  luckydraw_name
                },
                success: function(data) {
                    let isNameValid = true;
                    // Check name validation
                    if(data.action['field'] == 'name'){
                        if(data.action['status'] == 1){
                            $('.error_log_name').show();
                            $('.error_log_name').text('This Luckydraw name is already exists');
                            isNameValid = false;
                        } else {
                            $('.error_log_name').hide();
                            $('.error_log_name').text('');
                        }
                    }
                    $('.btn-cons').prop('disabled', !(isNameValid));
                }
            });
            }
        }
        $('#luckydraw_name').on('keyup',check_val);
    })
    function close_data(){
        $('.luckydraw_ticket_id').html('');
        $('#status option:first').prop('selected', true);
    }
    function update_btn(val){
            $('.luckydraw_manager_name').text('');
            $('.luckydraw_frequent').text('');
            $('#luckydraw_data').html(""); // Clear previous data
            $('.sale_luckydraw_hidden_id').val('');
            $('.sale_hidden_count').val('');
            $('.winner_span').text('');
            $('.sale_hidden_prize').val('');
            $('.luckydraw_no_of_prizes').text('');
            $('.luckydraw_hidden_frequency').val('');
            var recordId = $(val).data("id");
            var sold = $(val).data("sold");
            // console.log(recordId);
            $.ajax({
                url: "{{ url('luckydraw/get_declare_winner') }}",
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "recordId": recordId,
                },
                success: function(response) {
                    if (response.luckydraw) { // Ensure response has data
                        console.log(response.sale_count)
                        $('.luckydraw_manager_name').text(response.luckydraw.luckydraw_name);
                        $('.sale_hidden_count').val(response.sale_count);
                        $('.sale_hidden_prize').val(response.luckydraw.no_of_prizes);
                        $('.luckydraw_no_of_prizes').text(response.luckydraw.no_of_prizes);
                        $('.sale_luckydraw_hidden_id').val(response.luckydraw.id);
                        $('.luckydraw_hidden_frequency').val(response.luckydraw.frequency);
                        if (response.luckydraw.frequency == 1) {
                            $('.luckydraw_frequent').text('Daily');
                        } else if (response.luckydraw.frequency == 2) {
                            $('.luckydraw_frequent').text('Weekly');
                        } else if (response.luckydraw.frequency == 3) {
                            $('.luckydraw_frequent').text('Monthly');
                        } else if (response.luckydraw.frequency == 4) {
                            $('.luckydraw_frequent').text('Yearly');
                        }
                        if (response.sale_count == 0) {
                            $('.declare_winner').prop('disable', true);
                            $('.winner_span').text('No Sales so no winners');
                        } else {
                            $('.declare_winner').prop('disable', false);
                            $('.winner_span').text('');
                        }
                        var rowData = `<tr>
                    <td>${response.luckydraw.start_date}</td>
                    <td>${response.luckydraw.end_date}</td>
                    <td>${sold}</td>
                    <td>${response.sale_count}</td>
                </tr>`;
                        $('#luckydraw_data').append(rowData);
                    } else {
                        $('#luckydraw_data').append("<tr><td colspan='4'>No data found</td></tr>");
                    }
                },
                error: function(xhr, status, error) {
                    console.log("AJAX Error: ", error);
                }
            });
            $("#myModal").modal("show");
        }
    $('.cancel-btn').on('click', function(e) {
        e.preventDefault();
        if (confirm("Do you want to Cancel this Edit?")) {
            $('#form-condensed')[0].reset();
            $('.error_log_name, .error_log_code').hide().text('');
        }
    });

</script>