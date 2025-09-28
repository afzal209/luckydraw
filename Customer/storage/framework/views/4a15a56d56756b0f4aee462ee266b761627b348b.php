
<?php $__env->startSection('title','Luckydraw'); ?>
<?php $__env->startSection('content'); ?>
     <!-- breadcrumb begin  -->
      <div class="breadcrumb-pok">
         <img class="br-shape-left" src="<?php echo e(URL::asset('img/breadcrumb/left-bg.png' )); ?>" alt="">
         <img class="br-shape-right" src="<?php echo e(URL::asset('img/breadcrumb/right-bg.png' )); ?>" alt="">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-xl-7 col-lg-8">
                  <div class="breadcrumb-content">
                     <span class="subtitle">UBG Luckydraw</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
    <!-- breadcrumb end  -->
    <!-- lottery begin -->
    <div class="lotteries">
<div class="container">
    <!-- Header Row -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">My Profile</h2>
        <div>
            <a class="btn-pok mid me-2" href="<?php echo e(route('profile')); ?>">
                Edit Profile <i class="fa-solid fa-user"></i>
            </a>
            <a class="btn-pok mid" href="<?php echo e(route('logout')); ?>">
                Logout <i class="fa-solid fa-lock"></i>
            </a>
        </div>
    </div>

    <!-- Profile Content -->
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-6">
            <div class="card position-relative">
                <!-- Top Right Images -->
                <div class="position-absolute top-0 end-0 m-2 text-center">
                    <img src="<?php echo e(request()->getSchemeAndHttpHost()); ?>/uploads/customer/profile_image/<?php echo e($customer->profile_image ?? ''); ?>" style="width:100px;height:100px;">
                </div>
                <div class="card-body">
                    <p><strong>Customer ID:</strong> <?php echo e($customer->customer_id); ?></p>
                    <p><strong>Name:</strong> <?php echo e($customer->first_name); ?> <?php echo e($customer->last_name); ?></p>
                    <p><strong>Email:</strong> <?php echo e($customer->email); ?></p>
                    <p><strong>Mobile:</strong> <?php echo e($customer->mobile); ?></p>
                    <p><strong>Address:</strong> <?php echo e($customer->address_line_1); ?> <?php echo e($customer->address_line_2); ?></p>
                    <p><strong>Country:</strong> <?php echo e($customer->country_name); ?> | <strong>State:</strong> <?php echo e($customer->state_name); ?></p>
                    <p><strong>City:</strong> <?php echo e($customer->city_name); ?></p>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6">
            <div class="card position-relative">
                <!-- Top Right Images -->
                <div class="position-absolute top-0 end-0 m-2 text-center">
                    <img src="<?php echo e(request()->getSchemeAndHttpHost()); ?>/uploads/customer/national_id_photo/<?php echo e($customer->national_id_photo ?? ''); ?>" style="width:100px;height:100px;">
                </div>
                <div class="card-body">
                    <p><strong>DOB:</strong> <?php echo e($customer->dob); ?></p>
                    <p><strong>Timezone:</strong> <?php echo e($customer->timezone); ?></p>
                    <p><strong>Account Since :</strong> <?php echo e($customer->created_at); ?></p>
                    <p><strong>Last Updated :</strong> <?php echo e($customer->updated_at); ?></p>
                    <p><strong>Status:</strong> <?php echo e($customer->status == 1 ? 'Active' : 'Inactive'); ?></p>
                    <p><strong>Nationality Number:</strong> <?php echo e($customer->national_id_number); ?></p>
                    <p><strong>Zip:</strong> <?php echo e($customer->zip_code); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/crm2amicrosharp/public_html/Customer/resources/views/customers/profile.blade.php ENDPATH**/ ?>