@extends('admin.static')

@section('title')
    <title>Service Lists</title>
@endsection


@section('main')

<div class="container">

    @if(Session::has('fail'))
        <p class="alert-fail">{{Session::get('fail')}}</p>
    @elseif(Session::has('success'))
        <p class="alert-success">{{Session::get('success')}}</p>
    @endif 

    <div class="container" style="width: 50%; padding:25px; background-color:#BFBFBF">
        <form class="form-group" action="{{ url('/add_service') }}" method="POST">
            @csrf
            <select class="form-control" type="text" name="category" required>
                <option value="">Select a Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category }}</option>  
                    @endforeach
            </select> <br>
            <input class="form-control" type="text" name="service" placeholder="Service Name" required autocomplete="off"><br>
            <input class="form-control" type="text" name="pricing_scheme" placeholder="Pricing Scheme (e.g. Hour / Dose)" required autocomplete="off"><br>
            <input class="form-control" type="number" name="unit_price" placeholder="Unit Price" required autocomplete="off"><br>
            <span style="float:right"><button type="submit" class="btn btn-primary" style="margin-bottom:10px">Add Service</button></span>
        </form>
        <br>
    </div>

    <br>

    @if(sizeof($servicelists))
        <div class="container d-flex justify-content-center" style="padding-top:25px">
            <h4>All Services</h4>
        </div>

        <div class="container d-flex justify-content-center">

            <table class="table">

                <thead>
                    <tr>
                        <th scope="col" class="text-center">SL</th>
                        <th scope="col" class="text-center">Service Name</th>
                        <th scope="col" class="text-center">Pricing Scheme</th>
                        <th scope="col" class="text-center">Unit Price</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @php $count = 0; @endphp

                    @foreach($servicelists as $service)
                        <tr>
                            <th scope="row" class="text-center">{{ ++$count }}</th>
                            <td class="text-center">{{ $service->service_name }}</td>
                            <td class="text-center">{{ $service->pricing_scheme }}</td>
                            <td class="text-center">{{ $service->unit_price }}</td>
                            <td class="text-center"><button type="button" class="btn btn-info">Update</button></td>
                        </tr>
                    @endforeach 
                </tbody>

            </table>
        
        </div>
    @endif
</div>
@endsection

