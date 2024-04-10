@extends('control.layout._app')
@section('content')
    <div class="col-lg-12">
        @include('auth.message')
        @include('auth.error')
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Schedule</h5>

                <form action="{{url('/_doctor/update_schedule/'.$getSchedule->id)}}" method="POST">
                    @csrf

                    <!-- Table with stripped rows -->
                    <div class="row mb-3">
                        <label for="per_patient_time" class="col-sm-2 col-form-label"><b>Per patient time(In Minutes):</b> </label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" id="per_patient_time" name="per_patient_time" value="{{$getSchedule->per_patient_time}}">
                        </div>
                    </div>
                    <table class="table table-striped">

                        <thead>
                            <tr>
                                <th scope="col">AVAILABLE ON:</th>
                                <th scope="col">AVAILABLE FROM:</th>
                                <th scope="col">AVAILABLE TO:</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <th scope="row">Monday</th>
                                <td>
                                    <div class="row mb-3">
                                        <div class="col-sm-10">
                                            <input class="form-control" type="time" id="formFile" name="monday1" value="{{$getSchedule->monday1}}">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row mb-3">
                                        <div class="col-sm-10">
                                            <input class="form-control" type="time" id="formFile" name="monday2" value="{{$getSchedule->monday2}}">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Tuesday</th>
                                <td>
                                    <div class="row mb-3">
                                        <div class="col-sm-10">
                                            <input class="form-control" type="time" id="formFile" name="tuesday1" value="{{$getSchedule->tuesday1}}">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row mb-3">
                                        <div class="col-sm-10">
                                            <input class="form-control" type="time" id="formFile" name="tuesday2" value="{{$getSchedule->tuesday2}}">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Wednesday</th>
                                <td>
                                    <div class="row mb-3">
                                        <div class="col-sm-10">
                                            <input class="form-control" type="time" id="formFile" name="wednesday1" value="{{$getSchedule->wednesday1}}">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row mb-3">
                                        <div class="col-sm-10">
                                            <input class="form-control" type="time" id="formFile" name="wednesday2" value="{{$getSchedule->wednesday2}}">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Thursday</th>
                                <td>
                                    <div class="row mb-3">
                                        <div class="col-sm-10">
                                            <input class="form-control" type="time" id="formFile" name="thursday1" value="{{$getSchedule->thursday1}}">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row mb-3">
                                        <div class="col-sm-10">
                                            <input class="form-control" type="time" id="formFile" name="thursday2" value="{{$getSchedule->thursday2}}">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Friday</th>
                                <td>
                                    <div class="row mb-3">
                                        <div class="col-sm-10">
                                            <input class="form-control" type="time" id="formFile" name="friday1" value="{{$getSchedule->friday1}}">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row mb-3">
                                        <div class="col-sm-10">
                                            <input class="form-control" type="time" id="formFile" name="friday2" value="{{$getSchedule->friday2}}">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Sunday</th>
                                <td>
                                    <div class="row mb-3">
                                        <div class="col-sm-10">
                                            <input class="form-control" type="time" id="formFile" name="sunday1" value="{{$getSchedule->sunday1}}">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row mb-3">
                                        <div class="col-sm-10">
                                            <input class="form-control" type="time" id="formFile" name="sunday2" value="{{$getSchedule->sunday2}}">
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        </tbody>

                    </table>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
                <!-- End Table with stripped rows -->

            </div>
        </div>
    </div>
@endsection
