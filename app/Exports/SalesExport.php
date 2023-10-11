<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class SalesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('export.SaleReport',['invoices'=>DB::select('SELECT branches.name as center_name, 
                                                                customers.first_name, 
                                                                customers.last_name, 
                                                                customers.phone as phone,
                                                                invoice.invoice_no,
                                                                invoice.invocie_date,
                                                                invoice.total,
                                                                invoice.paid_amount
                                                            FROM black_bull.invoice
                                                            inner join branches on branches.id = invoice.branch
                                                            inner join customers on customers.id = invoice.customer;')]);
    }
}
