@extends('control.layout._app')

@section('content')

    <section class="section">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Doctor Management</h5>

                    <!-- Default Tabs -->
                    <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#home-justified" type="button" role="tab" aria-controls="home"
                                aria-selected="true">Doctors</button>
                        </li>
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab"
                                data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile"
                                aria-selected="false">Add Doctor</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2" id="myTabjustifiedContent">
                        <div class="tab-pane fade show active" id="home-justified" role="tabpanel"
                            aria-labelledby="home-tab">
                            @include('auth.message')
                            <h5 class="card-title">Manager</h5>
                            {{-- <a href="{{ url('/_admin/show_departments') }}" class="btn btn-primary">Add new department</a>
                            <!-- Table with stripped rows --> --}}
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Photo</th>
                                        <th scope="col">Department</th>
                                        <th scope="col">Qualification</th>

                                        <th scope="col">Specialist</th>

                                        <th scope="col">Phone</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $item)
                                        <tr>
                                            <td scope="row">{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td><img style="width: 60px;border-radius:50%;"
                                                    src="{{ asset('digitalcare/admin/doctors/' . $item->photo_path) }}"
                                                    alt="{{ $item->name }}"></td>
                                            <td>{{ $item->departments->find($item->department_id)->name }}</td>
                                            <td>{{ $item->qualification }}</td>

                                            <td>{{ $item->specialist }}</td>

                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->gender }}</td>
                                            <td>{{ $item->address }}</td>

                                            <td>

                                                <a href="{{ url('_admin/delete_doctors/' . $item->id) }}"
                                                    onclick="return confirm('Are you sure that you want to delete?')"
                                                    class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                        <div class="tab-pane fade" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab">
                            <form action="{{ url('/_admin/add_doctors') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                
                               

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">ID<-->Email</label>
                                    <div class="col-sm-10">
                                        <select name="user_id" class="form-select" aria-label="Default select example">
                                            <option value="{{ $getDoctor->first()->id}}">
                                                {{ $getDoctor->first()->id .'<--> '.$getDoctor->first()->email}}
                                            </option>
                                            @foreach ($getDoctor as $item)
                                                @if ($item->id != $getDoctor->first()->id)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->id .'<--> '. $item->email}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Department</label>
                                    <div class="col-sm-10">
                                        <select name="department_id" class="form-select" aria-label="Default select example">
                                            <option value="{{ $getDepartment->first()->id}}">
                                                {{ $getDepartment->first()->name}}
                                            </option>
                                            @foreach ($getDepartment as $department)
                                                @if ($department->id != $getDepartment->first()->id)
                                                    <option value="{{ $department->id }}">
                                                        {{ $department->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                

                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </div>

                            </form><!-- End General Form Elements -->

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
