<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\manufacturers;
use App\Models\Tyre;
use App\Models\Tyresize;
use Exception;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class TyreController extends Controller
{
    //
    function resourceUrl():string{
        return "admin.tyre";
    }
    function modelIns(): Tyre{
        return new Tyre;
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
                        return $row->origin;
                    })
                    ->addColumn('manufactory_year',function($row){
                        return $row->manufactory_year;
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
            return view('admin.tyre.indexTyre')
                    ->with('pageName','Tyre Size')
                    ->with('resourceUrl',$this->resourceUrl());
        }
    }
    public function getBrand($id){
        return DB::table('brand')->where('id',$id)->get(['name'])->pluck();
    }
    public function create(){
        $brand_dataset = DB::table('brand')->get(['id','name']);
        $pattern_dataset = DB::table('pattern')->get(['id','name']);
        $origin_dataset = DB::table('origin')->get(['id','name']);
        $make_dataset = manufacturers::get(['id','name']);   
        $tyre_size_dataset = Tyresize::get(['id',"height","width","rim_size","speed"]); 
        //return $tyre_size_dataset; 
        return view('admin.tyre.editTyre',compact('brand_dataset'
                                            ,'pattern_dataset','origin_dataset'
                                            ,'make_dataset','tyre_size_dataset'))
                ->with('pageName', 'Create Tyre')
                ->with('id','')
                ->with('resourceUrl',$this->resourceUrl());
    }
    public function edit($id){
        $tyre = $this->modelIns()::find($id);
        return view('admin.tyre.editTyre',compact('tyre'))
        ->with('pageName', 'Edit Tyre')
        ->with('id',$id)
        ->with('resourceUrl',$this->resourceUrl()); 
    }
    public function store(Request $request){
        $validate = $request->validate([
            'height' =>['required'],
            'width' =>['required'],
            'rimsize' =>['required'],
        ]);
        if($validate){
            if($request->id == '' || $request->id == null){
                $data = [
                    'height' => $request->height,
                    'width' => $request->width,
                    'rim_size' => $request->rimsize,
                    'speed' => $request->speed,
                    'description' => $request->description,
                    'created_by' => Auth::guard('admin')->user()->id,
                    'created_at' => Carbon::now()
                ];
                try {
                    $res = $this->modelIns()::insert($data);
                if($res){
                    return redirect()->route($this->resourceUrl().'.index')->with('success','Tyre Size saved successfully...!!!');
                }else{
                    return redirect()->route($this->resourceUrl().'.index')->with('error','Error saving Tyre Size...!!!');
                }
                } catch (Exception $th) {
                    info('Tyre-Size-saving-error:'.$th->getMessage());
                }
            }else{
                $data = [
                    'height' => $request->height,
                    'width' => $request->width,
                    'rim_size' => $request->rimsize,
                    'speed' => $request->speed,
                    'description' => $request->description,
                    'updated_by' => Auth::guard('admin')->user()->id,
                    'updated_at' => Carbon::now()
                ];
                try {                    
                    $res = $this->modelIns()::whereId($request->id)->update($data);
                    if($res){
                        return redirect()->route($this->resourceUrl().'.index')->with('success','Tyre updated successfully...!!!');
                    }else{
                        return redirect()->route($this->resourceUrl().'.index')->with('error','Error updating Tyre Size...!!!');
                    }
                    } catch (Exception $th) {
                        info('Tyre-update-error:'.$th->getMessage());
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
