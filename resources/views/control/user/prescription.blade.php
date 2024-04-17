@extends('control.layout._app')
@section('content')
    <div class="col-lg-12">
        <div class="card">
            @include('auth.message')
            @include('auth.error')
            <div class="card-body">
                <h5 class="card-title">Prescription</h5>
                <!-- Bordered Tabs Justified -->
                <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab"
                            data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home"
                            aria-selected="true">Prescription List</button>
                    </li>
                </ul>
                <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                    <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel"
                        aria-labelledby="home-tab">
                        <section class="section">
                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">My Prescription List</h5>
                                            <!-- Table with stripped rows -->
                                            <table class="table datatable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Patient Name</th>
                                                        <th>Doctor Name</th>
                                                        <th>Appointment Date</th>
                                                        <th>Appointment Time</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($getPrescription as $item)
                                                        <tr>
                                                            <td>{{ $item->id }}</td>
                                                            <td>{{ $getPatient->find($item->patient_id)->name }}</td>
                                                            <td>{{ $getDoctor->find($item->doctor_id)->name }}</td>
                                                            <td>{{ $getRA->find($item->req_appointment_id)->preferred_date }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($getAA->where('request_id',$item->req_appointment_id)->first()->slotTime)->format('h:i A') }}</td>
                                                            <td>
                                                                <a href="{{ url('_user/view_prescription/' . $item->id) }}"
                                                                    class="btn btn-outline-info mb-1">View
                                                                    <span></span><i class="bi bi-eye"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                            <!-- End Table with stripped rows -->

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </section>


                    </div>

                </div><!-- End Bordered Tabs Justified -->

            </div>
        </div>
    </div>
@endsection
