@extends('admin.static')

@section('title')
    @yield('title')
@endsection

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

@section('top_header')
<header class="top-header">        
    <nav class="navbar navbar-expand gap-3">
      <div class="mobile-toggle-icon fs-3">
          <i class="bi bi-list"></i>
        </div>
        <div class="searchbar">
            <h5>Welcome, {{ ucfirst(Auth::user()->usertype) }} </h5>
        </div>
        <div class="top-navbar-right ms-auto">
          <ul class="navbar-nav align-items-center">
            <li class="nav-item dropdown dropdown-large">
                <a class="nav-link" id="logout" href="{{ url('/logout') }}">
                    <div class="d-flex align-items-center">
                      <div class="ms-3"><span><i class="bi bi-lock-fill"></i>&nbsp;Logout</span></div>
                    </div>
                </a>
            </li>
          </ul>
        </div>
    </nav>
  </header>
@endsection

@section('side_bar')
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
      <div>
        <img src="{{ asset('public/website/images/favicon.png') }}" class="logo-icon" alt="logo_icon">
      </div>
      <div>
        <h4 class="logo-text"><i>Sheeba</i></h4>
      </div>
      <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
      </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        <li class="{{ (Request::is('dashboard')) ? 'mm-active' : '' }}">
            <a href="{{ url('/dashboard') }}">
                <div class="parent-icon"><i class="bi bi-house-fill"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

      <li class="{{ ((Request::is('appointments')) || (Request::is('appointment/*'))) ? 'mm-active' : '' }}">
        <a href="{{ url('/appointments') }}">
          <div class="parent-icon"><i class="bi bi-grid-fill"></i>
          </div>
          <div class="menu-title">
            Appointments

              @php
                $current = App\Appointment::where('nurse_id', null)->where('appointment_status', '!=', 'cancelled')->count();
              @endphp

            <span id="showspan" style="display:{{ ($current) ? 'block' : 'none' }}">
               <span id="un_count" class="notify-badge"> {{ $current }} </span> 
            </span>
          
          </div>
        </a>
      </li>

      <li class="{{ (Request::is('invoices')) ? 'mm-active' : '' }}">
        <a href="{{ url('/invoices') }}">
          <div class="parent-icon"><i class="bi bi-file-earmark-text-fill"></i>
          </div>
          <div class="menu-title">Invoices</div>
        </a>
      </li>

      <li class="{{ (Request::is('nurses')) || (Request::is('nurse/*')) ? 'mm-active' : '' }}">
        <a href="{{ url('/nurses') }}">
          <div class="parent-icon"><i class="bi bi-person-fill"></i>
          </div>
          <div class="menu-title">Nurses</div>
        </a>
      </li>

      <li class="{{ (Request::is('clients')) || (Request::is('client/*')) ? 'mm-active' : '' }}">
        <a href="{{ url('/clients') }}">
          <div class="parent-icon"><i class="bi bi-person-square"></i>
          </div>
          <div class="menu-title">Clients</div>
        </a>
      </li>

      @if(Auth::user()->usertype=='superadmin')
      <li class="{{ (Request::is('admins')) || (Request::is('admin/*')) ? 'mm-active' : '' }}">
        <a href="{{ url('/admins') }}">
          <div class="parent-icon"><i class="bi bi-person-circle"></i>
          </div>
          <div class="menu-title">Admins</div>
        </a>
      </li>
      @endif
      
      <li class="{{ (Request::is('referrals')) ? 'mm-active' : '' }}">
        <a href="{{ url('/referrals') }}">
          <div class="parent-icon"><i class="bi bi-share-fill"></i>
          </div>
          <div class="menu-title">Referrals</div>
        </a>
      </li>

      <li class="{{ (Request::is('ads')) ? 'mm-active' : '' }}">
        <a href="{{ url('/ads') }}">
          <div class="parent-icon"><i class="bi bi-badge-ad"></i>
          </div>
          <div class="menu-title">Ads & Promos</div>
        </a>
      </li>

      {{-- <li class="{{ (Request::is('servicecategories')) ? 'mm-active' : '' }}">
        <a href="{{url('/servicecategories')}}">
          <div class="parent-icon"><i class="bi bi-bookmark-star-fill"></i>
          </div>
          <div class="menu-title">Service Categories</div>
        </a>
      </li>

      <li class="{{ (Request::is('servicelist')) ? 'mm-active' : '' }}">
        <a href="{{ url('/servicelist') }}">
          <div class="parent-icon"><i class="bi bi-front"></i>
          </div>
          <div class="menu-title">Services</div>
        </a>
      </li>

      <li>
        <a href="pages-user-profile.html">
          <div class="parent-icon"><i class="bi bi-person-lines-fill"></i>
          </div>
          <div class="menu-title">Service Areas</div>
        </a>
      </li> --}}

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
        url : "{{url('/unassigned')}}",
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
@endsection

@section('main')   
        @yield('main')
@endsection