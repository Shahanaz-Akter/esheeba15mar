<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo e(asset('public/website/images/favicon.png')); ?>" type="image/png" />
        <!--plugins-->
        <link href="<?php echo e(asset('public/admin/plugins/vectormap/jquery-jvectormap-2.0.2.css')); ?>" rel="stylesheet"/>
        <link href="<?php echo e(asset('public/admin/plugins/simplebar/css/simplebar.css')); ?>" rel="stylesheet" />
        <link href="<?php echo e(asset('public/admin/plugins/perfect-scrollbar/css/perfect-scrollbar.css')); ?>" rel="stylesheet" />
        <link href="<?php echo e(asset('public/admin/plugins/metismenu/css/metisMenu.min.css')); ?>" rel="stylesheet" />
        <!-- Bootstrap CSS -->
        <link href="<?php echo e(asset('public/admin/css/bootstrap.min.css')); ?>" rel="stylesheet" />
        <link href="<?php echo e(asset('public/admin/css/bootstrap-extended.css')); ?>" rel="stylesheet" />
        <link href="<?php echo e(asset('public/admin/css/style.css')); ?>" rel="stylesheet" />
        <link href="<?php echo e(asset('public/admin/css/icons.css')); ?>" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        

        <!-- loader-->
        <link href="<?php echo e(asset('public/admin/css/pace.min.css')); ?>" rel="stylesheet" />


        <?php echo $__env->yieldContent('title'); ?>

        <style>

            #logout:hover{
                color: #ec2024;
            }
                        
        </style>

    </head>

    <body>

        <!--start wrapper-->
        <div class="wrapper">

            <?php echo $__env->yieldContent('top_header'); ?>
            <?php echo $__env->yieldContent('side_bar'); ?>
            
            <main class="page-content">
                <?php echo $__env->yieldContent('main'); ?>
            </main>

            <!--Start Back To Top Button-->
		     <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
             <!--End Back To Top Button-->

        </div>
        <!--end wrapper-->

  <!-- Bootstrap bundle JS -->
  <script src="<?php echo e(asset('public/admin/js/bootstrap.bundle.min.js')); ?>"></script>
  <!--plugins-->
  <script src="<?php echo e(asset('public/admin/js/jquery.min.js')); ?>"></script>
  <script src="<?php echo e(asset('public/admin/plugins/simplebar/js/simplebar.min.js')); ?>"></script>
  <script src="<?php echo e(asset('public/admin/plugins/metismenu/js/metisMenu.min.js')); ?>"></script>
  <script src="<?php echo e(asset('public/admin/js/pace.min.js')); ?>"></script>
  <script src="<?php echo e(asset('public/admin/plugins/datatable/js/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('public/admin/plugins/datatable/js/dataTables.bootstrap5.min.js')); ?>"></script>
  <script src="<?php echo e(asset('public/admin/js/table-datatable.js')); ?>"></script>
  <!--app-->
  <script src="<?php echo e(asset('public/admin/js/app.js')); ?>"></script>
</body>

</html><?php /**PATH /home/858192.cloudwaysapps.com/xnrkmuucrp/public_html/resources/views/admin/static.blade.php ENDPATH**/ ?>