@extends('control.layout._app')
@section('content')
    <div class="pagetitle">

        <h1>Block Management</h1>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row ">
            <div class="col-lg-12">
                @include('auth.message')
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Manager</h5>
                        <a href="{{url('/_admin/add_blocks')}}" class="btn btn-primary">Add new block</a>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">BlockName</th>
                                    <th scope="col">BlockCode</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($getRecord as $item)
                                <tr>
                                    <td scope="row">{{$item->id}}</td>
                                    <td>{{$item->blockName}}</td>
                                    <td>{{$item->blockCode}}</td>
                                    <td>
                                        <a href="{{url('_admin/edit_blocks/'.$item->id)}}" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                                        <a href="{{url('_admin/delete_blocks/'.$item->id)}}" onclick="return confirm('Are you sure that you want to delete?')"  class="btn btn-danger"><i class="bi bi-trash"></i></a>
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
