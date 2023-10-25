<?php

namespace App\Exports;

use App\Models\Expense;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class monthlyExpense implements FromView
{
    protected $month;
    public function __construct($month)
    {
        $this->month = $month;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('export.expenseReport',['expense'=>DB::select("SELECT * FROM expenses Where(month(month) = $this->month)")]);
    }
}
