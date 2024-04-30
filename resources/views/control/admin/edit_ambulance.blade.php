@extends('control.layout._app')
@section('content')
    <div class="card">
        @include('auth.error')
        @include('auth.message')
        <div class="card-body">
            <h5 class="card-title">Edit Ambulance</h5>

            <!-- Horizontal Form -->
            <form action="{{ url('/_admin/edit_ambulance/'.$getAmb->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">:Example Number Plate:</label>
                    <div class="col-sm-10">
                        <img class="form-control" src="{{ asset('/digitalcare/ambulance/Number_plate.png') }}"
                            alt="Number Plate" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">#Reg No</label>
                    <div class="col-sm-10">
                        <input id="inputText" name="reg_no" class="form-control" type="text"
                            value="{{ $getAmb->reg_no }}" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText1" class="col-sm-2 col-form-label">Driver</label>
                    <div class="col-sm-10">
                        <input id="inputText1" name="driver" class="form-control" type="text"
                            value="{{ $getAmb->driver }}" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText2" class="col-sm-2 col-form-label">Contact</label>
                    <div class="col-sm-10">
                        <input id="inputText2" name="contact" class="form-control" type="text"
                            value="{{ $getAmb->contact }}" />
                    </div>
                </div>
                <div class="row mb-3 justify-content-center">
                    <img style="width: 300px; height: 180px; border-radius: 40px; border:1px solid grey"
                        src="{{ asset('digitalcare/admin/ambulance/' . $getAmb->photo_path) }}" />
                </div>
                
                <div class="row mb-3">
                    
                    <label for="inputText2" class="col-sm-2 col-form-label">Photo</label>
                    <div class="col-sm-10">
                        <input id="inputText2" name="photo_path" class="form-control" type="file" />
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <a href="{{ url('/_admin/ambulance') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
            <!-- End Horizontal Form -->

        </div>
    </div>
@endsection
