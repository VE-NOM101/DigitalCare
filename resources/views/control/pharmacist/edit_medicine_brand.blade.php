@extends('control.layout._app')
@section('content')
    <div class="card">
        <div class="card-body">
            @include('auth.message')
            @include('auth.error')
            <h5 class="card-title">Edit Medicine Brand</h5>
            <form action="{{ url('_pharmacist/edit_medicine_brand/'.$getBrand->id) }}" class="form-control" method="POST">
                @csrf
                <div class="col-md-12">
                    <label for="inputPassword5" class="form-label">Brand<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputPassword5" name="brand" value="{{$getBrand->brand}}">
                </div>
                <div class="col-md-12">
                    <label for="inputPassword5" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputPassword5" name="email" value="{{$getBrand->email}}">
                </div>
                <div class="col-md-12">
                    <label for="inputPassword5" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="inputPassword5" name="phone" value="{{$getBrand->phone}}">
                </div>
                <br>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update Brand</button>
                </div>
            </form>
        </div>
    </div>
@endsection
