@extends('layout.mainLayout')
@section('page-breadcrumb')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{ $pageName }}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Product Sales</a></li>
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
                  
                    <div class="row mb-3">
                        <div class="col-md-4 col-sm-6">
                            <div class="row">
                                <div class="col-12 mb-2">To,</div>
                                <div class="col-12 mb-2">
                                    <input placeholder="Cutomer Name" type="text" name="customer_name" id="customer_name" class="form-control">
                                </div>
                                <div class="col-12 mb-2">
                                    <textarea placeholder="Cutomer Address" name="customer_address" id="customer_address" cols="30" rows="3" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6"></div>
                        <div class="col-md-4 col-sm-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Invoice No</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>Invoice Date</td>
                                        <td>{{\Carbon\Carbon::now()->format('d-m-Y')}}</td>
                                    </tr>
                                    <tr>
                                        <td>Invoice Amount</td>
                                        <td id="display_amount">0.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <table id="itemTable" class="table table-striped table-hover">
                                <thead>
                                    <th>Category</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
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
                                            <select name="product[]" id="product" class="form-select product" data-live-search="true" required>
                                                <option value="">---SELECT---</option>
                                            </select>
                                        </td>
                                        <td width="120">
                                            <input min="0" type="number" name="qty[]" id="qty" class="form-control" placeholder="Quantity" required>
                                        </td>
                                        <td width="120"><input type="text" name="price[]" id="price" class="form-control" placeholder="Price" required readonly></td>
                                        <td width="120"><input type="text" name="total[]" id="total" class="form-control" placeholder="Total" required readonly></td>
                                        <td>
                                            <a class="btn-reomve btn btn-icon text-red"><span class="mdi mdi-close-circle"></span></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 text-start">
                            <a id="addItem" class="btn bg-success text-white btn-sm"><i class="mdi mdi-plus-circle"></i> Add more</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-sm-6">
                            <label for="">Note:</label>
                            <textarea name="description" id="description" cols="30" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="col-md-4 col-sm-6 pt-3">
                            <div class="row mb-2">
                                <div class="col-md-6 col-sm-12 text-end">
                                    <label for="">Sub Total Amount</label>                                
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <input type="text" name="SubTotalAmount" id="SubTotalAmount" class="form-control" value="0.00" readonly>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6 col-sm-12 text-end">
                                    <label for="">Tax</label>                                
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <input type="text" name="tax" id="tax" placeholder="Tax" class="form-control" value="0">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6 col-sm-12 text-end">
                                    <label for="">Total Amount</label>                                
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <input type="text" name="TotalAmount" id="TotalAmount" class="form-control" value="0.00" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="row mb-3 ">
                    <input type="hidden" name="id" value="{{$id}}">
                    <div class="col-12 text-end">
                        <a href="{{route($resourceUrl.'.index')}}" class="btn btn-primary btn-sm">Close</a>
                        <button type="submit" class="btn btn-primary btn-sm"><span>@if ($id =='') Submit @else Update @endif</span></button>
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
            var selectedRow = $(this);
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
            var url = '../../get-product-price';
               $.ajax({
                type:'GET',
                url:url,
                data:{
                    'id': product,
                    'category': category
                },
                success: function(data){                      
                    selectedRow[0].parentNode.parentNode.children[3].children[0].value = data.price;
                    addTotalAmount();
                }
            });            
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
            $('#display_amount').html(Number(AddAmount + TaxAmount).toFixed(2));
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