<?php $__env->startSection('title'); ?>
<title>Clients</title>
<?php $__env->stopSection(); ?>


<style>
    @media (min-width: 768px) {
        .col-md-3 {
            flex: 0 0 auto;
            width: 35% !important;
        }
    }

    .card-header {
        padding: 0 !important;
    }

    .row {
        padding-bottom: 10px;
    }

    #client_filter,
    #client_paginate {
        float: right;
    }
</style>

<?php $__env->startSection('main'); ?>

<!-- <div class="card"> -->
<div class="">
    <!-- card-body -->
    <div class="">
        <!-- card-header -->
        <div class=" py-3">
            <div class="row align-items-center justify-content-between">
                <div class="text-start col-md-6 col-12 mb-md-0 mb-3">
                    <h4>All Clients</h4>
                </div>

                <div class="text-end col-md-6 col-12 mb-md-0 mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <h4>Custom Clients</h4>
                </div>
            </div>
        </div>

        <?php if(sizeof($clients)): ?>
        <br>
        <!-- table table-striped table-bordered"-->
        <div class="table-responsive">
            <table id="client" class="table table-striped table-bordered w-100">
                <thead>
                    <tr>
                        <th>Phone</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Birthday</th>
                        <th>Gender</th>
                        <th>Blood_Group</th>
                        <th>Registered_Date</th>
                        <th>Service_Area</th>
                        <th>Address</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($client->phone); ?></td>
                        <td>
                            <div class="d-flex align-items-center gap-3 cursor-pointer">
                                <img src="<?php echo e(asset($client->image)); ?>" class="rounded-circle" width="30" height="30">
                                <div class="">
                                    <p class="mb-0"><?php echo e($client->name); ?></p>
                                </div>
                            </div>
                        </td>
                        <td><?php echo e(($client->email) ? $client->email : 'N/A'); ?></td>
                        <td><?php echo e(($client->date_of_birth) ? $client->date_of_birth : 'N/A'); ?></td>
                        <td><?php echo e(($client->sex) ? ucfirst($client->sex) : 'N/A'); ?></td>
                        <td><?php echo e(($client->blood_group) ? DB::table('bloodgroups')->where('id', $client->blood_group)->value('group') : 'N/A'); ?></td>
                        <td><?php echo e(($client->created_at)? $client->created_at : 'N/A'); ?></td>
                        <td><?php echo e(DB::table('serviceareas')->where('id', $client->service_area)->value('area')); ?></td>
                        <td><?php echo e(($client->address) ? ucwords($client->address) : 'N/A'); ?></td>
                        <td class="">
                            <!-- <a href="<?php echo e(url('/client/'.$client->id)); ?>"><button type="button" class="btn btn-sm btn-primary">Update</button></a> -->
                            <span class="me-2">
                                <a href="<?php echo e(url('/client/'.$client->id)); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512">
                                        <!--!Font Awesome Free 6.5.1 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                        <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                                    </svg>
                                </a>
                            </span>

                            <span>
                                <a href="<?php echo e(url('/delete_client/'.$client->id)); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512">
                                        <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                    </svg>
                                </a>
                            </span>

                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>

            </table>
        </div>
        <?php else: ?>
        <br>
        <h5 class="text-center">No Clients Found !</h5>
        <?php endif; ?>
    </div>
</div>


<!-- Custom clients modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Custom Clients</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <form action=" <?php echo e(url('/custom_adding_clients')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-12 col-md-6 col-lg-6 col-xl-6 mb-2">
                                <label for="phone">Phone</label>
                                <div>
                                    <input type="text" class="form-control" name="phone" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 col-xl-6 mb-2">
                                <label for="name">Name</label>
                                <div>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 col-xl-6 mb-2">
                                <label for="email">Email</label>
                                <div>
                                    <input type="text" class="form-control" name="email">
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 col-xl-6 mb-2">
                                <label for="date_of_birth">Date of Birth</label>
                                <div>
                                    <input type="date" class="form-control" name="date_of_birth" min="<?php echo e(date('Y-m-d')); ?>">
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 col-xl-6 mb-2">
                                <label class="form-label">Gender</label>
                                <select class="form-control" name="sex">
                                    <option value="">Select</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 col-xl-6 mb-2">
                                <label class="form-label" for="bloodgroup">Blood Group</label>
                                <select class="form-control" name="bloodgroup">
                                    <option value="">Select</option>
                                    <option value="1">A+</option>
                                    <option value="2">A-</option>
                                    <option value="3">B+</option>
                                    <option value="4">B-</option>
                                    <option value="5">O+</option>
                                    <option value="6">O-</option>
                                    <option value="7">AB+</option>
                                    <option value="8">AB-</option>
                                </select>
                            </div>


                            <!-- <div><?php echo e(DB::table('serviceareas')->where('id', $client->service_area)->value('area')); ?></div> -->

                            <div class="col-12 col-md-6 col-lg-6 col-xl-6 mb-2">
                                <label class="form-label" for="service_area">Service Area</label>
                                <select class="form-control" name="service_area" required>
                                    <option value="">Select</option>
                                    <option value="1">Uttara Zone</option>
                                    <option value="2">Khilkhet / Nikunja Zone</option>
                                    <option value="3">Mirpur DOSH Zone</option>
                                    <option value="4">Uttarakhan Zone</option>
                                    <option value="5">Dhakhshinkhan Zone</option>
                                    <option value="6">Tongi Zone</option>
                                    <option value="7">Ashulia Zone</option>
                                    <option value="8">Banani Zone</option>
                                    <option value="9">Gulshan Zone</option>
                                    <option value="10">Bashundhara Zone</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 col-xl-6 mb-2">
                                <label for="address">Address</label>
                                <div>
                                    <input type="text" class="form-control" name="address" required>
                                </div>
                            </div>


                            <!-- display none  -->
                            <div class="col-12 col-md-6 col-lg-6 col-xl-6 mb-2 d-none">
                                <label for="usertype">user Type</label>
                                <input type="text" class="form-control" name="usertype" value="client">
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 col-xl-6 mb-2">
                                <label for="password">Password</label>
                                <div>
                                    <input type="text" class="form-control" name="password" required>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 col-xl-6 mb-2">
                                <label for="confirmpassword">Confirm Password</label>
                                <div>
                                    <input type="text" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <!-- <button type="button" class="btn btn-primary">Save</button> -->
                    </div>
                </form>

            </div>

        </div>
    </div>

    <!-- <script>
    // Assuming you've already initialized the DataTable

    let oTable = $('#client').DataTable({
        paging: true,
        scrollCollapse: false,
        scrollY: '55vh'
    });
</script> -->
    <!-- <script>
    $(document).ready(function() {
        $('#client').DataTable({
            order: [
                [6, 'desc']
            ]
        });
    });
</script> -->

    <?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/858192.cloudwaysapps.com/xnrkmuucrp/public_html/resources/views/admin/clients.blade.php ENDPATH**/ ?>