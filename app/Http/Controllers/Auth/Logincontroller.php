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
            'type' => 'required',
        ]);
        if($validate){
             $credetial = ['email'=> $request->email, 'password'=>$request->password];
             if($request->type == '1'){
                $gaurd = 'admin';
             }else{
                $gaurd = 'employee';
             }
             if(Auth::guard($gaurd)->attempt($credetial)){
                //return Auth::guard($gaurd)->user();
                if($request->type == '1'){
                    return redirect()->intended('/admin/dashboard');
                }else{
                    $userRole = Auth::guard($gaurd)->user()->department_id;
                    if($userRole == '1'){
                        return redirect()->route('manager.dashboard');
                    }else if($userRole == '2'){
                        return redirect()->intended('/employee/dashboard');
                    }
                }
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
