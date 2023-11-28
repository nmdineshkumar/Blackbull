@extends('layout.mainLayout')
@php
    $product = old('product');
    $category = old('category');
    $qty = old('qty');
    $price = old('price');
    $total = old('total') == '' ? '0.00' : old('total');
    $SubTotalAmount = old('SubTotalAmount') == '' ? '0.00' : old('SubTotalAmount');
    $TotalAmount = old('TotalAmount') == '' ? '0.00' : old('TotalAmount');
    $paidAmount = old('paidAmount');
    $description = old('description');
    $tax = old('tax') == '' ? '0' : old('tax');
    $branch = old('branch');
    $customer_data = old('customer');
    $item_description = old('item_description');
    $subTotal = old('subTotal');
    $discount = old('discount');
    $pay_mode = old('pay_mode');
    $taxAmount = old('$tax_amount');
    $DeliveryAmount = old('DeliveryAmount');
    $delivery_address = old('delivery_address');
    if ($id != '') {
        //print_r($invoice_items);
        $category = old('category') != null ? old('category') : array_column($invoice_items, 'category');
        $product = old('product') != null ? old('product') : array_column($invoice_items, 'product_id');
        $qty = old('qty') != null ? old('qty') : array_column($invoice_items, 'qty');
        $price = old('price') != null ? old('price') : array_column($invoice_items, 'price');
        $total = old('total') != null ? old('total') : array_column($invoice_items, 'total');
        $item_description = old('item_description') != null ? old('item_description') : array_column($invoice_items, 'description');
        $branch = old('branch') != null ? old('branch') : $sales->branch;
        $customer_data = old('customer_data') != null ? old('customer_data') : $sales->customer;
        $TotalAmount = old('TotalAmount') != null ? old('TotalAmount') : $sales->total;
        $tax = old('tax') != null ? old('tax') : $sales->tax;
        $description = old('description') != null ? old('description') : $sales->comment;
        $discount = old('discount') != null ? old('discount') : $sales->discount;
        $pay_mode = old('pay_mode') != null ? old('pay_mode') : $sales->pay_mode;
        $DeliveryAmount = old('DeliveryAmount') != null ? old('DeliveryAmount') : $sales->delivery_amount;
        $delivery_address = old('delivery_address') != null ? old('delivery_address') : $sales->delivery;
        $paidAmount = old('paidAmount') != null ? old('paidAmount') : $sales->paid_amount;
        // print_r($category);paidAmount
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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Product TaxAmo</a></li>
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
                                                @if ($customer_data != '')
                                                    @foreach ($customer as $row)
                                                        @if ($row->id == $customer_data)
                                                            <option value="{{ $row->id }}" selected>
                                                                {{ $row->first_name . ' ' . ($row->last_name == '-' ? '' : $row->last_name) }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $row->id }}">
                                                                {{ $row->first_name . ' ' . ($row->last_name == '-' ? '' : $row->last_name) }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @foreach ($customer as $row)
                                                        <option value="{{ $row->id }}">
                                                            {{ $row->first_name . ' ' . ($row->last_name == '-' ? '' : $row->last_name) }}
                                                        </option>
                                                    @endforeach
                                                @endif
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
                                            @if ($customer_data != '')
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="">Branch</label>
                                        <select name="branch" id="branch" class="form-select">
                                            <option value="">---SELECT---</option>
                                            @if ($branch != null)
                                                @foreach ($branch_dataset as $row)
                                                    @if ($branch == $row->id)
                                                        <option value="{{ $row->id }}" selected>{{ $row->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                    @endif
                                                @endforeach
                                            @else
                                                @foreach ($branch_dataset as $row)
                                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('branch')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Invoice No</td>
                                            <td>{{ $invoiceno }}</td>
                                        </tr>
                                        <tr>
                                            <td>Invoice Date</td>
                                            <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Invoice Amount</td>
                                            <td id="display_amount">{{ $TotalAmount == '' ? '0.00' : $TotalAmount }}
                                            </td>
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
                                        <th>Description</th>
                                        <th width="80">Quantity</th>
                                        <th width="80">Price</th>
                                        <th width="80">Total</th>
                                        <th width="40">Action</th>
                                    </thead>
                                    <tbody>
                                        @if ($product == '')
                                            <tr>
                                                <td width="200">
                                                    <select name="category[]" id="category" class="form-select category"
                                                        required>
                                                        <option value="">---SELECT---</option>
                                                        @foreach ($category_dataset as $row)
                                                            <option value="{{ $row->id }}">{{ $row->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="auto-complete">
                                                        <input type="text" name="auto_complete" id="auto_complete"
                                                            class="form-control auto_complete">
                                                        <input type="hidden" name="product[]" id="product">
                                                    </div>
                                                    {{-- <select name="product[]" id="product" class="form-select product"
                                                    data-live-search="true" required>
                                                    <option value="">---SELECT---</option>
                                                </select> --}}
                                                </td>
                                                <td width="200">
                                                    <input type="text" name="item_description[]" id="item_description"
                                                        class="form-control">
                                                </td>
                                                <td width="120">
                                                    <input min="0" type="number" name="qty[]" id="qty"
                                                        class="form-control" placeholder="Quantity" required>
                                                </td>
                                                <td width="120"><input type="text" name="price[]" id="price"
                                                        class="form-control" placeholder="Price" required></td>
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
                                                        <select name="category[]" id="category"
                                                            class="form-select category" required>
                                                            <option value="">---SELECT---</option>
                                                            @foreach ($category_dataset as $index => $row)
                                                                @if ($categoryrow == $row->id)
                                                                    <option value="{{ $row->id }}" selected>
                                                                        {{ $row->name }}</option>
                                                                @else
                                                                    <option value="{{ $row->id }}">
                                                                        {{ $row->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    {{-- Get Product by category --}}

                                                    <td>
                                                        <div class="auto-complete">
                                                            <input type="text" name="auto_complete" id="auto_complete"
                                                                class="form-control auto_complete"
                                                                value="{{ App\Http\Controllers\HelperController::get_ProductName_ById($category[$category_index], $product[$category_index]) }}">
                                                            <input type="hidden" name="product[]" id="product"
                                                                value="{{ $product[$category_index] }}">
                                                            <input type="hidden" name="invoice_item_id[]" id="invoice_item_id"
                                                                value="{{ $invoice_items[$category_index]['id'] }}">
                                                        </div>
                                                        {{-- <select name="product[]" id="product"
                                                            class="form-select product" data-live-search="true" required>
                                                            <option value="">---SELECT---</option>
                                                            @foreach ($dropdown_dataset as $productrow)
                                                                @if ($product[$category_index] == $productrow->id)
                                                                    <option value="{{ $productrow->id }}" selected>
                                                                        {{ $productrow->name }}</option>
                                                                @else
                                                                    <option value="{{ $productrow->id }}">
                                                                        {{ $productrow->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select> --}}
                                                    </td>
                                                    <td width="200">
                                                        <input type="text" name="item_description[]"
                                                            value="{{ $item_description[$category_index] }}"
                                                            id="item_description" class="form-control">
                                                    </td>
                                                    <td width="120">
                                                        <input min="0" type="number" name="qty[]"
                                                            id="qty" class="form-control" placeholder="Quantity"
                                                            required value="{{ $qty[$category_index] }}">
                                                    </td>
                                                    <td width="120"><input type="text" name="price[]"
                                                            id="price" class="form-control" placeholder="Price"
                                                            required value="{{ $price[$category_index] }}"></td>
                                                    <td width="120"><input type="text" name="total[]"
                                                            id="total" class="form-control" placeholder="Total"
                                                            required readonly value="{{ $total[$category_index] }}"></td>
                                                    <td>
                                                        <a class="btn-reomve btn btn-icon text-red"
                                                            invoice-item-remove="true"
                                                            invocie-item-id="{{ $invoice_items[$category_index]['id'] }}"><span
                                                                class="mdi mdi-delete"></span></a>
                                                    </td>
                                                </tr>
                                                @php
                                                    $SubTotalAmount = $SubTotalAmount + $total[$category_index];
                                                @endphp
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
                                <div class="row">
                                    <div class="col-12">
                                        <label for="mb-3">Delivery Address</label><br>
                                        <input type="checkbox" name="same_address" id="same_address"><label
                                            for="" class="ps-3">Same address</label>
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <textarea name="delivery_address" id="delivery_address" cols="10" rows="5" class="form-control">{{ $delivery_address }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="">Note:</label>
                                        <textarea name="description" id="description" cols="30" rows="3" class="form-control">{{ $description }}</textarea>
                                    </div>
                                </div>

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
                                        <input type="text" name="tax" id="tax" placeholder="Tax %"
                                            class="form-control" value="{{ $tax }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6 col-sm-12 text-end">
                                        <label for="">Tax Amount</label>
                                    </div>
                                    @php
                                        if ($tax > 0) {
                                            $taxAmount = number_format(($tax * $SubTotalAmount) / 100, 2);
                                        }

                                    @endphp
                                    <div class="col-md-6 col-sm-12">
                                        <input type="text" name="tax_amount" id="tax_amount" placeholder="Tax"
                                            class="form-control" value="{{ $taxAmount }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6 col-sm-12 text-end">
                                        <label for="">Discount</label>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <input type="text" name="discount" id="discount" placeholder="Discount"
                                            class="form-control" value="{{ number_format($discount, 2) }}">
                                    </div>
                                </div>
                                {{-- <div class="row mb-2">
                                    <div class="col-md-6 col-sm-12 text-end">
                                        <label for="">Discount Amount</label>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <input type="text" name="discount_amount" id="discount_amount"
                                            placeholder="Discount" class="form-control" value="">
                                    </div>
                                </div> --}}
                                <div class="row mb-2">
                                    <div class="col-md-6 col-sm-12 text-end">
                                        <label for="">Delivery Charges</label>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <input type="text" name="DeliveryAmount" id="DeliveryAmount"
                                            class="form-control" value="{{ $DeliveryAmount }}">
                                        @error('DeliveryAmount')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
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
                                        <label for="">Pay Mode</label>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <select name="pay_mode" id="pay_mode" class="form-select">
                                            <option value="">---SELECT---</option>
                                            <option value="Credit Cards" @if ($pay_mode == 'Credit Cards') selected @endif>
                                                Credit Cards
                                            </option>
                                            <option value="Debit Cards"@if ($pay_mode == 'Debit Cards') selected @endif>
                                                Credit Cards</option>
                                            <option value="Cash" @if ($pay_mode == 'Cash') selected @endif>Cash
                                            </option>
                                            <option value="Paper Checks"
                                                @if ($pay_mode == 'Paper Checks') selected @endif>Paper Checks
                                            </option>
                                            <option value="UPI" @if ($pay_mode == 'UPI') selected @endif>UPI
                                            </option>
                                        </select>
                                        @error('paidAmount')
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
                                            value="{{ $paidAmount }}" required>
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
                                    @foreach ($coutries as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
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
        .auto-complete {
            position: relative;
        }

        .auto-serach-table {
            position: absolute;
            z-index: 999;
            background: ghostwhite;
            width: 100%;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 20px 25px -5px, rgba(0, 0, 0, 0.04) 0px 10px 10px -5px;
        }

        .auto-serach-table tr {
            cursor: pointer;
        }

        .auto-serach-table tr:not(:first-child)hover {
            background-color: rgb(211, 255, 146) !important;
            color: #000000 !important;
        }

        .auto-serach-table tr td {
            padding: 4px 12px;
            font-size: 12px;
            border: 1px solid white;
        }

        .auto-serach-table tr:first-child {
            font-size: 13px;
            font-weight: bolder;
            text-align: center;
            background-color: black;
            color: white;
        }

        .auto-serach-table tr:nth-child(odd) {
            background-color: #4C8BF5;
            color: #fff;
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
            $('.auto_complete').on('keyup', function() {

                var table = $('#itemTable tbody');
                var url = "{{ route('sales-auto-complete') }}";
                var rowIndex = $(this)[0].parentNode.parentNode.parentNode.rowIndex;
                var selected_category = table[0].rows[rowIndex - 1].children[0].children[0].value;
                console.log(selected_category)
                if (selected_category === null || selected_category === '' || selected_category ===
                    undefined) {
                    iziToast.error({
                        title: 'Error',
                        message: 'Please choose any category',
                        position: 'topRight'
                    });
                    return false;
                }
                var autocomplete = $(this)[0].parentNode;
                if (this.value != '') {
                    $.ajax({
                        type: 'GET',
                        url: url,
                        data: {
                            'search_text': this.value,
                            'category': selected_category
                        },
                        success: function(data) {
                            $('.auto-serach-table').remove();
                            if (data.rows.length > 0) {
                                let auto_comlete_table = document.createElement('table')
                                auto_comlete_table.className = "auto-serach-table";
                                ObjectkeyLength = Object.keys(data.rows[0]).length;
                                complete_row = document.createElement('tr');
                                for (var i = 1; i < ObjectkeyLength; i++) {
                                    //Create column header
                                    complete_column_header = document.createElement(
                                        'td');
                                    complete_column_header.innerHTML = Object.keys(
                                        data.rows[0])[i].replace('_', ' ').toUpperCase();
                                    complete_row.append(complete_column_header);
                                }
                                auto_comlete_table.append(complete_row);
                                data.rows.forEach($element => {
                                    complete_row = document.createElement('tr');
                                    complete_row.setAttribute("data-id", $element[Object
                                        .keys(
                                            $element)[0]])
                                    complete_row.setAttribute("data-name", $element[
                                        Object.keys(
                                            $element)[1]])
                                    complete_row.addEventListener('click', function(e) {
                                        let parent_Node = this.parentNode
                                            .parentNode;
                                        $(parent_Node).find('#auto_complete')
                                            .val(this.attributes[1].nodeValue);
                                        $(parent_Node).find('#product').val(this
                                            .attributes[0].nodeValue);
                                        var selectedRow = $(this);
                                        var category = $(this)[0].parentNode
                                            .parentNode.parentNode
                                            .parentNode.children[0].children[0]
                                            .value;
                                        if (category === null || category ===
                                            undefined || category === '') {
                                            iziToast.error({
                                                title: 'Error',
                                                message: 'Please choose any category',
                                                position: 'topRight'
                                            });
                                            return false;
                                        }
                                        var rowIndex = $(this)[0].parentNode
                                            .parentNode.parentNode.parentNode
                                            .rowIndex;
                                        console.log(rowIndex);
                                        var product = $(this)[0].attributes[
                                            'data-id'].value;

                                        for (let index = 0; index < table[0]
                                            .rows.length; index++) {

                                            if (category == table[0].rows[index]
                                                .children[0].children[0]
                                                .value && product == table[0]
                                                .rows[index]
                                                .children[1].children[0]
                                                .children[1].value &&
                                                rowIndex != index + 1
                                            ) {
                                                iziToast.warning({
                                                    title: 'Error',
                                                    message: 'This product has already been selected',
                                                    position: 'topRight'
                                                });
                                                $(parent_Node).find('#product')
                                                    .val('');
                                                return false;
                                            }
                                        }
                                        var url =
                                            '{{ route('get-product-price') }}';
                                        $.ajax({
                                            type: 'GET',
                                            url: url,
                                            data: {
                                                'id': product,
                                                'category': category
                                            },
                                            success: function(
                                                data) {
                                                table[0]
                                                    .rows[
                                                        rowIndex - 1
                                                    ]
                                                    .children[
                                                        4]
                                                    .children[
                                                        0]
                                                    .value =
                                                    data
                                                    .price;
                                                addTotalAmount
                                                    ();
                                            }
                                        });
                                        $('.auto-serach-table')
                                            .remove();
                                    })
                                    ObjectkeyLength = Object.keys($element).length;
                                    for (var i = 1; i < ObjectkeyLength; i++) {
                                        //Create column header
                                        var column_name = Object.keys(
                                            $element)[i];
                                        complete_column = document.createElement('td');
                                        str = $element[column_name] == null ?
                                            $element[column_name] : $element[
                                                column_name].replace(this.value,
                                                '<mark>' + this.value + '</mark>');
                                        if (column_name === "TYPE") {
                                            str = str === '1' ? 'TTF' : 'TL';
                                        }
                                        complete_column.innerHTML = str;
                                        complete_row.append(complete_column);

                                    }
                                    auto_comlete_table.append(complete_row);
                                })
                                autocomplete.append(auto_comlete_table);
                            }
                        }
                    })
                } else {
                    $('.auto-serach-table').remove();
                }
            })
            $('#discount').on('keyup', function() {
                addTotalAmount();
            });


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
                newRow[0].children[2].children[0].value = ""
                newRow[0].children[3].children[0].value = "0"
                newRow[0].children[4].children[0].value = "0.00"
                newRow[0].children[5].children[0].value = "0.00"

                $("#itemTable").find('tr:last').after(newRow);
            });
            $('#tax').on('change paste keyup', function() {
                addTotalAmount()
            })
            $('[id=price]').on('change paste keyup', function() {
                // var qty = $(this)[0].parentNode.parentNode.children[3].children[0].value;
                // var price = $(this).val() * qty;
                addTotalAmount();
               // $(this)[0].parentNode.parentNode.children[5].children[0].value = Number(price).toFixed(2);
            })
            $('[id=qty]').on('change paste keyup', function() {
                var amount = $(this)[0].parentNode.parentNode.children[4].children[0].value;
                var price = $(this).val() * amount;
                addTotalAmount();
                $(this)[0].parentNode.parentNode.children[5].children[0].value = Number(price).toFixed(2);;
            })

            function addTotalAmount() {
                var table = $('#itemTable');
                var tbl_rows = table[0].rows;
                for(var i = 1;i < tbl_rows.length;i++){
                    //console.log(tbl_rows[i].cells[3].children[0].value);
                    var qty = table[0].rows[i].cells[3].children[0].value
                    var price = table[0].rows[i].cells[4].children[0].value
                    table[0].rows[i].cells[5].children[0].value = Number(qty * price).toFixed(2)
                }
                var amountArray = document.querySelectorAll('input[id=total]');
                var SubTotalAmount = document.getElementById('SubTotalAmount');
                var TotalAmount = document.getElementById('TotalAmount');
                var Tax_amount = document.getElementById('tax_amount');
                var Tax = document.getElementById('tax');
                var Discount = document.getElementById('discount');
                var Discount_amount = document.getElementById('discount_amount');
                var Delivery_Amount = document.getElementById('DeliveryAmount');
                var AddAmount = 0,
                    TaxAmount = 0,
                    DiscountAmount = 0;
                DeliveryAmount = 0;
                for (let index = 0; index < amountArray.length; index++) {
                    AddAmount = Number(AddAmount) + Number(amountArray[index].value);
                }
                SubTotalAmount.value = Number(AddAmount).toFixed(2);
                if (Number(Tax.value) > 0) {
                    TaxAmount = AddAmount * Number(Tax.value) / 100;
                    Tax_amount.value = Number(TaxAmount).toFixed(2);
                } else {
                    Tax_amount.value = 0;
                }

                if (Number(Delivery_Amount.value) > 0) {
                    DeliveryAmount = Delivery_Amount.value
                } else {
                    DeliveryAmount = 0;
                }
                TotalAmount.value = Number(Number(AddAmount + TaxAmount + Number(DeliveryAmount)) - Discount.value)
                    .toFixed(2);
                $('#display_amount').html(Number(Number(AddAmount + TaxAmount + Number(DeliveryAmount)) -
                    DiscountAmount).toFixed(2));
            }
            $('#DeliveryAmount').on('keyup', function() {
                addTotalAmount();
            });
            $('.btn-reomve').on('click', function(e) {
                var row = e.currentTarget.parentNode.parentNode;
                var deleted_id = $(row.cells[1]).find('#invoice_item_id').val();
                if ($('#itemTable >tbody >tr').length > 1) {
                    if (e.currentTarget.getAttribute('invoice-item-remove')) {
                        let remove_item = e.currentTarget.attributes['invocie-item-id'].value;
                        url = '{{ route('admin.quotation-item.delete', ':id') }}';
                        url = url.replace(':id', deleted_id);
                        $.ajax({
                            type: 'POST',
                            url: url,                          
                            success: function(data) {

                            }
                        })
                        console.log()
                    }
                    $(e.currentTarget.parentNode.parentNode).remove();
                    addTotalAmount();
                } else {
                    iziToast.warning({
                        title: 'Error',
                        message: 'You unable to remove this item...!!!',
                        position: 'topRight'
                    });
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
                                if (v != '' || v != 'null' || v != 'undefined' || v !=
                                    null || v != "-") {
                                    customer_address[0].innerHTML += '<lalel>' + v +
                                        '</label><br/>';
                                }
                            });
                        }
                    });
                }
            })
            $('#same_address').on('change', function() {
                let customer = document.getElementById('customer');
                let delivery_address = document.getElementById('delivery_address');
                if (this.checked === false) {
                    delivery_address.value = "";
                    return;
                }
                if (customer.value.length > 0) {
                    var customer_address = $('#customer_address');
                    delivery_address.value = customer_address[0].textContent;
                } else {
                    this.checked = false;
                    alert("Please choose any one customer");
                    return false;
                }
            })
        })
    </script>
@endsection
