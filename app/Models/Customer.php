<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class Customer extends Model
{
    use HasFactory;
    //public $timestamps = false;
    // protected $filltable = [
    //     'customer_name',
    //     'customer_email',
    //     'customer_password',
    //     'customer_phone',
    //     'customer_address',
    //     'created_at',
    //     'updated_at',
    // ];

    // protected $primaryKey = 'customer_id';
    // protected $table = 'tbl_customer';

    // public function __construct()
    // {
    //     parent::__construct();
    // }

   
}
