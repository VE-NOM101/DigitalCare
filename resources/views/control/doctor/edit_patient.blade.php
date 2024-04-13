@extends('control.layout._app')

@section('content')
    <div class="card">

        <div class="card-body">

            @include('auth.error')
            @include('auth.message')
            <!-- Multi Columns Form -->
            <form class="row g-3" action="{{url('_doctor/update_patient/'.$getPatient->id)}}" method="POST">
                @csrf
                <h5 style="text-align:center;" class="card-title alert alert-info">Basic Information</h5>
                {{-- <label for="inputPassword5" class="form-label">#Patient-ID<sup style="color:red;">*</sup></label>
                <input type="text" class="form-control" id="inputPassword5" disabled> --}}
                
                <div class="col-md-6">
                    <label for="inputPassword5" class="form-label">Name<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputPassword5" name="name" value="{{$getPatient->name}}">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail5" class="form-label">Email<sup style="color:red;">*</sup></label>
                    <input type="number" id="selectedID" name="id" value="" hidden>
                    <input type="email" class="form-control" id="inputEmail" name="email" value="{{$getPatient->email}}" disabled>
                </div>
                <div class="col-md-4">
                    <label for="inputPassword5" class="form-label">Gender<sup style="color:red;">*</sup></label>
                    <select id="inputState" class="form-select" name="gender">
                        <option value="male" @if($getPatient->gender == 'male') @selected(true) @endif>Male</option>
                        <option value="female" @if($getPatient->gender == 'female') @selected(true) @endif>Female</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <label for="inputAddress5" class="form-label">Address<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputAddres5s" name="address" value="{{$getPatient->address}}">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">Age<sup style="color:red;">*</sup></label>
                    <input type="number" class="form-control" id="inputCity" name="age" value="{{$getPatient->age}}">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">Contact Number<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputCity" name="phone" value="{{$getPatient->phone}}">
                </div>
                {{-- <div class="col-md-12">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Photo</label>
                    <input class="form-control" type="file" id="formFile" name="photo_path">
                </div> --}}
                <hr />

                <h5 style="text-align:center;" class="card-title alert alert-info mt-2">Medical Information</h5>
                <div class="col-md-6">
                    <label for="inputPassword5" class="form-label">Height<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputPassword5" placeholder="Enter Height In Centimeter" name="height" value="{{$getPatient->height}}">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword5" class="form-label">Blood Group<sup style="color:red;">*</sup></label>
                    <select id="inputState" class="form-select" name="blood_group">
                        <option value="A+" @if($getPatient->blood_group=='A+') @selected(true) @endif>A+</option>
                        <option value="A-" @if($getPatient->blood_group=='A-') @selected(true) @endif>A-</option>
                        <option value="B+" @if($getPatient->blood_group=='B+') @selected(true) @endif>B+</option>
                        <option value="B-" @if($getPatient->blood_group=='B-') @selected(true) @endif>B-</option>
                        <option value="O+" @if($getPatient->blood_group=='O+') @selected(true) @endif>O+</option>
                        <option value="O-" @if($getPatient->blood_group=='O-') @selected(true) @endif>O-</option>
                        <option value="AB+" @if($getPatient->blood_group=='AB+') @selected(true) @endif>AB+</option>
                        <option value="AB-" @if($getPatient->blood_group=='AB-') @selected(true) @endif>AB-</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="inputPassword5" class="form-label">Pulse<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputPassword5" placeholder="Enter Pulse" name="pulse" value="{{$getPatient->pulse}}">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword5" class="form-label">Blood Pressure<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputPassword5" placeholder="Enter Blood Pressure" name="blood_pressure" value="{{$getPatient->blood_pressure}}">
                </div>
                <div class="col-md-12">
                    <label for="inputPassword5" class="form-label">Allergy<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputPassword5" placeholder="Enter Allergy Symptoms" name="allergy" value="{{$getPatient->allergy}}">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword5" class="form-label">Weight<sup style="color:red;">*</sup></label>
                    <input type="number" class="form-control" id="inputPassword5" placeholder="Enter Weight" name="weight" value="{{$getPatient->weight}}">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword5" class="form-label">Respiration<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputPassword5" placeholder="Enter Respiration" name="respiration" value="{{$getPatient->respiration}}">
                </div>
                <div class="col-md-12">
                    <label for="inputPassword5" class="form-label">Diet<sup style="color:red;">*</sup></label>
                    <select id="inputState" class="form-select" name="diet">
                        <option value="vegetarian" @if($getPatient->diet=='vegetarian') @selected(true) @endif >Vegetarian</option>
                        <option value="non-vegetarian" @if($getPatient->diet=='non-vegetarian') @selected(true) @endif>Non-Vegetarian</option>
                        <option value="vegan" @if($getPatient->diet=='vegan') @selected(true) @endif>Vegan</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>                  
                </div>
                <!-- End Multi Columns Form -->
            </form>
        </div>


    </div>
@endsection
