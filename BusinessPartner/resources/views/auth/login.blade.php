@extends('layout')
@section('title','login')
@section('content')
<!-- /.login-logo -->
<form action="{{ route('login.post') }}" method="post">
   @csrf
                  <!-- Logo starts -->
                  <a href="index.html" class="auth-logo mt-5 mb-3"><img src="{{URL::asset('images/logo.png') }}" alt="Naresh Lottery" /></a>
                  <!-- Logo ends -->
                  <!-- Authbox starts -->
                  <div class="auth-box">
                      	@if (session('error_login'))
                			<div class="alert alert-danger" role="alert">
                				{{ session('error_login') }}
                			</div>
                	    @endif
                     <h4 class="mb-4">Welcome to Naresh Lottery</h4>
                     <div class="mb-3">
                        <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                        <div class="input-group">
                           <span class="input-group-text">
                           <i class="bi bi-envelope"></i>
                           </span>
                           <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email">
                           	@if ($errors->has('email'))
        						<span class="text-danger">{{ $errors->first('email') }}</span>
        					@endif
                        </div>
                     </div>
                     <div class="mb-2">
                        <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                           <span class="input-group-text">
                           <i class="bi bi-lock"></i>
                           </span>
                           <input type="password" id="password" name="password" class="form-control" placeholder="Enter password">
                            @if ($errors->has('password'))
        						<span class="text-danger">{{ $errors->first('password') }}</span>
        					@endif
                           <button class="btn btn-outline-secondary" type="button">
                           <i class="bi bi-eye"></i>
                           </button>
                        </div>
                     </div>
                     <div class="d-flex justify-content-end mb-3">
                        <a href="#" class="text-decoration-underline">Forgot Password?</a>
                     </div>
                     <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Get me Access</button>
                     </div>
                  </div>
                  <!-- Authbox ends -->
               </form>
@endsection