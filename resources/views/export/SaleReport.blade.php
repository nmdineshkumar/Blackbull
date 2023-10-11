<table>
    <thead>
    <tr>
        <th>S No</th>
        <th>Center</th>
        <th>Customer</th>
        <th>Customer Number</th>
        <th>Invoice No</th>
        <th>Invoice Date</th>
        <th>Total</th>
        <th>Paid Amount</th>
    </tr>
    </thead>
    <tbody>
    @foreach($invoices as $index => $invoice)
        <tr>
            <td>{{$index+1}}</td>
            <td>{{ $invoice->center_name }}</td>
            <td>{{ $invoice->first_name .' '.$invoice->last_name }}</td>
            <td>{{ $invoice->phone}}</td>
            <td>{{ $invoice->invoice_no}}</td>
            <td>{{ \Carbon\Carbon::parse($invoice->invocie_date)->format('d-m-Y')}}</td>
            <td>{{$invoice->total}}</td>
            <td>{{ $invoice->paid_amount}}</td>
        </tr>
    @endforeach
    </tbody>
</table>