
<?php $__env->startSection('title','Profile'); ?>
<?php $__env->startSection('content'); ?>



<!-- breadcrumb begin  -->
        <div class="breadcrumb-pok">
            <img class="br-shape-left" src="<?php echo e(URL::asset('img/breadcrumb/left-bg.png')); ?>" alt="">
            <img class="br-shape-right" src="<?php echo e(URL::asset('img/breadcrumb/right-bg.png')); ?>" alt="">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="breadcrumb-content">
                            <span class="subtitle">Profile</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb end  -->

        <!-- sign-up begin -->
        <div class="sign-up">
            <div class="container">
                <!--<div class="row justify-content-center">-->
                <!--    <div class="col-xl-8 col-lg-9 col-md-10">-->
                <!--        <div class="processing-steps">-->
                <!--            <div class="single-steps first-step current-step">-->
                <!--                <div class="part-icon">-->
                <!--                    <img src="<?php echo e(URL::asset('img/register/step-1.png')); ?>" alt="">-->
                <!--                </div>-->
                <!--                <div class="part-text">-->
                <!--                    <span class="step-line-title">Getting Started</span>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--            <div class="arrow-img">-->
                <!--                <img src="<?php echo e(URL::asset('img/register/arrow-1.png')); ?>" alt="" class="arrow-icon">-->
                <!--            </div>-->
                <!--            <div class="single-steps second-step">-->
                <!--                <div class="part-icon">-->
                <!--                    <img src="<?php echo e(URL::asset('img/register/step-2.png')); ?>" alt="">-->
                <!--                </div>-->
                <!--                <div class="part-text">-->
                <!--                    <span class="step-line-title">Contact Details</span>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--            <div class="arrow-img second">-->
                <!--                <img src="<?php echo e(URL::asset('img/register/arrow-2.png')); ?>" alt="" class="arrow-icon">-->
                <!--            </div>-->
                <!--            <div class="single-steps third-step">-->
                <!--                <div class="part-icon">-->
                <!--                    <img src="<?php echo e(URL::asset('img/register/step-3')); ?>.png" alt="">-->
                <!--                </div>-->
                <!--                <div class="part-text">-->
                <!--                    <span class="step-line-title">Documents</span>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--            <div class="arrow-img">-->
                <!--                <img src="<?php echo e(URL::asset('img/register/arrow-1.png')); ?>" alt="" class="arrow-icon">-->
                <!--            </div>-->
                <!--            <div class="single-steps last-step">-->
                <!--                <div class="part-icon">-->
                <!--                    <img src="<?php echo e(URL::asset('img/register/step-4.png' )); ?>" alt="">-->
                <!--                </div>-->
                <!--                <div class="part-text">-->
                <!--                    <span class="step-line-title">Finish</span>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-10">
                        <div class="poklotto-form" id="poklotto_register_form">
                            <h3 class="steps-heading-title title">Getting started</h3>
                            <div class="part-form">
                                <form method="post" action="<?php echo e(route('update_personal')); ?>" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-all-step">
                                        <div class="first-step-form per-step animate__animated blanked">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-2 col-md-2">
                                                    <label class="form-label">Gender<font color="red">*</font></label>
                                                    <select name="prefix" id="prefix" class="form-select gender-select">
                                                        <option>Select Perfix</option>
                                                        <option value="0" <?php if($customer->prefix == 0): ?> selected <?php endif; ?>>Mr &#9794;</option>
                                                        <option value="1" <?php if($customer->prefix == 1): ?> selected <?php endif; ?>>Miss &#9792;</option>
                                                        
                                                    </select>

                                                </div>
												<div class="col-xl-5 col-lg-5 col-md-5 col-sm-5">
                                                    <label for="first_name" class="form-label">First name<font color="red">*</font></label>
                                                    <input type="text" name="first_name" id="first_name" placeholder="Ex: John" value="<?php echo e($customer->first_name ?? ''); ?>" required>
                                                </div>
                                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5">
                                                    <label for="last_name" class="form-label">Last name</label>
                                                    <input type="text" name="last_name" id="last_name" placeholder="Ex: Doe" value="<?php echo e($customer->last_name ?? ''); ?>">
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6">
                                                    <label for="email" class="form-label">Mail address<font color="red">*</font></label>
                                                    <input type="email" name="email" id="email" placeholder="Ex: yourmail@address" required value="<?php echo e($customer->email ?? ''); ?>">
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6">
                                                    <label for="mobile" class="form-label">Mobile Number<font color="red">*</font></label>
                                                    <input type="text" name="mobile" id="mobile" placeholder="Ex: 919845012345" value="<?php echo e($customer->mobile ?? ''); ?>" \>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6">
                                                    <label for="birth-date" class="form-label">Date of birth<font color="red">*</font></label>
                                                    <div class="birth-date-element">
                                                        <input type="text" name="dob" id="birth-date" placeholder="Ex: 19/05/98"  value="<?php echo e($customer->dob ?? ''); ?>">
                                                        <span class="caln-icon">
                                                            <i class="fa-solid fa-calendar-days"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6">
                                                    <label for="profession_name" class="form-label">National ID<font color="red">*</font></label>
                                                    <input type="text" name="national_id_number" id="national_id_number" placeholder="Ex: ABC29382KFDJ."  value="<?php echo e($customer->national_id_number ?? ''); ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-6">
                                                    <label for="address_one" class="form-label">Address line 1<font color="red">*</font></label>
                                                    <input type="text" name="address_line_1" id="address_one" placeholder="There will be your first address line."  value="<?php echo e($customer->address_line_1 ?? ''); ?>">
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6">
                                                    <label for="address_two" class="form-label">Address line 2</label>
                                                    <input type="text" id="address_two" name="address_line_2" placeholder="There will be your second address line." ="<?php echo e($customer->address_line_2 ?? ''); ?>">
                                                </div>
											</div>
                                            <div class="row">
                                                <div class="col-xl-3 col-lg-3 col-md-3">
                                                    <label class="form-label">Country Name<font color="red">*</font></label>
                                                    <select name="country_id" id="country_id" class="form-select country-select" onchange="get_country($(this),<?php echo e($customer->state_id ?? ''); ?>)">
                                                        <?php $__currentLoopData = $country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countrys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($countrys->id); ?>" <?php if($countrys->id == $customer->country_id): ?> selected <?php endif; ?>><?php echo e($countrys->country_name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>

                                                </div>
                                                <div class="col-xl-3 col-lg-3 col-md-3">
                                                    <label class="form-label">State Name<font color="red">*</font></label>
                                                     <select name="state_id" id="state_id" class="form-select state-select" onchange="get_state($(this),<?php echo e($customer->city_id ?? ''); ?>)">
                                                       
                                                    </select>
                                                </div>
                                                <div class="col-xl-3 col-lg-3 col-md-3">
                                                    <label class="form-label">City Name<font color="red">*</font></label>
                                                     <select name="city_id" id="city_id" class="form-select city-select">
                                                      
                                                    </select>
                                                </div>
                                                <div class="col-xl-3 col-lg-3 col-md-3">
                                                    <label for="zip_code" class="form-label">PIN/ZIP Code</label>
                                                    <input type="text" name="zip_code" id="zip_code" placeholder="Ex: 123456" value="<?php echo e($customer->zip_code ?? ''); ?>">
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6">
                                                    <label for="profile_image" class="form-label">Profile Image</label>
                                                    <input type="file" name="profile_image" id="profile_image" <?php if($customer->profile_image == ''): ?> required <?php else: ?>  <?php endif; ?>>
                                                    
                                                     <?php if(isset($customer)): ?>
                                    			    <img src="<?php echo e(request()->getSchemeAndHttpHost()); ?>/uploads/customer/profile_image/<?php echo e($customer->profile_image ?? ''); ?>" style="width:100px;height:100px;">
                                    		        <?php endif; ?>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6">
                                                    <label for="national_id_photo" class="form-label">National ID Proof</label>
                                                    <input type="file" name="national_id_photo" id="national_id_photo" <?php if($customer->national_id_photo == ''): ?> required <?php else: ?>  <?php endif; ?>>
                                                    
                                                    <?php if(isset($customer)): ?>
                                    			    <img src="<?php echo e(request()->getSchemeAndHttpHost()); ?>/uploads/customer/national_id_photo/<?php echo e($customer->national_id_photo ?? ''); ?>" style="width:100px;height:100px;">
                                    		        <?php endif; ?>
                                                </div>
                                                <div class="agreement-article">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" required>
                                                    <label class="form-check-label" for="inlineCheckbox1">These website standard terms and conditions written on this webpage shall manage your use of our website, envesta accessible at envesta.template.</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" checked type="checkbox" id="inlineCheckbox2" value="option2" required>
                                                    <label class="form-check-label" for="inlineCheckbox2">These terms will be applied fully and affect to your use of this website. by using this Website, you agreed to accept all terms and conditions written in here. you must not use this website if you disagree with any of these website standard terms and conditions. these terms and conditions have been generated with the help of the terms and conditiions sample generator.</label>
                                                </div>
                                                
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" required>
                                                    <label class="form-check-label" for="inlineCheckbox3">Minors or people below 18 years old are not allowed to use this Website.</label>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <!--<div class="second-step-form per-step animate__animated">-->
                                            
                                        <!--</div>-->
                                         <input type="hidden" name="hidden_country" id="hidden_country" value="<?php echo e($customer->country_id ?? ''); ?>"/>
                                       <input type="hidden" name="hidden_state" id="hidden_state" value="<?php echo e($customer->state_id ?? ''); ?>"/>
                                       <input type="hidden" name="hidden_city" id="hidden_city" value="<?php echo e($customer->city_id ?? ''); ?>"/>
                                      
                                    </div>
                                    <div class="form-controller">
                                        <!--<button class="btn-pok prv-stp-btn disabled" id="prv-stp-btn">-->
                                        <!--    <i class="fa-solid fa-angles-left"></i>-->
                                        <!--</button>-->
                                        <button class="btn-pok" id="" type="submit">
                                            Update <i class="fa-solid fa-angles-right"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- sign-up end -->
            
         


