<?php $__env->startSection('title'); ?>
    <?php echo $__env->yieldContent('title'); ?>
<?php $__env->stopSection(); ?>

<style>
  .btn-close{
    width: 0em !important;
    height: 0em !important;
  }
</style>

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>

  // Enable pusher logging - don't include this in production
  // Pusher.logToConsole = true;

  var pusher = new Pusher('2da9a2e69b147ee7f7ec', {
    cluster: 'ap2'
  });

  var channel = pusher.subscribe('appointment-channel');
  channel.bind('newappointment-event', function(data) {
    unassigned();
  });
</script>

<?php $__env->startSection('top_header'); ?>
<header class="top-header">        
    <nav class="navbar navbar-expand gap-3">
      <div class="mobile-toggle-icon fs-3">
          <i class="bi bi-list"></i>
        </div>
        <div class="searchbar">
            <h5>Welcome, <?php echo e(ucfirst(Auth::user()->usertype)); ?> </h5>
        </div>
        <div class="top-navbar-right ms-auto">
          <ul class="navbar-nav align-items-center">
            <li class="nav-item dropdown dropdown-large">
                <a class="nav-link" id="logout" href="<?php echo e(url('/logout')); ?>">
                    <div class="d-flex align-items-center">
                      <div class="ms-3"><span><i class="bi bi-lock-fill"></i>&nbsp;Logout</span></div>
                    </div>
                </a>
            </li>
          </ul>
        </div>
    </nav>
  </header>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('side_bar'); ?>
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
      <div>
        <img src="<?php echo e(asset('public/website/images/favicon.png')); ?>" class="logo-icon" alt="logo_icon">
      </div>
      <div>
        <h4 class="logo-text"><i>Sheeba</i></h4>
      </div>
      <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
      </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        <li class="<?php echo e((Request::is('dashboard')) ? 'mm-active' : ''); ?>">
            <a href="<?php echo e(url('/dashboard')); ?>">
                <div class="parent-icon"><i class="bi bi-house-fill"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

      <li class="<?php echo e(((Request::is('appointments')) || (Request::is('appointment/*'))) ? 'mm-active' : ''); ?>">
        <a href="<?php echo e(url('/appointments')); ?>">
          <div class="parent-icon"><i class="bi bi-grid-fill"></i>
          </div>
          <div class="menu-title">
            Appointments

              <?php
                $current = App\Appointment::where('nurse_id', null)->where('appointment_status', '!=', 'cancelled')->count();
              ?>

            <span id="showspan" style="display:<?php echo e(($current) ? 'block' : 'none'); ?>">
               <span id="un_count" class="notify-badge"> <?php echo e($current); ?> </span> 
            </span>
          
          </div>
        </a>
      </li>

      <li class="<?php echo e((Request::is('invoices')) ? 'mm-active' : ''); ?>">
        <a href="<?php echo e(url('/invoices')); ?>">
          <div class="parent-icon"><i class="bi bi-file-earmark-text-fill"></i>
          </div>
          <div class="menu-title">Invoices</div>
        </a>
      </li>

      <li class="<?php echo e((Request::is('nurses')) || (Request::is('nurse/*')) ? 'mm-active' : ''); ?>">
        <a href="<?php echo e(url('/nurses')); ?>">
          <div class="parent-icon"><i class="bi bi-person-fill"></i>
          </div>
          <div class="menu-title">Nurses</div>
        </a>
      </li>

      <li class="<?php echo e((Request::is('clients')) || (Request::is('client/*')) ? 'mm-active' : ''); ?>">
        <a href="<?php echo e(url('/clients')); ?>">
          <div class="parent-icon"><i class="bi bi-person-square"></i>
          </div>
          <div class="menu-title">Clients</div>
        </a>
      </li>

      <?php if(Auth::user()->usertype=='superadmin'): ?>
      <li class="<?php echo e((Request::is('admins')) || (Request::is('admin/*')) ? 'mm-active' : ''); ?>">
        <a href="<?php echo e(url('/admins')); ?>">
          <div class="parent-icon"><i class="bi bi-person-circle"></i>
          </div>
          <div class="menu-title">Admins</div>
        </a>
      </li>
      <?php endif; ?>
      
      <li class="<?php echo e((Request::is('referrals')) ? 'mm-active' : ''); ?>">
        <a href="<?php echo e(url('/referrals')); ?>">
          <div class="parent-icon"><i class="bi bi-share-fill"></i>
          </div>
          <div class="menu-title">Referrals</div>
        </a>
      </li>

      <li class="<?php echo e((Request::is('ads')) ? 'mm-active' : ''); ?>">
        <a href="<?php echo e(url('/ads')); ?>">
          <div class="parent-icon"><i class="bi bi-badge-ad"></i>
          </div>
          <div class="menu-title">Ads & Promos</div>
        </a>
      </li>

      

    </ul>
    <!--end navigation-->
 </aside>

 <script>

  var countelement = document.getElementById('un_count');
  var showspan = document.getElementById('showspan');

  Notification.requestPermission();

  function unassigned(){
      var oldcount = parseInt(countelement.innerHTML) ? parseInt(countelement.innerHTML) : 0;
      $.ajax({
        type : 'GET',
        url : "<?php echo e(url('/unassigned')); ?>",
        success : function(count) {
          if(count>0){
            if(count!=oldcount){
              showspan.style.display='block';
              if(count>oldcount){
                notification();
              }
              oldcount = count;
          }
        } else {
            showspan.style.display='none';
        }
        countelement.innerHTML = count;  
        }
    });
  }

  function notification(){
        let permission = Notification.permission;

        if(permission === "granted"){
        showNotification();
        } else if(permission === "default"){
        requestAndShowPermission();
        } else {
        alert("Use normal alert");
        }
  }

  function requestAndShowPermission() {
      Notification.requestPermission(function (permission) {
        if (permission === "granted") {
          showNotification();
        }
    });
  }

  function showNotification() {
      let title = "Appointment";
        let body = "New Appointment is Here";
        let notification = new Notification(title, { body });

        notification.onclick = () => {
            notification.close();
            window.parent.focus();
        }

  }               

 </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>   
        <?php echo $__env->yieldContent('main'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.static', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/858192.cloudwaysapps.com/xnrkmuucrp/public_html/resources/views/admin/layout.blade.php ENDPATH**/ ?>