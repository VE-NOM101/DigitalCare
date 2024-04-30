@extends('control.layout._app')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Add Ambulance</h5>

            <!-- Horizontal Form -->
            <form action="{{ url('/_admin/confirm_ambulance/'.$getBookAmb) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="row mb-3 col-5">
                        <label for="inputText" class="col-sm-2 col-form-label">Photo</label>
                        <div class="col-sm-10">
                            <img style="width: 20rem; height:15rem;" id="ambulanceImage" class="form-control"
                                src="{{ asset('/digitalcare/ambulance/ambulance.jpg') }}" alt="Ambulance" />
                        </div>
                    </div>
                    <div class="col-1"></div>
                    <div class="row mb-3 col-6">
                        <label for="inputText" class="col-sm-2 col-form-label">Driver:</label>
                        <div class="col-sm-10">
                            <input id="driver" class="form-control mb-3" readonly/>
                            <input id="contact" class="form-control" readonly />
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">#Ambulance</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="amb_id" onchange="changeAmbulanceImage(this)">
                            @foreach ($getAmb as $item)
                                <option class="form-control" value="{{ $item->id }}"
                                    data-image="{{ asset('digitalcare/admin/ambulance/' . $item->photo_path) }}"
                                    data-driver="{{$item->driver}}" data-contact="{{$item->contact}}">
                                    {{ $item->id . '<>' . $item->reg_no }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                    <a href="{{ url('/_admin/ambulance') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
            <!-- End Horizontal Form -->

        </div>
    </div>
    <script>
        function changeAmbulanceImage(select) {
            var selectedImage = select.options[select.selectedIndex].getAttribute('data-image');
            var selectedDriver = select.options[select.selectedIndex].getAttribute('data-driver');
            var selectedContact = select.options[select.selectedIndex].getAttribute('data-contact');
            document.getElementById('ambulanceImage').src = selectedImage;
            document.getElementById('driver').value = selectedDriver;
            document.getElementById('contact').value = selectedContact;
        }
    </script>
@endsection
