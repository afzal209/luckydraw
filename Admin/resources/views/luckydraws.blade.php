@extends('layout')
@section('title','Create Luckydraw')
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
            width: 14px;
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
        <li><a href="#" class="active">
            @if(isset($luckydraws_edit))
            Edit Luckydraw
            @else
            Create a New Luckydraw
            @endif
            </a> </li>
    </ul>
	<div class="row form-row">
		<form action="{{ isset($luckydraws_edit) ? route('luckydraw.update', $luckydraws_edit->id) : route('luckydraw.create') }}" method="POST" id="form_traditional_validation" name="form_traditional_validation" role="form" autocomplete="off" enctype="multipart/form-data">
		    @csrf
			<div class="col-md-12">
				<div class="grid simple">
					<div class="grid-body">
						<div class="row form-row">
							<div class="col-md-3">
								<p>Name of the Luckydraw <font color="red">*</font></p>
								<input name="luckydraw_name" id="luckydraw_name" type="text" class="form-control" placeholder="Luckydraw Name" value="{{$luckydraws_edit->luckydraw_name ?? ''}}" required  onkeyup="get_name_total($(this).val(),$('#total_hidden').val())">
								<label style="color:red;display:none;" class="error_log_name"></label>
							</div>
							<div class="col-md-3">
								<input type="hidden" value style="width:300px" id="e12" tabindex="-1" class="select2-offscreen">
								<p>Luckydraw Frequency <font color="red">*</font></p>
								<select name="frequency" id="frequency" class="select2" style="width:100%" required>
									<option value="">Choose Frequency</option>
									<option value="1" @if(isset($luckydraws_edit) && $luckydraws_edit->frequency == 1) selected @endif >Daily</option>
									<option value="2" @if(isset($luckydraws_edit) && $luckydraws_edit->frequency == 2) selected @endif >Weekly</option>
									<option value="3" @if(isset($luckydraws_edit) && $luckydraws_edit->frequency == 3) selected @endif >Monthly</option>
									<option value="4" @if(isset($luckydraws_edit) && $luckydraws_edit->frequency == 4) selected @endif >Yearly</option>
								</select>
							</div>
							<input type="hidden" name="method_hidden_id" id="method_hidden_id" value="{{ isset($luckydraws_edit) ? $luckydraws_edit->template_option : '' }}"/>
							<input type="hidden" name="template_hidden_id[]" id="template_hidden_id" value="{{ isset($luckydraws_edit) ? json_encode(explode(',', $luckydraws_edit->template_id)) : '' }}"/>
							<input type="hidden" name="region_hidden_id[]" id="region_hidden_id" value="{{ isset($luckydraws_edit) ? json_encode(explode(',', $luckydraws_edit->region_id)) : '' }}"/>
							<input type="hidden" name="country_hidden_id[]" id="country_hidden_id" value="{{ isset($luckydraws_edit) ? json_encode(explode(',', $luckydraws_edit->country_id)) : '' }}"/>
							<input type="hidden" name="state_hidden_id[]" id="state_hidden_id" value="{{ isset($luckydraws_edit) ? json_encode(explode(',', $luckydraws_edit->state_id)) : '' }}"/>
							<input type="hidden" name="luckydraw_hidden_id[]" id="luckydraw_hidden_id" value="{{ isset($luckydraws_edit) ? json_encode(explode(',', $luckydraws_edit->template_id)) : '' }}"/>
							<input type="hidden" name="luckydraw_wise_allocation_hidden_id[]" id="luckydraw_wise_allocation_hidden_id" value="{{ isset($luckydraws_edit) ? json_encode(explode(',', $luckydraws_edit->luckydraw_wise_allocation)) : '' }}"/>
							<input type="hidden" name="country_luckydraw_id_hidden_id[]" id="country_luckydraw_id_hidden_id" value="{{ isset($luckydraws_edit) ? json_encode(explode(',', $luckydraws_edit->country_luckydraw_id)) : '' }}"/>
							<input type="hidden" name="state_luckydraw_id_hidden_id[]" id="state_luckydraw_id_hidden_id" value="{{ isset($luckydraws_edit) ? json_encode(explode(',', $luckydraws_edit->state_luckydraw_id)) : '' }}"/>
							<input type="hidden" name="total_hidden" id="total_hidden" value=""/>
							<div class="col-md-3">
								<input type="hidden" value style="width:300px" id="e12" tabindex="-1" class="select2-offscreen">
								<p>Luckydraw Format <font color="red">*</font></p>
								<select name="format" id="format" class="select2" style="width:100%" required>
									<option value="">Choose Format</option>
									<option value="2" @if(isset($luckydraws_edit) && $luckydraws_edit->format == 2) selected @endif >Sequence Number</option>
									<option disabled value="1" @if(isset($luckydraws_edit) && $luckydraws_edit->format == 1) selected @endif >Unique Random Number</option>
								</select>
							</div>
							<div class="col-md-3">
								<p>Winner Logic Method <font color="red">*</font></p>
								<select name="method" id="method" class="select2" style="width:100%" required>
									<option value="">Choose Logic Method</option>
									<option value="1" @if(isset($luckydraws_edit) && $luckydraws_edit->method == 1) selected @endif >Random Number</option>
									<option disabled value="2" @if(isset($luckydraws_edit) && $luckydraws_edit->method == 2) selected @endif>Logic#2</option>
									<option disabled value="3" @if(isset($luckydraws_edit) && $luckydraws_edit->method == 3) selected @endif>Logic#3</option>
									<option disabled value="4" @if(isset($luckydraws_edit) && $luckydraws_edit->method == 4) selected @endif>Logic#4</option>
									<option disabled value="5" @if(isset($luckydraws_edit) && $luckydraws_edit->method == 5) selected @endif>Logic#5</option>
								</select>
							</div>
						</div>
						<div class="row form-row">
						    <!--
                            <div class="col-md-4">
                                <p>Business Area <font color="red">*</font></p>
							    <select name="business_area_id" id="business_area_id" style="width:100%" required>
								    <option>Choose Business Area</option>
    								@foreach($business_area as $business)
        								@if(isset($luckydraws_edit) && $luckydraws_edit->business_area_id == $business->id)
        								    <option value="{{$business->id}}" selected>{{$business->area_name}}-{{$business->area_code}}</option>
        								@else
        								    <option value="{{$business->id}}" >{{$business->area_name}}-{{$business->area_code}}</option>
        								@endif
    								@endforeach
								</select>
                            </div>
                            -->
							<div class="col-md-3">
								<p>Region <font color="red">*</font></p>
								@php
                                    $selected_regions = explode(',', isset($luckydraws_edit) && $luckydraws_edit->region_id) ; // Convert to array
                                @endphp
								<select name="region_id[]" id="region" class="select2" style="width:100%" multiple required  onchange="get_region($(this));">
								    @foreach($region as $regions)
								        <option value="{{$regions->id}}"  @if(in_array($regions->id, $selected_regions)) selected @endif>{{$regions->region_name}}</option>
								    @endforeach
								</select>
							</div>
							<div class="col-md-3">
								<p>Country <font color="red">*</font></p>
								<select name="country_id[]" id="country" class="select2" style="width:100%" multiple required onchange="get_country($(this));">
								</select>
							</div>
							<div class="col-md-3">
								<p>State</p>
								<select name="state_id[]" id="state" class="select2" style="width:100%" multiple onchange="get_state($(this));">
								</select>
							</div>
							<div class="col-md-3">
								<p>Luckydraw Selling Price <font color="red">*</font></p>
								<input name="price" id="price" type="text" class="form-control" placeholder="Luckydraw Cost in Euro" value="{{$luckydraws_edit->price ?? ''}}" required>
							</div>
						</div>
						<div class="row form-row">											
							<div class="col-md-3">
								<p>Template Options <font color="red">*</font></p>
								<select name="template_option" id="template_option" class="select2" style="width:100%" required  onchange="get_template_option($(this));">
									<option value="">Choose Template Options</option>
                                    <option value="1" @if(isset($luckydraws_edit) && $luckydraws_edit->template_option == 1) selected @endif >Individual Templates</option>
									<option value="2" @if(isset($luckydraws_edit) && $luckydraws_edit->template_option == 2) selected @endif >Template Groups</option>
								</select>
							</div>
							<div class="col-md-9">
								<p id="lucky_group">Luckydraw Template/Groups <font color="red">*</font></p>
								<!--<select name="template_id[]" id="template_id" class="select2" style="width:100%"  multiple  data-luckydraw-allocation="{{$luckydraws_edit->luckydraw_wise_allocation ?? ''}}"-->
        <!--                            data-country-luckydraw="{{$luckydraws_edit->country_luckydraw_id ?? ''}}" data-state-luckydraw="{{$luckydraws_edit->state_luckydraw_id ?? ''}}" onclick="get_luckydraw_template(this)">-->
        
        	<select name="template_id[]" id="template_id" class="select2" style="width:100%"  multiple  data-luckydraw-allocation="{{$luckydraws_edit->luckydraw_wise_allocation ?? ''}}"
                                    data-country-luckydraw="{{$luckydraws_edit->country_luckydraw_id ?? ''}}" data-state-luckydraw="{{$luckydraws_edit->state_luckydraw_id ?? ''}}" >
							        @php
                                        $selected_template = [];
                                        if (isset($luckydraws_edit) && $luckydraws_edit->template_id) {
                                            $selected_template = explode(',', $luckydraws_edit->template_id);
                                            // ✅ If "all" exists, replace with all IDs
                                            if (in_array("all", $selected_template)) {
                                                $selected_template = $template_Manager->pluck('id')->toArray(); 
                                                $selected_template[] = "all"; // keep "all" also selected (if you want)
                                            }
                                        }
                                    @endphp
                                    {{-- Optional "All" option --}}
                                    <option value="all" @if(in_array("all", $selected_template)) selected @endif>All</option>
                                    @php 
                                    $template_group = \App\Models\Template_group::where('status',1)->get();
                                    @endphp
                                    @if(isset($luckydraws_edit))
                                    @if($luckydraws_edit->template_option == 1)
                                    @foreach($template_Manager as $template_Managers)
                                        <option value="{{$template_Managers->id}}" 
                                            @if(in_array($template_Managers->id, $selected_template)) selected @endif>
                                            {{ $template_Managers->template_name }}
                                        </option>
                                    @endforeach
                                    @else 
                                    @foreach($template_group as $template_groups)
                                        <option value="{{$template_groups->id}}" 
                                            @if(in_array($template_groups->id, $selected_template)) selected @endif>
                                            {{ $template_groups->group_name }}
                                        </option>
                                    @endforeach
                                    @endif
                                    @endif
								</select>
							</div>
						</div>
						<div class="row form-row">											
							<div class="col-md-4">
								<p>Luckydraw Start Date <font color="red">*</font></p>
								<div class="input-append success date col-md-10 col-lg-6 no-padding">
									<input type="date" name="start_date" id="start_date" class="form-control" value="{{$luckydraws_edit->start_date ?? ''}}" required>
									<span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span>
								</div>
							</div>
							<div class="col-md-4">
							    <div class="d-flex align-items-center justify-content-start" style="gap: 10px;">
                                    <p class="mb-0">Luckydraw End Date <font color="red">*</font> <label class="mb-0"  style="color:brown;display:none;font-size:11px;margin-left: 140px;color: red;margin-top: -22px;" id="luckydraw_end_date_label"></label></p>
                                </div>
								<div
									class="input-append success date col-md-10 col-lg-6 no-padding">
									<input type="date" name="end_date" id="end_date" class="form-control" value="{{$luckydraws_edit->end_date ?? ''}}" required>
									<span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span>
								</div>
							</div>
							<div class="col-md-4">
								<p>Number of Prizes <font color="red">*</font></p>
								<input name="no_of_prizes" id="no_of_prizes" type="text" class="form-control" placeholder="Enter No of Price" value="{{$luckydraws_edit->no_of_prizes ?? ''}}" required>
							</div>											
						</div>
						<div class="row form-row">
							<div class="col-md-12">
							    <div class="luckydraw_template">
							    </div>
							</div>
						</div>
						<div class="row form-row" id="prizeRowsContainer">
						    @if(isset($prize_group))
							    @foreach($prize_group as $prize)
								    @php $index = $loop->iteration; @endphp
                                    <div class="col-md-12 prize-row" >
                                        <div class="row">
                                            <input type="hidden" name="prize_id[]" value="{{$prize->id ?? ''}}" id="prize_id{{$index}}" />
                                            <div class="col-md-3" id="prize_type_div{{$index}}">
                                                <p>Choose Type Of Prize <font color="red">*</font></p>
                                                <select name="prize_type[]" class="select2 form-control" required  onchange="get_prize_type($(this), {{$index}})">
                                                    
                                                    <option value="1" @if( $prize->prize_type === 1) selected @endif >Cash Prize</option>
                                                    <option value="2" @if( $prize->prize_type === 2) selected @endif >Item/Product</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3" id="amount_div{{$index}}" >
                                                <p>Prize Amount <font color="red">*</font></p>
                                                <input name="amount[]" type="text" class="form-control" placeholder="Enter Prize Amount" value="{{$prize->amount ?? ''}}">
                                            </div>
                                            @if(!$prize)
                                            <div class="col-md-3" id="currency_div{{$index}}">
                                                <p>Currency <font color="red">*</font></p>
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
                                            @endif
                                            <div class="col-md-3" id="item_div{{$index}}">
                                                <p>Item/Product Name <font color="red">*</font></p>
                                                 <input type="text" name="item[]" class="form-control"  placeholder="Enter Item/Product Name" value="{{$prize->item ?? ''}}" >
                                            </div>
                                            <div class="col-md-3" id="image_div{{$index}}">
                                                <p>Upload Prize Image</p>
                                                @if(isset($luckydraws_edit))
                                                <input type="file" name="image[]" class="form-control" >
                                                @else
                                                 <input type="file" name="image[]" class="form-control" required>
                                                @endif
                                                @if(isset($luckydraws_edit))
                                    			    <img src="{{request()->getSchemeAndHttpHost()}}/uploads/luckydraw/prizes/{{$prize->image}}" style="width:100px;height:100px;">
                                    		    @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <input type="hidden" name="hidden_image" value="edit" id="hidden_image" />
                                @endforeach
                            @else
                            
                            <input type="hidden" name="hidden_image" value="save" id="hidden_image" />
                            	<div class="col-md-12 prize-row" >
                                    <div class="row">
                                        <div class="col-md-3" id="prize_type_div1">
                                            <p>Choose Type Of Prize <font color="red">*</font></p>
                                            <select name="prize_type[]" class="select2 form-control" required  onchange="get_prize_type($(this),1)">
                                                
                                                <option value="1" >Cash Prize</option>
                                                <option value="2" >Item/Product</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3" id="amount_div1">
                                            <p>Prize Amount <font color="red">*</font></p>
                                            <input name="amount[]" type="text" class="form-control" placeholder="Enter Prize Amount" value="">
                                        </div>
                                        <div class="col-md-3" id="currency_div1">
                                            <p>Currency  <font color="red">*</font></p>
                                            <select name="currency[]" class="select2 form-control"  >
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
                                        <div class="col-md-3" id="item_div1">
                                            <p>Item/Product Name <font color="red">*</font></p>
                                             <input type="text" name="item[]" class="form-control"  placeholder="Enter Item/Product Name" value="" >
                                        </div>
                                        <div class="col-md-3" id="image_div1">
                                            <p>Upload Prize Image</p>
                                            <input type="file" name="image[]" class="form-control" >
                                             									
                                        </div>
                                    </div>
                                </div>
						    @endif
                        </div>
						<div class="form-actions">
						    <div class="pull-left">
						    <div class="row">
						        <div class="col-md-12">
									<p id="message"></p>
								</div>    
						    </div>
						     <div class="row" id="heading_div">
						      </div>
						    </div> 	
							<div class="pull-right">
							     @if(isset($luckydraws_edit))
									<button class="btn btn-success btn-cons" id="icon" type="submit"><i class="fa fa-refresh"></i> Update Luckydraw</button>
								@else
								<button class="btn btn-success btn-cons" id="icon" type="submit"><i class="fa fa-gift"></i> Create Luckydraw</button>
								@endif
								<a href="{{route('luckydraws')}}" class="btn btn-warning btn-cons cancel-btn" type="reset" id="clear-btn"><i class="fa fa-eraser"></i> Clear</a >
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
    <!-- END DROPDOWN CONTROLS-->
	

