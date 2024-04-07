@extends('control.layout._app')

@section('content')

    <section class="section">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Nurse Management</h5>

                    <!-- Default Tabs -->
                    <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#home-justified" type="button" role="tab" aria-controls="home"
                                aria-selected="true">Nurses</button>
                        </li>
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab"
                                data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile"
                                aria-selected="false">Add Nurse</button>
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
                                        <th scope="col">Phone</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Qualification</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $item)
                                        <tr>
                                            <td scope="row">{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->gender }}</td>
                                            <td>{{ $item->address }}</td>
                                            <td>{{ $item->qualification }}</td>
                                            <td>
                                                <a href="{{ url('_admin/delete_nurses/' . $item->id) }}"
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
                            <form action="{{ url('/_admin/add_nurses') }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">ID<-->Email</label>
                                    <div class="col-sm-10">
                                        <select name="user_id" class="form-select" aria-label="Default select example">
                                            <option value="{{ $getNurse->first()->id}}">
                                                {{ $getNurse->first()->id .'<--> '.$getNurse->first()->email}}
                                            </option>
                                            @foreach ($getNurse as $item)
                                                @if ($item->id != $getNurse->first()->id)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->id .'<--> '. $item->email}}</option>
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
