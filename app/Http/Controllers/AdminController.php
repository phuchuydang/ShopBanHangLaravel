<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;

session_start();

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin_login');
    }

    public function showDashboard()
    {
        return view('admin.dashboard');
    }

    public function dashboard(Request $request)
    {
        $email = $request->input('admin_email');
        $password = md5($request->input('admin_password'));
        $result = DB::table('tbl_admin')->where('email', $email)->where('password', $password)->first();
        if ($result) {
            Session::put('name', $result->name);
            Session::put('email', $result->email);
            return Redirect::to('/dashboard');
        } else {
            Session::put('message', 'Email or Password is incorrect');
            return Redirect::to('/admin');
            
        }
    }

    public function log_out()
    {
        Session::put('name', null);
        Session::put('email', null);
        return Redirect::to('/admin');
    }
}
