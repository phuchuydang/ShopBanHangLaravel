<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'tbl_order';
    protected $primaryKey = 'order_id';
    protected $fillable = 
        [ 'customer_id', 'shipping_id', 'order_status','order_code'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
