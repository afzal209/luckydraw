<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <meta name="author" content="Microsharp Technologies, Bengaluru - https://www.microsharp.net">
    <!-- Google Font: Source Sans Pro -->
   @if(Request::is('/') )
        <link href="{{URL::asset('assets/plugins/pace/pace-theme-flash.css')}}" rel="stylesheet" type="text/css" media="screen" />
        <link href="{{URL::asset('assets/plugins/bootstrapv3/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('assets/plugins/bootstrapv3/css/bootstrap-theme.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="{{URL::asset('assets/plugins/animate.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.css')}}" rel="stylesheet" type="text/css" />
        <!-- END PLUGIN CSS -->
        <!-- BEGIN CORE CSS FRAMEWORK -->
        <link href="{{URL::asset('assets/css/UBGAdmin.css')}}" rel="stylesheet" type="text/css" />
   @else
        <link href="{{URL::asset('assets/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('assets/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('assets/plugins/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{URL::asset('assets/plugins/jquery-ricksaw-chart/css/rickshaw.css') }}" type="text/css" media="screen">
        <link rel="stylesheet" href="{{URL::asset('assets/plugins/jquery-morris-chart/css/morris.css') }}" type="text/css" media="screen">
        <link href="{{URL::asset('assets/plugins/bootstrap-select2/select2.css') }}" rel="stylesheet" type="text/css" media="screen" />
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
     <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
</head>