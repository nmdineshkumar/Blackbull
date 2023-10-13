@php
    $month = old('month');
    $branch = old('branch');
    $name = old('name');
    $amount = old('amount');
    $comment = old('coment');
    if ($id != '') {
        $month = old('month') != '' ? old('month') : $expense->month;
        $branch = old('branch') != '' ? old('branch') : $expense->center;
        $name = old('name') != '' ? old('name') : $expense->expense_name;
        $amount = old('amount') != '' ? old('amount') : $expense->amount;
        $comment = old('comment') != '' ? old('comment') : $expense->comment;
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
                                <h4 class="card-title mt-2 text-uppercase">{{ $pageName }}</h4>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn btn-primary" href="{{ route($resourceUrl . '.index') }}"><i
                                        class="mdi mdi-arrow-left-circle"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route($resourceUrl . '.store') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12">
                                <label for="form-lable mb-3">Branch</label>
                                <select name="branch" id="branch" class="form-select">
                                    <option value="">---SELECT---</option>
                                    @if ($branch != '')
                                        @foreach ($branches as $row)
                                            @if ($branch == $row->id)
                                                <option value="{{ $row->id }}" selected>{{ $row->name }}</option>
                                            @else
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        @foreach ($branches as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    @endif

                                </select>
                                @error('branch')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="form-lable mb-3">Month</label>
                                <input type="text" name="month" id="month" class="form-control"
                                    value="{{ \Carbon\Carbon::parse($month)->format('d-m-Y') }}">
                                @error('month')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12">
                                <label for="form-lable mb-3">Category</label>
                                <div class="input-group">
                                    <select name="name" id="name" class="form-select">
                                        <option value="">---SELECT---</option>
                                        @if ($name != '')
                                            @foreach ($expense_category as $row)
                                                @if ($name == $row->name)
                                                    <option value="{{ $row->name }}" selected>{{ $row->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $row->name }}">{{ $row->name }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            @foreach ($expense_category as $row)
                                                <option value="{{ $row->name }}">{{ $row->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="input-group-append">
                                        <a data-bs-toggle="modal" data-bs-target="#expense_categoryModal"
                                            class="btn btn-primary"><i class="mdi mdi-plus-circle"></i></a>
                                    </div>
                                </div>
                                {{-- <input type="text" name="name" id="name" class="form-control" value="{{$name}}"> --}}
                                @error('name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="form-lable mb-3">Amount</label>
                                <input type="text" name="amount" id="amount" class="form-control"
                                    value="{{ $amount }}">
                            </div>
                            @error('amount')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12">
                                <label for="">Remarks</label>
                                <textarea name="comment" id="comment" cols="15" rows="5" class="form-control">{{$comment}}</textarea>
                            </div>
                        </div>
                        <div class="col-12 mb-3 text-center">
                            <input type="hidden" name="id" id="id" value="{{ $id }}">
                            <a href="{{ route($resourceUrl . '.index') }}" class="btn btn-secondary">Close</a>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Brand Modal Start -->
    <div class="modal fade" id="expense_categoryModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Expense Category</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form ajax-submit="true" id="addExpense_category" action="{{ route('save-expense-category') }}"
                        method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="">Category</label>
                                <input type="text" name="expense_Category" id="expense_Category"
                                    class="form-control">
                            </div>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Brand Modal End -->
@endsection


@section('add-js')
    <script type="text/javascript">
        const config_date = {
            dateFormat: "d-m-Y",
        }
        $(function() {
            $('#month').flatpickr(config_date);
            $('form[ajax-submit=true]').submit(function(e) {
                e.preventDefault();
                var mySlection, modal, formid;
                e.preventDefault();
                formid = e.currentTarget.id;
                if (formid === 'addExpense_category') {
                    mySlection = $('#name');
                    modal = $('#expense_categoryModal');
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
        });
    </script>
@endsection
