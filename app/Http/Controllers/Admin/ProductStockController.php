<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Car_battery;
use App\Models\category;
use App\Models\Productstock;
use App\Models\Tube;
use App\Models\Tyre;
use Illuminate\Http\Request;
use DataTables;

class ProductStockController extends Controller
{
    //
    function resourceUrl():string{
        return "admin.productstock";
    }
    function modelIns(): Productstock{
        return new Productstock;
    }
    public function index(Request $request){
        if($request->ajax()) {
            $data = $this->modelIns()::all();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('Category',function($row){
                        return $this->getCategory($row->category);
                    })
                    ->addColumn('product', function($row){
                        return $this->getProduct($row->product_id,$row->category);
                    })                    
                    ->addColumn('current_qty',function($row){
                        return $row->current_qty;
                    })
                    ->addColumn('online',function($row){
                        return $row->online_purchases;
                    })
                    ->addColumn('offline',function($row){
                        return $row->offline_purchases;
                    })
                    ->addColumn('old_qty',function($row){
                        return $row->old_qty;
                    })
                    ->addColumn('branch',function($row){
                        return $this->getbranch($row->branch);
                    })
                    ->rawColumns(['category',])
                    ->make(true);
    
        }else{
            return view('admin.product.indexProductStock')
                    ->with('pageName','Product Stock')
                    ->with('resourceUrl',$this->resourceUrl());
        }
    }
    public function getbranch($id){
        return Branch::where('id','=',$id)->get('name')->pluck('name')->first();
    }
    public function getCategory($id){
        return category::where('id','=',$id)->get('name')->pluck('name')->first();
    }
    public function getProduct($id, $category){
        if($category == '1'){
            return Tyre::where('id','=',$id)->get('name')->pluck('name')->first();
        }else if($category == '2'){
            return Tube::where('id','=',$id)->get('name')->pluck('name')->first();
        }else if($category == '3'){
            return Car_battery::where('id','=',$id)->get('name')->pluck('name')->first();
        }
    }
}
