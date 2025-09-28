@extends('layout')
@section('title','Payment Gateway Settings')
@section('content')
<ul class="breadcrumb">
   <li><p>Dashboard</p></li>
   <li><a href="#" class="active">Settings</a></li>
   <li><a href="#" class="active">Manage Payment Gateway Settings</a> </li>
</ul>
<div class="row-fluid">
    <div class="span12">
        <div class="grid simple ">
            <div class="grid-title">
                <h3><i class="fa fa-credit-card"></i><span class="semi-bold"> Manage Payment Gateway Settings</span></h3>
            </div>
            <div class="grid-body ">
                <form class="form-no-horizontal-spacing" id="form-condensed" action="{{route('settings.payment_gateway.create_general_payment_gateway')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                           <p>Time Zone<font color="red">*</font></p>
                           <select id="default_time_zone" name="default_time_zone" class="form-control" >
								<option value="America/Scoresbysund GMT-1:00" @if($General_Payment_Gateway->default_time_zone == 'America/Scoresbysund GMT-1:00') selected @endif>America/Scoresbysund GMT-1:00</option>
								<option value="Atlantic/Azores GMT-1:00" @if($General_Payment_Gateway->default_time_zone == 'Atlantic/Azores GMT-1:00') selected @endif>Atlantic/Azores GMT-1:00</option>
								<option value="Atlantic/Cape_Verde GMT-1:00" @if($General_Payment_Gateway->default_time_zone == 'Atlantic/Cape_Verde GMT-1:00') selected @endif>Atlantic/Cape_Verde GMT-1:00</option>
								<option value="Etc/GMT+1 GMT-1:00" @if($General_Payment_Gateway->default_time_zone == 'Etc/GMT+1 GMT-1:00') selected @endif>Etc/GMT+1 GMT-1:00</option>
								<option value="America/Adak GMT-10:00" @if($General_Payment_Gateway->default_time_zone == 'America/Adak GMT-10:00') selected @endif>America/Adak GMT-10:00</option>
								<option value="America/Atka GMT-10:00" @if($General_Payment_Gateway->default_time_zone == 'America/Atka GMT-10:00') selected @endif>America/Atka GMT-10:00</option>
								<option value="Etc/GMT+10 GMT-10:00" @if($General_Payment_Gateway->default_time_zone == 'Etc/GMT+10 GMT-10:00') selected @endif>Etc/GMT+10 GMT-10:00</option>
								<option value="HST GMT-10:00" @if($General_Payment_Gateway->default_time_zone == 'HST GMT-10:00') selected @endif>HST GMT-10:00</option>
								<option value="Pacific/Fakaofo GMT-10:00" @if($General_Payment_Gateway->default_time_zone == 'Pacific/Fakaofo GMT-10:00') selected @endif>Pacific/Fakaofo GMT-10:00</option>
								<option value="Pacific/Honolulu GMT-10:00" @if($General_Payment_Gateway->default_time_zone == 'Pacific/Honolulu GMT-10:00') selected @endif>Pacific/Honolulu GMT-10:00</option>
								<option value="Pacific/Johnston GMT-10:00" @if($General_Payment_Gateway->default_time_zone == 'Pacific/Johnston GMT-10:00') selected @endif>Pacific/Johnston GMT-10:00</option>
								<option value="Pacific/Rarotonga GMT-10:00" @if($General_Payment_Gateway->default_time_zone == 'Pacific/Rarotonga GMT-10:00') selected @endif>Pacific/Rarotonga GMT-10:00</option>
								<option value="Pacific/Tahiti GMT-10:00" @if($General_Payment_Gateway->default_time_zone == 'Pacific/Tahiti GMT-10:00') selected @endif>Pacific/Tahiti GMT-10:00</option>
								<option value="SystemV/HST10 GMT-10:00" @if($General_Payment_Gateway->default_time_zone == 'SystemV/HST10 GMT-10:00') selected @endif>SystemV/HST10 GMT-10:00</option>
								<option value="US/Aleutian GMT-10:00" @if($General_Payment_Gateway->default_time_zone == 'US/Aleutian GMT-10:00') selected @endif>US/Aleutian GMT-10:00</option>
								<option value="US/Hawaii GMT-10:00" @if($General_Payment_Gateway->default_time_zone == 'US/Hawaii GMT-10:00') selected @endif>US/Hawaii GMT-10:00</option>
								<option value="Etc/GMT+11 GMT-11:00" @if($General_Payment_Gateway->default_time_zone == 'Etc/GMT+11 GMT-11:00') selected @endif>Etc/GMT+11 GMT-11:00</option>
								<option value="MIT GMT-11:00" @if($General_Payment_Gateway->default_time_zone == 'MIT GMT-11:00') selected @endif>MIT GMT-11:00</option>
								<option value="Pacific/Apia GMT-11:00" @if($General_Payment_Gateway->default_time_zone == 'Pacific/Apia GMT-11:00') selected @endif>Pacific/Apia GMT-11:00</option>
								<option value="Pacific/Midway GMT-11:00" @if($General_Payment_Gateway->default_time_zone == 'Pacific/Midway GMT-11:00') selected @endif>Pacific/Midway GMT-11:00</option>
								<option value="Pacific/Niue GMT-11:00" @if($General_Payment_Gateway->default_time_zone == 'Pacific/Niue GMT-11:00') selected @endif>Pacific/Niue GMT-11:00</option>
								<option value="Pacific/Pago_Pago GMT-11:00" @if($General_Payment_Gateway->default_time_zone == 'Pacific/Pago_Pago GMT-11:00') selected @endif>Pacific/Pago_Pago GMT-11:00</option>
								<option value="Pacific/Samoa GMT-11:00" @if($General_Payment_Gateway->default_time_zone == 'Pacific/Samoa GMT-11:00') selected @endif>Pacific/Samoa GMT-11:00</option>
								<option value="US/Samoa GMT-11:00" @if($General_Payment_Gateway->default_time_zone == 'US/Samoa GMT-11:00') selected @endif>US/Samoa GMT-11:00</option>
								<option value="Etc/GMT+12 GMT-12:00" @if($General_Payment_Gateway->default_time_zone == 'Etc/GMT+12 GMT-12:00') selected @endif>Etc/GMT+12 GMT-12:00</option>
								<option value="America/Noronha GMT-2:00" @if($General_Payment_Gateway->default_time_zone == 'America/Noronha GMT-2:00') selected @endif>America/Noronha GMT-2:00</option>
								<option value="Atlantic/South_Georgia GMT-2:00" @if($General_Payment_Gateway->default_time_zone == 'Atlantic/South_Georgia GMT-2:00') selected @endif>Atlantic/South_Georgia GMT-2:00</option>
								<option value="Brazil/DeNoronha GMT-2:00" @if($General_Payment_Gateway->default_time_zone == 'Brazil/DeNoronha GMT-2:00') selected @endif>Brazil/DeNoronha GMT-2:00</option>
								<option value="Etc/GMT+2 GMT-2:00" @if($General_Payment_Gateway->default_time_zone == 'Etc/GMT+2 GMT-2:00') selected @endif>Etc/GMT+2 GMT-2:00</option>
								<option value="AGT GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'AGT GMT-3:00') selected @endif>AGT GMT-3:00</option>
								<option value="America/Araguaina GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Araguaina GMT-3:00') selected @endif>America/Araguaina GMT-3:00</option>
								<option value="America/Argentina/Buenos_Aires GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Argentina/Buenos_Aires GMT-3:00') selected @endif>America/Argentina/Buenos_Aires GMT-3:00</option>
								<option value="America/Argentina/Catamarca GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Argentina/Catamarca GMT-3:00') selected @endif>America/Argentina/Catamarca GMT-3:00</option>
								<option value="America/Argentina/ComodRivadavia GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Argentina/ComodRivadavia GMT-3:00') selected @endif>America/Argentina/ComodRivadavia GMT-3:00</option>
								<option value="America/Argentina/Cordoba GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Argentina/Cordoba GMT-3:00') selected @endif>America/Argentina/Cordoba GMT-3:00</option>
								<option value="America/Argentina/Jujuy GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Argentina/Jujuy GMT-3:00') selected @endif>America/Argentina/Jujuy GMT-3:00</option>
								<option value="America/Argentina/La_Rioja GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Argentina/La_Rioja GMT-3:00') selected @endif>America/Argentina/La_Rioja GMT-3:00</option>
								<option value="America/Argentina/Mendoza GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Argentina/Mendoza GMT-3:00') selected @endif>America/Argentina/Mendoza GMT-3:00</option>
								<option value="America/Argentina/Rio_Gallegos GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Argentina/Rio_Gallegos GMT-3:00') selected @endif>America/Argentina/Rio_Gallegos GMT-3:00</option>
								<option value="America/Argentina/Salta GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Argentina/Salta GMT-3:00') selected @endif>America/Argentina/Salta GMT-3:00</option>
								<option value="America/Argentina/San_Juan GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Argentina/San_Juan GMT-3:00') selected @endif>America/Argentina/San_Juan GMT-3:00</option>
								<option value="America/Argentina/Tucuman GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Argentina/Tucuman GMT-3:00') selected @endif>America/Argentina/Tucuman GMT-3:00</option>
								<option value="America/Argentina/Ushuaia GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Argentina/Ushuaia GMT-3:00') selected @endif>America/Argentina/Ushuaia GMT-3:00</option>
								<option value="America/Bahia GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Bahia GMT-3:00') selected @endif>America/Bahia GMT-3:00</option>
								<option value="America/Belem GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Belem GMT-3:00') selected @endif>America/Belem GMT-3:00</option>
								<option value="America/Buenos_Aires GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Buenos_Aires GMT-3:00') selected @endif>America/Buenos_Aires GMT-3:00</option>
								<option value="America/Catamarca GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Catamarca GMT-3:00') selected @endif>America/Catamarca GMT-3:00</option>
								<option value="America/Cayenne GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Cayenne GMT-3:00') selected @endif>America/Cayenne GMT-3:00</option>
								<option value="America/Cordoba GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Cordoba GMT-3:00') selected @endif>America/Cordoba GMT-3:00</option>
								<option value="America/Fortaleza GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Fortaleza GMT-3:00') selected @endif>America/Fortaleza GMT-3:00</option>
								<option value="America/Godthab GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Godthab GMT-3:00') selected @endif>America/Godthab GMT-3:00</option>
								<option value="America/Jujuy GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Jujuy GMT-3:00') selected @endif>America/Jujuy GMT-3:00</option>
								<option value="America/Maceio GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Maceio GMT-3:00') selected @endif>America/Maceio GMT-3:00</option>
								<option value="America/Mendoza GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Mendoza GMT-3:00') selected @endif>America/Mendoza GMT-3:00</option>
								<option value="America/Miquelon GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Miquelon GMT-3:00') selected @endif>America/Miquelon GMT-3:00</option>
								<option value="America/Montevideo GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Montevideo GMT-3:00') selected @endif>America/Montevideo GMT-3:00</option>
								<option value="America/Paramaribo GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Paramaribo GMT-3:00') selected @endif>America/Paramaribo GMT-3:00</option>
								<option value="America/Recife GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Recife GMT-3:00') selected @endif>America/Recife GMT-3:00</option>
								<option value="America/Rosario GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Rosario GMT-3:00') selected @endif>America/Rosario GMT-3:00</option>
								<option value="America/Santarem GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Santarem GMT-3:00') selected @endif>America/Santarem GMT-3:00</option>
								<option value="America/Sao_Paulo GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'America/Sao_Paulo GMT-3:00') selected @endif>America/Sao_Paulo GMT-3:00</option>
								<option value="Antarctica/Rothera GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'Antarctica/Rothera GMT-3:00') selected @endif>Antarctica/Rothera GMT-3:00</option>
								<option value="BET GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'BET GMT-3:00') selected @endif>BET GMT-3:00</option>
								<option value="Brazil/East GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'Brazil/East GMT-3:00') selected @endif>Brazil/East GMT-3:00</option>
								<option value="Etc/GMT+3 GMT-3:00" @if($General_Payment_Gateway->default_time_zone == 'Etc/GMT+3 GMT-3:00') selected @endif>Etc/GMT+3 GMT-3:00</option>
								<option value="America/St_Johns GMT-3:30" @if($General_Payment_Gateway->default_time_zone == 'America/St_Johns GMT-3:30') selected @endif>America/St_Johns GMT-3:30</option>
								<option value="Canada/Newfoundland GMT-3:30" @if($General_Payment_Gateway->default_time_zone == 'Canada/Newfoundland GMT-3:30') selected @endif>Canada/Newfoundland GMT-3:30</option>
								<option value="CNT GMT-3:30" @if($General_Payment_Gateway->default_time_zone == 'CNT GMT-3:30') selected @endif>CNT GMT-3:30</option>
								<option value="America/Anguilla GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Anguilla GMT-4:00') selected @endif>America/Anguilla GMT-4:00</option>
								<option value="America/Antigua GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Antigua GMT-4:00') selected @endif>America/Antigua GMT-4:00</option>
								<option value="America/Argentina/San_Luis GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Argentina/San_Luis GMT-4:00') selected @endif>America/Argentina/San_Luis GMT-4:00</option>
								<option value="America/Aruba GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Aruba GMT-4:00') selected @endif>America/Aruba GMT-4:00</option>
								<option value="America/Asuncion GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Asuncion GMT-4:00') selected @endif>America/Asuncion GMT-4:00</option>
								<option value="America/Barbados GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Barbados GMT-4:00') selected @endif>America/Barbados GMT-4:00</option>
								<option value="America/Blanc-Sablon GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Blanc-Sablon GMT-4:00') selected @endif>America/Blanc-Sablon GMT-4:00</option>
								<option value="America/Boa_Vista GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Boa_Vista GMT-4:00') selected @endif>America/Boa_Vista GMT-4:00</option>
								<option value="America/Campo_Grande GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Campo_Grande GMT-4:00') selected @endif>America/Campo_Grande GMT-4:00</option>
								<option value="America/Cuiaba GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Cuiaba GMT-4:00') selected @endif>America/Cuiaba GMT-4:00</option>
								<option value="America/Curacao GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Curacao GMT-4:00') selected @endif>America/Curacao GMT-4:00</option>
								<option value="America/Dominica GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Dominica GMT-4:00') selected @endif>America/Dominica GMT-4:00</option>
								<option value="America/Eirunepe GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Eirunepe GMT-4:00') selected @endif>America/Eirunepe GMT-4:00</option>
								<option value="America/Glace_Bay GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Glace_Bay GMT-4:00') selected @endif>America/Glace_Bay GMT-4:00</option>
								<option value="America/Goose_Bay GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Goose_Bay GMT-4:00') selected @endif>America/Goose_Bay GMT-4:00</option>
								<option value="America/Grenada GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Grenada GMT-4:00') selected @endif>America/Grenada GMT-4:00</option>
								<option value="America/Guadeloupe GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Guadeloupe GMT-4:00') selected @endif>America/Guadeloupe GMT-4:00</option>
								<option value="America/Guyana GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Guyana GMT-4:00') selected @endif>America/Guyana GMT-4:00</option>
								<option value="America/Halifax GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Halifax GMT-4:00') selected @endif>America/Halifax GMT-4:00</option>
								<option value="America/La_Paz GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/La_Paz GMT-4:00') selected @endif>America/La_Paz GMT-4:00</option>
								<option value="America/Manaus GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Manaus GMT-4:00') selected @endif>America/Manaus GMT-4:00</option>
								<option value="America/Marigot GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Marigot GMT-4:00') selected @endif>America/Marigot GMT-4:00</option>
								<option value="America/Martinique GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Martinique GMT-4:00') selected @endif>America/Martinique GMT-4:00</option>
								<option value="America/Moncton GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Moncton GMT-4:00') selected @endif>America/Moncton GMT-4:00</option>
								<option value="America/Montserrat GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Montserrat GMT-4:00') selected @endif>America/Montserrat GMT-4:00</option>
								<option value="America/Port_of_Spain GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Port_of_Spain GMT-4:00') selected @endif>America/Port_of_Spain GMT-4:00</option>
								<option value="America/Porto_Acre GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Porto_Acre GMT-4:00') selected @endif>America/Porto_Acre GMT-4:00</option>
								<option value="America/Porto_Velho GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Porto_Velho GMT-4:00') selected @endif>America/Porto_Velho GMT-4:00</option>
								<option value="America/Puerto_Rico GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Puerto_Rico GMT-4:00') selected @endif>America/Puerto_Rico GMT-4:00</option>
								<option value="America/Rio_Branco GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Rio_Branco GMT-4:00') selected @endif>America/Rio_Branco GMT-4:00</option>
								<option value="America/Santiago GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Santiago GMT-4:00') selected @endif>America/Santiago GMT-4:00</option>
								<option value="America/Santo_Domingo GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Santo_Domingo GMT-4:00') selected @endif>America/Santo_Domingo GMT-4:00</option>
								<option value="America/St_Barthelemy GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/St_Barthelemy GMT-4:00') selected @endif>America/St_Barthelemy GMT-4:00</option>
								<option value="America/St_Kitts GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/St_Kitts GMT-4:00') selected @endif>America/St_Kitts GMT-4:00</option>
								<option value="America/St_Lucia GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/St_Lucia GMT-4:00') selected @endif>America/St_Lucia GMT-4:00</option>
								<option value="America/St_Thomas GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/St_Thomas GMT-4:00') selected @endif>America/St_Thomas GMT-4:00</option>
								<option value="America/St_Vincent GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/St_Vincent GMT-4:00') selected @endif>America/St_Vincent GMT-4:00</option>
								<option value="America/Thule GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Thule GMT-4:00') selected @endif>America/Thule GMT-4:00</option>
								<option value="America/Tortola GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Tortola GMT-4:00') selected @endif>America/Tortola GMT-4:00</option>
								<option value="America/Virgin GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'America/Virgin GMT-4:00') selected @endif>America/Virgin GMT-4:00</option>
								<option value="Antarctica/Palmer GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'Antarctica/Palmer GMT-4:00') selected @endif>Antarctica/Palmer GMT-4:00</option>
								<option value="Atlantic/Bermuda GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'Atlantic/Bermuda GMT-4:00') selected @endif>Atlantic/Bermuda GMT-4:00</option>
								<option value="Atlantic/Stanley GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'Atlantic/Stanley GMT-4:00') selected @endif>Atlantic/Stanley GMT-4:00</option>
								<option value="Brazil/Acre GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'Brazil/Acre GMT-4:00') selected @endif>Brazil/Acre GMT-4:00</option>
								<option value="Brazil/West GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'Brazil/West GMT-4:00') selected @endif>Brazil/West GMT-4:00</option>
								<option value="Canada/Atlantic GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'Canada/Atlantic GMT-4:00') selected @endif>Canada/Atlantic GMT-4:00</option>
								<option value="Chile/Continental GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'Chile/Continental GMT-4:00') selected @endif>Chile/Continental GMT-4:00</option>
								<option value="Etc/GMT+4 GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'Etc/GMT+4 GMT-4:00') selected @endif>Etc/GMT+4 GMT-4:00</option>
								<option value="PRT GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'PRT GMT-4:00') selected @endif>PRT GMT-4:00</option>
								<option value="SystemV/AST4 GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'SystemV/AST4 GMT-4:00') selected @endif>SystemV/AST4 GMT-4:00</option>
								<option value="SystemV/AST4ADT GMT-4:00" @if($General_Payment_Gateway->default_time_zone == 'SystemV/AST4ADT GMT-4:00') selected @endif>SystemV/AST4ADT GMT-4:00</option>
								<option value="America/Caracas GMT-4:30" @if($General_Payment_Gateway->default_time_zone == 'America/Caracas GMT-4:30') selected @endif>America/Caracas GMT-4:30</option>
								<option value="America/Atikokan GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Atikokan GMT-5:00') selected @endif>America/Atikokan GMT-5:00</option>
								<option value="America/Bogota GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Bogota GMT-5:00') selected @endif>America/Bogota GMT-5:00</option>
								<option value="America/Cayman GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Cayman GMT-5:00') selected @endif>America/Cayman GMT-5:00</option>
								<option value="America/Coral_Harbour GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Coral_Harbour GMT-5:00') selected @endif>America/Coral_Harbour GMT-5:00</option>
								<option value="America/Detroit GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Detroit GMT-5:00') selected @endif>America/Detroit GMT-5:00</option>
								<option value="America/Fort_Wayne GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Fort_Wayne GMT-5:00') selected @endif>America/Fort_Wayne GMT-5:00</option>
								<option value="America/Grand_Turk GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Grand_Turk GMT-5:00') selected @endif>America/Grand_Turk GMT-5:00</option>
								<option value="America/Guayaquil GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Guayaquil GMT-5:00') selected @endif>America/Guayaquil GMT-5:00</option>
								<option value="America/Havana GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Havana GMT-5:00') selected @endif>America/Havana GMT-5:00</option>
								<option value="America/Indiana/Indianapolis GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Indiana/Indianapolis GMT-5:00') selected @endif>America/Indiana/Indianapolis GMT-5:00</option>
								<option value="America/Indiana/Marengo GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Indiana/Marengo GMT-5:00') selected @endif>America/Indiana/Marengo GMT-5:00</option>
								<option value="America/Indiana/Petersburg GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Indiana/Petersburg GMT-5:00') selected @endif>America/Indiana/Petersburg GMT-5:00</option>
								<option value="America/Indiana/Vevay GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Indiana/Vevay GMT-5:00') selected @endif>America/Indiana/Vevay GMT-5:00</option>
								<option value="America/Indiana/Vincennes GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Indiana/Vincennes GMT-5:00') selected @endif>America/Indiana/Vincennes GMT-5:00</option>
								<option value="America/Indiana/Winamac GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Indiana/Winamac GMT-5:00') selected @endif>America/Indiana/Winamac GMT-5:00</option>
								<option value="America/Indianapolis GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Indianapolis GMT-5:00') selected @endif>America/Indianapolis GMT-5:00</option>
								<option value="America/Iqaluit GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Iqaluit GMT-5:00') selected @endif>America/Iqaluit GMT-5:00</option>
								<option value="America/Jamaica GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Jamaica GMT-5:00') selected @endif>America/Jamaica GMT-5:00</option>
								<option value="America/Kentucky/Louisville GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Kentucky/Louisville GMT-5:00') selected @endif>America/Kentucky/Louisville GMT-5:00</option>
								<option value="America/Kentucky/Monticello GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Kentucky/Monticello GMT-5:00') selected @endif>America/Kentucky/Monticello GMT-5:00</option>
								<option value="America/Lima GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Lima GMT-5:00') selected @endif>America/Lima GMT-5:00</option>
								<option value="America/Louisville GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Louisville GMT-5:00') selected @endif>America/Louisville GMT-5:00</option>
								<option value="America/Montreal GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Montreal GMT-5:00') selected @endif>America/Montreal GMT-5:00</option>
								<option value="America/Nassau GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Nassau GMT-5:00') selected @endif>America/Nassau GMT-5:00</option>
								<option value="America/New_York GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/New_York GMT-5:00') selected @endif>America/New_York GMT-5:00</option>
								<option value="America/Nipigon GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Nipigon GMT-5:00') selected @endif>America/Nipigon GMT-5:00</option>
								<option value="America/Panama GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Panama GMT-5:00') selected @endif>America/Panama GMT-5:00</option>
								<option value="America/Pangnirtung GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Pangnirtung GMT-5:00') selected @endif>America/Pangnirtung GMT-5:00</option>
								<option value="America/Port-au-Prince GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Port-au-Prince GMT-5:00') selected @endif>America/Port-au-Prince GMT-5:00</option>
								<option value="America/Resolute GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Resolute GMT-5:00') selected @endif>America/Resolute GMT-5:00</option>
								<option value="America/Thunder_Bay GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Thunder_Bay GMT-5:00') selected @endif>America/Thunder_Bay GMT-5:00</option>
								<option value="America/Toronto GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'America/Toronto GMT-5:00') selected @endif>America/Toronto GMT-5:00</option>
								<option value="Canada/Eastern GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'Canada/Eastern GMT-5:00') selected @endif>Canada/Eastern GMT-5:00</option>
								<option value="Cuba GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'Cuba GMT-5:00') selected @endif>Cuba GMT-5:00</option>
								<option value="EST GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'EST GMT-5:00') selected @endif>EST GMT-5:00</option>
								<option value="EST5EDT GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'EST5EDT GMT-5:00') selected @endif>EST5EDT GMT-5:00</option>
								<option value="Etc/GMT+5 GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'Etc/GMT+5 GMT-5:00') selected @endif>Etc/GMT+5 GMT-5:00</option>
								<option value="IET GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'IET GMT-5:00') selected @endif>IET GMT-5:00</option>
								<option value="Jamaica GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'Jamaica GMT-5:00') selected @endif>Jamaica GMT-5:00</option>
								<option value="SystemV/EST5 GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'SystemV/EST5 GMT-5:00') selected @endif>SystemV/EST5 GMT-5:00</option>
								<option value="SystemV/EST5EDT GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'SystemV/EST5EDT GMT-5:00') selected @endif>SystemV/EST5EDT GMT-5:00</option>
								<option value="US/Eastern GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'US/Eastern GMT-5:00') selected @endif>US/Eastern GMT-5:00</option>
								<option value="US/East-Indiana GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'US/East-Indiana GMT-5:00') selected @endif>US/East-Indiana GMT-5:00</option>
								<option value="US/Michigan GMT-5:00" @if($General_Payment_Gateway->default_time_zone == 'US/Michigan GMT-5:00') selected @endif>US/Michigan GMT-5:00</option>
								<option value="America/Belize GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'America/Belize GMT-6:00') selected @endif>America/Belize GMT-6:00</option>
								<option value="America/Cancun GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'America/Cancun GMT-6:00') selected @endif>America/Cancun GMT-6:00</option>
								<option value="America/Chicago GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'America/Chicago GMT-6:00') selected @endif>America/Chicago GMT-6:00</option>
								<option value="America/Costa_Rica GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'America/Costa_Rica GMT-6:00') selected @endif>America/Costa_Rica GMT-6:00</option>
								<option value="America/El_Salvador GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'America/El_Salvador GMT-6:00') selected @endif>America/El_Salvador GMT-6:00</option>
								<option value="America/Guatemala GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'America/Guatemala GMT-6:00') selected @endif>America/Guatemala GMT-6:00</option>
								<option value="America/Indiana/Knox GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'America/Indiana/Knox GMT-6:00') selected @endif>America/Indiana/Knox GMT-6:00</option>
								<option value="America/Indiana/Tell_City GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'America/Indiana/Tell_City GMT-6:00') selected @endif>America/Indiana/Tell_City GMT-6:00</option>
								<option value="America/Knox_IN GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'America/Knox_IN GMT-6:00') selected @endif>America/Knox_IN GMT-6:00</option>
								<option value="America/Managua GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'America/Managua GMT-6:00') selected @endif>America/Managua GMT-6:00</option>
								<option value="America/Menominee GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'America/Menominee GMT-6:00') selected @endif>America/Menominee GMT-6:00</option>
								<option value="America/Merida GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'America/Merida GMT-6:00') selected @endif>America/Merida GMT-6:00</option>
								<option value="America/Mexico_City GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'America/Mexico_City GMT-6:00') selected @endif>America/Mexico_City GMT-6:00</option>
								<option value="America/Monterrey GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'America/Monterrey GMT-6:00') selected @endif>America/Monterrey GMT-6:00</option>
								<option value="America/North_Dakota/Center GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'America/North_Dakota/Center GMT-6:00') selected @endif>America/North_Dakota/Center GMT-6:00</option>
								<option value="America/North_Dakota/New_Salem GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'America/North_Dakota/New_Salem GMT-6:00') selected @endif>America/North_Dakota/New_Salem GMT-6:00</option>
								<option value="America/Rainy_River GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'America/Rainy_River GMT-6:00') selected @endif>America/Rainy_River GMT-6:00</option>
								<option value="America/Rankin_Inlet GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'America/Rankin_Inlet GMT-6:00') selected @endif>America/Rankin_Inlet GMT-6:00</option>
								<option value="America/Regina GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'America/Regina GMT-6:00') selected @endif>America/Regina GMT-6:00</option>
								<option value="America/Swift_Current GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'America/Swift_Current GMT-6:00') selected @endif>America/Swift_Current GMT-6:00</option>
								<option value="America/Tegucigalpa GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'America/Tegucigalpa GMT-6:00') selected @endif>America/Tegucigalpa GMT-6:00</option>
								<option value="America/Winnipeg GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'America/Winnipeg GMT-6:00') selected @endif>America/Winnipeg GMT-6:00</option>
								<option value="Canada/Central GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'Canada/Central GMT-6:00') selected @endif>Canada/Central GMT-6:00</option>
								<option value="Canada/East-Saskatchewan GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'Canada/East-Saskatchewan GMT-6:00') selected @endif>Canada/East-Saskatchewan GMT-6:00</option>
								<option value="Canada/Saskatchewan GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'Canada/Saskatchewan GMT-6:00') selected @endif>Canada/Saskatchewan GMT-6:00</option>
								<option value="Chile/EasterIsland GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'Chile/EasterIsland GMT-6:00') selected @endif>Chile/EasterIsland GMT-6:00</option>
								<option value="CST GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'CST GMT-6:00') selected @endif>CST GMT-6:00</option>
								<option value="CST6CDT GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'CST6CDT GMT-6:00') selected @endif>CST6CDT GMT-6:00</option>
								<option value="Etc/GMT+6 GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'Etc/GMT+6 GMT-6:00') selected @endif>Etc/GMT+6 GMT-6:00</option>
								<option value="Mexico/General GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'Mexico/General GMT-6:00') selected @endif>Mexico/General GMT-6:00</option>
								<option value="Pacific/Easter GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'Pacific/Easter GMT-6:00') selected @endif>Pacific/Easter GMT-6:00</option>
								<option value="Pacific/Galapagos GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'Pacific/Galapagos GMT-6:00') selected @endif>Pacific/Galapagos GMT-6:00</option>
								<option value="SystemV/CST6 GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'SystemV/CST6 GMT-6:00') selected @endif>SystemV/CST6 GMT-6:00</option>
								<option value="SystemV/CST6CDT GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'SystemV/CST6CDT GMT-6:00') selected @endif>SystemV/CST6CDT GMT-6:00</option>
								<option value="US/Central GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'US/Central GMT-6:00') selected @endif>US/Central GMT-6:00</option>
								<option value="US/Indiana-Starke GMT-6:00" @if($General_Payment_Gateway->default_time_zone == 'US/Indiana-Starke GMT-6:00') selected @endif>US/Indiana-Starke GMT-6:00</option>
								<option value="America/Boise GMT-7:00" @if($General_Payment_Gateway->default_time_zone == 'America/Boise GMT-7:00') selected @endif>America/Boise GMT-7:00</option>
								<option value="America/Cambridge_Bay GMT-7:00" @if($General_Payment_Gateway->default_time_zone == 'America/Cambridge_Bay GMT-7:00') selected @endif>America/Cambridge_Bay GMT-7:00</option>
								<option value="America/Chihuahua GMT-7:00" @if($General_Payment_Gateway->default_time_zone == 'America/Chihuahua GMT-7:00') selected @endif>America/Chihuahua GMT-7:00</option>
								<option value="America/Dawson_Creek GMT-7:00" @if($General_Payment_Gateway->default_time_zone == 'America/Dawson_Creek GMT-7:00') selected @endif>America/Dawson_Creek GMT-7:00</option>
								<option value="America/Denver GMT-7:00" @if($General_Payment_Gateway->default_time_zone == 'America/Denver GMT-7:00') selected @endif>America/Denver GMT-7:00</option>
								<option value="America/Edmonton GMT-7:00" @if($General_Payment_Gateway->default_time_zone == 'America/Edmonton GMT-7:00') selected @endif>America/Edmonton GMT-7:00</option>
								<option value="America/Hermosillo GMT-7:00" @if($General_Payment_Gateway->default_time_zone == 'America/Hermosillo GMT-7:00') selected @endif>America/Hermosillo GMT-7:00</option>
								<option value="America/Inuvik GMT-7:00" @if($General_Payment_Gateway->default_time_zone == 'America/Inuvik GMT-7:00') selected @endif>America/Inuvik GMT-7:00</option>
								<option value="America/Mazatlan GMT-7:00" @if($General_Payment_Gateway->default_time_zone == 'America/Mazatlan GMT-7:00') selected @endif>America/Mazatlan GMT-7:00</option>
								<option value="America/Phoenix GMT-7:00" @if($General_Payment_Gateway->default_time_zone == 'America/Phoenix GMT-7:00') selected @endif>America/Phoenix GMT-7:00</option>
								<option value="America/Shiprock GMT-7:00" @if($General_Payment_Gateway->default_time_zone == 'America/Shiprock GMT-7:00') selected @endif>America/Shiprock GMT-7:00</option>
								<option value="America/Yellowknife GMT-7:00" @if($General_Payment_Gateway->default_time_zone == 'America/Yellowknife GMT-7:00') selected @endif>America/Yellowknife GMT-7:00</option>
								<option value="Canada/Mountain GMT-7:00" @if($General_Payment_Gateway->default_time_zone == 'Canada/Mountain GMT-7:00') selected @endif>Canada/Mountain GMT-7:00</option>
								<option value="Etc/GMT+7 GMT-7:00" @if($General_Payment_Gateway->default_time_zone == 'Etc/GMT+7 GMT-7:00') selected @endif>Etc/GMT+7 GMT-7:00</option>
								<option value="Mexico/BajaSur GMT-7:00" @if($General_Payment_Gateway->default_time_zone == 'Mexico/BajaSur GMT-7:00') selected @endif>Mexico/BajaSur GMT-7:00</option>
								<option value="MST GMT-7:00" @if($General_Payment_Gateway->default_time_zone == 'MST GMT-7:00') selected @endif>MST GMT-7:00</option>
								<option value="MST7MDT GMT-7:00" @if($General_Payment_Gateway->default_time_zone == 'MST7MDT GMT-7:00') selected @endif>MST7MDT GMT-7:00</option>
								<option value="Navajo GMT-7:00" @if($General_Payment_Gateway->default_time_zone == 'Navajo GMT-7:00') selected @endif>Navajo GMT-7:00</option>
								<option value="PNT GMT-7:00" @if($General_Payment_Gateway->default_time_zone == 'PNT GMT-7:00') selected @endif>PNT GMT-7:00</option>
								<option value="SystemV/MST7 GMT-7:00" @if($General_Payment_Gateway->default_time_zone == 'SystemV/MST7 GMT-7:00') selected @endif>SystemV/MST7 GMT-7:00</option>
								<option value="SystemV/MST7MDT GMT-7:00" @if($General_Payment_Gateway->default_time_zone == 'SystemV/MST7MDT GMT-7:00') selected @endif>SystemV/MST7MDT GMT-7:00</option>
								<option value="US/Arizona GMT-7:00" @if($General_Payment_Gateway->default_time_zone == 'US/Arizona GMT-7:00') selected @endif>US/Arizona GMT-7:00</option>
								<option value="US/Mountain GMT-7:00" @if($General_Payment_Gateway->default_time_zone == 'US/Mountain GMT-7:00') selected @endif>US/Mountain GMT-7:00</option>
								<option value="America/Dawson GMT-8:00" @if($General_Payment_Gateway->default_time_zone == 'America/Dawson GMT-8:00') selected @endif>America/Dawson GMT-8:00</option>
								<option value="America/Ensenada GMT-8:00" @if($General_Payment_Gateway->default_time_zone == 'America/Ensenada GMT-8:00') selected @endif>America/Ensenada GMT-8:00</option>
								<option value="America/Los_Angeles GMT-8:00" @if($General_Payment_Gateway->default_time_zone == 'America/Los_Angeles GMT-8:00') selected @endif>America/Los_Angeles GMT-8:00</option>
								<option value="America/Tijuana GMT-8:00" @if($General_Payment_Gateway->default_time_zone == 'America/Tijuana GMT-8:00') selected @endif>America/Tijuana GMT-8:00</option>
								<option value="America/Vancouver GMT-8:00" @if($General_Payment_Gateway->default_time_zone == 'America/Vancouver GMT-8:00') selected @endif>America/Vancouver GMT-8:00</option>
								<option value="America/Whitehorse GMT-8:00" @if($General_Payment_Gateway->default_time_zone == 'America/Whitehorse GMT-8:00') selected @endif>America/Whitehorse GMT-8:00</option>
								<option value="Canada/Pacific GMT-8:00" @if($General_Payment_Gateway->default_time_zone == 'Canada/Pacific GMT-8:00') selected @endif>Canada/Pacific GMT-8:00</option>
								<option value="Canada/Yukon GMT-8:00" @if($General_Payment_Gateway->default_time_zone == 'Canada/Yukon GMT-8:00') selected @endif>Canada/Yukon GMT-8:00</option>
								<option value="Etc/GMT+8 GMT-8:00" @if($General_Payment_Gateway->default_time_zone == 'Etc/GMT+8 GMT-8:00') selected @endif>Etc/GMT+8 GMT-8:00</option>
								<option value="Mexico/BajaNorte GMT-8:00" @if($General_Payment_Gateway->default_time_zone == 'Mexico/BajaNorte GMT-8:00') selected @endif>Mexico/BajaNorte GMT-8:00</option>
								<option value="Pacific/Pitcairn GMT-8:00" @if($General_Payment_Gateway->default_time_zone == 'Pacific/Pitcairn GMT-8:00') selected @endif>Pacific/Pitcairn GMT-8:00</option>
								<option value="PST GMT-8:00" @if($General_Payment_Gateway->default_time_zone == 'PST GMT-8:00') selected @endif>PST GMT-8:00</option>
								<option value="PST8PDT GMT-8:00" @if($General_Payment_Gateway->default_time_zone == 'PST8PDT GMT-8:00') selected @endif>PST8PDT GMT-8:00</option>
								<option value="SystemV/PST8 GMT-8:00" @if($General_Payment_Gateway->default_time_zone == 'SystemV/PST8 GMT-8:00') selected @endif>SystemV/PST8 GMT-8:00</option>
								<option value="SystemV/PST8PDT GMT-8:00" @if($General_Payment_Gateway->default_time_zone == 'SystemV/PST8PDT GMT-8:00') selected @endif>SystemV/PST8PDT GMT-8:00</option>
								<option value="US/Pacific GMT-8:00" @if($General_Payment_Gateway->default_time_zone == 'US/Pacific GMT-8:00') selected @endif>US/Pacific GMT-8:00</option>
								<option value="US/Pacific-New GMT-8:00" @if($General_Payment_Gateway->default_time_zone == 'US/Pacific-New GMT-8:00') selected @endif>US/Pacific-New GMT-8:00</option>
								<option value="America/Anchorage GMT-9:00" @if($General_Payment_Gateway->default_time_zone == 'America/Anchorage GMT-9:00') selected @endif>America/Anchorage GMT-9:00</option>
								<option value="America/Juneau GMT-9:00" @if($General_Payment_Gateway->default_time_zone == 'America/Juneau GMT-9:00') selected @endif>America/Juneau GMT-9:00</option>
								<option value="America/Nome GMT-9:00" @if($General_Payment_Gateway->default_time_zone == 'America/Nome GMT-9:00') selected @endif>America/Nome GMT-9:00</option>
								<option value="America/Yakutat GMT-9:00" @if($General_Payment_Gateway->default_time_zone == 'America/Yakutat GMT-9:00') selected @endif>America/Yakutat GMT-9:00</option>
								<option value="AST GMT-9:00" @if($General_Payment_Gateway->default_time_zone == 'AST GMT-9:00') selected @endif>AST GMT-9:00</option>
								<option value="Etc/GMT+9 GMT-9:00" @if($General_Payment_Gateway->default_time_zone == 'Etc/GMT+9 GMT-9:00') selected @endif>Etc/GMT+9 GMT-9:00</option>
								<option value="Pacific/Gambier GMT-9:00" @if($General_Payment_Gateway->default_time_zone == 'Pacific/Gambier GMT-9:00') selected @endif>Pacific/Gambier GMT-9:00</option>
								<option value="SystemV/YST9 GMT-9:00" @if($General_Payment_Gateway->default_time_zone == 'SystemV/YST9 GMT-9:00') selected @endif>SystemV/YST9 GMT-9:00</option>
								<option value="SystemV/YST9YDT GMT-9:00" @if($General_Payment_Gateway->default_time_zone == 'SystemV/YST9YDT GMT-9:00') selected @endif>SystemV/YST9YDT GMT-9:00</option>
								<option value="US/Alaska GMT-9:00" @if($General_Payment_Gateway->default_time_zone == 'US/Alaska GMT-9:00') selected @endif>US/Alaska GMT-9:00</option>
								<option value="Pacific/Marquesas GMT-9:30" @if($General_Payment_Gateway->default_time_zone == 'Pacific/Marquesas GMT-9:30') selected @endif>Pacific/Marquesas GMT-9:30</option>
								<option value="Africa/Abidjan GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Africa/Abidjan GMT+00:00') selected @endif>Africa/Abidjan GMT+00:00</option>
								<option value="Africa/Accra GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Africa/Accra GMT+00:00') selected @endif>Africa/Accra GMT+00:00</option>
								<option value="Africa/Bamako GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Africa/Bamako GMT+00:00') selected @endif>Africa/Bamako GMT+00:00</option>
								<option value="Africa/Banjul GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Africa/Banjul GMT+00:00') selected @endif>Africa/Banjul GMT+00:00</option>
								<option value="Africa/Bissau GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Africa/Bissau GMT+00:00') selected @endif>Africa/Bissau GMT+00:00</option>
								<option value="Africa/Casablanca GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Africa/Casablanca GMT+00:00') selected @endif>Africa/Casablanca GMT+00:00</option>
								<option value="Africa/Conakry GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Africa/Conakry GMT+00:00') selected @endif>Africa/Conakry GMT+00:00</option>
								<option value="Africa/Dakar GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Africa/Dakar GMT+00:00') selected @endif>Africa/Dakar GMT+00:00</option>
								<option value="Africa/El_Aaiun GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Africa/El_Aaiun GMT+00:00') selected @endif>Africa/El_Aaiun GMT+00:00</option>
								<option value="Africa/Freetown GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Africa/Freetown GMT+00:00') selected @endif>Africa/Freetown GMT+00:00</option>
								<option value="Africa/Lome GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Africa/Lome GMT+00:00') selected @endif>Africa/Lome GMT+00:00</option>
								<option value="Africa/Monrovia GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Africa/Monrovia GMT+00:00') selected @endif>Africa/Monrovia GMT+00:00</option>
								<option value="Africa/Nouakchott GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Africa/Nouakchott GMT+00:00') selected @endif>Africa/Nouakchott GMT+00:00</option>
								<option value="Africa/Ouagadougou GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Africa/Ouagadougou GMT+00:00') selected @endif>Africa/Ouagadougou GMT+00:00</option>
								<option value="Africa/Sao_Tome GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Africa/Sao_Tome GMT+00:00') selected @endif>Africa/Sao_Tome GMT+00:00</option>
								<option value="Africa/Timbuktu GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Africa/Timbuktu GMT+00:00') selected @endif>Africa/Timbuktu GMT+00:00</option>
								<option value="America/Danmarkshavn GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'America/Danmarkshavn GMT+00:00') selected @endif>America/Danmarkshavn GMT+00:00</option>
								<option value="Atlantic/Canary GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Atlantic/Canary GMT+00:00') selected @endif>Atlantic/Canary GMT+00:00</option>
								<option value="Atlantic/Faeroe GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Atlantic/Faeroe GMT+00:00') selected @endif>Atlantic/Faeroe GMT+00:00</option>
								<option value="Atlantic/Faroe GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Atlantic/Faroe GMT+00:00') selected @endif>Atlantic/Faroe GMT+00:00</option>
								<option value="Atlantic/Madeira GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Atlantic/Madeira GMT+00:00') selected @endif>Atlantic/Madeira GMT+00:00</option>
								<option value="Atlantic/Reykjavik GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Atlantic/Reykjavik GMT+00:00') selected @endif>Atlantic/Reykjavik GMT+00:00</option>
								<option value="Atlantic/St_Helena GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Atlantic/St_Helena GMT+00:00') selected @endif>Atlantic/St_Helena GMT+00:00</option>
								<option value="Eire GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Eire GMT+00:00') selected @endif>Eire GMT+00:00</option>
								<option value="Etc/GMT GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Etc/GMT GMT+00:00') selected @endif>Etc/GMT GMT+00:00</option>
								<option value="Etc/GMT-0 GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Etc/GMT-0 GMT+00:00') selected @endif>Etc/GMT-0 GMT+00:00</option>
								<option value="Etc/GMT+0 GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Etc/GMT+0 GMT+00:00') selected @endif>Etc/GMT+0 GMT+00:00</option>
								<option value="Etc/GMT0 GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Etc/GMT0 GMT+00:00') selected @endif>Etc/GMT0 GMT+00:00</option>
								<option value="Etc/Greenwich GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Etc/Greenwich GMT+00:00') selected @endif>Etc/Greenwich GMT+00:00</option>
								<option value="Etc/UCT GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Etc/UCT GMT+00:00') selected @endif>Etc/UCT GMT+00:00</option>
								<option value="Etc/Universal GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Etc/Universal GMT+00:00') selected @endif>Etc/Universal GMT+00:00</option>
								<option value="Etc/UTC GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Etc/UTC GMT+00:00') selected @endif>Etc/UTC GMT+00:00</option>
								<option value="Etc/Zulu GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Etc/Zulu GMT+00:00') selected @endif>Etc/Zulu GMT+00:00</option>
								<option value="Europe/Belfast GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Europe/Belfast GMT+00:00') selected @endif>Europe/Belfast GMT+00:00</option>
								<option value="Europe/Dublin GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Europe/Dublin GMT+00:00') selected @endif>Europe/Dublin GMT+00:00</option>
								<option value="Europe/Guernsey GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Europe/Guernsey GMT+00:00') selected @endif>Europe/Guernsey GMT+00:00</option>
								<option value="Europe/Isle_of_Man GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Europe/Isle_of_Man GMT+00:00') selected @endif>Europe/Isle_of_Man GMT+00:00</option>
								<option value="Europe/Jersey GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Europe/Jersey GMT+00:00') selected @endif>Europe/Jersey GMT+00:00</option>
								<option value="Europe/Lisbon GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Europe/Lisbon GMT+00:00') selected @endif>Europe/Lisbon GMT+00:00</option>
								<option value="Europe/London GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Europe/London GMT+00:00') selected @endif>Europe/London GMT+00:00</option>
								<option value="GB GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'GB GMT+00:00') selected @endif>GB GMT+00:00</option>
								<option value="GB-Eire GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'GB-Eire GMT+00:00') selected @endif>GB-Eire GMT+00:00</option>
								<option value="GMT GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'GMT GMT+00:00') selected @endif>GMT GMT+00:00</option>
								<option value="GMT0 GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'GMT0 GMT+00:00') selected @endif>GMT0 GMT+00:00</option>
								<option value="Greenwich GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Greenwich GMT+00:00') selected @endif>Greenwich GMT+00:00</option>
								<option value="Iceland GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Iceland GMT+00:00') selected @endif>Iceland GMT+00:00</option>
								<option value="Portugal GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Portugal GMT+00:00') selected @endif>Portugal GMT+00:00</option>
								<option value="UCT GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'UCT GMT+00:00') selected @endif>UCT GMT+00:00</option>
								<option value="Universal GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'Universal GMT+00:00') selected @endif>Universal GMT+00:00</option>
								<option value="UTC GMT+00:00" @if($General_Payment_Gateway->default_time_zone == 'UTC GMT+00:00') selected @endif>UTC GMT+00:00</option>
                           </select>
                        </div>
                        <div class="col-md-4">
                            <p>Currency<font color="red">*</font></p>
                            <select name="default_currency" id="default_currency" class="form-control" required>
                                 <option value="1" @if($General_Payment_Gateway->default_currency == '1') selected @endif>Albania (Leke) (ALL)</option>
