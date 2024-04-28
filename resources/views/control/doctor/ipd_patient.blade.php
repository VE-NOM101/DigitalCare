@extends('control.layout._app')
@section('content')
    <div class="card">
        @include('auth.message')
        @include('auth.error')
        <div class="card-body">
            <h5 class="card-title">IPD Patient</h5>

            <!-- Bordered Tabs Justified -->
            <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100 active" id="profile-tab" data-bs-toggle="tab"
                        data-bs-target="#bordered-justified-profile" type="button" role="tab" aria-controls="profile"
                        aria-selected="false">IPD-Patient In</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab"
                        data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="contact"
                        aria-selected="false">Add IPD-Patient In</button>
                </li>
            </ul>
            <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                <div class="tab-pane fade show active" id="bordered-justified-profile" role="tabpanel"
                    aria-labelledby="profile-tab">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Patient</th>
                                <th>Doctor</th>
                                <th>Admission Date</th>
                                <th>Note</th>
                                <th>Bed</th>
                                <th>Bill Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getIpd as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $getPatient->find($item->patient_id)->name }}</td>
                                    <td>{{ $getDoctor->find($item->doctor_id)->name }}</td>
                                    <td>{{ $item->admission_date }}</td>
                                    <td>{{ $item->note }}</td>
                                    <td style="color: {{ $getBedType->find($item->bed_id)->color }};">
                                        {{ $getBedType->find($item->bed_id)->type }}</td>
                                    <td>
                                        @if ($getInvoice->find($item->invoice_id)->status == 'paid')
                                            <span class="badge bg-success">Paid</span>
                                        @else<span class="badge bg-danger">Unpaid</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($getInvoice->find($item->invoice_id)->status == 'unpaid')
                                            <a href="{{ url('_doctor/edit_ipd_patient/' . $item->id) }}"
                                                class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                                        @endif
                                        <a href="{{ url('_doctor/delete_ipd_patient/' . $item->id) }}"
                                            onclick="return confirm('Are you sure that you want to delete?')"
                                            class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="bordered-justified-contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">IPD-Patient</h5>

                            <!-- Horizontal Form -->
                            <form action="{{ url('/_doctor/add_ipd_patient') }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Patient</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" name="patient_id">
                                            @foreach ($getPatient as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Doctor</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" name="doctor_id" @readonly(true)>
                                                <option value="{{ $getDoctor->id }}">{{ $getDoctor->name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Bed</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" name="bed_id">
                                            @foreach ($getBedType as $item)
                                                <option value="{{ $item->id }}" style="color: {{ $item->color }};">
                                                    {{ $item->type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Bill Status</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" name="bill_status">
                                            <option value="unpaid" style="color: red;"><span>Unpaid</span></option>
                                            <option value="paid" style="color: green;"><span>Paid</span></option>

                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputAddress5" class="col-sm-2 col-form-label">Payment Method</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="inputAddress5" name="payment_method">
                                            <option value="cash">Cash</option>
                                            <option value="cheque">Cheque</option>
                                            <option value="credit_card">Credit Card</option>
                                            <option value="online">Online</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Admission Date</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="inputText" name="admission_date"
                                            min="{{ now()->format('Y-m-d') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Notes</label>
                                    <div class="col-sm-10">
                                        <textarea name="note" class="form-control" placeholder="Write short notes"></textarea>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                    <a href="{{ url('/_doctor/ipd_patient') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                            <!-- End Horizontal Form -->

                        </div>
                    </div>
                </div>
            </div><!-- End Bordered Tabs Justified -->

        </div>
    </div>
@endsection
