@extends('control.layout._app')
@section('content')
    <div class="col-lg-12">
        <div class="card">
            @include('auth.message')
            @include('auth.error')
            <div class="card-body">
                <h5 class="card-title">Medicines Manager</h5>

                <!-- Bordered Tabs Justified -->
                <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="home-tab" data-bs-toggle="tab"
                            data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home"
                            aria-selected="false">Medicine Categories</button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab"
                            data-bs-target="#bordered-justified-profile" type="button" role="tab"
                            aria-controls="profile" aria-selected="false">Medicine Brands</button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100 active" id="medicine-tab" data-bs-toggle="tab"
                            data-bs-target="#bordered-justified-medicine" type="button" role="tab"
                            aria-controls="medicine" aria-selected="true">Medicines</button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="purchase-tab" data-bs-toggle="tab"
                            data-bs-target="#bordered-justified-purchase" type="button" role="tab"
                            aria-controls="purchase" aria-selected="false">Purchase Medicines</button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab"
                            data-bs-target="#bordered-justified-contact" type="button" role="tab"
                            aria-controls="contact" aria-selected="false">Contact</button>
                    </li>
                </ul>
                <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                    <div class="tab-pane fade" id="bordered-justified-home" role="tabpanel" aria-labelledby="home-tab">
                        <a class="btn btn-info text-center" href="{{ url('/_pharmacist/add_medicine_category') }}">Add
                            Medicine
                            Category<span> </span><i class="bi bi-plus-circle-fill"></i></a>
                        <table class="table table-striped datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getCategory as $item)
                                    <tr>
                                        <td scope="row">{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            @if ($item->isActive == 1)
                                                <span class="badge bg-primary">On</span>
                                            @else
                                                <span class="badge bg-secondary">Off</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('_pharmacist/edit_medicine_category/' . $item->id) }}"
                                                class="btn btn-success"><i class="bi bi-pencil-square"></i></a>

                                            <a href="{{ url('_pharmacist/delete_medicine_category/' . $item->id) }}"
                                                onclick="return confirm('Are you sure that you want to delete?')"
                                                class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="bordered-justified-profile" role="tabpanel"
                        aria-labelledby="profile-tab">

                        <a class="btn btn-info text-center" href="{{ url('/_pharmacist/add_medicine_brand') }}">Add
                            Medicine
                            Brand<span> </span><i class="bi bi-plus-circle-fill"></i></a>
                        <table class="table table-striped datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getBrand as $item)
                                    <tr>
                                        <td scope="row">{{ $item->id }}</td>
                                        <td>{{ $item->brand }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>
                                            <a href="{{ url('_pharmacist/edit_medicine_brand/' . $item->id) }}"
                                                class="btn btn-success"><i class="bi bi-pencil-square"></i></a>

                                            <a href="{{ url('_pharmacist/delete_medicine_brand/' . $item->id) }}"
                                                onclick="return confirm('Are you sure that you want to delete?')"
                                                class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fade show active" id="bordered-justified-medicine" role="tabpanel"
                        aria-labelledby="medicine-tab">
                        <a class="btn btn-info text-center" href="{{ url('/_pharmacist/add_medicine') }}">Add
                            Medicine<span> </span><i class="bi bi-plus-circle-fill"></i></a>
                        <table class="table table-striped datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Medicine</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Available Quantity</th>
                                    <th scope="col">Selling Price</th>
                                    <th scope="col">Buying Price</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getMedicine as $item)
                                    <tr>
                                        <td scope="row" class="text-center">{{ $item->id }}</td>
                                        <td class="text-center">{{ $item->name }}</td>
                                        <td class="text-center">{{ $getCategory->find($item->category_id)->name }}</td>
                                        <td class="text-center">{{ $getBrand->find($item->brand_id)->brand }}</td>
                                        <td class="text-center"><span
                                                class="badge bg-primary">{{ $item->quantity }}</span></td>
                                        <td class="text-center">{{ $item->selling_price }}</td>
                                        <td class="text-center">{{ $item->buying_price }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('_pharmacist/edit_medicine/' . $item->id) }}"
                                                class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="bordered-justified-purchase" role="tabpanel"
                        aria-labelledby="purchase-tab">
                        <a class="btn btn-info text-center" href="{{ url('/_pharmacist/buy_medicine') }}">Buy
                            Medicine<span> </span><i class="bi bi-plus-circle-fill"></i></a>
                        <table class="table table-striped datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#Purchase Number</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Net</th>
                                    <th scope="col">Method of payment</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getMedicinePurchase as $item)
                                    <tr>
                                        <td scope="row" class="text-center">Dig@SL::{{ $item->id }}</td>
                                        <td class="text-center">{{ $item->discount }}</td>
                                        <td class="text-center">{{ $item->net }}</td>
                                        <td class="text-center">{{ $item->payment_method}}</td>
                                        <td class="text-center">
                                            <a href="{{ url('_pharmacist/view_medicine_purchase/' . $item->id) }}"
                                                class="btn btn-info"><i class="bi bi-eye"></i></a>

                                            <a href="{{ url('_pharmacist/delete_medicine_purchase/' . $item->id) }}"
                                                onclick="return confirm('Are you sure that you want to delete?')"
                                                class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane fade" id="bordered-justified-contact" role="tabpanel"
                        aria-labelledby="contact-tab">
                        Saepe animi et soluta ad odit soluta sunt. Nihil quos omnis animi debitis cumque. Accusantium
                        quibusdam perspiciatis qui qui omnis magnam. Officiis accusamus impedit molestias nostrum veniam.
                        Qui amet ipsum iure. Dignissimos fuga tempore dolor.
                    </div>
                </div><!-- End Bordered Tabs Justified -->

            </div>
        </div>
    </div>
@endsection
