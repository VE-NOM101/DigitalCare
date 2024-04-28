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
                    <h4 class="card-title" style="font-size: 1.5rem;">Invoice #{{ $getInvoice->id }}</h4>
                    <!-- Prescription form goes here -->
                </div>
            </div>
            <hr>
            <div class="row card-body">
                <div class="col-md-3">
                    <h6 style="font-weight: bold;">Doctor</h6>
                    <h6>{{ $getDoctor->name }}</h6>
                    <h6>{{ $getDoctor->qualification }}</h6>
                    <h6>{{ $getDoctor->phone }}</h6>
                    <h6>{{ $getDoctor->email }}</h6>
                    <!-- Content for doctor goes here -->
                </div>
                <div class="col-md-3">
                    <h6 style="font-weight: bold;">Patient</h6>
                    <h6>{{ $getPatient->name }}</h6>
                    <h6>{{ $getPatient->phone }}</h6>
                    <h6>{{ $getPatient->email }}</h6>
                    <!-- Content for patient goes here -->
                </div>
                <div class="col-md-3">
                    <h6 style="font-weight: bold;">Payment Details</h6>
                    <h6>Payment Method: {{ $getInvoice->payment_method }}</h6>
                    <h6>Status: {{ $getInvoice->status }}</h6>
                    <!-- Content for patient goes here -->
                </div>
                <div class="col-md-3">
                    <h6 style="font-weight: bold;">Invoice Date:
                        {{ \Carbon\Carbon::parse($getInvoice->updated_at)->format('d-m-Y | h:i A') }}</h6>
                    <h6 style="font-weight: bold;">Appointment Date:
                        @if ($getRA)
                            {{ \Carbon\Carbon::parse($getRA->preferred_date)->format('d-m-Y') }}
                        @else
                            -
                        @endif
                    </h6>
                    <!-- Content for dates goes here -->
                </div>
            </div>
            <hr>
            <div class="row card-body">
                <div class="col-md-12">
                    <h5 style="font-weight: bold;">Invoice summary</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Amount</th>
                                <th>Tax</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td>{{ $getInvoice->id }}</td>
                                <td>{{ $getInvoice->title }}</td>
                                <td>{{ $getInvoice->amount }}Tk</td>
                                <td>{{ $getInvoice->tax }}</td>
                            </tr>

                        </tbody>
                    </table>

                    <!-- Content for doctor goes here -->
                </div>
                <div class="col-md-9">

                </div>
                <div class="col-md-3">
                    <h4><span style="color:cornflowerblue;">Total</span> :
                        {{ $getInvoice->amount + ($getInvoice->amount * $getInvoice->tax) / 100 }}Tk</h4>
                    <!-- Content for patient goes here -->
                </div>
                @if ($getInvoice->status == 'unpaid')
                    <div class="col-md-12 text-center">
                        <br><br>
                        <h3><a href="{{ url('/_user/payment/' . $getInvoice->id) }}" type="button"
                                class="btn btn-primary"><i class="bi bi-paypal"></i><span> </span>Quick Pay</a></h3>
                    </div>
                @endif
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
