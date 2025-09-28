<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title><?php echo $__env->yieldContent('title'); ?> - UK Business Partner</title>
      <!-- Meta -->
      <meta name="description" content="Naresh Luckydraw Business Partner Dashboard" />
      <meta name="author" content="Microsharp Technologies, Bangalore - https://www.microsharp.net" />
      <link rel="canonical" href="https://www.nareshluckydraw.com/">
      <meta property="og:url" content="https://www.nareshluckydraw.com/">
      <meta property="og:title" content="Naresh Luckydraw Business Partner Dashboard">
      <meta property="og:description" content="Naresh Luckydraw Business Partner Dashboard">
      <meta property="og:type" content="Website">
      <meta property="og:site_name" content="Naresh Luckydraw">
      <link rel="shortcut icon" href="<?php echo e(URL::asset('images/favicon.svg')); ?>" />
      <!-- Google Font: Source Sans Pro -->
      <?php if(Request::is('/') ): ?>
      <link rel="stylesheet" href="<?php echo e(URL::asset('fonts/bootstrap/bootstrap-icons.min.css')); ?>" />
      <link rel="stylesheet" href="<?php echo e(URL::asset('css/main.min.css')); ?>" />
      <!-- END PLUGIN CSS -->
      <!-- BEGIN CORE CSS FRAMEWORK -->
      <?php else: ?>
      <link rel="stylesheet" href="<?php echo e(URL::asset('fonts/bootstrap/bootstrap-icons.min.css')); ?>" />
      <link rel="stylesheet" href="<?php echo e(URL::asset('css/main.min.css')); ?>" />
      <?php endif; ?>
      <link rel="stylesheet" href="<?php echo e(URL::asset('vendor/overlay-scroll/OverlayScrollbars.min.css')); ?>" />
      <!-- Theme style -->
      <style>
         .scroll250 {
         max-height: 250px;
         overflow-y: auto;
         }
      </style>
   </head>
   <body <?php if(Request::is('/')): ?> class="page-wrapper" <?php endif; ?> >
   <div class="page-wrapper">
      <?php if(Request::is('/') ): ?>
      <!-- Auth container starts -->
      <div class="auth-container">
         <div class="d-flex justify-content-center">
            <?php else: ?>
            <div class="main-container">
               <nav id="sidebar" class="sidebar-wrapper">
                  <!-- App brand starts -->
                  <div class="app-brand p-3 my-2">
                     <a href="#">
                     <img src="<?php echo e(URL::asset('images/logo.png')); ?>" class="logo" alt="Naresh Luckydraw" />
                     </a>
                  </div>
                  <!-- App brand ends -->
                  <!-- Sidebar menu starts -->
                  <div class="sidebarMenuScroll">
                     <ul class="sidebar-menu">
                        <li class="<?php echo e(request()->is('dashboard') ? 'active current-page' : ''); ?>"><a href="<?php echo e(route('dashboard')); ?>"><i class="bi bi-bar-chart-line"></i><span class="menu-text">Dashboard</span></a></li>
                        <li class="treeview <?php echo e(request()->is('sales/*') ? 'active current-page' : ''); ?>">
                           <a href="#!"><i class="bi bi-box"></i><span class="menu-text">Manage Sales</span></a>
                           <ul class="treeview-menu">
                              <li><a href="<?php echo e(route('sales.new_sale')); ?>" class="<?php echo e(request()->routeIs('sales.new_sale') ? 'active' : ''); ?>">Make Sale</a></li>
                              <li><a href="<?php echo e(route('sales.view_sale')); ?>" class="<?php echo e(request()->routeIs('sales.view_sale') ? 'active' : ''); ?>">View Sales</a></li>
                           </ul>
                        </li>
                        <li class="<?php echo e(request()->is('product') ? 'active current-page' : ''); ?>"><a href="<?php echo e(route('product')); ?>" ><i class="bi bi-credit-card-2-front-fill"></i><span class="menu-text">View Products</span></a></li>
                        <li class="<?php echo e(request()->is('wallet_transaction') ? 'active current-page' : ''); ?>"><a href="<?php echo e(route('wallet_transaction')); ?>"><i class="bi bi-code-square"></i><span class="menu-text">Wallet Transactions</span></a></li>
                        <li class="treeview <?php echo e(request()->is('manage_customer/*') ? 'active current-page' : ''); ?>">
                           <a href="#!"><i class="bi bi-emoji-laughing"></i><span class="menu-text">Manage Customers</span></a>
                           <ul class="treeview-menu">
                              <li><a href="<?php echo e(route('manage_customer.add_new_customer')); ?>" class="<?php echo e(request()->routeIs('manage_customer.add_new_customer') ? 'active' : ''); ?>">Add New Customer</a></li>
                              <li><a href="<?php echo e(route('manage_customer.bulk_customer')); ?>" class="<?php echo e(request()->routeIs('manage_customer.bulk_customer') ? 'active' : ''); ?>">Bulk Customers</a></li>
                              <li><a href="<?php echo e(route('manage_customer.view_customer')); ?>" class="<?php echo e(request()->routeIs('manage_customer.view_customer') ? 'active' : ''); ?>">View Customers</a></li>
                              <li><a href="<?php echo e(route('manage_customer.manage_customer_group')); ?>" class="<?php echo e(request()->routeIs('manage_customer.manage_customer_group') ? 'active' : ''); ?>">Manage Customer Groups</a></li>
                           </ul>
                        </li>
                        <li><a href="#"><i class="bi bi-aspect-ratio"></i><span class="menu-text">Historical Data</span></a></li>
                        <li class="<?php echo e(request()->is('support') ? 'active current-page' : ''); ?>"><a href="<?php echo e(route('support')); ?>" ><i class="bi bi-headphones"></i><span class="menu-text">Support</span></a></li>
                     </ul>
                  </div>
                  <!-- Sidebar menu ends -->
               </nav>
               <div class="app-container">
                  <div class="app-header d-flex align-items-center">
                     <!-- Toggle buttons starts -->
                     <div class="d-flex">
                        <button class="toggle-sidebar">
                        <i class="bi bi-list lh-1"></i>
                        </button>
                        <button class="pin-sidebar">
                        <i class="bi bi-list lh-1"></i>
                        </button>
                     </div>
                     <!-- Toggle buttons ends -->
                     <!-- App brand sm starts -->
                     <div class="app-brand-sm d-lg-none d-flex">
                        <!-- Logo sm starts -->
                        <a href="index.html">
                        <img src="<?php echo e(URL::asset('images/logo-sm.svg')); ?>" class="logo" alt="Naresh Luckydraw">
                        </a>
                        <!-- Logo sm end -->
                     </div>
                     <?php 
                         $user = Session::get('user');
                         $countries = App\Models\Country::find($user['country_id']);
                         $words = explode(' ', $countries->country_name); // Split words
                         $initials = implode(' ', array_map(fn($word) => strtoupper($word[0]), $words)); // Get first letter
                         $sales = App\Models\Sale::where('partner_id',$user['id'])->count('id');
                         $Sale_notify = App\Models\Sale::select(
                         'customers.profile_image',
                         'customers.first_name',
                         'luckydraws.luckydraw_name',
                         'luckydraws.ticket_id',
                         'luckydraws.price'
                         )
                         ->join('customers', 'customers.customer_id', '=', 'sales.customer_id') // Join customers
                         ->join('luckydraws', 'luckydraws.id', '=', 'sales.luckydraw_id') // Join luckydraws
                         ->where('sales.partner_id', $user['id'])->orderby('sales.created_at')->limit(2)
                         ->get();
                     ?>
                     <!-- App brand sm ends -->
                     <!-- Page title starts -->
                     <h5 class="m-0 ms-2 fw-semibold"><?php echo e($user['business_name']); ?>,<?php echo e($countries->country_name); ?></h5>
                     <!-- Page title ends -->
                     <!-- App header actions starts -->
                     <div class="header-actions">
                        <!-- Header action bar starts -->
                        <div class="bg-white p-2 rounded-4 d-flex align-items-center">
                           <!-- Header actions start -->
                           <div class="d-sm-flex d-none">
                              <div class="dropdown">
                                 <a class="dropdown-toggle d-flex p-3 position-relative" href="#!" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                 <i class="bi bi-receipt fs-4 lh-1"></i>
                                 <span class="count-label bg-danger"><?php echo e($sales); ?></span>
                                 </a>
                                 <div class="dropdown-menu dropdown-menu-end dropdown-menu-sm">
                                    <h5 class="fw-semibold px-3 py-2 text-primary">Latest Sales</h5>
                                    <div class="scroll250">
                                       <?php $__currentLoopData = $Sale_notify; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Sale_notifys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <div class="dropdown-item">
                                          <div class="d-flex align-items-center py-2">
                                             <img src="https://crm1.microsharp.net/uploads/profile/<?php echo e($Sale_notifys->profile_image); ?>" class="img-3x me-3 rounded-5" alt="Naresh Luckydraw" />
                                             <div class="m-0">
                                                <h4 class="mb-2 text-primary">€<?php echo e($Sale_notifys->price); ?></h4>
                                                <h6 class="mb-1 fw-semibold"><?php echo e($Sale_notifys->first_name); ?> </h6>
                                                <p class="m-0 text-secondary">
                                                   Invoice #<?php echo e($Sale_notifys->ticket_id); ?><span class="badge bg-success ms-2">Online</span>
                                                </p>
                                             </div>
                                          </div>
                                       </div>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <div class="d-grid m-3">
                                       <a href="<?php echo e(route('sales.view_sale')); ?>" class="btn btn-primary">View All Sales</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- Header actions end -->
                           <!-- User settings start -->
                           <div class="dropdown ms-2">
                              <a id="userSettings" class="dropdown-toggle user-settings" href="#!" role="button"
                                 data-bs-toggle="dropdown" aria-expanded="false">
                                 <span class="me-2 text-truncate d-lg-block d-none"><?php if($user['prefix'] == 1): ?> <?php echo e('Mr'); ?> <?php else: ?> <?php echo e('Ms'); ?> <?php endif; ?> . <?php echo e($user['poc_first_name']); ?></span>
                                 <div class="icon-box md rounded-4 fw-bold bg-primary-subtle text-primary"><?php echo e($initials); ?></div>
                              </a>
                              <div class="dropdown-menu dropdown-menu-end shadow-lg">
                                 <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('profile')); ?>"><i class="bi bi-person fs-4 me-2"></i>My Profile</a>
                                 <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('setting')); ?>"><i class="bi bi-gear fs-4 me-2"></i>Account Settings</a>
                                 <div class="mx-3 my-2 d-grid"><a href="<?php echo e(route('logout')); ?>" class="btn btn-warning">Logout</a></div>
                              </div>
                           </div>
                           <!-- User settings end -->
                        </div>
                        <!-- Header action bar ends -->
                     </div>
                     <!-- App header actions ends -->
                  </div>
                  <!-- App header ends -->
                  <!-- App body starts -->
                  <div class="app-body">
                     <?php endif; ?>
                     <?php if(session('success')): ?>
                     <div class="alert alert-success" role="alert">
                        <?php echo e(session('success')); ?>

                     </div>
                     <?php elseif(session('error')): ?>
                     <div class="alert alert-danger" role="alert">
                        <?php echo e(session('error')); ?>

                     </div>
                     <?php endif; ?>
                     <?php echo $__env->yieldContent('content'); ?>
                     <?php if(Request::is('/') ): ?>      
                  </div>
               </div>
               <!-- Auth container ends -->
               <?php else: ?>
            </div>
            <div class="app-footer">
               <span class="small">&copy;2025 Naresh Luckydraw</span>
            </div>
            <!-- App footer ends -->
         </div>
      </div>
      <?php endif; ?>
   </div>
   <?php if(Request::is('dashboard') ): ?>
   <!-- Required jQuery first, then Bootstrap Bundle JS -->
   <script src="<?php echo e(URL::asset('js/jquery.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('js/bootstrap.bundle.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('js/moment.min.js')); ?>"></script>
   <!-- *************
      ************ Vendor Js Files *************
      ************* -->
   <!-- Overlay Scroll JS -->
   <script src="<?php echo e(URL::asset('vendor/overlay-scroll/jquery.overlayScrollbars.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('vendor/overlay-scroll/custom-scrollbar.js')); ?>"></script>
   <!-- Apex Charts -->
   <script src="<?php echo e(URL::asset('vendor/apex/apexcharts.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('vendor/apex/custom/analytics/stats.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('vendor/apex/custom/analytics/sales.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('vendor/apex/custom/analytics/views.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('vendor/apex/custom/analytics/audiences.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('vendor/apex/custom/analytics/orders.js')); ?>"></script>
   <!-- Vector Maps -->
   <script src="<?php echo e(URL::asset('vendor/jvectormap/jquery-jvectormap-2.0.5.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('vendor/jvectormap/world-mill-en.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('vendor/jvectormap/gdp-data.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('vendor/jvectormap/continents-mill.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('vendor/jvectormap/custom/world-map-markers4.js')); ?>"></script>
   <!-- Rating -->
   <script src="<?php echo e(URL::asset('vendor/rating/raty.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('vendor/rating/raty-custom.js')); ?>"></script>
   <!-- Custom JS files -->
   <script src="<?php echo e(URL::asset('js/custom.js')); ?>"></script>
   <?php elseif(Request::is('setting') || Request::is('setting#*')): ?>
   <!-- Required jQuery first, then Bootstrap Bundle JS -->
   <script src="<?php echo e(URL::asset('js/jquery.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('js/bootstrap.bundle.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('js/moment.min.js')); ?>"></script>
   <!-- *************
      ************ Vendor Js Files *************
      ************* -->
   <!-- Overlay Scroll JS -->
   <script src="<?php echo e(URL::asset('vendor/overlay-scroll/jquery.overlayScrollbars.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('vendor/overlay-scroll/custom-scrollbar.js')); ?>"></script>
   <!-- Custom JS files -->
   <script src="<?php echo e(URL::asset('js/custom.js')); ?>"></script>
   <?php elseif(Request::is('profile')): ?>
   <script src="<?php echo e(URL::asset('js/jquery.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('js/bootstrap.bundle.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('vendor/overlay-scroll/jquery.overlayScrollbars.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('vendor/overlay-scroll/custom-scrollbar.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/custom.js')); ?>"></script>
          <script src="<?php echo e(URL::asset('js/validations.js')); ?>"></script>
    
    <?php elseif(Request::is('sales/new_sale')): ?>
     <script src="<?php echo e(URL::asset('js/jquery.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('js/bootstrap.bundle.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('vendor/overlay-scroll/jquery.overlayScrollbars.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('vendor/overlay-scroll/custom-scrollbar.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/custom.js')); ?>"></script>
    <?php elseif(Request::is('sales/view_sale')): ?>
     <script src="<?php echo e(URL::asset('js/jquery.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('js/bootstrap.bundle.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('vendor/overlay-scroll/jquery.overlayScrollbars.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('vendor/overlay-scroll/custom-scrollbar.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/custom.js')); ?>"></script>
    <?php elseif(Request::is('wallet_transaction')): ?>
     <script src="<?php echo e(URL::asset('js/jquery.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/moment.min.js')); ?>"></script>

   <script src="<?php echo e(URL::asset('vendor/overlay-scroll/jquery.overlayScrollbars.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('vendor/overlay-scroll/custom-scrollbar.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/custom.js')); ?>"></script>
     <?php elseif(Request::is('wallet')): ?>
      <script src="<?php echo e(URL::asset('js/jquery.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/moment.min.js')); ?>"></script>

   <script src="<?php echo e(URL::asset('vendor/overlay-scroll/jquery.overlayScrollbars.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('vendor/overlay-scroll/custom-scrollbar.js')); ?>"></script>
   
   <script src="<?php echo e(URL::asset('vendor/apex/apexcharts.min.js')); ?>"></script>
      <script src="<?php echo e(URL::asset('vendor/apex/custom/orders/orders.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/custom.js')); ?>"></script>
     <script src="<?php echo e(URL::asset('js/custom.js')); ?>"></script>
    <?php elseif(Request::is('support')): ?>
     <script src="<?php echo e(URL::asset('js/jquery.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/moment.min.js')); ?>"></script>

   <script src="<?php echo e(URL::asset('vendor/overlay-scroll/jquery.overlayScrollbars.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('vendor/overlay-scroll/custom-scrollbar.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/custom.js')); ?>"></script>
    
     <?php elseif(Request::is('manage_customer/add_new_customer')): ?>
     <script src="<?php echo e(URL::asset('js/jquery.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/moment.min.js')); ?>"></script>

   <script src="<?php echo e(URL::asset('vendor/overlay-scroll/jquery.overlayScrollbars.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('vendor/overlay-scroll/custom-scrollbar.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/custom.js')); ?>"></script>
     <?php elseif(Request::is('manage_customer/bulk_customer')): ?>
     <script src="<?php echo e(URL::asset('js/jquery.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/moment.min.js')); ?>"></script>

