<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
     //
     function resourceUrl():string{
        return "admin.tube";
    }
    function modelIns(): Tube{
        return new Tube;
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
                        return $row->getVolve($row->volve);
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
        $brand_dataset = DB::table('brand')->get(['id','name']);
        $pattern_dataset = DB::table('pattern')->get(['id','name']);
        $origin_dataset = DB::table('origin')->get(['id','name']);
        $tyre_size_dataset = Tyresize::get(['id',"height","width","rim_size","speed"]); 
        //return $tyre_size_dataset; 
        return view('admin.tube.editTube',compact('brand_dataset'
                                            ,'pattern_dataset','origin_dataset'
                                            ,'tyre_size_dataset'))
                ->with('pageName', 'Create Tube')
                ->with('id','')
                ->with('resourceUrl',$this->resourceUrl());
    }
    public function edit($id){
        $brand_dataset = DB::table('brand')->get(['id','name']);
        $pattern_dataset = DB::table('pattern')->get(['id','name']);
        $origin_dataset = DB::table('origin')->get(['id','name']);
        $tyre_size_dataset = Tyresize::get(['id',"height","width","rim_size","speed"]); 
        $tyre = $this->modelIns()::find($id);
        return view('admin.tyre.editTyre',compact('tyre','brand_dataset'
                                            ,'pattern_dataset','origin_dataset'
                                            ,'tyre_size_dataset'))
        ->with('pageName', 'Edit Tube')
        ->with('id',$id)
        ->with('resourceUrl',$this->resourceUrl()); 
    }
    public function store(Request $request){
        $validate = $request->validate([
            'name' => ['required','unique:tyres,name,'.$request->id.',id'],
            'brand' => ['required'],
            'pattern' => ['required'],
            'type' => ['required'],
            'origin' => ['required'],
            'myear' => ['required'],
            'sku' => ['required','unique:tyres,sku,'.$request->id.',id'],
            'wyear' => ['required'],
            'make' => ['required'],
            'model' => ['required'],
            'year'  => ['required'],
            'fuel_type' => ['required'],
            'engine_type' => ['required'],
            'tyre_size' => ['required'],
            'image' => ['required'],
            'description' => ['required'],
        ]);
        if($validate){
            if($request->id == '' || $request->id == null){
               
                $data = [
                    'name' => $request->name,
                    'brand' => $request->brand,
                    'pattern' => $request->pattern,
                    'tyre_type' => $request->type,
                    'tyre_size' => $request->tyre_size,
                    'origin' => $request->origin,
                    'manufactory_year' => $request->myear,
                    'warranty_year' => $request->wyear,
                    'sku' => $request->sku,
                    'description' => $request->description,
                    'image' => $request->image,
                    'price' => '0.00',
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
                    'pattern' => $request->pattern,
                    'tyre_type' => $request->type,
                    'tyre_size' => $request->tyre_size,
                    'origin' => $request->origin,
                    'manufactory_year' => $request->myear,
                    'warranty_year' => $request->wyear,
                    'sku' => $request->sku,
                    'description' => $request->description,
                    'image' => $request->image,
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
