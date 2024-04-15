@extends('control.layout._app')
@section('content')

<div class="card col-lg-6">
    <div class="card-body">
        @include('auth.message')
        @include('auth.error')
        <h5 class="card-title">Add Medicine Category</h5>
        <form action="{{url('_pharmacist/add_medicine_category')}}" class="form-control" method="POST">
            @csrf
            <div class="col-md-12">
                <label for="inputPassword5" class="form-label">Medicine Category<sup style="color:red;">*</sup></label>
                <input type="text" class="form-control" id="inputPassword5" name="name">
            </div>
            <br>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Add Category</button>                  
            </div>
        </form>
    </div>
</div>
@endsection