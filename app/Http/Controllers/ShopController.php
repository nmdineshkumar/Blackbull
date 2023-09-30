<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    //
    public function index(){
        $url =asset('assets/css/front/page-title/top_bg.jpg');
        $pageName = "SHOP";
        return view('website.shopPage')
        ->with('url',$url)
        ->with('pageName',$pageName);
    }
}
