@extends('admin.layout')

@section('title')
<title>Nurses</title>
@endsection

<style>
    @media (min-width: 768px) {
        .col-md-3 {
            flex: 0 0 auto;
            width: 35% !important;
        }
    }

    @media (max-width: 1300px) {

        .table-responsive {
            overflow-x: auto;
        }
    }

    .card-header {
        padding: 0 !important;
    }

    .row {
        padding-bottom: 10px;
    }

    #nurse_filter,
    #nurse_paginate {
        float: right;
    }
</style>

@section('main')

<div class="card">
    <div class="card-body">
        <div class="card-header py-3">
            <div class="row align-items-center">
                <div class="col-md-3 col-12 me-auto mb-md-0 mb-3">
                    <h4>{{ucfirst($current)}} Nurses</h4>
                </div>
                <div class="col-md-2 col-6">
                    <select name="show" class="form-select" onchange="redirect(this.value)">
                        <option value="all" {{ ($current=='all') ? 'selected' : ''}}>All</option>
                        <option value="active" {{ ($current=='active') ? 'selected' : ''}}>Active</option>
                        <option value="inactive" {{ ($current=='inactive') ? 'selected' : ''}}>Inactive</option>
                    </select>
                </div>
            </div>
        </div>
        @if(sizeof($nurses))
        <br>
        <div class="table-responsive">

            <table id="nurse" class="table table-striped table-bordered ">
                <thead>
                    <tr>
                        <th>Phone</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Birthday</th>
                        <th>Gender</th>
                        <th>Blood_Group</th>
                        <th>Service_Area</th>
                        <th>Address</th>
                        <th>Registered_Date</th>
                        <th>Work_Address</th>
                        <th>Specialized</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($nurses as $nurse)
                    <tr>
                        <td>{{ $nurse->phone }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-3 cursor-pointer">
                                <img src="{{ asset($nurse->image) }}" class="rounded-circle" width="30" height="30">
                                <div class="">
                                    <p class="mb-0">{{ $nurse->name }}</p>
                                </div>
                            </div>
                        </td>
                        <td>{{ ($nurse->email) ? $nurse->email : 'N/A' }}</td>
                        <td>{{ ($nurse->date_of_birth) ? $nurse->date_of_birth : 'N/A' }}</td>
                        <td>{{ ($nurse->sex) ? ucfirst($nurse->sex) : 'N/A' }}</td>
                        <td>{{ ($nurse->blood_group) ? DB::table('bloodgroups')->where('id', $nurse->blood_group)->value('group') : 'N/A' }}</td>
                        <td>{{ DB::table('serviceareas')->where('id', $nurse->service_area)->value('area') }}</td>
                        <td>{{ ($nurse->address) ? ucwords($nurse->address) : 'N/A' }}</td>
                        <td>{{ ($nurse->created_at)? $nurse->created_at : 'N/A' }}</td>
                        <td>{{ ($nurse->current_work_address) ? ucwords($nurse->current_work_address) : 'N/A' }}</td>
                        <td>{{ ($nurse->specializes) ? ucwords($nurse->specializes) : 'N/A' }}</td>
                        <td class="">
                            <!-- <a class="me-2" href="{{ url('/nurse/'.$nurse->id) }}"><button type="button" class="btn btn-primary">Update</button></a> -->
                            <a class="me-2" href="{{ url('/nurse/'.$nurse->id) }}"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                    <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                                </svg>
                            </a>

                            <a href="{{ url('/deletenurse/'.$nurse->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512">
                                    <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />

                                </svg>
                            </a>

                        </td>
                    </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
        @else
        <br>
        <h5 class="text-center">No Nurses Found !</h5>
        @endif
    </div>
</div>

<script>
    function redirect(show) {
        var url = '{{ url("/nurses?show=:slug") }}';
        url = url.replace(':slug', show);
        window.location.href = url;
    }
</script>

@endsection