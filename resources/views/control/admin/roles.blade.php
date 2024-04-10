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
                        <table class="table table-hover">
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
                                                    <input id="admin" name="role" class="form-check-input role-checkbox" title="Admin" placeholder="Admin"
                                                        type="radio" value="4"
                                                        {{ $item->role == 4 ? 'checked' : '' }}>
                                                    <label for="admin" class="form-check-label">Admin</label>
                                                </div>
                                                <div class="form-check">
                                                    <input id="doctor" name="role" class="form-check-input role-checkbox" title="Doctor" placeholder="Doctor"
                                                        type="radio" value="2"
                                                        {{ $item->role == 2 ? 'checked' : '' }}>
                                                    <label for="doctor" class="form-check-label">Doctor</label>
                                                </div>
                                                <div class="form-check">
                                                    <input id="pharmacist" name="role" class="form-check-input role-checkbox" title="Pharmacist" placeholder="Pharmacist"
                                                        type="radio" value="3"
                                                        {{ $item->role == 3 ? 'checked' : '' }}>
                                                    <label for="pharmacist" class="form-check-label">Pharmacist</label>
                                                </div>
                                                <div class="form-check">
                                                    <input id="nurse" name="role" class="form-check-input role-checkbox" title="Nurse" placeholder="Nurse"
                                                        type="radio" value="5"
                                                        {{ $item->role == 5 ? 'checked' : '' }}>
                                                    <label for="nurse" class="form-check-label">Nurse</label>
                                                </div>
                                                <div class="form-check">
                                                    <input id="user" name="role" class="form-check-input role-checkbox" title="User" placeholder="User"
                                                        type="radio" value="1"
                                                        {{ $item->role == 1 ? 'checked' : '' }}>
                                                    <label for="user" class="form-check-label">User</label>
                                                </div>

                                                <button type="submit" class="btn btn-outline-primary">Done<span>   </span><i class="bi bi-check-circle-fill"></i></button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                        {{$getRecord->onEachSide(1)->links()}}
                    </div>
                </div> 
            </div>
        </div>
    </section>
@endsection
