<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\Productstock;
use App\Models\PurchaseItem;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Carbon\Carbon;
use Exception;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
                        return "<a href='" .route($this->resourceUrl().'.edit',$row->id) ."'>".$this->getSupplier($row->supplier)."</a>";
                    })                    
                    ->addColumn('date',function($row){
                        return Carbon::parse($row->invoice_date)->format('d-m-Y');
                    })
                    ->addColumn('amount',function($row){
                        return $row->invoice_amount;
                    })
                    ->addColumn('invoice',function($row){
                        return $row->invoice_no;
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
            return view('admin.purchseOrder.indexPurchaseOrder')
                    ->with('pageName','Manufacture')
                    ->with('resourceUrl',$this->resourceUrl());
        }
    }
    public function getSupplier($id){
        return Supplier::where('id',$id)->get('name')->pluck('name')->first();
    }
    public function create(){
        $category_dataset = category::get(['id','name']);
        $supplier_dataset = Supplier::get(['id','name']);
        return view('admin.purchseOrder.editPurchaseOrder',compact('category_dataset','supplier_dataset'))
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
            'supplier' => ['required',],
            'purchasetype' => ['required',],
            'invoiceno' => ['required','unique:purchase_orders,invoice_no,'.$request->id.',id'],
            'invoicedata' => ['required'],
            'product.*' => ['required']
        ]);
        if($validate){
            if($request->id == '' || $request->id == null){
                $purchase_order = [
                    'supplier' => $request->supplier,
                    'purchase_type'=>$request->purchasetype,
                    'total_amount' => $request->SubTotalAmount,
                    'total_qty' => '0',
                    'invoice_date' => Carbon::parse($request->invoicedata),
                    'invoice_amount' => $request->TotalAmount,
                    'invoice_no' => $request->invoiceno,
                    'image' => $request->image == '' ? '/' : $request->image,
                    'created_by' => Auth::guard('admin')->user()->id,
                    'created_at' => Carbon::now()
                ];
                try {
                    $PO_id = $this->modelIns()::insertGetId($purchase_order);
                    for($i = 0; $i<count($request->product); $i++){
                        $product_items =[
                            'category_id' => $request->category[$i],
                            'purchase_id' => $PO_id,
                            'product_id' => $request->product[$i],
                            'quantity' => $request->qty[$i],
                            'amount' => $request->price[$i],
                            'total_amount' => $request->total[$i],
                            'created_at' => Carbon::now()
                        ];
                        $res = PurchaseItem::insert($product_items);
                        $result = Productstock::where(['product_id' => $request->product[$i],
                                                        'category' => $request->category[$i]])->exists();
                        if(!$result){
                            $product_stock =[
                                'category' => $request->category[$i],
                                'product_id' => $request->product[$i],
                                'current_qty' => $request->qty[$i],
                                'old_qty'=>'0',
                                'overall_qty' => '0',
                                'online_purchases' => '0',
                                'offline_purchases' => '0',
                                'created_at' => Carbon::now()
                            ];
                            Productstock::insert($product_stock);
                        }else{
                          
                          DB::Table('productstocks')
                                ->where(['product_id' => $request->product[$i],
                                        'category' => $request->category[$i]])
                                ->increment('overall_qty' , $request->qty[$i]);
                                DB::Table('productstocks')
                                ->where(['product_id' => $request->product[$i],
                                        'category' => $request->category[$i]])
                                ->increment('current_qty' , $request->qty[$i]);
                                
                                
                        }
                        
                    }
                if($res){
                    return redirect()->route($this->resourceUrl().'.index')->with('success','Purchase Order saved successfully...!!!');
                }else{
                    return redirect()->route($this->resourceUrl().'.index')->with('error','Error saving Purchase Order...!!!');
                }
                } catch (Exception $th) {
                    info('Purchase Order-saving-error:'.$th->getMessage());
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
