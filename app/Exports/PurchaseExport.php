<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class PurchaseExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('export.purchaseReport',['purchase'=>DB::select('Select 
                                                                branches.name as branch_name,
                                                                suppliers.name as supplier_name,
                                                                purchase_orders.purchase_type,
                                                                purchase_orders.invoice_date,
                                                                purchase_orders.invoice_amount,
                                                                purchase_orders.invoice_no,
                                                                purchase_orders.invoice_tax
                                                                from purchase_orders
                                                                inner join suppliers on suppliers.id = purchase_orders.supplier
                                                                inner join branches on branches.id = purchase_orders.branch')]);
    }
}
