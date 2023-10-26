@php
    $name = old('name');
    $brand = old('brand');
    $preload = [];
    $image = old('image');
    $description = old('description');
    $capacity = old('capacity');
    $wyear = old('wyear');
    $voltage = old('voltage');
    $sku = old('sku');
    $model_number = old('model_number');
    $price = old('price');
    $visible_status = old('visible_status');

    if($id != ''){
        $name = (old('name') != '') ? $name : $battery->name;
        $brand = (old('brand') != '') ? $brand : $battery->brand;
        $image = (old('image') != '') ? $image : $battery->image;
        $description = (old('description') != '') ? $description : $battery->description;
        $capacity = (old('capacity') != '') ? $capacity : $battery->capacity;
        $wyear = (old('wyear') != '') ? $wyear : $battery->warranty_year;
        $voltage = (old('voltage') != '') ? $voltage : $battery->voltage;
        $sku = (old('sku') != '') ? $sku : $battery->sku;
        $model_number = (old('model_number') != '') ? $model_number : $battery->model_number;
        $price = (old('price') != '') ? $price : $battery->price;
        $visible_status = (old('visible_status') != '') ? $visible_status : $battery->status;
    }
    if ($image != "") {
    $path1 = "products/tube/" . $image;
    if (Storage::disk(getFileDisk())->exists($path1)) {
        $path = Storage::disk(getFileDisk())->url($path1);
        $mime = Storage::disk(getFileDisk())->mimeType($path1);
        $size = Storage::disk(getFileDisk())->size($path1);

        $inner = array(
            "url" => $path,
            "thumbnail" => $path,
            "readerForce" => true
        );
        $preload[] = array(
            "name" => $image,
            "type" => $mime,
            "size" => $size,
            "file" => $path,
            "local" => $path,
            "data" => array("url" => $path, "thumbnail" => $path, "readerForce" => true)
        );
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
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tube</a></li>
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
                            <label for="">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $name }}">
                            @error('name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="">Brand</label>
                                <div class="input-group">
                                    <select class="form-select" name="brand" id="brand">
                                        <option value="">---SELECT---</option>
                                        @if($id != '')
                                            @foreach ($brand_dataset as $row)
                                                @if ($brand == $row->id)
                                                    <option value="{{ $row->id }}" selected>{{ $row->name }}</option>
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
                                        <a data-bs-toggle="modal" data-bs-target="#brandModal" class="btn btn-primary"><i class="mdi mdi-plus-circle"></i></a>
                                    </div>
                                </div> 
                                @error('brand')
                                <div class="error">{{$message}}</div>
                            @enderror    
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 col-sm-12">
                            <label for="">Capacity</label>
                            <input type="text" name="capacity" id="capacity" class="form-control" value="{{ $capacity }}">
                            @error('capacity')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="">Warranty Year</label>
                            <input type="text" name="wyear" id="wyear" class="form-control" value="{{ $wyear }}">
                            @error('wyear')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 col-sm-12">
                            <label for="">Voltage</label>
                            <input type="text" name="voltage" id="voltage" class="form-control" value="{{ $voltage }}">
                            @error('voltage')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="">SKU</label>
                            <input type="text" name="sku" id="sku" class="form-control" value="{{ $sku }}">
                            @error('sku')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 col-sm-12">
                                <label for="" class="mb-3">Images</label>
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
                        <div class="col-md-6 col-sm-12">
                            <div class="row">
                                <div class="col-6">
                                    <label for="">Model Number</label>
                                    <input type="text" name="model_number" id="model_number" class="form-control" value="{{ $model_number }}">
                                    @error('model_number')
                                        <div class="error">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="">Price</label>
                                    <input type="text" name="price" id="price" class="form-control" value="{{ $price }}">
                                    @error('price')
                                        <div class="error">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 mt-3">
                                <label for="" class="mb-3">Website Visible</label>
                                <select name="visible_status" id="visible_status" class="form-select">
                                    <option value="">---SELECT----</option>
                                    @if ($visible_status != '')
                                        @foreach (website_visible() as $row)
                                            @if ($visible_status == $row->id)
                                                <option value="{{ $row->id }}" selected>{{ $row->name }}</option>
                                            @else
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        @foreach (website_visible() as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="">Description</label>
                            <textarea id="summernote" name="description">{{$description}}</textarea>
                            @error('description')
                            <div class="error">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 text-center">
                            <input type="hidden" name="id" value="{{$id}}">                               
                            <a href="{{route($resourceUrl.'.index')}}" class="btn btn-primary">Close</a>
                            <button type="submit" class="btn btn-primary">@if($id != '') Update @else Save @endif </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Brand Modal Start -->
<div class="modal fade" id="brandModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Brand</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form ajax-submit="true" id="addBrand" action="{{route('save-tyre-brand')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-12">
                    <label for="">Name</label>
                    <input type="text" name="brandname" id="brandname" class="form-control">
                </div>
                <div class="col-12">
                    <label for="" class="mb-3">Images</label>
                        <input type="file"name="file1" id="file1" 
                        file-accept='<?php echo json_encode(array('jpg', 'png', 'gif', 'jpeg', 'svg')) ?>'
                        data-fileuploader-files='<?php echo json_encode($preload) ?>'
                        data-id="{{url('admin/delete-image?path=brand')}}" 
                        data-attr-name="image-file-saver"
                        data-url="{{url('admin/save-image?path=brand')}}"
                        class="form-control">
                        <input type="hidden" name="image" class="image-file-saver" value="<?php echo $image; ?>">
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button  type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<!-- Brand Modal End -->
@endsection


@section('add-js')
<script>
    $(function(){
        $('form[ajax-submit=true]').submit(function(e){
            var mySlection,modal,formid;
            e.preventDefault();
            formid = e.currentTarget.id;
            if(formid === 'addBrand'){
                mySlection = $('#brand');
                modal = $('#brandModal');
            }
            $.ajax({
                url: e.currentTarget.action,
                type: "POST",
                data: $('#'+e.currentTarget.id).serialize(),
                success: function( response ) {
                    mySlection.empty();
                    mySlection.append(new Option('---SELECT---',''));
                    response.forEach(element => {
                        mySlection.append(new Option(element.name,element.id));
                    });
                    modal.modal('toggle');
                },
                error: function(error) {
                        var errors = error.responseJSON;
                        $('#ErrorMsg').remove()       
                        ErrorHtml = '<div id="ErrorMsg" class="alert alert-danger"><ul>';
                        $.each(errors.errors,function (k,v) {
                            ErrorHtml += '<li>'+ v + '</li>';
                        });
                        ErrorHtml += '</ul></di>';
                        $('#'+formid).append(ErrorHtml); 
                }
            });
            console.log(e);
        })
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    })
</script>
@endsection