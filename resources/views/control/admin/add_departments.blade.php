@extends('control.layout._app')

@section('content')
    <div class="pagetitle">
        <h1>Add Department</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('auth.message')
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Manager</h5>

                        <!-- General Form Elements -->
                        <form action="{{ url('/_admin/add_departments') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Department Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Picture upload</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" id="formFile" name="photo_path">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" style="height: 100px" name="description"></textarea>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Block</label>
                                <div class="col-sm-10">
                                    <select name="block_id" class="form-select" aria-label="Default select example">
                                        <option value="{{ $getBlock->first()->id }}">
                                            {{ $getBlock->first()->blockName . '-' . $getBlock->first()->blockCode }}</option>
                                        @foreach ($getBlock as $block)
                                            @if ($block->id <> $getBlock->first()->id)
                                                <option value="{{ $block->id }}">
                                                    {{ $block->blockName . '-' . $block->blockCode }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Action</label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{url('/_admin/departments')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>


        </div>
    </section>
@endsection
