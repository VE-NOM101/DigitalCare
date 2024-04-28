@extends('control.layout._app')
@section('content')
    
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Edit Beds</h5>

        <!-- Horizontal Form -->
        <form action="{{url('/_admin/edit_bed/'.$getBed->id)}}" method="POST">
            @csrf
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Type</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputText" name="type" value="{{$getBed->type}}">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                   <textarea name="description" class="form-control">{{$getBed->description}}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword" class="col-sm-2 col-form-label">Charge</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputPassword" name="charge" value="{{$getBed->charge}}">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword" class="col-sm-2 col-form-label">Size</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputPassword" name="size" value="{{$getBed->size}}">
                </div>
            </div>
            <div class="row mb-3">
                <label for="colorPicker" class="col-sm-2 col-form-label">Color</label>
                <div class="col-sm-2">
                    <input type="color" class="form-control" id="colorPicker" name="color" value="{{$getBed->color}}">
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Edit</button>
                <a href="{{url('/_admin/bed_management')}}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
        <!-- End Horizontal Form -->

    </div>
</div>

@endsection