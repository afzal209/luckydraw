<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>@yield('title') | Paklotto</title>
      <meta name="title" content="UBG Lottery - Play & Win Big | UBGGlobal.com">
      <meta name="description" content="Join UBG Lottery on UBGGlobal.com for exciting lottery draws, big winnings, and secure gameplay. Play now and stand a chance to win amazing prizes!">
      <meta name="keywords" content="UBG Lottery, UBGGlobal, online lottery, play lottery, win big, lottery results, jackpot, secure lottery">
      <meta name="author" content="Microsharp Technologies, Bangalore - https://www.microsahrp.net">
      <meta name="robots" content="index, follow">
      <meta property="og:title" content="UBG Lottery - Play & Win Big | UBGGlobal.com">
      <meta property="og:description" content="Experience the thrill of UBG Lottery on UBGGlobal.com. Play, win, and claim your rewards securely!">
      <meta property="og:url" content="https://www.ubgglobal.com">
      <meta property="og:type" content="website">
      <meta property="og:image" content="https://www.ubgglobal.com/images/ubg-lottery-banner.jpg">
      <meta name="twitter:card" content="summary_large_image">
      <meta name="twitter:title" content="UBG Lottery - Play & Win Big | UBGGlobal.com">
      <meta name="twitter:description" content="Join UBG Lottery for a chance to win huge prizes. Play now on UBGGlobal.com!">
      <meta name="twitter:image" content="https://www.ubgglobal.com/images/ubg-lottery-banner.jpg">
      <link rel="icon" type="image/png" href="{{URL::asset('img/favicon.png') }}" sizes="16x16">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
      <!-- bootstrap -->
      <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css' ) }}">
      <!-- animate css -->
      <link rel="stylesheet" href="{{URL::asset('css/animate.css' ) }}">
      <link rel="stylesheet" href="{{URL::asset('css/animate.min.css' ) }}">
      <!-- load all Font Awesome styles -->
      <link rel="stylesheet" href="{{URL::asset('css/all.min.css' ) }}">
      <!-- owl carousel css -->
      <link rel="stylesheet" href="{{URL::asset('css/owl.carousel.min.css' ) }}">
      <!-- main css -->
      <link rel="stylesheet" href="{{URL::asset('css/style.css' ) }}">
      @if(Request::is('profile'))
      <link rel="stylesheet" href="{{URL::asset('date-p/mc-calendar.min.css' )}}">
      @endif
      
      <!-- style main css -->
      
   </head>
   <body>
      <!-- preloader begin -->
      <div class="preloader">
         <div class="loader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
         </div>
      </div>
      <!-- preloader end -->    
      <!-- scroll-to-top start -->
  
      <!-- header begin -->
      <div class="header">
         <div class="container">
            <div class="row">
               <div class="col-xl-3 col-lg-3 d-xl-flex d-lg-flex d-block align-items-center">
                  <div class="row">
                     <div class="col-xl-12 col-lg-12 col-6 d-xl-block d-lg-block d-flex align-items-center">
                        <div class="logo">
                           <a href='index.html'>
                           <img src="{{URL::asset('img/logo.png') }}" alt="">
                           </a>
                        </div>
                     </div>
                     <div class="col-6 d-xl-none d-lg-none d-flex justify-content-end">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa-solid fa-bars"></i>
                        </button>
                     </div>
                  </div>
               </div>
               <div class="col-xl-6 col-lg-6">
                  <div class="main-menu">
                     <nav class="navbar navbar-expand-lg">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                           <ul class="navbar-nav m-auto">
                              <li class="nav-item">
                                 <a class='nav-link' href='index.html'>Home</a>
                              </li>
                              <li class="nav-item">
                                 <a class='nav-link' href='about.html'>About</a>
                              </li>
                              @if(Session::get('user'))
                              <li class="nav-item dropdown">
                                 <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                 Luckydraws
                                 </a>
                                 <!--<a class='nav-link' href='{{route('luckydraw.luckydraw')}}'>Luckydraws</a>-->
                                 <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('luckydraw.luckydraw') ? 'active' : '' }}" 
                                           href="{{ route('luckydraw.luckydraw') }}">
                                            My Luckydraws
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('my.prizes') ? 'active' : '' }}" 
                                           href="{{ route('my.prizes') }}">
                                            My Prizes
                                        </a>
                                    </li>
                                 </ul>
                              </li>
                              @endif
                              <li class="nav-item dropdown">
                                 <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                 Pages
                                 </a>
                                 <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class='dropdown-item active' href='sign-in.html'>Sign In</a></li>
                                    <li><a class='dropdown-item' href='register.html'>Register / Sign up</a></li>
                                    <li><a class='dropdown-item' href='faq.html'>Ques. & Ans.</a></li>
                                    <li><a class='dropdown-item' href='blog-posts.html'>Blog Posts</a></li>
                                    <li><a class='dropdown-item' href='blog-details.html'>Blog Details</a></li>
                                    <li><a class='dropdown-item' href='error.html'>Error 404</a></li>
                                 </ul>
                              </li>
                              <li class="nav-item">
                                 <a class='nav-link' href='contact.html'>Contact</a>
                              </li>
                              @if(Session::get('user'))
                              <li class="nav-item">
                                 <a class='nav-link' href='{{route('logout')}}'>Logout</a>
                              </li>
                              @endif
                           </ul>
                        </div>
                     </nav>
                  </div>
               </div>
               @if(Session::get('user'))
               <div class="col-xl-3 col-lg-3 d-xl-flex d-lg-flex d-none align-items-center justify-content-end">
                  <a class='btn-pok mid' href='{{route('customers.profile')}}'>My Profile <i class="fa-solid fa-user"></i></a>
               </div>
               @endif
            </div>
         </div>
      </div>
    
         
         <!-- header-section end  -->
         @yield('content')
         <!-- footer section start  -->
         <div class="footer">
         <div class="footer-bottom">
            <div class="container">
               <div class="footer-bottom-content">
                  <p class="copyright-text"> Copyright &copy <script type="text/javascript"> document.write(new Date().getFullYear());</script> Luckydraw Company. All rights reserved.</p>
                  <ul class="social-link">
                     <li class="single-social">
                        <a href="#0">
                        <i class="fa-brands fa-facebook-f"></i>
                        </a>
                     </li>
                     <li class="single-social">
                        <a href="#0">
                        <i class="fa-brands fa-twitter"></i>
                        </a>
                     </li>
                     <li class="single-social">
                        <a href="#0">
                        <i class="fa-brands fa-pinterest-p"></i>
                        </a>
                     </li>
                  </ul>
                  <div class="footer-menu">
                     <ul>
                        <li>
                           <a class='single-menu' href='index.html'>Home</a>
                        </li>
                        <li>
                           <a class='single-menu' href='about.html'>About</a>
                        </li>
                        <li>
                           <a class='single-menu' href='lotteries.html'>Luckydraws</a>
                        </li>
                        <li>
                           <a class='single-menu' href='blog-posts.html'>Blogs</a>
                        </li>
                        <li>
                           <a class='single-menu' href='contact.html'>contact</a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- footer end -->
      <!-- back to button begin -->
      <div class="back-to-top-btn">
         <a href="#">
         <i class="fa-solid fa-arrow-turn-up"></i>
         </a>
      </div>
      <!-- back to top button end -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
      <!-- bootstrap js -->
      <script src="{{URL::asset('js/jquery-3.6.0.min.js') }}"></script>
      <!-- bootstrap js -->
      <script src="{{URL::asset('js/bootstrap.bundle.min.js') }}"></script>
      <!-- owl carousel js -->
      <script src="{{URL::asset('js/owl.carousel.min.js') }}"></script>
      <!-- main js -->
      <script src="{{URL::asset('js/main.js') }}"></script>
      <!-- lottery js initialize -->
      @if(Request::is('luckydraw'))
      <script src="{{URL::asset('js/lotteries-initialization.js') }}"></script>
      @elseif(Request::is('profile'))
       <script src="{{URL::asset('js/lotteries-initialization.js')}}"></script>
        <!-- register js initialize -->
        <script src="{{URL::asset('date-p/mc-calendar.min.js')}}"></script>

        <script src="{{URL::asset('js/register.js')}}"></script>
      @endif
      
      <script>
         $(document).ready(function() {
              $('#cmn-bt1').on('click', function(e) {
                  e.preventDefault(); // ✅ Correct usage here
                  // alert('yes');
                  // var email = $('#signup_name').val();
                  // var password = $('#signup_pass').val();
                  // console.log(name);
                  // console.log(password);
                  // $.ajax({
                  //     url: "{{ url('post-register') }}",
                  //     type: "POST",
                  //     data: {
                  //         "_token": "{{ csrf_token() }}",
                  //         "email" :  email,
                  //         "password" : password,
                  //     },
                  //     success: function(data) {
                  //         console.log(data);
                  //         // console.log(data['doneMessage']);
                  //     }
                  // });
                  var email = $('#signup_name').val();
                  var password = $('#signup_pass').val();
                  var confirmPassword = $('#signup_re-pass').val();
                  if (password !== confirmPassword) {
                      alert("Passwords do not match.");
                      return;
                  }
                  $.ajax({
                      url: "{{ url('post-register') }}",
                      type: "POST",
                      data: {
                          "_token": "{{ csrf_token() }}",
                          "email" :  email,
                          "password" : password,
                      },
                      success: function(data) {
                          alert(data.success); // success message
                          $('#signupModal').modal('hide');
                      },
                      error: function(xhr) {
                          if (xhr.status === 422) {
                              let errors = xhr.responseJSON.errors;
                              let errorMessages = '';
                              for (let field in errors) {
                                  errorMessages += errors[field][0] + '\n';
                              }
                              alert(errorMessages); // display validation errors
                          } else {
                              alert("An unexpected error occurred.");
                          }
                      }
                  });
              })
               $('#cmn-bt').on('click', function(e) {
                   e.preventDefault();
                  var email = $('#login_name').val();
                  var password = $('#login_pass').val();
                  // Clear previous message
                  $('#login-message').text('');
                  $.ajax({
                      url: "{{ url('post-login') }}",
                      type: "POST",
                      data: {
                          "_token": "{{ csrf_token() }}",
                          "email": email,
                          "password": password,
                      },
                      success: function(data) {
                          // ✅ Save user email in localStorage
                          localStorage.setItem('data', data);
                          // ✅ Redirect user
                          window.location.href = "{{ url('/luckydraw') }}"; // update to your actual URL
                      },
                      error: function(xhr) {
                          if (xhr.status === 422) {
                              let response = xhr.responseJSON;
                              let errorMsg = response.errors || "Login failed";
                              $('#login-message').text(errorMsg).css("color", "red");
                          } else {
                              $('#login-message').text("An unexpected error occurred").css("color", "red");
                          }
                      }
                  });
               });
                $('#personal_details').on('click',function(){
                    $('#personal_details_label').hide();
                   $('#personal_details_div').show();
               })
                $('#email_address').on('click',function(){
                     $('#email_address_label').hide();
                   $('#email_address_div').show();
               })
                $('#number').on('click',function(){
                     $('#number_label').hide();
                   $('#number_div').show();
               })
               $('#password').on('click',function(){
                   $('#password_label').hide();
                   $('#password_div').show();
               })
               $('#personal_details_cancel').on('click',function(){
                    $('#personal_details_label').show();
                   $('#personal_details_div').hide();
               })
                $('#email_address_cancel').on('click',function(){
                    $('#email_address_label').show();
                   $('#email_address_div').hide();
               })
                $('#number_cancel').on('click',function(){
                     $('#number_label').show();
                   $('#number_div').hide();
               })
               $('#password_cancel').on('click',function(){
                    $('#password_label').show();
                   $('#password_div').hide();
               })
          });
      </script>
   </body>
</html>