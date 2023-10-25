<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class ExpenseExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function  view(): View
    {
        //
        return view('export.expenseReport',['expense'=>Expense::all()]);
    }
}
