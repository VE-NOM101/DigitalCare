@extends('control.layout._app')
@section('content')
    <div class="pagetitle">
        <h1>Profile</h1>
        @include('auth.message')
        @include('auth.error')
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img style="max-height: 200px" src="@if($getDetails->photo_path){{asset('digitalcare/doctors/profile/'.$getDetails->photo_path)}} @else{{asset('digitalcare/doctors/profile/img-1.jpg')}} @endif" alt="Profile"
                            class="rounded-circle">
                        <h2>{{ $getDetails->name }}</h2>
                        <h3>{{ $getDepartment }}</h3>
                        <div class="social-links mt-2">
                            <a href="{{ $getDetails->facebook }}" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="mailto:{{ $getDetails->email }}" class="google"><i class="bi bi-google"></i></a>
                            <a href="{{ $getDetails->linkedin }}" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                    Profile</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-change-password">Change Password</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Qualification</h5>
                                <p class="small fst-italic">{{ $getDetails->qualification }}</p>

                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Doctor ID: #{{ $getDetails->id }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                    <div class="col-lg-9 col-md-8">{{ $getDetails->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Address</div>
                                    <div class="col-lg-9 col-md-8">{{ $getDetails->address }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Specialist</div>
                                    <div class="col-lg-9 col-md-8">{{ $getDetails->specialist }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Gender</div>
                                    <div class="col-lg-9 col-md-8">{{ $getDetails->gender }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Checkout Time</div>
                                    <div class="col-lg-9 col-md-8">{{ date('h:i A', strtotime($getDetails->checkout_time1)) .' - '. date('h:i A', strtotime($getDetails->checkout_time2))}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8">{{ $getDetails->phone }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ $getDetails->email }}</div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form
                                    action="{{ url('/_doctor/edit_profile/' . $getDetails->id . '/' . $getDetails->user_id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="inputNumber" class="col-sm-2 col-form-label">Picture upload</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" id="formFile" name="photo_path">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text" class="form-control" id="fullName"
                                                value="{{ $getDetails->name }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Gender</label>
                                        <div class="col-sm-10">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    id="gridRadios1" value="Male"
                                                    @if ($getDetails->gender == 'Male') @checked(true) @endif>
                                                <label class="form-check-label" for="gridRadios1">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    id="gridRadios2" value="Female" 
                                                    @if ($getDetails->gender == 'Female') @checked(true) @endif>
                                                <label class="form-check-label" for="gridRadios2">
                                                    Female
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="about"
                                            class="col-md-4 col-lg-3 col-form-label">Qualification</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea name="qualification" class="form-control" id="about" style="height: 100px">{{ $getDetails->qualification }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="company" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="address" type="text" class="form-control" id="company"
                                                value="{{ $getDetails->address }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Job" class="col-md-4 col-lg-3 col-form-label">Specialist</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="specialist" type="text" class="form-control" id="Job"
                                                value="{{ $getDetails->specialist }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="Country" class="col-md-4 col-lg-3 col-form-label">Checkout Time</label>
                                        <div class="col-md-8 col-lg-9">
                                            <span>From</span><input name="checkout_time1" type="time" class="form-control" id="Country"
                                                value="{{ $getDetails->checkout_time1 }}">
                                            <span>To</span><input name="checkout_time2" type="time" class="form-control" id="Country"
                                                value="{{ $getDetails->checkout_time2 }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Country" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="phone" type="text" class="form-control" id="Country"
                                                value="{{ $getDetails->phone }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="Email"
                                                disabled value="{{ $getDetails->email }}">
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook
                                            Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="facebook" type="text" class="form-control" id="Facebook"
                                                value="{{ $getDetails->facebook }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin
                                            Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="linkedin" type="text" class="form-control" id="Linkedin"
                                                value="{{ $getDetails->linkedin }}">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>


                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form action="{{url('/_doctor/change_password/'.$getDetails->user_id)}}" method="POST">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="password" class="form-control"
                                                id="currentPassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="newpassword" type="password" class="form-control"
                                                id="newPassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="renewpassword" type="password" class="form-control"
                                                id="renewPassword">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </div>
                                </form><!-- End Change Password Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
