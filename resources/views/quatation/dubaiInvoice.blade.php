@php
    $subTotal = '0';
@endphp
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dubai Quotation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="{{ asset('assets/js/ntw.js') }}"></script>
    <style>
        body {
            background: rgb(204, 204, 204);
        }

        page[size="A4"] {
            background: white;
            width: 21cm;
            min-height: 29.7cm;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            /* box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5); */
        }

        table.invoice-container-content {
            page-break-after: always;
        }

        thead.invoice-header {
            display: table-header-group;
        }

        tfoot.invoice-footer {
            display: table-footer-group;
        }
    </style>
    <!-- Web Fonts
======================= -->
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900'
        type='text/css'>

    <!-- Stylesheet
======================= -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/app.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/invoice/invoice.css') }}" />
</head>

<body>
    <page size="A4">
        <div class="row p-3">
            <div class="container">
                <table style="width: 100%">
                    <thead class="p-0 border-0">
                        <tr>
                            <td>
                                <div class="row mb-3 invoice-header" id="header">
                                    <div class="col-3">
                                        <div class="block">
                                            <img src="{{ asset('invoice/logo_text.jpeg') }}" class=""
                                                alt="..." style="height: 15%">
                                        </div>
                                    </div>
                                    <div class="col-9 text-end">
                                        <p class="text-danger fw-bolder mb-1">شركة بالك بيل لتجارة اطارات السيارات ذ.م
                                            .م</p>
                                        <p class="fw-bolder text-left mb-1">BLACKBULL TYRES & RIMS TRADING CO. L.L.C</p>
                                        <p class="fw-bolder text-left mb-1">TRN: 100427665300003 (DUBAI)</p>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-0">
                                <div class="invoice-container-content">
                                    <div class="row align-items-center ">
                                        <div class="col-sm-7 text-center text-sm-start mb-3 mb-sm-0"> </div>
                                        <div class="col-sm-5 text-center text-sm-end">
                                            <p class="mb-0">Quotation Number - {{ $invoiceNumber }}</p>
                                        </div>
                                    </div>
                                    <div class="row mt-3">

                                        <div class="col-12">
                                            <h4 class="fw-bolder text-center text-decoration-underline">Quotation</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            {{-- <div style=" background: url({{asset('invoice/logo.jpeg')}}) no-repeat center center; 
                                        -webkit-background-size: 70%;
                                        -moz-background-size: 70%;
                                        -o-background-size: 70%;
                                        background-size: 70%;height:100vh;opacity:0.3"> --}}
                                            <main>
                                                <div class="row">
                                                    <div class="col-sm-6 text-sm-end order-sm-1"> <strong>Quotation From:</strong>
                                                        <address>
                                                            {{ $branch[0]->name }}<br />
                                                            {{-- {{ $branch[0]->address1 }}, {{ $branch[0]->address2 }}<
                                                            {{ $branch[0]->state }},{{ $branch[0]->city }} - {{ $branch[0]->zip }}<br />
                                                            {{ $branch[0]->country }} --}}
                                                        </address>
                                                    </div>
                                                    <div class="col-sm-6 order-sm-0"> <strong>Quotation To:</strong>
                                                        <address>
                                                            @if (count($customer) > 0)
                                                                {{ $customer[0]->first_name }}
                                                                {{ $customer[0]->last_name == '-' ? '' : $customer[0]->last_name }}
                                                                {{ $customer[0]->address1 == '-' ? '' : $customer[0]->address1 }}
                                                                {{ $customer[0]->address2 == '' ? '' : $customer[0]->address2 }}
                                                                {{ $customer[0]->state == '-' ? '' : $customer[0]->state }}{{ $customer[0]->city == '-' ? '' : $customer[0]->city }}
                                                                {{ $customer[0]->zip == '-' ? '' : $customer[0]->zip }}
                                                                {{ $customer[0]->country == '-' ? '' : $customer[0]->country }}
                                                            @else
                                                            @endif
                                                        </address>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    {{-- <div class="col-sm-6"> <strong>Payment Method:</strong><br>
                                                        <span> {{ $invoice->pay_mode }} </span> <br />
                                                        <br />
                                                    </div> --}}
                                                    <div class="col-sm-6"></div>
                                                    <div class="col-sm-6 text-sm-end"> <strong>Order Date:</strong><br>
                                                        <span>{{ \Carbon\Carbon::parse($invoice->invocie_date)->format('d-m-Y') }}<br>
                                                            <br>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div>
                                                        <div class="col-12">
                                                            <strong>Delivery To:</strong><br>
                                                            {{ $invoice->delivery }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header"> <span class="fw-600 text-4">Summary</span>
                                                    </div>
                                                    <div class="card-body p-0">
                                                        <div class="table-responsive">
                                                            <table class="table-sm w-100 p-0 mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 10px">SI.No</th>
                                                                        <th>Item Code</th>
                                                                        <th>Description</th>
                                                                        <th style="text-align: center">Qty</th>
                                                                        <th style="text-align: center">Rate</th>
                                                                        <th style="text-align: center">Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($invoiceItems as $index => $row)
                                                                        <tr style="border-bottom: 1px solid #808080">
                                                                            <td>{{ $index + 1 }}. </td>
                                                                            <td>{{ $row->Product }}</td>
                                                                            <td>{{ $row->description }} </td>
                                                                            <td class="text-center">{{ $row->qty }}
                                                                            </td>
                                                                            <td class="text-center">
                                                                                {{ number_format($row->price, 2) }}
                                                                            </td>
                                                                            <td class="text-center">
                                                                                {{ number_format($row->total, 2) }}
                                                                            </td>
                                                                        </tr>
                                                                        @php $subTotal = $subTotal + $row->total @endphp
                                                                    @endforeach
                                                                    <tr>
                                                                        <td colspan="6" class="p-0 border-0">
                                                                            <table
                                                                                class="card-footer  w-100 table-sm m-0">
                                                                                <tr>
                                                                                    <td colspan="3" class="text-end">
                                                                                        <strong>Sub
                                                                                            Total:</strong>
                                                                                    </td>
                                                                                    <td class="text-end"
                                                                                        style="width: 15%">
                                                                                        {{ number_format($subTotal, 2) }}
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="3" class="text-end">
                                                                                        <strong>Tax
                                                                                            {{ $invoice->tax }}%
                                                                                            :</strong>
                                                                                    </td>
                                                                                    <td class="text-end">
                                                                                        {{ ($invoice->tax / 100) * $subTotal }}
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="3" class="text-end">
                                                                                        <strong>Discount :</strong>
                                                                                    </td>
                                                                                    <td class="text-end">
                                                                                        {{ $invoice->discount }}
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="3" class="text-end">
                                                                                        <strong>Delivery Charges
                                                                                            :</strong>
                                                                                    </td>
                                                                                    <td class="text-end">
                                                                                        {{ $invoice->delivery_amount == null ? '0.00' : number_format($invoice->delivery_amount, 2) }}
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="3"
                                                                                        class="text-end border-bottom-0">
                                                                                        <strong>Total:</strong>
                                                                                    </td>
                                                                                    <td
                                                                                        class="text-end border-bottom-0">
                                                                                       <b><small>AED </small>
                                                                                        {{ number_format($invoice->total, 2) }}</b> 
                                                                                    </td>
                                                                                </tr>
                                                                                {{-- <tr>
                                                                                    <td colspan="3" class="text-end">
                                                                                        <strong>Paid Amount:</strong>
                                                                                    </td>
                                                                                    <td class="text-end">                                                                                        
                                                                                        <b><small>AED</small> {{ number_format($invoice->paid_amount, 2) }}</b>
                                                                                    </td>
                                                                                </tr> --}}
                                                                                <tr>
                                                                                    <td colspan="2"
                                                                                        style="text-align: center">
                                                                                        <span id="numberWords"
                                                                                            class="text-uppercase"
                                                                                            data-value="{{ $invoice->total }}"></span>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="table-responsive d-print-none">

                                                </div>
                                            </main>
                                            {{-- </div> --}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">

                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="p-0">
                                <!-- Footer -->

                                <div class="d-flex align-items-end invoice-footer" id="fotter">
                                    <div class="col-12 text-center">
                                        <p style="font-size: 12px"><b>Address:</b>Shop No. 32, Chinese Dragon Building,
                                            Deira,
                                            Dubai,
                                            United Arab Emirates <b>| P.O Box :</b> 39502</p>
                                        <p style="font-size: 12px"><b>Email :</b> <a
                                                href="mailto:blackbulltyre@gmail.com">blackbulltyre@gmail.com</a> <b>|
                                                Tel :</b>+97142248844</p>
                                    </div>
                                </div>
                                <footer class="text-center mb-5">
                                    <p class="text-1"><strong>NOTE :</strong> This is computer generated receipt and
                                        does not
                                        require
                                        physical signature.</p>
                                    <div class="btn-group btn-group-sm d-print-none"> <a
                                            href="javascript:window.print()"
                                            class="btn btn-light border text-black-50 shadow-none"><i
                                                class="fa fa-print"></i>
                                            Print</a>
                                        <a href="" class="btn btn-light border text-black-50 shadow-none"><i
                                                class="fa fa-download"></i> Download</a>
                                    </div>
                                </footer>
                            </td>
                        </tr>
                    </tfoot>
                </table>



            </div>
        </div>
    </page>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>
<script>
    var numberWords = document.getElementById('numberWords');
    console.log(numberWords);
    let number = numberWords.attributes['data-value'].nodeValue;
    numberWords.innerHTML = NumToWordsInt(Number(number));
</script>

</html>
