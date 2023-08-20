<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
   //
   function resourceUrl():string{
    return "admin.category";
}
function modelIns(): category{
    return new category;
}
public function index(Request $request){
    if($request->ajax()) {
        $data = $this->modelIns()::all();
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function($row){
                    return "<a href='" .route($this->resourceUrl().'.edit',$row->id) ."'>$row->name</a>";
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
                ->rawColumns(['name','action'])
                ->make(true);

    }else{
        return view('admin.category.indexCategory')
                ->with('pageName','Category')
                ->with('resourceUrl',$this->resourceUrl());
    }
}
public function create(){
    return view('admin.category.editCategory')
            ->with('pageName', 'Create Category')
            ->with('id','')
            ->with('resourceUrl',$this->resourceUrl());
}
public function edit($id){
    $category = $this->modelIns()::find($id);
    return view('admin.category.editCategory',compact('category'))
    ->with('pageName', 'Edit Category')
    ->with('id',$id)
    ->with('resourceUrl',$this->resourceUrl()); 
}
public function store(Request $request){
    $validate = $request->validate([
        'name' => ['required','unique:categories,name,'.$request->id.',id'],
    ]);
    if($validate){
        if($request->id == '' || $request->id == null){
            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'created_by' => Auth::guard('admin')->user()->id,
                'created_at' => Carbon::now()
            ];
            try {
                $res = $this->modelIns()::insert($data);
            if($res){
                return redirect()->route($this->resourceUrl().'.index')->with('success','Category saved successfully...!!!');
            }else{
                return redirect()->route($this->resourceUrl().'.index')->with('error','Error saving Category...!!!');
            }
            } catch (Exception $th) {
                info('Category-saving-error:'.$th->getMessage());
            }
        }else{
            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'updated_by' => Auth::guard('admin')->user()->id,
                'updated_at' => Carbon::now()
            ];
            try {                    
                $res = $this->modelIns()::whereId($request->id)->update($data);
                if($res){
                    return redirect()->route($this->resourceUrl().'.index')->with('success','Category updated successfully...!!!');
                }else{
                    return redirect()->route($this->resourceUrl().'.index')->with('error','Error updating Category...!!!');
                }
                } catch (Exception $th) {
                    info('Category-update-error:'.$th->getMessage());
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
        info('Category-delete-error:'.$th->getMessage());
    }
}
}
