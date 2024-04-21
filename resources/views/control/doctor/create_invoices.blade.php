@extends('control.layout._app')
@section('content')
    <div class="card">
        @include('auth.message')
        @include('auth.error')
        <h5 style="text-align:center;" class="card-title alert alert-success">New Invoice</h5>
        <div class="card-body">
            <!-- Multi Columns Form -->
            <form class="row g-3" action="{{ url('_doctor/') }}" method="POST">
                @csrf
                <h6 style="text-align:center;" class="card-title alert alert-warning">Invoices Details
                </h6>
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
                    <select id="inputAppointment" class="form-select" name="req_appointment_id">
                        <!-- Appointments will be populated dynamically based on selected patient -->
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="inputAddress5" class="form-label">Payment Method<sup style="color:red;">*</sup></label>
                    <select class="form-select" id="inputAddress5" name="payment_method">
                        <option value="cash">Cash</option>
                        <option value="cheque">Cheque</option>
                        <option value="credit_card">Credit Card</option>
                        <option value="online">Online</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="inputDiagnosis" class="col-sm-2 col-form-label">Status<sup
                            style="color:red;">*</sup></label>
                    <select class="form-select" id="inputDiagnosis" name="payment_status">
                        <option value="unpaid">Unpaid</option>
                        <option value="paid">Paid</option>
                    </select>
                </div>
                <hr />
                <h6 style="text-align:center;" class="card-title alert alert-warning">Invoices Summary
                </h6>
                <div class="col-md-6">
                    <label for="inputTitle" class="col-sm-2 col-form-label">Title<sup
                            style="color:red;">*</sup></label>
                    <input type="text" class="form-control" name="title"/>
                </div>
                <div class="col-md-6">
                    <label for="inputAmount" class="col-sm-2 col-form-label">Amount<sup
                            style="color:red;">*</sup></label>
                    <input type="number" class="form-control" name="amount"/>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Create Invoice</button>
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
