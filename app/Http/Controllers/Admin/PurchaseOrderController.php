<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use Carbon\Carbon;
use Exception;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PurchaseOrderController extends Controller
{
    //
    function resourceUrl():string{
        return "admin.purchase";
    }
    function modelIns(): PurchaseOrder{
        return new PurchaseOrder;
    }
    public function index(Request $request){
        if($request->ajax()) {
            $data = $this->modelIns()::all();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function($row){
                        return "<a href='" .route($this->resourceUrl().'.edit',$row->id) ."'>$row->name</a>";
                    })
                    ->addColumn('path',function($row){
                        return "<img src=".getS3FullUrl("/manufacturers/". $row->path). " alt='' style='Height:50px' />";
                    })
                    ->addColumn('created_at',function($row){
                        return $row->created_at;
                    })
                    ->addColumn('action', function($row){
                        if($row->deleted_at=== NULL){
                            return getActionButtons($row->id, $this->resourceUrl(),['edit','delete']);
                        }else{
                            return getActionButtons($row->id, $this->resourceUrl(),['retrieve']);
                        }
                    })
                    ->rawColumns(['name','action','path'])
                    ->make(true);
    
        }else{
            return view('admin.purchseOrder.indexPurchaseOrder')
                    ->with('pageName','Manufacture')
                    ->with('resourceUrl',$this->resourceUrl());
        }
    }
    public function create(){
        return view('admin.purchseOrder.editPurchaseOrder')
                ->with('pageName', 'Create Purchase Order')
                ->with('id','')
                ->with('resourceUrl',$this->resourceUrl());
    }
    public function edit($id){
        $purchase = $this->modelIns()::find($id);
        return view('admin.purchseOrder.editPurchaseOrder',compact('purchase'))
        ->with('pageName', 'Edit Manufacturer')
        ->with('id',$id)
        ->with('resourceUrl',$this->resourceUrl()); 
    }
    public function store(Request $request){
        $validate = $request->validate([
            'name' => ['required','unique:manufacturers,name,'.$request->id.',id'],
            'image' => ['required'],
            'statues' => ['required']
        ]);
        if($validate){
            if($request->id == '' || $request->id == null){
                $data = [
                    'name' => $request->name,
                    'path' => $request->image,
                    'status' => $request->statues,
                    'created_by' => Auth::guard('admin')->user()->id,
                    'created_at' => Carbon::now()
                ];
                try {
                    $res = $this->modelIns()::insert($data);
                if($res){
                    return redirect()->route($this->resourceUrl().'.index')->with('success','Manufacture saved successfully...!!!');
                }else{
                    return redirect()->route($this->resourceUrl().'.index')->with('error','Error saving Manufacture...!!!');
                }
                } catch (Exception $th) {
                    info('Manufacture-saving-error:'.$th->getMessage());
                }
            }else{
                $data = [
                    'name' => $request->name,
                    'path' => $request->image,
                    'status' => $request->statues,
                    'updated_by' => Auth::guard('admin')->user()->id,
                    'updated_at' => Carbon::now()
                ];
                try {                    
                    $res = $this->modelIns()::whereId($request->id)->update($data);
                    if($res){
                        return redirect()->route($this->resourceUrl().'.index')->with('success','Manufacture updated successfully...!!!');
                    }else{
                        return redirect()->route($this->resourceUrl().'.index')->with('error','Error updating Manufacture...!!!');
                    }
                    } catch (Exception $th) {
                        info('Manufacture-update-error:'.$th->getMessage());
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
            info('Manufacture-delete-error:'.$th->getMessage());
        }
    }
}
