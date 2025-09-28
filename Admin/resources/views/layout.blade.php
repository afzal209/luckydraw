<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <meta name="author" content="Microsharp Technologies, Bengaluru - https://www.microsharp.net">
        <!-- Google Font: Source Sans Pro -->
        @if(Request::is('/') )s
        	<link href="{{URL::asset('assets/plugins/pace/pace-theme-flash.css')}}" rel="stylesheet" type="text/css" media="screen" />
            <link href="{{URL::asset('assets/plugins/bootstrapv3/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
            <link href="{{URL::asset('assets/plugins/bootstrapv3/css/bootstrap-theme.min.css')}}" rel="stylesheet" type="text/css" />
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link href="{{URL::asset('assets/plugins/animate.min.css')}}" rel="stylesheet" type="text/css" />
            <link href="{{URL::asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.css')}}" rel="stylesheet" type="text/css" />
            <!-- END PLUGIN CSS -->
            <!-- BEGIN CORE CSS FRAMEWORK -->
            <link href="{{URL::asset('assets/css/UBGAdmin.css')}}" rel="stylesheet" type="text/css" />
        @elseif(Request::is('luckydraws') || Request::is('luckydraws/.r*') )
            <link href="{{URL::asset('assets/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{URL::asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.css') }}" relr="stylesheet" type="text/css" />
            <link href="{{URL::asset('assets/plugins/dropzone/css/dropzone.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{URL::asset('assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{URL::asset('assets/plugins/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{URL::asset('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{URL::asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{URL::asset('assets/plugins/ios-switch/ios7-switch.css') }}" rel="stylesheet" type="text/css" media="screen">
            <link href="{{URL::asset('assets/plugins/bootstrap-select2/select2.css') }}" rel="stylesheet" type="text/css" media="screen" />
            <link href="{{URL::asset('assets/plugins/boostrap-clockpicker/bootstrap-clockpicker.min.css') }}" rel="stylesheet" type="text/css" media="screen" />
            <!-- END PLUGIN CSS -->
            <!-- BEGIN PLUGIN CSS -->
            <link href="{{URL::asset('assets/plugins/pace/pace-theme-flash.css') }}" rel="stylesheet" type="text/css" media="screen" />
            <link href="{{URL::asset('assets/plugins/bootstrapv3/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{URL::asset('assets/plugins/bootstrapv3/css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link href="{{URL::asset('assets/plugins/animate.min.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{URL::asset('assets/plugins/jquery-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{URL::asset('assets/plugins/datatables-responsive/css/datatables.responsive.css') }}" rel="stylesheet" type="text/css" media="screen" />
            <link href="{{URL::asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.css') }}" rel="stylesheet" type="text/css" />
            <!-- END PLUGIN CSS -->
            <!-- BEGIN CORE CSS FRAMEWORK -->
            <link href="{{URL::asset('assets/css/UBGAdmin.css') }}" rel="stylesheet" type="text/css" />
        @else
            <link href="{{URL::asset('assets/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css" />
            <!-- Include Flatpickr -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
            <link href="{{URL::asset('assets/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{URL::asset('assets/plugins/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{URL::asset('assets/plugins/jquery-ricksaw-chart/css/rickshaw.css') }}" rel="stylesheet" type="text/css" media="screen">
            <link href="{{URL::asset('assets/plugins/jquery-morris-chart/css/morris.css') }}" rel="stylesheet" type="text/css" media="screen">
            <link href="{{URL::asset('assets/plugins/ios-switch/ios7-switch.css') }}" rel="stylesheet" type="text/css" media="screen">
            <link href="{{URL::asset('assets/plugins/bootstrap-select2/select2.css') }}" rel="stylesheet" type="text/css" media="screen" />
            <link href="{{URL::asset('assets/plugins/boostrap-clockpicker/bootstrap-clockpicker.min.css') }}" rel="stylesheet" type="text/css" media="screen" />
            <link href="{{URL::asset('assets/plugins/jquery-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{URL::asset('assets/plugins/datatables-responsive/css/datatables.responsive.css') }}" rel="stylesheet" type="text/css" media="screen" />
            <link href="{{URL::asset('assets/plugins/jquery-jvectormap/css/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" media="screen" />
            <!-- END PLUGIN CSS -->
            <!-- BEGIN PLUGIN CSS -->
            <link href="{{URL::asset('assets/plugins/pace/pace-theme-flash.css') }}" rel="stylesheet" type="text/css" media="screen" />
            <link href="{{URL::asset('assets/plugins/bootstrapv3/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{URL::asset('assets/plugins/bootstrapv3/css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link href="{{URL::asset('assets/plugins/animate.min.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{URL::asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.css') }}" rel="stylesheet" type="text/css" />
            <!-- END PLUGIN CSS -->
            <!-- BEGIN CORE CSS FRAMEWORK -->
            <link href="{{URL::asset('assets/css/UBGAdmin.css') }}" rel="stylesheet" type="text/css" />
            <!-- END CORE CSS FRAMEWORK -->
       @endif
       @yield('styles')
        <!-- Theme style -->
    </head>
    <body class="@if(Request::is('/') ) error-body no-top lazy @else @endif" @if(Request::is('/') )  data-original="assets/img/work.jpg" style="background-image: url('assets/img/loginBG.jpg');background-repeat: no-repeat; background-size: 100% 100%;" @endif >
    @if(Request::is('/') )
        <div class="container">
            <div class="row login-container animated fadeInUp">
                @else
                    @php
                        $user = Session::get('user');
                        $fullUrl = null;
                        if ($user && !empty($user['profile_pic'])) {
                            $fullUrl = str_replace("../../", env('WEB_URL'), $user['profile_pic']);
                        }
                    @endphp
                    
                <!-- BEGIN HEADER -->
                <div class="header navbar navbar-inverse ">
                    <!-- BEGIN TOP NAVIGATION BAR -->
                    <div class="navbar-inner">
                        <div class="header-seperation">
                           <ul class="nav pull-left notifcation-center visible-xs visible-sm">
                              <li class="dropdown">
                                 <a href="#main-menu" data-webarch="toggle-left-side">
                                 <i class="material-icons">menu</i>
                                 </a>
                              </li>
                           </ul>
                           <!-- BEGIN LOGO -->
                           <a href="https://google.com/"> <img src="{{ URL::asset('assets/img/logo.png') }}" class="logo" alt="" data-src="{{ URL::asset('assets/img/logo.png') }}" data-src-retina="{{ URL::asset('assets/img/logo2x.png') }}" width="106" height="21" /> </a>
                           <!-- END LOGO -->
                            <ul class="nav pull-right notifcation-center">
                                <li class="dropdown hidden-xs hidden-sm">
                                    <a href="https://www.ubgglobal.com/" class="dropdown-toggle active" data-toggle=""><i class="material-icons">home</i></a>
                                </li>
                                <li class="dropdown visible-xs visible-sm"> <a href="#" data-webarch="toggle-right-side"> <i class="material-icons">chat</i> </a> </li>
                           </ul>
                        </div>
                        <!-- END RESPONSIVE MENU TOGGLER -->
                        <div class="header-quick-nav">
                           <!-- BEGIN TOP NAVIGATION MENU -->
                           <div class="pull-left">
                              <ul class="nav quick-section">
                                 <li class="quicklinks"> <a href="#" class="" id="layout-condensed-toggle"> <i class="material-icons">menu</i> </a> </li>
                              </ul>
                              <ul class="nav quick-section">
                                 <li class="quicklinks  m-r-10"> <a href="#" class=""> <i class="material-icons">refresh</i> </a> </li>
                                 <li class="quicklinks"><a href="#" class=""> <i class="material-icons">apps</i> </a></li>
                                 <li class="quicklinks"> <span class="h-seperate"></span></li>
                                 <li class="quicklinks"> <a href="#" class="" id="my-task-list" data-placement="bottom" data-content='' data-toggle="dropdown" data-original-title="Notifications"> <i class="material-icons">notifications_none</i><span class="badge badge-important bubble-only"></span></a></li>
                              </ul>
                           </div>
                           <div id="notification-list" style="display:none">
                              <div style="width:300px">
                                 <div class="notification-messages info">
                                    <div class="user-profile">
                                       <img src="{{ URL::asset('assets/img/profiles/d.jpg') }}" alt="" data-src="{{URL::asset('assets/img/profiles/d.jpg') }}" data-src-retina="{{ URL::asset('assets/img/profiles/d2x.jpg') }}" width="35" height="35">
                                    </div>
                                    <div class="message-wrapper">
            							<div class="heading">Mr. David - UK</div>
            							<div class="description">XMAS Ticket Sold</div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                                 <div class="notification-messages danger">
                                    <div class="iconholder">
                                       <img src="assets/img/profiles/d.jpg" alt="" data-src="{{URL::asset('assets/img/profiles/d.jpg') }}" data-src-retina="assets/img/profiles/d2x.jpg" width="35" height="35">
                                    </div>
                                    <div class="message-wrapper">
            							<div class="heading">Mr. Prabhakar - India</div>
            							<div class="description">Loaded 1000 to Wallet</div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                                 <div class="notification-messages success">
                                    <div class="user-profile">
                                       <img src="{{ URL::asset('assets/img/profiles/h.jpg') }}" alt="" data-src="{{ URL::asset('assets/img/profiles/h.jpg') }}" data-src-retina="{{ URL::asset('assets/img/profiles/h2x.jpg') }}" width="35" height="35">
                                    </div>
                                    <div class="message-wrapper">
            							<div class="heading">Mr. Prabhakar - India</div>
            							<div class="description">Bought New Year Luckydraw for 25USD</div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                              </div>
                           </div>
                           <!-- END TOP NAVIGATION MENU -->
                           <!-- BEGIN PROFILE TOGGLER -->
                           <div class="pull-right">
                              <ul class="nav quick-section ">
                                 <li class="quicklinks">
                                    <a data-toggle="dropdown" class="dropdown-toggle  pull-right " href="#" id="user-options">
                                        <img src="{{ $fullUrl ?? '' }}" style="border-radius:50%" alt="{{ $user['name'] ?? 'Default Name' }}" data-src="{{ $fullUrl ?? '' }}" data-src-retina="{{ $fullUrl ?? '' }}" width="35" height="35" />
                                        <div class="availability-bubble online"></div>
                                    </a>
                                    <ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
                                       <li><a href="{{route('settings.general_setting') }}"> My Account</a></li>
                                       <!-- <li><a href="#"> My Inbox&nbsp;&nbsp;<span class="badge badge-important animated bounceIn">2</span></a></li> -->
                                       <li class="divider"></li>
                                       <li><a href="{{ env('APP_URL') }}logout"><i class="material-icons">power_settings_new</i>&nbsp;&nbsp;Log Out</a></li>
                                    </ul>
                                 </li>
                              </ul>
                           </div>
                           <!-- END PROFILE TOGGLER -->
                        </div>
                        <!-- END TOP NAVIGATION MENU -->
                     </div>
                     <!-- END TOP NAVIGATION BAR -->
                  </div>
                  <div class="page-container row">
                      <!-- BEGIN SIDEBAR -->
                     <div class="page-sidebar " id="main-menu">
                        <!-- BEGIN MINI-PROFILE -->
                        <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
                           <div class="user-info-wrapper sm">
                                @php
                                    $user = Session::get('user');
                                @endphp                               
                              <div class="profile-wrapper sm">
                                 <img src="{{$fullUrl}}" alt="{{ $user['name'] }}" data-src="{{$fullUrl}}" data-src-retina="{{$fullUrl}}" width="69" height="69" />
                                 <div class="availability-bubble online"></div>
                              </div>
                                <div class="user-info sm" style="color:black;">
                                    <div class="username">
                                        @if($user && isset($user['name']))
                                            {{ $user['name'] }} <span class="semi-bold">UBG</span>
                                        @else
                                            Guest <span class="semi-bold">CH</span>
                                        @endif
                                    </div>
                                    <div class="status">
                                        @if($user)
                                            Administrator
                                        @else
                                            Relogin
                                        @endif
                                    </div>
                                </div>
                           </div>
                           <!-- END MINI-PROFILE -->
                           <!-- BEGIN SIDEBAR MENU -->
                           <p class="menu-title sm">Navigation Menu</p>
                           <ul>
            					<li class="start {{ request()->is('dashboard') ? 'open' : '' }}"><a href="{{route('dashboard')}}"><i class="material-icons">airplay</i> <span class="title">Dashboard</span> <span class="selected"></span></a></li>
                                <li class="treeview {{ request()->is('business_area') || request()->is('region') || request()->is('country') || request()->is('state') || request()->is('city') || request()->is('template_manager') || request()->is('price_manager') || request()->is('template_manager_group*') ? 'open' : '' }}">
                                    <a href="#!"> 
                                        <i class="material-icons">hive</i> 
                                        <span class="title">Information Manager</span> 
                                        <span class="arrow"></span> 
                                    </a>
                                    <ul class="sub-menu" style="{{ request()->is('business_area') || request()->is('region') || request()->is('country') || request()->is('state') || request()->is('city') || request()->is('template_manager') || request()->is('price_manager') || request()->is('template_manager_group*') ? 'display: block;' : 'display: none;' }}">
                                        <li>
                                            <a href="{{ route('business_area') }}" class="{{ request()->routeIs('business_area') ? 'start open' : '' }}">
                                                <div class="status-icon blue"></div>Business Area
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('region') }}" class="{{ request()->routeIs('region') ? 'start open' : '' }}">
                                                <div class="status-icon green"></div>Region
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('country') }}" class="{{ request()->routeIs('country') ? 'start open' : '' }}">
                                                <div class="status-icon blue"></div>Country
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('state') }}" class="{{ request()->routeIs('state') ? 'start open' : '' }}">
                                                <div class="status-icon green"></div>State
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('city') }}" class="{{ request()->routeIs('city') ? 'start open' : '' }}">
                                                <div class="status-icon blue"></div>City
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('template_manager') }}" class="{{ request()->routeIs('template_manager') ? 'start open' : '' }}">
                                                <div class="status-icon green"></div>Template Manager
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('template_manager_group.group') }}" class="{{ request()->routeIs('template_manager_group.group') ? 'start open' : '' }}">
                                                <div class="status-icon blue"></div>Template Group Manager
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="treeview {{ request()->is('luckydraws*') ? 'open' : '' }}">
                                    <a href="#!"> 
                                        <i class="material-icons">dataset_linked</i> 
                                        <span class="title">Manage Luckydraws</span> 
                                        <span class="arrow"></span> 
                                    </a>
                                    <ul class="sub-menu" style="{{ request()->is('luckydraws*') ? 'display: block;' : 'display: none;' }}">
                                        <li>
                                            <a href="{{ route('luckydraws.add') }}" class="{{ request()->routeIs('luckydraws.add') ? 'start open' : '' }}">
                                                <div class="status-icon blue"></div>Create Lucky Draw
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('luckydraws') }}" class="{{ request()->routeIs('luckydraws') ? 'start open' : '' }}">
                                                <div class="status-icon green"></div>View Lucky Draws
                                            </a>
                                        </li>
                                    </ul>
                                </li>
            					<a href=""> <span class="title"></span> <span class="selected"></span></a></li>
                                <li class="treeview {{ request()->is('business_partners/*') ? 'open' : '' }}">
                                    <a href="#!"> 
                                        <i class="material-icons">diversity_1</i> 
                                        <span class="title">Business Partners</span> 
                                        <span class="arrow"></span> 
                                    </a>
                                    <ul class="sub-menu" style="{{ request()->is('business_partners/*') || request()->routeIs('wallet_transaction') ? 'display: block;' : 'display: none;' }}">
                                        <li>
                                            <a href="{{ route('business_partners.partner') }}" class="{{ request()->routeIs('business_partners.partner') ? 'start open' : '' }}">
                                                <div class="status-icon blue"></div>Create Business Partner
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('business_partners.partners') }}" class="{{ request()->routeIs('business_partners.partners') ? 'start open' : '' }}">
                                                <div class="status-icon green"></div>View Business Partners
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('wallet_transaction') }}" class="{{ request()->routeIs('wallet_transaction') ? 'start open' : '' }}">
                                                <div class="status-icon yellow"></div>Manage Wallet
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="start {{ request()->is('customer') ? 'open' : '' }}">
                                    <a href="{{ route('customer') }}"> 
                                        <i class="material-icons">group</i> 
                                        <span class="title">View Customers</span>
                                    </a>
                                </li>
                                <li class="start {{ request()->is('sales') ? 'open' : '' }}">
                                    <a href="{{ route('sales') }}"> 
                                        <i class="material-icons">terminal</i> 
                                        <span class="title">View Sales</span>
                                    </a>
                                </li>
                                <li class="treeview {{ request()->is('report*') || request()->routeIs('*.report') ? 'open' : '' }}">
                                    <a href="#!"> 
                                        <i class="material-icons">cloud_download</i> 
                                        <span class="title">Reports</span> 
                                        <span class="arrow"></span> 
                                    </a>
                                    <ul class="sub-menu" style="{{ request()->is('report*')  || request()->routeIs('*.report') ? 'display: block;' : 'display: none;' }}">
                                        <li>
                                            <a href="{{ route('reports.index') }}" class="{{ request()->routeIs('reports.index') ? 'start open' : '' }}">
                                                <div class="status-icon yellow"></div>Report Manager
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('reports.customers') }}" class="{{ request()->routeIs('reports.customers') ? 'start open' : '' }}">
                                                <div class="status-icon yellow"></div>Customers Report
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('reports.business_partners') }}" class="{{ request()->routeIs('reports.business_partners') ? 'start open' : '' }}">
                                                <div class="status-icon yellow"></div>BP Report
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('wallet.report') }}" class="{{ request()->routeIs('wallet.report') ? 'start open' : '' }}">
                                                <div class="status-icon yellow"></div>BP Wallet Report
                                            </a>
                                        </li>                           
                                        <li>
                                            <a href="{{ route('sales.report') }}" class="{{ request()->routeIs('sales.report') ? 'start open' : '' }}">
                                                <div class="status-icon yellow"></div>Luckydraw Sales Report
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('luckydraw.report') }}" class="{{ request()->routeIs('luckydraw.report') ? 'start open' : '' }}">
                                                <div class="status-icon yellow"></div>Template Sales Reports
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('overallSales.report') }}" class="{{ request()->routeIs('overallSales.report') ? 'start open' : '' }}">
                                                <div class="status-icon yellow"></div>All Sales Report
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="start {{ request()->is('sales') ? 'open' : '' }}">
                                    <a href="{{ route('sales') }}"> 
                                        <i class="material-icons">terminal</i> 
                                        <span class="title">View Sales</span>
                                    </a>
                                </li>                                
                                <li class="start {{ request()->is('support') ? 'open' : '' }}">
                                    <a href="{{ route('support') }}">
                                        <i class="material-icons">layers</i>
                                        <span class="title">Support</span>
                                    </a>
                                </li>
                                <li class="treeview {{ request()->is('settings/*') ? 'open' : '' }}">
                                    <a href="#!">
                                        <i class="material-icons">apps</i>
                                        <span class="title">Settings</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu" style="{{ request()->is('settings/*') ? 'display: block;' : 'display: none;' }}">    
                                        <li>
                                            <a href="{{ route('settings.general_setting') }}"
                                               class="{{ request()->routeIs('settings.general_setting') ? 'start open' : '' }}">
                                                <div class="status-icon yellow"></div>
                                                General Settings
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('settings.payment_gateway') }}"
                                               class="{{ request()->routeIs('settings.payment_gateway') ? 'start open' : '' }}">
                                                <div class="status-icon blue"></div>
                                                Manage Payment Gateways
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('settings.manage_smtp_mail') }}"
                                               class="{{ request()->routeIs('settings.manage_smtp_mail') ? 'start open' : '' }}">
                                                <div class="status-icon green"></div>
                                                Manage SMTP Mails
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                               class="{{ request()->is('settings/manage_notifications') ? 'start open' : '' }}">
                                                <div class="status-icon red"></div>
                                                Manage Notifications
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                               class="{{ request()->is('settings/manage_mails') ? 'start open' : '' }}">
                                                <div class="status-icon yellow"></div>
                                                Manage Mails
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                           </ul>
                           <div class="side-bar-widgets">
                              <p class="menu-title sm">Tech Support<span class="pull-right"><a href="#" class="create-folder"> <i class="material-icons">add</i></a></span></p>
                              <ul class="folders">
                                 <li><a href="#"><div class="status-icon green"></div>+91 9972 64 65 66</a></li>
                                 <li><a href="#"><div class="status-icon red"></div>info@microsharp.net</a></li>
                                 <li><a href="#"><div class="status-icon blue"></div>24X7 Chat Support</a></li>
                                 <li class="folder-input" style="display:none">
                                    <input type="text" placeholder="Name of folder" class="no-boarder folder-name" name="">
                                 </li>
                              </ul>
                           </div>
                           <div class="clearfix"></div>
                           <!-- END SIDEBAR MENU -->
                        </div>
            		</div>
                      <a href="#" class="scrollup">Scroll</a>
                     <div class="footer-widget">
            			Designed by <a href="https://microsharp.net" target="_blank">Microsharp</a>&trade;
                     </div>
                     <div class="page-content">
                         <div id="portlet-config" class="modal hide">
                           <div class="modal-header">
                              <button data-dismiss="modal" class="close" type="button"></button>
                              <h3>Widget Settings</h3>
                           </div>
                           <div class="modal-body"> Widget settings form goes here </div>
                        </div>
                        <div class="clearfix"></div>
                         <div class="content">
                  @endif
            		@if (session('success'))
            			<div class="alert alert-success" role="alert">
            				{{ session('success') }}
            			</div>
            		@elseif(session('error'))
            		<div class="alert alert-danger" role="alert">
            				{{ session('error') }}
            			</div>
            		@endif
            		@yield('content')
            			@if(Request::is('/') )      
            				</div>
            				</div>
            			@else
            			</div>
            		</div>
            		</div>
            	@endif
                @if(Request::is('/') )
            		<!-- END CONTAINER -->
            		  <script src="{{URL::asset('assets/plugins/pace/pace.min.js')}}" type="text/javascript"></script>
            		  <!-- BEGIN JS DEPENDECENCIES-->
            		  <script src="{{URL::asset('assets/plugins/jquery/jquery-1.11.3.min.js')}}" type="text/javascript"></script>
            		  <script src="{{URL::asset('assets/plugins/bootstrapv3/js/bootstrap.min.js')}}" type="text/javascript"></script>
            		  <script src="{{URL::asset('assets/plugins/jquery-block-ui/jqueryblockui.min.js')}}" type="text/javascript"></script>
            		  <script src="{{URL::asset('assets/plugins/jquery-unveil/jquery.unveil.min.js')}}" type="text/javascript"></script>
            		  <script src="{{URL::asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js')}}" type="text/javascript"></script>
            		  <script src="{{URL::asset('assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js')}}" type="text/javascript"></script>
            		  <script src="{{URL::asset('assets/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
            		  <script src="{{URL::asset('assets/plugins/bootstrap-select2/select2.min.js')}}" type="text/javascript"></script>
            		  <!-- END CORE JS DEPENDECENCIES-->
            		  <!-- BEGIN CORE TEMPLATE JS -->
            		  <!--<script src="webarch/js/webarch.js" type="text/javascript"></script>-->
            		  <script src="{{URL::asset('assets/js/chat.js')}}" type="text/javascript"></script>
            		@elseif(Request::is('luckydraws') || Request::is('luckydraws/.*') )
            		<!-- END CONTAINER -->
            <script src="{{ URL::asset('assets/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
            		 <!-- BEGIN JS DEPENDECENCIES-->
            		 <script src="{{ URL::asset('assets/plugins/jquery/jquery-1.11.3.min.js') }}" type="text/javascript"></script>
            		 <script src="{{ URL::asset('assets/plugins/bootstrapv3/js/bootstrap.min.js') }}" type="text/javascript"></script>
            		 <script src="{{ URL::asset('assets/plugins/jquery-block-ui/jqueryblockui.min.js') }}" type="text/javascript"></script>
            		 <script src="{{ URL::asset('assets/plugins/jquery-unveil/jquery.unveil.min.js') }}" type="text/javascript"></script>
            		 <script src="{{ URL::asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js') }}" type="text/javascript"></script>
            		 <script src="{{ URL::asset('assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js') }}" type="text/javascript"></script>
            		 <script src="{{ URL::asset('assets/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
            		 <script src="{{ URL::asset('assets/plugins/bootstrap-select2/select2.min.js') }}" type="text/javascript"></script>
            		 <!-- END CORE JS DEPENDECENCIES-->
            		 <!-- BEGIN CORE TEMPLATE JS -->
            		 <script src="{{ URL::asset('assets/js/UBGAdmin.js') }}" type="text/javascript"></script>
            		 <script src="{{ URL::asset('assets/js/chat.js') }}" type="text/javascript"></script>
            		 <!-- END CORE TEMPLATE JS -->
            		 <!-- BEGIN PAGE LEVEL PLUGINS -->
            		 <script src="{{ URL::asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
            		 <script src="{{ URL::asset('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
            		 <script src="{{ URL::asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}" type="text/javascript"></script>
            		 <script src="{{ URL::asset('assets/plugins/jquery-inputmask/jquery.inputmask.min.js') }}" type="text/javascript"></script>
            		 <script src="{{ URL::asset('assets/plugins/jquery-autonumeric/autoNumeric.js') }}" type="text/javascript"></script>
            		 <script src="{{ URL::asset('assets/plugins/ios-switch/ios7-switch.js') }}" type="text/javascript"></script>
            		 <script src="{{ URL::asset('assets/plugins/bootstrap-select2/select2.min.js') }}" type="text/javascript"></script>
            		 <script src="{{ URL::asset('assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') }}" type="text/javascript"></script>
            		 <script src="{{ URL::asset('assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js') }}" type="text/javascript"></script>
            		 <script src="{{ URL::asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js') }}" type="text/javascript"></script>
            		 <script src="{{ URL::asset('assets/plugins/boostrap-clockpicker/bootstrap-clockpicker.min.js') }}" type="text/javascript"></script>
            		 <script src="{{ URL::asset('assets/plugins/dropzone/dropzone.min.js') }}" type="text/javascript"></script>
            		 <!-- END PAGE LEVEL PLUGINS -->
            		 <!-- BEGIN PAGE LEVEL SCRIPTS -->
            		 <script src="{{ URL::asset('assets/js/form_elements.js') }}" type="text/javascript"></script>
            		 <script src="{{URL::asset('assets/plugins/jquery-datatable/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
                      <script src="{{URL::asset('assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js') }}" type="text/javascript"></script>
            		 <script type="text/javascript" src="{{URL::asset('assets/plugins/datatables-responsive/js/datatables.responsive.js') }}"></script>
                      <script type="text/javascript" src="{{URL::asset('assets/plugins/datatables-responsive/js/lodash.min.js') }}"></script>
                       <script src="{{URL::asset('assets/js/datatables.js') }}" type="text/javascript"></script>
            	
            		@else
            		  <script src="{{URL::asset('assets/plugins/pace/pace.min.js')}}" type="text/javascript"></script>
            		  
            		  
            		  <!-- BEGIN JS DEPENDECENCIES-->
            		  <script src="{{URL::asset('assets/plugins/jquery/jquery-1.11.3.min.js')}}" type="text/javascript"></script>
            		  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
            		  
            		  <script src="{{URL::asset('assets/plugins/bootstrapv3/js/bootstrap.min.js')}}" type="text/javascript"></script>
            		  <script src="{{URL::asset('assets/plugins/jquery-block-ui/jqueryblockui.min.js')}}" type="text/javascript"></script>
            		  <script src="{{URL::asset('assets/plugins/jquery-unveil/jquery.unveil.min.js')}}" type="text/javascript"></script>
            		  <script src="{{URL::asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js')}}" type="text/javascript"></script>
            		  <script src="{{URL::asset('assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js')}}" type="text/javascript"></script>
            		  <script src="{{URL::asset('assets/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
            		  <script src="{{URL::asset('assets/plugins/bootstrap-select2/select2.min.js')}}" type="text/javascript"></script>
            		  <!-- END CORE JS DEPENDECENCIES-->
            		  <!-- BEGIN CORE TEMPLATE JS -->
            		  <script src="{{URL::asset('assets/js/UBGAdmin.js')}}" type="text/javascript"></script>
            		  <script src="{{URL::asset('assets/js/chat.js')}}" type="text/javascript"></script>
            		  <!-- END CORE TEMPLATE JS -->
            		  <!-- BEGIN PAGE LEVEL JS -->
            		  <script src="{{URL::asset('assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}" type="text/javascript"></script>
            		  <script src="{{URL::asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
            		  <script src="{{URL::asset('assets/plugins/jquery-block-ui/jqueryblockui.js')}}" type="text/javascript"></script>
            		  <script src="{{URL::asset('assets/plugins/bootstrap-select2/select2.min.js')}}" type="text/javascript"></script>
            		  <script src="{{URL::asset('assets/plugins/jquery-ricksaw-chart/js/raphael-min.js')}}"></script>
            		  <script src="{{URL::asset('assets/plugins/jquery-ricksaw-chart/js/d3.v2.js')}}"></script>
            		  <script src="{{URL::asset('assets/plugins/jquery-ricksaw-chart/js/rickshaw.min.js')}}"></script>
            		  <script src="{{URL::asset('assets/plugins/jquery-morris-chart/js/morris.min.js')}}"></script>
            		  <script src="{{URL::asset('assets/plugins/jquery-easy-pie-chart/js/jquery.easypiechart.min.js')}}"></script>
            		  <script src="{{URL::asset('assets/plugins/jquery-slider/jquery.sidr.min.js')}}" type="text/javascript"></script>
            		  <script src="{{URL::asset('assets/plugins/jquery-jvectormap/js/jquery-jvectormap-1.2.2.min.js')}}" type="text/javascript"></script>
            		  <script src="{{URL::asset('assets/plugins/jquery-jvectormap/js/jquery-jvectormap-us-lcc-en.js')}}" type="text/javascript"></script>
            		  <script src="{{URL::asset('assets/plugins/jquery-sparkline/jquery-sparkline.js')}}"></script>
            		  <script src="{{URL::asset('assets/plugins/jquery-flot/jquery.flot.min.js') }}"></script>
            		  <script src="{{URL::asset('assets/plugins/jquery-flot/jquery.flot.animator.min.js')}}"></script>
            		  <script src="{{URL::asset('assets/plugins/skycons/skycons.js')}}"></script>
            		  <script src="{{URL::asset('assets/plugins/jquery-datatable/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
                      <script src="{{URL::asset('assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js') }}" type="text/javascript"></script>
                      <script type="text/javascript" src="{{URL::asset('assets/plugins/datatables-responsive/js/datatables.responsive.js') }}"></script>
                      <script type="text/javascript" src="{{URL::asset('assets/plugins/datatables-responsive/js/lodash.min.js') }}"></script>
                      <!-- END PAGE LEVEL JS INIT -->
                      <script src="{{URL::asset('assets/js/datatables.js') }}" type="text/javascript"></script>
            		  <!-- END PAGE LEVEL PLUGINS   -->
            		  <!-- PAGE JS -->
            		  <script src="{{URL::asset('assets/js/dashboard.js')}}" type="text/javascript"></script>
            		  <!-- The core Firebase JS SDK is always required and must be listed first -->
            		  <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-app.js"></script>
            		  <!-- TODO: Add SDKs for Firebase products that you want to use
            			 https://firebase.google.com/docs/web/setup#available-libraries -->
            		  <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-analytics.js"></script>
            		  <script>
            			 // Your web app's Firebase configuration
            			 // For Firebase JS SDK v7.20.0 and later, measurementId is optional
            			 var firebaseConfig = {
            				 apiKey: "AIzaSyDaflsWYusjtsDkIyXPWuxpgYg9vYVelAM",
            				 authDomain: "ubgLuckydraw-38d59.firebaseapp.com",
            				 databaseURL: "https://ubgLuckydraw-38d59.firebaseio.com",
            				 projectId: "ubgLuckydraw-38d59",
            				 storageBucket: "ubgLuckydraw-38d59.appspot.com",
            				 messagingSenderId: "604319374989",
            				 appId: "1:604319374989:web:bb8e838658a5405d03ccc4",
            				 measurementId: "G-1P9DBV3T3N"
            			 };
            			 // Initialize Firebase
            			 firebase.initializeApp(firebaseConfig);
            			 firebase.analytics();
            		  </script>
            		@endif
            		@yield('script')
            		 
            		 <script>
            		 
            		 function initializeSelect2() {
    $('.select2').each(function() {
        if (!$(this).hasClass('select2-hidden-accessible')) { // Check if already initialized
            $(this).select2();
        }
    });
}
            		 
                      $(document).ready(function () {
                     
                     initializeSelect2(); // Initial load
                         
                $('.treeview').each(function () {
                    if ($(this).find('.open').length > 0) {
                        $(this).addClass('menu-open');
                        $(this).children('.sub-menu').show();
                    }
                });
            
                $('.treeview > a').on('click', function (e) {
                    e.preventDefault();
                    var parent = $(this).parent();
                    if (parent.hasClass('menu-open')) {
                        parent.removeClass('menu-open');
                        parent.children('.sub-menu').slideUp();
                    } else {
                        $('.treeview.menu-open').removeClass('menu-open').children('.sub-menu').slideUp();
                        parent.addClass('menu-open');
                        parent.children('.sub-menu').slideDown();
                    }
                });
            });
      </script>
	</body>
</html>