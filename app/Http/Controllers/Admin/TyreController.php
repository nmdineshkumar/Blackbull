<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Models\Cars_data;
use App\Models\manufacturers;
use App\Models\Tyre;
use App\Models\Tyresize;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TyreController extends Controller
{
    //
    function resourceUrl(): string
    {
        return "admin.tyre";
    }
    function modelIns(): Tyre
    {
        return new Tyre;
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->modelIns()::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return "<a href='" . route($this->resourceUrl() . '.edit', $row->id) . "'>$row->name </a>";
                })
                ->addColumn('brand', function ($row) {
                    return $this->getBrand($row->brand);
                })
                ->addColumn('origin', function ($row) {
                    return $this->getOrigin($row->origin);
                })
                ->addColumn('manufactory_year', function ($row) {
                    return $row->manufactory_year;
                })
                ->addColumn('size', function ($row) {
                    return HelperController::getTyreSize($row->tyre_size);
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
            return view('admin.tyre.indexTyre')
                ->with('pageName', 'Tyre')
                ->with('resourceUrl', $this->resourceUrl());
        }
    }
    public function getBrand($id)
    {
        return DB::table('brand')->where('id', $id)->get(['name'])->pluck('name')->first();
    }
    public function getOrigin($id)
    {
        return DB::table('origin')->where('id', $id)->get(['name'])->pluck('name')->first();
    }
    public function create()
    {
        $brand_dataset = DB::table('brand')->get(['id', 'name']);
        $pattern_dataset = DB::table('pattern')->get(['id', 'name']);
        $origin_dataset = DB::table('origin')->get(['id', 'name']);
        $make_dataset = manufacturers::get(['id', 'name']);
        $tyre_size_dataset = Tyresize::get(['id', "height", "width", "rim_size", "speed"]);
        //return $tyre_size_dataset; 
        return view('admin.tyre.editTyre', compact(
            'brand_dataset',
            'pattern_dataset',
            'origin_dataset',
            'make_dataset',
            'tyre_size_dataset'
        ))
            ->with('pageName', 'Create Tyre')
            ->with('id', '')
            ->with('resourceUrl', $this->resourceUrl());
    }
    public function edit($id)
    {
        $brand_dataset = DB::table('brand')->get(['id', 'name']);
        $pattern_dataset = DB::table('pattern')->get(['id', 'name']);
        $origin_dataset = DB::table('origin')->get(['id', 'name']);
        $make_dataset = manufacturers::get(['id', 'name']);
        $tyre_size_dataset = Tyresize::get(['id', "height", "width", "rim_size", "speed"]);
        $tyre = $this->modelIns()::find($id);
        $cars_data = Cars_data::where('id', $tyre->cars)->get();
        $model_dataset = HelperController::getCar_model($cars_data[0]->maker);
        $year_dataset = HelperController::getCar_year($cars_data[0]->model);
        return view('admin.tyre.editTyre', compact(
            'tyre',
            'brand_dataset',
            'pattern_dataset',
            'origin_dataset',
            'make_dataset',
            'tyre_size_dataset',
            'cars_data',
            'model_dataset',
            'year_dataset'
        ))
            ->with('pageName', 'Edit Tyre')
            ->with('id', $id)
            ->with('resourceUrl', $this->resourceUrl());
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'unique:tyres,name,' . $request->id . ',id'],
            'brand' => ['required'],
            'pattern' => ['required'],
            'type' => ['required'],
            'origin' => ['required'],
            'myear' => ['required'],
            'sku' => ['required', 'unique:tyres,sku,' . $request->id . ',id'],
            'wyear' => ['required'],
            'make' => ['required'],
            'model' => ['required'],
            'year'  => ['required'],
            'price' => ['required'],
            'set_price' => ['required'],
            'tyre_size' => ['required'],
            'image' => ['required'],
            'description' => ['required'],
        ]);
        if ($validate) {
            if ($request->id == '' || $request->id == null) {
                $car_model = Cars_data::where([
                    'maker' => $request->make,
                    'model' => $request->model,
                    'year' => $request->year,
                    'engine' => $request->engine_type,
                    'fuel_type' => $request->fuel_type,
                    'Horsepower' => $request->other,
                    'tyre_size' => $request->tyre_size,
                ])->exists();
                if ($car_model) {
                    $car_data_id = Cars_data::where([
                        'maker' => $request->make,
                        'model' => $request->model,
                        'year' => $request->year,
                        'engine' => $request->engine_type,
                        'fuel_type' => $request->fuel_type,
                        'Horsepower' => $request->other,
                        'tyre_size' => $request->tyre_size,
                    ])->get('id')->pluck('id')->first();
                } else {
                    $model_data = [
                        'maker' => $request->make,
                        'model' => $request->model,
                        'year' => $request->year,
                        'engine' => $request->engine_type,
                        'fuel_type' => $request->fuel_type,
                        'Horsepower' => $request->other,
                        'tyre_size' => $request->tyre_size,
                        'created_by' => Auth::guard('admin')->user()->id,
                        'created_at' => Carbon::now()
                    ];
                    $car_data_id = Cars_data::insertGetId($model_data);
                }

                $data = [
                    'name' => $request->name,
                    'brand' => $request->brand,
                    'pattern' => $request->pattern,
                    'tyre_type' => $request->type,
                    'tyre_size' => $request->tyre_size,
                    'origin' => $request->origin,
                    'manufactory_year' => $request->myear,
                    'warranty_year' => $request->wyear,
                    'sku' => $request->sku,
                    'description' => $request->description,
                    'cars' => $car_data_id,
                    'image' => $request->image,
                    'price' => $request->price,
                    'set_price' => $request->set_price,
                    'created_by' => Auth::guard('admin')->user()->id,
                    'created_at' => Carbon::now()
                ];
                try {
                    $res = $this->modelIns()::insert($data);
                    if ($res) {
                        return redirect()->route($this->resourceUrl() . '.index')->with('success', 'Tyre Product saved successfully...!!!');
                    } else {
                        return redirect()->route($this->resourceUrl() . '.index')->with('error', 'Error saving Tyre Product...!!!');
                    }
                } catch (Exception $th) {
                    info('Tyre-Product-saving-error:' . $th->getMessage());
                }
            } else {
                $data = [
                    'name' => $request->name,
                    'brand' => $request->brand,
                    'pattern' => $request->pattern,
                    'tyre_type' => $request->type,
                    'tyre_size' => $request->tyre_size,
                    'origin' => $request->origin,
                    'manufactory_year' => $request->myear,
                    'warranty_year' => $request->wyear,
                    'sku' => $request->sku,
                    'description' => $request->description,
                    'image' => $request->image,
                    'created_by' => Auth::guard('admin')->user()->id,
                    'created_at' => Carbon::now()
                ];
                try {
                    $res = $this->modelIns()::whereId($request->id)->update($data);
                    // $model_data = [
                    //     'maker' => $request->make,
                    //     'model' => $request->model,
                    //     'year' => $request->year,
                    //     'engine' => $request->engine_type,
                    //     'fuel_type' => $request->fuel_type,
                    //     'tyre_size' => $request->tyre_size,
                    //     'Horsepower' => $request->other,
                    //     'updated_by' => Auth::guard('admin')->user()->id,
                    //     'updated_at' => Carbon::now()
                    // ];
                    // Cars_data::whereId($request->car_data_id)->update($model_data);
                    if ($res) {
                        return redirect()->route($this->resourceUrl() . '.index')->with('success', 'Tyre Product updated successfully...!!!');
                    } else {
                        return redirect()->route($this->resourceUrl() . '.index')->with('error', 'Error updating Tyre Product...!!!');
                    }
                } catch (Exception $th) {
                    info('Tyre-Product-update-error:' . $th->getMessage());
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
            info('Tyre Size-delete-error:' . $th->getMessage());
        }
    }
}
