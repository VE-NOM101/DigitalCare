@extends('control.layout._app')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('auth.message')
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit</h5>
                        <!-- Multi Columns Form -->
                        <form class="row g-3" action="{{url('_admin/edit_users/'.$getRecord->id)}}" method="POST">
                            @csrf
                            <div class="col-md-12">
                                <label for="inputID5" class="form-label">ID</label>
                                <input type="text" class="form-control" id="inputName5" name="id" disabled value="{{$getRecord->id}}">
                            </div>
                            <div class="col-md-6">
                                <label for="inputName5" class="form-label">Name</label>
                                <input type="text" class="form-control" id="inputName5" name="name" value="{{$getRecord->name}}" >
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail5" class="form-label">Email</label>
                                <input type="email" class="form-control" id="inputEmail5" name="email" value="{{$getRecord->email}}">
                            </div>
                            <div class="col-12">
                                <label for="inputAddress5" class="form-label">Address</label>
                                <textarea id="inputAddress5" name="address" class="form-control">{{$getRecord->address}}</textarea>
                                {{-- <input type="textarea" class="form-control" id="inputAddres5s" name="address"> --}}
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{url('_admin/users/')}}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form><!-- End Multi Columns Form -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
