
<?php $__env->startSection('title','Luckydraw'); ?>
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
                     <span class="subtitle">Lotteries</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- breadcrumb end  -->
 <!-- lottery begin -->
        <div class="lotteries">
            <div class="bg-shape-2">
                <img src="<?php echo e(URL::asset('img/bg-shape/bg-shape-2.png')); ?>" alt="">
            </div>
            <div class="bg-shape-1">
                <img src="<?php echo e(URL::asset('img/bg-shape/bg-shape-1.png')); ?>" alt="">
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8">
                        <div class="section-title">
                            <h3 class="sub-title">My Luckydraws</h3>
                            <h2 class="title">Based on His Country display the Luckydraws</h2>
                        </div>
                    </div>
                </div>
                <div class="part-picking-number">
                    <div class="lotteries-selection-menu owl-carousel">
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- lottery end -->

        <!-- cta begin -->
        <div class="cta">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-9 col-lg-9 col-sm-8 d-xl-flex d-lg-flex d-block align-items-center">
                        <div class="part-text">
                            <h2 class="title">If you have any query about lottery or anything!</h2>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3">
                        <div class="btn-cta">
                            <a class='btn-pok' href='contact.html'>Contact Us <i class="fa-solid fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cta end -->

        <!-- promotion begin -->
        <div class="promotion">
            <div class="bg-shape-1">
                <img src="<?php echo e(URL::asset('img/bg-shape/bg-shape-1.png')); ?>" alt="">
            </div>
            <img src="<?php echo e(URL::asset('img/bg-shape/bg-shape-3.png')); ?>" alt="" class="bg-shape-3">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-8">
                        <div class="section-title">
                            <h3 class="sub-title">My Luckydraws</h3>
                            <h2 class="title">My Luckydraws</h2>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <h2>My Tickets</h2>
                    <div class="mb-3">
                        <a href="<?php echo e(route('luckydraw.export', 'csv')); ?>" class="btn btn-sm btn-success">Export CSV</a>
                        <a href="<?php echo e(route('luckydraw.export', 'pdf')); ?>" class="btn btn-sm btn-danger">Export PDF</a>
                    </div>
                    
                    <?php $__empty_1 = true; $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partnerId => $tickets): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $partner = $tickets->first();
                        ?>
                        <h4>
                            UBG Lucky Draw - <?php echo e($partner->business_name); ?> <!-- (<?php echo e($tickets->count()); ?> Tickets) - <small><?php echo e($partner->poc_mobile); ?> | <?php echo e($partner->poc_email); ?> | <?php echo e($partner->address_line_1); ?> <?php echo e($partner->address_line_2); ?></small> -->
                        </h4>
                        <div class="row">
                            <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="part-img text-center">
                                        <?php if(!empty($ticket->sale_image_path)): ?>
                                            <a href="<?php echo e(env('WEB_URL')); ?>BusinessPartner/public/<?php echo e($ticket->sale_image_path); ?>"
                                               download="my-ticket.jpg" 
                                               title="<?php echo e($ticket->ticket_id); ?>">
                                                <img src="<?php echo e(env('WEB_URL')); ?>BusinessPartner/public/<?php echo e($ticket->sale_image_path); ?>" 
                                                     alt="<?php echo e($ticket->luckydraw_name); ?>" 
                                                     class="img-fluid rounded shadow-sm">
                                            </a>
                                            <div class="mt-2">
                                                <small><strong><?php echo e($ticket->ticket_id); ?></strong></small>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php if(($loop->iteration % 4) == 0 && !$loop->last): ?>
                                    </div><div class="row">
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <hr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p>No tickets purchased yet.</p>
                    <?php endif; ?>
                </div>

            </div>
        </div>
        <!-- promotion end -->
        <!--Mew COde-->
<?php $__env->stopSection(); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>
$(document).ready(function(){
    // $('.owl-carousel').owlCarousel({
    //     loop: true,
    //     margin: 10,
    //     nav: true,
    //     responsive:{
    //         0:{
    //             items:2, // 2 per row on mobile
    //             rows:2
    //         },
    //         768:{
    //             items:3, // 3 per row on tablet
    //             rows:2
    //         },
    //         1200:{
    //             items:5, // 5 per row on desktop
    //             rows:2
    //         }
    //     }
    // });
    
    
    $('.lotteries-selection-menu').owlCarousel({
        loop: true,
        margin: 15,
        nav: false,
        autoplay: true,
        autoplayTimeout: 2000, // 2 seconds
        autoplayHoverPause: true,
        responsive:{
            0:{ items:2 },
            768:{ items:4 },
            1200:{ items:6 }
        }
    });
});
</script>


 <?php
// <div class="col-xl-4 col-lg-4 col-md-4">-->
//                     <!--        <div class="part-img">-->
//                     <!--            <a href="{{ env('WEB_URL') }}BusinessPartner/public/{{$sales->sale_image_path}}" download="my-ticket.jpg">-->
//                     <!--               <img src="{{ env('WEB_URL') }}BusinessPartner/public/{{$sales->sale_image_path}}" alt="">-->
//                     <!--            </a>-->
//                     <!--        </div>  -->
//                     <!--    </div>-->
                    
//     // Database connection
//     $mysqli = new mysqli("localhost", "db_user", "db_pass", "db_name");
    
//     // Check connection
//     if ($mysqli->connect_error) {
//         die("Connection failed: " . $mysqli->connect_error);
//     }
    
//     // Example: Logged in customer's ID (you’ll replace this with your session value)
//     $loggedInCustomerId = 123;
    
//     // Fetch sale_image_path grouped by partner_id
//     $sql = "SELECT partner_id, sale_image_path 
//             FROM your_table 
//             WHERE customer_id = ? 
//             ORDER BY partner_id";
    
//     $stmt = $mysqli->prepare($sql);
//     $stmt->bind_param("i", $loggedInCustomerId);
//     $stmt->execute();
//     $result = $stmt->get_result();
    
//     // Group data by partner_id
//     $data = [];
//     while ($row = $result->fetch_assoc()) {
//         $data[$row['partner_id']][] = $row['sale_image_path'];
//     }
    
//     // Display
//     foreach ($data as $partnerId => $images) {
//         echo "<h3>Partner ID: " . htmlspecialchars($partnerId) . "</h3>";
//         foreach ($images as $path) {
//             echo htmlspecialchars($path) . "<br>";
//         }
//     }
    
 ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/crm2amicrosharp/public_html/Customer/resources/views/luckydraw.blade.php ENDPATH**/ ?>