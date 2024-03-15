@extends('admin.layout')

@section('title')
    <title>Refers</title>
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

    #client_filter, #client_paginate{
        float: right;
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
                        <h4>All Referrals</h4>
                    </div>
                    <div class="col-md-2 col-6 text-end"> 
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#referal_code">Add Referral Code</button>
                    </div>
                 </div>
                </div>


                <div class="modal fade" id="referal_code" tabindex="-1" aria-labelledby="#" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="border p-3 rounded">
                                <form class="row g-3" action="{{ url('/add_referral') }}" method="POST">
                                    @csrf
                                  <div class="col-12">
                                    <label class="form-label">Discount</label>
                                    <input type="number" name="discount" class="form-control" required>
                                  </div>
                                  <div class="col-12">
                                    <label class="form-label">Valid Till (Keep Blank for Unlimited Time)</label>
                                    <input type="date" name="valid_till" class="form-control">
                                  </div>
                                  <div class="col-12">
                                    <div class="d-grid">
                                      <button type="submit" class="btn btn-primary">Add Referral</button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                        </div>
                    </div>
                </div>

    @if(sizeof($referrals))
                <br>
        <div class="table-responsive">
            <table id="client" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Refer Code</th>
                        <th>Referrer Phone</th>
                        <th>Referrer Type</th>
                        <th>Discount Percentage</th>
                        <th>Used</th>
                        <th>Validity (Set to Limit Validity)</th>
                    </tr>
                </thead>

                <tbody>
                
                @foreach ($referrals as $refer)

                    @php
                        $uid = App\User::where('id', $refer->referer_uid)->first();
                    @endphp
                    <tr>
                        <td>{{ $refer->refer_code }}</td>
                        <td>{{ $uid->phone }}</td>
                        <td>{{ ucfirst($uid->usertype) }}</td>
                        <td>
                            <form method="POST" action="{{url('/update_discount/'.$refer->id)}}">
                                @csrf
                            <span style="float: left; width:25%;">
                                <input type="number" class="form-control" name="discount" value="{{ $refer->off_percentage }}" max="75">
                            </span>
                            <span style="float: right;"><button type="submit" class="btn btn-info">Change</button></span>
                            </form>
                        </td>
                        <td>{{ $refer->use_count }}</td>
                        <td>
                            <form method="POST" action="{{url('/set_validity/'.$refer->id)}}">
                                @csrf                            
                            <span style="float: left; width:50%;">
                                <input type="date" class="form-control" name="valid_till" value="{{$refer->valid_till}}">
                            </span>
                            <span style="float: right;"><button type="submit" class="btn btn-info">Change</button></span>
                            </form>
                        </td>
                    </tr> 
                @endforeach

                </tbody>
            </table>
        </div>
    @else
    <br>
        <h5 class="text-center">No Refer Codes Found !</h5>
    @endif
    </div>
</div>

@endsection