
<?php $__env->startSection('title', 'View Sale'); ?>
<?php $__env->startSection('content'); ?>




    <?php
        $user = Session::get('user');
    ?>
    <div class="row gx-4">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="mb-3">Total Invoices Amount</h6>
                    <h2 class="mb-2 d-flex align-items-center justify-content-between">
                        <i class="bi bi-journal-medical fs-3 lh-1 bg-primary p-3 rounded-3 text-white"></i>
                        <span class="text-primary">€ <?php echo e($sale_amount); ?></span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="mb-3">Paid to Company</h6>
                    <h2 class="mb-2 d-flex align-items-center justify-content-between">
                        <i class="bi bi-journal-check fs-3 lh-1 bg-primary p-3 rounded-3 text-white"></i>
                        <span class="text-primary">€ <?php echo e($sale_amount); ?></span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="mb-3">Total Luckydraw Tickets Sold</h6>
                    <h2 class="mb-2 d-flex align-items-center justify-content-between">
                        <i class="bi bi-ticket-perforated-fill fs-3 lh-1 bg-primary p-3 rounded-3 text-white"></i>
                        <span class="text-primary"><?php echo e($sales); ?></span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="mb-3">Wallet Balance</h6>
                    <h2 class="mb-2 d-flex align-items-center justify-content-between">
                        <i class="bi bi-wallet-fill fs-3 lh-1 bg-primary p-3 rounded-3 text-white"></i>
                        <span class="text-primary">€ <?php echo e($wallet->wallet_amount); ?></span>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Row ends -->
    <!-- Row starts -->
    <div class="row gx-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Sales History</h5>
                </div>
                <div class="card-body">
                    <div class=" table-outer mb-2">
                        <div class="table-responsive">
                            <table class="table truncate align-middle">
                                <thead>
                                    <tr>
                                        <td width="200px">Customer Details</td>
                                        <td width="100px">Luckydraw Details</td>
                                        <td width="100px">Ticket Details</td>
                                        <td width="100px">Purchased Date</td>
                                        <td width="100px">Draw Date</td>
                                        <td width="100px">Is Winner</td>
                                        <td width="100px">Actions</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $Sale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Sales): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php 
                                    $busniess_partner = \App\Models\Business_Partner::from('business_partners as bp')
                                        ->select(
                                            'bp.poc_first_name',
                                            'bp.poc_last_name',
                                            'bp.poc_email',
                                            'bp.poc_mobile',
                                            'bp.business_name',
                                            'bp.address_line_1',
                                            'bp.address_line_2',
                                            'bp_ar.area_name',
                                            'rg.region_name',
                                            'ct.country_name',
                                            'st.state_title',
                                            'cit.name as city_name',
                                            'bp.zip_code'
                                        )
                                        ->leftJoin('business_area as bp_ar', 'bp.business_area_id', '=', 'bp_ar.id')
                                        ->leftJoin('region as rg', 'bp.region_id', '=', 'rg.id')
                                        ->leftJoin('country as ct', 'bp.country_id', '=', 'ct.id')
                                        ->leftJoin('state as st', 'bp.state_id', '=', 'st.id')
                                        ->leftJoin('city as cit', 'bp.city_id', '=', 'cit.id')
                                        ->where('bp.id', $user['id'])
                                        ->first();
                                    ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center"><img src="<?php echo e(env('WEB_URL')); ?>/uploads/customer/profile_image/<?php echo e($Sales->profile_image); ?>" class="img-3x rounded-5 me-3" alt="<?php echo e($Sales->first_name); ?>"></div>
                                                <?php echo e($Sales->first_name); ?><br>
                                                <small><?php echo e($Sales->email); ?><br /><?php echo e($Sales->mobile); ?></small>
                                            </td>
                                            <td><?php echo e($Sales->luckydraw_name); ?><br>€<?php echo e($Sales->price); ?>/- <span class="badge bg-success">Paid Online</span></td>
                                            <td align="center"><br><img src="<?php echo e(asset($Sales->sale_image_path)); ?>" class="img-3x rounded-5 me-3" alt="<?php echo e($Sales->luckydraw_name); ?>"><br>Ticket ID:<?php echo e($Sales->ticket_id); ?> </td>
                                            <td><?php echo e($Sales->created_at->format('Y-m-d')); ?></td>
                                            <td><?php echo e($Sales->created_at->format('Y-m-d')); ?></td>
                                            <td>
                                                <!--//If This ID is the winner then show Yes label else No lable.-->
                                                 
                                                
                                                <!--//prize_id from prizes Tables-->
                                                <?php 
    $prize_distribution = \App\Models\Prize_Distribution::where('ticket_id', $Sales->ticket_id)->first();
    $prize = null;

    if ($prize_distribution && $prize_distribution->prize_id != null) {
        $prize = \App\Models\Prize::where('id', $prize_distribution->prize_id)
                   ->select('amount','item','image')
                   ->first();
    }
