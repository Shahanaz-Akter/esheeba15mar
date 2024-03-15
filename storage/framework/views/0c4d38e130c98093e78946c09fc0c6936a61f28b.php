<?php $__env->startSection('title'); ?>
    <title>Appointments</title>
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
                        <h4><?php echo e(ucfirst($current)); ?> Appointments</h4>
                    </div>
                    <div class="col-md-2 col-6"> 
                        <select name="show" class="form-select" onchange="redirect(this.value)">
                            <option value="unassigned" <?php echo e(($current=='unassigned') ? 'selected' : ''); ?>>Unassigned</option>
                            <option value="ongoing" <?php echo e(($current=='ongoing') ? 'selected' : ''); ?>>On Going</option>
                            <option value="completed" <?php echo e(($current=='completed') ? 'selected' : ''); ?>>Completed</option>
                            <option value="cancelled" <?php echo e(($current=='cancelled') ? 'selected' : ''); ?>>Cancelled</option>
                        </select>
                    </div>
                 </div>
                </div>
    <?php if(sizeof($appointments)): ?>
                <br>
        <div class="table-responsive">
            <table id="appointment" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Appointment ID</th>
                        <th>Service</th>
                        <th>Client</th>
                        <th>Nurse</th>
                        <th>Appointment Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                
                <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($app->invoice_id); ?></td>
                        <td><?php echo e(DB::table('services')->where('id', $app->service_id)->value('service_name')); ?></td>
                        <td><?php echo e(App\Client::where('id', $app->client_id)->value('name')); ?></td>
                        <td><?php echo e(($app->nurse_id) ? (App\Nurse::where('id',$app->nurse_id)->value('name')) : 'N/A'); ?></td>
                        <td><?php echo e(date('d-m-Y h:i A', strtotime($app->appointment_date))); ?></td>
                        <td class="text-center">
                            <a href="<?php echo e(url('/appointment/'.$app->id)); ?>"><button type="button" class="btn btn-primary">Update</button></a>
                        </td>
                    </tr> 
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
            </table>
        </div>
    <?php else: ?>
    <br>
        <h5 class="text-center">No Appointments Found !</h5>
    <?php endif; ?>
    </div>
</div>

<script>
    function redirect(show){
        var url = '<?php echo e(url("/appointments?show=:slug")); ?>';
        url = url.replace(':slug', show);
        window.location.href=url;
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/858192.cloudwaysapps.com/xnrkmuucrp/public_html/resources/views/admin/appointments.blade.php ENDPATH**/ ?>