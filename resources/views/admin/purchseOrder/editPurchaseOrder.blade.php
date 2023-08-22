@php
    $preload = [];
    $image = old('image');
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
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Purchase</a></li>
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
                            <label for="">Supplier</label>
                            <select name="supplier" id="supplier" class="form-select">
                                <option value="">---SELECT---</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="">Purchase Type</label>
                            <select name="purchasetype" id="purchasetype" class="form-select">
                                    <option value="">---SELECT---</option>
                                @foreach (purchase_type() as $row)
                                     <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 col-sm-12">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="">Total Amount</label>
                                    <input type="text" name="total_amount" id="total_amount" class="form-control">
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="">Total Qty</label>
                                    <input type="text" name="total_qty" id="total_qty" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="" class="mb-3">Invoice</label>
                                    <input type="file"name="file1" id="file1" 
                                    file-accept='<?php echo json_encode(array('jpg', 'png', 'gif', 'jpeg', 'svg')) ?>'
                                    data-fileuploader-files='<?php echo json_encode($preload) ?>'
                                    data-id="{{url('admin/delete-image?path=products/tube')}}" 
                                    data-attr-name="image-file-saver"
                                    data-url="{{url('admin/save-image?path=products/tube')}}"
                                    class="form-control">
                                    <input type="hidden" name="image" class="image-file-saver" value="<?php echo $image; ?>">
                                    @error('image')
                                    <div class="error">{{$message}}</div>
                                @enderror
                        </div>
                    </div>
                    <h5>Add Item</h5>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-4">
                            <label for="">Category</label>
                            <select name="category" id="category" class="form-select">
                                <option value="">---SELECT---</option>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="">Product</label>
                            <select name="product" id="product" class="form-select">
                                <option value="">---SELECT---</option>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="">Qty</label>
                                    <input type="text" name="qty" id="qty" class="form-control">
                                </div>
                                <div class="col-md-6 col-sm-12 align-text-bottom">
                                    <div class="d-flex flex-row-reverse bd-highlight">
                                    <a id="addItem" class="btn btn-primary"><i class="mdi mdi-plus-circle"></i> Add</a>
                                </div>
                                </div>
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