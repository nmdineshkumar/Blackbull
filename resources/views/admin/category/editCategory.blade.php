@php
    $name = old('name');
    $description = old('description');
    if($id != ''){
        $name = (old('name') != '') ? $name : $category->name;
        $description = (old('description') != '') ? $description : $category->description;
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
                <div class="row  mb-3">
                    <div class="col-6">
                        <label for="" class="mb-3">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$name}}">
                        @error('name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6"><label for=""></label></div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="" class="mb-3">Description</label>
                        <input type="text" name="description" id="description" class="form-control" value="{{$description}}">
                        @error('description')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    </div>                    
                </div>
                <div class="row mb-3">
                    <input type="hidden" name="id" value="{{$id}}">
                    <div class="col-6 text-center">
                        <button type="submit" class="btn btn-primary"><span>@if ($id =='') Submit @else Update @endif</span></button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('add-js')

@endpush