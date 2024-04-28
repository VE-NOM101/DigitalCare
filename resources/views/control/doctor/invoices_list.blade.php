@extends('control.layout._app')
@section('content')
    <div class="col-lg-12">
        <div class="card">
            @include('auth.message')
            @include('auth.error')
            <div class="card-body">
                <h5 class="card-title">Invoices</h5>
                <a href="{{ url('/_doctor/create_invoices') }}" class="btn btn-info text-center"><i class="bi bi-plus-circle-fill"></i>Add new invoice</a>
                <!-- Bordered Tabs Justified -->
                <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab"
                            data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home"
                            aria-selected="true">Invoices List</button>
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
                                            <h5 class="card-title">My Invoice List</h5>
                                            <!-- Table with stripped rows -->
                                            <table class="table datatable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Patient Name</th>
                                                        <th>Appointment Date</th>
                                                        <th>Title</th> 
                                                        <th>Payment Method</th> 
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($getPatientInvoices as $item)
                                                        <tr>
                                                            <td>{{ $item->id }}</td>
                                                            <td>{{ $getPatient->find($item->patient_id)->name }}</td>
                                                            <td>@if($item->req_appointment_id){{ $getRA->find($item->req_appointment_id)->preferred_date }}
                                                                @else -
                                                                @endif
                                                            </td>
                                                            <td>{{ $item->title}}</td>
                                                            <td>{{ $item->payment_method}}</td>
                                                            <td>@if ($item->status == 'unpaid')
                                                                <span class="badge bg-warning text-dark"><i class="bi bi-x-octagon">Unpaid</i></span>
                                                            @else
                                                            <span class="badge bg-success text-dark"><i class="bi bi-currency-dollar">Paid</i></span>
                                                            @endif</td> 
                                                            <td>
                                                                <a href="{{ url('_doctor/view_invoice/' . $item->id) }}"
                                                                    class="btn btn-outline-info mb-1">View
                                                                    <span></span><i class="bi bi-eye"></i></a>
                                                                @if($item->status == 'unpaid')    
                                                                <a href="{{ url('_doctor/delete_invoice/' . $item->id) }}"
                                                                    class="btn btn-outline-danger mb-1">Delete
                                                                    <span></span><i class="bi bi-pencil-square"></i></a>
                                                                @endif
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
