@extends('control.layout._app')

@section('content')

<div class="col-md-6" style="width: 36%; position:relative; left:32%;">
    <form action="{{url('/_user/add_profile_picture/'.$id)}}" class="form-control" method="POST" enctype="multipart/form-data">
      @csrf 
        <div class="card">
            <img src="@if ($getPatient->photo_path){{ asset('/digitalcare/patients/profile/'.$getPatient->photo_path) }} @else {{ asset('/digitalcare/patients/profile/img.jpg') }} @endif" class="card-img-top" alt="..." style="border-radius:15px;border:grey 2px solid;">
            <div class="card-body">
              <h5 class="card-title">Profile Picture</h5>
              <label for="photo_path">Upload</label>
              <input id="photo_path" type="file" class="form-control" name="photo_path"/>
            </div>
            <Button class="btn btn-primary">Submit</Button>
          </div>
    </form>
</div>
    
@endsection