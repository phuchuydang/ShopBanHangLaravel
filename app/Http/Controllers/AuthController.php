<?php

namespace App\Http\Controllers;

use App\Models\Customer;

use Illuminate\Http\Request;
session_start();

use App\Models\Admin;
use App\Models\Roles;

class AuthController extends Controller
{
    public function registerAuth(){
        return view('admin.auth.register');
    }

    public function register(Request $request){
        $data = $request->all();
        $admin = new Admin();
        $admin->name = $data['auth_name'];
        $admin->email = $data['auth_email'];
        $admin->phone = $data['auth_phone'];
        $admin->password = md5($data['auth_password']);
        $admin->save();
        $rle = new Roles();
        $rle->email = $data['auth_email'];
        $rle->role_number = 1;
        $rle->save();
       
        return redirect()->back()->with('success', 'Register success');
    }

    // public function loginAuth(){
    //     return view('admin.auth.login');
    // }

    // public function login(Request $request){
    //     $data = $request->all();
    //     if(Auth::attempt(['email' => $data['auth_email'], 'password' => $data['auth_password']])){
    //         return Redirect::to('dashboard');
    //     }else{
    //         return redirect()->back()->with('error', 'Email or password is incorrect');
    //     }

    // }

}
