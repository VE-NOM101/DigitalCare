@extends('control.layout._app')
@section('content')
    <div class="card">
        <div class="card-body">
            @include('auth.message')
            @include('auth.error')
            <h5 class="card-title">Share room</h5>
            <form action="{{url('/_doctor/share_room/'.$getId)}}" method="POST">
                @csrf
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Give Room Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputText" name="link" value="digitalCareDoctorLiveConsultation" required>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Share</button>
                    <a href="{{url('_doctor/live_consultation')}}" type="reset" class="btn btn-secondary">Reset</a>
                </div>
            </form><!-- End Horizontal Form -->
        </div>
    </div>
@endsection
