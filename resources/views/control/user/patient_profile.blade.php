@extends('control.layout._app')
@section('content')
    <section class="section dashboard">
        <div class="row">
            @include('auth.message')
            @include('auth.error')
            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Appointments <span>| All</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-check-square"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>+{{$getAppointment->count()}}</h6>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">

                            <div class="card-body">
                                <h5 class="card-title">Pending Bills <span>| All</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-hourglass-bottom"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>$3,264</h6>
                                        <span class="text-success small pt-1 fw-bold">8%</span> <span
                                            class="text-muted small pt-2 ps-1">increase</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Bills<span>| All</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-plus-slash-minus"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>1244</h6>
                                        <span class="text-danger small pt-1 fw-bold">12%</span> <span
                                            class="text-muted small pt-2 ps-1">decrease</span>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Customers Card -->



                    <!-- Recent Sales -->
                    <div class="col-12 col-lg-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Extended Information</h5>

                                    <!-- Bordered Tabs Justified -->
                                    <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified"
                                        role="tablist">
                                        <li class="nav-item flex-fill" role="presentation">
                                            <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab"
                                                data-bs-target="#bordered-justified-home" type="button" role="tab"
                                                aria-controls="home" aria-selected="true">Medical Information</button>
                                        </li>
                                       
                                        <li class="nav-item flex-fill" role="presentation">
                                            <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab"
                                                data-bs-target="#bordered-justified-contact" type="button" role="tab"
                                                aria-controls="contact" aria-selected="false">Prescription List</button>
                                        </li>
                                        <li class="nav-item flex-fill" role="presentation">
                                            <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab"
                                                data-bs-target="#bordered-justified-invoices" type="button" role="tab"
                                                aria-controls="invoices" aria-selected="false">Invoices</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                                        <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel"
                                            aria-labelledby="home-tab">
                                            <table class="table table-striped" style="font-size:.8rem;">
                                                <thead>
                                                    <tr>
                                                        <th scope="col"></th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Height</th>
                                                        <td>{{ $getPatient->height }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Weight</th>
                                                        <td>{{ $getPatient->weight }}</td>

                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Blood Group</th>
                                                        <td>{{ $getPatient->blood_group }}</td>

                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Blood Pressure</th>
                                                        <td>{{ $getPatient->blood_pressure }}</td>

                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Pulse</th>
                                                        <td>{{ $getPatient->pulse }}</td>

                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Respiration</th>
                                                        <td>{{ $getPatient->respiration }}</td>

                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Allergy</th>
                                                        <td>{{ $getPatient->allergy }}</td>

                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Diet</th>
                                                        <td>{{ $getPatient->diet }}</td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        <div class="tab-pane fade" id="bordered-justified-contact" role="tabpanel"
                                            aria-labelledby="contact-tab">
                                            Saepe animi et soluta ad odit soluta sunt. Nihil quos omnis animi debitis
                                            cumque. Accusantium quibusdam perspiciatis qui qui omnis magnam. Officiis
                                            accusamus impedit molestias nostrum veniam. Qui amet ipsum iure. Dignissimos
                                            fuga tempore dolor.
                                        </div>
                                        <div class="tab-pane fade" id="bordered-justified-invoices" role="tabpanel"
                                            aria-labelledby="invoices-tab">
                                            Saepe animi et soluta ad odit soluta sunt. Nihil quos omnis animi debitis
                                            cumque. Accusantium quibusdam perspiciatis qui qui omnis magnam. Officiis
                                            accusamus impedit molestias nostrum veniam. Qui amet ipsum iure. Dignissimos
                                            fuga tempore dolor.
                                        </div>
                                    </div><!-- End Bordered Tabs Justified -->

                                </div>
                            </div>
                        </div>


                    </div><!-- End Recent Sales -->



                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Picture <span>|{{ $getPatient->name }}</span></h5>
                        <img src="@if ($getPatient->photo_path){{ asset('/digitalcare/patients/profile/'.$getPatient->photo_path) }} @else {{ asset('/digitalcare/patients/profile/img.jpg') }} @endif"
                            alt="{{ $getPatient->name }}"
                            style="width: 7rem;border:grey 2px solid; border-radius:15px" />
                        <a href="{{ url('_user/add_profile_picture/'.$getPatient->id) }}" class="btn btn-primary mb-1">Add Profile Picture
                            <span></span><i class="bi bi-pencil-square"></i></a>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">Personal Information <span>|{{ $getPatient->name }}</span></h5>
                        <table class="table table-striped" style="font-size:.8rem;">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Name</th>
                                    <td>{{ $getPatient->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Contact No</th>
                                    <td>{{ $getPatient->phone }}</td>

                                </tr>
                                <tr>
                                    <th scope="row">Email</th>
                                    <td>{{ $getPatient->email }}</td>

                                </tr>
                                <tr>
                                    <th scope="row">Age</th>
                                    <td>{{ $getPatient->age }}</td>

                                </tr>
                                <tr>
                                    <th scope="row">Gender</th>
                                    <td>{{ $getPatient->gender }}</td>

                                </tr>
                                <tr>
                                    <th scope="row">Address</th>
                                    <td>{{ $getPatient->address }}</td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!-- End Recent Activity -->

            </div><!-- End Right side columns -->

        </div>
    </section>
@endsection
