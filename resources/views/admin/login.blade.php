@extends('admin.static')

@section('title')
    <title>Admin Login</title>
@endsection

<style>
  .page-content{
    margin-left: 0px !important;
  }
</style>

@section('main')

        <div class="container-fluid">  
          <div class="authentication-card">            
            <div class="card shadow rounded-0 overflow-hidden">

            @if(Session::has('fail')) 
              <div class="alert border-0 bg-danger alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                  <div class="fs-3 text-white"><i class="bi bi-x-circle-fill"></i></div>
                    <div class="ms-3">
                      <div class="text-white text-center">{{Session::get('fail')}}</div>
                    </div>
                </div>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>  
            @endif

              <div class="row g-0">
                <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
                  <img src="{{ asset('public/admin/images/error/login-img.jpg') }}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6">
                  <div class="card-body p-4 p-sm-5">
                  
                    <form class="form-body" action="{{ url('/login') }}" method="POST">
                        @csrf
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



@endsection
