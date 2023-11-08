<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Quotation extends Model
{
    use HasFactory;
    public static function generateInvoiceNo(): String{
        $TempNo = DB::table('quotations')->orderBy('id','desc')->get('invoice_no')->first();
        $InvoiceNo = "";
        if($TempNo == ''){
            $InvoiceNo = 'QS-'.Carbon::now()->format('Ymd').'0001';
        }else{
            $InvoiceNo = 'QS-'.(explode('-',$TempNo->invoice_no)[1] + 1);
        }
        return $InvoiceNo;
    }
}
