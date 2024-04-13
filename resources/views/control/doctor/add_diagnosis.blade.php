@extends('control.layout._app')
@section('content')

<div class="card">
    <div class="card-body">
        @include('auth.message')
        @include('auth.error')
        <h5 class="card-title">Diagnosis</h5>
        <form action="{{url('_doctor/add_diagnosis')}}" class="form-control" method="POST">
            @csrf
            <div class="col-md-6">
                <label for="inputPassword5" class="form-label">Diagnosis Category<sup style="color:red;">*</sup></label>
                <input type="text" class="form-control" id="inputPassword5" name="name">
            </div>
            <div class="col-md-12">
                <label for="inputPassword5" class="form-label">Description<sup style="color:red;">*</sup></label>
                <textarea class="form-control" name="description"></textarea>
            </div>
            <br>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Add Category</button>                  
            </div>
        </form>
    </div>
</div>
@endsection