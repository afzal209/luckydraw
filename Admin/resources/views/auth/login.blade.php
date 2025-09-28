@extends('layout')
@section('title','login')
@section('content')
<!-- /.login-logo -->
<div class="col-md-7 col-md-offset-2 tiles white no-padding">
   <div class="p-t-30 p-l-40 p-b-20 xs-p-t-10 xs-p-l-10 xs-p-b-10">
	  <h2 class="normal">Admin Dashbord</h2>
	  <div role="tabpanel" class="tab-pane active" id="tab_login">
		 <form class="animated fadeIn validate" id="form" name="form" action="{{ route('login.post') }}" method="post">
			@csrf
			<div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
    <div class="col-md-6 col-sm-6">
        <input class="form-control" id="login_username" name="email" placeholder="Username" type="email" value="admin@gmail.com" required>
        @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif
    </div>
    <div class="col-md-6 col-sm-6">
        <input class="form-control" id="login_pass" name="password" placeholder="Password" type="password" value="1234567" required>
        @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
        @endif
    </div>
    @if(session('session_error'))
        <div class="col-md-12 col-sm-12">
            <div class="alert alert-danger" role="alert">{{ session('session_error') }}</div>
        </div>
    @endif
    <div role="tablist">
        <button type="submit" class="btn btn-primary">Get Me Access</button>
    </div>
</div>
			<div class="row p-t-10 m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
			   <div class="control-group col-md-10">
				  <div class="checkbox checkbox check-success">
					 <input id="checkbox1" type="checkbox" value="1">
					 <label for="checkbox1">Keep me reminded</label>
				  </div>
			   </div>
			</div>
		 </form>
	  </div>
   </div>
</div>
@endsection