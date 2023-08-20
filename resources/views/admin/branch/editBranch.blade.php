@extends('layout.mainLayout')
@php
    $name = old('name');
    $address1 = old('address1');
    $address2 = old('address2');
    $country = old('country');
    $state = old('state');
    $city = old('city');
    $pincode = old('pincode');
    $comments = old('comments');
    if($id != ''){
        $name = (old('name') != '') ? $name : $branches->name;
        $address1 = (old('address1') != '') ? $address1 : $branches->address1;
        $address2 = (old('address2') != '') ? $address2 : $branches->address2;
        $country = (old('country') != '') ? $country : $branches->country;
        $state = (old('state') != '') ? $state : $branches->state;
        $city = (old('city') != '') ? $city : $branches->city;
        $pincode = (old('pincode') != '') ? $pincode : $branches->pincode;
        $comments = (old('comments')!= '') ? $comments : $branches->comments;
        $states = App\Http\Controllers\HelperController::getState($branches->country);
        $cites = App\Http\Controllers\HelperController::getCity($branches->state);
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
                    <form action="{{route($resourceUrl.'.store')}}" method="post">
                        @csrf
                    <div class="row  mb-2">
                        <div class="col-6">
                            <label for="" class="mb-3">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{$name}}">
                            @error('name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6"><label for=""></label></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="" class="mb-3">Address 1</label>
                            <input type="text" name="address1" id="address1" class="form-control" value="{{$address1}}">
                            @error('address1')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-6">
                            <label for="" class="mb-3">Address 2</label>
                            <input type="text" name="address2" id="address1" class="form-control" value="{{$address2}}">
                            @error('address2')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6 col-sm-12">
                            <label for="" class="mb-3">Country</label>
                            <select name="country" id="country" class="form-select">
                                <option value="">---SELECT---</option>
                                @if($id != '')
                                    @foreach ($coutries as $row )
                                        @if($row->id == $country)
                                            <option value="{{$row->id}}" selected>{{ $row->name }}</option>
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
                        <div class="col-md-6 col-sm-12">
                            <label for="" class="mb-3">State</label>
                            <select name="state" id="state" class="form-select">
                                <option value="">---SELECT---</option>
                                @if($id != '' || $id != null)
                                    @foreach ($states as $row)
                                        @if ($state == $row->id)
                                            <option value="{{$row->id}}" selected >{{ $row->name }}</option>
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
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <label for="" class="mb-3">City</label>
                            <select name="city" id="city" class="form-select">
                                <option value="">---SELECT---</option>
                                @if($id != '' || $id != null)
                                    @foreach ($cites as $row)
                                        @if ($city == $row->id)
                                            <option value="{{$row->id}}" selected >{{ $row->name }}</option>
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
                        <div class="col-md-6 col-sm-12 mb-3">
                            <label for="" class="mb-3">Pincode</label>
                            <input type="text" name="pincode" id="pincode" class="form-control" value="{{$pincode}}">
                            @error('pincode')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 col-sm-12">
                            <label for="" class="mb-3">Comments</label>
                            <textarea name="comments" id="comments" cols="30" rows="10" class="form-control">{{$comments}}</textarea>
                        </div>
                        <div class="col-md-6 col-sm-12"></div>
                    </div>
                    <div class="row mb-3">
                        <input type="hidden" name="id" value="{{$id}}">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary"><span>@if ($id =='') Submit @else Update @endif</span></button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')

@endpush