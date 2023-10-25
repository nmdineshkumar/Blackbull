<?php

namespace App\Http\Controllers;

use App\Models\Tyre;
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
        $tyre = Tyre::paginate(20);
        $tyreheight = HelperController::Get_Filter_TyreHeight();
        return view('website.tyrePage', compact('make','tyre','tyreheight'))
        ->with('url',$url)
        ->with('pageName',$pageName);
    }
    public function ProductDetail($id){
        $id = base64_decode($id);
        $url =asset('assets/css/front/page-title/top_bg.jpg');
        $product = Tyre::find($id);
        $pageName = $product->name;
        $tyre = Tyre::take(4)->get();
        return view('website.tyre.productDetails', compact('tyre','product'))
        ->with('url',$url)
        ->with('pageName',$pageName);
    }
    public function ProductSearch(Request $request){
       // return $request;
        $url =asset('assets/css/front/page-title/top_bg.jpg');
        $pageName = "Tyres Search";
        $tyreheight = HelperController::Get_Filter_TyreHeight();
        $make = DB::select('SELECT m.id,m.name,count(C.id) as countNo FROM `cars_datas` C
                            inner join manufacturers m on m.id = C.maker
                            GROUP BY(m.id);');
        if($request->type == "model"){
            $tyre = Tyre::join('cars_datas','cars_datas.id','tyres.cars')
            ->orWhere('cars_datas.model',$request->model)
            ->orWhere('cars_datas.year',$request->year)
            ->orWhere('cars_datas.tyre_size',$request->size)
            ->orWhere('cars_datas.maker',$request->maker)
            ->paginate(20);
        }else{
            $tyre = Tyre::join('cars_datas','cars_datas.id','tyres.cars')
            ->join('tyresizes','cars_datas.tyre_size','tyresizes.id')
            ->Where('tyresizes.height',$request->height)
            ->Where('tyresizes.width',$request->width)
            ->Where('tyresizes.rim_size',$request->rim_size)
            ->paginate(20,array('tyres.id','tyres.name','tyres.image','cars_datas.tyre_size','tyres.price'));
        }
       // return $tyre;
        return view('website.tyre.productSearch', compact('make','tyre','tyreheight'))
        ->with('url',$url)
        ->with('pageName',$pageName);
    }
}
