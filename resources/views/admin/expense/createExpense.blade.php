@php
    $month = old('month');
    $branch = old('branch');
    $name = old('name');
    $amount = old('amount');
    if($id != ''){
        $month = (old('month') != '') ? old('month') : $expense->month;
        $branch = (old('branch') != '') ? old('branch') : $expense->branch;
        $name = (old('name') != '') ? old('name') : $expense->name;
        $amount = (old('amount') != '') ? old('amount') : $expense->amount;
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
                                <a class="btn btn-primary" href="{{route($resourceUrl.'.index')}}"><i class="mdi mdi-arrow-left-circle"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route($resourceUrl.'.store')}}" method="post">
                        @csrf
                    <div class="row mb-3">
                        <div class="col-md-6 col-sm-12">
                            <label for="form-lable mb-3">Branch</label>
                            <select name="branch" id="branch" class="form-select">
                                <option value="">---SELECT---</option>
                                @foreach($branches as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                            @error('branch')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="form-lable mb-3">Month</label>
                            <input type="text" name="month" id="month" class="form-control" value="{{\Carbon\Carbon::parse($month)->format('d-m-Y')}}">
                            @error('month')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 col-sm-12">
                            <label for="form-lable mb-3">Expense Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                            @error('name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="form-lable mb-3">Amount</label>
                         <input type="text" name="amount" id="amount" class="form-control">
                        </div>
                        @error('amount')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="col-12 mb-3 text-center">
                        <input type="hidden" name="id" id="id" value="{{ $id }}">
                        <a href="{{route($resourceUrl.'.index')}}" class="btn btn-secondary">Close</a>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('add-js')
<script type="text/javascript">
const config_date = {
    dateFormat: "d-m-Y",
}
    $(function () {
        $('#month').flatpickr(config_date);
    });
  </script>
@endsection
