<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tyresize;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;

class TyresizeController extends Controller
{
    //
    function resourceUrl():string{
        return "admin.tyresize";
    }
    function modelIns(): Tyresize{
        return new Tyresize;
    }
    public function index(Request $request){
        if($request->ajax()) {
            $data = $this->modelIns()::all();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function($row){
                        return "<a href='" .route($this->resourceUrl().'.edit',$row->id) ."'>$row->height / $row->width  R$row->rim_size  $row->speed</a>";
                    })
                    ->addColumn('height',function($row){
                        return $row->height;
                    })
                    ->addColumn('width',function($row){
                        return $row->width;
                    })
                    ->addColumn('rim_size',function($row){
                        return $row->rim_size;
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
            return view('admin.tyresize.indexTyresize')
                    ->with('pageName','Tyre Size')
                    ->with('resourceUrl',$this->resourceUrl());
        }
    }
    public function create(){
        $height = DB::table('tyre_heights')->get();
        $width = DB::table('tyre_profile')->get();
        $rimsize = DB::table('tyre_rim_size')->get();
       // return $height;
        return view('admin.tyresize.editTyresize',compact('height','width','rimsize'))
                ->with('pageName', 'Create Tyre Size')
                ->with('id','')
                ->with('resourceUrl',$this->resourceUrl());
    }
    public function edit($id){
        $height = DB::table('tyre_heights')->get();
        $width = DB::table('tyre_profile')->get();
        $rimsize = DB::table('tyre_rim_size')->get();
        $tyre_size = $this->modelIns()::find($id);
        return view('admin.tyresize.editTyresize',compact('tyre_size','height','width','rimsize'))
        ->with('pageName', 'Edit Tyre Size')
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
                        return redirect()->route($this->resourceUrl().'.index')->with('success','Tyre Size updated successfully...!!!');
                    }else{
                        return redirect()->route($this->resourceUrl().'.index')->with('error','Error updating Tyre Size...!!!');
                    }
                    } catch (Exception $th) {
                        info('Tyre-Size-update-error:'.$th->getMessage());
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
