<?php

namespace App\Http\Controllers;

use App\Models\Tyre;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        $tyre = Tyre::where('status','1')->take(4)->get();
        return view('website.home',compact('tyre'));
    }
}
