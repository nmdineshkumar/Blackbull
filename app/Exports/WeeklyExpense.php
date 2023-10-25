<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class WeeklyExpense implements FromView
{
    protected $from;
    protected $to;
    public function __construct($from,$to)
    {
        $this->from = $from;
        $this->to = $to;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('export.expenseReport',['expense'=>DB::select("SELECT * FROM expenses where (month between '".Carbon::parse($this->from)."'
        AND '".Carbon::parse($this->to)."')")]);
    }
}
