<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Models\Tube;
use App\Models\Tyresize;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TubeController extends Controller
{
    
     //
     function resourceUrl():string{
        return "admin.tube";
    }
    function modelIns(): Tube{
        return new Tube();
    }
    public function index(Request $request){
        if($request->ajax()) {
            $data = $this->modelIns()::all();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function($row){
                        return "<a href='" .route($this->resourceUrl().'.edit',$row->id) ."'>$row->name </a>";
                    })
                    ->addColumn('brand',function($row){
                        return $this->getBrand($row->brand);
                    })
                    ->addColumn('origin',function($row){
                        return $this->getOrigin($row->origin);
                    })
                    ->addColumn('volve',function($row){
                        return $this->getVolve($row->volve);
                    })
                    ->addColumn('height',function($row){
                        return HelperController::get_TubeHeight($row->height);
                    })
                    ->addColumn('rim_size',function($row){
                        return HelperController::get_RimSize($row->rim_size);
                    })
                    ->addColumn('price',function($row){
                        return number_format($row->price,2);
                    })
                    ->addColumn('action', function($row){
                        if($row->deleted_at=== NULL){
                            return getActionButtons($row->id, $this->resourceUrl(),['edit','delete']);
                        }else{
                            return getActionButtons($row->id, $this->resourceUrl(),['retrieve']);
                        }
                    })
                    ->rawColumns(['name','action'])
                    ->make(true);

        }else{
            return view('admin.tube.indexTube')
                    ->with('pageName','Tube')
                    ->with('resourceUrl',$this->resourceUrl());
        }
    }
    public function getVolve($id){
        return DB::table('tube_volve')->where('id',$id)->get(['name'])->pluck('name')->first();
    }
    public function getBrand($id){
        return DB::table('brand')->where('id',$id)->get(['name'])->pluck('name')->first();
    }
    public function getOrigin($id){
        return DB::table('origin')->where('id',$id)->get(['name'])->pluck('name')->first();
    }
    public function create(){
        $brand_dataset = DB::table('brand')->where('category','2')->get(['id','name']);
        $volve_dataset = DB::table('tube_volve')->get(['id','name']);
        $origin_dataset = DB::table('origin')->get(['id','name']);
        $tyre_size_dataset = Tyresize::get(['id',"height","width","rim_size","speed"]); 
        $tube_height = DB::table('tube_height')->get(['id','name']);
        $tube_rim_size = DB::table('tube_rim_size')->get(['id','name']);
        //return $tyre_size_dataset; 
        return view('admin.tube.editTube',compact('brand_dataset'
                                            ,'volve_dataset','origin_dataset'
                                            ,'tyre_size_dataset','tube_height','tube_rim_size'))
                ->with('pageName', 'Create Tube')
                ->with('id','')
                ->with('resourceUrl',$this->resourceUrl());
    }
    public function edit($id){
        $brand_dataset = DB::table('brand')->get(['id','name']);
        $origin_dataset = DB::table('origin')->get(['id','name']);
        $tyre_size_dataset = Tyresize::get(['id',"height","width","rim_size","speed"]); 
        $tube_height = DB::table('tube_height')->get(['id','name']);
        $tube_rim_size = DB::table('tube_rim_size')->get(['id','name']);
        $tube = $this->modelIns()::find($id);
        $volve_dataset = DB::table('tube_volve')->get(['id','name']);
        return view('admin.tube.editTube',compact('tube','brand_dataset'
                                            ,'origin_dataset','volve_dataset'
                                            ,'tyre_size_dataset','tube_height','tube_rim_size'))
        ->with('pageName', 'Edit Tube')
        ->with('id',$id)
        ->with('resourceUrl',$this->resourceUrl()); 
    }
    public function store(Request $request){
        $validate = $request->validate([
            'name' => ['required'],
            'brand' => ['required'],
            'origin' => ['required'],
            //'myear' => ['required'],
            //'sku' => ['required','unique:tyres,sku,'.$request->id.',id'],
            'volve' => ['required'],
            'height' => ['required'],
            'rim_size' => ['required'],
            //'image' => ['required'],
            //'description' => ['required'],
            'price' => ['required'],
            //'set_price' => ['required']
        ]);
        if($validate){
            if($request->id == '' || $request->id == null){
               
                $data = [
                    'name' => $request->name,
                    'brand' => $request->brand,
                    'origin' => $request->origin,
                    'manufacure_year' => $request->myear == null ? "-" : $request->myear,
                    'sku' => $request->sku == null ? "-" : $request->sku,
                    'description' => $request->description,
                    'image' => $request->image == null ? "-" : $request->image,
                    'height' =>  $request->height,
                    'rim_size' =>  $request->rim_size,
                    'volve' =>  $request->volve,
                    'price' => $request->price,
                    'set_price' => $request->set_price == null ? "0" : $request->set_price,
                    'status' => $request->visible_status,
                    'created_by' => Auth::guard('admin')->user()->id,
                    'created_at' => Carbon::now()
                ];
                try {
                    $res = $this->modelIns()::insert($data);
                if($res){
                    return redirect()->route($this->resourceUrl().'.index')->with('success','Tyre Product saved successfully...!!!');
                }else{
                    return redirect()->route($this->resourceUrl().'.index')->with('error','Error saving Tyre Product...!!!');
                }
                } catch (Exception $th) {
                    info('Tyre-Product-saving-error:'.$th->getMessage());
                }
            }else{
                $data = [
                    'name' => $request->name,
                    'brand' => $request->brand,
                    'origin' => $request->origin,
                    'manufacure_year' =>  $request->myear == null ? "-" : $request->myear,
                    'sku' => $request->sku == null ? "-" : $request->sku,
                    'description' => $request->description,
                    'image' => $request->image == null ? "-" : $request->image,
                    'height' =>  $request->height,
                    'rim_size' =>  $request->rim_size,
                    'volve' =>  $request->volve,
                    'price' => $request->price,
                    'set_price' => $request->set_price == null ? "0" : $request->set_price,
                    'status' => $request->visible_status,
                    'created_by' => Auth::guard('admin')->user()->id,
                    'created_at' => Carbon::now()
                ];
                try {                    
                    $res = $this->modelIns()::whereId($request->id)->update($data);
                   
                    if($res){
                        return redirect()->route($this->resourceUrl().'.index')->with('success','Tyre Product updated successfully...!!!');
                    }else{
                        return redirect()->route($this->resourceUrl().'.index')->with('error','Error updating Tyre Product...!!!');
                    }
                    } catch (Exception $th) {
                        info('Tyre-Product-update-error:'.$th->getMessage());
                    }
            }
        }
    }
    public function destroy($id){
        try {
            $res = $this->modelIns()::destroy($id);
        if($res){
            return response()->json( [ 'str' => 1 ] );
        }else{
            return response()->json( [ 'str' => 0 ] );
        }
        } catch (Exception $th) {
            info('Tyre Size-delete-error:'.$th->getMessage());
        }
    }
}
