@extends('admin.layout')

@section('title')
    <title>Ads & Promos</title>
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
                        <h4>All Ads & Promos</h4>
                    </div>
                    <div class="col-md-2 col-6 text-end"> 
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#servicecategory">New Ads</button>
                    </div>
                 </div>
                </div>


                <div class="modal fade" id="servicecategory" tabindex="-1" aria-labelledby="#" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="border p-3 rounded">
                                <form class="row g-3" action="{{ url('/new_ads') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                  <div class="col-12">
                                    <label class="form-label">Ads Banner</label>
                                    <input type="file" name="banner" class="form-control" accept="image/*" required>
                                  </div>
                                  <div class="col-12">
                                    <label class="form-label">Ads Title</label>
                                    <input type="text" name="title" class="form-control" required>
                                  </div>
                                  <div class="col-12">
                                    <div class="d-grid">
                                      <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                        </div>
                    </div>
                </div>

    @if(sizeof($ads))
                <br>
        <center>
        <div class="table-responsive" style="width: 60%">
            <table id="categories" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Ads</th>
                        <th>title</th>
                        <th>Creation Date</th>
                    </tr>
                </thead>

                <tbody>
                
                @foreach ($ads as $ad)
                    <tr>
                        <td class="text-center">
                               <img src="{{ asset($ad->ads_banner) }}"  width="200" height="auto">
                        </td>
                        <td>{{ $ad->title }}</td>
                        <td>{{ $ad->created_at }}</td>
                    </tr> 
                @endforeach

                </tbody>
            </table>
        </div>
    @else
    <br>
        <h5 class="text-center">No Ads or Promos Found !</h5>
    @endif
    </div>
</div>

@endsection