@extends('layout.mainLayout')
@section('page-breadcrumb')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{ $pageName }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Master</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Purchase Order</a></li>
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
            <form id="FrmPayment" ajax-submit="true" action="{{route('admin.purchase.savePayment')}}" method="post">
                <div class="row mb-3">
                    <div class="col-md-3 col-sm-6">
                        <label for="PaymentType">Payment Mode</label>
                        <select name="Payment_mode" id="Payment_mode" class="form-select">
                            <option value="">---SELECT---</option>
                            @foreach (paymentTypes() as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <label for="">Payment Date</label>
                        <input type="text" name="Payment_date" id="Payment_date" class="form-control">
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <label for="">Reference Number</label>
                        <input type="text" name="Reference_number" id="Reference_number" class="form-control">
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <label for="">Amount</label>
                        <input type="text" name="amount" id="amount" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 text-end">
                        <button class="btn-sm btn btn-primary" type="submit">Submit</button>
                    </div>
                    <input type="hidden" name="transaction_id" id="transaction_id" value="{{$transaction_id}}">
                    <input type="hidden" name="id" value="{{$id}}">
                </div>
            </form>
                <div class="row mb-3">
                    <div class="col-12">
                        <table id="Ajaxdatatable" class="table">
                            <thead>
                                <th>SNo</th>
                                <th>Mode</th>
                                <th>Date</th>
                                <th>Reference</th>
                                <th>Amount</th>
                                <th width="40">Action</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('add-js')
    <script>
        $(function(){
            const columns = [
              {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
              {data: 'name', name: 'Mode'},
              {data: 'date', name: 'date'},
              {data: 'reference', name: 'reference'},
              {data: 'amount', name: 'Amount'},
              {data: 'action', name: 'action'}
          ];
            $('form[ajax-submit=true]').submit(function(e){
            var formid;
            e.preventDefault();
            formid = e.currentTarget.attributes['id'].nodeValue;            
            $.ajax({
                url: e.currentTarget.action,
                type: "POST",
                data: $('#'+formid).serialize(),
                success: function( response ) {
                    reInitializeDataTable('Ajaxdatatable', '{{ route("$resourceUrl".'.addPayment',"$id") }}', columns);
                   
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
            $('#Payment_date').flatpickr();
          
        
       initializeDataTable('Ajaxdatatable', '{{ route("$resourceUrl".'.addPayment',"$id") }}', columns);
        })
    </script>
@endsection
