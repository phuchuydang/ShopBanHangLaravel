<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//Socialite
//use Socialite
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use App\Models\Social;
use App\Models\Customer;
use App\Models\Roles;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use phpDocumentor\Reflection\Types\This;
use App\Rules\Captcha;
use Dotenv\Validator;
session_start();

class UserController extends Controller
{
    public function Authenticate()
    {
        $admin_id = Session::get('name');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }


    public function listUser(){
        $this->Authenticate();
        $user = Customer::all();
        $role = Roles::all();
        return view('admin.user.list_user', compact('user', 'role'));
    }

    public function deleteUser(Request $request){
        $this->Authenticate();
        $data = $request->all();
        $user_id = $data['user_id'];
        $user = Customer::find($user_id);
        $user->delete();
        return redirect()->back()->with('success', 'Delete user success');
    }

    public function editUserRole($user_id){
        $this->Authenticate();
        //get user and role in 2 table
        $user = Customer::find($user_id);
        $role = Roles::all();
        return view('admin.user.edit_user', compact('user', 'role'));
    }


}
