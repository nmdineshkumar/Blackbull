<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
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
</head>

<body>
    <page size="A4">
            <div class="row p-5">
                <div class="container">
                    <div class="row">
                        <div class="col-3">
                            <div class="block">
                                <img src="{{asset('invoice/logo_text.jpeg')}}" class="" alt="..." style="height: 15%">  
                            </div>
                        </div>
                        <div class="col-9 text-end">
                            <p class="text-danger fw-bolder">الثور األسود للتجارة. ش ش و</p>
                            <p class="fw-bold" style="font-size: 12px">بيع االطارات ولوازمها - اصالح االطارات والعجالت - بيع قطع الغير الجديدة للمركبات - بيع البطاريات</p>
                            <p class="fw-bolder"><span class="text-danger">BLACK BULL TRADING S P C</span> | OMAN</p>
                            <p class="" style="font-size: 11px">SALE OF MOTOR VEHICLE TYRES ACCESSORIES - REPAIR TYRES & RIMS</p>
                            <p class="" style="font-size: 11px">SALE OF NEW MOTOR VEHICLE SPARE PARTS & ACCESSORIES - SALE OF MOTOR VEHICLE BATTERIES</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12"><h4 class="fw-bolder text-center text-decoration-underline">TAX INVOICE</h4></div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div style=" background: url({{asset('invoice/logo.jpeg')}}) no-repeat center center; 
                            -webkit-background-size: 70%;
                            -moz-background-size: 70%;
                            -o-background-size: 70%;
                            background-size: 70%;height:100vh;opacity:0.3">

                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-end">
                        <div class="col-12 text-center">
                            <p><b>Address:</b> Khasab, Musandam, Sultan of Oman</p>
                            <p><b>Email :</b> <a href="mailto:blackbulloman@gmail.com">blackbulloman@gmail.com</a> <b>| Tel :</b> +96879858474, +9687836026</p>
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
