@extends('control.layout._app')
@section('content')
    <div class="col-lg-12">
        <div class="card">
            @include('auth.message')
            @include('auth.error')
            <div class="card-body">
                <h5 class="card-title">Diagnosis</h5>

                <!-- Bordered Tabs Justified -->
                <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab"
                            data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home"
                            aria-selected="true">Diagnosis Category</button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab"
                            data-bs-target="#bordered-justified-profile" type="button" role="tab"
                            aria-controls="profile" aria-selected="false">Diagnosis Tests</button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab"
                            data-bs-target="#bordered-justified-contact" type="button" role="tab"
                            aria-controls="contact" aria-selected="false">Contact</button>
                    </li>
                </ul>
                <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                    <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel"
                        aria-labelledby="home-tab">
                        <a class="btn btn-primary text-center" href="{{ url('/_doctor/add_diagnosis') }}">Add New Diagnosis
                            Category<span> </span><i class="bi bi-plus-circle-fill"></i></a>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getDiagnosis as $item)
                                    <tr>
                                        <td scope="row">{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            <a href="{{url('_doctor/edit_diagnosis/'.$item->id)}}" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                                             
                                            <a href="{{url('_doctor/delete_diagnosis/'.$item->id)}}" onclick="return confirm('Are you sure that you want to delete?')"  class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane fade" id="bordered-justified-profile" role="tabpanel"
                        aria-labelledby="profile-tab">
                        
                    </div>
                    <div class="tab-pane fade" id="bordered-justified-contact" role="tabpanel"
                        aria-labelledby="contact-tab">
                        Saepe animi et soluta ad odit soluta sunt. Nihil quos omnis animi debitis cumque. Accusantium
                        quibusdam
                        perspiciatis qui qui omnis magnam. Officiis accusamus impedit molestias nostrum veniam. Qui amet
                        ipsum
                        iure. Dignissimos fuga tempore dolor.
                    </div>
                </div><!-- End Bordered Tabs Justified -->

            </div>
        </div>
    </div>
@endsection
