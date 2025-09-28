
<?php $__env->startSection('title','View Customer'); ?>
<?php $__env->startSection('content'); ?>

             <div class="row gx-4">
                     <div class="col-sm-12">
                        <div class="card mb-3">
                           <div class="card-header">
                              <h5 class="card-title">My Customers</h5>
                           </div>
                           <div class="card-body">
                              <div class="table-outer">
                                 <div class="table-responsive">
                                    <table class="table align-middle table-hover m-0 truncate">
                                       <thead>
                                          <tr>
                                             <th scope="col">Customer</th>
                                             <th scope="col">Details</th>
                                             <th scope="col">Address</th>
                                             <th scope="col">Age</th>
                                             <th scope="col">Since</th>
                                             <th scope="col">Revenue</th>
                                             <th scope="col">Status</th>
                                             <th scope="col">Actions</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                           <?php
                                                use Carbon\Carbon;
                                            ?>
                                           
                                           <?php $__currentLoopData = $customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <?php
                                                $dob = Carbon::parse($customers->dob);
                                                $today = Carbon::now();
                                                $years = $today->diffInYears($dob);
                                                $months = $today->diffInMonths($dob) % 12;
                                            ?>
                                          <tr>
                                             <td><div class="d-flex align-items-center">
    <img class="rounded-circle img-3x me-2" src="<?php echo e(request()->getSchemeAndHttpHost()); ?>/uploads/customer/profile/<?php echo e($customers->profile_image); ?>" alt="Prabhakar">
    <span class="fw-bold"><?php echo e($customers->customer_id); ?></span>
</div></td>
                                             <td><?php echo e($customers->first_name); ?><br><?php echo e($customers->email); ?><br><?php echo e($customers->mobile); ?></td>
                                             <td><?php echo e($customers->address_line_1); ?><br><?php echo e($customers->address_line_2); ?></td>
                                             <td><?php echo e($months); ?> Years</td>
                                             <td><?php echo e(Carbon::parse($customers->created_at)->format('Y-m-d')); ?></td>
                                             <td></td>
											 <td><?php if($customers->status == 1): ?>
											 <span class="badge border border-success text-primary">Active</span>
											    <?php else: ?>
											    <span class="badge border border-danger text-danger">In-Active</span>
											    <?php endif; ?>
											 
                                             <td>
                                                <a class="btn btn-info btn-icon btn-sm mb-1" href="<?php echo e(route('manage_customer.add_new_customer.edit',$customers->id)); ?>"><i class="bi bi-pencil"></i> Edit</a>
												<a class="btn btn-primary btn-icon btn-sm mb-1" href="#"><i class="bi bi-trash"></i> View Tx</a>
                                             </td>
                                          </tr>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!--                              <tr>-->
            <!--                                 <td> <img class="rounded-circle img-3x me-2" src="<?php echo e(URL::asset('images/user3.png')); ?>" alt="Naresh Lottery"> </td>-->
            <!--                                 <td>Prabhakar<br>prabhakar.test@gmail.com<br>+333 060 3230</td>-->
            <!--                                 <td>85 Great Portland St,First Floor,London</td>-->
            <!--                                 <td>31 Years</td>-->
            <!--                                 <td>18/01/2025</td>-->
            <!--                                 <td>$92,000</td>-->
											 <!--<td><span class="badge border border-danger text-danger">In-Active</span></td>-->
            <!--                                 <td>-->
            <!--                                    <a class="btn btn-info btn-icon btn-sm mb-1" href="#"><i class="bi bi-pencil"></i> Edit</a>-->
												<!--<a class="btn btn-primary btn-icon btn-sm mb-1" href="#"><i class="bi bi-trash"></i> View Tx</a>-->
            <!--                                 </td>-->
            <!--                              </tr>-->
            <!--                              <tr>-->
            <!--                                 <td> <img class="rounded-circle img-3x me-2" src="<?php echo e(URL::asset('images/user4.png')); ?>" alt="Naresh Lottery"> </td>-->
            <!--                                 <td>Shailaja<br>Shailaja.123@rediffmail.com<br>+1 3456 78899</td>-->
            <!--                                 <td>19 W 34th St. #1018, New York, <br>NY 10001, United States, 12345</td>-->
            <!--                                 <td>24 Years</td>-->
            <!--                                 <td>01/01/2024</td>-->
            <!--                                 <td>$1,000</td>-->
											 <!--<td><span class="badge border border-success text-primary">Active</span></td>-->
            <!--                                 <td>-->
            <!--                                    <a class="btn btn-info btn-icon btn-sm mb-1" href="#"><i class="bi bi-pencil"></i> Edit</a>-->
												<!--<a class="btn btn-primary btn-icon btn-sm mb-1" href="#"><i class="bi bi-trash"></i> View Tx</a>-->
            <!--                                 </td>-->
            <!--                              </tr>-->
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
            
         


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/crmtwo2/public_html/BusinessPartner/resources/views/manage_customer/view_customer.blade.php ENDPATH**/ ?>