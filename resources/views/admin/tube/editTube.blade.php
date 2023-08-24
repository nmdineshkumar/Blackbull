@php
    $preload = [];
    $image = old('image');
    $name = old('name');
    $brand = old('brand');
    $myear = old('myear');
    $volve = old('volve');
    $height = old('height');
    $rim_size = old('rim_size');
    $description = old('description');
    $sku = old('sku');
    $origin = old('origin');
    $price = old('price');
    $set_price = old('set_price');
    if($id != '')
    {
        $name = (old('name') != '') ? $name : $tube->name;
        $brand = (old('brand') != '') ? $brand : $tube->brand;
        $myear = (old('myear') != '') ? $myear : $tube->manufacure_year;
        $volve = (old('volve') != '') ? $volve : $tube->volve;
        $height = (old('height') != '') ? $height : $tube->height;
        $rim_size = (old('rim_size') != '') ? $rim_size : $tube->rim_size;
        $description = (old('description') != '') ? $description : $tube->description;
        $sku = (old('sku') != '') ? $sku : $tube->sku;
        $origin = (old('origin') != '') ? $origin : $tube->origin;
        $image = (old('image') != '') ? $image : $tube->image;
        $price = (old('price') != '') ? $price : $tube->price;
        $set_price = (old('set_price') != '') ? $set_price : $tube->set_price;
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
                        <div class="row mb-2">
                            <div class="col-md-6 col-sm-12">
                                <label for="">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $name }}">
                                @error('name')
                                <div class="error">{{$message}}</div>
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
                        <div class="row mb-2">
                            <div class="col-md-6 col-sm-12">
                                <label for="">Origin</label>
                                <div class="input-group">
                                    <select name="origin" id="origin" class="form-select">
                                        <option value="">---SELECT---</option>
                                        @if($id != '')
                                        @foreach ($origin_dataset as $row)
                                            @if($origin == $row->id)                                    
                                            <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                            @else
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                            @endif
                                        @endforeach
                                        @else
                                        @foreach ($origin_dataset as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <div class="input-group-append">
                                        <a data-bs-toggle="modal" data-bs-target="#originModal" class="btn btn-primary"><i class="mdi mdi-plus-circle"></i></a>
                                    </div>
                                </div>
                                @error('origin')
                                    <div class="error">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="">Manufacture Year</label>
                                <input type="text" name="myear" id="myear" class="form-control" value="{{$myear}}">
                                @error('myear')
                                    <div class="error">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6 col-sm-12">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="">Volve</label>
                                <div class="input-group">
                                    <select name="volve" id="volve" class="form-select">
                                        <option value="">---SELECT---</option>
                                        @if($id != '')
                                        @foreach ($volve_dataset as $row)
                                            @if($volve == $row->id)                                    
                                            <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                            @else
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                            @endif
                                        @endforeach
                                        @else
                                        @foreach ($volve_dataset as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <div class="input-group-append">
                                        <a data-bs-toggle="modal" data-bs-target="#volveModal" class="btn btn-primary"><i class="mdi mdi-plus-circle"></i></a>
                                    </div>
                                </div>
                                @error('volve')
                                    <div class="error">{{$message}}</div>
                                @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="">SKU</label>
                                        <input type="text" name="sku" id="sku" class="form-control" value="{{ $sku }}">
                                        @error('sku')
                                        <div class="error">{{$message}}</div>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Height</label>
                                        <div class="input-group">
                                            <select name="height" id="height" class="form-select">
                                                <option value="">---SELECT---</option>
                                                @if($id != '')
                                                @foreach ($tube_height as $row)
                                                    @if($height == $row->id)                                    
                                                    <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                                    @else
                                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                                    @endif
                                                @endforeach
                                                @else
                                                @foreach ($tube_height as $row)
                                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <div class="input-group-append">
                                                <a data-bs-toggle="modal" data-bs-target="#tubeheightModal" class="btn btn-primary"><i class="mdi mdi-plus-circle"></i></a>
                                            </div>
                                        </div>
                                        @error('height')
                                        <div class="error">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Rim Size</label>
                                        <div class="input-group">
                                            <select name="rim_size" id="rim_size" class="form-select">
                                                <option value="">---SELECT---</option>
                                                @if($id != '')
                                                @foreach ($tube_rim_size as $row)
                                                    @if($rim_size == $row->id)                                    
                                                    <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                                    @else
                                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                                    @endif
                                                @endforeach
                                                @else
                                                @foreach ($tube_rim_size as $row)
                                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <div class="input-group-append">
                                                <a data-bs-toggle="modal" data-bs-target="#tuberimsizeModal" class="btn btn-primary"><i class="mdi mdi-plus-circle"></i></a>
                                            </div>
                                        </div>
                                        @error('rim_size')
                                        <div class="error">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <label for="">Price</label>
                                <input type="text" name="price" id="price" class="form-control" value="{{ $price }}">
                                @error('price')
                                <div class="error">{{$message}}</div>
                            @enderror
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="">Set Price</label>
                                <input type="text" name="set_price" id="set_price" class="form-control" value="{{ $set_price }}">
                                @error('set_price')
                                <div class="error">{{$message}}</div>
                            @enderror
                            </div>
                        </div>
                        <div class="row">
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
<!-- Brand Origin Start -->
<div class="modal fade" id="originModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Origin</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form ajax-submit="true" id="addOrigin" action="{{route('save-tyre-origin')}}" method="post">
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
          <button  type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<!-- Brand Origin End -->
<!-- Brand volve Start -->
<div class="modal fade" id="volveModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Volve</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form ajax-submit="true" id="addVolve" action="{{route('save-tube-volve')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-12">
                    <label for="">Name</label>
                    <input type="text" name="volve" id="volve" class="form-control">
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
<!-- Brand volve End -->
<!-- Brand Tube Height Start -->
<div class="modal fade" id="tubeheightModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tube Height</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form ajax-submit="true" id="addTubeheight" action="{{route('save-tube-height')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-12">
                    <label for="">Name</label>
                    <input type="text" name="height" id="height" class="form-control">
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
<!-- Brand Tube Height End -->
<!-- Brand Tube rim size Start -->
<div class="modal fade" id="tuberimsizeModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Rim Size</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form ajax-submit="true" id="addTuberimsize" action="{{route('save-tube-rim-size')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-12">
                    <label for="">Name</label>
                    <input type="text" name="rim_size" id="rim_size" class="form-control">
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
<!-- Brand Tube rim size End -->
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
            }else if(formid == 'addVolve'){
                mySlection = $('#volve');
                modal = $('#volveModal');
            }else if(formid == 'addOrigin'){
                mySlection = $('#origin');
                modal = $('#originModal');
            }else if(formid == 'addTubeheight'){
                mySlection = $('#height');
                modal = $('#tubeheightModal');
            }else if(formid == 'addTuberimsize'){
                mySlection = $('#rim_size');
                modal = $('#tuberimsizeModal');
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