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
                            <p class="text-danger fw-bolder">شركة بالك بيل لتجارة اطارات السيارات ذ.م .م.</p>
                            <p class="fw-bolder text-left">BLACKBULL TYRES & RIMS TRADING CO. L.L.C</p>
                            <p class="fw-bolder text-left">TRN: 100427665300003 (DUBAI)</p>
                        </div>
                    </div>
                    <div class="row mt-3">
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
                            <p style="font-size: 12px"><b>Address:</b>Shop No. 32, Chinese Dragon Building, Deira, Dubai, Uniter Arab Emirates <b>| P.O Box :</b> 39502</p>
                            <p style="font-size: 12px"><b>Email :</b> <a href="mailto:blackbulltyre@gmail.com">blackbulltyre@gmail.com</a> <b>| Tel :</b>  +971 4 569 3560</p>
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
