<?php

namespace App\Http\Controllers;

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
}
