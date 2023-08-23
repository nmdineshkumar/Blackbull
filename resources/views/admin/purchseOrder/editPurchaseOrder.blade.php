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
                    
                    {{-- <div class="row mb-3">
                        <div class="col-sm-12 col-md-4">
                            <label for="">Category</label>
                            <select name="category[]" id="category" class="form-select">
                                <option value="">---SELECT---</option>
                                @foreach ($category_dataset as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
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
                                    <input type="text" name="qty" id="qty" class="form-control" placeholder="Quantity">
                                </div>
                                <div class="col-md-6 col-sm-12 align-text-bottom">
                                    <label for="">Price</label>
                                    <input type="text" name="price" id="price" class="form-control" placeholder="Price">
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        
                        <div class="col-md-8 col-sm-6 text-right">
                            <h5>Add Item</h5>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="d-flex flex-row-reverse bd-highlight">
                                <a id="addItem" class="btn btn-primary"><i class="mdi mdi-plus-circle"></i> Add</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <table id="itemTable" class="table">
                                <thead>
                                    <th width="20">SNo</th>
                                    <th>Category</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th width="30">Action</th>
                                </thead>
                                <tbody>
                                    <tr>                                        
                                        <td>0</td>
                                        <td width="200">
                                            <select name="category[]" id="category" class="form-select category">
                                                <option value="">---SELECT---</option>
                                                @foreach ($category_dataset as $row)
                                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="product" id="product" class="form-select product">
                                                <option value="">---SELECT---</option>
                                            </select>
                                        </td>
                                        <td width="120">
                                            <input type="number" name="qty[]" id="qty" class="form-control" placeholder="Quantity">
                                        </td>
                                        <td width="120"><input type="text" name="price[]" id="price" class="form-control" placeholder="Price"></td>
                                        <td>
                                            <a class="btn-reomve btn btn-icon"><span class="mdi mdi-close-circle"></span></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('add-js')
<script>
    $(function() {
        $('#addItem').on('click', function(e) {
            var category, product,qty, price,displayPrice,table;
            var newRow = $("#itemTable tr:last").clone(true).find(':input',':select').val('').end();
            var row = $('#itemTable >tbody >tr');
            $("#itemTable").append(newRow);
            for (let index = 0; index < row.length; index++) {
                $(row[index].children[2]).find('select').select2({});
                row[index].children[0].innerHTML = "";
                row[index].children[0].innerHTML = index + 1;                
            }
        });
        $('.btn-reomve').on('click', function(e){
            var row = e.currentTarget.parentNode.parentNode;
            if($('#itemTable >tbody >tr').length > 1) {
                $(e.currentTarget.parentNode.parentNode).remove();
            }else{
                alert('you unable to remove this item');
            }
        })
            
        $('.category').on('change', function(e){
            console.log(e.currentTarget.parentNode.parentNode)
            var id = $(this).val();
            var mySelection = $(e.currentTarget.parentNode.parentNode).find('select.product');
            console.log(mySelection)
            var url = '{{route('get-products',":id")}}';
            url = url.replace(':id',id);
            $.ajax({
                type:'GET',
                url:url,
                success: function(data){                    
                    mySelection.empty();
                    mySelection.append(new Option('---SELECT---',''));
                    data.forEach(element => {
                        mySelection.append(new Option(element.name,element.id));
                    });
                }
            })
        })
    })
</script>
@endsection