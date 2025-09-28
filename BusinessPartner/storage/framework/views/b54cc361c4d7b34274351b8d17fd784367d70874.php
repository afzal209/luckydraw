
<?php $__env->startSection('title','Manage Customer Group'); ?>
<?php $__env->startSection('content'); ?>

              <div class="row gx-4">
                     <div class="col-xl-12 col-sm-12">
                        <!-- Card start -->
                        <div class="card">
                           <div class="card-header">
                              <h5 class="card-title">Customer Group Manager</h5>
                           </div>
                         
                           <div class="card-body">
                              <form class="row g-3 needs-validation" novalidate method="POST" action="<?php echo e(isset($customer_group_edit) ? route('manage_customer.manage_customer_group.update_group', $customer_group_edit->id) : route('manage_customer.manage_customer_group.create_group')); ?>">
                                  <?php echo csrf_field(); ?>
                                  
                                 <div class="m-0">
                                    <label class="form-label" for="abc">Group Name</label>
                                    <input type="text" class="form-control" name="group_name" id="group_name" value="<?php echo e($customer_group_edit->group_name ?? ''); ?>" required>
                                         <?php $__errorArgs = ['group_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="error"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                 </div>
                                 <div class="col-sm-12 col-12">
                                    <div class="card mb-12">
                                        <?php if(!isset($customer_group_edit)): ?>
                                       <label class="form-label" for="abc">Choose One or More Customers</label>
                                        <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="checkbox" id="all_check" value="all">
                                             <label class="form-check-label" for="inlineCheckbox2">Select All Customer</label>
                                          </div>
                                          <?php endif; ?>
                                       <div class="card-body">
                                          <?php
                                          $selectedCustomers = explode(',', $customer_group_edit->customer_ids ?? ''); 

    // Get only the first value from the list
   
                                          
                                                        
                                                    ?>
                                           <?php $__currentLoopData = $customerId; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                           
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="checkbox" name="customer_ids[]" id="inlineCheckbox<?php echo e($customers->id); ?>" value="<?php echo e($customers->id); ?>" <?php if(in_array($customers->id, $selectedCustomers)): ?> checked <?php endif; ?>>
                                             <label class="form-check-label" for="inlineCheckbox<?php echo e($customers->id); ?>"><?php echo e($customers->first_name); ?> - <?php echo e($customers->customer_id); ?></label>
                                          </div>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-12">
                                    <button class="btn btn-primary" type="submit"><i class="bi bi-palette2"></i><?php if(isset($customer_group_edit)): ?> Update a Customer Group <?php else: ?> Create a Customer Group <?php endif; ?></button>
                                 </div>
                              </form>
                           </div>
                        </div>
                        <!-- Card end -->
                     </div>
                  </div>
                  <!-- Row ends -->
                  <!-- Row starts -->
                  <div class="row">
                     <div class="col-sm-12">
                        <br>
                     </div>
                  </div>
                  <!-- Row ends -->
                  <!-- Row starts -->
                  <div class="row gx-4">
                      <?php $__currentLoopData = $customer_group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer_groups): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <div class="col-xl-4 col-sm-6 col-12">
                        <div class="card mb-4">
                           <div class="card-body">
                              <div class="d-grid gap-2">
                                 <div class="form-check">
                                    <label class="form-check-label" for="flexCheckDefault"><?php echo e($customer_groups->group_name); ?></label>
                                 </div>
                                 <div class="form-check">
                                    <label class="form-check-label" for="flexCheckChecked"><small class="badge bg-primary">Total <?php echo e($customer_groups->value_count); ?> Subscribers</small></label>
                                 </div>
                                 <div class="col-sm-12 col-12">
                                    <div class="card mb-12">
                                       <div class="card-body">
                                          <div class="form-check form-check-inline">
                                             <!--<button class="btn btn-info" type="submit"><i class="bi bi-palette2"></i> View</button>-->
                                             <a href="<?php echo e(route('manage_customer.manage_customer_group.edit_group',$customer_groups->id)); ?>" class="btn btn-primary"><i class="bi bi-palette2"></i>View & Edit</a>
                                             <!--<button class="btn btn-primary" type="submit"><i class="bi bi-palette2"></i> Edit</button>-->
                                             <a href="<?php echo e(route('manage_customer.manage_customer_group.delete_group',$customer_groups->id)); ?>" class="btn btn-danger" ><i class="bi bi-palette2"></i> Delete</a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <!--               <div class="col-xl-4 col-sm-6 col-12">-->
      <!--                  <div class="card mb-4">-->
      <!--                     <div class="card-body">-->
      <!--                        <div class="d-grid gap-2">-->
      <!--                           <div class="form-check">-->
      <!--                              <label class="form-check-label" for="flexCheckDefault">Monthly Ticket Buyers</label>-->
      <!--                           </div>-->
      <!--                           <div class="form-check">-->
      <!--                              <label class="form-check-label" for="flexCheckChecked"><small class="badge bg-primary">Total 100 Subscribers</small></label>-->
      <!--                           </div>-->
      <!--                           <div class="col-sm-12 col-12">-->
      <!--                              <div class="card mb-12">-->
      <!--                                 <div class="card-body">-->
      <!--                                    <div class="form-check form-check-inline">-->
      <!--                                       <button class="btn btn-info" type="submit"><i class="bi bi-palette2"></i> View</button>-->
      <!--                                       <button class="btn btn-primary" type="submit"><i class="bi bi-palette2"></i> Edit</button>-->
      <!--                                       <button class="btn btn-danger" type="submit"><i class="bi bi-palette2"></i> Delete</button>-->
      <!--                                    </div>-->
      <!--                                 </div>-->
      <!--                              </div>-->
      <!--                           </div>-->
      <!--                        </div>-->
      <!--                     </div>-->
      <!--                  </div>-->
      <!--               </div>-->
					 <!--<div class="col-xl-4 col-sm-6 col-12">-->
      <!--                  <div class="card mb-4">-->
      <!--                     <div class="card-body">-->
      <!--                        <div class="d-grid gap-2">-->
      <!--                           <div class="form-check">-->
      <!--                              <label class="form-check-label" for="flexCheckDefault">My Relatives - Monthly Ticket Buyers</label>-->
      <!--                           </div>-->
      <!--                           <div class="form-check">-->
      <!--                              <label class="form-check-label" for="flexCheckChecked"><small class="badge bg-primary">Total 15 Subscribers</small></label>-->
      <!--                           </div>-->
      <!--                           <div class="col-sm-12 col-12">-->
      <!--                              <div class="card mb-12">-->
      <!--                                 <div class="card-body">-->
      <!--                                    <div class="form-check form-check-inline">-->
      <!--                                       <button class="btn btn-info" type="submit"><i class="bi bi-palette2"></i> View</button>-->
      <!--                                       <button class="btn btn-primary" type="submit"><i class="bi bi-palette2"></i> Edit</button>-->
      <!--                                       <button class="btn btn-danger" type="submit"><i class="bi bi-palette2"></i> Delete</button>-->
      <!--                                    </div>-->
      <!--                                 </div>-->
      <!--                              </div>-->
      <!--                           </div>-->
      <!--                        </div>-->
      <!--                     </div>-->
      <!--                  </div>-->
      <!--               </div>-->
                  </div>
            
         


<?php $__env->stopSection(); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function() {
       $("#all_check").change(function() {
           $("input[name='customer_ids[]']").prop("checked", $(this).prop("checked"));
       });
   });
</script>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/crm2amicrosharp/public_html/BusinessPartner/resources/views/manage_customer/manage_customer_group.blade.php ENDPATH**/ ?>