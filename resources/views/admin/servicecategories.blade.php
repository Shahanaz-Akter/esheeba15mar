@extends('admin.layout')

@section('title')
    <title>Service Categories</title>
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

    #categories_filter, #categories_paginate{
        float: right;
    }

    .btn-group, #categories_info{
        float: left;
    }

</style>

@section('main')

<div class="card">
    <div class="card-body">
         <div class="card-header py-3">
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
                  <div class="row align-items-center">
                    <div class="col-md-3 col-12 me-auto mb-md-0 mb-3">
                        <h4>All Service Categories</h4>
                    </div>
                    <div class="col-md-2 col-6 text-end"> 
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#servicecategory">Add Service Category</button>
                    </div>
                 </div>
                </div>


                <div class="modal fade" id="servicecategory" tabindex="-1" aria-labelledby="#" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="border p-3 rounded">
                                <form class="row g-3" action="{{ url('/add_servicecategories') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                  <div class="col-12">
                                    <label class="form-label">Icon</label>
                                    <input type="file" name="icon" class="form-control" accept="image/*" required>
                                  </div>
                                  <div class="col-12">
                                    <label class="form-label">Category Name</label>
                                    <input type="text" name="category" class="form-control" required>
                                  </div>
                                  <div class="col-12">
                                    <div class="d-grid">
                                      <button type="submit" class="btn btn-primary">Add Category</button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                        </div>
                    </div>
                </div>

    @if(sizeof($servicecategories))
                <br>
        <center>
        <div class="table-responsive" style="width: 60%">
            <table id="categories" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Icon</th>
                        <th>Service Category</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                
                @foreach ($servicecategories as $category)
                    <tr>
                        <td class="text-center">
                               <img src="{{ asset($category->icon) }}" class="rounded-circle" width="60" height="auto">
                        </td>
                        <td>{{ $category->category }}</td>
                        <td>{{ ($category->active) ? 'Active' : 'Inactive' }}</td>
                    </tr> 
                @endforeach

                </tbody>
            </table>
        </div>
    @else
    <br>
        <h5 class="text-center">No Service Categories Found !</h5>
    @endif
    </div>
</div>

@endsection