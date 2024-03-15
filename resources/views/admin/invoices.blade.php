@extends('admin.layout')

@section('title')
    <title>Invoices</title>
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

    #appointment_filter, #appointment_paginate{
                float: right;
    }

</style>

@section('main')

<div class="card">
    <div class="card-body">
         <div class="card-header py-3">
                  <div class="row align-items-center">
                    <div class="col-md-3 col-12 me-auto mb-md-0 mb-3">
                        <h4>{{ucfirst($current)}} Invoices</h4>
                    </div>
                    <div class="col-md-2 col-6"> 
                        <select name="show" class="form-select" onchange="redirect(this.value)">
                            <option value="all" {{ ($current=='all') ? 'selected' : ''}}>All</option>
                            <option value="paid" {{ ($current=='paid') ? 'selected' : ''}}>Paid</option>
                            <option value="unpaid" {{ ($current=='unpaid') ? 'selected' : ''}}>Unpaid</option>
                        </select>
                    </div>
                 </div>
                </div>
    @if(sizeof($invoices))
                <br>
        <div class="table-responsive">
            <table id="appointment" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Appointment ID</th>
                        <th>Cuopon</th>
                        <th>Net Total</th>
                        <th>Payment Method</th>
                        <th>Paid Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                
                @foreach ($invoices as $app)
                    <tr>
                        <td>{{ $app->invoice_id }}</td>
                        <td>{{ ($app->coupon) ? ($app->coupon) : 'N/A' }}</td>
                        <td>৳ {{ $app->net_total}}/=</td>
                        <td>{{ ucfirst($app->payment_method) }}</td>
                        @if($app->paid)
                            <td class="bg-success text-white">Paid</td>
                        @else
                            <td class="bg-danger text-white">Unpaid</td>
                        @endif
                        <td class="text-center">
                            @php
                                $id = DB::table('appointments')->where('invoice_id', $app->invoice_id)->value('id');
                            @endphp
                            <a href="{{ url('/appointment/'.$id) }}"><button type="button" class="btn btn-primary">Details</button></a>
                        </td>
                    </tr> 
                @endforeach

                </tbody>
            </table>
        </div>
    @else
    <br>
        <h5 class="text-center">No Invoices Found !</h5>
    @endif
    </div>
</div>

<script>
    function redirect(show){
        var url = '{{ url("/invoices?show=:slug") }}';
        url = url.replace(':slug', show);
        window.location.href=url;
    }
</script>

@endsection