@extends('control.layout._app')
@section('content')
    <div class="card">
        @include('auth.message')
        @include('auth.error')
        <h5 style="text-align:center;" class="card-title alert alert-success">Edit Prescription</h5>
        <div class="card-body">
            <!-- Multi Columns Form -->
            <form class="row g-3" action="{{ url('_doctor/edit_prescription/'.$getPrescription->id) }}" method="POST">
                @csrf
                <h6 style="text-align:center;" class="card-title alert alert-info">Prescription Details
                </h6>
                <div class="col-md-12">
                    <label for="inputPatient" class="form-label">Patient</label>
                    <input type="text" class="form-control" id="inputPatient" name=""
                        value="{{ $getPatient->name }} <> {{ $getPatient->email }}" disabled>
                </div>
                <div class="col-md-12">
                    <label for="inputAppointment" class="form-label">Appointment</label>
                    <input type="text" class="form-control" id="inputAppointment" name=""
                        value="{{ $getAppointment->preferred_date }} <> {{ \Carbon\Carbon::parse($getSlotTime->slotTime)->format('h:i A') }}"
                        disabled>
                </div>
                <div class="col-md-6">
                    <label for="inputAddress5" class="form-label">Symptoms<sup style="color:red;">*</sup></label>
                    <textarea id="inputAddress5" class="form-control" name="symptoms">{{ $getPrescription->symptoms }}</textarea>
                </div>
                <div class="col-md-6">
                    <label for="inputDiagnosis" class="col-sm-2 col-form-label">Diagnosis<sup
                            style="color:red;">*</sup></label>

                    <select id="inputDiagnosis" class="form-select" multiple aria-label="multiple select example"
                        name="diagnosis[]">
                        @foreach ($getDiagnosis as $item)
                            <option value="{{ $item->id }}"
                                @if ($getPrescription->diagnoses()->where('id', $item->id)->count() > 0) @selected(true) @endif>{{ $item->name }}
                            </option>
                        @endforeach
                    </select>

                </div>
                <hr />

                <h6 style="text-align:center;" class="card-title alert alert-info mt-2">Medication &
                    Test Reports Details</h6>
                <div class="col-md-12" style="border: 2px solid grey; padding: 1rem;">
                    <h4><label for="inputTable" class="form-label badge bg-warning">Medicine<sup
                                style="color:red;">*</sup></label></h4>
                    <button id="addRow" type="button" class="btn btn-info">Add <i
                            class="bi bi-plus-circle-fill"></i></button>
                    <table class="table table-striped" id="inputTable">
                        <thead>
                            <tr>
                                <th>Medicine Name</th>
                                <th>Notes</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getPreviousMedicine as $medicine)
                                <tr>
                                    <td>
                                        <select class="form-select" name="medicine_id[]">
                                            @foreach ($getMedicine as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $medicine->id ? 'selected' : '' }}>{{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <textarea class="form-control" name="medicine_notes[]">{{ $medicine->pivot->notes }}</textarea>
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-danger removeRow">Remove</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-md-12" style="border: 2px solid grey; padding:1rem;">
                    <h4><label for="inputTest" class="form-label badge bg-warning">Test Reports</label></h4>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="inputTestReport" class="form-label">Test Report</label>
                            <input type="text" class="form-control" id="inputTestReport" name="test_report" value="{{$getPrescription->test_report}}">
                        </div>
                        <div class="col-md-6">
                            <label for="inputTestNotes" class="form-label">Notes</label>
                            <textarea class="form-control" id="inputTestNotes" name="test_report_note">{{$getPrescription->test_report_note}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update Prescription</button>
                </div>
                <!-- End Multi Columns Form -->
            </form>
        </div>


    </div>

    {{-- patient --}}


    {{-- medicine --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Hide the remove button for the first row initially
            $("#inputTable tbody tr:first-child .removeRow").hide();

            $("#addRow").click(function(e) {
                e.preventDefault(); // Prevent the default form submission behavior

                var newRow = '<tr>' +
                    '<td><select class="form-select" name="medicine_id[]">@foreach ($getMedicine as $item)<option value="{{ $item->id }}">{{ $item->name }}</option>@endforeach</select></td>' +
                    '<td><textarea class="form-control" name="medicine_notes[]"></textarea></td>' +
                    '<td><button class="btn btn-outline-danger removeRow">Remove</button></td>' +
                    '</tr>';
                $("#inputTable tbody").append(newRow);

                // Show the remove button for all rows except the first one
                $("#inputTable tbody tr:not(:first-child) .removeRow").show();
            });

            $(document).on("click", ".removeRow", function() {
                $(this).closest("tr").remove();

                // Hide the remove button if there is only one row left
                if ($("#inputTable tbody tr").length === 1) {
                    $("#inputTable tbody tr:first-child .removeRow").hide();
                }
            });
        });
    </script>
@endsection
