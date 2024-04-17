@extends('control.layout._app')

@section('content')
<div class="card-footer text-end">
    <button class="btn btn-primary" onclick="printContent()"><i class="bi bi-printer"></i> Print</button>
</div>
    <div id="print-content">
        <div class="card">
            <div class="card-body d-flex justify-content-between">
                <div>
                    <h4 class="card-title" style="font-size: 1.5rem;"><img
                            src="{{ config('app.url') }}/Admin/assets/img/favicon.png">DigitalCare</h4>
                    <!-- Your existing content here -->
                </div>

                <div>
                    <h4 class="card-title" style="font-size: 1.5rem;">Prescription #{{ $getPrescription->id }}</h4>
                    <!-- Prescription form goes here -->
                </div>
            </div>
            <hr>
            <div class="row card-body">
                <div class="col-md-4">
                    <h6 style="font-weight: bold;">Doctor</h6>
                    <h6>{{ $getDoctor->name }}</h6>
                    <h6>{{ $getDoctor->qualification }}</h6>
                    <h6>{{ $getDoctor->phone }}</h6>
                    <h6>{{ $getDoctor->email }}</h6>
                    <!-- Content for doctor goes here -->
                </div>
                <div class="col-md-4">
                    <h6 style="font-weight: bold;">Patient</h6>
                    <h6>{{ $getPatient->name }}</h6>
                    <h6>{{ $getPatient->phone }}</h6>
                    <h6>{{ $getPatient->email }}</h6>
                    <!-- Content for patient goes here -->
                </div>
                <div class="col-md-4">
                    <h6 style="font-weight: bold;">Prescription Date:
                        {{ \Carbon\Carbon::parse($getPrescription->updated_at)->format('d-m-Y | h:i A') }}</h6>
                    <h6 style="font-weight: bold;">Appointment Date:
                        {{ \Carbon\Carbon::parse($getRA->preferred_date)->format('d-m-Y') }}</h6>
                    <!-- Content for dates goes here -->
                </div>
            </div>
            <hr>
            <div class="row card-body text-center">
                <div class="col-md-6">
                    <h6 style="font-weight: bold;">Symptoms:</h6>
                    <h6>{{ $getPrescription->symptoms }}</h6>
                    <!-- Content for doctor goes here -->
                </div>
                <div class="col-md-6">
                    <h6 style="font-weight: bold;">Diagnosis:</h6>
                    <h6>
                        @foreach ($getDiagnosis as $item)
                            {{ $item->name }},
                        @endforeach
                    </h6>
                    <!-- Content for patient goes here -->
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-6">
                    <h5 style="font-weight: bold;">Medications</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Medicine</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getMedicine as $item)
                                <tr>

                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->pivot->notes }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Content for doctor goes here -->
                </div>
                <div class="col-md-2">

                </div>
                <div class="col-md-4">
                    <h5 style="font-weight: bold;">Test Reports</h5>
                    <br><br>
                    <h6><span style="color:cornflowerblue;">{{ $getPrescription->test_report }}</span> :
                        {{ $getPrescription->test_report_note }}</h6>
                    <!-- Content for patient goes here -->
                </div>
            </div>
        </div>
    </div>
    <script>
        function printContent() {
            var content = document.getElementById("print-content").innerHTML;
            var originalBody = document.body.innerHTML;
            document.body.innerHTML = content;
            window.print();
            document.body.innerHTML = originalBody;
        }
    </script>
@endsection
