@extends('control.layout._app')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('auth.message')
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add</h5>
                        <!-- Multi Columns Form -->
                        <form class="row g-3" action="{{url('_admin/add_blocks/')}}" method="POST">
                            @csrf
                            <div class="col-md-6">
                                <label for="inputName5" class="form-label">BlockName</label>
                                <input type="text" pattern="[A-Za-z]+" class="form-control" id="inputName5" name="blockName" value="" >
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail5" class="form-label">BlockCode</label>
                                <input type="number" class="form-control" id="inputEmail5" name="blockCode" value="">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{url('_admin/blocks/')}}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form><!-- End Multi Columns Form -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
