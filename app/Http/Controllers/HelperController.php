<?php

namespace App\Http\Controllers;

use App\Models\Car_battery;
use App\Models\Tube;
use App\Models\Tyre;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HelperController extends Controller
{
    public static function getCountryName($id){
        return DB::table('tbl_countries')->where('id','=',$id)->get('name')->pluck('name')->first();
    }
    public static function getCityName($id){
        return DB::table('tbl_cities')->where('id','=', $id)->get('name')->pluck('name')->first();
    }
    public static function getStateName($id){
        return DB::table('tbl_states')->where('id','=',$id)->get('name');
    }
    public function getCountry(){
        return DB::table('tbl_countries')->get(['name','id']);
    }
    public function getState($id){
        return DB::table('tbl_states')->where('country_id','=',$id)->get(['id','name']);
    }
    public function getCity($id){
        return DB::table('tbl_cities')->where('state_id','=',$id)->get(['id','name']);
    }
    public function getTyreHeight(){
        return DB::table('tbl_tyres')->get();
    }
    public function saveTyreheight(Request $request){
        $validate = $request->validate([
            'height' =>['required' , 'unique:tyre_heights,height']
        ]);
        if($validate){
            $data = [
                'height' => $request->height,
                'created_at' => Carbon::now(),
            ];
            try {
                $res = DB::table('tyre_heights')->insert($data);
            if($res){
                return DB::table('tyre_heights')->get();
            }else{
                return response()->with('error','Error saving Tyre Height...!!!');
            }
            } catch (Exception $th) {
                info('Tyre-Height-saving-error:'.$th->getMessage());
            }
        }else{
            return response()->json(['success' => false, 'errors' => $validate->errors()], 422);;
        }
    }
    public function saveTyreprofile(Request $request){
        $validate = $request->validate([
            'profile' =>['required' , 'unique:tyre_profile,profile']
        ]);
        if($validate){
            $data = [
                'profile' => $request->profile,
                'created_at' => Carbon::now(),
            ];
            try {
                $res = DB::table('tyre_profile')->insert($data);
            if($res){
                return DB::table('tyre_profile')->get();
            }else{
                return response()->with('error','Error saving Tyre Profile...!!!');
            }
            } catch (Exception $th) {
                info('Tyre-Profile-saving-error:'.$th->getMessage());
            }
        }
    }
    public function saveTyrerimsize(Request $request){
        $validate = $request->validate([
            'rimsize' =>['required' , 'unique:tyre_rim_size,rimsize']
        ]);
        if($validate){
            $data = [
                'rimsize' => $request->rimsize,
                'created_at' => Carbon::now(),
            ];
            try {
                $res = DB::table('tyre_rim_size')->insert($data);
            if($res){
                return DB::table('tyre_rim_size')->get();
            }else{
                return response()->with('error','Error saving Tyre Tyre_rim_size...!!!');
            }
            } catch (Exception $th) {
                info('Tyre-Rim-size-saving-error:'.$th->getMessage());
            }
        }
    }
    public function saveBrand(Request $request){
        $validate  = $request->validate([
            'brandname' =>[ 'required'],
            'image' => ['required'],
        ]);
        if($validate){
            $data = [
                'name' =>$request->brandname,
                'path' =>$request->image,
                'created_by' => Auth::guard('admin')->user()->id,
                'created_at' => Carbon::now()
            ];
            try {
                $res = DB::table('brand')->insert($data);
            if($res){
                return DB::table('brand')->get(['id','name']);
            }else{
                return response()->with('error','Error saving Tyre Brand...!!!');
            }
            } catch (Exception $th) {
                info('Tyre-Brand-saving-error:'.$th->getMessage());
            }
        }
    }
    public function savePattern(Request $request){
        $validate  = $request->validate([
            'pattern' =>[ 'required']
        ]);
        if($validate){
            $data = [
                'name' =>$request->pattern,
                'created_by' => Auth::guard('admin')->user()->id,
                'created_at' => Carbon::now()
            ];
            try {
                $res = DB::table('pattern')->insert($data);
            if($res){
                return DB::table('pattern')->get(['id','name']);
            }else{
                return response()->with('error','Error saving Tyre Pattern...!!!');
            }
            } catch (Exception $th) {
                info('Tyre-Pattern-saving-error:'.$th->getMessage());
            }
        }
    }
    public function saveOrigin(Request $request){
        $validate  = $request->validate([
            'origin' =>[ 'required']
        ]);
        if($validate){
            $data = [
                'name' =>$request->origin,
                'created_by' => Auth::guard('admin')->user()->id,
                'created_at' => Carbon::now()
            ];
            try {
                $res = DB::table('origin')->insert($data);
            if($res){
                return DB::table('origin')->get(['id','name']);
            }else{
                return response()->with('error','Error saving Tyre Origin...!!!');
            }
            } catch (Exception $th) {
                info('Tyre-Origin-saving-error:'.$th->getMessage());
            }
        }
    }
    public function saveCar_model(Request $request){
        $validate  = $request->validate([
            'name' =>[ 'required'],
            'make' =>[ 'required'],
        ]);
        if($validate){
            $data = [
                'make' => $request->make,
                'name' =>$request->name,
                'created_by' => Auth::guard('admin')->user()->id,
                'created_at' => Carbon::now()
            ];
            try {
                $res = DB::table('car_model')->insert($data);
            if($res){
                return DB::table('car_model')->where('make','=',$request->make)->get(['id','name']);
            }else{
                return response()->with('error','Error saving Tyre Origin...!!!');
            }
            } catch (Exception $th) {
                info('Tyre-Origin-saving-error:'.$th->getMessage());
            }
        }
    }
    public static function getCar_model($id){
        return DB::table('car_model')->where('make','=',$id)->get(['id','name']);
    }
    public function saveCar_year(Request $request){
        $validate  = $request->validate([
            'model' =>[ 'required'],
            'make' =>[ 'required'],
            'year' =>[ 'required']
        ]);
        if($validate){
            $data = [
                'make' => $request->make,
                'year' =>$request->year,
                'model' => $request->model,
                'created_by' => Auth::guard('admin')->user()->id,
                'created_at' => Carbon::now()
            ];
            try {
                $res = DB::table('car_model_year')->insert($data);
            if($res){
                return DB::table('car_model_year')->where(['make'=>$request->make,'model'=>$request->model])
                                                    ->get(['id','year as name']);
            }else{
                return response()->with('error','Error saving Tyre Origin...!!!');
            }
            } catch (Exception $th) {
                info('Tyre-Origin-saving-error:'.$th->getMessage());
            }
        }
    }
    public static function getCar_year($id){
        return DB::table('car_model_year')->where(['make'=>$id])->get(['id','year as name']);
    }
    public function saveVolve(Request $request){
        $validate  = $request->validate([
            'volve' =>[ 'required','unique:tube_volve,name']
        ]);
        if($validate){
            $data = [
                'name' =>$request->volve,
                'created_by' => Auth::guard('admin')->user()->id,
                'created_at' => Carbon::now()
            ];
            try {
                $res = DB::table('tube_volve')->insert($data);
            if($res){
                return DB::table('tube_volve')->get(['id','name']);
            }else{
                return response()->with('error','Error saving Tyre Tube Volve...!!!');
            }
            } catch (Exception $th) {
                info('Tube-Volve-saving-error:'.$th->getMessage());
            }
        }
    }
    public function saveTubeheight(Request $request){
        $validate  = $request->validate([
            'height' =>[ 'required','unique:tube_volve,name']
        ]);
        if($validate){
            $data = [
                'name' =>$request->height,
                'created_by' => Auth::guard('admin')->user()->id,
                'created_at' => Carbon::now()
            ];
            try {
                $res = DB::table('tube_height')->insert($data);
            if($res){
                return DB::table('tube_height')->get(['id','name']);
            }else{
                return response()->with('error','Error saving Tyre Tube Volve...!!!');
            }
            } catch (Exception $th) {
                info('Tube-Volve-saving-error:'.$th->getMessage());
            }
        }
    }
    public function saveTubeRimsize(Request $request){
        $validate  = $request->validate([
            'rim_size' =>[ 'required','unique:tube_rim_size,name']
        ]);
        if($validate){
            $data = [
                'name' =>$request->rim_size,
                'created_by' => Auth::guard('admin')->user()->id,
                'created_at' => Carbon::now()
            ];
            try {
                $res = DB::table('tube_rim_size')->insert($data);
            if($res){
                return DB::table('tube_rim_size')->get(['id','name']);
            }else{
                return response()->with('error','Error saving Tyre Tube Volve...!!!');
            }
            } catch (Exception $th) {
                info('Tube-Volve-saving-error:'.$th->getMessage());
            }
        }
    }
    public function get_Product($id){
        if($id != ''){
            if($id == '1'){
                return Tyre::get(['id','name']);
            }else if($id == '2'){
                return Tube::get(['id','name']);
            }else if($id == '3'){
                return Car_battery::get(['id','name']);
            }
        }else{
            return back()->withErrors('errors','Please choose a category');
        }
    }
    public static function FilterMaker(){
        $data = DB::select('SELECT m.id,m.name,count(C.id) as countNo FROM `cars_datas` C
                            inner join manufacturers m on m.id = C.maker
                            GROUP BY(m.id);');
        $return_data = array();
        foreach($data as $key => $row){
            $return_data[$key]['id'] = $row->id;
            $return_data[$key]['name'] = $row->name.'('.$row->countNo.')';
        }
        return response()->json($return_data);
    }
    public function FilterCarModel($id){
        $data['model'] = DB::select('SELECT cm.id,cm.name,count(C.model) as countNo FROM `cars_datas` C
                            inner join manufacturers m on m.id = C.maker
                            inner join car_model cm on m.id = cm.make and C.model = cm.id
                            where c.maker = '.$id.'
                                GROUP BY(cm.id);');
        $data['target'] = 'year';
        $data['url'] = route('frontend.filter.year',':id');
        return $data;
    }
    public function FilterCarYear($id){
        $data['model'] = DB::select('SELECT C.year as id,C.year as name,count(C.year) as countNo FROM `cars_datas` C
                            inner join manufacturers m on m.id = C.maker
                            inner join car_model cm on m.id = cm.make and C.model = cm.id
                                GROUP BY(C.year);');
        $data['target'] = 'size';
        $data['url'] = route('frontend.filter.size',':id');
        return $data;
    }
    public function FilterCarSize($id,Request $request){
        $data['model'] = DB::select("SELECT ts.id,concat(ts.height,'X',ts.width,' R',ts.rim_size,' ',ts.speed) as name, '' as countNo FROM `cars_datas` C
                                    inner join manufacturers m on m.id = C.maker
                                    inner join car_model cm on m.id = cm.make and C.model = cm.id
                                    inner join tyresizes ts on ts.id = c.tyre_size
                                    where c.maker = '$request->make' and m.id = '$request->model'
                                        and C.year = '$id';");
        $data['target'] = '';
        $data['url'] = '';
        return $data;
    }

}
