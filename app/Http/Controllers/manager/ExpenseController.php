<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Models\Branch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    //Expense information added here
    function resourceUrl():string{
        return "manager.expense";
    }
    function modelIns(): Branch{
        return new Branch();
    }
    function userBranch():string{
        return Auth::guard('employee')->user()->branch_id;
    }
    //
     //
     public function index(Request $request){
        if($request->ajax()){
            $data = $this->modelIns()::get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('branch', function($row){
                        return HelperController::BranchName($row->center);
                    })
                    ->addColumn('month',function($row){
                        return $row->month;
                    })
                    ->addColumn('expense',function($row){
                       return  $row->expense_name;
                    })
                    ->addColumn('amount',function($row){
                       return $row->amount;
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
        $branches = Branch::where('id',$this->userBranch())->get();
        return view('manager.expense.createExpense',compact('branches'))
                ->with('pageName', 'Create Expense')
                ->with('id','')
                ->with('resourceUrl',$this->resourceUrl()); 
    }
    public function edit($id){
        $branches = Branch::where('id',$this->userBranch())->get();
        $expense = $this->modelIns()::find($id);
        return view('manager.expense.createExpense',compact('branches','expense'))
        ->with('pageName', 'Edit Branch')
        ->with('id',$id)
        ->with('resourceUrl',$this->resourceUrl()); 
    }
    public function store(Request $request){
        $validate = $request->validate([
            'name' => ['required'],
            'branch' => ['required'],
            'month' => ['required'],
            'amount' => ['required'],
        ]);
        if($validate){
            
            if($request->id != null){
                $data = [
                    'month' => $request->month,
                    'center' => $request->branch,
                    'expense_name' => $request->name,
                    'amount' => $request->amount,
                    'comment' => $request->comment,
                    'updated_by' => Auth::guard('employee')->user()->id,
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
                    info('expenses-update-error:'.$th->getMessage());
                }
            }else if($request->id == null || $request->id == ''){
                $data = [
                    'month' => $request->month,
                    'center' => $request->branch,
                    'expense_name' => $request->name,
                    'amount' => $request->amount,
                    'comment' => $request->comment,
                    'created_by' => Auth::guard('employee')->user()->id,
                    'created_at' => Carbon::now()
                ];
                try {
                    $res = $this->modelIns()::insert($data);
                if($res){
                    return redirect()->route($this->resourceUrl().'.index')->with('success','expenses saved successfully...!!!');
                }else{
                    return redirect()->route($this->resourceUrl().'.index')->with('error','Error saving expenses...!!!');
                }
                } catch (Exception $th) {
                    info('expenses-saving-error:'.$th->getMessage());
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
            info('expenses-delete-error:'.$th->getMessage());
        }
    }

}