?>
                                                <?php if($prize_distribution != ''): ?>
                                                    <span class="badge bg-success">Yes</span>
                                                    <?php
                                                    $created_at = $prize_distribution->created_at; 
                                                    $updated_at = $prize_distribution->updated_at; 
                                                    $tx_remarks = $prize_distribution->tx_remarks;
                                                    $tx_proof = $prize_distribution->tx_proof;
                                                    ?>
                                                    <br>
                                                    <?php echo e($created_at); ?>

                                                    <br>
                                                    <?php echo e($updated_at); ?>

                                                    <br>
                                                    <?php echo e($tx_remarks); ?>

                                                    <br>
                                                    <img src="<?php echo e(env('WEB_URL')); ?>/uploads/luckydraw/prizetransactions/<?php echo e($tx_proof); ?>" class="img-3x rounded-5 me-3" alt="Customer Name">
                                                    <br>
                                                    <?php if($prize): ?>
                                                        <!-- Display prize info -->
                                                        <br>
                                                        <?php echo e($prize->item); ?>  
                                                        <br>
                                                        <?php echo e($prize->amount); ?>

                                                        <br>
                                                        <img src="<?php echo e(env('WEB_URL')); ?>/uploads/luckydraw/prizes/<?php echo e($prize->image); ?>" alt="Prize" style="width: 90px;height: 90px;">
                                                    <?php endif; ?>
                                                    <br>
                                                <?php else: ?>
                                                    <span class="badge bg-danger">No</span>
                                                <?php endif; ?>
                                                <!--$amount = "";-->
                                                <!--$item = "";-->
                                                <!--$image = "";-->
                                                
                                                <!--//Table : prize_distribution -->
                                                <!--$created_at = ""; -->
                                                <!--$updated_at = ""; -->
                                                <!--$tx_remarks = "";-->
                                                <!--$tx_proof = "";-->
                                            </td>
                                            <!-- Will be used later ... <td><?php echo e($busniess_partner->poc_first_name); ?><br> <?php echo e($busniess_partner->poc_last_name); ?><br> <?php echo e($busniess_partner->poc_email); ?><br> <?php echo e($busniess_partner->poc_mobile); ?><br> <?php echo e($busniess_partner->area_name); ?><br> <?php echo e($busniess_partner->business_name); ?><br> <?php echo e($busniess_partner->address_line_1); ?><br> <?php echo e($busniess_partner->address_line_2); ?><br> <?php echo e($busniess_partner->region_name); ?><br> <?php echo e($busniess_partner->country_name); ?><br> <?php echo e($busniess_partner->state_title); ?><br> <?php echo e($busniess_partner->city_name); ?><br> <?php echo e($busniess_partner->zip_code); ?></td> -->
                                            <td>
                                                <a href="<?php echo e(asset($Sales->sale_image_path)); ?>" class="btn btn-primary" target="_blank"> <i class="bi bi-printer"></i> View & Print Ticket</a>
                                                <a href="https://wa.me/<?php echo e($Sales->mobile); ?>?text=Dear%20*<?php echo e($Sales->first_name); ?>*%2C%0A%0AThank%20you%20for%20purchasing%20the%20Luckydraw%20*<?php echo e($Sales->luckydraw_name); ?>*%20from%20*Naresh%20Luckydraws%2C%20India*.%0A%0AYour%20Luckydraw%20details%20are%20as%20follows%3A%0A%0ALuckydraw%20Name%3A%20*<?php echo e($Sales->luckydraw_name); ?>*%0ATicket%20Number%3A%20*<?php echo e($Sales->ticket_id); ?>*%0A%0APlease%20click%20the%20link%20below%20to%20download%20your%20Luckydraw%20ticket%3A%20https%3A%2F%2Fwww.crm2a.microsharp.net%2FCustomer%2Fpublic%2Fmyticket%2F<?php echo e($Sales->ticket_download_id); ?>%0A%0AThank%20you%20for%20choosing%20*<?php echo e($busniess_partner->business_name); ?>*.%0A%0AWarm%20Regards%2C%0A*<?php echo e($busniess_partner->poc_first_name); ?>*%0A<?php echo e($busniess_partner->poc_email); ?>%2C%20<?php echo e($busniess_partner->poc_mobile); ?>%0A<?php echo e($busniess_partner->area_name); ?>%2C%20<?php echo e($busniess_partner->region_name); ?>%2C%20<?php echo e($busniess_partner->city_name); ?>%0A<?php echo e($busniess_partner->city_name); ?>%2C%20<?php echo e($busniess_partner->state_title); ?>%0A<?php echo e($busniess_partner->country_name); ?>%2C%20<?php echo e($busniess_partner->zip_code); ?>" target="_blank" class="btn btn-info"><i class="bi bi-whatsapp"></i> Send Ticket</a>
                                                <br><br>
                                                <a href="<?php echo e(route('sales.print', $Sales->id)); ?>" class="btn btn-info"><i class="bi bi-file-pdf"></i> Download Ticket</a>
                                                <?php if($prize_distribution != ''): ?> <!-- Customer Won the Ticket to Enable the Button -->
                                                    <a href="https://wa.me/919972646566?text=Dear%20Mr.%20Rammohan%2C%0A%0AI%E2%80%99m%20pleased%20to%20inform%20you%20that%20you%E2%80%99ve%20won%20in%20today%E2%80%99s%20lucky%20draw%20*<?php echo e($Sales->luckydraw_name); ?>*%20conducted%20by%20*UBG%20Company*.%20Your%20winning%20ticket%20ID%20is%20%5B*<?php echo e($Sales->ticket_id); ?>*%5D.%0A%0AOur%20team%20will%20get%20in%20touch%20with%20you%20shortly%20regarding%20the%20next%20steps.%20In%20the%20meantime%2C%20please%20check%20your%20email%20for%20the%20draw%20details%20and%20open%20your%20Android%20app%20to%20view%20the%20latest%20status.%0A%0AThank%20you%20for%20choosing%20Rajkireet%20Luckydraw%20Store.%20Keep%20buying%20tickets%20with%20us%20for%20more%20chances%20to%20win%20exciting%20prizes!%0A%0AWarm%20Regards%2C%0A*<?php echo e($busniess_partner->poc_first_name); ?>*%0A<?php echo e($busniess_partner->poc_email); ?>%2C%20<?php echo e($busniess_partner->poc_mobile); ?>%0A<?php echo e($busniess_partner->area_name); ?>%2C%20<?php echo e($busniess_partner->region_name); ?>%2C%20<?php echo e($busniess_partner->city_name); ?>%0A<?php echo e($busniess_partner->city_name); ?>%2C%20<?php echo e($busniess_partner->state_title); ?>%0A<?php echo e($busniess_partner->country_name); ?>%2C%20<?php echo e($busniess_partner->zip_code); ?>" target="_blank" class="btn btn-primary"><i class="bi bi-whatsapp"></i> Click To Inform Winner</a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Pagination start -->
                    <div class="d-flex justify-content-end">
                        <b>Note:</b> If you find any mistakes, please raise a&nbsp;<u><a
                                href="<?php echo e(route('support')); ?>">Support Ticket</a></u>.
                    </div>
                    <!-- Pagination end -->
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/crm2amicrosharp/public_html/BusinessPartner/resources/views/sales/view_sale.blade.php ENDPATH**/ ?>