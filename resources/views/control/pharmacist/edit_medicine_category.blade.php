@extends('control.layout._app')
@section('content')
    <div class="card">
        <div class="card-body">
            @include('auth.message')
            @include('auth.error')
            <h5 class="card-title">Edit Medicine Category</h5>
            <form action="{{ url('_pharmacist/edit_medicine_category/'.$getCategory->id) }}" class="form-control" method="POST">
                @csrf
                <div class="col-md-6">
                    <label for="inputPassword5" class="form-label">Medicine Category<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputPassword5" name="name"
                        value="{{ $getCategory->name }}">
                </div>
                <div class="col-md-6 form-check form-switch">
                    <label class="form-check-label" for="flexSwitchCheckChecked">Active/Inactive</label>
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"  name='isActive' @if($getCategory->isActive ==1) @checked (true) value="1" @else value="0" @endif>
                </div>
                <br>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </div>
            </form>
        </div>
    </div>
@endsection
