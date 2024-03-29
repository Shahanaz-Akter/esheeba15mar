@extends('admin.layout')

@section('title')
    <title>{{ $client->name }}</title>
@endsection
<style>
    form {
   display:inline;
   margin:0;
   padding:0;
}
</style>

@section('main')
<div class="row">
      <div class="card shadow-sm border-0">
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
            <div class="card shadow-none border">
              <div class="card-header">
                <h6 class="mb-0">CLIENT INFORMATION</h6>
              </div>
              <div class="card-body">
                <div class="row g-3">
                     <div class="col-6">
                     <div class="card shadow-sm border-0 overflow-hidden">
                        <div class="card-body">
                            <div class="profile-avatar text-center">
                              <img src="{{ asset($client->image) }}" class="rounded-circle shadow" width="120" height="120" alt="">
                            </div>
                        </div>
                      </div>
                  </div>                    
                <div class="col-6">
                    <form method="POST" action="{{ url('/updatepic/client/'.$client->id) }}" enctype="multipart/form-data">
                        @csrf
                    <div class="text-center mt-4">
                        <h4 class="mb-1">{{ $client->name }}</h4>
                        <p class="mb-0 text-secondary">{{ $client->phone }}</p>
                        <div class="input-group" style="margin-top: 20px">  
                            <input type="file" name="image" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" required>
                            <button class="btn btn-outline-secondary" type="submit" id="inputGroupFileAddon04">Change</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

                <form class="row g-3" method="POST" action="{{ url('/updateclient/'.$client->id) }}">
                    @csrf
                   <div class="col-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $client->email }}">
                  </div>
                  <div class="col-6">
                    <label class="form-label">Service Area</label>
                    <select class="form-control" name="service_area" required>
                        @php
                            $serviceareas = DB::table('serviceareas')->get();
                        @endphp
                        @foreach($serviceareas as $a)
                            <option value="{{ $a->id }}" {{ ($client->service_area==$a->id) ? 'selected' : '' }} {{ ($a->active) ? '' : 'disabled' }}>{{ $a->area }}</option>
                        @endforeach
                    </select>
                   </div>
                   <div class="col-6">
                    <label class="form-label">Blood Group</label>
                    <select class="form-control" name="blood_group">
                        @php
                            $bloodgroups = DB::table('bloodgroups')->get();
                        @endphp
                        @foreach($bloodgroups as $b)
                            <option value="{{ $b->id }}" {{ ($client->blood_group==$b->id) ? 'selected' : '' }}>{{ $b->group }}</option>
                        @endforeach
                    </select>
                   </div>
                   <div class="col-6">
                    <label class="form-label">Gender</label>
                    <select class="form-control" name="sex" required>
                        <option value="">Select Gender</option>
                        <option value="male" {{ ($client->sex=='male') ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ ($client->sex=='female') ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ ($client->sex=='other') ? 'selected' : '' }}>Other</option>
                    </select>
                 </div>
                   <div class="col-6">
                    <label class="form-label">Date of Birth</label>
                    <input type="date" name="birthday" class="form-control" value="{{ $client->date_of_birth }}" required>
                  </div>
                    <div class="col-6">
                      <label class="form-label">Current Address</label>
                      <input type="text" name="address" class="form-control" value="{{ $client->address }}" required>
                  </div>
                   <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                   </div>
    
                </form>
              </div>
            </div>
        </div>
      </div>
  </div>
  <!--end row-->
@endsection