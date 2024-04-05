@extends('control.layout._app')
@section('content')
    <div class="pagetitle">

        <h1>Department Management</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('auth.message')
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Manager</h5>
                        <a href="{{url('/_admin/show_departments')}}" class="btn btn-primary">Add new department</a>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Department Name</th>
                                    <th scope="col">Photo</th>
                                    <th scope="col">BlockName</th>
                                    <th scope="col">BlockCode</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($getRecord as $item)
                                <tr>
                                    <td scope="row">{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td><img style="width: 250px; height: 150px;" src="{{asset('digitalcare/admin/departments/'.$item->photo_path)}}" alt="{{$item->name}}"></td>
                                    <td>{{$item->blocks->find($item->block_id)->blockName}}</td>
                                    <td>{{$item->blocks->find($item->block_id)->blockCode}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>
                                        <a href="{{url('_admin/edit_departments/'.$item->id)}}" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                                         
                                        <a href="{{url('_admin/delete_departments/'.$item->id)}}" onclick="return confirm('Are you sure that you want to delete?')"  class="btn btn-danger"><i class="bi bi-trash"></i></a>
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
