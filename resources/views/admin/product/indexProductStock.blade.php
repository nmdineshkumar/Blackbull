@extends('layout.mainLayout')
@section('page-breadcrumb')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{ $pageName }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Master</a></li>
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
                <div class="row">
                    <div class="d-flex">
                        <div class="col-6">
                            <h4 class="card-title mt-2 text-uppercase">{{$pageName}}</h4>
                        </div>
                        <div class="col-6 text-end">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="Ajaxdatatable" class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100 margin-t">
                    <thead>
                        <th width="20">SNo</th>
                        <th>Branch</th>
                        <th>Category</th>
                        <th>Product</th>
                        <th>Available</th>
                        <th>Old Stock</th>
                        <th>Online Sale</th>
                        <th>Offline Sale</th>
                    </thead>
                    <tbody class="text-gray-600 fw-bold">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection


@section('add-js')
<script type="text/javascript">
    $(function () {
        const columns = [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'branch', name: 'Branch'},
              {data: 'Category', name: 'Category'},
              {data: 'product', name: 'Product'},
              {data: 'current_qty', name: 'Available'},
              {data: 'old_qty', name: 'Old Stock'},
              {data: 'online', name: 'Online Sale'},
              {data: 'offline', name: 'Offline Sale'}
          ];
        initializeDataTable('Ajaxdatatable', '{{ route("$resourceUrl".'.index') }}', columns);
    });
  </script>
@endsection