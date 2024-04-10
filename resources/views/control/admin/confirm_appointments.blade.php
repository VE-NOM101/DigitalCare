@extends('control.layout._app')
@section('content')
    <div class="col-lg-8">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Select the nurse</h5>
                <form action="{{url('/_admin/confirm_appointment/'.$getApprovedId)}}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="card">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="nurse_id">
                                    {{-- <option value="{{ $getAllNurseId[0]}}">
                                        {{ $getNurse->find($getAllNurseId[0])->id . '<-->' . $getNurse->find($getAllNurseId[0])->email }}
                                    </option> --}}
                                    @foreach ($getAllNurseId as $id)
                                        @if($getNurse->find($id))
                                            <option value="{{$id}}">{{$getNurse->find($id)->id .'<-->'.$getNurse->find($id)->email}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label for="floatingSelect">Here are the available nurses</label>
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
