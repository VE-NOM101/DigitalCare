@extends('control.layout._app')
@section('content')
    <div class="card">
        @include('auth.message')
        @include('auth.error')
        <div class="card-body">
            <h5 class="card-title">Ambulance Management</h5>

            <!-- Bordered Tabs Justified -->
            <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100 active" id="profile-tab" data-bs-toggle="tab"
                        data-bs-target="#bordered-justified-profile" type="button" role="tab" aria-controls="profile"
                        aria-selected="false">Ambulances</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab"
                        data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="contact"
                        aria-selected="false">Add Ambulance</button>
                </li>
            </ul>
            <div class="tab-content pt-2" id="borderedTabJustifiedContent">

                <div class="tab-pane fade show active" id="bordered-justified-profile" role="tabpanel"
                    aria-labelledby="profile-tab">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Reg No</th>
                                <th>Driver</th>
                                <th>Contact</th>
                                <th>Photo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getAmb as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><span class="badge bg-warning">{{ $item->reg_no }}</span></td>
                                    <td>{{ $item->driver }}</td>
                                    <td>{{ $item->contact }}</td>
                                    <td><img style="width: 100px;height:80px; border-radius:15px;"
                                            src="{{ asset('digitalcare/admin/ambulance/' . $item->photo_path) }}" /></td>

                                    <td>

                                        <a href="{{ url('_admin/edit_ambulance/' . $item->id) }}" class="btn btn-success"><i
                                                class="bi bi-pencil-square"></i></a>
                                        <a href="{{ url('_admin/delete_ambulance/' . $item->id) }}"
                                            onclick="return confirm('Are you sure that you want to delete?')"
                                            class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                        @if ($item->isBooked == 1)
                                            <a href="{{ url('_admin/release_ambulance/' . $item->id) }}"
                                                class="btn btn-primary"><i class="fas fa-check-double"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="bordered-justified-contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Ambulance</h5>

                            <!-- Horizontal Form -->
                            <form action="{{ url('/_admin/add_ambulance') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">:Example Number Plate:</label>
                                    <div class="col-sm-10">
                                        <img class="form-control"
                                            src="{{ asset('/digitalcare/ambulance/Number_plate.png') }}"
                                            alt="Number Plate" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">#Reg No</label>
                                    <div class="col-sm-10">
                                        <input id="inputText" name="reg_no" class="form-control" type="text" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText1" class="col-sm-2 col-form-label">Driver</label>
                                    <div class="col-sm-10">
                                        <input id="inputText1" name="driver" class="form-control" type="text" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText2" class="col-sm-2 col-form-label">Contact</label>
                                    <div class="col-sm-10">
                                        <input id="inputText2" name="contact" class="form-control" type="text" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText2" class="col-sm-2 col-form-label">Photo</label>
                                    <div class="col-sm-10">
                                        <input id="inputText2" name="photo_path" class="form-control" type="file" />
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                    <a href="{{ url('/_admin/ambulance') }}" class="btn btn-secondary">Cancel</a>
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
