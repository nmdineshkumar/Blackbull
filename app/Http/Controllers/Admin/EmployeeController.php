<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class EmployeeController extends Controller
{
    //
    function resourceUrl(): string
    {
        return "admin.employee";
    }
    function modelIns(): Employee
    {
        return new Employee();
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->modelIns()::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return "<a href='" . route($this->resourceUrl() . '.edit', $row->id) . "'>$row->first_name</a>";
                })
                ->addColumn('branch',function($row){
                    return HelperController::BranchName($row->branch_id);
                })
                ->addColumn('email',function($row){
                    return $row->email;
                })
                ->addColumn('mobile',function($row){
                    return $row->mobile;
                })
                ->addColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->format('d-m-Y');
                })
                ->addColumn('action', function ($row) {
                    if ($row->deleted_at === NULL) {
                        return getActionButtons($row->id, $this->resourceUrl(), ['edit', 'delete']);
                    } else {
                        return getActionButtons($row->id, $this->resourceUrl(), ['retrieve']);
                    }
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
        } else {
            return view('admin.employee.indexEmployee')
                ->with('pageName', 'Employee')
                ->with('resourceUrl', $this->resourceUrl());
        }
    }
    public function create()
    {
        $department = Department::all();
        $branch = Branch::all();
        return view('admin.employee.editEmployee',compact('branch','department'))
            ->with('pageName', 'Create Employee')
            ->with('id', '')
            ->with('resourceUrl', $this->resourceUrl());
    }
    public function edit($id)
    {
        $department = Department::all();
        $branch = Branch::all();
        $employee = $this->modelIns()::find($id);
        return view('admin.employee.editEmployee', compact('employee','branch','department'))
            ->with('pageName', 'Edit Employee')
            ->with('id', $id)
            ->with('resourceUrl', $this->resourceUrl());
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required'],
            'last_name' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'branch_id' => 'required',
            'password' => 'required',
            'department_id' => 'required'
            
        ]);
        if ($validate) {
            if ($request->id == '' || $request->id == null) {
                $data = [
                    'first_name' => $request->name,
                    'last_name' => $request->last_name,
                    'department_id' => $request->department_id,
                    'branch_id' => $request->branch_id,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'password' => bcrypt($request->password),
                    'created_by' => Auth::guard('admin')->user()->id,
                    'created_at' => Carbon::now()
                ];
                try {
                    $res = $this->modelIns()::insert($data);
                    if ($res) {
                        return redirect()->route($this->resourceUrl() . '.index')->with('success', 'Employee saved successfully...!!!');
                    } else {
                        return redirect()->route($this->resourceUrl() . '.index')->with('error', 'Error saving Employee...!!!');
                    }
                } catch (Exception $th) {
                    info('Employee-saving-error:' . $th->getMessage());
                }
            } else {
                $data = [
                    'first_name' => $request->name,
                    'last_name' => $request->last_name,
                    'department_id' => $request->department_id,
                    'branch_id' => $request->branch_id,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'password' => bcrypt($request->password),
                    'updated_by' => Auth::guard('admin')->user()->id,
                    'updated_at' => Carbon::now()
                ];
                try {
                    $res = $this->modelIns()::whereId($request->id)->update($data);
                    if ($res) {
                        return redirect()->route($this->resourceUrl() . '.index')->with('success', 'Employee updated successfully...!!!');
                    } else {
                        return redirect()->route($this->resourceUrl() . '.index')->with('error', 'Error updating Employee...!!!');
                    }
                } catch (Exception $th) {
                    info('Employee-update-error:' . $th->getMessage());
                }
            }
        }
    }
    public function destroy($id)
    {
        try {
            $res = $this->modelIns()::destroy($id);
            if ($res) {
                return response()->json(['str' => 1]);
            } else {
                return response()->json(['str' => 0]);
            }
        } catch (Exception $th) {
            info('Employee-delete-error:' . $th->getMessage());
        }
    }
}
