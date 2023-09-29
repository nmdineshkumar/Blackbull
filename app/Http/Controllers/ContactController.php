<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function index(){
        $url = asset('assets/css/front/page-title/top_bg.jpg');
        $pageName = "Contact US";
        return view('website.contactUs')
            ->with('url',$url)
            ->with('pageName',$pageName);
    }
}
