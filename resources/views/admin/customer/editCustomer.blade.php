@extends('layout.mainLayout')
@php
    $first_name = old('first_name');
    $last_name = old('last_name');
    $address1 = old('address1');
    $address2 = old('address2');
    $country = old('country');
    $state = old('state');
    $city = old('city');
    $zip = old('zip');
    $email = old('email');
    $phone = old('phone');
    $type = old('type');
    if($id != ''){
        $first_name = (old('first_name') != '') ? $first_name : $customer->first_name;
        $last_name = (old('last_name') != '') ? $last_name : $customer->last_name;
        $address1 = (old('address1') != '') ? $address1 : $customer->address1;
        $address2 = (old('address2') != '') ? $address2 : $customer->address2;
        $country = (old('country') != '') ? $country : $customer->country;
        $state = (old('state') != '') ? $state : $customer->state;
        $city = (old('city') != '') ? $city : $customer->city;
        $zip = (old('zip') != '') ? $zip : $customer->zip;
        $email = (old('email') != '') ? $email : $customer->email;
        $phone = (old('phone') != '') ? $phone : $customer->phone;
        $type = (old('type') != '') ? $type : $customer->type;
        $states = App\Http\Controllers\HelperController::getState($customer->country);
        $cites = App\Http\Controllers\HelperController::getCity($customer->state);
    }
    $coutries = App\Http\Controllers\HelperController::getCountry();
@endphp
@section('page-breadcrumb')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{ $pageName }}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Master</a></li>
                    <li class="breadcrumb-item active">{{ $pageName }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row mb-2">
                    <div class="col-6">
                        <h4 class="card-title mt-2 text-uppercase">{{$pageName}}</h4>
                    </div>
                    <div class="col-6 text-end">
                        <a class="btn btn-primary" href="{{route($resourceUrl.'.index')}}"><i class="mdi mdi-arrow-left-circle"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form  action="{{ route($resourceUrl . '.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-6 mb-2">
                            <label for="">Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $first_name }}">
                            @error('first_name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-6 mb-2">
                            <label for="">Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $last_name }}">
                            @error('first_name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-6 mb-2">
                            <label for="">Address 1</label>
                            <input type="text" name="address1" id="address1" class="form-control" value="{{ $address1 }}">
                            @error('address1')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-6 mb-2">
                            <label for="">Address 2</label>
                            <input type="text" name="address2" id="address2" class="form-control" value="{{ $address2 }}">
                        </div>
                        <div class="col-6 mb-2">
                            <label for="">Email</label>
                            <input type="text" name="email" id="email" class="form-control" value="{{ $email }}">
                            @error('email')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-6 mb-2">
                            <label for="">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ $phone }}">
                            @error('phone')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-6 mb-2">
                            <label for="">Country</label>
                            <select name="country" id="country" class="selectpicker form-select" data-live-search="true">
                                <option value="">---SELECT---</option>
                                @if($id != '')
                                    @foreach ($coutries as $row )
                                        @if($row->id == $country)
                                            <option value="{{$row->id}}" selected="true">{{ $row->name }}</option>
                                        @else
                                        <option value="{{$row->id}}">{{ $row->name }}</option>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($coutries as $row )
                                    <option value="{{$row->id}}">{{ $row->name }}</option>
                                     @endforeach
                                @endif
                            </select>
                            @error('country')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-6 mb-2">
                            <label for="">State</label>
                            <select name="state" id="state" class="selectpicker form-select" data-live-search="true">
                                <option value="">---SELECT---</option>
                                @if($id != '' || $id != null)
                                @foreach ($states as $row)
                                    @if ($state == $row->id)
                                        <option value="{{$row->id}}" selected="true">{{ $row->name }}</option>
                                    @else
                                        <option value="{{$row->id}}" >{{ $row->name }}</option>
                                    @endif
                                @endforeach
                                @endif
                            </select>
                            @error('state')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-6 mb-2">
                            <label for="">City</label>
                            <select name="city" id="city" class="selectpicker form-select" data-live-search="true">
                                <option value="">---SELECT---</option>
                                @if($id != '' || $id != null)
                                @foreach ($cites as $row)
                                    @if ($city == $row->id)
                                        <option value="{{$row->id}}" selected="true">{{ $row->name }}</option>
                                    @else
                                        <option value="{{$row->id}}" >{{ $row->name }}</option>
                                    @endif
                                @endforeach
                                @endif
                            </select>
                            @error('city')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-6 mb-2">
                            <label for="">Zip</label>
                            <input type="text" name="zip" id="zip" class="form-control" value="{{ $zip }}">
                            @error('zip')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3 text-center">
                    <input type="hidden" name="type" value="{{ $type }}">
                    <input type="hidden" name="id" id="id" value="{{ $id }}">
                    <a href="{{route($resourceUrl.'.index')}}" class="btn btn-secondary">Close</a>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<style>
    .btn.dropdown-toggle.bs-placeholder.btn-light,.btn.dropdown-toggle.btn-light {
        padding: 0px !important;
        background-color: transparent;
        border: 0px;
    }

    .dropdown.bootstrap-select.form-select {
        width: 100% !important;
    }

    .input-group .dropdown.bootstrap-select.form-select {
        width: auto !important;
    }
</style>
@endsection


@push('js')

@endpush
