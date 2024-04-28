@extends('control.layout._app')
@section('content')
    <div class="card">
        @include('auth.message')
        @include('auth.error')
        <div class="card-body">
            <h5 class="card-title">Bed Management</h5>

            <!-- Bordered Tabs Justified -->
            <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab"
                        data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home"
                        aria-selected="true">Bed Status</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab"
                        data-bs-target="#bordered-justified-profile" type="button" role="tab" aria-controls="profile"
                        aria-selected="false">Bed Types</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab"
                        data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="contact"
                        aria-selected="false">Add New Bed Type</button>
                </li>
            </ul>
            <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel"
                    aria-labelledby="home-tab">
                    @foreach ($getBed as $bed)
                        @if ($getIpd->where('bed_id', $bed->id)->count() > 0)
                            <span style="color: brown">{{$bed->type}}</span>
                            <div class="card" style="padding:1rem;">
                                <ul class="icon-list">
                                    @foreach ($getIpd->where('bed_id', $bed->id) as $item)
                                        <li style="border:1px solid grey; padding:1rem;">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"
                                                style="width: 65px; height: 65px;">
                                                <path
                                                    d="M176 256c44.1 0 80-35.9 80-80s-35.9-80-80-80-80 35.9-80 80 35.9 80 80 80zm352-128H304c-8.8 0-16 7.2-16 16v144H64V80c0-8.8-7.2-16-16-16H16C7.2 64 0 71.2 0 80v352c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-48h512v48c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V240c0-61.9-50.1-112-112-112z"
                                                    style="fill: {{ $bed->color }}" />
                                            </svg>
                                            <br>
                                            <span style="color: {{$bed->color}}">{{$getPatient->find($item->patient_id)->name}}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    @endforeach
                    <style>
                        .icon-list {
                            list-style: none;
                            padding: 0;
                            margin: 0;
                            display: flex;
                        }

                        .icon-list li {
                            margin-right: 10px;
                        }
                    </style>
                

                </div>
                <div class="tab-pane fade" id="bordered-justified-profile" role="tabpanel" aria-labelledby="profile-tab">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Charge</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getBed as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->charge }}</td>
                                    <td>{{ $item->size }}</td>
                                    <td><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                            <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path
                                                d="M176 256c44.1 0 80-35.9 80-80s-35.9-80-80-80-80 35.9-80 80 35.9 80 80 80zm352-128H304c-8.8 0-16 7.2-16 16v144H64V80c0-8.8-7.2-16-16-16H16C7.2 64 0 71.2 0 80v352c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-48h512v48c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V240c0-61.9-50.1-112-112-112z"
                                                style="fill: {{ $item->color }}" />
                                        </svg>
                                    </td>
                                    <td>
                                        <a href="{{ url('_admin/edit_bed/' . $item->id) }}" class="btn btn-success"><i
                                                class="bi bi-pencil-square"></i></a>

                                        <a href="{{ url('_admin/delete_bed/' . $item->id) }}"
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
                            <h5 class="card-title">Beds</h5>

                            <!-- Horizontal Form -->
                            <form action="{{ url('/_admin/add_bed') }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Type</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputText" name="type">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Charge</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="inputPassword" name="charge">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Size</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="inputPassword" name="size">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="colorPicker" class="col-sm-2 col-form-label">Color</label>
                                    <div class="col-sm-2">
                                        <input type="color" class="form-control" id="colorPicker" name="color"
                                            value="#00FFAA">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                    <a href="{{ url('/_admin/bed_management') }}" class="btn btn-secondary">Cancel</a>
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
