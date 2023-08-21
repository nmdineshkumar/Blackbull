@php
    $rim_size = old('rimsize');
    $height_data = old('height');
    $width_data = old('width');
    $speed = old('speed');
    $description = old('description');
    if($id != '')
    {
        $rim_size = (old('rimsize') != '') ? $rimsize : $tyre_size->rim_size;
        $height_data = (old('height') != '') ? $height_data : $tyre_size->height;
        $width_data = (old('width') != '') ? $width_data : $tyre_size->width;
        $speed = (old('speed') != '') ? $speed : $tyre_size->speed;
        $description = (old('description') != '') ? $description : $tyre_size->description;
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
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tyre Size</a></li>
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
                            <label for="" class="mb-3">Height</label>
                            <div class="input-group mb-3">
                                <select name="height" id="height" class="form-select">
                                    <option value="">---SELECT---</option>
                                    @if($id != '')
                                    @foreach ($height as $row)
                                        @if ($height_data == $row->height)
                                            <option value="{{$row->height}}" selected>{{$row->height}}</option>
                                            @else
                                            <option value="{{$row->height}}">{{$row->height}}</option>
                                        @endif
                                    @endforeach
                                    @else
                                        @foreach ($height as $row)
                                            <option value="{{$row->height}}">{{$row->height}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="input-group-append">
                                    <button data-bs-toggle="modal" data-bs-target="#heightModal" type="button" class="btn btn-primary"><i class="mdi mdi-plus-circle-outline"></i></button>
                                </div>
                            </div>
                            @error('height')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="" class="mb-3">Profile</label>
                            <div class="input-group mb-3">
                                <select name="width" id="width" class="form-select">
                                    <option value="">---SELECT---</option>
                                    @if($id != '')
                                    @foreach ($width as $row)
                                        @if ($width_data == $row->profile)
                                            <option value="{{$row->profile}}" selected>{{$row->profile}}</option>
                                            @else
                                            <option value="{{$row->profile}}">{{$row->profile}}</option>
                                        @endif
                                    @endforeach
                                    @else
                                        @foreach ($width as $row)
                                            <option value="{{$row->profile}}">{{$row->profile}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="input-group-append">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#profileModal"  class="btn btn-primary"><i class="mdi mdi-plus-circle-outline"></i></button>
                                </div>
                            </div>
                            @error('width')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 col-sm-12">
                            <label for="" class="mb-3">Rim Size</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend"><span class="input-group-text">R</span></div>
                                <select name="rimsize" id="rimsize" class="form-select">
                                    <option value="">---SELECT---</option>
                                    @if($id != '')
                                    @foreach ($rimsize as $row)
                                        @if ($rim_size == $row->rimsize)
                                            <option value="{{$row->rimsize}}" selected>{{$row->rimsize}}</option>
                                            @else
                                            <option value="{{$row->rimsize}}">{{$row->rimsize}}</option>
                                        @endif
                                    @endforeach
                                    @else
                                        @foreach ($rimsize as $row)
                                            <option value="{{$row->rimsize}}">{{$row->rimsize}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="input-group-append">
                                    <a data-bs-toggle="modal" data-bs-target="#rimsizeModal" class="btn btn-primary"><i class="mdi mdi-plus-circle-outline"></i></a>
                                </div>
                            </div>
                            @error('rimsize')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="" class="mb-3">
                                <label for="" class="mb-3">Load / Speed</label>
                                <input type="text" name="speed" id="speed" class="form-control" value="{{$speed}}">
                            </label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 col-sm-12">
                            <label for="" class="mb-3">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{$description}}</textarea>
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
<!-- Add Height Modal -->
<div class="modal fade" id="heightModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Tyre Height</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="frmHeight" action="" method="post">
            @csrf
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col-12">
                <label for="" class="mb-3">Height</label>
                <input type="text" name="height" id="add_height" class="form-control">
                <div class="error" id="height_Error"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" data-btn="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
</div>

<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Tyre Profile</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="frmProfile" action="" method="post">
            @csrf
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col-12">
                <label for="" class="mb-3">Profile</label>
                <input type="text" name="profile" id="add_profile" class="form-control">
                <div class="error" id="profile_Error"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" data-btn="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
</div>
<div class="modal fade" id="rimsizeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Tyre Profile</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="frmRimsize" action="" method="post">
            @csrf
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col-12">
                <label for="" class="mb-3">Rim Size</label>
                <input type="text" name="rimsize" id="add_rimsize" class="form-control">
                <div class="error" id="rimsize_Error"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" data-btn="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
</div>
@endsection
@section('add-js')
<script>
    $(function(){
        $('#frmHeight').on('submit',function(e){
            e.preventDefault();
            var myHeight = $('#height');            
            $.ajax({
                url: "{{route('save-tyreheight')}}",
                type: "POST",
                data: $('#frmHeight').serialize(),
                dataType: 'json',
                success: function( response ) { 
                    myHeight.empty();
                    myHeight.append(new Option("---SELECT---",""));
                    response.forEach(element => {
                        myHeight.append(new Option(element.height,element.height));
                    });
                    $('#heightModal').modal('toggle');
                },
                error: function(error) {
                    var errors = error.responseJSON;                    
                    $('#ErrorMsg').remove()       
                        ErrorHtml = '<div id="ErrorMsg" class="alert alert-danger"><ul>';
                        $.each(errors.errors,function (k,v) {
                            ErrorHtml += '<li>'+ v + '</li>';
                        });
                        ErrorHtml += '</ul></di>';
                        $('#height_Error').append(ErrorHtml);            
                }
            });
        })
        $('#frmProfile').on('submit',function(e){
            e.preventDefault();
            var myWidth = $('#width');
            $.ajax({
                url: "{{route('save-tyreprofile')}}",
                type: "POST",
                data: $('#frmProfile').serialize(),
                success: function( response ) {
                    myWidth.empty();
                    myWidth.append(new Option('---SELECT---',''));
                    response.forEach(element => {
                        myWidth.append(new Option(element.profile,element.profile));
                    });
                    $('#profileModal').modal('toggle');
                },
                error: function(error) {
                    var errors = error.responseJSON;                    
                        $('#ErrorMsg').remove()       
                        ErrorHtml = '<div id="ErrorMsg" class="alert alert-danger"><ul>';
                        $.each(errors.errors,function (k,v) {
                            ErrorHtml += '<li>'+ v + '</li>';
                        });
                        ErrorHtml += '</ul></di>';
                        $('#profile_Error').append(ErrorHtml);             
                }
            });
        })
        $('#frmRimsize').on('submit',function(e){
            e.preventDefault();
            var myRimsize = $('#rimsize');
            $.ajax({
                url: "{{route('save-tyrerimsize')}}",
                type: "POST",
                data: $('#frmRimsize').serialize(),
                success: function( response ) {
                    myRimsize.empty();
                    myRimsize.append(new Option('---SELECT---',''));
                    response.forEach(element => {
                        myRimsize.append(new Option(element.rimsize,element.rimsize));
                    });
                    $('#rimsizeModal').modal('toggle');
                },
                error: function(error) {
                    var errors = error.responseJSON;
                        $('#ErrorMsg').remove()       
                        ErrorHtml = '<div id="ErrorMsg" class="alert alert-danger"><ul>';
                        $.each(errors.errors,function (k,v) {
                            ErrorHtml += '<li>'+ v + '</li>';
                        });
                        ErrorHtml += '</ul></di>';
                        $('#frmRimsize').append(ErrorHtml);              
                }
            });
        })
       
    })
</script>
@endsection