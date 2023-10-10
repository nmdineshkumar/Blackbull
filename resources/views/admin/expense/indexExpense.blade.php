@extends('layout.mainLayout')
@section('page-breadcrumb')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{ $pageName }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Expense</a></li>
                    <li class="breadcrumb-item active">List Expense</li>
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
                                <a class="btn btn-primary" href="{{route($resourceUrl.'.create')}}"><i class="mdi mdi-plus-circle"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="Ajaxdatatable" class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100 margin-t">
                        <thead>
                            <th>SNo</th>
                            <th>Center</th>
                            <th>Month</th>
                            <th>Amount</th>
                            <th>Action</th>
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
              {data: 'branch', name: 'Name'},
              {data: 'month', name: 'month'},
              {data: 'name', name: 'expense'},
              {data: 'action', name: 'action'}
          ];
        initializeDataTable('Ajaxdatatable', '{{ route("$resourceUrl".'.index') }}', columns);
    });
  </script>
@endsection
