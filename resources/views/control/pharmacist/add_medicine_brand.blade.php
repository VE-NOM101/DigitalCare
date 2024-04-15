@extends('control.layout._app')
@section('content')
    <div class="card col-lg-6">
        <div class="card-body">
            @include('auth.message')
            @include('auth.error')
            <h5 class="card-title">Add Medicine Brand</h5>
            <form action="{{ url('_pharmacist/add_medicine_brand') }}" class="form-control" method="POST">
                @csrf
                <div class="col-md-12">
                    <label for="inputPassword5" class="form-label">Brand<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputPassword5" name="brand">
                </div>
                <div class="col-md-12">
                    <label for="inputPassword5" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputPassword5" name="email">
                </div>
                <div class="col-md-12">
                    <label for="inputPassword5" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="inputPassword5" name="phone">
                </div>
                <br>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Add Brand</button>
                </div>
            </form>
        </div>
    </div>
@endsection
