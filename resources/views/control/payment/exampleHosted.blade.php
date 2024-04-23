@extends('control.layout._app')
@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<style>
.bd-placeholder-img {
  font-size: 1.125rem;
  text-anchor: middle;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

@media (min-width: 768px) {
  .bd-placeholder-img-lg {
      font-size: 3.5rem;
  }
}
</style>
    <div class="container">
        <div class="py-5 text-center">
            <h2>SSLCommerz</h2>
            <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. We have provided
                this sample form for understanding Hosted Checkout Payment with SSLCommerz.</p>
        </div>

        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your Bill</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Title</h6>
                            <small class="text-muted">{{$getInvoice->title}}</small>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Amount</h6>
                        </div>
                        <span class="text-muted">{{$getInvoice->amount}}Tk</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Tax</h6>
                        </div>
                        <span class="text-muted">{{$getInvoice->tax*$getInvoice->amount/100}}Tk</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (BDT)</span>
                        <strong>{{$getInvoice->amount + $getInvoice->tax*$getInvoice->amount/100}}Tk</strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing address</h4>
                <form action="{{ url('_user/pay/'.$getInvoice->id) }}" method="POST" class="needs-validation">
                    <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="firstName">Full name</label>
                            <input type="text" name="customer_name" class="form-control" id="customer_name"
                                placeholder="" value="{{$getPatient->name}}" required readonly>
                            <div class="invalid-feedback">
                                Valid customer name is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="mobile">Mobile</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+88</span>
                            </div>
                            <input type="text" name="customer_mobile" class="form-control" id="mobile"
                                placeholder="Mobile" value="{{$getPatient->phone}}" required readonly>
                            <div class="invalid-feedback" style="width: 100%;">
                                Your Mobile number is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email <span class="text-muted"></span></label>
                        <input type="email" name="customer_email" class="form-control" id="email"
                            placeholder="you@example.com" value="{{$getPatient->email}}" required readonly>
                        <div class="invalid-feedback">
                            Please enter a valid email address.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" name= "customer_address" class="form-control" id="address" placeholder="1234 Main St"
                            value="{{$getPatient->address}}" required readonly>
                        <div class="invalid-feedback">
                            Please enter your address.
                        </div>
                    </div>
                    <hr class="mb-4">
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Confirm</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
@endsection
