@extends('control.layout._app')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">IPD-Patient</h5>

            <!-- Horizontal Form -->
            <form action="{{ url('/_doctor/edit_ipd_patient/'.$getIpd->id) }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Patient</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="patient_id" disabled>
                                <option value="{{ $getIpd->patient_id }}">{{ $getPatient->find($getIpd->patient_id)->name }}</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Doctor</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="doctor_id">
                            @foreach ($getDoctor as $item)
                                @if($getIpd->doctor_id == $item->id) <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                @else<option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Bed</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="bed_id">
                            @foreach ($getBedType as $item)
                                @if($getIpd->bed_id == $item->id) <option value="{{ $item->id }}" style="color: {{ $item->color }};" selected>
                                    {{ $item->type }}</option>
                            
                                @else<option value="{{ $item->id }}" style="color: {{ $item->color }};">
                                    {{ $item->type }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Bill Status</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="bill_status">
                            @if($getIpd->bill_status=='unpaid')
                            <option value="unpaid" style="color: red;"><span>Unpaid</span></option>
                            @else
                            <option value="paid" style="color: green;"><span>Paid</span></option>
                            @endif

                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputAddress5" class="col-sm-2 col-form-label">Payment Method</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="inputAddress5" name="payment_method">
                            <option @if($getPayment == 'cash') selected @endif value="cash">Cash</option>
                            <option @if($getPayment == 'cheque') selected @endif value="cheque">Cheque</option>
                            <option @if($getPayment == 'credit_card') selected @endif value="credit_card">Credit Card</option>
                            <option @if($getPayment == 'online') selected @endif value="online">Online</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Admission Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="inputText" name="admission_date"
                            min="{{ now()->format('Y-m-d') }}" value="{{$getIpd->admission_date}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Notes</label>
                    <div class="col-sm-10">
                        <textarea name="note" class="form-control" placeholder="Write short notes">{{$getIpd->note}}</textarea>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ url('/_doctor/ipd_patient') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
            <!-- End Horizontal Form -->

        </div>
    </div>
@endsection
