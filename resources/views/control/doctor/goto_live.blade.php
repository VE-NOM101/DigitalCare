@extends('control.layout._app')
<script src='https://meet.jit.si/external_api.js'></script>
@section('content')
    <div class="card">
        <div class="card-body">
            @include('auth.message')
            @include('auth.error')
            <h5 class="card-title">Live</h5>
           
        </div>
    </div>
    <div id='jitsi-container'></div>
    <script>
        var domain = 'meet.jit.si';
        var roomLink = "{{ $getLink }}"; // Injecting the room link here
        var options = {
            roomName: roomLink,
            width: '100%',
            height: '100%',
            parentNode: document.querySelector('#jitsi-container')
        };
        var api = new JitsiMeetExternalAPI(domain, options);
    </script>
@endsection
