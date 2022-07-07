<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
class Customer extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_password',
        'customer_phone',
        'customer_address',
    ];
    protected $table = 'tbl_customer';
    protected $primaryKey = 'customer_id';

    public function getCustomerByEmailPassword($email, $password)
    {
        $customer = Customer::where('customer_email', $email)->where('customer_password', $password)->first();
        // echo '<pre>';
        // print_r($customer);
        // echo '</pre>';
         $login_count = Customer::where('customer_email', $email)
        ->where('customer_password', $password)->count();
        // echo '<pre>';
        // print_r($login_count);
        // echo '</pre>';
        if($login_count){
            Session::put('customer_id', $customer->customer_id);
            Session::put('customer_name', $customer->customer_name);
            Session::put('message', 'Login Successfully');
            Session::save();
            return  Redirect::to('/');
        } else {
            Session::put('message', 'Login Failed');
            Session::save();
            return Redirect::to('/login-checkout');
        }
    }
}
