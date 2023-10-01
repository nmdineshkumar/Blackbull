<?php

namespace App\Http\Controllers;

use App\Models\manufacturers;
use App\Models\Tube;
use Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TubeController extends Controller
{
    //
    public function index(){
        $url =asset('assets/css/front/page-title/top_bg.jpg');
        $make = DB::select('SELECT b.id,b.name,count(t.id) as countNo FROM `tubes` t
                            inner join brand b on b.id = t.brand
                            GROUP BY(t.id);');
        $pageName = "TUBE";
        $tube = Tube::paginate(20);
        return view('website.tubePage',compact('make','tube'))
        ->with('url',$url)
        ->with('pageName',$pageName);
    }
    public function ProductDetail($id){
        $id = base64_decode($id);
        $url =asset('assets/css/front/page-title/top_bg.jpg');
        $product = Tube::find($id);
        $pageName = $product->name;
        $tube = Tube::take(4)->get();
        return view('website.tube.productDetails', compact('tube','product'))
        ->with('url',$url)
        ->with('pageName',$pageName);
    }
    public function ProductSearch(Request $request){
        $url =asset('assets/css/front/page-title/top_bg.jpg');
        $pageName = "Tyres Search";
        $make = DB::select('SELECT b.id,b.name,count(t.id) as countNo FROM `tubes` t
                    inner join brand b on b.id = t.brand
                    GROUP BY(t.id);');
        $tube = Tube::join('brand','brand.id','tubes.brand')
                ->join('origin','origin.id','tubes.origin')
                ->orWhere('tubes.manufacure_year',$request->year)
                ->orWhere('origin.id',$request->origin)
                ->orWhere('brand.id',$request->maker)
                ->paginate(20);
        return view('website.tube.productSearch', compact('make','tube'))
        ->with('url',$url)
        ->with('pageName',$pageName);
    }
}
