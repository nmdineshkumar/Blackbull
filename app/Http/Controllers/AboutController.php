<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    //
    public function index(){
        $url =asset('assets/css/front/page-title/top_bg.jpg');
        $pageName = "About Us";
        return view('website.aboutUs')
        ->with('url',$url)
        ->with('pageName',$pageName);
    }
}
