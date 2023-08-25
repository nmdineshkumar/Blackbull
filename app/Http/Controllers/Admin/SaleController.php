<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\customer;
use App\Models\Sales;
use App\Models\Supplier;
use App\Models\Tyre;
use Carbon\Carbon;
use Exception;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    //
    function resourceUrl():string{
        return "admin.sales";
    }
    function modelIns(): Sales{
        return new Sales;
    }

    //
    public function index(Request $request){
        if($request->ajax()){
            $data = $this->modelIns()::get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function($row){
                        return "<a href='" .route($this->resourceUrl().'.edit',$row->id) ."'>$row->invoice_no</a>";
                    })
                    ->addColumn('type',function($row){
                        return purchase_type($row->type);
                    })
                    ->addColumn('date',function($row){
                        return Carbon::parse($row->invocie_date)->format('d-m-Y');
                    })
                    ->addColumn('amount',function($row){
                        return $row->total;
                    })
                    ->addColumn('customer',function($row){
                        return $this->getCustomer($row->customer);
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
            return view('admin.invoice.indexInvoice')
                    ->with('pageName', 'Invoice')
                    ->with('resourceUrl',$this->resourceUrl());
        }
    }
    public function getCustomer($id){
        return customer::where('id','=',$id)->get('name')->pluck('name')->first();
    }
    public function getPriceByProduct(Request $request){
        if($request->category == '1'){
            return Tyre::where(['id' => $request->id])->get('price')->first();
        }
    }
    public function create(){
        $category_dataset = category::all();
        $invoiceno = Sales::generateInvoiceNo();
        return view('admin.invoice.editInvoice',compact('category_dataset'))
                ->with('pageName', 'Create Invoice')
                ->with('invoiceno',$invoiceno)
                ->with('id','')
                ->with('resourceUrl',$this->resourceUrl());
    }
    public function edit($id){
        $sales = $this->modelIns()::find($id);
        return view('admin.branch.editBranch',compact('sales'))
        ->with('pageName', 'Edit Branch')
        ->with('id',$id)
        ->with('resourceUrl',$this->resourceUrl());
    }
    public function store(Request $request){
        $invoiceNo = Sales::generateInvoiceNo();
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
                    return redirect()->route($this->resourceUrl().'.index')->with('success','Invoice updated successfully...!!!');
                }else{
                    return redirect()->route($this->resourceUrl().'.index')->with('error','Error updating invoice...!!!');
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
                    return redirect()->route($this->resourceUrl().'.index')->with('success','Invoice saved successfully...!!!');
                }else{
                    return redirect()->route($this->resourceUrl().'.index')->with('error','Error saving invoice...!!!');
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
