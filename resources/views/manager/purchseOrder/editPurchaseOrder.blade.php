@php
    $preload = [];
    $image = old('image');
    $branch = old('branch');
    $supplier = old('supplier');
    $purchasetype = old('purchasetype');
    $invoiceno = old('invoiceno');
    $invoicedata = old('invoicedata');
    $SubTotalAmount = (old('SubTotalAmount') == '') ? '0.00' : old('SubTotalAmount');
    $tax = old('tax');
    $TotalAmount = (old('TotalAmount') == '') ? '0.00' : old('SubTotalAmount');
    $product = old('product');
    $category = old('category');
    $qty = old('qty');
    $price = old('price');
    $total = old('total') == "" ? "0.00" : old('total');
    if ($id != '') {
        # assign the Edit purchase orider information
        $branch = (old('branch') != '') ? $branch : $purchase->branch;
        $supplier = (old('supplier') != '') ? $supplier : $purchase->supplier;
        $purchasetype = (old('purchasetype') != '') ? $purchasetype : $purchase->purchase_type;
        $invoiceno = (old('invoiceno') != '') ? $invoiceno : $purchase->invoice_no;
        $invoicedata = (old('invoicedata') != '') ? $invoicedata : $purchase->invoice_date;
        $tax = (old('tax') != '') ? $tax : $purchase->invoice_tax;
        $TotalAmount = (old('TotalAmount')!= '') ? $TotalAmount : $purchase->invoice_amount;
        //(Number($purchase->invoice_amount) – (Number($purchase->invoice_amount) * (100 / (100 + Number($purchase->invoice_tax)% ) ) ))
        $SubTotalAmount = (old('SubTotalAmount')!= '') ? $SubTotalAmount :  ($purchase->invoice_tax == '0' ? $purchase->invoice_amount : ($purchase->invoice_amount - ($purchase->invoice_amount * 100 /(100 + $purchase->invoice_tax )) ) ) ;
    }
