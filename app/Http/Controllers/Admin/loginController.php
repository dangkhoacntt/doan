<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class loginController extends Controller
{
    //
    public function getlogin(){
        return view('backend.login');
    }
    public function postlogin(Request $request)
    {
        if($request->remember ='Remember Me' ){
            $remember = true ;
        }else{
            $remember = false;
        }
        $arr=['email' => $request->email, 'password' => $request->password];
        if (Auth::attempt($arr,$remember)){
            return redirect()->intended('admin/home');
        }else{
            return back()->withInput()->with('error','tai khoan hoac mat khau chua dung') ;
        }
        
      
    }
}
