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
                                    aria-selected="true">Requested & Confirmed</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile"
                                    aria-selected="false">History</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2" id="borderedTabContent">
                            <div class="tab-pane fade show active" id="bordered-home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <a href="{{ url('/_admin/appointments') }}"><i class="bi bi-arrow-repeat"></i>Refresh</a>
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Patient</th>
                                            <th scope="col">Doctor</th>
                                            <th scope="col">Nurse</th>
                                            <th scope="col">Appointment Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getApproved as $item)
                                            <tr>
                                                <td scope="row" row>{{ $item->id }}</td>
                                                <td>{{ $getRequest->find($item->request_id)->name }}</td>
                                                <td>{{ $getDoctor->find($getRequest->find($item->request_id)->doctor_id)->name }}
                                                </td>
                                                <td>
                                                    @if ($item->nurse_appointment_id)
                                                        {{ $getNurse->find($getAppointedNurse->find($item->nurse_appointment_id)->nurse_id)->name }}@else{{ 'N/A' }}
                                                    @endif
                                                </td>
                                                <td>{{ $getRequest->find($item->request_id)->preferred_date }}</td>
                                                <td>
                                                    @if ($getRequest->find($item->request_id)->isVisited == 1)
                                                        <span class="badge bg-info text-dark"><i
                                                                class="bi bi-check2-all me-1">Visited</i></span>
                                                    @elseif ($getRequest->find($item->request_id)->isConfirmed == 0)
                                                        <span class="badge bg-warning text-dark"><i
                                                                class="bi bi-exclamation-triangle me-1"></i>Pending</span>
                                                    @elseif($getRequest->find($item->request_id)->isConfirmed == 1)
                                                        <span class="badge bg-primary"><i
                                                                class="bi bi-star me-1"></i>Confirmed</span>
                                                    @else
                                                        <span class="badge bg-danger"><i
                                                                class="bi bi-exclamation-octagon me-1"></i>Canceled</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($getRequest->find($item->request_id)->isConfirmed != 1)
                                                        <a href="{{ url('_admin/confirm_appointment/' . $item->id) }}"
                                                            class="btn btn-outline-primary mb-1">Confirm <span></span><i
                                                                class="bi bi-check-circle"></i></a>
                                                        <a href="{{ url('_admin/cancel_appointment/' . $item->id) }}"
                                                            onclick="return confirm('Are you sure that you want to cancel?')"
                                                            class="btn btn-outline-danger">Cancel <span></span><i
                                                                class="bi bi-x-circle"></i></a>
                                                    @else
                                                        No Action<span class='bi bi-x-circle'></span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                                <a href="{{ url('/_admin/appointments') }}"><i class="bi bi-arrow-repeat"></i>Refresh</a>
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Patient</th>
                                            <th scope="col">Doctor</th>
                                            <th scope="col">Preferred_date</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRequest as $item)
                                            <tr>
                                                <td scope="row" row>{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $getDoctor->find($item->doctor_id)->name }}
                                                </td>
                                                <td>{{ $item->preferred_date }}</td>
                                                <td>
                                                    @if ($item->isVisited == 1)
                                                        <span class="badge bg-info text-dark"><i
                                                                class="bi bi-check2-all me-1">Visited</i></span>
                                                    @elseif ($item->isConfirmed == 0)
                                                        <span class="badge bg-warning text-dark"><i
                                                                class="bi bi-exclamation-triangle me-1"></i>Pending</span>
                                                    @elseif($item->isConfirmed == 1 && $item->isApproved == 1)
                                                        <span class="badge bg-primary"><i
                                                                class="bi bi-star me-1"></i>Confirmed</span>
                                                    @else
                                                        <span class="badge bg-danger"><i
                                                                class="bi bi-exclamation-octagon me-1"></i>Canceled</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
