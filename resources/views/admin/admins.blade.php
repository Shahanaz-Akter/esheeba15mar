@extends('admin.layout')

@section('title')
    <title>Admins</title>
@endsection

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

    #admintable_filter, #admintable_paginate{
        float: right;
    }


</style>

@section('main')

<div class="card">
    <div class="card-body">
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
      @elseif(Session::has('success'))
      <div class="alert border-0 bg-success alert-dismissible fade show py-2">
        <div class="d-flex align-items-center">
          <div class="fs-3 text-white"><i class="bi bi-check-circle-fill"></i></div>
            <div class="ms-3">
              <div class="text-white text-center">{{Session::get('success')}}</div>
            </div>
        </div>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div> 
      @endif
         <div class="card-header py-3">
                  <div class="row align-items-center">
                    <div class="col-md-3 col-12 me-auto mb-md-0 mb-3">
                        <h4>All Admins</h4>
                    </div>
                    <div class="col-md-2 col-6 text-end"> 
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#add_admin">Add Admin</button>
                    </div>
                 </div>
                

                <div class="modal fade" id="add_admin" tabindex="-1" aria-labelledby="#" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="border p-3 rounded">
                                <form class="row g-3" action="{{ url('/admin_add') }}" method="POST">
                                    @csrf
                                  <div class="col-12">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control" maxlength="11" required>
                                  </div>
                                  <div class="col-12">
                                    <label class="form-label">Admin Type</label>
                                    <select name="type" class="form-control" required>
                                        <option value="">Select an Admin Type ↓</option>
                                        <option value="superadmin">Superadmin</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                  </div>
                                  <div class="col-12">
                                    <div class="d-grid">
                                      <button type="submit" class="btn btn-primary">Add as Admin</button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                        </div>
                    </div>
                </div>
            @if(sizeof($admins))
                @foreach ($admins as $admin)

                <div class="modal fade" id="update{{ $admin->id }}" tabindex="-1" aria-labelledby="#" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <b>Are you Sure you Want to Toogle this Admin's Type?</b>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a href="{{ url('/toggle_admin/'.$admin->id) }}"><button type="button" class="btn btn-primary">Toggle</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal fade" id="resetpassword{{ $admin->id }}" tabindex="-1" aria-labelledby="#" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body"><b>Are you Sure you Want to Reset this Admin's Password?<br>Default Password is 00000000.</b></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a href="{{ url('/resetadminpassword/'.$admin->id) }}"><button type="button" class="btn btn-warning">Reset</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal fade" id="delete{{ $admin->id }}" tabindex="-1" aria-labelledby="#" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body"><b>Are you Sure you Want to Delete this Admin?</b></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a href="{{ url('/deleteadmin/'.$admin->id) }}"><button type="button" class="btn btn-danger">Delete</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
         </div>

    @if(sizeof($admins))
                <br>
        <div class="table-responsive">
            <table id="admintable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Phone</th>
                        <th>Admin Type</th>
                        <th class="text-center">Toggle</th>
                        <th class="text-center">Reset</th>
                        <th class="text-center">Delete</th>
                    </tr>
                </thead>

                <tbody>
                
                @foreach ($admins as $admin)
                    <tr>
                        <td>{{ $admin->phone }}</td>
                        <td>{{ ucfirst($admin->usertype) }}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#update{{ $admin->id }}">Toogle Admin Type</button>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#resetpassword{{ $admin->id }}">Reset Password</button>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $admin->id }}">Delete Admin</button>
                        </td>
                    </tr> 
                @endforeach

                </tbody>
            </table>
        </div>
    @else
    <br>
        <h5 class="text-center">No Admins Found !</h5>
    @endif
    </div>
</div>

@endsection