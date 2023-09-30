<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TyreController extends Controller
{
    //
    public function index(){
        $url =asset('assets/css/front/page-title/top_bg.jpg');
        $pageName = "Tyres";
        $make = DB::select('SELECT m.id,m.name,count(C.id) as countNo FROM `cars_datas` C
                            inner join manufacturers m on m.id = C.maker
                            GROUP BY(m.id);');
        return view('website.tyrePage', compact('make'))
        ->with('url',$url)
        ->with('pageName',$pageName);
    }
}
