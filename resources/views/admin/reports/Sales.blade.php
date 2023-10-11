@extends('layout.mainLayout')

@section('page-breadcrumb')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{ $pageName }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
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
                                {{-- <a class="btn btn-primary" href="{{route($resourceUrl.'.create')}}"><i class="mdi mdi-plus-circle"></i></a> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6 colsm-12">
                            <label for="">Over All Report</label>
                        </div>
                        <div class="col-md-6 colsm-12 text-end">
                            <a href="{{route('admin.over-all-sales')}}" target="_blank" class="btn btn-primary"><span>Export to Sales Report</span></a>
                        </div>
                    </div>
                    <div class="row p-0 mb-3">
                        <h3 class="text-danger mb-3 text-uppercase">Montly Report</h3>
                        <div class="col-md-6 col-sm-12">
                            <label for="">Month</label>
                            <select name="month" id="month" class="form-select">
                                <option value="">---SELECT MONTH---</option>
                                @for ($id = 1; $id <= 12; $id++)
                                    <option value="{{$id}}">{{  date('F', mktime(0,0,0,$id, 1, date('Y'))) }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-6 col-sm-12 text-end">
                            <p></p>
                            <a href="" id="urlMontly" target="_blank" class="btn btn-primary mt-2"><span>Export to Montly Report</span></a>
                        </div>
                    </div>
                    <div class="row p-0 mb-3">
                        <div class="col-12">
                            <p><h3 class="text-danger mb-3 text-uppercase">Datewise Report</h3></p>
                            <div class="row">                        
                                <div class="col-md-4 col-sm-12">
                                    <label for="">From Date</label>
                                    <input type="text" name="from" id="from" class="form-control" value="{{\Carbon\Carbon::now()->format('d-m-Y')}}">
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label for="">From Date</label>
                                    <input type="text" name="to" id="to" class="form-control" value="{{\Carbon\Carbon::now()->addDays(6)->format('d-m-Y')}}">
                                </div>
                                <div class="col-md-4 col-sm-12 text-end">
                                    <p></p>
                                    <a href="" id="urldatewise" target="_blank" class="btn btn-primary mt-2"><span>Export to Datewise Report</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('add-js')
<script>
    var montly_url = "{{route('admin.montly-sales',['id:'])}}";
    var datewise_url = "{{route('admin.datewise-sales',['from:','to:'])}}"
    const monthly = document.getElementById('month');
    const datewise = document.getElementById('urldatewise');
    datewise.addEventListener('click',function(){
        url = datewise_url.replace('from:',encodeURI($('#from').val()))
        url = url.replace('to:',encodeURI($('#to').val()))
        this.href = url;
    })
    monthly.addEventListener('change',function(){
            url = montly_url.replace('id:',this.value);
        var target_element = document.getElementById('urlMontly');
        target_element.href = url;
    })
   $(function(){
    $('#from,#to').flatpickr({
      enableTime: false,
      dateFormat: 'd-m-Y'
    })
   })
</script>
@endsection