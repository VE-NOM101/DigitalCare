@extends('control.layout._app')

@section('content')
    <div class="card">
        @include('auth.message')
        @include('auth.error')
        <div class="card-body">
            <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                <h5 class="badge bg-danger">Emergency Request</h5>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>City</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getBookAmbulance as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td> <span class="badge bg-secondary">{{ $item->phone }}</span></td>
                                <td>{{ $item->city }}</td>

                                <td>
                                    <button class="btn btn-outline-info" onclick="showMap({{ $item->lat }}, {{ $item->lon }})"><i class="fas fa-map-marker-alt"> </i>Show
                                        Map</button>
                                    <a href="{{ url('_admin/confirm_ambulance/' . $item->id) }}"
                                        class="btn btn-outline-success"><i class="fas fa-clipboard-check">
                                        </i>Confirm</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- End Bordered Tabs Justified -->

        </div>
        <hr>
        <h5 class="badge bg-success">Map</h5>
        <div id="map" class="card-body" style="height: 400px;">
        </div>

    </div>
    <script type="text/javascript">
        function showMap(lat, lng) {
            const myLatLng = {
                lat: lat,
                lng: lng
            };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 10,
                center: myLatLng,
            });

            new google.maps.Marker({
                position: myLatLng,
                map,
                title: "Hello",
            });
        }
    </script>

    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries">
    </script>
@endsection
