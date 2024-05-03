@extends('control.layout._app')

@section('content')
    <div class="card">
        <div class="card-body">
            @include('auth.message')
            @include('auth.error')
            <h5 class="card-title">Medical Campaign</h5>
            <!-- Bordered Tabs Justified -->
            <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab"
                        data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home"
                        aria-selected="true">Campaign</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab"
                        data-bs-target="#bordered-justified-profile" type="button" role="tab" aria-controls="profile"
                        aria-selected="false">Add Campaign</button>
                </li>
            </ul>
            <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel"
                    aria-labelledby="home-tab">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Manage Campaign</h5>
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Place</th>
                                        <th>Date</th>
                                        <th>Photo</th>
                                        <th>Form Link</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getCampaign as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->place }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($item->from_date)->format('d-M-Y') }} -
                                                {{ \Carbon\Carbon::parse($item->to_date)->format('d-M-Y') }}<br>
                                                At {{ \Carbon\Carbon::parse($item->time)->format('H:i A') }}
                                            </td>

                                            <td><img style="border-radius: 50%; width:120px;"
                                                    src="{{ asset('digitalcare/admin/campaign/' . $item->photo_path) }}" />
                                            </td>
                                            <td><a href="{{ $item->form_link }}">Go</a></td>
                                            <td><span
                                                    class="badge bg-info">{{ $item->type }}</span><br>{{ $item->reg_fee }}
                                                Tk</td>
                                            <td>
                                                <form class="role-form"
                                                    action="{{ url('_admin/toggle_campaign/' . $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="toggle_{{ $item->id }}" name="status"
                                                            {{ $item->isActive ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="toggle_{{ $item->id }}">Active</label>
                                                    </div>
                                                    <button type="submit" class="btn btn-outline-primary">Done <span><i
                                                                class="bi bi-check-circle-fill"></i></span></button>
                                                </form>
                                            </td>

                                            <td><a class="btn btn-outline-success">Publish<span><i class="far fa-paper-plane"></i></span></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="bordered-justified-profile" role="tabpanel" aria-labelledby="profile-tab">
                    <form action="{{ url('_admin/add_campaign') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Campaign name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Campaign Place</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="place">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputDate" class="col-sm-2 col-form-label">From Date</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="from_date">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputDate" class="col-sm-2 col-form-label">To Date</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="to_date">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputTime" class="col-sm-2 col-form-label">Time</label>
                            <div class="col-sm-10">
                                <input type="time" class="form-control" name="time">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Photo</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="formFile" name="photo_path">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description">DigitalCare Present,

                                </textarea>
                            </div>
                        </div>


                        <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-2 pt-0">Active/In-Active</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="isActive" id="gridRadios1"
                                        value="1">
                                    <label class="form-check-label" for="gridRadios1">
                                        Click Here
                                    </label>
                                </div>
                            </div>
                        </fieldset>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Type</label>
                            <div class="col-sm-10">
                                <select class="form-select" aria-label="Default select example" name="type">
                                    <option value="free">Free</option>
                                    <option value="paid">Paid</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Registration Fee</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="reg_fee" value="0">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputNumber1" class="col-sm-2 col-form-label">Form Link</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="form_link">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Submit Button</label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Submit Form</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div><!-- End Bordered Tabs Justified -->

        </div>
    </div>
@endsection
