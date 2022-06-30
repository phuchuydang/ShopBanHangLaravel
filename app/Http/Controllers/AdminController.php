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
use App\Models\Login;
use App\Models\Social;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use phpDocumentor\Reflection\Types\This;
use App\Rules\Captcha;
use Dotenv\Validator;
session_start();

class AdminController extends Controller
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

    public function index()
    {
        return view('admin_login');
    }

  
    public function dashboard(Request $request)
    {
        $data = $request->all();
        $request->validate([
        
                'g-recaptcha-response' => 'required|captcha'
            ],
            [
                'g-recaptcha-response' => 'Please check are you a robot or not'
            ],
        );

        $admin_email = $data['admin_email'];
        $admin_password = md5($data['admin_password']);
        $login = Login::where('email', $admin_email)->where('password', $admin_password)->first();
        // echo '<pre>';
        // print_r($login);
        // echo '</pre>';
        //login count
        $login_count = Login::where('email', $admin_email)->where('password', $admin_password)->count();
        if ($login_count) {
            Session::put('name', $login->name);
            //admin_id
            Session::put('email', $login->email);
            return Redirect::to('dashboard');
        } else {
            Session::put('message', 'Wrong username or password');
            return Redirect::to('admin');
        }
    }

    public function showDashboard()
    {
        $this->Authenticate();
        return view('admin.dashboard');
    }


    public function log_out()
    {
        $this->Authenticate();
        Session::put('name', null);
        Session::put('email', null);
        return Redirect::to('/admin');
    }

    //showprofile
    public function showProfile()
    {
        $this->Authenticate();
        return view('admin.profile');
    }
    
   

    public function loginFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFacebook(){
        // $users = Socialite::driver('facebook')->user();
        // $authUser = $this->findOrCreateUser($users,'Facebook');
        // $account_name = Login::where('id', $authUser->user)->first();
        // Session::put('name', $account_name->name);
        // Session::put('email', $account_name->email);
        // return Redirect::to('dashboard')->with('message', 'Welcome '.$account_name->name);

    }

    public function loginGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function findOrCreateUser($user,$provider){
        $authUser = Social::where('provider_user_id', $user->id)->first();
        // echo '<pre>';
        // print_r($authUser);
        // echo '</pre>';
        if($authUser){
           return $authUser;
        } else{
            $hieu = new Social([
                'provider' => strtoupper($provider),
                'provider_user_id' => $user->id,
                'user' => $user->name,
            ]);

            $orang = Login::where('email', $user->email)->first();
            if(!$orang){
                $orang = Login::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => '',
                    'phone' => '',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => NULL,
                ]);
            }
            $hieu->login() ->associate($orang);
            $hieu->save();
            // $account_name = Login::where('id', $authUser->user_id)->first();
            // Session::put('admin_login', $account_name->name);
            // return Redirect::to('dashboard')->with('message', 'Welcome '.$account_name->name);
            return $hieu;
        }
    }

    public function callbackGoogle(){
        $users = Socialite::driver('google')->user();
        $authUser = $this->findOrCreateUser($users,'Google');
        //echo '<pre>';print_r($authUser);echo '</pre>';
        $account_name = Login::where('id', $authUser->user_id)->first();
        Session::put('name', $account_name->name);
        return Redirect::to('dashboard')->with('message', 'Welcome '.$account_name->name);
        // echo '<pre>';
        // print_r($account_name);
        // echo '</pre>';
    }



}
