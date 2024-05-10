@extends('control.layout._app')
@section('content')
    <div class="card">
        <div class="card-body">
            @include('auth.message')
            @include('auth.error')
            <h5 class="card-title">Live Consultation</h5>

            <!-- Bordered Tabs Justified -->
            <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab"
                        data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home"
                        aria-selected="true">Make a request</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab"
                        data-bs-target="#bordered-justified-profile" type="button" role="tab" aria-controls="profile"
                        aria-selected="false">Today's Meeting</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab"
                        data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="contact"
                        aria-selected="false">History</button>
                </li>
            </ul>
            <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel"
                    aria-labelledby="home-tab">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Live</h5>

                            <!-- Multi Columns Form -->
                            <form class="row g-3" action="{{ url('/_user/req_live_consultation') }}" method="POST">
                                @csrf
                                <div class="col-md-12">
                                    <label for="inputState" class="form-label">Select Doctor</label>
                                    <select id="inputState" class="form-select" name="doctor_id">
                                        @foreach ($getDoctor as $doctor)
                                            <option value="{{ $doctor->id }}"
                                                data-photo="{{ asset('digitalcare/doctors/profile/' . $doctor->photo_path) }}">
                                                {{ $doctor->name }} - {{ $doctor->email }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 text-center"> <!-- Added text-center class to center align content -->
                                    <label for="inputImage" class="form-label">Image</label>
                                    <img style="width:210px; height:200px; border-radius:50%; display:block; margin:auto;"
                                        id="doctorImage" src="{{ asset('digitalcare/doctors/profile/default.jpg') }}"
                                        alt="Doctor" /> <!-- Added display:block and margin:auto to center the image -->
                                </div>
                                <div class="col-md-12">
                                    <label for="inputDate" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="inputDate" name="date"
                                        min="{{ date('Y-m-d') }}">
                                </div>

                                <div class="col-md-12">
                                    <label for="inputEmail5" class="form-label">Description</label>
                                    <textarea class="form-control" name="description"></textarea>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Send request</button>
                                    <a href="{{ url('/_user/live_consultation') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </form>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    const inputState = document.getElementById('inputState');
                                    const doctorImage = document.getElementById('doctorImage');

                                    // Get the first option and its data-photo attribute
                                    const firstOption = inputState.options[0];
                                    const photoPath = firstOption.getAttribute('data-photo');

                                    // Set the image source to the first option's photo path
                                    doctorImage.src = photoPath ? photoPath : "{{ asset('digitalcare/doctors/profile/default.jpg') }}";

                                    inputState.addEventListener('change', function() {
                                        const selectedOption = this.options[this.selectedIndex];
                                        const photoPath = selectedOption.getAttribute('data-photo');
                                        doctorImage.src = photoPath ? photoPath :
                                            "{{ asset('digitalcare/doctors/profile/default.jpg') }}";
                                    });
                                });
                            </script>






                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="bordered-justified-profile" role="tabpanel" aria-labelledby="profile-tab">
               
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Table with stripped rows</h5>

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Doctor</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getLiveToday as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $getDoctor->find($item->doctor_id)->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->date)->format('d-m-y') }}</td>
                                        <!-- Formatting the date -->
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            @php
                                                $status = '';
                                                switch ($item->status) {
                                                    case 0:
                                                        $status = '<span class="badge bg-warning">Pending</span>';
                                                        break;
                                                    case 1:
                                                        $status = '<span class="badge bg-primary">Confirmed</span>';
                                                        break;
                                                    case 2:
                                                        $status = '<span class="badge bg-success">Done</span>';
                                                        break;
                                                    case 3:
                                                        $status = '<span class="badge bg-danger">Canceled</span>';
                                                        break;
                                                }
                                                echo $status;
                                            @endphp
                                        </td>
                                        <td>
                                            @if ($item->link)
                                                <a href="{{url('_user/goto_live/'.$item->id)}}" class="btn btn-outline-success mb-1"
                                                    >Goto Live
                                                    <span></span><i class="fas fa-play"></i>
                                                </a>
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
            <div class="tab-pane fade" id="bordered-justified-contact" role="tabpanel" aria-labelledby="contact-tab">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Doctor Name</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getLive as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $getDoctor->find($item->doctor_id)->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->date)->format('d-m-y') }}</td>
                                <!-- Formatting the date -->
                                <td>{{ $item->description }}</td>
                                <td>
                                    @php
                                        $status = '';
                                        switch ($item->status) {
                                            case 0:
                                                $status = '<span class="badge bg-warning">Pending</span>';
                                                break;
                                            case 1:
                                                $status = '<span class="badge bg-primary">Confirmed</span>';
                                                break;
                                            case 2:
                                                $status = '<span class="badge bg-success">Done</span>';
                                                break;
                                            case 3:
                                                $status = '<span class="badge bg-danger">Canceled</span>';
                                                break;
                                        }
                                        echo $status;
                                    @endphp
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div><!-- End Bordered Tabs Justified -->

    </div>
@endsection
