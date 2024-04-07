@extends('control.layout._app')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Appointment Manager</h5>
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home"
                                    aria-selected="true">Approved</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile"
                                    aria-selected="false">Request</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2" id="borderedTabContent">
                            <div class="tab-pane fade show active" id="bordered-home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <a href=""><i class="bi bi-arrow-repeat"></i>Refresh</a>
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Appointment Date</th>
                                            <th scope="col">Approximate Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($getRecord as $item)
                                            <tr>
                                                <td scope="row">{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>
                                                    <form class="role-form"
                                                        action="{{ url('_admin/edit_roles/' . $item->id) }}" method="POST">
                                                        @csrf
                                                        <div class="form-check">
                                                            <input name="role" class="form-check-input role-checkbox"
                                                                type="radio" value="4"
                                                                {{ $item->role == 4 ? 'checked' : '' }}>
                                                            <label class="form-check-label">Admin</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input name="role" class="form-check-input role-checkbox"
                                                                type="radio" value="2"
                                                                {{ $item->role == 2 ? 'checked' : '' }}>
                                                            <label class="form-check-label">Doctor</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input name="role" class="form-check-input role-checkbox"
                                                                type="radio" value="3"
                                                                {{ $item->role == 3 ? 'checked' : '' }}>
                                                            <label class="form-check-label">Pharmacist</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input name="role" class="form-check-input role-checkbox"
                                                                type="radio" value="1"
                                                                {{ $item->role == 1 ? 'checked' : '' }}>
                                                            <label class="form-check-label">User</label>
                                                        </div>

                                                        <button type="submit" class="btn btn-outline-primary">Done<span>
                                                            </span><i class="bi bi-check-circle-fill"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                                <a href=""><i class="bi bi-arrow-repeat"></i>Refresh</a>
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Appointment Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRA as $item)
                                            <tr>
                                                <td scope="row">{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->phone }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td>{{ $item->preferred_date }}</td>
                                                <td>
                                                    <a href="{{url('_doctor/approve_appointment/'.$item->id)}}" class="btn btn-outline-primary mb-1">Approve <span></span><i class="bi bi-check-circle"></i></a>
                                                    <a href="{{url('_doctor/cancel_appointment/'.$item->id)}}" onclick="return confirm('Are you sure that you want to delete?')"  class="btn btn-outline-danger">Cancel <span></span><i class="bi bi-x-circle"></i></a>
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
