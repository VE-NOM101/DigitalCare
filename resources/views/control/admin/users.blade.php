@extends('control.layout._app')
@section('content')
    <div class="pagetitle">

        <h1>Users List</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('auth.message')
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>
                        {{-- <a href="" class="btn btn-primary">Add</a> --}}
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($getRecord as $item)
                                <tr>
                                    <td scope="row">{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->address}}</td>
                                    <td>{{date('D-M-Y H:iA',strtotime($item->created_at))}}</td>
                                    <td>
                                        <a href="{{url('_admin/edit_users/'.$item->id)}}" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                                        <a href="{{url('_admin/delete_users/'.$item->id)}}" onclick="return confirm('Are you sure that you want to delete?')"  class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