@endsection

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 
 
 
 

 
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




<script>

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggleLink').forEach(function (toggleLink) {
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
});
</script>
 <script>
    // luckydraw_end_date_label
    $(document).ready(function() {
        
        $('.cancel-btn').on('click', function(e) {
        e.preventDefault();
        if (confirm("Do you want to Cancel this Edit?")) {
            $('#form-condensed')[0].reset();
            $('.error_log_name, .error_log_code').hide().text('');
        }
    });
        // get_prize_type
       
        
        // get_luckydraw_template(('#template_id'));
        
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
    let selectedRegions = [];
    let selectedCountries = [];
    let selectedStates = [];
    let selectedMethod;
    let selectedTemplate_Id = [];
    
    selectedMethod = $('#method_hidden_id');
    
    
    if ($('#template_hidden_id').val() != '') {
        try {
            selectedTemplate_Id = JSON.parse($('#template_hidden_id').val());
        } catch (e) {
            selectedTemplate_Id = $('#template_hidden_id').val().split(',');
        }
    }
    
    // if ($('#region_hidden_id').val() != '') {
    //     try {
    //         selectedRegions = JSON.parse($('#region_hidden_id').val());
    //     } catch (e) {
    //         selectedRegions = $('#region_hidden_id').val().split(',');
    //     }
    // }
    
    // Restore hidden values
    if ($('#region_hidden_id').val() != '') {
        try {
            selectedRegions = JSON.parse($('#region_hidden_id').val());
        } catch (e) {
            selectedRegions = $('#region_hidden_id').val().split(',');
        }
    }
    if ($('#country_hidden_id').val() != '') {
        try {
            selectedCountries = JSON.parse($('#country_hidden_id').val());
        } catch (e) {
            selectedCountries = $('#country_hidden_id').val().split(',');
        }
    }
    if ($('#state_hidden_id').val() != '') {
        try {
            selectedStates = JSON.parse($('#state_hidden_id').val());
        } catch (e) {
            selectedStates = $('#state_hidden_id').val().split(',');
        }
    }
    
    
    var option_id = $(selectedMethod).val();
        
        if(option_id == ''){
            $('#lucky_group').text('Luckydraw Template/Groups');
        } 
        else if(option_id == 1){
            $('#lucky_group').text('Luckydraw Individual Templates');
        }
        else{
            $('#lucky_group').text('Luckydraw Template Groups');
        }
        
        $('#template_id').html('');
        $('#template_id').val(null).trigger('change');
           // // Convert countryIds to array if it's a string (for single-select)
    
            $.ajax({
                url: "{{ url('luckydraw/get_template_option') }}",
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "option_id": option_id,
                },
                success: function(data) {
                    // console.log(data);
                     $(data.template_option).each(function(key, value) {
                        $('#template_id').append('<option value=' + value.id + '>' + value.name + '</option>')
                    });
                    // console.log(data['doneMessage']);
                    //  $('#state').append('<option>Select State</option>')
                    $('#template_id').val(selectedTemplate_Id).trigger('change');
                }
            });
    
    
    

    // Step 1: Load Regions
    $('#region').val(selectedRegions).trigger('change');
    handleAllOption('#region', selectedRegions);

    // Step 2: Load Countries (after region is restored)
    $.ajax({
        url: "{{ url('luckydraw/get_country') }}",
        type: "GET",
        data: {
            "_token": "{{ csrf_token() }}",
            "region_id": selectedRegions,
        },
        success: function (data) {
            $('#country').html('');
            $(data.countries).each(function (key, value) {
                $('#country').append('<option value="' + value.id + '">' + value.country_name + '</option>');
            });

            $('#country').val(selectedCountries).trigger('change');
            handleAllOption('#country', selectedCountries);

            // Step 3: Load States (AFTER country is restored)
            $.ajax({
                url: "{{ url('luckydraw/get_state') }}",
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "country_id": selectedCountries,
                },
                success: function (data) {
                    $('#state').html('');
                    $(data.states).each(function (key, value) {
                        $('#state').append('<option value="' + value.id + '">' + value.state_title + '</option>');
                    });

                    $('#state').val(selectedStates).trigger('change');
                    handleAllOption('#state', selectedStates);
                }
            });
        }
    });

    // Helper: disable/enable "all"
    function handleAllOption(selector, selectedValues) {
        $(selector + ' option').prop('disabled', false);
        if (selectedValues.includes("all")) {
            $(selector + ' option').each(function () {
                if ($(this).val() !== "all") {
                    $(this).prop('disabled', true).prop('selected', false);
                }
            });
        } else if (selectedValues.length > 0) {
            $(selector + ' option[value="all"]').prop('disabled', true).prop('selected', false);
        }
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
    
    function get_template_option(val){
        var option_id = $(val).val();
        $('#lucky_group').text('');
        if(option_id == ''){
            $('#lucky_group').text('Luckydraw Template/Groups');
        } 
        else if(option_id == 1){
            $('#lucky_group').text('Luckydraw Individual Templates');
        }
        else{
            $('#lucky_group').text('Luckydraw Template Groups');
        }
        
        $('#template_id').html('');
        $('#template_id').val(null).trigger('change');
           // // Convert countryIds to array if it's a string (for single-select)
    
            $.ajax({
                url: "{{ url('luckydraw/get_template_option') }}",
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "option_id": option_id,
                },
                success: function(data) {
                    // console.log(data);
                     $(data.template_option).each(function(key, value) {
                        $('#template_id').append('<option value=' + value.id + '>' + value.name + '</option>')
                    });
                    // console.log(data['doneMessage']);
                    //  $('#state').append('<option>Select State</option>')
                   
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
    let editMode = <?php echo isset($luckydraws_edit) ? 'true' : 'false'; ?>;
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
            var sale_price = $('.sale_hidden_price').val();
            var luckydraw_frequency = $('.luckydraw_hidden_frequency').val();
            $('.luckydraw_ticket_id').html('');
            var sale_luckydraw_hidden_id = $('.sale_luckydraw_hidden_id').val();
            var compare_value = '';
            if (sale_count < sale_price) {
                compare_value = sale_count;
            } else if (sale_price < sale_count) {
                compare_value = sale_price;
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
        get_name_total('LuckydrawName', 'Total')
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
let cleanTemplateText = templateText.trim();

            $('.luckydraw_template').append(`
                <input type="hidden" name="template_luckydraw_id[]" value="${templateValue}" />
                <div class="row form-row">
                    <div class="col-md-3">
                        <p>Template</p>
                        <input name="template_luckydraw_name[]" type="text" class="form-control template_luckydraw_name" value="${cleanTemplateText}" readonly>
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
        get_name_total(name, sum);
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
        var sale_price = $('.sale_hidden_price').val();
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
            $('.sale_hidden_price').val('');
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
                        $('.sale_hidden_price').val(response.luckydraw.no_of_prizes);
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
</script>