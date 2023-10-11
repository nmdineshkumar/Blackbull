<table>
    <thead>
    <tr>
        <th>S No</th>
        <th>Center</th>
        <th>Supplier</th>
        <th>Customer Number</th>
        <th>Invoice No</th>
        <th>Invoice Date</th>
        <th>Tax</th>
        <th>Paid Amount</th>
    </tr>
    </thead>
    <tbody>
    @foreach($purchase as $index => $item)
        <tr>
            <td>{{$index+1}}</td>
            <td>{{ $item->branch_name }}</td>
            <td>{{ $item->supplier_name }}</td>
            <td>{{ get_Puchase_type($item->purchase_type)}}</td>
            <td>{{ $item->invoice_no}}</td>
            <td>{{ \Carbon\Carbon::parse($item->invoice_date)->format('d-m-Y')}}</td>
            <td>{{$item->invoice_tax}}</td>
            <td>{{ $item->invoice_amount}}</td>
        </tr>
    @endforeach
    </tbody>
</table>