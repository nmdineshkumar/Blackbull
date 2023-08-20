<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Logincontroller extends Controller
{
    //
    public function showLoginForm(){
        return view('auth.login');
    }
    public function Auth_validateLogin(Request $request){
        $validate = $request->validate([
            'email' =>'required',
            'password' =>'required',
        ]);
        if($validate){
             $credetial = ['email'=> $request->email, 'password'=>$request->password];
             if(Auth::guard('admin')->attempt($credetial)){
                //return Auth::guard('admin')->user();
                return redirect()->intended('/admin/dashboard');
             }  
             else{
                return back()->withErrors(['error'=>'invalid username or password']);
             }
        }
    }
    public function logoutForm(){
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }
}
