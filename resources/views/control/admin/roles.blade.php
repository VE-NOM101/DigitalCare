@extends('control.layout._app')
@section('content')
    <div class="pagetitle">

        <h1>Role Management</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('auth.message')
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Manager</h5>
                        {{-- <a href="" class="btn btn-primary">Add</a> --}}
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Roles</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getRecord as $item)
                                    <tr>
                                        <td scope="row">{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            <form class="role-form" action="{{ url('_admin/edit_roles/' . $item->id) }}"
                                                method="POST">
                                                @csrf
                                                <div class="form-check">
                                                    <input name="role" class="form-check-input role-checkbox"
                                                        type="radio" value="4"
                                                        {{ $item->role == 4 ? 'checked' : '' }}>
                                                    <label class="form-check-label">Admin</label>
                                                </div>
                                                <div class="form-check">
                                                    <input name="role" class="form-check-input role-checkbox"
                                                        type="radio" value="2"
                                                        {{ $item->role == 2 ? 'checked' : '' }}>
                                                    <label class="form-check-label">Doctor</label>
                                                </div>
                                                <div class="form-check">
                                                    <input name="role" class="form-check-input role-checkbox"
                                                        type="radio" value="3"
                                                        {{ $item->role == 3 ? 'checked' : '' }}>
                                                    <label class="form-check-label">Pharmacist</label>
                                                </div>
                                                <div class="form-check">
                                                    <input name="role" class="form-check-input role-checkbox"
                                                        type="radio" value="1"
                                                        {{ $item->role == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label">User</label>
                                                </div>

                                                <button type="submit" class="btn btn-outline-primary">Done<span>   </span><i class="bi bi-check-circle-fill"></i></button>
                                            </form>
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
