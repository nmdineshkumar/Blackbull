@php
    $preload = [];
    $image = old('image');
    $name = old('name');
    $brand = old('brand');
    $pattern = old('pattern');
    $type = old('type');
    $origin = old('origin');
    $myear = old('myear');
    $sku = old('sku');
    $wyear = old('wyear');
    $make = old('make');
    $model = old('model');
    $year = old('year');
    $fuel_type = old('fuel_type');
    $engine_type = old('engine_type');
    $other = old('other');
    $tyre_size = old('tyre_size');
    $description = old('description');
    $price = old('price');
    $set_price = old('set_price');
    $visible_status = old('visible_status');

    if ($id != '') {
        $name = old('name') != '' ? $name : $tyre->name;
        $brand = old('brand') != '' ? $brand : $tyre->brand;
        $pattern = old('pattern') != '' ? $pattern : $tyre->pattern;
        $tyre_type = old('tyre_type') != '' ? $tyre_type : $tyre->tyre_type;
        $origin = old('orgin') != '' ? $orgin : $tyre->origin;
        $myear = old('myear') != '' ? $myear : $tyre->manufactory_year;
        $wyear = old('wyear') != '' ? $wyear : $tyre->warranty_year;
        $sku = old('sku') != '' ? $sku : $tyre->sku;
        $description = old('description') != '' ? $description : $tyre->description;
        $price = old('price') != '' ? $price : $tyre->price;
        $image = old('image') != '' ? $image : $tyre->image;
        $make = old('make') != '' ? $make : $cars_data[0]->maker;
        $model = old('model') != '' ? $model : $cars_data[0]->model;
        $year = old('year') != '' ? $year : $cars_data[0]->year;
        $fuel_type = old('fuel_type') != '' ? $fuel_type : $cars_data[0]->fuel_type;
        $engine_type = old('engine_type') != '' ? $engine_type : $cars_data[0]->engine;
        $other = old('other') != '' ? $other : $cars_data[0]->Horsepower;
        $tyre_size = old('tyre_size') != '' ? $tyre_size : $cars_data[0]->tyre_size;
        $set_price = old('set_price') != '' ? $set_price : $tyre->set_price;
        $visible_status = old('visible_status') != '' ? $visible_status : $tyre->status;
    }
    if ($image != '') {
        $path1 = 'products/tyre/' . $image;
        if (Storage::disk(getFileDisk())->exists($path1)) {
            $path = Storage::disk(getFileDisk())->url($path1);
            $mime = Storage::disk(getFileDisk())->mimeType($path1);
            $size = Storage::disk(getFileDisk())->size($path1);

            $inner = [
                'url' => $path,
                'thumbnail' => $path,
                'readerForce' => true,
            ];
            $preload[] = [
                'name' => $image,
                'type' => $mime,
                'size' => $size,
                'file' => $path,
                'local' => $path,
                'data' => ['url' => $path, 'thumbnail' => $path, 'readerForce' => true],
            ];
        }
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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tyre</a></li>
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
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title mt-2 text-uppercase">{{ $pageName }}</h4>
                        </div>
                        <div class="col-6 text-end">
                            <a class="btn btn-primary" href="{{ route($resourceUrl . '.index') }}"><i
                                    class="mdi mdi-arrow-left-circle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">


                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form action="{{ route($resourceUrl . '.store') }}" method="post">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-6 col-sm-12">
                                <label for="">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $name }}">
                                @error('name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="">Brand</label>
                                <div class="input-group">
                                    <select name="brand" id="brand" class="form-select">
                                        <option value="">---SELECT---</option>
                                        @if ($id != '')
                                            @foreach ($brand_dataset as $row)
                                                @if ($brand == $row->id)
                                                    <option value="{{ $row->id }}" selected>{{ $row->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            @foreach ($brand_dataset as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="input-group-append">
                                        <a data-bs-toggle="modal" data-bs-target="#brandModal" class="btn btn-primary"><i
                                                class="mdi mdi-plus-circle"></i></a>
                                    </div>
                                </div>
                                @error('brand')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6 col-sm-12">
                                <label for="">Pattern</label>
                                <div class="input-group">
                                    <select name="pattern" id="pattern" class="form-select">
                                        <option value="">---SELECT---</option>
                                        @if ($id != '')
                                            @foreach ($pattern_dataset as $row)
                                                @if ($pattern == $row->id)
                                                    <option value="{{ $row->id }}" selected>{{ $row->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            @foreach ($pattern_dataset as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="input-group-append">
                                        <a data-bs-toggle="modal" data-bs-target="#patternModal" class="btn btn-primary"><i
                                                class="mdi mdi-plus-circle"></i></a>
                                    </div>
                                </div>
                                @error('pattern')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="">Type</label>
                                <select name="type" id="type" class="form-select">
                                    <option value="">---SELECT---</option>
                                    @if ($id != '')
                                        @foreach (tyreType() as $row)
                                            @if ($tyre_type == $row->id)
                                                <option value="{{ $row->id }}" selected>{{ $row->name }}</option>
                                            @else
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        @foreach (tyreType() as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('type')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6 col-sm-12">
                                <label for="">Origin</label>
                                <div class="input-group">
                                    <select name="origin" id="origin" class="form-select">
                                        <option value="">---SELECT---</option>
                                        @if ($id != '')
                                            @foreach ($origin_dataset as $row)
                                                @if ($origin == $row->id)
                                                    <option value="{{ $row->id }}" selected>{{ $row->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            @foreach ($origin_dataset as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="input-group-append">
                                        <a data-bs-toggle="modal" data-bs-target="#originModal" class="btn btn-primary"><i
                                                class="mdi mdi-plus-circle"></i></a>
                                    </div>
                                </div>
                                @error('origin')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="">Manufacture Year</label>
                                <input type="text" name="myear" id="myear" class="form-control"
                                    value="{{ $myear }}">
                                @error('myear')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6 col-sm-12">
                                <label for="">Sku</label>
                                <input type="text" name="sku" id="sku" class="form-control"
                                    value="{{ $sku }}">
                                @error('sku')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="">Warranty Year</label>
                                <input type="text" name="wyear" id="wyear" class="form-control"
                                    value="{{ $wyear }}">
                                @error('wyear')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6 col-sm-12">
                                <label for="">Price</label>
                                <input type="text" name="price" id="price" class="form-control"
                                    value="{{ $price }}">
                                @error('price')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="">Set Price</label>
                                <input type="text" name="set_price" id="set_price" class="form-control"
                                    value="{{ $set_price }}">
                                @error('set_price')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <h5 class="card-title mt-2 text-uppercase">Car Model</h5>
                            <hr>
                            <div class="col-md-6 col-sm-12">
                                <label for="">Make</label>
                                <div class="input-group">
                                <select name="make" id="make" class="form-select">
                                    <option value="">---SELECT---</option>
                                    @if ($id != '')
                                        @foreach ($make_dataset as $row)
                                            @if ($make == $row->id)
                                                <option value="{{ $row->id }}" selected>{{ $row->name }}</option>
                                            @else
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        @foreach ($make_dataset as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="input-group-append">
                                    <a data-bs-toggle="modal" data-bs-target="#makeModal"
                                        class="btn btn-primary"><i class="mdi mdi-plus-circle"></i></a>
                                </div>
                                </div>
                                @error('make')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="">Model</label>
                                <div class="input-group">
                                    <select name="model" id="model" class="form-select">
                                        <option value="">---SELECT---</option>
                                        @if ($id != '')
                                            @foreach ($model_dataset as $row)
                                                @if ($model == $row->id)
                                                    <option value="{{ $row->id }}" selected>{{ $row->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="input-group-append">
                                        <a data-bs-toggle="modal" data-bs-target="#carmodelModal"
                                            class="btn btn-primary"><i class="mdi mdi-plus-circle"></i></a>
                                    </div>
                                </div>
                                @error('model')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6 col-sm-12">
                                <label for="">Year</label>
                                <div class="input-group">
                                    <select name="year" id="year" class="form-select">
                                        <option value="">---SELECT---</option>
                                        @if ($id != '')
                                            @foreach ($year_dataset as $row)
                                                @if ($year == $row->name)
                                                    <option value="{{ $row->name }}" selected>{{ $row->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $row->name }}">{{ $row->name }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="input-group-append">
                                        <a data-bs-toggle="modal" data-bs-target="#caryearModal"
                                            class="btn btn-primary"><i class="mdi mdi-plus-circle"></i></a>
                                    </div>
                                </div>
                                @error('year')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="">Fuel Type</label>
                                <select name="fuel_type" id="fuel_type" class="form-select">
                                    <option value="">---SELECT---</option>
                                    @if ($id != '')
                                        @foreach (carFuelType() as $row)
                                            @if ($fuel_type == $row->id)
                                                <option value="{{ $row->id }}" selected>{{ $row->name }}</option>
                                            @else
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        @foreach (carFuelType() as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6 col-sm-12">
                                <label for="">Engine Type</label>
                                <input type="text" name="engine_type" id="engine_type" class="form-control"
                                    value="{{ $engine_type }}">
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="">Speed/HP</label>
                                <input type="text" name="other" id="other" class="form-control"
                                    value="{{ $other }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6 col-sm-12">
                                <label for="">Tyre Size</label>
                                <select name="tyre_size" id="tyre_size" class="form-select">
                                    <option value="">---SELECT---</option>
                                    @if ($id != '')
                                        @foreach ($tyre_size_dataset as $row)
                                            @if ($tyre_size == $row->id)
                                                <option value="{{ $row->id }}" selected>
                                                    {{ $row->height . '/' . $row->width . ' R' . $row->rim_size . ' ' . $row->speed }}
                                                </option>
                                            @else
                                                <option value="{{ $row->id }}">
                                                    {{ $row->height . '/' . $row->width . ' R' . $row->rim_size . ' ' . $row->speed }}
                                                </option>
                                            @endif
                                        @endforeach
                                    @else
                                        @foreach ($tyre_size_dataset as $row)
                                            <option value="{{ $row->id }}">
                                                {{ $row->height . '/' . $row->width . ' R' . $row->rim_size . ' ' . $row->speed }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="" class="mb-3">Images</label>
                                <input type="file"name="file1" id="file1" file-accept='<?php echo json_encode(['jpg', 'png', 'gif', 'jpeg', 'svg']); ?>'
                                    data-fileuploader-files='<?php echo json_encode($preload); ?>'
                                    data-id="{{ url('admin/delete-image?path=products/tyre') }}"
                                    data-attr-name="image-file-saver"
                                    data-url="{{ url('admin/save-image?path=products/tyre') }}" class="form-control">
                                <input type="hidden" name="image" class="image-file-saver"
                                    value="<?php echo $image; ?>">
                                @error('image')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6 col-sm-12">
                                <label for="" class="mb-3">Website Visible</label>
                                <select name="visible_status" id="visible_status" class="form-select">
                                    <option value="">---SELECT----</option>
                                @if($visible_status != '')
                                    @foreach (website_visible() as $row )
                                    @if($visible_status == $row->id)                                        
                                        <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                    @else                                        
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endif
                                    @endforeach
                                @else
                                    @foreach (website_visible() as $row )
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach

                                @endif
                            </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="">Description</label>
                                <textarea id="summernote" name="description">{{ $description }}</textarea>
                                @error('description')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 text-center">
                                <input type="hidden" name="id" value="{{ $id }}">
                                @if ($id != '')
                                    <input type="hidden" name="car_data_id" value="{{ $tyre->cars }}">
                                @endif
                                <a href="{{ route($resourceUrl . '.index') }}" class="btn btn-primary">Close</a>
                                <button type="submit" class="btn btn-primary">
                                    @if ($id != '')
                                        Update
                                    @else
                                        Save
                                    @endif
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Make Modal Start -->
    <div class="modal fade" id="makeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Make</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form ajax-submit="true" id="addMake" action="{{ route('save-tyremake') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="">Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="" class="mb-3">Images</label>
                                <input type="file"name="file1" id="file1" file-accept='<?php echo json_encode(['jpg', 'png', 'gif', 'jpeg', 'svg']); ?>'
                                    data-fileuploader-files='<?php echo json_encode($preload); ?>'
                                    data-id="{{ url('admin/delete-image?path=manufacturers') }}"
                                    data-attr-name="image-file-saver" data-url="{{ url('admin/save-image?path=manufacturers') }}"
                                    class="form-control">
                                <input type="hidden" name="image" class="image-file-saver"
                                    value="<?php echo $image; ?>">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Make Modal End -->
    <!-- Brand Modal Start -->
    <div class="modal fade" id="brandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Brand</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form ajax-submit="true" id="addBrand" action="{{ route('save-tyre-brand') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="">Name</label>
                                <input type="text" name="brandname" id="brandname" class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="" class="mb-3">Images</label>
                                <input type="file"name="file1" id="file1" file-accept='<?php echo json_encode(['jpg', 'png', 'gif', 'jpeg', 'svg']); ?>'
                                    data-fileuploader-files='<?php echo json_encode($preload); ?>'
                                    data-id="{{ url('admin/delete-image?path=brand') }}"
                                    data-attr-name="image-file-saver" data-url="{{ url('admin/save-image?path=brand') }}"
                                    class="form-control">
                                <input type="hidden" name="image" class="image-file-saver"
                                    value="<?php echo $image; ?>">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Brand Modal End -->
    <!-- Brand Pattern Start -->
    <div class="modal fade" id="patternModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pattern</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form ajax-submit="true" id="addPattern" action="{{ route('save-tyre-pattern') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="">Name</label>
                                <input type="text" name="pattern" id="pattern" class="form-control">
                            </div>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Brand Pattern End -->
    <!-- Brand Origin Start -->
    <div class="modal fade" id="originModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Origin</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form ajax-submit="true" id="addOrigin" action="{{ route('save-tyre-origin') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="">Name</label>
                                <input type="text" name="origin" id="origin" class="form-control">
                            </div>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Brand Origin End -->
    <!-- Brand Car Year Start -->
    <div class="modal fade" id="caryearModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Car Year</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form ajax-submit="true" id="addCaryear" action="{{ route('save-car-year') }}" method="post">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="make" id="hiddenMake" value="">
                            <input type="hidden" name="model" id="hiddenModel" value="">
                            <div class="col-12">
                                <label for="">Year</label>
                                <input type="text" name="year" id="year" class="form-control">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Brand Car Year End -->
    <!-- Brand Car model Start -->
    <div class="modal fade" id="carmodelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Car Model</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form ajax-submit="true" id="addCarmodel" action="{{ route('save-car-model') }}" method="post">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="make" id="modelMake" value="">
                            <div class="col-12">
                                <label for="">Model</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Brand Car Model End -->
@endsection
@section('add-js')
    <script>
        $(function() {
            $('[data-bs-target="#carmodelModal"]').on('click', function() {
                $('#modelMake').val($('#make').val());
            });
            $('[data-bs-target="#caryearModal"]').on('click', function() {
                $('#hiddenMake').val($('#make').val());
                $('#hiddenModel').val($('#model').val());
            });
            $(document).ready(function() {
                $('#summernote').summernote();
            });
            $('form[ajax-submit=true]').submit(function(e) {
                var mySlection, modal, formid;
                e.preventDefault();
                formid = e.currentTarget.id;
                if (formid === 'addBrand') {
                    mySlection = $('#brand');
                    modal = $('#brandModal');
                } else if (formid == 'addPattern') {
                    mySlection = $('#pattern');
                    modal = $('#patternModal');
                } else if (formid == 'addOrigin') {
                    mySlection = $('#origin');
                    modal = $('#originModal');
                } else if (formid == 'addCarmodel') {
                    mySlection = $('#model');
                    modal = $('#carmodelModal');
                } else if (formid == 'addCaryear') {
                    mySlection = $('#year');
                    modal = $('#caryearModal');
                }else if(formid == 'addMake'){
                    mySlection = $('#make');
                    modal = $('#makeModal');
                }
                $.ajax({
                    url: e.currentTarget.action,
                    type: "POST",
                    data: $('#' + e.currentTarget.id).serialize(),
                    success: function(response) {
                        mySlection.empty();
                        mySlection.append(new Option('---SELECT---', ''));
                        response.forEach(element => {
                            mySlection.append(new Option(element.name, element.id));
                        });
                        modal.modal('toggle');
                    },
                    error: function(error) {
                        var errors = error.responseJSON;
                        $('#ErrorMsg').remove()
                        ErrorHtml = '<div id="ErrorMsg" class="alert alert-danger"><ul>';
                        $.each(errors.errors, function(k, v) {
                            ErrorHtml += '<li>' + v + '</li>';
                        });
                        ErrorHtml += '</ul></di>';
                        $('#' + formid).append(ErrorHtml);
                    }
                });
            })
        });
        $('#tyre_size').select2();
    </script>
@endsection
