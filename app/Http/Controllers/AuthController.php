<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use User;

class AuthController extends Controller
{
    public function login(){
        return view('admin/layouts/login');
    }

    public function submitLogin(Request $request){
        // $input = $request->all();
        $this->validate($request,[
            'username'  => 'required',
            'password'  => 'required',
        ]);
        
        if(Auth::attempt($request->only('username','password')))
        {
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()
                ->with('error','Username or Password Are Wrong.');
        }
        // Auth::attempt(['username'  => $request->username, 'password' => $request->password]);
        // return redirect(route('administrator'));
    }

    public function logout(){
        Auth::logout();
        return $this->login();
    }
}
