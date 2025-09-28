
<?php $__env->startSection('title','Products'); ?>
<?php $__env->startSection('content'); ?>
    <h1>Current Luckydraws</h1>
    <div class="row gx-4">
        <?php $__currentLoopData = $luckydraw; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $luckydraws): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(date('Y-m-d') >= $luckydraws->start_date AND date('Y-m-d') <= $luckydraws->end_date): ?>
				<div class="col-sm-4 col-12">
					<div class="card mb-4">
						<div class="card-header">
							<h5 class="card-title"><?php echo e($luckydraws->luckydraw_name); ?></h5>
						</div>
						<div class="card-body">
							<div class="card-img">
							</div>
							<a href="#" class="btn btn-warning">€<?php echo e($luckydraws->price); ?>/-</a>
							<a href="#" class="btn btn-info">Last Date : <?php echo e($luckydraws->end_date); ?></a>
							<a href="#" class="btn btn-success">
								<?php if($luckydraws->frequency == 1): ?>
									<?php echo e('Daily'); ?>

								<?php elseif($luckydraws->frequency == 2): ?>
									<?php echo e('Weekly'); ?>

								<?php elseif($luckydraws->frequency == 3): ?>
									<?php echo e('Monthly'); ?>

								<?php elseif($luckydraws->frequency == 4): ?>
									<?php echo e('Yearly'); ?>

								<?php endif; ?>
							</a>
						</div>
					</div>
				</div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
	<h1>Future Luckydraws</h1>
    <div class="row gx-4">
        <?php $__currentLoopData = $luckydraw; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $luckydraws): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(date('Y-m-d') < $luckydraws->start_date AND date('Y-m-d') <= $luckydraws->end_date): ?>
				<div class="col-sm-4 col-12">
					<div class="card mb-4">
						<div class="card-header">
							<h5 class="card-title"><?php echo e($luckydraws->luckydraw_name); ?></h5>
						</div>
						<div class="card-body">
							<div class="card-img">
							
							</div>
							<a href="#" class="btn btn-warning">€<?php echo e($luckydraws->price); ?>/-</a>
							<a href="#" class="btn btn-info">Start Date : <?php echo e($luckydraws->start_date); ?></a>
							<a href="#" class="btn btn-success">
								<?php if($luckydraws->frequency == 1): ?>
									<?php echo e('Daily'); ?>

								<?php elseif($luckydraws->frequency == 2): ?>
									<?php echo e('Weekly'); ?>

								<?php elseif($luckydraws->frequency == 3): ?>
									<?php echo e('Monthly'); ?>

								<?php elseif($luckydraws->frequency == 4): ?>
									<?php echo e('Yearly'); ?>

								<?php endif; ?>
							</a>
						</div>
					</div>
				</div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/crm2amicrosharp/public_html/BusinessPartner/resources/views/product.blade.php ENDPATH**/ ?>