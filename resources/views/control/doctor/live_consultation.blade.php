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
                        aria-selected="true">Accept request</button>
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
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Name</th>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getLive as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $getUser->find($item->user_id)->name }}</td>
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
                                                @if ($item->status == 0)
                                                    <a href="{{ url('_doctor/confirm_consultation/' . $item->id) }}"
                                                        class="btn btn-outline-success mb-1">Confirm
                                                        <span></span><i class="fas fa-check-double"></i></a>

                                                    <a href="{{ url('_doctor/delete_consultation/' . $item->id) }}"
                                                        class="btn btn-outline-danger mb-1">Delete
                                                        <span></span><i class="fas fa-trash-alt"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                                        <th>User Name</th>
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
                                            <td>{{ $getUser->find($item->user_id)->name }}</td>
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
                                                    <a href="{{ url('_doctor/goto_live/' . $item->id) }}"
                                                        class="btn btn-outline-success mb-1">Goto Live
                                                        <span></span><i class="fas fa-play"></i>
                                                    </a>
                                                @else
                                                    <a href="https://meet.jit.si/" class="btn btn-outline-info mb-1"
                                                        target="_blank">Create Room
                                                        <span></span><i class="fas fa-yen-sign"></i>
                                                    </a>


                                                    <a href="{{ url('_doctor/share_room/' . $item->id) }}"
                                                        class="btn btn-outline-danger mb-1">Share Room
                                                        <span></span><i class="fas fa-share"></i></a>
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
                                <th>User Name</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getLiveAll as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $getUser->find($item->user_id)->name }}</td>
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
                                        @if($item->status == 1)
                                        <a href="{{url('_doctor/done_consultation/'.$item->id)}}" class="btn btn-outline-info mb-1"
                                            target="_blank">Done
                                            <span></span><i class="fas fa-check-square"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!-- End Bordered Tabs Justified -->

        </div>
    </div>
@endsection
