<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Car_battery;
use App\Models\category;
use App\Models\customer;
use App\Models\InvoiceItem;
use App\Models\Productstock;
use App\Models\Quotation;
use App\Models\Quotation_item;
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

class QuatationController extends Controller
{
    //
    function resourceUrl(): string
    {
        return "admin.quotation";
    }
    function modelIns(): Quotation
    {
        return new Quotation;
    }

    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->modelIns()::orderBy('created_at', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return "<a target='_blank' href='" . route('getQuotation', $row->id) . "'>$row->invoice_no</a>";
                })
                ->addColumn('type', function ($row) {
                    return SaleTypeGetById($row->type);
                })
                ->addColumn('branch', function ($row) {
                    return $this->getbranch($row->branch);
                })
                ->addColumn('date', function ($row) {
                    return Carbon::parse($row->invocie_date)->format('d-m-Y');
                })
                ->addColumn('amount', function ($row) {
                    return $row->total;
                })
                ->addColumn('customer', function ($row) {
                    return $this->getCustomer($row->customer);
                })
                ->addColumn('action', function ($row) {
                    if ($row->deleted_at === NULL && $row->status === '1') {
                        return getActionButtons($row->id, $this->resourceUrl(), ['edit', 'delete','approved','rejected']);
                    } elseif($row->deleted_at === NULL && $row->status === '2'){
                            return "Approved "."Invoice no: ".(Sales::whereId($row->invoice_id)->get()->first())->invoice_no;
                    }elseif($row->deleted_at === NULL && $row->status === '3'){
                        return "Rejected";
                } else {
                        return getActionButtons($row->id, $this->resourceUrl(), ['retrieve']);
                    }
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
        } else {
            return view('admin.quatation.indexInvoice')
                ->with('pageName', 'Quotation')
                ->with('resourceUrl', $this->resourceUrl());
        }
    }
    public function getbranch($id)
    {
        return Branch::where('id', '=', $id)->get('name')->pluck('name')->first();
    }
    public function getCustomer($id)
    {
        return customer::where('id', '=', $id)->get('first_name')->pluck('first_name')->first();
    }
    public function getPriceByProduct(Request $request)
    {
        if ($request->category == '1') {
            return Tyre::where(['id' => $request->id])->get('price')->first();
        } else if ($request->category == '2') {
            return Tube::where(['id' => $request->id])->get('price')->first();
        } else if ($request->category == '3') {
            return Car_battery::where(['id' => $request->id])->get('price')->first();
        }
    }
    public function create()
    {
        $category_dataset = category::all();
        $customer = customer::all();
        $branch_dataset = Branch::all();
        $invoiceno = '#';
        return view('admin.quatation.editInvoice', compact('category_dataset', 'customer', 'branch_dataset'))
            ->with('pageName', 'Create Quotation')
            ->with('invoiceno', $invoiceno)
            ->with('id', '')
            ->with('resourceUrl', $this->resourceUrl());
    }
    public function edit($id)
    {
        $category_dataset = category::all();
        $customer = customer::all();
        $branch_dataset = Branch::all();
        $sales = $this->modelIns()::find($id);
        $invoiceno = $sales->invoice_no;
        $invoice_items = Quotation_item::where('invoice_id', $id)->get()->toArray();
        //return $invoice_items;
        return view('admin.quatation.editInvoice', compact('sales', 'category_dataset', 'customer', 'branch_dataset', 'invoice_items'))
            ->with('pageName', 'Edit Quotation')
            ->with('id', $id)
            ->with('invoiceno', $invoiceno)
            ->with('resourceUrl', $this->resourceUrl());
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'branch' => ['required'],
            'customer' => ['required'],
            'TotalAmount' => ['required', 'numeric', 'min:10'],
            'SubTotalAmount' => ['required', 'numeric', 'min:10'],
            'category.*' => ['required'],
            'product.*' => ['required'],
            'qty.*' => ['required', 'numeric', 'min:1'],
            'price.*' => ['required', 'numeric', 'min:10'],
            'toa.*' => ['required', 'numeric', 'min:10'],
            'paidAmount' => ['required'],
        ]);
        if ($validate) {
            $invoiceNo = Quotation::generateInvoiceNo();
            if ($request->id != null) {
                $invoice_data = [
                    'branch' => $request->branch,
                    'type' => $request->type,
                    'customer' => $request->customer,
                    //'invoice_no' => $invoiceNo,
                    'invocie_date' => Carbon::now(),
                    'tax' => $request->tax,
                    'total' => $request->TotalAmount,
                    'paid_amount' => $request->paidAmount,
                    'due_amount' => ($request->TotalAmount - $request->paidAmount),
                    'delivery' => $request->delivery_address,
                    'discount' => $request->discount == null ? '0' : $request->discount,
                    'comment' => $request->description,
                    'pay_mode' => $request->pay_mode,
                    'delivery_amount' => $request->DeliveryAmount,
                    'created_by' => Auth::guard('admin')->user()->id,
                    'created_at' => Carbon::now(),
                ];
                try {
                    $res = $this->modelIns()::whereId($request->id)->update($invoice_data);
                    for ($i = 0; $i < count($request->product); $i++) {
                        $product_items = [
                            'invoice_id' => $request->id,
                            'category' => $request->category[$i],
                            'product_id' => $request->product[$i],
                            'description' => $request->item_description[$i],
                            'qty' => $request->qty[$i],
                            'price' => $request->price[$i],
                            'total' => $request->total[$i],
                            'created_at' => Carbon::now()
                        ];
                        if ($request->invoice_item_id[$i] == null) {
                            $res = Quotation_item::insert($product_items);
                            
                        } else {
                            //Check Invoice Item
                            $old_Invoice_item = Quotation_item::where('id', $request->invoice_item_id[$i])->get()->first();
                           
                            $res = Quotation_item::where('id', $request->invoice_item_id[$i])->update($product_items);
                        }
                    }
                    if ($res) {
                        return redirect()->route($this->resourceUrl() . '.index')->with('success', 'Quotation updated successfully...!!!');
                    } else {
                        return redirect()->route($this->resourceUrl() . '.index')->with('error', 'Error updating Quotation...!!!');
                    }
                } catch (Exception $th) {
                    info('Invoice-update-error:' . $th->getMessage());
                }
            } else if ($request->id == null || $request->id == '') {
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
                    'delivery' => $request->delivery_address,
                    'discount' => $request->discount == null ? '0' : $request->discount,
                    'comment' => $request->description,
                    'pay_mode' => $request->pay_mode,
                    'delivery_amount' => $request->DeliveryAmount,
                    'created_by' => Auth::guard('admin')->user()->id,
                    'created_at' => Carbon::now(),
                ];
                try {
                    $invoice_id = $this->modelIns()::insertGetId($invoice_data);
                    for ($i = 0; $i < count($request->product); $i++) {
                        $product_items = [
                            'category' => $request->category[$i],
                            'invoice_id' => $invoice_id,
                            'product_id' => $request->product[$i],
                            'description' => $request->item_description[$i],
                            'qty' => $request->qty[$i],
                            'price' => $request->price[$i],
                            'total' => $request->total[$i],
                            'created_at' => Carbon::now()
                        ];
                        $res = Quotation_item::insert($product_items);
                        
                        
                    }
                    if ($res) {
                        return redirect()->route($this->resourceUrl() . '.index')->with('success', 'Quotation saved successfully...!!!');
                    } else {
                        return redirect()->route($this->resourceUrl() . '.index')->with('error', 'Error saving Quotation...!!!');
                    }
                } catch (Exception $th) {
                    info('Invoice-saving-error:' . $th->getMessage());
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
            info('Branch-delete-error:' . $th->getMessage());
        }
    }

    public static function getTyres()
    {
        return Tyre::all(['id', 'name']);
    }
    public static function getTubes()
    {
        return Tube::all(['id', 'name']);
    }
    public static function getBattery()
    {
        return Car_battery::all(['id', 'name']);
    }
    public static function getCategory()
    {
        return Category::all(['id', 'name']);
    }
    public function remove_InvoiceItem($id){

        $invoice_item = Quotation_item::where('id',$id)->get()->first();
        $invoice = Quotation::where('id',$invoice_item->invoice_id)->get()->first();
        if($invoice_item){
            Quotation_item::where('id',$id)->delete();           
           
            $invoice_items = Quotation_item::where('invoice_id',$invoice_item->invoice_id)->get();
           // return $invoice_items;
            $total_amount = $tax_amount = '0';
            foreach($invoice_items as $row){
                $total_amount = (int)$total_amount + (int)$row->total;
            }
            //return $total_amount;
            if((int)$invoice->tax > 0){
                $tax_amount = round(($total_amount / (int)$invoice->tax)*100,2) + number_format((int)$invoice->delivery_amount,2);
            }else{
                $tax_amount = round(((int)$total_amount + (int)$invoice->delivery_amount),2);
            }            
            Quotation::where('id',$invoice_item->invoice_id)->update(['total'=>number_format((int)$tax_amount-(int)$invoice->discount,2)]);
        }else{
            return response()->json($data=['status'=>'0','message'=>'Please choose any valid item...!!!']);
        }
    }
    public function viewInvoice($id)
    {
        $invoice = $this->modelIns()::find($id);
        $invoiceNumber = $invoice->invoice_no;
        $branch = Branch::join('tbl_countries', 'tbl_countries.id', '=', 'branches.country')
            ->join('tbl_states', 'tbl_states.id', '=', 'branches.state')
            ->join('tbl_cities', 'tbl_cities.id', '=', 'branches.city')
            ->where('branches.id', '=', $invoice->branch)
            ->get([
                'branches.name', 'branches.address1', 'branches.address2',
                'branches.pincode', 'tbl_countries.name as country', 'tbl_states.name as state',
                'tbl_cities.name as city', 'branches.invoice'
            ]);
        $customer = Customer::join('tbl_countries', 'tbl_countries.id', '=', 'customers.country', 'left outer')
            ->join('tbl_states', 'tbl_states.id', '=', 'customers.state', 'left outer')
            ->join('tbl_cities', 'tbl_cities.id', '=', 'customers.city', 'left outer')
            ->where('customers.id', '=', $invoice->customer)
            ->get([
                'customers.first_name', 'customers.last_name', 'customers.address1', 'customers.address2',
                'customers.zip', 'tbl_countries.name as country', 'tbl_states.name as state',
                'tbl_cities.name as city'
            ]);

        $invoiceItems = DB::select('SELECT
                                    items.invoice_id,
                                    categories.name as category,
                                    case when items.category = 1 then tyres.name
                                        when items.category = 2 then tubes.name
                                        when items.category = 3 then car_batteries.name
                                    end as Product,
                                    items.qty,
                                    items.price,
                                    items.total,
                                    items.description
                                FROM black_bull.quotation_items items
                                inner join categories on categories.id = items.category
                                left outer join tyres on tyres.id = items.product_id
                                left outer join tubes on tubes.id = items.product_id
                                left outer join car_batteries on car_batteries.id = items.product_id
                                WHERE items.invoice_id=?', [$id]);
        $InvoiceTemplate = '';
        if ($invoice->tax == 0 || $invoice->tax == "0") {
            $InvoiceTemplate = "myInvoice";
        } else {
            $InvoiceTemplate = getInvoiceTemplate($branch[0]->invoice);
        }
        return view('quatation.' . $InvoiceTemplate, compact('invoice', 'invoiceNumber', 'customer', 'branch', 'invoiceItems'));
    }
    public function Quotation_status_update(Request $request){
        $validate = $request->validate(['quotation_id'=>'required',
        'status' => 'required']);
        if($validate){
            if($request->status == '2'){
                $res = true;
                if ($res) {
                    $invoiceNo = Sales::generateInvoiceNo();
                    $quotation_master = Quotation::whereId($request->quotation_id)->get()->first();
                    $invoice_data = [
                        'branch' => $quotation_master->branch,
                        'type' => $quotation_master->type,
                        'customer' => $quotation_master->customer,
                        'invoice_no' => $invoiceNo,
                        'invocie_date' => Carbon::now(),
                        'tax' => $quotation_master->tax,
                        'total' => $quotation_master->total,
                        'paid_amount' => $quotation_master->paid_amount,
                        'due_amount' => ($quotation_master->due_amount),
                        'delivery' => $quotation_master->delivery,
                        'discount' => $quotation_master->discount == null ? '0' : $quotation_master->discount,
                        'comment' => $quotation_master->comment,
                        'pay_mode' => $quotation_master->pay_mode,
                        'delivery_amount' => $quotation_master->delivery_amount,
                        'created_by' => Auth::guard('admin')->user()->id,
                        'created_at' => Carbon::now(),
                    ];
                    $invoice_id = Sales::insertGetId($invoice_data);
                   // $res = $this->modelIns()::where('invoice_id',$request->quotation_id)->update($invoice_data);
                    $quotation_items = Quotation_item::where('invoice_id',$request->quotation_id)->get();
                    //Quotation Items
                    for ($i = 0; $i < count($quotation_items); $i++) {
                        $product_items = [
                            'category' => $quotation_items[$i]->category,
                            'invoice_id' => $invoice_id,
                            'product_id' => $quotation_items[$i]->product_id,
                            'description' => $quotation_items[$i]->description,
                            'qty' => $quotation_items[$i]->qty,
                            'price' => $quotation_items[$i]->price,
                            'total' => $quotation_items[$i]->total,
                            'created_at' => Carbon::now()
                        ];
                        $res = InvoiceItem::insert($product_items);
                        //Remove stock quantity
                        $result = Productstock::where(['product_id' => $quotation_items[$i]->product_id,
                                                        'category' => $quotation_items[$i]->category,
                                                        'branch' => $quotation_items[$i]->branch])->exists();
                        if(!$result){
                            $product_stock =[
                                'branch' => $quotation_master->branch,
                                'category' => $quotation_items[$i]->category,
                                'product_id' =>  $quotation_items[$i]->product_id,
                                'current_qty' => '-'. $quotation_items[$i]->qty,
                                'old_qty'=>'0',
                                'overall_qty' => '-'. $quotation_items[$i]->qty,
                                'online_purchases' => '0',
                                'offline_purchases' => '0',
                                'created_at' => Carbon::now()
                            ];
                            Productstock::insert($product_stock);
                        }else{
                            DB::Table('productstocks')
                            ->where([
                                'product_id' => $quotation_items[$i]->product_id,
                                                        'category' => $quotation_items[$i]->category,
                                                        'branch' => $quotation_master->branch
                            ])
                            ->decrement('current_qty', $quotation_items[$i]->qty);
                        }
                    }
                    Quotation::whereId($request->quotation_id)->update(['invoice_id'=>$invoice_id,'status'=>'2']);
                    return response()->json(['success' =>'Quotation Approved successfully...!!!']);
                } else {
                    return response()->json(['error' => 'Error approved Quotation...!!!']);
                }
            }else if($request->status == '3'){
                $res = Quotation::whereId($request->quotation_id)->update(['status'=>'3']);;
                if ($res) {
                    return response()->json(['success' => 'Quotation Rejected successfully...!!!']);
                } else {
                    return response()->json(['error'=>'Error rejected Quotation...!!!']);
                }
            }
        }
    }
}
