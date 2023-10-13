<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Exception;

class SupplierController extends Controller
{
    //
    function resourceUrl():string{
        return "admin.supplier";
    }
    function modelIns(): Supplier{
        return new Supplier;
    }
    public function index(Request $request){
        if($request->ajax()) {
            $data = $this->modelIns()::all();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function($row){
                        return "<a href='" .route($this->resourceUrl().'.edit',$row->id) ."'>$row->name</a>";
                    })
                    ->addColumn('contact_name',function($row){
                        return $row->contact_name;
                    })
                    ->addColumn('phone',function($row){
                        return $row->phone;
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
            return view('admin.supplier.indexSupplier')
                    ->with('pageName','Supplier')
                    ->with('resourceUrl',$this->resourceUrl());
        }
    }
    public function create(){
        return view('admin.supplier.editSupplier')
                ->with('pageName', 'Create Supplier')
                ->with('id','')
                ->with('resourceUrl',$this->resourceUrl());
    }
    public function edit($id){
        $supplier = $this->modelIns()::find($id);
        return view('admin.supplier.editSupplier',compact('supplier'))
        ->with('pageName', 'Edit Branch')
        ->with('id',$id)
        ->with('resourceUrl',$this->resourceUrl()); 
    }
    public function store(Request $request){
        $validate = $request->validate([
            'name' => ['required','unique:suppliers,name,'.$request->id.',id'],
            // 'address1' => ['required'],
            // 'address2' => ['required'],
            // 'pincode' => ['required'],
            // 'phone' => ['required'],
            // 'email' => ['required'],
            // 'contact_name' => ['required'],
            // 'contact_email' => ['required'],
            // 'contact_phone' => ['required'],
        ]);
        if($validate){
            if($request->id == '' || $request->id == null){
                $data = [
                    'name' => $request->name,
                    'address1' => $request->address1,
                    'address2' => $request->address2,
                    'pincode' => $request->pincode,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'contact_name' => $request->contact_name,
                    'contact_email' => $request->contact_email,
                    'contact_phone' => $request->contact_phone,
                    'created_at' => Carbon::now()
                ];
                try {
                    $res = $this->modelIns()::insert($data);
                if($res){
                    return redirect()->route($this->resourceUrl().'.index')->with('success','Supplier saved successfully...!!!');
                }else{
                    return redirect()->route($this->resourceUrl().'.index')->with('error','Error saving Supplier...!!!');
                }
                } catch (Exception $th) {
                    info('Supplier-saving-error:'.$th->getMessage());
                }
            }else{
                $data = [
                    'name' => $request->name,
                    'address1' => $request->address1,
                    'address2' => $request->address2,
                    'pincode' => $request->pincode,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'contact_name' => $request->contact_name,
                    'contact_email' => $request->contact_email,
                    'contact_phone' => $request->contact_phone,
                    'updated_at' => Carbon::now()
                ];
                try {                    
                    $res = $this->modelIns()::whereId($request->id)->update($data);
                    if($res){
                        return redirect()->route($this->resourceUrl().'.index')->with('success','Supplier updated successfully...!!!');
                    }else{
                        return redirect()->route($this->resourceUrl().'.index')->with('error','Error updating supplier...!!!');
                    }
                    } catch (Exception $th) {
                        info('Supplier-update-error:'.$th->getMessage());
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
            info('Branch-delete-error:'.$th->getMessage());
        }
    }
}
