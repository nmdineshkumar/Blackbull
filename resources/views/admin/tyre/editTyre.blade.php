@php
    $preload = [];
    $image =old('image');
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
                <div class="row mb-2">
                    <div class="col-md-6 col-sm-12">
                        <label for="">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                        @error('name')
                            <div class="error">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12">                        
                        <label for="">Brand</label>
                        <div class="input-group">
                            <select name="brand" id="brand" class="form-select">
                                <option value="">---SELECT---</option>
                                @foreach ($brand_dataset as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
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
                        <label for="">Pattern</label>
                        <div class="input-group">
                            <select name="pattern" id="pattern" class="form-select">
                                <option value="">---SELECT---</option>
                                @foreach ($pattern_dataset as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <a data-bs-toggle="modal" data-bs-target="#patternModal" class="btn btn-primary"><i class="mdi mdi-plus-circle"></i></a>
                            </div>
                        </div>
                        @error('pattern')
                            <div class="error">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="">Type</label>
                        <select name="type" id="type" class="form-select">
                            <option value="">---SELECT---</option>
                            @foreach (tyreType() as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>
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
                                @foreach ($origin_dataset as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
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
                        <input type="text" name="myear" id="myear" class="form-control">
                        @error('myear')
                            <div class="error">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6 col-sm-12">
                        <label for="">Sku</label>
                        <input type="text" name="sku" id="sku" class="form-control">
                        @error('sku')
                            <div class="error">{{$message}}</div>
                        @enderror                      
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="">Warranty Year</label>
                        <input type="text" name="wyear" id="wyear" class="form-control">
                        @error('brand')
                            <div class="error">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <h5 class="card-title mt-2 text-uppercase">Car Model</h5>
                    <hr>
                    <div class="col-md-6 col-sm-12">
                        <label for="">Make</label>
                        <select name="make" id="make" class="form-select">
                            <option value="">---SELECT---</option>
                                @foreach ($make_dataset as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach                            
                        </select>
                        @error('make')
                            <div class="error">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="">Model</label>
                        <div class="input-group">
                            <select name="model" id="model" class="form-select">
                                <option value="">---SELECT---</option>
                            </select>
                            <div class="input-group-append">
                                <a data-bs-toggle="modal" data-bs-target="#carmodelModal" class="btn btn-primary"><i class="mdi mdi-plus-circle"></i></a>
                            </div>
                        </div>                        
                        @error('model')
                            <div class="error">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6 col-sm-12">
                        <label for="">Year</label>
                        <div class="input-group">
                            <select name="year" id="year" class="form-select">
                                <option value="">---SELECT---</option>                                                           
                            </select>
                            <div class="input-group-append">
                                <a data-bs-toggle="modal" data-bs-target="#caryearModal" class="btn btn-primary"><i class="mdi mdi-plus-circle"></i></a>
                            </div>
                        </div>                        
                        @error('year')
                            <div class="error">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="">Fuel Type</label>
                        <select name="fuel_type" id="fuel_type" class="form-select">
                            <option value="">---SELECT---</option>   
                            @foreach (carFuelType() as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach                                                        
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6 col-sm-12">
                        <label for="">Engine Type</label>
                        <input type="text" name="engine_type" id="engine_type" class="form-control">                        
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="">Speed/HP</label>
                        <input type="text" name="other" id="other" class="form-control">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6 col-sm-12">
                        <label for="">Tyre Size</label>
                        <select name="tyre_size" id="tyre_size" class="form-select">
                            <option value="">---SELECT---</option>
                            @foreach ($tyre_size_dataset as $row)
                                <option value="{{$row->id}}">{{$row->height.'/'.$row->width.' R'.$row->rim_size.' '.$row->speed}}</option>                                
                            @endforeach
                        </select>                      
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Brand Modal Start -->
<div class="modal fade" id="brandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
<!-- Brand Pattern Start -->
<div class="modal fade" id="patternModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Pattern</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form ajax-submit="true" id="addPattern" action="{{route('save-tyre-pattern')}}" method="post">
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
          <button  type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<!-- Brand Pattern End -->
<!-- Brand Origin Start -->
<div class="modal fade" id="originModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
<!-- Brand Car Year Start -->
<div class="modal fade" id="caryearModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Car Year</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form ajax-submit="true" id="addCaryear" action="{{route('save-car-year')}}" method="post">
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
          <button  type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<!-- Brand Car Year End -->
<!-- Brand Car model Start -->
<div class="modal fade" id="carmodelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Car Model</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form ajax-submit="true" id="addCarmodel" action="{{route('save-car-model')}}" method="post">
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
          <button  type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<!-- Brand Car Model End -->
@endsection
@section('add-js')
<script>
    $(function(){
        $('[data-bs-target="#carmodelModal"]').on('click', function(){
            $('#modelMake').val($('#make').val());
        });
        $('[data-bs-target="#caryearModal"]').on('click', function(){
            $('#hiddenMake').val($('#make').val());
            $('#hiddenModel').val($('#model').val());
        });
        $('form[ajax-submit=true]').submit(function(e){
            var mySlection,modal,formid;
            e.preventDefault();
            formid = e.currentTarget.id;
            if(formid === 'addBrand'){
                mySlection = $('#brand');
                modal = $('#brandModal');
            }else if(formid == 'addPattern'){
                mySlection = $('#pattern');
                modal = $('#patternModal');
            }else if(formid == 'addOrigin'){
                mySlection = $('#origin');
                modal = $('#originModal');
            }else if(formid == 'addCarmodel'){
                mySlection = $('#model');
                modal = $('#carmodelModal');
            }else if(formid == 'addCaryear'){
                mySlection = $('#year');
                modal = $('#caryearModal');
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
                    $('#profile_Error').html(error.responseJSON.errors.height[0])                
                }
            });
            console.log(e);
        })
    });
</script>
@endsection