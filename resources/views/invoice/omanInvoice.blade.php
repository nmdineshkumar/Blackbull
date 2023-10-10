<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Oman Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background: rgb(204, 204, 204);
        }

        page[size="A4"] {
            background: white;
            width: 21cm;
            height: 29.7cm;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
        }

        @media print {

            body,
            page[size="A4"] {
                margin: 0;
                box-shadow: 0;
            }
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
        <div class="row p-5">
            <div class="container">
                <div class="row mb-3">
                    <div class="col-3">
                        <div class="block">
                            <img src="{{ asset('invoice/logo_text.jpeg') }}" class="" alt="..."
                                style="height: 15%">
                        </div>
                    </div>
                    <div class="col-9 text-end">
                        <p class="text-danger fw-bolder mb-1">الثور األسود للتجارة. ش ش و</p>
                        <p class="fw-bold mb-1" style="font-size: 12px">بيع االطارات ولوازمها - اصالح االطارات والعجالت
                            - بيع قطع الغير الجديدة للمركبات - بيع البطاريات</p>
                        <p class="fw-bolder mb-1"><span class="text-danger">BLACK BULL TRADING S P C</span> | OMAN</p>
                        <p class="mb-1" style="font-size: 11px">SALE OF MOTOR VEHICLE TYRES ACCESSORIES - REPAIR TYRES
                            & RIMS</p>
                        <p class="mb-1" style="font-size: 11px">SALE OF NEW MOTOR VEHICLE SPARE PARTS & ACCESSORIES -
                            SALE OF MOTOR VEHICLE BATTERIES</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h4 class="fw-bolder text-center text-decoration-underline">TAX INVOICE</h4>
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
                                <div class="col-sm-6 text-sm-end order-sm-1"> <strong>Pay To:</strong>
                                    <address>
                                        {{ $branch[0]->name }}<br />
                                        {{ $branch[0]->address1 }}, {{ $branch[0]->address2 }}<br />
                                        {{ $branch[0]->state }},{{ $branch[0]->city }} - {{ $branch[0]->zip }}<br />
                                        {{ $branch[0]->country }}
                                    </address>
                                </div>
                                <div class="col-sm-6 order-sm-0"> <strong>Invoiced To:</strong>
                                    <address>
                                        {{ $customer[0]->first_name }} {{ $customer[0]->last_name }}<br />
                                        {{ $customer[0]->address1 }}, {{ $customer[0]->address2 }}<br />
                                        {{ $customer[0]->state }},{{ $customer[0]->city }} -
                                        {{ $customer[0]->zip }}<br />
                                        {{ $customer[0]->country }}
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6"> <strong>Payment Method:</strong><br>
                                    <span> Cash </span> <br />
                                    <br />
                                </div>
                                <div class="col-sm-6 text-sm-end"> <strong>Order Date:</strong><br>
                                    <span>{{ \Carbon\Carbon::parse($invoice->invocie_date)->format('d-m-Y') }}<br>
                                        <br>
                                    </span>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header"> <span class="fw-600 text-4">Summary</span> </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <td class="col-8"><strong>Description</strong></td>
                                                    <td class="col-2 text-center"><strong>Qty</strong></td>
                                                    <td class="col-2 text-end"><strong>Price</strong></td>
                                                    <td class="col-2 text-end"><strong>Total</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($invoiceItems as $row)
                                                    <tr>
                                                        <td><small class="">{{ $row->category }}</small><br />
                                                            {{ $row->Product }}</td>
                                                        <td class="text-center">{{ $row->qty }}</td>
                                                        <td class="text-center">{{ $row->price }}</td>
                                                        <td class="text-end">{{ $row->total }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot class="card-footer">
                                                <tr>
                                                    <td colspan="3" class="text-end"><strong>Paid Amount:</strong>
                                                    </td>
                                                    <td class="text-end">{{ $invoice->paid_amount }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="text-end"><strong>Tax:</strong></td>
                                                    <td class="text-end">{{ $invoice->tax }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="text-end border-bottom-0">
                                                        <strong>Total:</strong></td>
                                                    <td class="text-end border-bottom-0">{{ $invoice->total }}</td>
                                                </tr>
                                            </tfoot>
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
                 <!-- Footer -->
                 <footer class="text-center mb-5">
                    <p class="text-1"><strong>NOTE :</strong> This is computer generated receipt and does not require
                        physical signature.</p>
                    <div class="btn-group btn-group-sm d-print-none"> <a href="javascript:window.print()"
                            class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-print"></i> Print</a>
                        <a href="" class="btn btn-light border text-black-50 shadow-none"><i
                                class="fa fa-download"></i> Download</a> </div>
                </footer>
                <div class="d-flex align-items-end">
                    <div class="col-12 text-center">
                        <p class="mb-1"><b>Address:</b> Khasab, Musandam, Sultan of Oman</p>
                        <p class="mb-1"><b>Email :</b> <a href="mailto:blackbulloman@gmail.com">blackbulloman@gmail.com</a> <b>| Tel
                                :</b> +96879858474, +9687836026</p>
                    </div>
                </div>
               
            </div>
        </div>
    </page>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
