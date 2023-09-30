<?php

namespace App\Http\Controllers;

use App\Models\manufacturers;
use Illuminate\Http\Request;

class WheelController extends Controller
{
    //
    public function index(){
        $url =asset('assets/css/front/page-title/top_bg.jpg');
        $make = manufacturers::all();
        $pageName = "WHEELS";
        return view('website.wheelPage',compact('make'))
        ->with('url',$url)
        ->with('pageName',$pageName);
    }
}
