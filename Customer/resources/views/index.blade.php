@extends('layout')
@section('title','Index')
@section('content')

           <!-- breadcrumb begin  -->
      <div class="breadcrumb-pok">
         <img class="br-shape-left" src="{{URL::asset('img/breadcrumb/left-bg.png')}}" alt="">
         <img class="br-shape-right" src="{{URL::asset('img/breadcrumb/right-bg.png')}}" alt="">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-xl-7 col-lg-8">
                  <div class="breadcrumb-content">
                     <span class="subtitle">Sign In</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- breadcrumb end  -->
      <!-- sign-in begin -->
      <div class="sign-in">
         <div class="container">
            <div class="row justify-content-lg-between justify-content-center">
               <div class="col-xl-5 col-lg-6">
                  <div class="poklotto-form">
                     <h3 class="title">Fill the form as well</h3>
                     <div class="part-form">
                        <form>
                           <div class="row">
                               <div id="login-message" class="text-danger text-center mb-2"></div>
                              <div class="col-xl-12">
                                 <label for="login_name" class="form-label">Username</label>
                                 <input type="text" name="login_name" id="login_name" placeholder="Ex: John">
                              </div>
                              <div class="col-xl-12">
                                 <label for="login_pass" class="form-label">Password</label>
                                 <input type="password" name="login_pass" id="login_pass" placeholder="">
                              </div>
                           </div>
                           <div class="part-submit">
                              <button id="cmn-bt" class="btn-pok" type="submit">
                              sign In <i class="fa-solid fa-angle-right"></i>
                              </button>
                           </div>
                        </form>
                        <div class="part-connect-social-info">
                           <div class="title-overlap">
                              <h4 class="title">or sign in with</h4>
                           </div>
                           <ul>
                              <li>
                                 <a href="#" class="single-social s-pinterest"><i class="fa-brands fa-pinterest-p"></i></a>
                              </li>
                              <li>
                                 <a href="#" class="single-social s-facebook"><i class="fa-brands fa-facebook-f"></i></a>
                              </li>
                              <li>
                                 <a href="#" class="single-social s-twitter"><i class="fa-brands fa-twitter"></i></a>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-6 col-lg-5 col-md-8 col-sm-10 d-xl-flex d-lg-flex d-block align-items-center">
                  <div class="part-right">
                     <div class="part-img">
                        <img src="{{URL::asset('img/sign-in/sign-in-img.png') }}" alt="">
                     </div>
                     <div class="part-text">
                        <div class="section-title">
                           <h3 class="sub-title">Welcome to UBG Luckydraws</h3>
                           <h2 class="title">Sign in and pick lucky number with just one click.</h2>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- sign-in end -->
            
         


@endsection