
<?php $__env->startSection('title','Dashboard'); ?>
<?php $__env->startSection('content'); ?>

           <div class="row gx-4">
                     <div class="col-xxl-3 col-sm-6 col-12">
                        <div class="card mb-4">
                           <div class="card-body">
                              <div class="d-flex align-items-center">
                                 <div class="p-1 border border-primary rounded-circle me-3">
                                    <div id="radial1"></div>
                                 </div>
                                 <div class="d-flex flex-column">
                                    <h2 class="lh-1"><?php echo e($tickets); ?></h2>
                                    <p class="m-0 opacity-50">Tickets Sold</p>
                                 </div>
                              </div>
                              <div class="d-flex align-items-center justify-content-between mt-1">
                                 <a class="text-primary" href="<?php echo e(route('sales.view_sale')); ?>">
                                 <span>View All Sales</span><i class="bi bi-arrow-right ms-2"></i></a>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xxl-3 col-sm-6 col-12">
                        <div class="card mb-4">
                           <div class="card-body">
                              <div class="d-flex align-items-center">
                                 <div class="p-1 border border-success rounded-circle me-3">
                                    <div id="radial2"></div>
                                 </div>
                                 <div class="d-flex flex-column">
                                    <h2 class="lh-1"><?php echo e($luckydraw->value_count); ?></h2>
                                    <p class="m-0 opacity-50">Luckydraws</p>
                                 </div>
                              </div>
                              <div class="d-flex align-items-center justify-content-between mt-1">
                                 <a class="text-primary" href="<?php echo e(route('product')); ?>">
                                 <span>View All Luckydraws</span><i class="bi bi-arrow-right ms-2"></i></a>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xxl-3 col-sm-6 col-12">
                        <div class="card mb-4">
                           <div class="card-body">
                              <div class="d-flex align-items-center">
                                 <div class="p-1 border border-info rounded-circle me-3">
                                    <div id="radial3"></div>
                                 </div>
                                 <div class="d-flex flex-column">
                                    <h2 class="lh-1"><?php echo e($customer); ?></h2>
                                    <p class="m-0 opacity-50">Customers</p>
                                 </div>
                              </div>
                              <div class="d-flex align-items-center justify-content-between mt-1">
                                 <a class="text-primary" href="<?php echo e(route('manage_customer.view_customer')); ?>">
                                 <span>View All Customers</span><i class="bi bi-arrow-right ms-2"></i></a>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xxl-3 col-sm-6 col-12">
                        <div class="card mb-4 bg-primary">
                           <div class="card-body text-white">
                              <div class="d-flex align-items-center">
                                 <div class="p-1 border border-white rounded-circle me-3">
                                    <div id="radial4"></div>
                                 </div>
                                 <div class="d-flex flex-column">
                                    <h2 class="m-0 lh-1">€ <?php echo e($wallet->wallet_amount); ?>/-</h2>
                                    <p class="m-0 opacity-50">My Wallet</p>
                                 </div>
                              </div>
                              <div class="d-flex align-items-center justify-content-between mt-1">
                                 <a class="text-white" href="<?php echo e(route('wallet_transaction')); ?>">
                                 <span>View All Transactions</span>
                                 <i class="bi bi-arrow-right ms-2"></i>
                                 </a>
                                 <div class="text-end">
                                    <a href="<?php echo e(route('wallet')); ?>" type="button" class="badge bg-danger text-white small">Load Amount</a>
                                 </div>
								<!-- Modal -->
								<div class="modal fade" id="exampleModalCenter" tabindex="-1"
								  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
								  <div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="exampleModalCenterTitle">
										  <font color="blue">Transaction Details</font>
										</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									  </div>
									  <div class="modal-body">
										<p>This is a vertically centered modal.</p>
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-dark" data-bs-dismiss="modal">
										  Close
										</button>
										<button type="button" class="btn btn-primary">
										  Submit My Tx
										</button>
									  </div>
									</div>
								  </div>
								</div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  
                  <div class="row gx-4">
                     <div class="col-xxl-6 col-sm-12 col-12">
                        <div class="card mb-4 card-height-420">
                           <div class="card-header">
                              <h5 class="card-title">Sales Summary</h5>
                           </div>
                           <div class="card-body">
                              <div class="graph-body auto-align-graph">
                                 <!-- <div id="orders"></div> -->
                                 <div id="sales"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xxl-3 col-sm-6 col-12">
                        <div class="card mb-4 card-height-420">
                           <div class="card-header">
                              <h5 class="card-title">Highest Revenue Luckydraws</h5>
                           </div>
                           <div class="card-body">
                              <div class="d-flex flex-column justify-content-between h-100">
                                 <!-- Transactions starts -->
                                 <div class="d-flex flex-column gap-3">
                                    <div class="d-flex pb-3 border-bottom w-100">
                                       <div class="icon-box lg bg-primary-subtle rounded-5 me-3">
                                          <i class="bi bi-twitter fs-3 text-primary"></i>
                                       </div>
                                       <div class="d-flex flex-column">
                                          <p class="mb-1 opacity-50">Weekly Luckydraw</p>
                                          <h3 class="m-0 lh-1 fw-semibold">€11,111.11</h3>
                                       </div>
                                    </div>
                                    <div class="d-flex pb-3 border-bottom w-100">
                                       <div class="icon-box lg bg-info-subtle rounded-5 me-3">
                                          <i class="bi bi-xbox fs-3 text-info"></i>
                                       </div>
                                       <div class="d-flex flex-column">
                                          <p class="mb-1 opacity-50">Diwali Luckydraw</p>
                                          <h3 class="m-0 lh-1 fw-semibold">€7,890.12</h3>
                                       </div>
                                    </div>
                                    <div class="d-flex pb-3 border-bottom w-100">
                                       <div class="icon-box lg bg-danger-subtle rounded-5 me-3">
                                          <i class="bi bi-youtube fs-3 text-danger"></i>
                                       </div>
                                       <div class="d-flex flex-column">
                                          <p class="mb-1 opacity-50">XMas Luckydraw</p>
                                          <h3 class="m-0 lh-1 fw-semibold">€1,234.56</h3>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- Transactions ends -->
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xxl-3 col-sm-6 col-12">
                        <div class="card mb-4 card-height-350">
                           <div class="card-header">
                              <h5 class="card-title">Recent Winners</h5>
                           </div>
                           <div id="notificationCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
         <?php $__currentLoopData = $Sale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sales): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="carousel-item active">
            <div class="card-body">
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex flex-column p-3 border rounded-2">
                        <div class="d-flex align-items-center flex-row mb-3">
                            <img src="<?php echo e(request()->getSchemeAndHttpHost()); ?>/uploads/customer/profile/<?php echo e($sales->profile_image); ?>" class="img-4x rounded-5 me-3" alt="<?php echo e($sales->first_name); ?>">
                            <p class="m-0"><?php echo e($sales->first_name); ?><br>
                                <small><?php echo e($sales->customer_id); ?></small><br><small><?php echo e($sales->mobile); ?></small>
                            </p>
                        </div>
                         <?php echo e($sales->luckydraw_name); ?> <?php echo e($sales->ticket_id); ?> bought on <?php echo e($sales->created_at); ?>

                            <?php
                                $msg_url = "https://wa.me/{$sales->mobile}?text=%F0%9F%8E%89%20*Congratulations!*%20You%20Won%20the%20*{$sales->luckydraw_name}%20Luckydraw*%20Prize!%20%F0%9F%8E%89%0A%0ADear%20*{$sales->first_name}%20({$sales->customer_id})*%2C%0A%0AWe%20are%20delighted%20to%20inform%20you%20that%20you%20have%20won%20a%20prize%20in%20our%20*{$sales->luckydraw_name}%20Luckydraw!*%20%F0%9F%8E%8A%0AYour%20*Ticket%20ID%3A%20{$sales->ticket_id}*%20has%20been%20selected%20as%20a%20winner.%0A%0APlease%20contact%20us%20for%20more%20details%20or%20visit%20our%20luckydraw%20app%20to%20check%20your%20prize%20information.%0AThank%20you%20for%20participating%2C%20and%20congratulations%20once%20again!%0A%0ABest%20regards%2C%0A*ABC%20Luckydraw%20Agency*%0ABangalore%2C%C2%A0Karnata";
                            ?>
                        <a href="<?php echo $msg_url;?>" target="_blank" class="badge bg-success text-white small">Share Via <i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
            </div>
        </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        <!-- Additional carousel items can be added here -->
        
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#notificationCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#notificationCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
                           <a href="<?php echo e($url); ?>" target="_blank" class="btn btn-info btn-lg text-white">View All Winners in Website<i class="bi bi-web"></i></a>
                        </div>
                     </div>
                  </div>
            
         


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/crm2amicrosharp/public_html/BusinessPartner/resources/views/dashboard.blade.php ENDPATH**/ ?>