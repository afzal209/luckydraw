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
        @else
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
    </body>
</html>