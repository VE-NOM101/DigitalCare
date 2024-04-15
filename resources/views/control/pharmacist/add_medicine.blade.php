@extends('control.layout._app')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">New Medicine</h5>
            <!-- Multi Columns Form -->
            <form class="row g-3" action="{{url('_pharmacist/add_medicine')}}" method="POST">
                @csrf
                <div class="col-md-6">
                    <label for="inputName5" class="form-label">Medicine<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputName5" name="name">
                </div>
                <div class="col-md-6">
                    <label for="inputCategory" class="form-label">Category<sup style="color:red;">*</sup></label>
                    <select id="inputCategory" class="form-select" name="category_id">
                        @foreach ($getCategory as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="inputBrand" class="form-label">Brand<sup style="color:red;">*</sup></label>
                    <select id="inputBrand" class="form-select" name="brand_id">
                        @foreach ($getBrand as $item)
                            <option value="{{$item->id}}">{{$item->brand}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="inputAddress5s" class="form-label">Salt Composition<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputAddres5s" name="salt_composition">
                </div>
                <div class="col-md-6">
                    <label for="inputAddress2" class="form-label">Buying Price<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputAddress2" name="buying_price">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">Selling Prime<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputCity" name="selling_price">
                </div>
                <div class="col-md-6">
                    <label for="inputSide" class="form-label">Side Effects</label>
                    <textarea id="inputSide" class="form-control" name="side_effect"></textarea>
                </div>
                <div class="col-md-6">
                    <label for="inputDescription" class="form-label">Description</label>
                    <textarea id="inputDescription" class="form-control" name="description"></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <a href="" class="btn btn-secondary">Cancel</a>
                </div>
            </form><!-- End Multi Columns Form -->

        </div>
    </div>
@endsection
