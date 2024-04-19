@extends('control.layout._app')
@section('content')
    <div class="card">
        @include('auth.message')
        @include('auth.error')
        <h5 style="text-align:center;" class="card-title alert alert-success">View Purchase Details</h5>
        <div class="card-body">
            <!-- Multi Columns Form -->

            <h6 style="text-align:center;" class="card-title alert alert-info mt-2">Select Medicines</h6>
            <div class="col-md-12" style="border: 2px solid grey; padding:1rem;">
               
                <table class="table table-striped" id="inputTable">
                    <thead>
                        <tr>
                            <th>Medicaments</th>
                            <th>Lot No</th>
                            <th>Purchase Price</th>
                            <th>Sale Price</th>
                            <th>Quantity</th>
                            <th>Tax</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getAllMedicine as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->pivot->lot_no }}</td>
                                <td>{{ $item->buying_price }}</td>
                                <td>{{ $item->selling_price }}</td>
                                <td>{{ $item->pivot->quantity }}</td>
                                <td>{{ $item->pivot->tax }}%</td>
                                <td>{{ $item->pivot->amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <h6 style="text-align:center;" class="card-title alert alert-info mt-2">Memo</h6>
            <div class="col-md-12" style="border: 2px solid grey; padding:1rem;">
                <div class="row">
                    <div class="col-md-7">
                        <label for="inputNote" class="form-label">Note</label>
                        <textarea class="form-control" id="inputNote" name="notes" style="height: 100px" disabled>{{$getMedicinePurchase->note}}</textarea>
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="inputDiscount" class="form-label">Discount</label>
                                <input type="number" class="form-control" id="inputDiscount" name="discount"
                                     value="{{$getMedicinePurchase->discount}}" disabled>
                            </div>
                            <div class="col-md-12">
                                <label for="inputNet" class="form-label">Net<sup style="color:red;">*</sup></label>
                                <input type="number" class="form-control" id="inputNet" name="net" value="{{$getMedicinePurchase->net}}" disabled>
                            </div>
                            <div class="col-md-12">
                                <label for="inputMethod" class="form-label">Payment Method<sup
                                        style="color:red;">*</sup></label>
                                <select class="form-select" name="payment_method" disabled>
                                    <option value="cash" @if($getMedicinePurchase->payment_method=='cash') @selected(true) @endif>Cash</option>
                                    <option value="cheque" @if($getMedicinePurchase->payment_method=='cheque') @selected(true) @endif>Cheque</option>
                                    <option value="credit_card" @if($getMedicinePurchase->payment_method=='credit_card') @selected(true) @endif>Credit Card</option>
                                    <option value="online" @if($getMedicinePurchase->payment_method=='online') @selected(true) @endif>Online</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
