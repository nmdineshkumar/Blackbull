<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class WeeklySales implements FromView
{
    protected $from;
    protected $to;

    function __construct($from,$to)
    {
        $this->from = $from;
        $this->to = $to;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view():View{
        return view('export.SaleReport',['invoices'=>DB::select("SELECT branches.name as center_name, 
                                                customers.first_name, 
                                                customers.last_name, 
                                                customers.phone as phone,
                                                invoice.invoice_no,
                                                invoice.invocie_date,
                                                invoice.total,
                                                invoice.paid_amount
                                            FROM black_bull.invoice
                                            inner join branches on branches.id = invoice.branch
                                            inner join customers on customers.id = invoice.customer
                                            where (invoice.created_at BETWEEN '".Carbon::parse($this->from)."'
                                            AND '".Carbon::parse($this->to)."')")]);
    }
}
