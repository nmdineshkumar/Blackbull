@php
    $name = old('name');
    $address1 = old('address1');
    $address2 = old('address2');
    $pincode = old('pincode');
    $email = old('email');
    $phone = old('phone');
    $contact_name = old('contact_name');
    $contact_email = old('contact_email');
    $contact_phone = old('contact_phone');
    if($id != '')
    {
        $name = (old('name') != '') ? $name : $supplier->name;
        $address1 = (old('address1') != '') ? $address1 : $supplier->address1;
        $address2 = (old('address2') != '') ? $address2 : $supplier->address2;
        $pincode = (old('pincode') != '') ? $pincode : $supplier->pincode;
        $email = (old('email') != '') ? $email : $supplier->email;
        $phone = (old('phone') != '') ? $phone : $supplier->phone;
        $contact_name = (old('contact_name') != '') ? $contact_name : $supplier->contact_name;
        $contact_email = (old('contact_email') != '') ? $contact_email : $supplier->contact_email;
        $contact_phone = (old('contact_phone') != '') ? $contact_phone : $supplier->contact_phone;
    }
@endphp
@extends('layout.mainLayout')
@section('page-breadcrumb')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{ $pageName }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Master</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Supplier</a></li>
                    <li class="breadcrumb-item active">{{$pageName}}</li>
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
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title mt-2 text-uppercase">{{$pageName}}</h4>
                        </div>
                        <div class="col-6 text-end">
                            <a class="btn btn-primary" href="{{route($resourceUrl.'.index')}}"><i class="mdi mdi-arrow-left-circle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route($resourceUrl.'.store')}}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12">
                                <label for="" class="mb-3">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{$name}}">
                                @error('name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="" class="mb-3">Addres 1</label>
                                <input type="text" name="address1" id="address1" class="form-control" value="{{$address1}}">
                                @error('address1')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12">
                                <label for="" class="mb-3">Address 2</label>
                                <input type="text" name="address2" id="address2" class="form-control" value="{{$address2}}">
                                @error('address2')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="" class="mb-3">Pincode</label>
                                <input type="text" name="pincode" id="pincode" class="form-control" value="{{$pincode}}">
                                @error('pincode')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12">
                                <label for="" class="mb-3">Email</label>
                                <input type="text" name="email" id="email" class="form-control" value="{{$email}}">
                                @error('email')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="" class="mb-3">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{$phone}}">
                                @error('phone')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12">
                                <label for="" class="mb-3">Contact Name</label>
                                <input type="text" name="contact_name" id="contact_name" class="form-control" value="{{$contact_name}}">
                                @error('contact_name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12">
                                <label for="" class="mb-3">Contact Email</label>
                                <input type="text" name="contact_email" id="contact_email" class="form-control" value="{{$contact_email}}">
                                @error('contact_email')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="" class="mb-3">Contact Phone</label>
                                <input type="text" name="contact_phone" id="contact_phone" class="form-control" value="{{$contact_phone}}">
                                @error('contact_phone')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                            <div class="row mb-3 text-center">
                                <div class="col-12">
                                    <input type="hidden" name="id" value="{{$id}}">
                                    <button type="submit" class="btn btn-primary"><span>@if ($id == '') Save @else Update @endif</span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('add-js')

@endsection