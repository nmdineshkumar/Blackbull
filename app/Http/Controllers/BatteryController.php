<?php

namespace App\Http\Controllers;

use App\Models\Car_battery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BatteryController extends Controller
{
    //
    public function index(){
        $url =asset('assets/css/front/page-title/top_bg.jpg');
        $pageName = "BATTERY";
        $make = DB::select('SELECT b.id,b.name,count(cb.id) as countNo FROM `car_batteries` cb
                        inner join brand b on b.id = cb.brand
                        GROUP BY(cb.brand);');
        $battery = Car_battery::paginate(20);
        return view('website.battery',compact('make','battery'))
        ->with('url',$url)
        ->with('pageName',$pageName);
    }
    public function ProductDetail($id){
        $id = base64_decode($id);
        $url =asset('assets/css/front/page-title/top_bg.jpg');
        $product = Car_battery::find($id);
        $pageName = $product->name;
        $battery = Car_battery::take(4)->get();
        return view('website.battery.productDetails', compact('battery','product'))
        ->with('url',$url)
        ->with('pageName',$pageName);
    }
    public function ProductSearch(Request $request){
        $url =asset('assets/css/front/page-title/top_bg.jpg');
        $pageName = "Tyres Search";
        $make = DB::select('SELECT b.id,b.name,count(t.id) as countNo FROM `tubes` t
                    inner join brand b on b.id = t.brand
                    GROUP BY(t.id);');
        $battery = Car_battery::join('brand','brand.id','car_batteries.brand')
                ->orWhere('car_batteries.capacity',$request->capacity)
                ->Where('brand.id',$request->maker)
                ->paginate(20);
        return view('website.battery.productSearch', compact('make','battery'))
        ->with('url',$url)
        ->with('pageName',$pageName);
    }
}
