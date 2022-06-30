<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $table = 'tbl_voucher';
    protected $fillable = ['voucher_name', 'voucher_code', 'voucher_amount', 'voucher_condition', 'voucher_percent_discount'];
    public $timestamps = true;
    //primary key
    public $primaryKey = 'voucher_id';
}
