<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Models\Branch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Exception;

class ExpenseController extends Controller
{
    //Expense information added here
    function resourceUrl():string{
        return "manager.expense";
    }
    function modelIns(): Branch{
        return new Branch();
    }

    //
    public function index(Request $request){
        if($request->ajax()){
            $data = $this->modelIns()::get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function($row){
                        return "<a href='" .route($this->resourceUrl().'.edit',$row->id) ."'>$row->name</a>";
                    })
                    ->addColumn('Country',function($row){
                        return HelperController::getCountryName($row->country);
                    })
                    ->addColumn('City',function($row){
                        return HelperController::getCityName($row->city);
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
            return view('manager.expense.indexExpense')
                    ->with('pageName', 'Expense')
                    ->with('resourceUrl',$this->resourceUrl());
        }
    }
    public function create(){
        return view('manager.expense.createExpense')
                ->with('pageName', 'Create Expense')
                ->with('id','')
                ->with('resourceUrl',$this->resourceUrl()); 
    }
    public function edit($id){
        $branches = $this->modelIns()::find($id);
        return view('manager.branch.editBranch',compact('branches'))
        ->with('pageName', 'Edit Branch')
        ->with('id',$id)
        ->with('resourceUrl',$this->resourceUrl()); 
    }
    public function store(Request $request){
        $validate = $request->validate([
            'name' => ['required','unique:branches,name,'.$request->id.',id'],
            'address1' => ['required'],
            'address2' => ['required'],
            'country' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
            'pincode' => ['required'],]);
        if($validate){
            
            if($request->id != null){
                $data = [
                    'name' => $request->name,
                    'address1' => $request->address1,
                    'address2' => $request->address2,
                    'country' => $request->country,
                    'state' => $request->state,
                    'city' => $request->city,
                    'pincode' => $request->pincode,
                    'comments' => $request->comments,
                    'updated_at' => Carbon::now()
                ];
                try {                    
                $res = $this->modelIns()::whereId($request->id)->update($data);
                if($res){
                    return redirect()->route($this->resourceUrl().'.index')->with('success','Branches updated successfully...!!!');
                }else{
                    return redirect()->route($this->resourceUrl().'.index')->with('error','Error updating branch...!!!');
                }
                } catch (Exception $th) {
                    info('Branch-update-error:'.$th->getMessage());
                }
            }else if($request->id == null || $request->id == ''){
                $data = [
                    'name' => $request->name,
                    'address1' => $request->address1,
                    'address2' => $request->address2,
                    'country' => $request->country,
                    'state' => $request->state,
                    'city' => $request->city,
                    'pincode' => $request->pincode,
                    'comments'=>$request->comments,
                    'created_at' => Carbon::now()
                ];
                try {
                    $res = $this->modelIns()::insert($data);
                if($res){
                    return redirect()->route($this->resourceUrl().'.index')->with('success','Branches saved successfully...!!!');
                }else{
                    return redirect()->route($this->resourceUrl().'.index')->with('error','Error saving branch...!!!');
                }
                } catch (Exception $th) {
                    info('Branch-saving-error:'.$th->getMessage());
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
