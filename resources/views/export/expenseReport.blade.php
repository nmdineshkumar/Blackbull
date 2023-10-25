<table>
    <thead>
        <th>Sno</th>
        <th>Center</th>
        <th>Month</th>
        <th>Expense Name</th>
        <th>Amount</th>
    </thead>
    <tbody>
        @foreach ($expense as $index => $row)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \App\Http\Controllers\HelperController::BranchName($row->center) }}</td>
                <td>{{ $row->month }}</td>
                <td>{{ $row->expense_name }}</td>
                <td>{{ $row->amount }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