<script src="<?php echo e(URL::asset('vendor/apex/apexcharts.min.js')); ?>"></script>
      <script src="<?php echo e(URL::asset('vendor/apex/custom/orders/orders.js')); ?>"></script>

   <script src="<?php echo e(URL::asset('vendor/overlay-scroll/jquery.overlayScrollbars.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('vendor/overlay-scroll/custom-scrollbar.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/custom.js')); ?>"></script>
      <?php elseif(Request::is('manage_customer/view_customer')): ?>
     <script src="<?php echo e(URL::asset('js/jquery.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/moment.min.js')); ?>"></script>

   <script src="<?php echo e(URL::asset('vendor/overlay-scroll/jquery.overlayScrollbars.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('vendor/overlay-scroll/custom-scrollbar.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/custom.js')); ?>"></script>
    
    <?php elseif(Request::is('manage_customer/manage_customer_group')): ?>
     <script src="<?php echo e(URL::asset('js/jquery.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/moment.min.js')); ?>"></script>

<script src="<?php echo e(URL::asset('vendor/apex/apexcharts.min.js')); ?>"></script>
      <script src="<?php echo e(URL::asset('vendor/apex/custom/orders/orders.js')); ?>"></script>

   <script src="<?php echo e(URL::asset('vendor/overlay-scroll/jquery.overlayScrollbars.min.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('vendor/overlay-scroll/custom-scrollbar.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/custom.js')); ?>"></script>
   <?php endif; ?>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script>
      $(document).ready(function () {
        //   alert('yes');
      $('.treeview').each(function () {
      if ($(this).find('.active').length > 0) {
        $(this).addClass('menu-open');
        $(this).children('.treeview-menu').show();
      }
      });
      $('.treeview > a').on('click', function (e) {
      e.preventDefault();
      var parent = $(this).parent();
      if (parent.hasClass('menu-open')) {
        parent.removeClass('menu-open');
        parent.children('.treeview-menu').slideUp();
      } else {
        $('.treeview.menu-open').removeClass('menu-open').children('.treeview-menu').slideUp();
        parent.addClass('menu-open');
        parent.children('.treeview-menu').slideDown();
      }
      });
      });
   </script>
   </body>
</html><?php /**PATH /home/crmtwo2/public_html/BusinessPartner/resources/views/layout.blade.php ENDPATH**/ ?>