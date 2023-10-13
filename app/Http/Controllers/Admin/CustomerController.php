<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Models\customer;
use Carbon\Carbon;
use Exception;
use DataTables;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    function resourceUrl():string{
        return "admin.customer";
    }
    function modelIns(): customer{
        return new customer;
    }

    //
    public function index(Request $request){
        if($request->ajax()){
            $data = $this->modelIns()::get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function($row){
                        return "<a href='" .route($this->resourceUrl().'.edit',$row->id) ."'>$row->first_name $row->last_name </a>";
                    })
                    ->addColumn('Country',function($row){
                        return HelperController::getCountryName($row->country);
                    })
                    ->addColumn('Email',function($row){
                        return $row->email;
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
            return view('admin.customer.indexCustomer')
                    ->with('pageName', 'Customer')
                    ->with('resourceUrl',$this->resourceUrl());
        }
    }
    public function create(){
        return view('admin.customer.editCustomer')
                ->with('pageName', 'Create Customer')
                ->with('id','')
                ->with('type','')
                ->with('resourceUrl',$this->resourceUrl());
    }
    public function edit($id){
        $customer = $this->modelIns()::find($id);
        return view('admin.customer.editCustomer',compact('customer'))
        ->with('pageName', 'Edit Customer')
        ->with('id',$id)
        ->with('resourceUrl',$this->resourceUrl());
    }
    public function store(Request $request){
        $validate = $request->validate([
            'first_name' => ['required',],
            'phone' => ['required','unique:customers,phone,'.$request->id.',id'],
            'email' => ['required','unique:customers,email,'.$request->id.',id'],
            // 'address1' => ['required'],
            // 'country' => ['required'],
            // 'state' => ['required'],
            // 'city' => ['required'],
            'zip' => ['required'],
            'type' => ['required']]);
        if($validate){ 
            if($request->id != null){
                $data = [
                    'first_name' => $request->first_name,
                    'type' => $request->type,
                    'last_name' => $request->last_name,
                    'address1' => $request->address1,
                    'address2' => $request->address2,
                    'country' => $request->country,
                    'state' => $request->state,
                    'city' => $request->city,
                    'zip' => $request->zip,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'updated_at' => Carbon::now()
                ];
                try {
                $res = $this->modelIns()::whereId($request->id)->update($data);
                if($res){
                    if($request->ajax()){
                        $customer = customer::all(['id','name']);
                        return back()
                               ->with('success','Customer updated successfully...!!!')
                               ->with('customer',$customer);
                    }else{
                        return redirect()->route($this->resourceUrl().'.index')->with('success','Customer updated successfully...!!!');

                    }
                }else{
                    return redirect()->route($this->resourceUrl().'.index')->with('error','Error updating customer...!!!');
                }
                } catch (Exception $th) {
                    info('Customer-update-error:'.$th->getMessage());
                }
            }else if($request->id == null || $request->id == ''){
                $data = [
                    'first_name' => $request->first_name,
                    'type' => $request->type,
                    'last_name' => $request->last_name,
                    'address1' => $request->address1,
                    'address2' => $request->address2,
                    'country' => $request->country,
                    'state' => $request->state,
                    'city' => $request->city,
                    'zip' => $request->zip,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'password' => bcrypt('Password'),
                    'created_at' => Carbon::now()
                ];
                try {
                    $res = $this->modelIns()::insert($data);
                if($res){
                    return redirect()->route($this->resourceUrl().'.index')->with('success','Customer saved successfully...!!!');
                }else{
                    return redirect()->route($this->resourceUrl().'.index')->with('error','Error saving customer...!!!');
                }
                } catch (Exception $th) {
                    info('Customer-saving-error:'.$th->getMessage());
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
    public function GetCustomer($id){
        $customer = customer::where('id','=',$id)->get(['first_name','last_name','address1','address2']);
        return $customer;
    }
}