<?php $__env->stopSection(); ?>


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    get_country($('#hidden_country'),$('#hidden_state'));
    get_state($('#hidden_state'),$('#hidden_city'));
});
     
     function get_country(val,id){
     console.log(id)
     $('#state_id').html('');
    var country_id = $(val).val();
    var state_id = $(id).val();
    console.log(state_id);
   
    $.ajax({
            url: "<?php echo e(url('profile/get_country')); ?>",
            type: "GET",
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                "country_id" :  country_id,
                
            },
            success: function(data) {
                console.log(data);
                // console.log(data['doneMessage']);
                 $('#state_id').append('<option value="">Choose State</option>')
                 $(data).each(function(key, value) {
                      var select = '';
                      if(state_id == value.id){
                          select = 'selected';
                      }
                      else{
                          select = '';
                      }
                    // console.log(value.address);
                    $('#state_id').append('<option value='+value.id+' '+select+'>'+value.state_title+'</option>')
                });
              

            }
        });
    }
    
    function get_state(val,id){
     console.log(id)
     $('#city_id').html('');
    var state_id = $(val).val();
    var city_id = $(id).val();
    console.log(state_id);
   
    $.ajax({
            url: "<?php echo e(url('profile/get_state')); ?>",
            type: "GET",
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                "state_id" :  state_id,
                
            },
            success: function(data) {
                console.log(data);
                // console.log(data['doneMessage']);
                 $('#city_id').append('<option value="">Choose City</option>')
                 $(data).each(function(key, value) {
                      var select = '';
                      if(city_id == value.id){
                          select = 'selected';
                      }
                      else{
                          select = '';
                      }
                    // console.log(value.address);
                    $('#city_id').append('<option value='+value.id+' '+select+'>'+value.name+'</option>')
                });
              

            }
        });
    }
</script>




<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/crm2amicrosharp/public_html/Customer/resources/views/profile.blade.php ENDPATH**/ ?>