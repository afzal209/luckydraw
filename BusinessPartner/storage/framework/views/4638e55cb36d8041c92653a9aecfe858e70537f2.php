
<?php $__env->startSection('title','Profile'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
                     <div class="col-sm-12">
                        <div class="card mb-4">
                           <div class="card-body">
						   	  <h5 class="m-0 ms-2 fw-semibold">My Profile</h5><br>
                              <form class="row g-3 needs-validation" novalidate method="POST" action="<?php echo e(route('profile.update')); ?>">
                                  <?php echo csrf_field(); ?>
                                 <div class="col-md-3 position-relative">
                                    <label for="validationCustomUsername" class="form-label">First Name<font color="red">*</font></label>
                                    <div class="input-group has-validation">
                                       <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-emoji-laughing"></i></span>
                                       <input type="text" class="form-control" name="poc_first_name" id="poc_first_name"  value="<?php echo e($business_partner->poc_first_name ?? ''); ?>" aria-describedby="inputGroupPrepend" required />
                                    </div>
                                 </div>
                                 <div class="col-md-3 position-relative">
                                    <label for="validationCustomUsername" class="form-label">Lastt Name</label>
                                    <div class="input-group has-validation">
                                       <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-emoji-laughing"></i></span>
                                       <input type="text" class="form-control" name="poc_last_name" id="poc_last_name" value="<?php echo e($business_partner->poc_last_name ?? ''); ?>" aria-describedby="inputGroupPrepend"  />
                                    </div>
                                 </div>                                 
                                 <div class="col-md-3 position-relative">
                                    <label for="validationCustomUsername" class="form-label">Email<font color="red">*</font></label>
                                    <div class="input-group has-validation">
                                       <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-mailbox"></i></span>
                                       <input type="text" class="form-control" name="poc_email" id="poc_email" value="<?php echo e($business_partner->poc_email ?? ''); ?>" aria-describedby="inputGroupPrepend" required />
                                    </div>
                                 </div>
                                 <div class="col-md-3 position-relative">
                                    <label for="validationCustomUsername" class="form-label">Phone Number<font color="red">*</font></label>
                                    <div class="input-group has-validation">
                                       <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-phone-fill"></i></span>
                                       <input type="text" class="form-control" name="poc_mobile" id="poc_mobile" value="<?php echo e($business_partner->poc_mobile ?? ''); ?>" aria-describedby="inputGroupPrepend" required />
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <label for="validationCustom03" class="form-label">Business Name<font color="red">*</font></label>
                                    <input type="text" class="form-control" name="business_name" id="business_name" value="<?php echo e($business_partner->business_name ?? ''); ?>" required />
                                 </div>
                                 <div class="col-md-6">
                                    <label for="validationCustom03" class="form-label">Address Line#1<font color="red">*</font></label>
                                    <input type="text" class="form-control" name="address_line_1" id="address_line_1" value="<?php echo e($business_partner->address_line_1 ?? ''); ?>"  required />
                                 </div>
                                 <div class="col-md-6">
                                    <label for="validationCustom03" class="form-label">Address Line#2</label>
                                    <input type="text" class="form-control" name="address_line_2" id="address_line_2" value="<?php echo e($business_partner->address_line_2 ?? ''); ?>" />
                                 </div>                                 
                                 
                                 <div class="col-md-3">
                                    <label for="validationCustom04" class="form-label">Country<font color="red">*</font></label>
                                    <select class="form-select" id="country_id" name="country_id" required onchange="get_country($(this),<?php echo e($business_partner->state_id ?? ''); ?>);">
                                       <option  disabled value="">Choose Country</option>
                                       <?php $__currentLoopData = $country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countrys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <?php if($business_partner->country_id == $countrys->id): ?>
                                       <option value="<?php echo e($countrys->id); ?>" selected><?php echo e($countrys->country_name); ?></option>
                                       <?php else: ?>
                                       <option value="<?php echo e($countrys->id); ?>"><?php echo e($countrys->country_name); ?></option>
                                       <?php endif; ?>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                 </div>
                                 <div class="col-md-3">
                                    <label for="state_id" class="form-label">State<font color="red">*</font></label>
                                    <select class="form-select" id="state_id" name="state_id" required onchange="get_state($(this),<?php echo e($business_partner->city_id ?? ''); ?>);">
                                       <option selected disabled value="">Choose State</option>
                                       <option>Karnataka</option>
                                    </select>
                                 </div>
                                 <div class="col-md-3">
                                    <label for="city_id" class="form-label">City<font color="red">*</font></label>
                                    <!--<input type="text" class="form-control" id="validationCustom05" required />-->
                                    <select class="form-select" id="city_id" name="city_id" required>
                                       <option selected disabled value="">Choose State</option>
                                       
                                    </select>
                                 </div>
                                 <input type="hidden" name="hidden_country" id="hidden_country" value="<?php echo e($business_partner->country_id ?? ''); ?>"/>
                                  <input type="hidden" name="hidden_state" id="hidden_state" value="<?php echo e($business_partner->state_id ?? ''); ?>"/>
                                       <input type="hidden" name="hidden_city" id="hidden_city" value="<?php echo e($business_partner->city_id ?? ''); ?>"/>
                                 
                                 <div class="col-md-3">
                                    <label for="validationCustom04" class="form-label">ZIP/PIN Code<font color="red">*</font></label>
                                    <input type="text" class="form-control" id="zip_code" name="zip_code" required value="<?php echo e($business_partner->zip_code); ?>" />
                                 </div>
                                 <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Update My Profile</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Row ends -->
                  <!-- Row starts -->
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="card mb-4">
                           <div class="card-body">
						   	  <h5 class="m-0 ms-2 fw-semibold">Change Password</h5><br>
                              <form class="row g-3 needs-validation" novalidate method="POST" action="<?php echo e(route('profile.update_passord')); ?>">
                                  <?php echo csrf_field(); ?>
                                 <div class="col-md-3 position-relative">
                                    <label for="validationTooltip01" class="form-label">Current Password<font color="red">*</font></label>
                                    <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter the Current Password" required />
                                 </div>
                                 <div class="col-md-3 position-relative">
                                    <label for="validationTooltip01" class="form-label">New Password<font color="red">*</font></label>
                                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter the New Password" required />
                                 </div>
                                 <div class="col-md-3 position-relative">
                                    <label for="validationTooltip01" class="form-label">Confirm Password<font color="red">*</font></label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter the New Password" required />
                                 </div>
                                 <div class="col-md-3 position-relative">
                                    <label for="validationTooltip01" class="form-label">&nbsp;</label><br>
                                    <button class="btn btn-primary" type="submit">Update My Password</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>


<?php $__env->stopSection(); ?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>

$(document).ready(function() {
   get_country($('#hidden_country'),$('#hidden_state').val())
    get_state($('#hidden_state'),$('#hidden_city').val()); 
});

     function get_country(val,id){
    //  console.log(id)
     $('#state_id').html('');
      $('#city_id').html('');
    var country_id = $(val).val();
    var state_id = id;
    // console.log(region_id);
   
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
                 $('#state_id').append('<option>Select State</option>')
                 $(data).each(function(key, value) {
                      var select = '';
                      if(state_id == value.id){
                          select = 'selected';
                      }
                      else{
                          select = '';
                      }
                //     // console.log(value.address);
                    $('#state_id').append('<option value='+value.id+' '+select+'>'+value.state_title+'</option>')
                });
              

            }
        });
    }
    
    function get_state(val,id){
        
        $('#city_id').html('');
         var state_id = $(val).val();
         var city_id = id;
             $.ajax({
            url: "<?php echo e(url('profile/get_state')); ?>",
            type: "GET",
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                "state_id" :  state_id,
                
            },
            success: function(data) {
                // console.log(data);
                // console.log(data['doneMessage']);
                 $('#city_id').append('<option>Select City</option>')
                 $(data).each(function(key, value) {
                      var select = '';
                      if(city_id == value.id){
                          select = 'selected';
                      }
                      else{
                          select = '';
                      }
                //     // console.log(value.address);
                    $('#city_id').append('<option value='+value.id+' '+select+'>'+value.name+'</option>')
                });
              

            }
        });

    }
    
</script>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/crmtwo2/public_html/BusinessPartner/resources/views/profile.blade.php ENDPATH**/ ?>