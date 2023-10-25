<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Car_battery;
use App\Models\expense_category;
use App\Models\manufacturers;
use App\Models\Tube;
use App\Models\Tyre;
use App\Models\Tyresize;
use Carbon\Carbon;
use CarModel;
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
    public static function getCountry(){
        return DB::table('tbl_countries')->get(['name','id']);
    }
    public static function getState($id){
        return DB::table('tbl_states')->where('country_id','=',$id)->get(['id','name']);
    }
    public static function getCity($id){
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
                'created_at' => Carbon::now(),
                'updated_by' => '0'
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
    public static function get_Product($id){
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
    public static function FilterCarYear($id){
        $data['model'] = DB::select('SELECT C.year as id,C.year as name,count(C.year) as countNo FROM `cars_datas` C
                            inner join manufacturers m on m.id = C.maker
                            inner join car_model cm on m.id = cm.make and C.model = cm.id
                                GROUP BY(C.year);');
        $data['target'] = 'size';
        $data['url'] = route('frontend.filter.size',':id');
        return $data;
    }
    public function FilterCarSize($id,Request $request){
        $data['model'] = DB::select("SELECT ts.id,concat(ifnull(ts.height,''),'X',ifnull(ts.width,''),' R',ifnull(ts.rim_size,''),' ',ifnull(ts.speed,'')) as name, '' as countNo FROM `cars_datas` C
                                    inner join manufacturers m on m.id = C.maker
                                    inner join car_model cm on m.id = cm.make and C.model = cm.id
                                    inner join tyresizes ts on ts.id = c.tyre_size
                                    where c.maker = '$request->make' and m.id = '$request->model'
                                        and C.year = '$id'");
        $data['target'] = '';
        $data['url'] = '';
        return $data;
    }
    public static function getTyreSize($id){
        $name = '';
        $tyreRecord = Tyresize::where('id', $id)->get()->first();
        //return $tyreRecord;
        $name = $tyreRecord->height.'X'.$tyreRecord->width.' R'.$tyreRecord->rim_size.' '.$tyreRecord->speed;
        return $name;
    }
    public static function get_makerName($id){
        $product = manufacturers::join('cars_datas', 'manufacturers.id','cars_datas.maker')
                ->where('cars_datas.id', $id)->get('manufacturers.name')->first();
        return $product->name;
    }
    public static function get_modelName($id){        
        $product = DB::table('car_model')->join('cars_datas', 'car_model.id','cars_datas.model')
                ->where('cars_datas.id', $id)->get('car_model.name')->first();
        return $product->name;
    }
    public static function get_TyreYear($id){        
        $product = DB::table('car_model')->join('cars_datas', 'car_model.id','cars_datas.model')
                ->where('cars_datas.id', $id)->get('cars_datas.year')->first();
        return $product->year;
    }
    public static function get_TyreSize($id){        
        $product = DB::table('tyresizes')->join('cars_datas', 'tyresizes.id','cars_datas.tyre_size')
                ->where('tyresizes.id', $id)->get(['tyresizes.height','tyresizes.width','tyresizes.rim_size','tyresizes.speed'])->first();
        return $product->height.' X '.$product->width.' R'.$product->rim_size.' '.$product->speed;
    }
    public static function get_TyreOrigin($id){
        $product = DB::table('origin')->join('cars_datas', 'origin.id','cars_datas.model')
                ->where('cars_datas.id', $id)->get('origin.name')->first();
        return $product->name;
    }
    public static function TubeFilterByBrand($id){
        $data['model'] = DB::select('select `origin`.`name`, `origin`.`id`,count(tubes.origin) as countNo from `origin` 
                        inner join `tubes` on `origin`.`id` = `tubes`.`origin` where `tubes`.`id` = '.$id.'
                        GROUP BY(tubes.origin)');
        $data['target'] = 'origin';
        $data['url'] = route('frontend.tube.filter.origin',':id');
        return $data;
    }
    public static function TubeFilterByOrigin($id){
        //manufacure_year
        $data['model'] = DB::select('select `tubes`.`manufacure_year` as `id`, `tubes`.`manufacure_year` as `name`,count(tubes.manufacure_year) as countNo from `tubes` where `origin` = '.$id.' and `tubes`.`deleted_at` is null
                        GROUP BY(tubes.manufacure_year)');
        $data['target'] = 'year';
        $data['url'] = '';
        return $data;
    }
    //Tube data
    public static function get_BrandName($id){
        $name = '';
        $name = DB::table('brand')->where('id',$id)->first()->name;
        return $name;
    }
    public static function get_OriginName($id){
        $name = '';
        $name = DB::table('origin')->where('id',$id)->first()->name;
        return $name;
    }
    public static function get_RimSize($id){
        $name = '';
        $name = DB::table('tube_rim_size')->where('id',$id)->first()->name;
        return $name;
    }
    public static function get_TubeVolve($id){
        //tube_volve
        $name = '';
        $name = DB::table('tube_volve')->where('id',$id)->first()->name;
        return $name;
    }
    public static function BatteryFilterByBrand($id){
        $data['model'] = DB::select('select `capacity` as id,`capacity` as name,count(`capacity`) as countNo 
                                from `car_batteries` where `brand` = '.$id.' group by `capacity`');
        $data['target'] = 'capacity';
        $data['url'] = '';
        return $data;
    }
    public static function BranchName($id){
        $name = '';
        return Branch::find($id)->pluck('name')->first();
    }
    public function save_expense_category(Request $request){
        $validate = $request->validate([
            'expense_Category' => 'required'
        ]);
        if($validate){
            $data = [
                'name' => $request->expense_Category
            ];
            $res = expense_category::insert($data);
            if($res){
                $return_data = expense_category::all();
                return response()->json(['data'=>$return_data]);
            }
        }
    }
    //Tyre size filter
    public static function Get_Filter_TyreHeight(){
        $res = Tyresize::groupBy('height')
                ->selectRaw('count(*) as total,height')
                ->get();
        return $res;
    }
    public static function get_Filter_TyreWidth($id){
        $data['model'] = Tyresize::where('height',$id)
                        ->groupBy('width')
                        ->selectRaw('count(*) as countNo,width as id,width as name')
                        ->get();
                        $data['target'] = 'rim_size';
                        $data['url'] = route('frontend-tyre-size-filter-rim-size',[':height',':width']);;
        return $data;
    }
    public static function get_Filter_tyresize($height,$width){
        $data['model'] = Tyresize::where('height',$height)
                        ->where('width',$width)
                        ->groupBy('rim_size')
                        ->selectRaw('count(*) as countNo,rim_size as id,rim_size as name')
                        ->get();
                        $data['target'] = '';
                        $data['url'] = '';
        return response()->json($data);
    }
}