<option value="2" @if($General_Payment_Gateway->default_currency == '2') selected @endif>America (Dollars) (USD)</option>
<option value="3" @if($General_Payment_Gateway->default_currency == '3') selected @endif>Afghanistan (Afghanis) (AFN)</option>
<option value="4" @if($General_Payment_Gateway->default_currency == '4') selected @endif>Argentina (Pesos) (ARS)</option>
<option value="5" @if($General_Payment_Gateway->default_currency == '5') selected @endif>Aruba (Guilders) (AWG)</option>
<option value="6" @if($General_Payment_Gateway->default_currency == '6') selected @endif>Australia (Dollars) (AUD)</option>
<option value="7" @if($General_Payment_Gateway->default_currency == '7') selected @endif>Azerbaijan (New Manats) (AZN)</option>
<option value="8" @if($General_Payment_Gateway->default_currency == '8') selected @endif>Bahamas (Dollars) (BSD)</option>
<option value="9" @if($General_Payment_Gateway->default_currency == '9') selected @endif>Barbados (Dollars) (BBD)</option>
<option value="10" @if($General_Payment_Gateway->default_currency == '10') selected @endif>Belarus (Rubles) (BYR)</option>
<option value="11" @if($General_Payment_Gateway->default_currency == '11') selected @endif>Belgium (Euro) (EUR)</option>
<option value="12" @if($General_Payment_Gateway->default_currency == '12') selected @endif>Beliz (Dollars) (BZD)</option>
<option value="13" @if($General_Payment_Gateway->default_currency == '13') selected @endif>Bermuda (Dollars) (BMD)</option>
<option value="14" @if($General_Payment_Gateway->default_currency == '14') selected @endif>Bolivia (Bolivianos) (BOB)</option>
<option value="15" @if($General_Payment_Gateway->default_currency == '15') selected @endif>Bosnia and Herzegovina (Convertible Marka) (BAM)</option>
<option value="16" @if($General_Payment_Gateway->default_currency == '16') selected @endif>Botswana (Pula) (BWP)</option>
<option value="17" @if($General_Payment_Gateway->default_currency == '17') selected @endif>Bulgaria (Leva) (BGN)</option>
<option value="18" @if($General_Payment_Gateway->default_currency == '18') selected @endif>Brazil (Reais) (BRL)</option>
<option value="19" @if($General_Payment_Gateway->default_currency == '19') selected @endif>Britain (United Kingdom) (Pounds) (GBP)</option>
<option value="20" @if($General_Payment_Gateway->default_currency == '20') selected @endif>Brunei Darussalam (Dollars) (BND)</option>
<option value="21" @if($General_Payment_Gateway->default_currency == '21') selected @endif>Cambodia (Riels) (KHR)</option>
<option value="22" @if($General_Payment_Gateway->default_currency == '22') selected @endif>Canada (Dollars) (CAD)</option>
<option value="23" @if($General_Payment_Gateway->default_currency == '23') selected @endif>Cayman Islands (Dollars) (KYD)</option>
<option value="24" @if($General_Payment_Gateway->default_currency == '24') selected @endif>Chile (Pesos) (CLP)</option>
<option value="25" @if($General_Payment_Gateway->default_currency == '25') selected @endif>China (Yuan Renminbi) (CNY)</option>
<option value="26" @if($General_Payment_Gateway->default_currency == '26') selected @endif>Colombia (Pesos) (COP)</option>
<option value="27" @if($General_Payment_Gateway->default_currency == '27') selected @endif>Costa Rica (Colón) (CRC)</option>
<option value="28" @if($General_Payment_Gateway->default_currency == '28') selected @endif>Croatia (Kuna) (HRK)</option>
<option value="29" @if($General_Payment_Gateway->default_currency == '29') selected @endif>Cuba (Pesos) (CUP)</option>
<option value="30" @if($General_Payment_Gateway->default_currency == '30') selected @endif>Cyprus (Euro) (EUR)</option>
<option value="31" @if($General_Payment_Gateway->default_currency == '31') selected @endif>Czech Republic (Koruny) (CZK)</option>
<option value="32" @if($General_Payment_Gateway->default_currency == '32') selected @endif>Denmark (Kroner) (DKK)</option>
<option value="33" @if($General_Payment_Gateway->default_currency == '33') selected @endif>Dominican Republic (Pesos) (DOP)</option>
<option value="34" @if($General_Payment_Gateway->default_currency == '34') selected @endif>East Caribbean (Dollars) (XCD)</option>
<option value="35" @if($General_Payment_Gateway->default_currency == '35') selected @endif>Egypt (Pounds) (EGP)</option>
<option value="36" @if($General_Payment_Gateway->default_currency == '36') selected @endif>El Salvador (Colones) (SVC)</option>
<option value="37" @if($General_Payment_Gateway->default_currency == '37') selected @endif>England (United Kingdom) (Pounds) (GBP)</option>
<option value="38" @if($General_Payment_Gateway->default_currency == '38') selected @endif>Euro (Euro) (EUR)</option>
<option value="39" @if($General_Payment_Gateway->default_currency == '39') selected @endif>Falkland Islands (Pounds) (FKP)</option>
<option value="40" @if($General_Payment_Gateway->default_currency == '40') selected @endif>Fiji (Dollars) (FJD)</option>
<option value="41" @if($General_Payment_Gateway->default_currency == '41') selected @endif>France (Euro) (EUR)</option>
<option value="42" @if($General_Payment_Gateway->default_currency == '42') selected @endif>Ghana (Cedis) (GHC)</option>
<option value="43" @if($General_Payment_Gateway->default_currency == '43') selected @endif>Gibraltar (Pounds) (GIP)</option>
<option value="44" @if($General_Payment_Gateway->default_currency == '44') selected @endif>Greece (Euro) (EUR)</option>
<option value="45" @if($General_Payment_Gateway->default_currency == '45') selected @endif>Guatemala (Quetzales) (GTQ)</option>
<option value="46" @if($General_Payment_Gateway->default_currency == '46') selected @endif>Guernsey (Pounds) (GGP)</option>
<option value="47" @if($General_Payment_Gateway->default_currency == '47') selected @endif>Guyana (Dollars) (GYD)</option>
<option value="48" @if($General_Payment_Gateway->default_currency == '48') selected @endif>Holland (Netherlands) (Euro) (EUR)</option>
<option value="49" @if($General_Payment_Gateway->default_currency == '49') selected @endif>Honduras (Lempiras) (HNL)</option>
<option value="50" @if($General_Payment_Gateway->default_currency == '50') selected @endif>Hong Kong (Dollars) (HKD)</option>
<option value="51" @if($General_Payment_Gateway->default_currency == '51') selected @endif>Hungary (Forint) (HUF)</option>
<option value="52" @if($General_Payment_Gateway->default_currency == '52') selected @endif>Iceland (Kronur) (ISK)</option>
<option value="53" @if($General_Payment_Gateway->default_currency == '53') selected @endif>India (Rupees) (INR)</option>
<option value="54" @if($General_Payment_Gateway->default_currency == '54') selected @endif>Indonesia (Rupiahs) (IDR)</option>
<option value="55" @if($General_Payment_Gateway->default_currency == '55') selected @endif>Iran (Rials) (IRR)</option>
<option value="56" @if($General_Payment_Gateway->default_currency == '56') selected @endif>Ireland (Euro) (EUR)</option>
<option value="57" @if($General_Payment_Gateway->default_currency == '57') selected @endif>Isle of Man (Pounds) (IMP)</option>
<option value="58" @if($General_Payment_Gateway->default_currency == '58') selected @endif>Israel (New Shekels) (ILS)</option>
<option value="59" @if($General_Payment_Gateway->default_currency == '59') selected @endif>Italy (Euro) (EUR)</option>
<option value="60" @if($General_Payment_Gateway->default_currency == '60') selected @endif>Jamaica (Dollars) (JMD)</option>
<option value="61" @if($General_Payment_Gateway->default_currency == '61') selected @endif>Japan (Yen) (JPY)</option>
<option value="62" @if($General_Payment_Gateway->default_currency == '62') selected @endif>Jersey (Pounds) (JEP)</option>
<option value="63" @if($General_Payment_Gateway->default_currency == '63') selected @endif>Kazakhstan (Tenge) (KZT)</option>
<option value="64" @if($General_Payment_Gateway->default_currency == '64') selected @endif>Korea (North) (Won) (KPW)</option>
<option value="65" @if($General_Payment_Gateway->default_currency == '65') selected @endif>Korea (South) (Won) (KRW)</option>
<option value="66" @if($General_Payment_Gateway->default_currency == '66') selected @endif>Kyrgyzstan (Soms) (KGS)</option>
<option value="67" @if($General_Payment_Gateway->default_currency == '67') selected @endif>Laos (Kips) (LAK)</option>
<option value="68" @if($General_Payment_Gateway->default_currency == '68') selected @endif>Latvia (Lati) (LVL)</option>
<option value="69" @if($General_Payment_Gateway->default_currency == '69') selected @endif>Lebanon (Pounds) (LBP)</option>
<option value="70" @if($General_Payment_Gateway->default_currency == '70') selected @endif>Liberia (Dollars) (LRD)</option>
<option value="71" @if($General_Payment_Gateway->default_currency == '71') selected @endif>Liechtenstein (Switzerland Francs) (CHF)</option>
<option value="72" @if($General_Payment_Gateway->default_currency == '72') selected @endif>Lithuania (Litai) (LTL)</option>
<option value="73" @if($General_Payment_Gateway->default_currency == '73') selected @endif>Luxembourg (Euro) (EUR)</option>
<option value="74" @if($General_Payment_Gateway->default_currency == '74') selected @endif>Macedonia (Denars) (MKD)</option>
<option value="75" @if($General_Payment_Gateway->default_currency == '75') selected @endif>Malaysia (Ringgits) (MYR)</option>
<option value="76" @if($General_Payment_Gateway->default_currency == '76') selected @endif>Malta (Euro) (EUR)</option>
<option value="77" @if($General_Payment_Gateway->default_currency == '77') selected @endif>Mauritius (Rupees) (MUR)</option>
<option value="78" @if($General_Payment_Gateway->default_currency == '78') selected @endif>Mexico (Pesos) (MXN)</option>
<option value="79" @if($General_Payment_Gateway->default_currency == '79') selected @endif>Mongolia (Tugriks) (MNT)</option>
<option value="80" @if($General_Payment_Gateway->default_currency == '80') selected @endif>Mozambique (Meticais) (MZN)</option>
<option value="81" @if($General_Payment_Gateway->default_currency == '81') selected @endif>Namibia (Dollars) (NAD)</option>
<option value="82" @if($General_Payment_Gateway->default_currency == '82') selected @endif>Nepal (Rupees) (NPR)</option>
<option value="83" @if($General_Payment_Gateway->default_currency == '83') selected @endif>Netherlands Antilles (Guilders) (ANG)</option>
<option value="84" @if($General_Payment_Gateway->default_currency == '84') selected @endif>Netherlands (Euro) (EUR)</option>
<option value="85" @if($General_Payment_Gateway->default_currency == '85') selected @endif>New Zealand (Dollars) (NZD)</option>
<option value="86" @if($General_Payment_Gateway->default_currency == '86') selected @endif>Nicaragua (Cordobas) (NIO)</option>
<option value="87" @if($General_Payment_Gateway->default_currency == '87') selected @endif>Nigeria (Nairas) (NGN)</option>
<option value="88" @if($General_Payment_Gateway->default_currency == '88') selected @endif>North Korea (Won) (KPW)</option>
<option value="89" @if($General_Payment_Gateway->default_currency == '89') selected @endif>Norway (Krone) (NOK)</option>
<option value="90" @if($General_Payment_Gateway->default_currency == '90') selected @endif>Oman (Rials) (OMR)</option>
<option value="91" @if($General_Payment_Gateway->default_currency == '91') selected @endif>Pakistan (Rupees) (PKR)</option>
<option value="92" @if($General_Payment_Gateway->default_currency == '92') selected @endif>Panama (Balboa) (PAB)</option>
<option value="93" @if($General_Payment_Gateway->default_currency == '93') selected @endif>Paraguay (Guarani) (PYG)</option>
<option value="94" @if($General_Payment_Gateway->default_currency == '94') selected @endif>Peru (Nuevos Soles) (PEN)</option>
<option value="95" @if($General_Payment_Gateway->default_currency == '95') selected @endif>Philippines (Pesos) (PHP)</option>
<option value="96" @if($General_Payment_Gateway->default_currency == '96') selected @endif>Poland (Zlotych) (PLN)</option>
<option value="97" @if($General_Payment_Gateway->default_currency == '97') selected @endif>Qatar (Rials) (QAR)</option>
<option value="98" @if($General_Payment_Gateway->default_currency == '98') selected @endif>Romania (New Lei) (RON)</option>
<option value="99" @if($General_Payment_Gateway->default_currency == '99') selected @endif>Russia (Rubles) (RUB)</option>
<option value="100" @if($General_Payment_Gateway->default_currency == '100') selected @endif>Saint Helena (Pounds) (SHP)</option>
<option value="101" @if($General_Payment_Gateway->default_currency == '101') selected @endif>Saudi Arabia (Riyals) (SAR)</option>
<option value="102" @if($General_Payment_Gateway->default_currency == '102') selected @endif>Serbia (Dinars) (RSD)</option>
<option value="103" @if($General_Payment_Gateway->default_currency == '103') selected @endif>Seychelles (Rupees) (SCR)</option>
<option value="104" @if($General_Payment_Gateway->default_currency == '104') selected @endif>Singapore (Dollars) (SGD)</option>
<option value="105" @if($General_Payment_Gateway->default_currency == '105') selected @endif>Slovenia (Euro) (EUR)</option>
<option value="106" @if($General_Payment_Gateway->default_currency == '106') selected @endif>Solomon Islands (Dollars) (SBD)</option>
<option value="107" @if($General_Payment_Gateway->default_currency == '107') selected @endif>Somalia (Shillings) (SOS)</option>
<option value="108" @if($General_Payment_Gateway->default_currency == '108') selected @endif>South Africa (Rand) (ZAR)</option>
<option value="109" @if($General_Payment_Gateway->default_currency == '109') selected @endif>South Korea (Won) (KRW)</option>
<option value="110" @if($General_Payment_Gateway->default_currency == '110') selected @endif>Spain (Euro) (EUR)</option>
<option value="111" @if($General_Payment_Gateway->default_currency == '111') selected @endif>Sri Lanka (Rupees) (LKR)</option>
<option value="112" @if($General_Payment_Gateway->default_currency == '112') selected @endif>Sweden (Kronor) (SEK)</option>
<option value="113" @if($General_Payment_Gateway->default_currency == '113') selected @endif>Switzerland (Francs) (CHF)</option>
<option value="114" @if($General_Payment_Gateway->default_currency == '114') selected @endif>Suriname (Dollars) (SRD)</option>
<option value="115" @if($General_Payment_Gateway->default_currency == '115') selected @endif>Syria (Pounds) (SYP)</option>
<option value="116" @if($General_Payment_Gateway->default_currency == '116') selected @endif>Taiwan (New Dollars) (TWD)</option>
<option value="117" @if($General_Payment_Gateway->default_currency == '117') selected @endif>Thailand (Baht) (THB)</option>
<option value="118" @if($General_Payment_Gateway->default_currency == '118') selected @endif>Trinidad and Tobago (Dollars) (TTD)</option>
<option value="119" @if($General_Payment_Gateway->default_currency == '119') selected @endif>Turkey (Lira) (TRY)</option>
<option value="120" @if($General_Payment_Gateway->default_currency == '120') selected @endif>Turkey (Liras) (TRL)</option>
<option value="121" @if($General_Payment_Gateway->default_currency == '121') selected @endif>Tuvalu (Dollars) (TVD)</option>
<option value="122" @if($General_Payment_Gateway->default_currency == '122') selected @endif>Ukraine (Hryvnia) (UAH)</option>
<option value="123" @if($General_Payment_Gateway->default_currency == '123') selected @endif>United Kingdom (Pounds) (GBP)</option>
<option value="124" @if($General_Payment_Gateway->default_currency == '124') selected @endif>United States of America (Dollars) (USD)</option>
<option value="125" @if($General_Payment_Gateway->default_currency == '125') selected @endif>Uruguay (Pesos) (UYU)</option>
<option value="127" @if($General_Payment_Gateway->default_currency == '127') selected @endif>Vatican City (Euro) (EUR)</option>
<option value="128" @if($General_Payment_Gateway->default_currency == '128') selected @endif>Venezuela (Bolivares Fuertes) (VEF)</option>
<option value="129" @if($General_Payment_Gateway->default_currency == '129') selected @endif>Vietnam (Dong) (VND)</option>
<option value="130" @if($General_Payment_Gateway->default_currency == '130') selected @endif>Yemen (Rials) (YER)</option>
<option value="131" @if($General_Payment_Gateway->default_currency == '131') selected @endif>Zimbabwe (Zimbabwe Dollars) (ZWD)</option>
<option value="132" @if($General_Payment_Gateway->default_currency == '132') selected @endif>Kenya (Kenyan Shilling) (KES)</option>
<option value="133" @if($General_Payment_Gateway->default_currency == '133') selected @endif>Ghana (Ghanaian Cedi) (GHS)</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <p>Site Global /Default Currency<font color="red">*</font></p>
                            <select name="site_global_currency" class="form-control" id="site_global_currency">
