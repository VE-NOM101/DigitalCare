@extends('control.layout._app')

@section('content')
    <div class="card">
        <h5 style="text-align:center;" class="card-title alert alert-success">New Prescription</h5>
        <div class="card-body">

            @include('auth.error')
            @include('auth.message')
            <!-- Multi Columns Form -->
            <form class="row g-3" action="{{ url('_doctor/') }}" method="POST">
                @csrf
                <h6 style="text-align:center;" class="card-title alert alert-info">Prescription Details</h6>
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
                    <label for="inputDiagnosis" class="col-sm-2 col-form-label">Diagnosis<sup style="color:red;">*</sup></label>

                    <select id="inputDiagnosis" class="form-select" multiple aria-label="multiple select example" name="diagnosis">
                        @foreach ($getDiagnosis as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">Contact Number<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputCity" name="phone">
                </div>
                {{-- <div class="col-md-12">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Photo</label>
                    <input class="form-control" type="file" id="formFile" name="photo_path">
                </div> --}}
                <hr />

                <h6 style="text-align:center;" class="card-title alert alert-info mt-2">Medical Information</h6>
                <div class="col-md-6">
                    <label for="inputPassword5" class="form-label">Height<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputPassword5" placeholder="Enter Height In Centimeter"
                        name="height">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword5" class="form-label">Blood Group<sup style="color:red;">*</sup></label>
                    <select id="inputState" class="form-select" name="blood_group">
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="inputPassword5" class="form-label">Pulse<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputPassword5" placeholder="Enter Pulse" name="pulse">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword5" class="form-label">Blood Pressure<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputPassword5" placeholder="Enter Blood Pressure"
                        name="blood_pressure">
                </div>
                <div class="col-md-12">
                    <label for="inputPassword5" class="form-label">Allergy<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputPassword5" placeholder="Enter Allergy Symptoms"
                        name="allergy">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword5" class="form-label">Weight<sup style="color:red;">*</sup></label>
                    <input type="number" class="form-control" id="inputPassword5" placeholder="Enter Weight"
                        name="weight">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword5" class="form-label">Respiration<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputPassword5" placeholder="Enter Respiration"
                        name="respiration">
                </div>
                <div class="col-md-12">
                    <label for="inputPassword5" class="form-label">Diet<sup style="color:red;">*</sup></label>
                    <select id="inputState" class="form-select" name="diet">
                        <option value="vegetarian">Vegetarian</option>
                        <option value="non-vegetarian">Non-Vegetarian</option>
                        <option value="vegan">Vegan</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Add Patient</button>
                </div>
                <!-- End Multi Columns Form -->
            </form>
        </div>


    </div>

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
@endsection
