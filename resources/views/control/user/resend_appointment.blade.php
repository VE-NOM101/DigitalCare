@extends('control.layout._app')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Resend Appointment Manager</h5>
                        @include('auth.error')
                        @include('auth.message')
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home"
                                    aria-selected="true">Appointments</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2" id="borderedTabContent">
                            <div class="tab-pane fade show active" id="bordered-home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <form action="{{ url('/_user/post_resend_appointment') }}" method="POST">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $getRA->name }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="email"
                                                value="{{ $getRA->email }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputNumber" class="col-sm-2 col-form-label">Phone</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="phone"
                                                value="{{ $getRA->phone }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputNumber" class="col-sm-2 col-form-label">Preferred Date</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" name="preferred_date"
                                                value="{{ $getRA->preferred_date }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" style="height: 100px" name="description">{{ $getRA->description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Doctor</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" aria-label="multiple select example"
                                                name="doctor_id">
                                                @foreach ($getDoctor as $doctor)
                                                    @if ($doctor->id == $getRA->doctor_id)
                                                        <option value="{{ $doctor->id }}" selected>
                                                            {{ $doctor->name . ' -->mail:' . $doctor->email }}</option>
                                                    @else
                                                        <option value="{{ $doctor->id }}">
                                                            {{ $doctor->name . ' -->mail:' . $doctor->email }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Submit Button</label>
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Make another appointment</button>
                                        </div>
                                    </div>

                                </form><!-- End General Form Elements -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
