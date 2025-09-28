
<?php $__env->startSection('title','My Prizes'); ?>
<?php $__env->startSection('content'); ?>


<style>
 
.single-lottery-item {
    display: inline-block;
    padding: 10px;
    background: #fff;
    border-radius: 8px;
}


.lottery-item {
    text-align: center; /* centers inline content inside this div */
}

.lottery-name {
    display: block;       /* span becomes block so text-align works */
    margin-top: 8px;      /* spacing from the image */
    font-weight: bold;    /* optional */
    text-align: center;   /* ensures text is centered */
}

table {
        border-collapse: collapse; /* makes borders visible */
        width: 100%;
    }
    table, th, td {
        border: 1px solid black; /* sets border style */
    }
    th, td {
        padding: 8px;
        text-align: left;
    }


</style>



     <!-- breadcrumb begin  -->
      <div class="breadcrumb-pok">
         <img class="br-shape-left" src="<?php echo e(URL::asset('img/breadcrumb/left-bg.png' )); ?>" alt="">
         <img class="br-shape-right" src="<?php echo e(URL::asset('img/breadcrumb/right-bg.png' )); ?>" alt="">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-xl-7 col-lg-8">
                  <div class="breadcrumb-content">
                     <span class="subtitle">🎁 My Prize Distribution</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- breadcrumb end  -->

<div class="lotteries">
    <div class="container">
        <?php if($tickets->isEmpty()): ?>
            <div class="alert alert-info">No prize records found.</div>
        <?php else: ?>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Sl.No</th>
                        <th>Ticket ID</th>
                        <th>Lucky Draw</th>
                        <th>Prize</th>
                        <th>Business Partner</th>
                        <th>Remarks</th>
                        <th>Proof</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>
                            <td><?php echo e($t->ticket_id); ?></td>
                            <td><?php echo e($t->luckydraw_name); ?></td>
                            <td>
                                <?php if($t->prize_type == 1): ?>
                                    💰 <?php echo e($t->amount); ?>

                                <?php elseif($t->prize_type == 2): ?>
                                    <div>
                                        🎁 <?php echo e($t->item); ?> <br>
                                        <?php if($t->image): ?>
                                            <img src="<?php echo e(asset($t->image)); ?>" alt="Prize" width="80">
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($t->business_name); ?></td>
                            <td><?php echo e($t->tx_remarks ?? '-'); ?></td>
                            <td>
                                <?php if($t->tx_proof): ?>
                                    <a href="<?php echo e(env('WEB_URL')); ?>/uploads/luckydraw/prizetransactions/<?php echo e($t->tx_proof); ?>" target="_blank"><img src="<?php echo e(env('WEB_URL')); ?>/uploads/luckydraw/prizetransactions/<?php echo e($t->tx_proof); ?>" style="width:125px;height:75px;"></a>
                                <?php else: ?>
                                    
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($t->tx_status == 1): ?>
                                    <span class="badge bg-success">Paid</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">Pending</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/crm2amicrosharp/public_html/Customer/resources/views/my_prizes.blade.php ENDPATH**/ ?>