<option value="INR" @if($General_Payment_Gateway->site_global_currency == 'INR') selected @endif>INR(₹)</option>
<option value="USD" @if($General_Payment_Gateway->site_global_currency == 'USD') selected @endif>USD($)</option>
<option value="EUR" @if($General_Payment_Gateway->site_global_currency == 'EUR') selected @endif>EUR(€)</option>
<option value="IDR" @if($General_Payment_Gateway->site_global_currency == 'IDR') selected @endif>IDR(Rp)</option>
<option value="AUD" @if($General_Payment_Gateway->site_global_currency == 'AUD') selected @endif>AUD(A$)</option>
<option value="SGD" @if($General_Payment_Gateway->site_global_currency == 'SGD') selected @endif>SGD(S$)</option>
<option value="JPY" @if($General_Payment_Gateway->site_global_currency == 'JPY') selected @endif>JPY(¥)</option>
<option value="GBP" @if($General_Payment_Gateway->site_global_currency == 'GBP') selected @endif>GBP(£)</option>
<option value="MYR" @if($General_Payment_Gateway->site_global_currency == 'MYR') selected @endif>MYR(RM)</option>
<option value="PHP" @if($General_Payment_Gateway->site_global_currency == 'PHP') selected @endif>PHP(₱)</option>
<option value="THB" @if($General_Payment_Gateway->site_global_currency == 'THB') selected @endif>THB(฿)</option>
<option value="KRW" @if($General_Payment_Gateway->site_global_currency == 'KRW') selected @endif>KRW(₩)</option>
<option value="NGN" @if($General_Payment_Gateway->site_global_currency == 'NGN') selected @endif>NGN(₦)</option>
<option value="GHS" @if($General_Payment_Gateway->site_global_currency == 'GHS') selected @endif>GHS(GH₵)</option>
<option value="BRL" @if($General_Payment_Gateway->site_global_currency == 'BRL') selected @endif>BRL(R$)</option>
<option value="BIF" @if($General_Payment_Gateway->site_global_currency == 'BIF') selected @endif>BIF(FBu)</option>
<option value="CAD" @if($General_Payment_Gateway->site_global_currency == 'CAD') selected @endif>CAD(C$)</option>
<option value="CDF" @if($General_Payment_Gateway->site_global_currency == 'CDF') selected @endif>CDF(FC)</option>
<option value="CVE" @if($General_Payment_Gateway->site_global_currency == 'CVE') selected @endif>CVE(Esc)</option>
<option value="GHP" @if($General_Payment_Gateway->site_global_currency == 'GHP') selected @endif>GHP(GH₵)</option>
<option value="GMD" @if($General_Payment_Gateway->site_global_currency == 'GMD') selected @endif>GMD(D)</option>
<option value="GNF" @if($General_Payment_Gateway->site_global_currency == 'GNF') selected @endif>GNF(FG)</option>
<option value="KES" @if($General_Payment_Gateway->site_global_currency == 'KES') selected @endif>KES(Ksh)</option>
<option value="LRD" @if($General_Payment_Gateway->site_global_currency == 'LRD') selected @endif>LRD(L$)</option>
<option value="MWK" @if($General_Payment_Gateway->site_global_currency == 'MWK') selected @endif>MWK(MK)</option>
<option value="MZN" @if($General_Payment_Gateway->site_global_currency == 'MZN') selected @endif>MZN(MT)</option>
<option value="RWF" @if($General_Payment_Gateway->site_global_currency == 'RWF') selected @endif>RWF(R₣)</option>
<option value="SLL" @if($General_Payment_Gateway->site_global_currency == 'SLL') selected @endif>SLL(Le)</option>
<option value="STD" @if($General_Payment_Gateway->site_global_currency == 'STD') selected @endif>STD(Db)</option>
<option value="TZS" @if($General_Payment_Gateway->site_global_currency == 'TZS') selected @endif>TZS(TSh)</option>
<option value="UGX" @if($General_Payment_Gateway->site_global_currency == 'UGX') selected @endif>UGX(USh)</option>
<option value="XAF" @if($General_Payment_Gateway->site_global_currency == 'XAF') selected @endif>XAF(FCFA)</option>
<option value="XOF" @if($General_Payment_Gateway->site_global_currency == 'XOF') selected @endif>XOF(CFA)</option>
<option value="ZMK" @if($General_Payment_Gateway->site_global_currency == 'ZMK') selected @endif>ZMK(ZK)</option>
<option value="ZMW" @if($General_Payment_Gateway->site_global_currency == 'ZMW') selected @endif>ZMW(ZK)</option>
<option value="ZWD" @if($General_Payment_Gateway->site_global_currency == 'ZWD') selected @endif>ZWD(Z$)</option>
<option value="AED" @if($General_Payment_Gateway->site_global_currency == 'AED') selected @endif>AED(د.إ)</option>
<option value="AFN" @if($General_Payment_Gateway->site_global_currency == 'AFN') selected @endif>AFN(؋)</option>
<option value="ALL" @if($General_Payment_Gateway->site_global_currency == 'ALL') selected @endif>ALL(L)</option>
<option value="AMD" @if($General_Payment_Gateway->site_global_currency == 'AMD') selected @endif>AMD(֏)</option>
<option value="ANG" @if($General_Payment_Gateway->site_global_currency == 'ANG') selected @endif>ANG(NAf)</option>
<option value="AOA" @if($General_Payment_Gateway->site_global_currency == 'AOA') selected @endif>AOA(Kz)</option>
<option value="ARS" @if($General_Payment_Gateway->site_global_currency == 'ARS') selected @endif>ARS($)</option>
<option value="AWG" @if($General_Payment_Gateway->site_global_currency == 'AWG') selected @endif>AWG(ƒ)</option>
<option value="AZN" @if($General_Payment_Gateway->site_global_currency == 'AZN') selected @endif>AZN(₼)</option>
<option value="BAM" @if($General_Payment_Gateway->site_global_currency == 'BAM') selected @endif>BAM(KM)</option>
<option value="BBD" @if($General_Payment_Gateway->site_global_currency == 'BBD') selected @endif>BBD(Bds$)</option>
<option value="BDT" @if($General_Payment_Gateway->site_global_currency == 'BDT') selected @endif>BDT(৳)</option>
<option value="BGN" @if($General_Payment_Gateway->site_global_currency == 'BGN') selected @endif>BGN(лв)</option>
<option value="BMD" @if($General_Payment_Gateway->site_global_currency == 'BMD') selected @endif>BMD($)</option>
<option value="BND" @if($General_Payment_Gateway->site_global_currency == 'BND') selected @endif>BND(B$)</option>
<option value="BOB" @if($General_Payment_Gateway->site_global_currency == 'BOB') selected @endif>BOB(Bs)</option>
<option value="BSD" @if($General_Payment_Gateway->site_global_currency == 'BSD') selected @endif>BSD(B$)</option>
<option value="BWP" @if($General_Payment_Gateway->site_global_currency == 'BWP') selected @endif>BWP(P)</option>
<option value="BZD" @if($General_Payment_Gateway->site_global_currency == 'BZD') selected @endif>BZD($)</option>
<option value="CHF" @if($General_Payment_Gateway->site_global_currency == 'CHF') selected @endif>CHF(CHF)</option>
<option value="CNY" @if($General_Payment_Gateway->site_global_currency == 'CNY') selected @endif>CNY(¥)</option>
<option value="CLP" @if($General_Payment_Gateway->site_global_currency == 'CLP') selected @endif>CLP($)</option>
<option value="COP" @if($General_Payment_Gateway->site_global_currency == 'COP') selected @endif>COP($)</option>
<option value="CRC" @if($General_Payment_Gateway->site_global_currency == 'CRC') selected @endif>CRC(₡)</option>
<option value="CZK" @if($General_Payment_Gateway->site_global_currency == 'CZK') selected @endif>CZK(Kč)</option>
<option value="DJF" @if($General_Payment_Gateway->site_global_currency == 'DJF') selected @endif>DJF(Fdj)</option>
<option value="DKK" @if($General_Payment_Gateway->site_global_currency == 'DKK') selected @endif>DKK(Kr)</option>
<option value="DOP" @if($General_Payment_Gateway->site_global_currency == 'DOP') selected @endif>DOP(RD$)</option>
<option value="DZD" @if($General_Payment_Gateway->site_global_currency == 'DZD') selected @endif>DZD(دج)</option>
<option value="EGP" @if($General_Payment_Gateway->site_global_currency == 'EGP') selected @endif>EGP(E£)</option>
<option value="ETB" @if($General_Payment_Gateway->site_global_currency == 'ETB') selected @endif>ETB(ብር)</option>
<option value="FJD" @if($General_Payment_Gateway->site_global_currency == 'FJD') selected @endif>FJD(FJ$)</option>
<option value="FKP" @if($General_Payment_Gateway->site_global_currency == 'FKP') selected @endif>FKP(£)</option>
<option value="GEL" @if($General_Payment_Gateway->site_global_currency == 'GEL') selected @endif>GEL(₾)</option>
<option value="GIP" @if($General_Payment_Gateway->site_global_currency == 'GIP') selected @endif>GIP(£)</option>
<option value="GTQ" @if($General_Payment_Gateway->site_global_currency == 'GTQ') selected @endif>GTQ(Q)</option>
<option value="GYD" @if($General_Payment_Gateway->site_global_currency == 'GYD') selected @endif>GYD(G$)</option>
<option value="HKD" @if($General_Payment_Gateway->site_global_currency == 'HKD') selected @endif>HKD(HK$)</option>
<option value="HNL" @if($General_Payment_Gateway->site_global_currency == 'HNL') selected @endif>HNL(L)</option>
<option value="HRK" @if($General_Payment_Gateway->site_global_currency == 'HRK') selected @endif>HRK(kn)</option>
<option value="HTG" @if($General_Payment_Gateway->site_global_currency == 'HTG') selected @endif>HTG(G)</option>
<option value="HUF" @if($General_Payment_Gateway->site_global_currency == 'HUF') selected @endif>HUF(Ft)</option>
<option value="ILS" @if($General_Payment_Gateway->site_global_currency == 'ILS') selected @endif>ILS(₪)</option>
<option value="ISK" @if($General_Payment_Gateway->site_global_currency == 'ISK') selected @endif>ISK(kr)</option>
<option value="JMD" @if($General_Payment_Gateway->site_global_currency == 'JMD') selected @endif>JMD($)</option>
<option value="KGS" @if($General_Payment_Gateway->site_global_currency == 'KGS') selected @endif>KGS(с)</option>
<option value="KHR" @if($General_Payment_Gateway->site_global_currency == 'KHR') selected @endif>KHR(៛)</option>
<option value="KMF" @if($General_Payment_Gateway->site_global_currency == 'KMF') selected @endif>KMF(CF)</option>
<option value="KYD" @if($General_Payment_Gateway->site_global_currency == 'KYD') selected @endif>KYD($)</option>
<option value="KZT" @if($General_Payment_Gateway->site_global_currency == 'KZT') selected @endif>KZT(₸)</option>
<option value="LAK" @if($General_Payment_Gateway->site_global_currency == 'LAK') selected @endif>LAK(₭)</option>
<option value="LBP" @if($General_Payment_Gateway->site_global_currency == 'LBP') selected @endif>LBP(ل.ل.)</option>
<option value="LKR" @if($General_Payment_Gateway->site_global_currency == 'LKR') selected @endif>LKR(රු)</option>
<option value="LSL" @if($General_Payment_Gateway->site_global_currency == 'LSL') selected @endif>LSL(L)</option>
<option value="MAD" @if($General_Payment_Gateway->site_global_currency == 'MAD') selected @endif>MAD(MAD)</option>
<option value="MDL" @if($General_Payment_Gateway->site_global_currency == 'MDL') selected @endif>MDL(L)</option>
<option value="MGA" @if($General_Payment_Gateway->site_global_currency == 'MGA') selected @endif>MGA(Ar)</option>
<option value="MKD" @if($General_Payment_Gateway->site_global_currency == 'MKD') selected @endif>MKD(ден)</option>
<option value="MMK" @if($General_Payment_Gateway->site_global_currency == 'MMK') selected @endif>MMK(K)</option>
<option value="MNT" @if($General_Payment_Gateway->site_global_currency == 'MNT') selected @endif>MNT(₮)</option>
<option value="MOP" @if($General_Payment_Gateway->site_global_currency == 'MOP') selected @endif>MOP(MOP$)</option>
<option value="MRO" @if($General_Payment_Gateway->site_global_currency == 'MRO') selected @endif>MRO(MRU)</option>
<option value="MUR" @if($General_Payment_Gateway->site_global_currency == 'MUR') selected @endif>MUR(₨)</option>
<option value="MVR" @if($General_Payment_Gateway->site_global_currency == 'MVR') selected @endif>MVR(Rf)</option>
<option value="MXN" @if($General_Payment_Gateway->site_global_currency == 'MXN') selected @endif>MXN($)</option>
<option value="NAD" @if($General_Payment_Gateway->site_global_currency == 'NAD') selected @endif>NAD(N$)</option>
<option value="NIO" @if($General_Payment_Gateway->site_global_currency == 'NIO') selected @endif>NIO(C$)</option>
<option value="NOK" @if($General_Payment_Gateway->site_global_currency == 'NOK') selected @endif>NOK(kr)</option>
<option value="NPR" @if($General_Payment_Gateway->site_global_currency == 'NPR') selected @endif>NPR(रु)</option>
<option value="NZD" @if($General_Payment_Gateway->site_global_currency == 'NZD') selected @endif>NZD($)</option>
<option value="PAB" @if($General_Payment_Gateway->site_global_currency == 'PAB') selected @endif>PAB(B/.)</option>
<option value="PEN" @if($General_Payment_Gateway->site_global_currency == 'PEN') selected @endif>PEN(S/)</option>
<option value="PGK" @if($General_Payment_Gateway->site_global_currency == 'PGK') selected @endif>PGK(K)</option>
<option value="PKR" @if($General_Payment_Gateway->site_global_currency == 'PKR') selected @endif>PKR(₨)</option>
<option value="PLN" @if($General_Payment_Gateway->site_global_currency == 'PLN') selected @endif>PLN(zł)</option>
<option value="PYG" @if($General_Payment_Gateway->site_global_currency == 'PYG') selected @endif>PYG(₲)</option>
<option value="QAR" @if($General_Payment_Gateway->site_global_currency == 'QAR') selected @endif>QAR(QR)</option>
<option value="RON" @if($General_Payment_Gateway->site_global_currency == 'RON') selected @endif>RON(lei)</option>
<option value="RSD" @if($General_Payment_Gateway->site_global_currency == 'RSD') selected @endif>RSD(din)</option>
<option value="RUB" @if($General_Payment_Gateway->site_global_currency == 'RUB') selected @endif>RUB(₽)</option>
<option value="SAR" @if($General_Payment_Gateway->site_global_currency == 'SAR') selected @endif>SAR(SR)</option>
<option value="SBD" @if($General_Payment_Gateway->site_global_currency == 'SBD') selected @endif>SBD(Si$)</option>
<option value="SCR" @if($General_Payment_Gateway->site_global_currency == 'SCR') selected @endif>SCR(SR)</option>
<option value="SEK" @if($General_Payment_Gateway->site_global_currency == 'SEK') selected @endif>SEK(kr)</option>
<option value="SHP" @if($General_Payment_Gateway->site_global_currency == 'SHP') selected @endif>SHP(£)</option>
<option value="SOS" @if($General_Payment_Gateway->site_global_currency == 'SOS') selected @endif>SOS(Sh.so.)</option>
<option value="SRD" @if($General_Payment_Gateway->site_global_currency == 'SRD') selected @endif>SRD($)</option>
<option value="SZL" @if($General_Payment_Gateway->site_global_currency == 'SZL') selected @endif>SZL(E)</option>
<option value="TJS" @if($General_Payment_Gateway->site_global_currency == 'TJS') selected @endif>TJS(ЅМ)</option>
<option value="TRY" @if($General_Payment_Gateway->site_global_currency == 'TRY') selected @endif>TRY(₺)</option>
<option value="TTD" @if($General_Payment_Gateway->site_global_currency == 'TTD') selected @endif>TTD(TT$)</option>
<option value="TWD" @if($General_Payment_Gateway->site_global_currency == 'TWD') selected @endif>TWD(NT$)</option>
<option value="UAH" @if($General_Payment_Gateway->site_global_currency == 'UAH') selected @endif>UAH(₴)</option>
<option value="UYU" @if($General_Payment_Gateway->site_global_currency == 'UYU') selected @endif>UYU($U)</option>
<option value="UZS" @if($General_Payment_Gateway->site_global_currency == 'UZS') selected @endif>UZS(so'm)</option>
<option value="VND" @if($General_Payment_Gateway->site_global_currency == 'VND') selected @endif>VND(₫)</option>
<option value="VUV" @if($General_Payment_Gateway->site_global_currency == 'VUV') selected @endif>VUV(VT)</option>
<option value="WST" @if($General_Payment_Gateway->site_global_currency == 'WST') selected @endif>WST(WS$)</option>
<option value="XCD" @if($General_Payment_Gateway->site_global_currency == 'XCD') selected @endif>XCD($)</option>
<option value="XPF" @if($General_Payment_Gateway->site_global_currency == 'XPF') selected @endif>XPF(₣)</option>
<option value="YER" @if($General_Payment_Gateway->site_global_currency == 'YER') selected @endif>YER(﷼)</option>
<option value="ZAR" @if($General_Payment_Gateway->site_global_currency == 'ZAR') selected @endif>ZAR(R)</option>
<option value="BHD" @if($General_Payment_Gateway->site_global_currency == 'BHD') selected @endif>BHD(BHD)</option>
<option value="KWD" @if($General_Payment_Gateway->site_global_currency == 'KWD') selected @endif>KWD(د.ك)</option>                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <p>Currency Symbol Position</p>
                            <select class="form-control" name="site_currency_symbol_position" id="site_currency_symbol_position">
                                <option value="left"selected >Left</option>
                                <option value="right">Right</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <p>INR to USD Exchange Rate<font color="red">*</font></p>
                            <input type="text" class="form-control" name="site_inr_to_usd_exchange_rate" id="site_inr_to_usd_exchange_rate" value="{{$General_Payment_Gateway->site_inr_to_usd_exchange_rate}}">
                            <span class="info-text">enter INR to USD exchange rate. eg: 1 INR = ? USD</span>
                        </div>
                        <div class="col-md-4">
                            <p>INR to IDR Exchange Rate<font color="red">*</font></p>
                            <input type="text" class="form-control" name="site_inr_to_idr_exchange_rate" id="site_inr_to_idr_exchange_rate" value="{{$General_Payment_Gateway->site_inr_to_idr_exchange_rate}}">
                            <span class="info-text">enter INR to USD exchange rate. eg: 1 INR = ? IDR</span>
                        </div>
                    </div>
                    <div class="row">                            
                        <div class="col-md-4">
                            <p>INR to ZAR Exchange Rate<font color="red">*</font></p>
                            <input type="text" class="form-control" name="site_inr_to_zar_exchange_rate" value="{{$General_Payment_Gateway->site_inr_to_zar_exchange_rate}}">
                            <span class="info-text">enter INR to USD exchange rate. eg: 1 INR = ? ZAR</span>
                        </div>
                        <div class="col-md-4">
                            <p>INR to BRL Exchange Rate<font color="red">*</font></p>
                            <input type="text" class="form-control" name="site_inr_to_brl_exchange_rate" value="{{$General_Payment_Gateway->site_inr_to_brl_exchange_rate}}">
                            <span class="info-text">enter INR to BRL exchange rate. eg: 1INR = ? BRL</span>
                        </div>
                        <div class="col-md-4">
                            <p>INR to MYR Exchange Rate<font color="red">*</font></p>
                            <input type="text" class="form-control" name="site_inr_to_myr_exchange_rate" value="{{$General_Payment_Gateway->site_inr_to_myr_exchange_rate}}">
                            <span class="info-text">enter INR to MYR exchange rate. eg: 1INR = ? MYR</span>
                        </div>
                        @if(isset($General_Payment_Gateway))
                       <input type="hidden" name="action" value="update" />
                        @else
                        
                         <input type="hidden" name="action" value="save" />
                        >
                        @endif
                        <div class="col-md-6">
                                     @if(isset($General_Payment_Gateway))
                                      <button class="btn btn-info btn-cons" type="submit" name="action" value="update" ><i class="fa fa-credit-card"></i> Update General Payment Settings</button>
                                     @else
                                      <button class="btn btn-info btn-cons" type="submit" name="action" value="save" ><i class="fa fa-credit-card"></i> Add General Payment Settings</button>
                                     @endif
                                   
                                    <button class="btn btn-warning btn-cons cancel-btn" type="reset" id="clear-btn"><i class="fa fa-eraser"></i> Clear</button>
                                 </div>
                    </div>
                    
                    <!-- Paypal Starts Here -->
                    </form>
                    <form method="POST" action="{{route('settings.payment_gateway.create_international_payment_gateway')}}" enctype="multipart/form-data">
                        @csrf
                    <div class="grid-title">
                        <h3><i class="fa fa-users"></i><span class="semi-bold"> Paypal Settings</span></h3>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <p>Enable Paypal?<font color="red">*</font></p>
                            <select class="form-control" name="paypal_gateway" id="paypal_gateway">
                                <option value="Yes" @if($Payment_Gateway->paypal_gateway == 'Yes') selected @endif >Yes</option>
                                <option value="No" @if($Payment_Gateway->paypal_gateway == 'No') selected @endif>No</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <p>Enable Mode (Test/Live)<font color="red">*</font></p>
                            <select class="form-control" name="paypal_mode" id="paypal_gateway">
                                <option value="sandbox" @if($Payment_Gateway->paypal_mode == 'sandbox') selected @endif >Test Mode</option>
                                <option value="Live" @if($Payment_Gateway->paypal_mode == 'live') selected @endif>Live Modeo</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="paypal_sandbox_client_id">Paypal Sandbox Client ID</label>
                            <input type="text" name="paypal_sandbox_client_id" class="form-control" value="{{$Payment_Gateway->paypal_sandbox_client_id ?? ''}}">
                        </div>
                        <div class="col-md-3">
                            <label for="paypal_sandbox_client_secret">Paypal Sandbox Client Secret</label>
                            <input type="text" name="paypal_sandbox_client_secret" class="form-control" value="{{$Payment_Gateway->paypal_sandbox_client_secret ?? ''}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="paypal_sandbox_app_id">Paypal Sandbox App ID</label>
                            <input type="text" class="form-control" name="paypal_sandbox_app_id" id="paypal_sandbox_app_id" value="{{$Payment_Gateway->paypal_sandbox_app_id ?? ''}}">
                        </div>
                        <div class="col-md-3">
                            <label for="paypal_live_client_id">Paypal Live Client ID</label>
                            <input type="text" class="form-control" name="paypal_live_client_id" id="paypal_live_client_id" value="{{$Payment_Gateway->paypal_live_client_id ?? ''}}">
                        </div>
                        <div class="col-md-3">
                            <label for="paypal_live_client_secret">Paypal Live Client Secret</label>
                            <input type="text" class="form-control" name="paypal_live_client_secret" id="paypal_live_client_secret" value="{{$Payment_Gateway->paypal_live_client_secret ?? ''}}">
                        </div>
                        <div class="col-md-3">
                            <label for="paypal_live_app_id">Paypal Live App ID</label>
                            <input type="text" class="form-control" name="paypal_live_app_id" id="paypal_live_app_id" value="{{$Payment_Gateway->paypal_live_app_id ?? ''}}">
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col-md-3">
                            <p>Paypal Logo<font color="red">*</font></p>
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap">
                                    <div class="attachment-preview" style="width: 136px;">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{ str_replace("../../", request()->getSchemeAndHttpHost().'/', $Payment_Gateway->paypal_preview_logo) ?? 'https://srisrisha.org/myDonation/assets/uploads/no-image.png'}}" alt="" style="width: 128px;height: 70px;" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="paypal_preview_logo_hidden" id="paypal_preview_logo" value="{{$Payment_Gateway->paypal_preview_logo ?? ''}}">
                                <!--<button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">-->
                                <!--    Change Paypal Logo-->
                                <!--</button>-->
                                <input type="file" name="paypal_preview_logo" id="paypal_logo_input" accept="image/jpeg,image/png" onchange="previewImage(event)">
                            </div>
                            <small class="form-text text-muted">Allowed image formats: jpg/peg/png.Recommended Logo 160x50</small>
                        </div>       
                    </div>
                    <!-- Paypal End Here -->
                    <!-- Razorpay Starts Here -->
                    <div class="grid-title">
                        <h3><i class="fa fa-users"></i><span class="semi-bold"> Razorpay Settings</span></h3>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <p>Enable Razorpay?<font color="red">*</font></p>
                            <select class="form-control" name="razorpay_gateway" id="razorpay_gateway">
                                <option value="Yes" @if($Payment_Gateway->razorpay_gateway == 'Yes') selected @endif >Yes</option>
                                <option value="No" @if($Payment_Gateway->razorpay_gateway == 'No') selected @endif>No</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <p>Enable Mode (Test/Live)<font color="red">*</font></p>
                            <select class="form-control" name="razorpay_mode" id="razorpay_mode">
                                <option value="Test" @if($Payment_Gateway->razorpay_mode == 'Test') selected @endif >Test Mode</option>
                                <option value="Live" @if($Payment_Gateway->razorpay_mode == 'Live') selected @endif>Live Modeo</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="razorpay_api_key">Razorpay API Key</label>
                            <input type="text" class="form-control" name="razorpay_api_key" id="razorpay_api_key" value="{{$Payment_Gateway->razorpay_api_key ?? ''}}">
                        </div>
                        <div class="col-md-3">
                            <label for="razorpay_api_secret">Razorpay API Secret</label>
                            <input type="text" class="form-control" name="razorpay_api_secret" id="razorpay_api_secret" value="{{$Payment_Gateway->razorpay_api_secret ?? ''}}">
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col-md-3">
                            <p>Razorpay Logo<font color="red">*</font></p>
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap">
                                    <div class="attachment-preview" style="width: 136px;" >
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{ str_replace("../../", request()->getSchemeAndHttpHost().'/', $Payment_Gateway->razorpay_preview_logo) ?? 'https://srisrisha.org/myDonation/assets/uploads/no-image.png'}}" alt="" style="width: 128px;height: 70px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="razorpay_preview_logo_hidden" id="razorpay_preview_logo" value="{{$Payment_Gateway->razorpay_preview_logo ?? ''}}">
                                <input type="file" name="razorpay_preview_logo" id="razorpay_logo_input" accept="image/jpeg,image/png" onchange="previewImage(event)">
                                <!--<button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">-->
                                <!--    Change Razorpay Logo-->
                                <!--</button>-->
                            </div>
                            <small class="form-text text-muted">Allowed image formats: jpg/peg/png.Recommended Logo 160x50</small>
                        </div>       
                    </div>       
                    <!-- Razorpay Ends Here -->
                    <!-- Instamojo Starts Here -->
                    <div class="grid-title">
                        <h3><i class="fa fa-users"></i><span class="semi-bold"> Instamojo Settings</span></h3>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <p>Enable Instamojo?<font color="red">*</font></p>
                            <select class="form-control" name="instamojo_gateway" id="instamojo_gateway">
                                <option value="Yes" @if($Payment_Gateway->instamojo_gateway == 'Yes') selected @endif  >Yes</option>
                                <option value="No" @if($Payment_Gateway->instamojo_gateway == 'No') selected @endif>No</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <p>Enable Mode (Test/Live)<font color="red">*</font></p>
                            <select class="form-control" name="instamojo_mode" id="instamojo_mode">
                                <option value="Test"  @if($Payment_Gateway->instamojo_mode == 'Test') selected @endif>Test Mode</option>
                                <option value="Live" @if($Payment_Gateway->instamojo_mode == 'Live') selected @endif>Live Modeo</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="instamojo_client_id">Instamojo Client ID</label>
                            <input type="text" class="form-control" name="instamojo_client_id" id="instamojo_client_id" value="{{$Payment_Gateway->instamojo_client_id ?? ''}}">
                        </div>
                        <div class="col-md-3">
                            <label for="instamojo_client_secret">Instamojo Client Secret</label>
                            <input type="text" class="form-control" name="instamojo_client_secret" id="instamojo_client_secret" value="{{$Payment_Gateway->instamojo_client_secret ?? ''}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="instamojo_username">Instamojo Username</label>
                            <input type="text" class="form-control" name="instamojo_username" id="instamojo_username" value="{{$Payment_Gateway->instamojo_username ?? ''}}">
                        </div>
                        <div class="col-md-3">
                            <label for="instamojo_password">Instamojo Password</label>
                            <input type="text" class="form-control" name="instamojo_password" id="instamojo_password" value="{{$Payment_Gateway->instamojo_password ?? ''}}">
                        </div>                        
                        <div class="col-md-3">
                            <p>Instamojo Logo<font color="red">*</font></p>
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap">
                                    <div class="attachment-preview" style="width: 136px;" >
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{ str_replace("../../", request()->getSchemeAndHttpHost().'/', $Payment_Gateway->instamojo_preview_logo) ?? 'https://srisrisha.org/myDonation/assets/uploads/no-image.png'}}" alt="" style="width: 128px;height: 70px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="instamojo_preview_logo_hidden" id="instamojo_preview_logo" value="{{$Payment_Gateway->instamojo_preview_logo ?? ''}}">
                                <!--<button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">-->
                                <!--    Change Instamojo Logo-->
                                <!--</button>-->
                                
                                <input type="file" name="instamojo_preview_logo" id="instamojo_logo_input" accept="image/jpeg,image/png" onchange="previewImage(event)">
                            </div>
                            <small class="form-text text-muted">Allowed image formats: jpg/peg/png.Recommended Logo 160x50</small>
                        </div>       
                    </div>                    
                    <!-- Instamojo Ends Here -->   
                    <!-- Stripe Starts Here -->
                    <div class="grid-title">
                        <h3><i class="fa fa-users"></i><span class="semi-bold"> Stripe Settings</span></h3>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <p>Enable Stripe?<font color="red">*</font></p>
                            <select class="form-control" name="stripe_gateway" id="stripe_gateway">
                                <option value="Yes" @if($Payment_Gateway->stripe_gateway == 'Yes') selected @endif >Yes</option>
                                <option value="No" @if($Payment_Gateway->stripe_gateway == 'Yes') selected @endif>No</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <p>Enable Mode (Test/Live)<font color="red">*</font></p>
                            <select class="form-control" name="stripe_mode" id="stripe_mode">
                                <option value="Test" @if($Payment_Gateway->stripe_mode == 'Test') selected @endif >Test Mode</option>
                                <option value="Live" @if($Payment_Gateway->stripe_gateway == 'Live') selected @endif>Live Modeo</option>
                            </select>
                        </div>
                      <div class="col-md-3">
                            <label for="stripe_public_key">Stripe Public Key</label>
                            <input type="text" class="form-control" name="stripe_public_key" id="stripe_public_key" value="{{$Payment_Gateway->stripe_public_key ?? ''}}">
                        </div>
                        <div class="col-md-3">
                            <p>Stripe Logo<font color="red">*</font></p>
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap">
                                    <div class="attachment-preview" style="width: 136px;" >
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{ str_replace("../../", request()->getSchemeAndHttpHost().'/', $Payment_Gateway->stripe_preview_logo) ?? 'https://srisrisha.org/myDonation/assets/uploads/no-image.png'}}" alt="" style="width: 128px;height: 70px;" id="stripe_logo_preview">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="stripe_preview_logo_hidden" id="stripe_preview_logo" value="{{$Payment_Gateway->stripe_preview_logo ?? ''}}">
                                <input type="file" name="stripe_preview_logo" id="stripe_logo_input" accept="image/jpeg,image/png" onchange="previewImage(event)">
                                <small class="form-text text-muted">Allowed image formats: jpg/jpeg/png. Recommended Logo 160x50</small>
                            </div>
                        </div>      
                    </div>                    
                    <!-- Stripe Ends Here -->
                    <!-- Mollie Starts Here -->
                    <div class="grid-title">
                        <h3><i class="fa fa-users"></i><span class="semi-bold"> Mollie Settings</span></h3>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <p>Enable Mollie?<font color="red">*</font></p>
                            <select class="form-control" name="mollie_gateway" id="mollie_gateway">
                                <option value="Yes"@if($Payment_Gateway->mollie_gateway == 'Yes') selected @endif >Yes</option>
                                <option value="No" @if($Payment_Gateway->mollie_gateway == 'No') selected @endif>No</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <p>Enable Mode (Test/Live)<font color="red">*</font></p>
                            <select class="form-control" name="mollie_mode" id="mollie_mode">
                                <option value="Test" @if($Payment_Gateway->mollie_mode == 'Test') selected @endif >Test Mode</option>
                                <option value="Live" @if($Payment_Gateway->mollie_mode == 'Live') selected @endif>Live Modeo</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="mollie_public_key">Mollie Public Key</label>
                            <input type="text" class="form-control" name="mollie_public_key" id="mollie_public_key" value="{{$Payment_Gateway->mollie_public_key ?? ''}}">
                        </div>
                        <div class="col-md-3">
                            <p>Mollie Logo<font color="red">*</font></p>
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap">
                                    <div class="attachment-preview" style="width: 136px;" >
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{ str_replace("../../", request()->getSchemeAndHttpHost().'/', $Payment_Gateway->mollie_preview_logo) ?? 'https://srisrisha.org/myDonation/assets/uploads/no-image.png'}}" alt="" style="width: 128px;height: 70px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="mollie_preview_logo_hidden" id="mollie_preview_logo" value="{{$Payment_Gateway->mollie_preview_logo ?? ''}}">
                                <input type="file" name="mollie_preview_logo" id="mollie_logo_input" accept="image/jpeg,image/png" onchange="previewImage(event)">
                                <!--<button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">-->
                                <!--    Change Mollie Logo-->
                                <!--</button>-->
                            </div>
                            <small class="form-text text-muted">Allowed image formats: jpg/peg/png.Recommended Logo 160x50</small>
                        </div>       
                    </div>                    
                    <!-- Mollie Ends Here -->
                    <!-- Flw Starts Here -->
                    <div class="grid-title">
                        <h3><i class="fa fa-users"></i><span class="semi-bold"> FLW Settings</span></h3>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <p>Enable FLW?<font color="red">*</font></p>
                            <select class="form-control" name="flw_gateway" id="flw_gateway">
                                <option value="Yes" @if($Payment_Gateway->razorpay_mode == 'Yes') selected @endif >Yes</option>
                                <option value="No" @if($Payment_Gateway->razorpay_mode == 'No') selected @endif>No</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <p>Enable Mode (Test/Live)<font color="red">*</font></p>
                            <select class="form-control" name="flw_mode" id="flw_mode">
                                <option value="Test" @if($Payment_Gateway->flw_mode == 'Test') selected @endif >Test Mode</option>
                                <option value="Live" @if($Payment_Gateway->flw_mode == 'Live') selected @endif>Live Modeo</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="flw_public_key">FLW Public Key</label>
                            <input type="text" class="form-control" name="flw_public_key" id="flw_public_key" value="{{$Payment_Gateway->flw_public_key ?? ''}}">
                        </div>
                        <div class="col-md-3">
                            <label for="flw_secret_key">FLW Secret Key</label>
                            <input type="text" class="form-control" name="flw_secret_key" id="flw_secret_key" value="{{$Payment_Gateway->flw_secret_key ?? ''}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="flw_secret_hash">FLW Secret Key</label>
                            <input type="text" class="form-control" name="flw_secret_hash" id="flw_secret_hash" value="{{$Payment_Gateway->flw_secret_hash ?? ''}}">
                        </div>
                        <div class="col-md-3">
                            <p>FLW Logo<font color="red">*</font></p>
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap">
                                    <div class="attachment-preview" style="width: 136px;" >
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{ str_replace("../../", request()->getSchemeAndHttpHost().'/', $Payment_Gateway->flw_preview_logo) ?? 'https://srisrisha.org/myDonation/assets/uploads/no-image.png'}}" alt="" style="width: 128px;height: 70px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="flw_preview_logo_hidden" id="flw_preview_logo" value="{{$Payment_Gateway->flw_preview_logo ?? ''}}">
                                <input type="file" name="flw_preview_logo" id="flw_logo_input" accept="image/jpeg,image/png" onchange="previewImage(event)">
                                <!--<button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">-->
                                <!--    Change FLW Logo-->
                                <!--</button>-->
                            </div>
                            <small class="form-text text-muted">Allowed image formats: jpg/peg/png.Recommended Logo 160x50</small>
                        </div>       
                    </div>                    
                    <!-- Flw Ends Here -->
                    <!-- Authorizenet Starts Here -->
                    <div class="grid-title">
                        <h3><i class="fa fa-users"></i><span class="semi-bold"> Authorizenet Settings</span></h3>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <p>Enable Authorizenet?<font color="red">*</font></p>
                            <select class="form-control" name="authorizenet_gateway" id="authorizenet_gateway">
                                <option value="Yes" @if($Payment_Gateway->authorizenet_gateway == 'Yes') selected @endif >Yes</option>
                                <option value="No" @if($Payment_Gateway->authorizenet_gateway == 'No') selected @endif>No</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <p>Enable Mode (Test/Live)<font color="red">*</font></p>
                            <select class="form-control" name="authorizenet_mode" id="authorizenet_mode">
                                <option value="Test" @if($Payment_Gateway->authorizenet_mode == 'Test') selected @endif >Test Mode</option>
                                <option value="Live" @if($Payment_Gateway->authorizenet_mode == 'Line') selected @endif>Live Modeo</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="authorizenet_merchant_login_id">Authorizenet Merchant Login ID</label>
                            <input type="text" class="form-control" name="authorizenet_merchant_login_id" id="authorizenet_merchant_login_id" value="{{$Payment_Gateway->authorizenet_merchant_login_id ?? ''}}">
                        </div>
                        <div class="col-md-3">
                            <label for="authorizenet_merchant_transaction_id">Authorizenet Merchant Transaction ID</label>
                            <input type="text" class="form-control" name="authorizenet_merchant_transaction_id" id="authorizenet_merchant_transaction_id" value="{{$Payment_Gateway->authorizenet_merchant_transaction_id ?? ''}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <p>Authorizenet Logo<font color="red">*</font></p>
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap">
                                    <div class="attachment-preview" style="width: 136px;" >
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{ str_replace("../../", request()->getSchemeAndHttpHost().'/', $Payment_Gateway->authorizenet_preview_logo) ?? 'https://srisrisha.org/myDonation/assets/uploads/no-image.png'}}" alt="" style="width: 128px;height: 70px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="authorizenet_preview_logo_hidden" id="authorizenet_preview_logo" value="{{$Payment_Gateway->authorizenet_preview_logo ?? ''}}">
                                <!--<button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">-->
                                <!--    Change Authorizenet Logo-->
                                <!--</button>-->
                                <input type="file" name="authorizenet_preview_logo" id="authorizenet_logo_input" accept="image/jpeg,image/png" onchange="previewImage(event)">
                            </div>
                            <small class="form-text text-muted">Allowed image formats: jpg/peg/png.Recommended Logo 160x50</small>
                        </div>       
                    </div>                    
                    <!-- Authorizenet Ends Here -->   
                    <!-- Midtrans Gateway Starts Here -->
                    <div class="grid-title">
                        <h3><i class="fa fa-users"></i><span class="semi-bold">Midtrans Settings</span></h3>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <p>Enable Midtrans?<font color="red">*</font></p>
                            <select class="form-control" name="midtrans_gateway" id="midtrans_gateway">
                                <option value="Yes" @if($Payment_Gateway->midtrans_gateway == 'Yes') selected @endif>Yes</option>
                                <option value="No" @if($Payment_Gateway->midtrans_gateway == 'No') selected @endif>No</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <p>Enable Mode (Test/Live)<font color="red">*</font></p>
                            <select class="form-control" name="midtrans_mode" id="midtrans_mode">
                                <option value="Test" @if($Payment_Gateway->midtrans_mode == 'Test') selected @endif >Test Mode</option>
                                <option value="Live" @if($Payment_Gateway->midtrans_mode == 'Live') selected @endif>Live Modeo</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="midtrans_merchant_id">Midtrans Merchant ID</label>
                            <input type="text" class="form-control" name="midtrans_merchant_id" id="midtrans_merchant_id" value="{{$Payment_Gateway->midtrans_merchant_id ?? ''}}">
                        </div>
                        <div class="col-md-3">
                            <label for="midtrans_server_key">Midtrans Server Key</label>
                            <input type="text" class="form-control" name="midtrans_server_key" id="midtrans_server_key" value="{{$Payment_Gateway->midtrans_server_key ?? ''}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="midtrans_client_key">Midtrans Client Key</label>
                            <input type="text" class="form-control" name="midtrans_client_key" id="midtrans_client_key" value="{{$Payment_Gateway->midtrans_client_key ?? ''}}">
                        </div>
                        <div class="col-md-3">
                            <label for="midtrans_environment">Midtrans Environment</label>
                            <input type="text" class="form-control" name="midtrans_environment" id="midtrans_environment" value="{{$Payment_Gateway->midtrans_environment  ?? ''}}">
                        </div>                        
                        <div class="col-md-3">
                            <p>Midtrans Logo<font color="red">*</font></p>
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap">
                                    <div class="attachment-preview" style="width: 136px;" >
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{ str_replace("../../", request()->getSchemeAndHttpHost().'/', $Payment_Gateway->midtrans_preview_logo) ?? 'https://srisrisha.org/myDonation/assets/uploads/no-image.png'}}" alt="" style="width: 128px;height: 70px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="midtrans_preview_logo_hidden" id="midtrans_preview_logo" value="{{$Payment_Gateway->midtrans_preview_logo ?? ''}}">
                                <!--<button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">-->
                                <!--    Change Midtrans Logo-->
                                <!--</button>-->
                                <input type="file" name="midtrans_preview_logo" id="midtrans_logo_input" accept="image/jpeg,image/png" onchange="previewImage(event)">
                            </div>
                            <small class="form-text text-muted">Allowed image formats: jpg/peg/png.Recommended Logo 160x50</small>
                        </div>       
                    </div>                    
                    <!-- Midtrans Ends Here -->
                    <!-- Payfast Starts Here -->
                    <div class="grid-title">
                        <h3><i class="fa fa-users"></i><span class="semi-bold"> Payfast Settings</span></h3>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <p>Enable Payfast?<font color="red">*</font></p>
                            <select class="form-control" name="payfast_gateway" id="payfast_gateway">
                                <option value="Yes" @if($Payment_Gateway->payfast_gateway == 'Yes') selected @endif>Yes</option>
                                <option value="No" @if($Payment_Gateway->payfast_gateway == 'No') selected @endif>No</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <p>Enable Mode (Test/Live)<font color="red">*</font></p>
                            <select class="form-control" name="payfast_mode" id="payfast_mode">
                                <option value="Test" @if($Payment_Gateway->payfast_mode == 'Test') selected @endif >Test Mode</option>
                                <option value="Live" @if($Payment_Gateway->payfast_mode == 'Live') selected @endif>Live Modeo</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="payfast_merchant_env">Payfast Merchant ENV Key</label>
                            <input type="text" class="form-control" name="payfast_merchant_env" id="payfast_merchant_env" value="{{$Payment_Gateway->payfast_merchant_env ?? ''}}">
                        </div>
                        <div class="col-md-3">
                            <label for="payfast_itn_url">Payfast ITN URL</label>
                            <input type="text" class="form-control" name="payfast_itn_url" id="payfast_itn_url" value="{{$Payment_Gateway->payfast_itn_url ?? ''}}">
                        </div>                        
                        <div class="col-md-3">
                            <p>Payfast Logo<font color="red">*</font></p>
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap">
                                    <div class="attachment-preview" style="width: 136px;" >
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{ str_replace("../../", request()->getSchemeAndHttpHost().'/', $Payment_Gateway->payfast_preview_logo) ?? 'https://srisrisha.org/myDonation/assets/uploads/no-image.png'}}" alt="" style="width: 128px;height: 70px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="payfast_preview_logo_hidden" id="payfast_preview_logo" value="{{$Payment_Gateway->payfast_preview_logo ?? ''}}">
                                <!--<button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">-->
                                <!--    Change Payfast Logo-->
                                <!--</button>-->
                                <input type="file" name="payfast_preview_logo" id="payfast_logo_input" accept="image/jpeg,image/png" onchange="previewImage(event)">
                            </div>
                            <small class="form-text text-muted">Allowed image formats: jpg/peg/png.Recommended Logo 160x50</small>
                        </div>       
                    </div>                    
                    <!-- Payfast Ends Here -->
                    <!-- Cashfree Starts Here -->
                    <div class="grid-title">
                        <h3><i class="fa fa-users"></i><span class="semi-bold"> Cashfree Settings</span></h3>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <p>Enable Cashfree?<font color="red">*</font></p>
                            <select class="form-control" name="cashfree_gateway" id="cashfree_gateway">
                                <option value="Yes" @if($Payment_Gateway->cashfree_gateway == 'Yes') selected @endif >Yes</option>
                                <option value="No" @if($Payment_Gateway->cashfree_gateway == 'No') selected @endif>No</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <p>Enable Mode (Test/Live)<font color="red">*</font></p>
                            <select class="form-control" name="cashfree_mode" id="cashfree_mode">
                                <option value="Test" @if($Payment_Gateway->cashfree_mode == 'Test') selected @endif >Test Mode</option>
                                <option value="Live" @if($Payment_Gateway->cashfree_mode == 'Live') selected @endif>Live Modeo</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="cashfree_app_id">Cashfree APP ID</label>
                            <input type="text" class="form-control" name="cashfree_app_id" id="cashfree_app_id" value="{{$Payment_Gateway->cashfree_app_id ?? ''}}">
                        </div>
                        <div class="col-md-3">
                            <label for="cashfree_secret_key">Cashfree Secret Key</label>
                                <input type="text" class="form-control" name="cashfree_secret_key" id="cashfree_secret_key" value="{{$Payment_Gateway->cashfree_secret_key ?? ''}}">
                        </div>                        
                        <div class="col-md-3">
                            <p>Cashfree Logo<font color="red">*</font></p>
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap">
                                    <div class="attachment-preview" style="width: 136px;" >
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{ str_replace("../../", request()->getSchemeAndHttpHost().'/', $Payment_Gateway->cashfree_preview_logo) ?? 'https://srisrisha.org/myDonation/assets/uploads/no-image.png'}}" alt="" style="width: 128px;height: 70px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="cashfree_preview_logo_hidden" id="cashfree_preview_logo" value="{{$Payment_Gateway->cashfree_preview_logo ?? ''}}">
                                <!--<button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">-->
                                <!--    Change Cashfree Logo-->
                                <!--</button>-->
                                <input type="file" name="cashfree_preview_logo" id="cashfree_logo_input" accept="image/jpeg,image/png" onchange="previewImage(event)">
                            </div>
                            <small class="form-text text-muted">Allowed image formats: jpg/peg/png.Recommended Logo 160x50</small>
                        </div>       
                    </div>                    
                    <!-- Cashfree Ends Here -->
                    <!-- Marcadopago Starts Here -->
                    <div class="grid-title">
                        <h3><i class="fa fa-users"></i><span class="semi-bold"> Marcadopago Settings</span></h3>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <p>Enable Marcadopago?<font color="red">*</font></p>
                            <select class="form-control" name="marcado_pago_gateway" id="marcado_pago_gateway">
                                <option value="Yes" @if($Payment_Gateway->marcado_pago_gateway == 'Yes') selected @endif>Yes</option>
                                <option value="No" @if($Payment_Gateway->marcado_pago_gateway == 'No') selected @endif>No</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <p>Enable Mode (Test/Live)<font color="red">*</font></p>
                            <select class="form-control" name="marcado_pago_mode" id="marcado_pago_mode">
                                <option value="Test" @if($Payment_Gateway->marcado_pago_mode == 'Test') selected @endif >Test Mode</option>
                                <option value="Live" @if($Payment_Gateway->marcado_pago_mode == 'Live') selected @endif>Live Modeo</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="marcado_pago_client_id">Marcadopago Client ID</label>
                            <input type="text" class="form-control" name="marcado_pago_client_id" id="marcado_pago_client_id" value="{{$Payment_Gateway->marcado_pago_client_id ?? ''}}">
                        </div>
                        <div class="col-md-3">
                            <label for="marcado_pago_client_secret">Marcadopago Client Secret Key</label>
                            <input type="text" class="form-control" name="marcado_pago_client_secret" id="marcado_pago_client_secret" value="{{$Payment_Gateway->marcado_pago_client_secret ?? ''}}">
                        </div>                        
                        <div class="col-md-3">
                            <p>Marcadopago Logo<font color="red">*</font></p>
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap">
                                    <div class="attachment-preview" style="width: 136px;" >
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{ str_replace("../../",request()->getSchemeAndHttpHost().'/',$Payment_Gateway->marcadopago_preview_logo) ?? 'https://srisrisha.org/myDonation/assets/uploads/no-image.png'}}" alt="" style="width: 128px;height: 70px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="marcadopago_preview_logo_hidden" id="marcadopago_preview_logo" value="{{$Payment_Gateway->marcadopago_preview_logo ?? ''}}">
                                <!--<button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">-->
                                <!--    Change Marcadopago Logo-->
                                <!--</button>-->
                                <input type="file" name="marcadopago_preview_logo" id="marcadopago_logo_input" accept="image/jpeg,image/png" onchange="previewImage(event)">
                            </div>
                            <small class="form-text text-muted">Allowed image formats: jpg/peg/png.Recommended Logo 160x50</small>
                        </div>       
                    </div>                    
                    <!-- Marcadopago Ends Here -->
                    <!-- Squareup Starts Here -->
                    <div class="grid-title">
                        <h3><i class="fa fa-users"></i><span class="semi-bold"> Squareup Settings</span></h3>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <p>Enable Squareup?<font color="red">*</font></p>
                            <select class="form-control" name="squareup_gateway" id="squareup_gateway">
                                <option value="Yes" @if($Payment_Gateway->squareup_gateway == 'Yes') selected @endif>Yes</option>
                                <option value="No" @if($Payment_Gateway->squareup_gateway == 'No') selected @endif>No</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <p>Enable Mode (Test/Live)<font color="red">*</font></p>
                                <select class="form-control" name="squareup_mode" id="squareup_mode">
                                    <option value="Test" @if($Payment_Gateway->squareup_mode == 'Test') selected @endif >Test Mode</option>
                                    <option value="Live" @if($Payment_Gateway->squareup_mode == 'Live') selected @endif>Live Modeo</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="squareup_access_token">Squareup Access Token</label>
                            <input type="text" class="form-control" name="squareup_access_token" id="squareup_access_token" value="{{$Payment_Gateway->squareup_access_token ?? ''}}">
                        </div>
                        <div class="col-md-3">
                            <label for="squareup_location_id">Squareup Location ID</label>
                            <input type="text" class="form-control" name="squareup_location_id" id="squareup_location_id" value="{{$Payment_Gateway->squareup_location_id ?? ''}}">
                        </div>                        
                        <div class="col-md-3">
                            <p>Squareup Logo<font color="red">*</font></p>
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap">
                                    <div class="attachment-preview" style="width: 136px;" >
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{ str_replace("../../", request()->getSchemeAndHttpHost().'/', $Payment_Gateway->squareup_preview_logo) ?? 'https://srisrisha.org/myDonation/assets/uploads/no-image.png'}}" alt="" style="width: 128px;height: 70px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="squareup_preview_logo_hidden" id="squareup_preview_logo" value="{{$Payment_Gateway->squareup_preview_logo ?? ''}}">
                                <!--<button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">-->
                                <!--    Change Squareup Logo-->
                                <!--</button>-->
                                <input type="file" name="squareup_preview_logo" id="squareup_logo_input" accept="image/jpeg,image/png" onchange="previewImage(event)">
                            </div>
                            <small class="form-text text-muted">Allowed image formats: jpg/peg/png.Recommended Logo 160x50</small>
                        </div>       
                    </div>                    
                    <!-- Squreup Ends Here -->
                    <!-- Flutterwave Starts Here -->
                    <div class="grid-title">
                        <h3><i class="fa fa-users"></i><span class="semi-bold"> Flutterwave Settings</span></h3>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <p>Enable Flutterwave?<font color="red">*</font></p>
                            <select class="form-control" name="flutterwave_gateway" id="flutterwave_gateway">
                                <option value="Yes" @if($Payment_Gateway->flutterwave_gateway == 'Yes') selected @endif>Yes</option>
                                <option value="No" @if($Payment_Gateway->flutterwave_gateway == 'No') selected @endif>No</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <p>Enable Mode (Test/Live)<font color="red">*</font></p>
                            <select class="form-control" name="flutterwave_mode" id="flutterwave_mode">
                                <option value="Test" @if($Payment_Gateway->flutterwave_mode == 'Test') selected @endif >Test Mode</option>
                                <option value="Live" @if($Payment_Gateway->flutterwave_mode == 'Live') selected @endif>Live Modeo</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="flutterwave_client_id">Flutterwave Client ID</label>
                            <input type="text" class="form-control" name="flutterwave_client_id" id="flutterwave_client_id" value="{{$Payment_Gateway->flutterwave_client_id ?? ''}}">
                        </div>
                        <div class="col-md-3">
                            <label for="flutterwave_client_secret">Flutterwave Secret Key</label>
                            <input type="text" class="form-control" name="flutterwave_client_secret" id="flutterwave_client_secret" value="{{$Payment_Gateway->flutterwave_client_secret ?? ''}}">
                        </div>                        
                        <div class="col-md-3">
                            <p>Flutterwave Logo<font color="red">*</font></p>
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap">
                                    <div class="attachment-preview" style="width: 136px;" >
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{ str_replace("../../", request()->getSchemeAndHttpHost().'/', $Payment_Gateway->flutterwave_preview_logo) ?? 'https://srisrisha.org/myDonation/assets/uploads/no-image.png'}}" alt="" style="width: 128px;height: 70px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="flutterwave_preview_logo_hidden" id="flutterwave_preview_logo" value="{{$Payment_Gateway->flutterwave_preview_logo ?? ''}}">
                                <!--<button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">-->
                                <!--    Change Flutterwave Logo-->
                                <!--</button>-->
                                <input type="file" name="flutterwave_preview_logo" id="flutterwave_logo_input" accept="image/jpeg,image/png" onchange="previewImage(event)">
                            </div>
                            <small class="form-text text-muted">Allowed image formats: jpg/peg/png.Recommended Logo 160x50</small>
                        </div>       
                    </div>                    
                    <!-- Flutterwave Ends Here -->   
                    <!-- Paystack Starts Here -->
                    <div class="grid-title">
                        <h3><i class="fa fa-users"></i><span class="semi-bold"> Paystack Settings</span></h3>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <p>Enable Paystack?<font color="red">*</font></p>
                            <select class="form-control" name="paystack_gateway" id="paystack_gateway">
                                <option value="Yes" @if($Payment_Gateway->paystack_gateway == 'Yes') selected @endif>Yes</option>
                                <option value="No" @if($Payment_Gateway->paystack_gateway == 'No') selected @endif>No</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <p>Enable Mode (Test/Live)<font color="red">*</font></p>
                            <select class="form-control" name="paystack_mode" id="paystack_mode">
                                <option value="Test" @if($Payment_Gateway->paystack_mode == 'Test') selected @endif >Test Mode</option>
                                <option value="Live" @if($Payment_Gateway->paystack_mode == 'Live') selected @endif>Live Modeo</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="flutterwave_client_id">Playstack Client ID</label>
                            <input type="text" class="form-control" name="paystack_client_id" id="paystack_client_id" value="{{$Payment_Gateway->paystack_client_id ?? ''}}">
                        </div>
                        <div class="col-md-3">
                            <label for="paystack_client_secret">Playstack Secret Key</label>
                            <input type="text" class="form-control" name="paystack_client_secret" id="paystack_client_secret" value="{{$Payment_Gateway->paystack_client_secret ?? ''}}">
                        </div>                        
                        <div class="col-md-3">
                            <p>Playstack Logo<font color="red">*</font></p>
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap">
                                    <div class="attachment-preview" style="width: 136px;" >
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{ str_replace("../../", request()->getSchemeAndHttpHost().'/', $Payment_Gateway->paystack_preview_logo) ?? 'https://srisrisha.org/myDonation/assets/uploads/no-image.png'}}" alt="" style="width: 128px;height: 70px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="paystack_preview_logo_hidden" id="paystack_preview_logo" value="{{$Payment_Gateway->paystack_preview_logo ?? ''}}">
                                <!--<button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">-->
                                <!--    Change Playstack Logo-->
                                <!--</button>-->
                                <input type="file" name="paystack_preview_logo" id="paystack_logo_input" accept="image/jpeg,image/png" onchange="previewImage(event)">
                            </div>
                            <small class="form-text text-muted">Allowed image formats: jpg/peg/png.Recommended Logo 160x50</small>
                        </div>       
                    </div>                    
                    <!-- Playstack Ends Here -->
                    <!-- Cinetpay Starts Here -->
                    <div class="grid-title">
                        <h3><i class="fa fa-users"></i><span class="semi-bold"> Cinetpay Settings</span></h3>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <p>Enable Cinetpay?<font color="red">*</font></p>
                            <select class="form-control" name="cinetpay_gateway" id="cinetpay_gateway">
                                <option value="Yes" @if($Payment_Gateway->cinetpay_gateway == 'Yes') selected @endif>Yes</option>
                                <option value="No" @if($Payment_Gateway->cinetpay_gateway == 'No') selected @endif>No</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <p>Enable Mode (Test/Live)<font color="red">*</font></p>
                            <select class="form-control" name="cinetpay_mode" id="cinetpay_mode">
                                <option value="Test" @if($Payment_Gateway->cinetpay_mode == 'Test') selected @endif >Test Mode</option>
                                <option value="Live" @if($Payment_Gateway->cinetpay_mode == 'Live') selected @endif>Live Modeo</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="cinetpay_api_key">Cinetpay API Key</label>
                            <input type="text" class="form-control" name="cinetpay_api_key" id="cinetpay_api_key" value="{{$Payment_Gateway->cinetpay_api_key ?? ''}}">
                        </div>
                        <div class="col-md-3">
                            <label for="cinetpay_site_id">Cinetpay Site ID</label>
                            <input type="text" class="form-control" name="cinetpay_site_id" id="cinetpay_site_id" value="{{$Payment_Gateway->cinetpay_site_id ?? ''}}">
                        </div>                        
                        <div class="col-md-3">
                            <p>Cinetpay Logo<font color="red">*</font></p>
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap">
                                    <div class="attachment-preview" style="width: 136px;" >
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{ str_replace("../../",request()->getSchemeAndHttpHost().'/', $Payment_Gateway->cinetpay_preview_logo) ?? 'https://srisrisha.org/myDonation/assets/uploads/no-image.png'}}" alt="" style="width: 128px;height: 70px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="cinetpay_preview_logo_hidden" id="cinetpay_preview_logo" value="{{$Payment_Gateway->cinetpay_preview_logo ?? ''}}">
                                <!--<button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">-->
                                <!--    Change Cinetpay Logo-->
                                <!--</button>-->
                                <input type="file" name="cinetpay_preview_logo" id="cinetpay_logo_input" accept="image/jpeg,image/png" onchange="previewImage(event)">
                            </div>
                            <small class="form-text text-muted">Allowed image formats: jpg/peg/png.Recommended Logo 160x50</small>
                        </div>       
                    </div>                    
                    <!-- Cinetpay Ends Here -->
                    <!-- Zitopay Starts Here -->
                    <div class="grid-title">
                        <h3><i class="fa fa-users"></i><span class="semi-bold"> Zitopay Settings</span></h3>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <p>Enable Cinetpay?<font color="red">*</font></p>
                            <select class="form-control" name="zitopay_gateway" id="zitopay_gateway">
                                <option value="Yes" @if($Payment_Gateway->zitopay_gateway == 'Yes') selected @endif>Yes</option>
                                <option value="No" @if($Payment_Gateway->zitopay_gateway == 'No') selected @endif>No</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <p>Enable Mode (Test/Live)<font color="red">*</font></p>
                            <select class="form-control" name="zitopay_mode" id="zitopay_mode">
                                <option value="Test" @if($Payment_Gateway->zitopay_mode == 'Test') selected @endif >Test Mode</option>
                                <option value="Live" @if($Payment_Gateway->zitopay_mode == 'Live') selected @endif>Live Modeo</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="zitopay_username">Zitopay Username</label>
                            <input type="text" class="form-control" name="zitopay_username" id="zitopay_username" value="{{$Payment_Gateway->zitopay_username ?? ''}}">
                        </div>
                        <div class="col-md-3">
                            <p>Zitopay Logo<font color="red">*</font></p>
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap">
                                    <div class="attachment-preview" style="width: 136px;" >
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{ str_replace("../../", request()->getSchemeAndHttpHost().'/', $Payment_Gateway->zitopay_preview_logo) ?? 'https://srisrisha.org/myDonation/assets/uploads/no-image.png'}}" alt="" style="width: 128px;height: 70px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="zitopay_preview_logo_hidden" id="zitopay_preview_logo" value="{{$Payment_Gateway->zitopay_preview_logo ?? ''}}">
                                <input type="file" name="zitopay_preview_logo" id="zitopay_logo_input" accept="image/jpeg,image/png" onchange="previewImage(event)">
                            </div>
                            <small class="form-text text-muted">Allowed image formats: jpg/peg/png.Recommended Logo 160x50</small>
                        </div>    
                        @if(isset($Payment_Gateway))
                       <input type="hidden" name="action_payment" value="update" />
                        @else
                         <input type="hidden" name="action_payment" value="save" />
                        @endif
                        <div class="col-md-6">
						  @if(isset($Payment_Gateway))
							<button class="btn btn-success btn-cons" type="submit" name="action" value="save" ><i class="fa fa-credit-card"></i> Update Payment Gateways</button>
						  @else
							<button class="btn btn-info btn-cons" type="submit" name="action" value="save" ><i class="fa fa-credit-card"></i>  Add Payment Gateways</button>
						  @endif
						<button class="btn btn-warning btn-cons cancel-btn" type="reset" id="clear-btn"><i class="fa fa-eraser"></i> Clear</button>
					 </div>
                    </div>                    
                    <!-- Zitopay Ends Here -->                      
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
function previewImage(event) {
    // console.log(event);
    const input = event.target;
    const reader = new FileReader();
    reader.onload = function() {
        const previewContainer = input.closest('.media-upload-btn-wrapper');
        const output = previewContainer.querySelector('.avatar.user-thumb');
        const hiddenInput = previewContainer.querySelector('input[type="hidden"]');
        output.src = reader.result;
        hiddenInput.value = reader.result;
    }
    
    reader.readAsDataURL(input.files[0]);
}
</script>