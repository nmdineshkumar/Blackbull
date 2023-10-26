<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="images/favicon.png" rel="icon" />
<title>Invoice</title>
<meta name="author" content="blackbull.com">

<!-- Web Fonts
======================= -->
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>

<!-- Stylesheet
======================= -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/app.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/invoice/invoice.css') }}"/>
</head>
<body>
<!-- Container -->
<div class="container-fluid invoice-container"> 
  <!-- Header -->
  <header>
    <div class="row align-items-center">
      <div class="col-sm-7 text-center text-sm-start mb-3 mb-sm-0">  </div>
      <div class="col-sm-5 text-center text-sm-end">
        <h4 class="mb-0">Invoice</h4>
        <p class="mb-0">Invoice Number - {{ $invoiceNumber }}</p>
      </div>
    </div>
    <hr>
  </header>
  <!-- Main Content -->
  <main>
    <div class="row">
      {{-- <div class="col-sm-6 text-sm-end order-sm-1"> <strong>Pay To:</strong>
        <address>
            {{ $branch[0]->name }}<br />
            {{ $branch[0]->address1 }}, {{ $branch[0]->address2 }}<br />
            {{ $branch[0]->state  }},{{ $branch[0]->city  }} - {{ $branch[0]->zip }}<br />
            {{ $branch[0]->country }}
        </address>
      </div> --}}
      <div class="col-sm-6 order-sm-0"> <strong>Invoiced To:</strong>
        <address>
        {{ $customer[0]->first_name }} {{ $customer[0]->last_name }}<br />
        {{ $customer[0]->address1 }}, {{ $customer[0]->address2 }}<br />
        {{ $customer[0]->state  }},{{ $customer[0]->city  }} - {{ $customer[0]->zip }}<br />
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
        </span> </div>
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
                    <td><small class="">{{ $row->category }}</small><br/> {{ $row->Product }}</td>
                    <td class="text-center">{{ $row->qty }}</td>
                    <td class="text-center">{{ $row->price }}</td>
                    <td class="text-end">{{ $row->total }}</td>
                  </tr>
                @endforeach
            </tbody>
			<tfoot class="card-footer">
			  <tr>
                <td colspan="3" class="text-end"><strong>Paid Amount:</strong></td>
                <td class="text-end">{{ $invoice->paid_amount }}</td>
              </tr>
              <tr>
                <td colspan="3" class="text-end"><strong>Tax:</strong></td>
                <td class="text-end">{{ $invoice->tax }}</td>
              </tr>
              <tr>
                <td colspan="3" class="text-end border-bottom-0"><strong>Total:</strong></td>
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
  <!-- Footer -->
  {{-- <footer class="text-center">
    <p class="text-1"><strong>NOTE :</strong> This is computer generated receipt and does not require physical signature.</p>
    <div class="btn-group btn-group-sm d-print-none"> <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-print"></i> Print</a> <a href="" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-download"></i> Download</a> </div>
  </footer> --}}
</div>

</body>
</html>