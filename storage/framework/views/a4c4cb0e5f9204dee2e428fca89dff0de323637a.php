<?php $__env->startSection('title'); ?>
    <title>Invoices</title>
<?php $__env->stopSection(); ?>

<style>
    @media (min-width: 768px){
        .col-md-3 {
            flex: 0 0 auto;
            width: 35% !important;
        }       
    }
    .card-header{
        padding: 0 !important;
    }

    .row{
        padding-bottom: 10px;
    }

    #appointment_filter, #appointment_paginate{
                float: right;
    }

</style>

<?php $__env->startSection('main'); ?>

<div class="card">
    <div class="card-body">
         <div class="card-header py-3">
                  <div class="row align-items-center">
                    <div class="col-md-3 col-12 me-auto mb-md-0 mb-3">
                        <h4><?php echo e(ucfirst($current)); ?> Invoices</h4>
                    </div>
                    <div class="col-md-2 col-6"> 
                        <select name="show" class="form-select" onchange="redirect(this.value)">
                            <option value="all" <?php echo e(($current=='all') ? 'selected' : ''); ?>>All</option>
                            <option value="paid" <?php echo e(($current=='paid') ? 'selected' : ''); ?>>Paid</option>
                            <option value="unpaid" <?php echo e(($current=='unpaid') ? 'selected' : ''); ?>>Unpaid</option>
                        </select>
                    </div>
                 </div>
                </div>
    <?php if(sizeof($invoices)): ?>
                <br>
        <div class="table-responsive">
            <table id="appointment" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Appointment ID</th>
                        <th>Cuopon</th>
                        <th>Net Total</th>
                        <th>Payment Method</th>
                        <th>Paid Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                
                <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($app->invoice_id); ?></td>
                        <td><?php echo e(($app->coupon) ? ($app->coupon) : 'N/A'); ?></td>
                        <td>৳ <?php echo e($app->net_total); ?>/=</td>
                        <td><?php echo e(ucfirst($app->payment_method)); ?></td>
                        <?php if($app->paid): ?>
                            <td class="bg-success text-white">Paid</td>
                        <?php else: ?>
                            <td class="bg-danger text-white">Unpaid</td>
                        <?php endif; ?>
                        <td class="text-center">
                            <?php
                                $id = DB::table('appointments')->where('invoice_id', $app->invoice_id)->value('id');
                            ?>
                            <a href="<?php echo e(url('/appointment/'.$id)); ?>"><button type="button" class="btn btn-primary">Details</button></a>
                        </td>
                    </tr> 
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
            </table>
        </div>
    <?php else: ?>
    <br>
        <h5 class="text-center">No Invoices Found !</h5>
    <?php endif; ?>
    </div>
</div>

<script>
    function redirect(show){
        var url = '<?php echo e(url("/invoices?show=:slug")); ?>';
        url = url.replace(':slug', show);
        window.location.href=url;
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/858192.cloudwaysapps.com/xnrkmuucrp/public_html/resources/views/admin/invoices.blade.php ENDPATH**/ ?>