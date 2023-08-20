<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
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
}
