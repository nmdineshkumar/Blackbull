<?php

namespace App\Http\Controllers\admin;

use App\Exports\ExpenseExport;
use App\Exports\monthlyExpense;
use App\Exports\monthlyPurchase;
use App\Exports\montlySales;
use App\Exports\PurchaseExport;
use App\Exports\SalesExport;
use App\Exports\WeeklyExpense;
use App\Exports\WeeklyPurchase;
use App\Exports\WeeklySales;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{
    //Reports function
    public function over_all(){
        return Excel::download(new SalesExport, Carbon::now().'.xlsx');
    }
    public function monthly($id){
        return Excel::download(new montlySales($id), Carbon::now().'.xlsx');
    }
    public function weekly($from,$to){
        return Excel::download(new WeeklySales($from,$to),Carbon::now().'.xlsx');
    }
    public function purchase_weekly($from,$to){
        return Excel::download(new WeeklyPurchase($from,$to),Carbon::now().'.xlsx');
    }
    public function purchase_monthly($id){
        return Excel::download(new monthlyPurchase($id),Carbon::now().'.xlsx');
    }
    //PurchaseExport
    public function purchase_over_all(){
        return Excel::download(new PurchaseExport(),Carbon::now().'.xlsx');
    }

    public function expense_over_all(){
        return Excel::download(new ExpenseExport(),Carbon::now().'.xlsx');
    }
    public function expense_weekly($from,$to){
        return Excel::download(new WeeklyExpense($from,$to),Carbon::now().'.xlsx');
    }
    public function expense_monthly($id){
        return Excel::download(new monthlyExpense($id),Carbon::now().'.xlsx');
    }

    //Page Load function
    public function Sales_index(){
        return view('admin.reports.Sales')
                ->with('pageName', 'Sales Report');
    }
    public function Purchase_index(){
        return view('admin.reports.purchase')
                ->with('pageName','Purchase Report');
    }
    public function Expense_index(){
        return view('admin.reports.exportExpense')
                ->with('pageName','Expense Report');
    }
}
