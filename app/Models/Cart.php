<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'tbl_cart';
    protected $primaryKey = 'cart_id';
    protected $fillable = ['cart_product_id', 'cart_quantity', 'cart_user_id', 'cart_price'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'cart_product_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'cart_user_id');
    }

    public function order()
    {
        return $this->hasMany('App\Models\Order', 'order_cart_id');
    }
}
