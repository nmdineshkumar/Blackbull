<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sales extends Model
{
    use HasFactory;
    protected $table = 'invoice';
    public static function generateInvoiceNo(): String{
        $TempNo = DB::table('invoice')->orderBy('id','desc')->get('invoice_no')->first();
        $InvoiceNo = "";
        if($TempNo == ''){
            $InvoiceNo = Carbon::now()->format('Ymd').'0001';
        }else{
            $InvoiceNo = $TempNo->invoice_no + 1;
        }
        return $InvoiceNo;
    }
}
