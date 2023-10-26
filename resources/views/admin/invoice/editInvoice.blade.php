@extends('layout.mainLayout')
@php
    $product = old('product');
    $category = old('category');
    $qty = old('qty');
    $price = old('price');
    $total = old('total') == "" ? "0.00" : old('total');
    $SubTotalAmount = old('SubTotalAmount') == "" ? "0.00" : old('SubTotalAmount');
    $TotalAmount = old('TotalAmount') == "" ? "0.00" : old('TotalAmount');
    $paidAmount = old('paidAmount');
    $description = old('description');
    $tax = old('tax') == "" ? "0" : old('tax');
    $branch = old('branch');
    $customer_data = old('customer');
    if($id != ''){
          
    }
    $category_dataset = App\Http\Controllers\Admin\SaleController::getCategory();
    $tyre_dataset = App\Http\Controllers\Admin\SaleController::getTyres();
    $tube_dataset = App\Http\Controllers\Admin\SaleController::getTubes();
    $battery_dataset = App\Http\Controllers\Admin\SaleController::getBattery();

    $coutries = App\Http\Controllers\HelperController::getCountry();
@endphp
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
                            <h4 class="card-title mt-2 text-uppercase">{{ $pageName }}</h4>
                        </div>
                        <div class="col-6 text-end">
                            <a class="btn btn-primary" href="{{ route($resourceUrl . '.index') }}"><i
                                    class="mdi mdi-arrow-left-circle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route($resourceUrl . '.store') }}" method="post">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-4 col-sm-6">
                                <div class="row">
                                    <div class="col-12 mb-2">To,</div>
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <select name="customer" id="customer" class="selectpicker form-select"
                                                data-live-search="true">
                                                <option value="">---SELECT---</option>
                                                @foreach ($customer as $row)
                                                    <option value="{{ $row->id }}">
                                                        {{ $row->first_name . ' ' . $row->last_name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-append">
                                                <a class="btn btn-primary" href="#" id="addCustomer"
                                                    data-bs-toggle="modal" data-bs-target="#customerModal"><i
                                                        class="mdi mdi-plus-circle"></i></a>
                                            </div>
                                        </div>
                                        @error('customer')
                                        <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="px-3" id="customer_address">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label for="">Branch</label>
                                <select name="branch" id="branch" class="form-select">
                                    <option value="">---SELECT---</option>
                                    @foreach ($branch_dataset as $row )
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                                @error('branch')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Invoice No</td>
                                            <td>{{$invoiceno}}</td>
                                        </tr>
                                        <tr>
                                            <td>Invoice Date</td>
                                            <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Invoice Amount</td>
                                            <td id="display_amount">{{ ($TotalAmount == "" ? "0.00" :  $TotalAmount ) }}</td>
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
                                        <th width="80">Quantity</th>
                                        <th width="80">Price</th>
                                        <th width="80">Total</th>
                                        <th width="40">Action</th>
                                    </thead>
                                    <tbody>
                                        @if($product == '')
                                        <tr>
                                            <td width="200">
                                                <select name="category[]" id="category" class="form-select category"
                                                    required>
                                                    <option value="">---SELECT---</option>
                                                    @foreach ($category_dataset as $row)
                                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select name="product[]" id="product" class="form-select product"
                                                    data-live-search="true" required>
                                                    <option value="">---SELECT---</option>
                                                </select>
                                            </td>
                                            <td width="120">
                                                <input min="0" type="number" name="qty[]" id="qty"
                                                    class="form-control" placeholder="Quantity" required>
                                            </td>
                                            <td width="120"><input type="text" name="price[]" id="price"
                                                    class="form-control" placeholder="Price" required readonly></td>
                                            <td width="120"><input type="text" name="total[]" id="total"
                                                    class="form-control" placeholder="Total" required readonly></td>
                                            <td>
                                                <a class="btn-reomve btn btn-icon text-red"><span
                                                        class="mdi mdi-close-circle"></span></a>
                                            </td>
                                        </tr>
                                        @elseif(sizeof($product) > 0)
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
                                                        class="form-control" placeholder="Price" required readonly value="{{ $price[$category_index] }}"></td>
                                                <td width="120"><input type="text" name="total[]" id="total"
                                                        class="form-control" placeholder="Total" required readonly value="{{ $total[$category_index] }}"></td>
                                                <td>
                                                    <a class="btn-reomve btn btn-icon text-red"><span
                                                            class="mdi mdi-close-circle"></span></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-12 text-start">
                                <a id="addItem" class="btn bg-success text-white btn-sm"><i
                                        class="mdi mdi-plus-circle"></i> Add more</a>
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
                                        <input type="text" name="SubTotalAmount" id="SubTotalAmount"
                                            class="form-control" readonly value="{{ $SubTotalAmount }}">
                                            @error('SubTotalAmount')
                                            <div class="error">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6 col-sm-12 text-end">
                                        <label for="">Tax</label>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <input type="text" name="tax" id="tax" placeholder="Tax"
                                            class="form-control"  value="{{ $tax }}">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <input type="text" name="tax_amount" id="tax_amount" placeholder="Tax"
                                            class="form-control"  value="">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6 col-sm-12 text-end">
                                        <label for="">Total Amount</label>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <input type="text" name="TotalAmount" id="TotalAmount" class="form-control"
                                           readonly value="{{ $TotalAmount }}">
                                           @error('TotalAmount')
                                            <div class="error">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6 col-sm-12 text-end">
                                        <label for="">Paid Amount</label>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <input type="text" name="paidAmount" id="paidAmount" class="form-control"
                                            value="0.00" required>
                                            @error('paidAmount')
                                            <div class="error">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 ">
                            <input type="hidden" name="type" id="type" value="2">
                            <input type="hidden" name="id" value="{{ $id }}">
                            <div class="col-12 text-end">
                                <a href="{{ route($resourceUrl . '.index') }}" class="btn btn-primary btn-sm">Close</a>
                                <button type="submit" class="btn btn-primary btn-sm"><span>
                                        @if ($id == '')
                                            Submit
                                        @else
                                            Update
                                        @endif
                                    </span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Brand Modal Start -->
    <div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Customer</h5>
                    <button type="button" class="close btn-icon btn" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form ajax-submit="true" id="addcustomer" action="{{ route('admin.customer.store') }}"
                        method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label for="">First Name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control">
                            </div>
                            <div class="col-6 mb-2">
                                <label for="">Last Name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control">
                            </div>
                            <div class="col-6 mb-2">
                                <label for="">Address 1</label>
                                <input type="text" name="address1" id="address1" class="form-control">
                            </div>
                            <div class="col-6 mb-2">
                                <label for="">Address 2</label>
                                <input type="text" name="address2" id="address2" class="form-control">
                            </div>
                            <div class="col-6 mb-2">
                                <label for="">Email</label>
                                <input type="text" name="email" id="email" class="form-control">
                            </div>
                            <div class="col-6 mb-2">
                                <label for="">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control">
                            </div>
                            <div class="col-6 mb-2">
                                <label for="">Country</label>
                                <select name="country" id="country" class="selectpicker form-select"
                                    data-live-search="true">
                                    <option value="">---SELECT---</option>
                                    @if ($id != '')
                                        @foreach ($coutries as $row)
                                            @if ($row->id == $country)
                                                <option value="{{ $row->id }}" selected>{{ $row->name }}</option>
                                            @else
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        @foreach ($coutries as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-6 mb-2">
                                <label for="">State</label>
                                <select name="state" id="state" class="selectpicker form-select"
                                    data-live-search="true">
                                    <option value="">---SELECT---</option>
                                </select>
                            </div>
                            <div class="col-6 mb-2">
                                <label for="">City</label>
                                <select name="city" id="city" class="selectpicker form-select"
                                    data-live-search="true">
                                    <option value="">---SELECT---</option>
                                </select>
                            </div>
                            <div class="col-6 mb-2">
                                <label for="">Zip</label>
                                <input type="text" name="zip" id="zip" class="form-control">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="type" value="2">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Brand Modal End -->
    <style>
        .btn.dropdown-toggle.bs-placeholder.btn-light,
        .btn.dropdown-toggle.btn-light {
            padding: 0px !important;
            background-color: transparent;
            border: 0px;
        }

        .dropdown.bootstrap-select.form-select {
            width: 100% !important;
        }

        .input-group .dropdown.bootstrap-select.form-select {
            width: auto !important;
        }
    </style>
@endsection
@section('add-js')
    <script>
        $(function() {
            $('form[ajax-submit=true]').submit(function(e) {
                e.preventDefault();
                var mySlection, modal, formid;
                e.preventDefault();
                formid = e.currentTarget.id;
                if (formid === 'addcustomer') {
                    mySlection = $('#customer');
                    modal = $('#customerModal');
                }
                $.ajax({
                    url: e.currentTarget.action,
                    type: "POST",
                    data: $('#' + e.currentTarget.id).serialize(),
                    success: function(response) {
                        mySlection.empty();
                        mySlection.append(new Option('---SELECT---', ''));
                        response.data.forEach(element => {
                            mySlection.append(new Option(element.name, element.id));
                        });
                        modal.modal('toggle');
                    },
                    error: function(error) {
                        var errors = error.responseJSON;
                        $.each(errors.errors, function(k, v) {
                            $('#Error' + k).remove();
                            $('#' + k).after('<div id="Error' + k + '" class="error">' +
                                v + '</div>');
                        });
                    }
                });
            })
            $('#product').on('change', function() {
                var selectedRow = $(this);
                var table = $('#itemTable tbody tr');
                var category = $(this)[0].parentNode.parentNode.children[0].children[0].value;
                var rowIndex = $(this)[0].parentNode.parentNode.rowIndex;
                var product = $(this).val()
                for (let index = 0; index < table.length; index++) {
                    if (category == table[index].children[0].children[0].value && product == table[index]
                        .children[1].children[0].value && rowIndex != index + 1) {
                        alert('This product has already been selected');
                        $(this).val('')
                        return false;
                    }
                    var url = '../../get-product-price';
                    $.ajax({
                        type: 'GET',
                        url: url,
                        data: {
                            'id': product,
                            'category': category
                        },
                        success: function(data) {
                            selectedRow[0].parentNode.parentNode.children[3].children[0].value =
                                data.price;
                            addTotalAmount();
                        }
                    });
                }
            });
            $('#invoicedate').flatpickr();
            $('#addItem').on('click', function(e) {
                var category, product, qty, price, displayPrice, table;
                table = $("#itemTable");
                var newRow = table.find("tr:last").clone(true).find(':input', ':select').val('').end();
                var row = $('#itemTable >tbody >tr');
                newRow[0].children[2].children[0].value = "0"
                newRow[0].children[3].children[0].value = "0.00"
                newRow[0].children[4].children[0].value = "0.00"
                $("#itemTable").find('tr:last').after(newRow);
            });
            $('#tax').on('change paste keyup', function() {
                addTotalAmount()
            })
            $('[id=price]').on('change paste keyup', function() {
                var qty = $(this)[0].parentNode.parentNode.children[2].children[0].value;
                var price = $(this).val() * qty;
                addTotalAmount();
                $(this)[0].parentNode.parentNode.children[4].children[0].value = Number(price).toFixed(2);
            })
            $('[id=qty]').on('change paste keyup', function() {
                var amount = $(this)[0].parentNode.parentNode.children[3].children[0].value;
                var price = $(this).val() * amount;
                addTotalAmount();
                $(this)[0].parentNode.parentNode.children[4].children[0].value = Number(price).toFixed(2);;
            })

            function addTotalAmount() {
                var amountArray = document.querySelectorAll('input[id=total]');
                var SubTotalAmount = document.getElementById('SubTotalAmount');
                var TotalAmount = document.getElementById('TotalAmount');
                var Tax_amount = document.getElementById('tax_amount');
                var Tax = document.getElementById('tax');
                var AddAmount = 0,
                    TaxAmount = 0;
                for (let index = 0; index < amountArray.length; index++) {
                    AddAmount = Number(AddAmount) + Number(amountArray[index].value);
                }
                SubTotalAmount.value = Number(AddAmount).toFixed(2);
                if (Number(Tax.value) > 0) {
                    TaxAmount = AddAmount * Number(Tax.value) / 100;
                    Tax_amount.value = Number(TaxAmount).toFixed(2);
                }
                TotalAmount.value = Number(AddAmount + TaxAmount).toFixed(2);
                $('#display_amount').html(Number(AddAmount + TaxAmount).toFixed(2));
            }
            $('.btn-reomve').on('click', function(e) {
                var row = e.currentTarget.parentNode.parentNode;
                if ($('#itemTable >tbody >tr').length > 1) {
                    $(e.currentTarget.parentNode.parentNode).remove();
                    addTotalAmount();
                } else {
                    alert('you unable to remove this item');
                }
            })

            $('.category').on('change', function(e) {
                var id = $(this).val();
                var mySelection = $(e.currentTarget.parentNode.parentNode).find('select.product');
                var url = '{{ route('get-products', ':id') }}';
                url = url.replace(':id', id);
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(data) {
                        mySelection.empty();
                        mySelection.append(new Option('---SELECT---', ''));
                        data.forEach(element => {
                            mySelection.append(new Option(element.name, element.id));
                        });
                    }
                })
            })
            $('#customer').on('change', function(e) {
                var id = $(this).val();
                var customer_address = $('#customer_address');
                if (id != '') {
                    var url = '{{ route('get-customer', ':id') }}';
                    url = url.replace(':id', id);
                    customer_address[0].innerHTML = "";
                    $.ajax({
                        type: 'GET',
                        url: url,
                        success: function(data) {
                            $.each(data[0], function(k, v) {
                                console.log(v);
                                if(v != '' || v != 'null' || v != 'undefined' || v != null) {
                                customer_address[0].innerHTML += '<lalel>'+ v + '</label><br/>';}
                            });
                        }
                    });
                }
            })
        })
    </script>
@endsection
