<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Car_battery;
use App\Models\category;
use App\Models\customer;
use App\Models\InvoiceItem;
use App\Models\Sales;
use App\Models\Supplier;
use App\Models\Tube;
use App\Models\Tyre;
use Carbon\Carbon;
use Exception;
use DataTables;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    //
    function resourceUrl():string{
        return "employee.sales";
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
                        return "<a target='_blank' href='" .route('getInvoice',$row->id) ."'>$row->invoice_no</a>";
                    })
                    ->addColumn('type',function($row){
                        return SaleTypeGetById($row->type);
                    })
                    ->addColumn('branch',function($row){
                        return $this->getbranch($row->branch);
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
            return view('employee.invoice.indexInvoice')
                    ->with('pageName', 'Invoice')
                    ->with('resourceUrl',$this->resourceUrl());
        }
    }
    public function getbranch($id){
        return Branch::where('id','=',$id)->get('name')->pluck('name')->first();
    }
    public function getCustomer($id){
        return customer::where('id','=',$id)->get('first_name')->pluck('first_name')->first();
    }
    public function getPriceByProduct(Request $request){
        if($request->category == '1'){
            return Tyre::where(['id' => $request->id])->get('price')->first();
        }else if($request->category == '2'){
            return Tube::where(['id' => $request->id])->get('price')->first();
        }else if($request->category == '3'){
            return Car_battery::where(['id' => $request->id])->get('price')->first();
        }
    }
    public function create(){
        $category_dataset = category::all();
        $customer = customer::all();
        $branch_dataset = Branch::all();
        $invoiceno = '#';
        return view('employee.invoice.editInvoice',compact('category_dataset','customer','branch_dataset'))
                ->with('pageName', 'Create Invoice')
                ->with('invoiceno',$invoiceno)
                ->with('id','')
                ->with('resourceUrl',$this->resourceUrl());
    }
    public function edit($id){
        $sales = $this->modelIns()::find($id);
        return view('employee.branch.editBranch',compact('sales'))
        ->with('pageName', 'Edit Branch')
        ->with('id',$id)
        ->with('resourceUrl',$this->resourceUrl());
    }
    public function store(Request $request){
        $validate = $request->validate([
                'branch' => ['required'],
                'customer' => ['required'],
                'TotalAmount' => ['required','numeric','min:10'],
                'SubTotalAmount' => ['required','numeric','min:10'],
                'category.*' => ['required'],
                'product.*' => ['required'],
                'qty.*' => ['required','numeric','min:1'],
                'price.*' => ['required','numeric','min:10'],
                'toa.*' => ['required','numeric','min:10'],
                'paidAmount' => ['required'],
            ]);
        if($validate){
            $invoiceNo = Sales::generateInvoiceNo();
            if($request->id != null){
                $invoice_data = [
                    'branch' => $request->branch,
                    'type' => $request->type,
                    'customer' => $request->customer,
                    'invoice_no' => $invoiceNo,
                    'invocie_date' => Carbon::now(),
                    'tax' => $request->tax,
                    'total' => $request->TotalAmount,
                    'paid_amount' => $request->paidAmount,
                    'due_amount' => ($request->TotalAmount - $request->paidAmount),
                    'created_by' => Auth::guard('employee')->user()->id,
                    'created_at' => Carbon::now(),
                ];
                try {
                $res = $this->modelIns()::whereId($request->id)->update($data);
                if($res){
                    return redirect()->route($this->resourceUrl().'.index')->with('success','Invoice updated successfully...!!!');
                }else{
                    return redirect()->route($this->resourceUrl().'.index')->with('error','Error updating invoice...!!!');
                }
                } catch (Exception $th) {
                    info('Invoice-update-error:'.$th->getMessage());
                }
            }else if($request->id == null || $request->id == ''){
                $invoice_data = [
                    'branch' => $request->branch,
                    'type' => $request->type,
                    'customer' => $request->customer,
                    'invoice_no' => $invoiceNo,
                    'invocie_date' => Carbon::now(),
                    'tax' => $request->tax,
                    'total' => $request->TotalAmount,
                    'paid_amount' => $request->paidAmount,
                    'due_amount' => ($request->TotalAmount - $request->paidAmount),
                    'comment' => $request->description,
                    'created_by' => Auth::guard('employee')->user()->id,
                    'created_at' => Carbon::now(),
                ];
                try {
                    $invoice_id = $this->modelIns()::insertGetId($invoice_data);
                    for($i = 0; $i<count($request->product); $i++){
                        $product_items =[
                            'category' => $request->category[$i],
                            'invoice_id' => $invoice_id,
                            'product_id' => $request->product[$i],
                            'qty' => $request->qty[$i],
                            'price' => $request->price[$i],
                            'total' => $request->total[$i],
                            'created_at' => Carbon::now()
                        ];
                        $res = InvoiceItem::insert($product_items);
                        //Remove stock quantity
                        DB::Table('productstocks')
                                ->where(['product_id' => $request->product[$i],
                                        'category' => $request->category[$i],
                                        'branch' => $request->branch])
                                ->decrement('current_qty' , $request->qty[$i]);
                        if($request->type == "2"){
                            DB::Table('productstocks')
                                ->where(['product_id' => $request->product[$i],
                                        'category' => $request->category[$i],
                                        'branch' => $request->branch])
                                ->increment('offline_purchases' , $request->qty[$i]);
                        }elseif($request->type == "1"){
                            DB::Table('productstocks')
                                ->where(['product_id' => $request->product[$i],
                                        'category' => $request->category[$i],
                                        'branch' => $request->branch])
                                ->increment('online_purchases' , $request->qty[$i]);
                        }
                    }
                if($res){
                    return redirect()->route($this->resourceUrl().'.index')->with('success','Invoice saved successfully...!!!');
                }else{
                    return redirect()->route($this->resourceUrl().'.index')->with('error','Error saving invoice...!!!');
                }
                } catch (Exception $th) {
                    info('Invoice-saving-error:'.$th->getMessage());
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
    
    public static function getTyres() {
        return Tyre::all(['id', 'name']);
    }
    public static function getTubes() {
        return Tube::all(['id', 'name']);
    }
    public static function getBattery() {
        return Car_battery::all(['id', 'name']);
    }
    public static function getCategory() {
        return Category::all(['id', 'name']);
    }
    public function viewInvoice($id){
        $invoice = $this->modelIns()::find($id);
        $invoiceNumber = $invoice->invoice_no;
        $branch = Branch::join('tbl_countries','tbl_countries.id','=','branches.country')
                            ->join('tbl_states','tbl_states.id','=','branches.state')
                            ->join('tbl_cities','tbl_cities.id','=','branches.city')                    
                            ->where('branches.id','=',$invoice->branch)
                            ->get(['branches.name','branches.address1','branches.address2',
                            'branches.pincode','tbl_countries.name as country','tbl_states.name as state',
                            'tbl_cities.name as city']);
        $customer = Customer::join('tbl_countries','tbl_countries.id','=','customers.country')
                    ->join('tbl_states','tbl_states.id','=','customers.state')
                    ->join('tbl_cities','tbl_cities.id','=','customers.city')
                    ->where('customers.id','=',$invoice->customer)
                    ->get(['customers.first_name','customers.last_name','customers.address1','customers.address2',
                            'customers.zip','tbl_countries.name as country','tbl_states.name as state',
                            'tbl_cities.name as city']);
        
        $invoiceItems = DB::select('SELECT
                                    items.invoice_id,
                                    categories.name as category,
                                    case when items.category = 1 then tyres.name
                                        when items.category = 2 then tubes.name
                                        when items.category = 3 then car_batteries.name
                                    end as Product,
                                    items.qty,
                                    items.price,
                                    items.total
                                FROM black_bull.invoice_items items
                                inner join categories on categories.id = items.category
                                left outer join tyres on tyres.id = items.product_id
                                left outer join tubes on tubes.id = items.product_id
                                left outer join car_batteries on car_batteries.id = items.product_id
                                WHERE items.invoice_id=?', [$id]);
        return view('invoice.myInvoice',compact('invoice','invoiceNumber','customer','branch','invoiceItems'));
    }
}