@endphp
@extends('layout.employeeLayout')
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
                        <div class="col-md-4 col-sm-12">
                            <label for="">Branch</label>
                            <select name="branch" id="branch" class="form-select">
                                <option value="">---SELECT---</option>
                                @if ($id != '')
                                    @foreach ($branch_dataset as $row )
                                        @if($branch == $row->id)
                                        <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                        @else
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endif
                                    @endforeach
                                @else
                                @if ($branch != '')
                                @foreach ($branch_dataset as $row )
                                    @if($branch == $row->id)
                                    <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                    @else
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endif
                                @endforeach
                                @else
                                    @foreach ($branch_dataset as $row )
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                @endif
                                @endif
                            </select>
                            @error('branch')
                                    <div class="error">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 col-sm-12">
                            <label for="">Supplier</label>
                            <select name="supplier" id="supplier" class="form-select">
                                <option value="">---SELECT---</option>
                                @if ($id != '')
                                    @foreach ($supplier_dataset as $row )
                                        @if($supplier == $row->id)
                                        <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                        @else
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endif
                                    @endforeach
                                @else
                                @if ($branch != '')
                                @foreach ($supplier_dataset as $row )
                                    @if($supplier == $row->id)
                                    <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                    @else
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endif
                                @endforeach
                                @else
                                    @foreach ($supplier_dataset as $row )
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                @endif
                                @endif
                              
                            </select>
                            @error('supplier')
                                    <div class="error">{{$message}}</div>
                                @enderror
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="">Purchase Type</label>
                            <select name="purchasetype" id="purchasetype" class="form-select">
                                    <option value="">---SELECT---</option>
                                    @if ($id != '')
                                    @foreach (purchase_type() as $row )
                                        @if($purchasetype == $row->id)
                                        <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                        @else
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endif
                                    @endforeach
                                @else
                                @if ($branch != '')
                                @foreach (purchase_type() as $row )
                                    @if($purchasetype == $row->id)
                                    <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                    @else
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endif
                                @endforeach
                                @else
                                    @foreach (purchase_type() as $row )
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                @endif
                                @endif
                               
                            </select>
                            @error('purchasetype')
                                    <div class="error">{{$message}}</div>
                                @enderror
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="">Invoice Number</label>
                            <input type="text" name="invoiceno" id="invoiceno" class="form-control" value="{{$invoiceno}}">
                            @error('invoiceno')
                                    <div class="error">{{$message}}</div>
                                @enderror
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="">Invoice Date</label>
                            <input type="text" name="invoicedata" id="invoicedate" class="form-control" value="{{$invoicedata}}">
                            @error('invoicedata')
                                    <div class="error">{{$message}}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                       
                        <div class="col-md-8 col-sm-12">
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
                         <div class="col-md-4 col-sm-12">
                            <div class="row mb-2">
                                <div class="col-md-6 col-sm-12 text-end">
                                    <label for="">Sub Total Amount</label>                                
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <input type="text" name="SubTotalAmount" id="SubTotalAmount" class="form-control" value="{{ $SubTotalAmount }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6 col-sm-12 text-end">
                                    <label for="">Tax</label>                                
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <input type="text" name="tax" id="tax" placeholder="Tax" class="form-control" value="{{ $tax }}">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6 col-sm-12 text-end">
                                    <label for="">Total Amount</label>                                
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <input type="text" name="TotalAmount" id="TotalAmount" class="form-control" value="{{ $TotalAmount }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                    <th>Category</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th width="30">Action</th>
                                </thead>
                                <tbody>
                            @if($id == '')
                                @if($product != '')
                                        @foreach ($category as $category_index => $categoryrow)
                                            <tr>
                                                <td width="200">
                                                    <select name="category[]" id="category" class="form-select category"
                                                        required>
                                                        <option value="">---SELECT---</option>
                                                        @foreach ($category_dataset as $index => $row)
                                                            @if($categoryrow == $row->id)
                                                            <option value="{{ $row->id }}" selected>{{ $row->name }}</option>
                                                            @else
                                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                {{-- Get Product by category --}}
                                                @php
                                                    $dropdown_dataset = App\Http\Controllers\HelperController::get_Product($categoryrow);
                                                @endphp
                                                <td>
                                                    <select name="product[]" id="product" class="form-select product"
                                                        data-live-search="true" required>
                                                        <option value="">---SELECT---</option>
                                                        @foreach ($dropdown_dataset as $productrow)
                                                            @if($product[$category_index] == $productrow->id)
                                                            <option value="{{ $productrow->id }}" selected>{{ $productrow->name }}</option>
                                                            @else
                                                            <option value="{{ $productrow->id }}">{{ $productrow->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td width="120">
                                                    <input min="0" type="number" name="qty[]" id="qty"
                                                        class="form-control" placeholder="Quantity" required value="{{ $qty[$category_index] }}">
                                                </td>
                                                <td width="120"><input type="text" name="price[]" id="price"
                                                        class="form-control" placeholder="Price" required value="{{ $price[$category_index] }}"></td>
                                                <td width="120"><input type="text" name="total[]" id="total"
                                                        class="form-control" placeholder="Total" required readonly value="{{ $total[$category_index] }}"></td>
                                                <td>
                                                    <a class="btn-reomve btn btn-icon text-red"><span
                                                            class="mdi mdi-close-circle"></span></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                @else
                                    <tr>    
                                        <td width="200">
                                            <select name="category[]" id="category" class="form-select category" required>
                                                <option value="">---SELECT---</option>
                                                @foreach ($category_dataset as $row)
                                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="product[]" id="product" class="form-select product" required>
                                                <option value="">---SELECT---</option>
                                            </select>
                                        </td>
                                        <td width="120">
                                            <input min="0" type="number" name="qty[]" id="qty" class="form-control" placeholder="Quantity" required>
                                        </td>
                                        <td width="120"><input type="text" name="price[]" id="price" class="form-control" placeholder="Price" required></td>
                                        <td width="120"><input type="text" name="total[]" id="total" class="form-control" placeholder="Total" required></td>
                                        <td>
                                            <a class="btn-reomve btn btn-icon"><span class="mdi mdi-close-circle"></span></a>
                                        </td>
                                    </tr>
                                    @endif
                                @elseif ($id != "")
                                @foreach ($purchase_items as $Tablerow)
                                <tr>    
                                    <td width="200">
                                        <select name="category[]" id="category" class="form-select category" required>
                                            <option value="">---SELECT---</option>
                                            @foreach ($category_dataset as $row)
                                                @if($Tablerow->category_id == $row->id)
                                                <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                                @else
                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        @php
                                        $dropdown_dataset = App\Http\Controllers\HelperController::get_Product($Tablerow->category_id);
                                        @endphp
                                        <select name="product[]" id="product" class="form-select product" required>
                                            @foreach ($dropdown_dataset as $row)
                                            @if($Tablerow->product_id == $row->id)
                                            <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                            @else
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td width="120">
                                        <input min="0" type="number" name="qty[]" id="qty" class="form-control" placeholder="Quantity" value="{{ $Tablerow->quantity }}" required>
                                    </td>
                                    <td width="120"><input type="text" name="price[]" id="price" class="form-control" placeholder="Price" required value="{{ $Tablerow->amount }}"></td>
                                    <td width="120"><input type="text" name="total[]" id="total" class="form-control" placeholder="Total" required value="{{ $Tablerow->total_amount }}"></td>
                                    <td>
                                        <a class="btn-reomve btn btn-icon"><span class="mdi mdi-close-circle"></span></a>
                                    </td>
                                </tr>
                                @endforeach                               
                                @endif
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 text-center">                            
                            <a href="{{route($resourceUrl.'.index')}}" class="btn btn-primary">Close</a>
                            <button type="submit" class="btn btn-primary">@if($id != '') Update @else Save @endif </button>
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
        $('#product').on('change', function(){
            var table = $('#itemTable tbody tr');
            var category = $(this)[0].parentNode.parentNode.children[0].children[0].value;
            var rowIndex = $(this)[0].parentNode.parentNode.rowIndex;
            var product = $(this).val()
            for (let index = 0; index < table.length; index++) {
                if(category == table[index].children[0].children[0].value && product == table[index].children[1].children[0].value && rowIndex != index+1) {
                alert('This product has already been selected');
                $(this).val('')
                return false;
            }
        }
        });
        $('#invoicedate').flatpickr();
        $('#addItem').on('click', function(e) {
            var category, product,qty, price,displayPrice,table;
            table= $("#itemTable");
            var newRow = table.find("tr:last").clone(true).find(':input',':select').val('').end();
            var row = $('#itemTable >tbody >tr');
            newRow[0].children[2].children[0].value = "0"
            newRow[0].children[3].children[0].value = "0.00"
            newRow[0].children[4].children[0].value = "0.00"
            $("#itemTable").find('tr:last').after(newRow);
            console.log(newRow);
        });
        $('#tax').on('change paste keyup', function(){
            addTotalAmount()
        })
        $('[id=price]').on('change paste keyup', function(){
            var qty = $(this)[0].parentNode.parentNode.children[2].children[0].value;
            var price = $(this).val() * qty;
            addTotalAmount();
            $(this)[0].parentNode.parentNode.children[4].children[0].value = Number(price).toFixed(2);
        })
        $('[id=qty]').on('change paste keyup', function(){
            var amount = $(this)[0].parentNode.parentNode.children[3].children[0].value;
            var price = $(this).val() * amount;
            addTotalAmount();
            $(this)[0].parentNode.parentNode.children[4].children[0].value = Number(price).toFixed(2);;
        })
        function addTotalAmount(){
            var amountArray = document.querySelectorAll('input[id=total]');
            var SubTotalAmount = document.getElementById('SubTotalAmount');
            var TotalAmount = document.getElementById('TotalAmount');
            var Tax = document.getElementById('tax');
            var AddAmount = 0,TaxAmount = 0;
            for (let index = 0; index < amountArray.length; index++) {
                AddAmount = Number(AddAmount) + Number(amountArray[index].value);                
            }
            SubTotalAmount.value = Number(AddAmount).toFixed(2);
            if(Number(Tax.value) > 0){
                TaxAmount = AddAmount * Number(Tax.value) / 100;
            }
            TotalAmount.value = Number(AddAmount + TaxAmount).toFixed(2);
        }
        $('.btn-reomve').on('click', function(e){
            var row = e.currentTarget.parentNode.parentNode;
            if($('#itemTable >tbody >tr').length > 1) {
                $(e.currentTarget.parentNode.parentNode).remove();
                addTotalAmount();
            }else{
                alert('you unable to remove this item');
            }
        })
            
        $('.category').on('change', function(e){
            var id = $(this).val();
            var mySelection = $(e.currentTarget.parentNode.parentNode).find('select.product');
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