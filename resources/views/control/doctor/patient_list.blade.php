@extends('control.layout._app')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        @include('auth.message')
                        @include('auth.error')
                        <h5 class="card-title">Patients</h5>
                        <a href="{{ url('_doctor/add_new_patient') }}" class="btn btn-primary mb-1">Add new patients
                            <span></span><i class="bi bi-plus-circle-fill"></i></a>
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home"
                                    aria-selected="true">My Patient List</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile"
                                    aria-selected="false">All Patient List</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                    data-bs-target="#bordered-contact" type="button" role="tab" aria-controls="contact"
                                    aria-selected="false">Contact</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2" id="borderedTabContent">
                            <div class="tab-pane fade show active" id="bordered-home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getMyPatientList as $item)
                                            <tr>
                                                <td scope="row">{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->phone }}</td>
                                                <td>{{ $item->address }}</td>
                                                <td>
                                                    <a href="{{ url('_doctor/view_patient/' . $item->id) }}"
                                                        class="btn btn-outline-info mb-1">View
                                                        <span></span><i class="bi bi-eye"></i></a>
                                                    <a href="{{ url('_doctor/edit_patient/' . $item->id) }}"
                                                        class="btn btn-outline-success mb-1">Edit
                                                        <span></span><i class="bi bi-pencil-square"></i></a>
                                                    <a href="{{ url('_doctor/detach_patient/' . $item->id) }}"
                                                        class="btn btn-outline-danger mb-1">Detach
                                                        <span></span><i class="bi bi-pencil-square"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getAllPatientList as $item)
                                            <tr>
                                                <td scope="row">{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->phone }}</td>
                                                <td>{{ $item->address }}</td>
                                                <td>
                                                    <a href="{{ url('_doctor/view_patient/' . $item->id) }}"
                                                        class="btn btn-outline-info mb-1">View
                                                        <span></span><i class="bi bi-eye"></i></a>
                                                    <a href="{{ url('_doctor/attach_patient/' . $item->id) }}"
                                                        class="btn btn-outline-primary mb-1">Attach
                                                        <span></span><i class="bi bi-plus"></i></a>
                                        
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="bordered-contact" role="tabpanel" aria-labelledby="contact-tab">
                                Saepe animi et soluta ad odit soluta sunt. Nihil quos omnis animi debitis cumque.
                                Accusantium quibusdam perspiciatis qui qui omnis magnam. Officiis accusamus impedit
                                molestias nostrum veniam. Qui amet ipsum iure. Dignissimos fuga tempore dolor.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
