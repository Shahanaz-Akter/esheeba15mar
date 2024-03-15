@extends('admin.layout')

@section('title')
    <title>{{ ($appointment) ? $appointment->invoice_id : '404 Not Found' }}</title>
@endsection

@section('main')

<style>
    .row{
        padding-bottom: 10px;
    } 

    #nurse_assign_filter, #nurse_assign_paginate{
                float: right;
    }

</style>

@if($appointment)

    @php
        $client = App\Client::where('id', $appointment->client_id)->first();
        $nurse = null;
        $invoice = null;
        $allnurses = App\Nurse::where('active', 1)->get();

        if($appointment->invoice_id){ $invoice = App\Invoice::where('invoice_id', $appointment->invoice_id)->first(); }
        if($appointment->nurse_id){ $nurse = App\Nurse::where('id', $appointment->nurse_id)->first(); }
        
    @endphp

<p id="title" style="display: none"> {{ App\Service::where('id', $appointment->service_id)->value('service_name') }}
    ({{ DB::table('serviceareas')->where('id', $client->service_area)->value('area') }})</p>

<div class="card">
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
      <div class="row g-3 align-items-center">
        <div class="col-12 col-lg-4 col-md-6 me-auto">
          <h5 class="mb-1">Invoice ID : #{{ $appointment->invoice_id }}</h5>
        </div>
      </div>
     </div>
    <div class="card-body">
        <div class="row row-cols-1 row-cols-xl-2 row-cols-xxl-3">
           <div class="col">
             <div class="card border shadow-none radius-10">
               <div class="card-body">
                <div class="d-flex gap-3">
                  <div class="icon-box bg-light-primary border-0">
                    <i class="bi bi-person text-success"></i>
                  </div>
                  <div class="info">
                    <h6 class="mb-2">Client ({{ DB::table('serviceareas')->where('id', $client->service_area)->value('area') }})</h6>
                    <p class="mb-1">{{ $client->name }}</p>
                    @if($client->email)
                        <p class="mb-1">{{ $client->email }}</p>
                    @endif
                    <p class="mb-1">+88{{ $appointment->client_phone }}</p>
                    <p class="mb-1">{{ $appointment->client_address }}</p>

                  </div>
               </div>
               </div>
             </div>
           </div>
           <div class="col">
            <div class="card border shadow-none radius-10">
              <div class="card-body">
                <div class="d-flex gap-3">
                  <div class="icon-box bg-light-success border-0">
                    <i class="bi bi-person text-info"></i>
                  </div>
                  <div class="info">
                     <h6 class="mb-2">Nurse</h6>
                     @if($nurse)
                        <p class="mb-1">{{ $nurse->name }}</p>
                            @if( $nurse->email)
                                <p class="mb-1">{{ $nurse->email }}</p>
                            @endif
                        <p class="mb-1">+88{{ $nurse->phone }}</p>
                        <p class="mb-1">{{ $nurse->address }}</p>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleExtraLargeModal">Re-Assign Nurse</button>
                     @else
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleExtraLargeModal">Assign Nurse</button>
                      @endif

                      <div class="col">
                      <!-- Modal -->
                        <div class="modal fade" id="exampleExtraLargeModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table id="nurse_assign" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Nurse</th>
                                                        <th>Specialized In</th>
                                                        <th>Service Area</th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                
                                                <tbody>
                                                
                                                @foreach ($allnurses as $app)
                                                    <tr>
                                                        <td>{{ $app->name }}</td>
                                                        <td>{{ $app->specialized }}
                                                        <td>{{DB::table('serviceareas')->where('id', $app->service_area)->value('area')}}</td>
                                                        <td class="text-center">
                                                            @php $url = '/assign_nurse/'.$appointment->invoice_id.'/'.$app->id; @endphp
                                                            <a href="{{ url($url) }}"><button type="button" class="btn btn-primary">Assign</button></a>
                                                        </td>
                                                    </tr> 
                                                @endforeach
                                
                                                </tbody>
                                            </table>
                                        </div>                                      
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                     
                  </div>
               </div>
               </div>
              </div>
           </div>

          <div class="col">
            <div class="card border shadow-none radius-10">
              <div class="card-body">
                <div class="d-flex gap-3">
                  <div class="icon-box bg-light-danger border-0">
                    <i class="bx bx-donate-heart text-danger"></i>
                  </div>
                  <div class="info">
                    <h6 class="mb-2">Service Details</h6>
                    <p class="mb-1">{{ App\Service::where('id', $appointment->service_id)->value('service_name') }}</p>
                    <p class="mb-1">{{ date('d-m-Y h:i A', strtotime($appointment->appointment_date)) }}</p>
                  </div>
                </div>
              </div>
             </div>
        </div>

        <div class="col">
            <div class="card border shadow-none radius-10">
              <div class="card-body">
                <div class="d-flex gap-3">

                    @if($invoice->paid)
                        <div class="icon-box bg-light-success border-0">
                            <i class="bx bx-check text-success"></i>
                        </div>
                    @else
                        <div class="icon-box bg-light-danger border-0">
                            <i class="bx bx-x text-danger"></i>
                        </div>
                    @endif
                  <div class="info">
                    <h6 class="mb-2">{{ ($invoice->paid) ? 'Paid' : 'Unpaid' }}</h6>
                    <p class="mb-1">৳ {{ $invoice->net_total }}/= {{ ($invoice->coupon) ? '('.$invoice->coupon.')' : '' }}</p>
                    <p class="mb-1">{{ ($invoice->payment_method=='cash') ? 'Cash on Service' : (($invoice->payment_method=='cash') ? 'Online Payment' : '') }}</p>

                    @php $payurl = '/togglepayment/'.$appointment->invoice_id.'/'.(($invoice->paid) ? 0 : 1); @endphp

                    @if($invoice->paid)
                        <a href="{{url($payurl)}}"><button type="button" class="btn btn-primary">Mark as Unpaid</button></a>
                    @else
                        <a href="{{url($payurl)}}"><button type="button" class="btn btn-primary">Mark as Paid</button></a>
                    @endif                    
                  </div>
             
              </div>
              </div>
             </div>
        </div>

        <div class="col">
          <div class="card border shadow-none radius-10">
            <div class="card-body">
              <div class="d-flex gap-3">
                <div class="icon-box bg-light-info border-0">
                  <i class="bx bx-spreadsheet text-info"></i>
                </div>
                <div class="info">
                  <h6 class="mb-2">Status</h6>
                  <p class="mb-1">
                    <select name="status" class="form-control" onchange="updatestatus(this.value)">
                      <option value="pending" {{ ($appointment->appointment_status=='pending') ? 'selected' : '' }}>Pending</option>
                      <option value="completed" {{ ($appointment->appointment_status=='completed') ? 'selected' : '' }}>Completed</option>
                      <option value="cancelled" {{ ($appointment->appointment_status=='cancelled') ? 'selected' : '' }}>Cancelled</option>
                    </select>
                  </p>
                </div>
              </div>
            </div>
           </div>
      </div>

      </div>
      <!--end row-->

    </div>
  </div>

@else

<div class="error-404 d-flex align-items-center justify-content-center">
    <div class="container">
      <div class="card py-5">
        <div class="row g-0">
          <div class="col col-xl-5">
            <div class="card-body p-4">
              <h1 class="display-1"><span class="text-danger">4</span><span class="text-primary">0</span><span class="text-success">4</span></h1>
              <h2 class="font-weight-bold display-4">Not Found</h2>
            </div>
          </div>
          <div class="col-xl-7">
            <img src="{{ asset('public/admin/images/error/404-error.png') }}" class="img-fluid" alt="">
          </div>
        </div>
        <!--end row-->
      </div>
    </div>
  </div>
@endif


<script>
  function updatestatus(status){
    var url = 'updatestatus/'+"{{ $appointment->invoice_id }}"+'/'+status;
    var redirect = '{{ url(":slug") }}';
    redirect = redirect.replace(':slug', url);
    window.location.href=redirect;
}
</script>


@endsection