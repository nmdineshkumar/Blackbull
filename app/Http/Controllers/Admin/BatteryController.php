<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car_battery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BatteryController extends Controller
{
    //
    function resourceUrl():string{
        return "admin.battery";
    }
    function modelIns(): Car_battery{
        return new Car_battery;
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
                    ->addColumn('model',function($row){
                        return $row->model_number;
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
            return view('admin.battery.indexBattery')
                    ->with('pageName','Tube')
                    ->with('resourceUrl',$this->resourceUrl());
        }
    }
    
    public function getBrand($id){
        return DB::table('brand')->where('id',$id)->get(['name'])->pluck('name')->first();
    }
   
    public function create(){
        $brand_dataset = DB::table('brand')->get(['id','name']);
        return view('admin.battery.editBattery',compact('brand_dataset'))
                ->with('pageName', 'Create Battery')
                ->with('id','')
                ->with('resourceUrl',$this->resourceUrl());
    }
    public function edit($id){
        $brand_dataset = DB::table('brand')->get(['id','name']);
        $battery = $this->modelIns()::find($id);
        return view('admin.battery.editBattery',compact('battery','brand_dataset'))
        ->with('pageName', 'Edit Battery')
        ->with('id',$id)
        ->with('resourceUrl',$this->resourceUrl()); 
    }
    public function store(Request $request){
        $validate = $request->validate([
            'name' => ['required','unique:tyres,name,'.$request->id.',id'],
            'brand' => ['required'],
            'capacity' => ['required'],
            //'wyear' => ['required'],
            //'sku' => ['required','unique:tyres,sku,'.$request->id.',id'],
            //'image' => ['required'],
            'price' => ['required'],
            //'description' => ['required'],
        ]);
        if($validate){
            if($request->id == '' || $request->id == null){
               
                $data = [
                    'name' => $request->name,
                    'brand' => $request->brand,
                    'capacity' => $request->capacity,
                    'warranty_year' => $request->wyear == null ? "0" : $request->wyear,
                    'sku' => $request->sku == null ? "-" : $request->sku,
                    'description' => $request->description,
                    'image' => $request->image,
                    'voltage' =>  $request->voltage,
                    'model_number' => $request->model_number,
                    'price' => $request->price,
                    'status' => $request->visible_status,
                    'created_by' => Auth::guard('admin')->user()->id,
                    'created_at' => Carbon::now()
                ];
                try {
                    $res = $this->modelIns()::insert($data);
                if($res){
                    return redirect()->route($this->resourceUrl().'.index')->with('success','Battery Product saved successfully...!!!');
                }else{
                    return redirect()->route($this->resourceUrl().'.index')->with('error','Error saving Battery Product...!!!');
                }
                } catch (Exception $th) {
                    info('Battery-Product-saving-error:'.$th->getMessage());
                }
            }else{
                $data = [
                    'name' => $request->name,
                    'brand' => $request->brand,
                    'capacity' => $request->capacity,
                    'warranty_year' => $request->wyear,
                    'sku' => $request->sku,
                    'description' => $request->description,
                    'image' => $request->image,
                    'voltage' =>  $request->voltage,
                    'model_number' => $request->model_number,
                    'price' => $request->price,
                    'status' => $request->visible_status,
                    'updated_by' => Auth::guard('admin')->user()->id,
                    'created_at' => Carbon::now()
                ];
                try {                    
                    $res = $this->modelIns()::whereId($request->id)->update($data);
                   
                    if($res){
                        return redirect()->route($this->resourceUrl().'.index')->with('success','Battery Product updated successfully...!!!');
                    }else{
                        return redirect()->route($this->resourceUrl().'.index')->with('error','Error updating Battery Product...!!!');
                    }
                    } catch (Exception $th) {
                        info('Battery-Product-update-error:'.$th->getMessage());
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
            info('Battery-delete-error:'.$th->getMessage());
        }
    }
}
