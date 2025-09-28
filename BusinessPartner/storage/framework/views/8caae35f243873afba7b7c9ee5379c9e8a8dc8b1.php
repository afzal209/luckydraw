
<?php $__env->startSection('title','Add New Customer'); ?>
<?php $__env->startSection('content'); ?>

         
         <div class="row gx-4">
                     <div class="col-sm-12">
                        <div class="card">
                           <div class="card-body">
                              <!-- Row starts -->
                              <div class="row">
                                   <form method="POST" action="<?php echo e(isset($customer_edit) ? route('manage_customer.add_new_customer.update', $customer_edit->id) : route('manage_customer.add_new_customer.create')); ?>">
                                       <?php echo csrf_field(); ?>
                                 <div class="col-xxl-12 col-sm-6 col-12">
                                    <!-- Row starts -->
                                    <div class="row gx-12">
                                       <div class="col-12">
                                          <h5 class="fw-semibold mb-3">Customer Details</h5>
                                       </div>
                                       
                                               
                                          
                                       <div class="col-4">
                                          
                                          <!-- Form group start -->
                                          <div class="mb-3">
                                             <label for="customerName" class="form-label">Customer Name<font color="red">*</font></label>
                                             <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Enter Customer Name" value="<?php echo e($customer_edit->first_name ?? ''); ?>">
                                          </div>
                                          <!-- Form group end -->
                                       </div>
                                       <div class="col-3">
                                          <!-- Form group start -->
                                          <div class="mb-3">
                                             <label for="invNumber" class="form-label">Customer Email<font color="red">*</font></label>
                                             <input type="text" name="customer_mail" id="customer_mail" class="form-control" placeholder="Enter Valid Email" value="<?php echo e($customer_edit->email ?? ''); ?>">
                                          </div>
                                          <!-- Form group end -->
                                       </div>
                                       <div class="col-sm-4 col-12">
                                          <!-- Form group start -->
                                          <div class="mb-3">
                                             <label for="dateIssued" class="form-label">Phone Number<font color="red">*</font></label>
                                             <input type="text" name="customer_phone" id="customer_phone" class="form-control" placeholder="Enter Phone Number Prefix Without 00 & +" value="<?php echo e($customer_edit->mobile ?? ''); ?>">
                                          </div>
                                          <!-- Form group end -->
                                       </div>
                                    </div>
                                    <!-- Row ends -->
                                 </div>
                                 <div class="col-12">
                                    <div class="d-flex justify-content-end gap-1">
                                       <button type="submit" class="btn btn-dark"><i class="bi bi-cloud-arrow-up-fill"></i><?php if(isset($customer_edit)): ?> Update Customer <?php else: ?> Create New Customer <?php endif; ?></button>
                                       <a href="<?php echo e(route('manage_customer.view_customer')); ?>" class="btn btn-success"><i class="bi bi-cancel"></i> Cancel</a>
                                    </div>
                                 </div>
                                </form>
                              </div>
                              <!-- Row ends -->
                           </div>
                        </div>
                     </div>
                  </div>

<?php $__env->stopSection(); ?>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
  
});

  
</script>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/crm2amicrosharp/public_html/BusinessPartner/resources/views/manage_customer/add_new_customer.blade.php ENDPATH**/ ?>