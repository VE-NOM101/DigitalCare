@extends('control.layout._app')
@section('content')
    <div class="card">
        <h5 style="text-align:center;" class="card-title alert alert-success">New Prescription</h5>
        <div class="card-body">
            <!-- Multi Columns Form -->
            <form class="row g-3" action="{{ url('_doctor/add_new_prescription') }}" method="POST">
                @csrf
                <h6 style="text-align:center;" class="card-title alert alert-info">Prescription Details
                </h6>
                {{-- <label for="inputPassword5" class="form-label">#Patient-ID<sup style="color:red;">*</sup></label>
        <input type="text" class="form-control" id="inputPassword5" disabled> --}}
                <div class="col-md-12">
                    <label for="inputPatient" class="form-label">Select Patient<sup style="color:red;">*</sup></label>
                    <select id="inputPatient" class="form-select" name="patient_id">
                        @foreach ($getPatientList as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->name }} | Email:
                                {{ $patient->email }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="inputAppointment" class="form-label">Select Appointment<sup
                            style="color:red;">*</sup></label>
                    <select id="inputAppointment" class="form-select" name="appointment_id">
                        <!-- Appointments will be populated dynamically based on selected patient -->
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="inputAddress5" class="form-label">Symptoms<sup style="color:red;">*</sup></label>
                    <textarea id="inputAddress5" class="form-control" name="symptoms"></textarea>
                </div>
                <div class="col-md-6">
                    <label for="inputDiagnosis" class="col-sm-2 col-form-label">Diagnosis<sup
                            style="color:red;">*</sup></label>

                    <select id="inputDiagnosis" class="form-select" multiple aria-label="multiple select example"
                        name="diagnosis">
                        @foreach ($getDiagnosis as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="col-md-12">
            <label for="inputNumber" class="col-sm-2 col-form-label">Photo</label>
            <input class="form-control" type="file" id="formFile" name="photo_path">
        </div> --}}
                <hr />

                <h6 style="text-align:center;" class="card-title alert alert-info mt-2">Medication &
                    Test Reports Details</h6>
                <div class="col-md-12" style="border: 2px solid grey; padding:1rem;">
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
                            <tr>
                                <td>
                                    <select class="form-select" name="medicine_id[]">
                                        @foreach ($getMedicine as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <textarea class="form-control" name="medicine_notes[]"></textarea>
                                </td>
                                <td>
                                    <button class="btn btn-outline-danger removeRow">Remove</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12" style="border: 2px solid grey; padding:1rem;">
                    <h4><label for="inputTest" class="form-label badge bg-warning">Test Reports</label></h4>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="inputTestReport" class="form-label">Test Report</label>
                            <input type="text" class="form-control" id="inputTestReport" name="test_report">
                        </div>
                        <div class="col-md-6">
                            <label for="inputTestNotes" class="form-label">Notes</label>
                            <textarea class="form-control" id="inputTestNotes" name="test_report_note"></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Add Patient</button>
                </div>
                <!-- End Multi Columns Form -->
            </form>
        </div>


    </div>

    {{-- patient --}}
    <script>
        //For prescription

        document.addEventListener('DOMContentLoaded', function() {
            const inputPatient = document.getElementById('inputPatient');
            const inputAppointment = document.getElementById('inputAppointment');

            inputPatient.addEventListener('change', function() {
                const selectedPatientId = this.value;
                inputAppointment.innerHTML = ''; // Clear previous options

                fetchAppointments(selectedPatientId);
            });

            // Fetch appointments for the first patient when the page loads
            fetchAppointments(inputPatient.value);

            function fetchAppointments(patientId) {
                fetch(`/_doctor/get_patient_appointments?patient_id=${patientId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        data.forEach(appointment => {
                            const option = document.createElement('option');
                            option.value = appointment.id;
                            option.textContent =
                                `ID:${appointment.id} | Name: ${appointment.name} | Preferred Date: ${appointment.preferred_date}`;
                            inputAppointment.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching appointments:', error);
                    });
            }
        });
    </script>

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
