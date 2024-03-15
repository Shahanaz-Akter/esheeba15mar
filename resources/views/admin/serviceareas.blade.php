@extends('admin.static')

@section('title')
    <title>Service Areas</title>
@endsection


@section('main')

<div class="container">

    @if(Session::has('fail'))
        <p class="alert-fail">{{Session::get('fail')}}</p>
    @elseif(Session::has('success'))
        <p class="alert-success">{{Session::get('success')}}</p>
    @endif 

    <div class="container" style="width: 50%; padding:25px; background-color:#BFBFBF">
        <form class="form-group" action="{{ url('/add_servicearea') }}" method="POST">
            @csrf
            <input class="form-control" type="text" name="area" placeholder="Service Area" autocomplete="off" required><br>
            <select class="form-control" type="text" name="status" required>
                <option value="0">Inactive</option>
                <option value="1">Active</option>
            </select><br>
            <span style="float:right"><button type="submit" class="btn btn-primary" style="margin-bottom:10px">Add Service Area</button></span>
        </form>
        <br>
    </div>

    <br>

    @if(sizeof($serviceareas))
        <div class="container d-flex justify-content-center" style="padding-top:25px">
            <h4>All Service Categories</h4>
        </div>

        <div class="container d-flex justify-content-center">

            <table class="table">

                <thead>
                    <tr>
                        <th scope="col" class="text-center">SL</th>
                        <th scope="col" class="text-center">Area</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @php $count = 0; @endphp

                    @foreach($serviceareas as $area)
                        <tr>
                            <th scope="row" class="text-center">{{ ++$count }}</th>
                            <td class="text-center">{{ $area->area }}</td>
                            <td class="text-center">{{ ($area->active) ? "Active" : "Inactive" }}</td>
                            <td class="text-center"><button type="button" class="btn btn-info">Update</button></td>
                        </tr>
                    @endforeach 
                </tbody>

            </table>
        
        </div>
    @endif
</div>
@endsection

