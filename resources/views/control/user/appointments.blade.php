@extends('control.layout._app')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Appointment Manager</h5>
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
                                <a href="{{ url('/_admin/appointments') }}"><i class="bi bi-arrow-repeat"></i>Refresh</a>
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Doctor</th>
                                            <th scope="col">Nurse</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Appointment Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRA as $item)
                                            <tr>
                                                <td scope="row" row>{{ $getDoctor->find($item->doctor_id)->name }}</td>
                                                <td>
                                                    @if ($item->isApproved == 1 && $item->isConfirmed == 1)
                                                        {{ $getNurse->find($getNA->find($getAA->where('request_id',$item->id)->first()->nurse_appointment_id)->nurse_id)->name }}
                                                    @else
                                                        {{ '-' }}
                                                    @endif
                                                </td>
                                                <td>{{ $item->description }}</td>
                                                <td>
                                                    <p>{{ $item->preferred_date }}</p>
                                                    @if ($getAA->where('request_id',$item->id)->count()>0)
                                                        <p>{{ \Carbon\Carbon::parse($getAA->where('request_id',$item->id)->first()->slotTime)->format('h:i A') }}</p>
                                                    @else
                                                        {{ '---' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->isApproved == 1 && $item->isConfirmed == 1)
                                                        <span class="badge bg-primary"><i
                                                                class="bi bi-star me-1"></i>Confirmed</span>
                                                    @elseif($item->isConfirmed == 2)
                                                        <span class="badge bg-danger"><i
                                                                class="bi bi-exclamation-octagon me-1"></i>Canceled</span>
                                                    @else
                                                        <span class="badge bg-warning text-dark"><i
                                                                class="bi bi-exclamation-triangle me-1"></i>Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->isApproved == 1 && $item->isConfirmed == 1)
                                                        <a href="{{ url('_user/generateAppointmentCard/' . $item->id) }}"
                                                            class="btn btn-outline-success mb-1">Download  <span></span>
                                                            <i class="bi bi-cloud-arrow-down"></i></a>
                                                    @elseif($item->isConfirmed == 2)
                                                        <a href="{{ url('_user/resend_appointment/' . $item->id) }}"
                                                            class="btn btn-outline-primary mb-1">Resend <span></span>
                                                            <i class="bi bi-send"></i></a>
                                                    @else
                                                        <a href="{{ url('_user/cancel_appointment/' . $item->id) }}"
                                                            onclick="return confirm('Are you sure that you want to cancel?')"
                                                            class="btn btn-outline-danger">Cancel <span></span><i
                                                                class="bi bi-x-circle"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Patient</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col" style="width: 250px">Description</th>
                                            <th scope="col">Appointment Date</th>
                                            <th scope="col">Select Nurse</th>
                                            <th scope="col" style="width: 50px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRA as $item)
                                            <tr>
                                                <td scope="row">{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->phone }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td>{{ $item->preferred_date }}</td>
                                                <td>
                                                    <form id="appointment_form_{{ $item->id }}"
                                                        action="{{ url('_doctor/approve_appointment/' . $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="row mb-3">
                                                            <div class="col-sm-10">
                                                                <select name="slotTime" class="form-select"
                                                                    aria-label="Default select example">
                                                                    @foreach ($getAvailableSlots[$item->id] as $key => $slot)
                                                                        @if (!$loop->last || $key < count($getAvailableSlots[$item->id]) - 1)
                                                                            <option value="{{$slot}}">
                                                                                {{ date('h:i A', strtotime($slot)) }}</option>
                                                                        @endif
                                                                    @endforeach


                                                                </select>

                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-outline-primary mb-1"
                                                        onclick="submitForm('{{ $item->id }}')">Approve <span></span><i
                                                            class="bi bi-check-circle"></i></a>
                                                    <a href="{{ url('_doctor/cancel_appointment/' . $item->id) }}"
                                                        onclick="return confirm('Are you sure that you want to delete?')"
                                                        class="btn btn-outline-danger">Cancel <span></span><i
                                                            class="bi bi-x-circle"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> --}}
                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
