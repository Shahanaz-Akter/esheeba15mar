@extends('admin.layout')

@section('title')
    <title>Appointments</title>
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
                        <h4>{{ucfirst($current)}} Appointments</h4>
                    </div>
                    <div class="col-md-2 col-6"> 
                        <select name="show" class="form-select" onchange="redirect(this.value)">
                            <option value="unassigned" {{ ($current=='unassigned') ? 'selected' : ''}}>Unassigned</option>
                            <option value="ongoing" {{ ($current=='ongoing') ? 'selected' : ''}}>On Going</option>
                            <option value="completed" {{ ($current=='completed') ? 'selected' : ''}}>Completed</option>
                            <option value="cancelled" {{ ($current=='cancelled') ? 'selected' : ''}}>Cancelled</option>
                        </select>
                    </div>
                 </div>
                </div>
    @if(sizeof($appointments))
                <br>
        <div class="table-responsive">
            <table id="appointment" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Appointment ID</th>
                        <th>Service</th>
                        <th>Client</th>
                        <th>Nurse</th>
                        <th>Appointment Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                
                @foreach ($appointments as $app)
                    <tr>
                        <td>{{$app->invoice_id}}</td>
                        <td>{{DB::table('services')->where('id', $app->service_id)->value('service_name')}}</td>
                        <td>{{App\Client::where('id', $app->client_id)->value('name')}}</td>
                        <td>{{ ($app->nurse_id) ? (App\Nurse::where('id',$app->nurse_id)->value('name')) : 'N/A' }}</td>
                        <td>{{date('d-m-Y h:i A', strtotime($app->appointment_date))}}</td>
                        <td class="text-center">
                            <a href="{{ url('/appointment/'.$app->id) }}"><button type="button" class="btn btn-primary">Update</button></a>
                        </td>
                    </tr> 
                @endforeach

                </tbody>
            </table>
        </div>
    @else
    <br>
        <h5 class="text-center">No Appointments Found !</h5>
    @endif
    </div>
</div>

<script>
    function redirect(show){
        var url = '{{ url("/appointments?show=:slug") }}';
        url = url.replace(':slug', show);
        window.location.href=url;
    }
</script>

@endsection