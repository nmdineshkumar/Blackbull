@php
    $name = old('name');
    $preload = [];
$image = old('image');
$status = old('status');
if($id != ''){
    $name = (old('name') != '') ? $name : $manufacture->name;
    $image = (old('image') != "") ? $image : $manufacture->path;
    $status = (old('status') != '') ? $status : $manufacture->status;
}
if ($image != "") {
    $path1 = "manufacturers/" . $image;
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
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Manufacturer</a></li>
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
                <div class="row mb-2">
                    <div class="col-md-6 col-sm-12">
                        <h4 class="card-title mt-2 text-uppercase">{{$pageName}}</h4>
                    </div>
                    <div class="col-md-6 col-sm-12 text-end">
                        <a class="btn btn-primary" href="{{route($resourceUrl.'.index')}}"><i class="mdi mdi-arrow-left-circle"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route($resourceUrl.'.store')}}" method="post">
                    @csrf
                <div class="row  mb-3">
                    <div class="col-md-6 col-sm-12">
                        <label for="" class="mb-3">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$name}}">
                        @error('name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12"><label for=""></label></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 col-sm-12">
                        <label for="" class="mb-3">Status</label> <br/>
                        <select name="statues" id="statues" class="form-select">
                            <option value="">---SELECT---</option>
                            @if ($id != '')
                            @foreach (statusOptions() as $row)
                                @if($row->id == $status)
                                <option value="{{$row->id}}" selected>{{ $row->name }}</option>
                                @else
                                <option value="{{$row->id}}">{{ $row->name }}</option>
                                @endif                                
                            @endforeach
                            @else  
                                @foreach (statusOptions() as $row)
                                <option value="{{$row->id}}">{{ $row->name }}</option>                                
                                @endforeach
                            @endif
                            
                        </select>
                        @error('statues')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12"><label for=""></label></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 col-sm-12">
                        <label for="" class="mb-3">Images</label>
                        <input type="file"name="file1" id="file1" 
                        file-accept='<?php echo json_encode(array('jpg', 'png', 'gif', 'jpeg', 'svg')) ?>'
                        data-fileuploader-files='<?php echo json_encode($preload) ?>'
                        data-id="{{url('admin/delete-image?path=manufacturers')}}" 
                        data-attr-name="image-file-saver"
                        data-url="{{url('admin/save-image?path=manufacturers')}}"
                        class="form-control">
                        <input type="hidden" name="image" class="image-file-saver" value="<?php echo $image; ?>">
                        @error('image')
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
@section('add-js')

@endsection