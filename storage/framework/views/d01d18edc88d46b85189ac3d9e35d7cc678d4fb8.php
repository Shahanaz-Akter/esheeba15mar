<?php $__env->startSection('title'); ?>
    <title>Admin Login</title>
<?php $__env->stopSection(); ?>

<style>
  .page-content{
    margin-left: 0px !important;
  }
</style>

<?php $__env->startSection('main'); ?>

        <div class="container-fluid">  
          <div class="authentication-card">            
            <div class="card shadow rounded-0 overflow-hidden">

            <?php if(Session::has('fail')): ?> 
              <div class="alert border-0 bg-danger alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                  <div class="fs-3 text-white"><i class="bi bi-x-circle-fill"></i></div>
                    <div class="ms-3">
                      <div class="text-white text-center"><?php echo e(Session::get('fail')); ?></div>
                    </div>
                </div>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>  
            <?php endif; ?>

              <div class="row g-0">
                <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
                  <img src="<?php echo e(asset('public/admin/images/error/login-img.jpg')); ?>" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6">
                  <div class="card-body p-4 p-sm-5">
                  
                    <form class="form-body" action="<?php echo e(url('/login')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row g-3">
                          <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Enter Phone</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-telephone-fill"></i></div>
                              <input type="text" name="phone" class="form-control radius-30 ps-5" id="inputEmailAddress" placeholder="Phone" required>
                            </div>
                          </div>
                          <div class="col-12">
                            <label for="inputChoosePassword" class="form-label">Enter Password</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                              <input type="password" name="password" class="form-control radius-30 ps-5" id="inputChoosePassword" placeholder="Password" required>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-check form-switch">
                              <input class="form-check-input" type="checkbox" name="remember" id="flexSwitchCheckChecked" checked>
                              <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="d-grid">
                              <button type="submit" class="btn btn-primary radius-30">Sign In</button>
                            </div>
                          </div>
                          <div class="col-12 text-center">
                            <p class="mb-0">Forgot Password? Contact your System Admin ASAP!</p>
                          </div>
                        </div>
                    </form>
                 </div>
                </div>
              </div>
            </div>
          </div>
        </div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.static', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/858192.cloudwaysapps.com/xnrkmuucrp/public_html/resources/views/admin/login.blade.php ENDPATH**/ ?>