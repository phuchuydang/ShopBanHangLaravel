<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use Whoops\Run;

class CartController extends Controller
{
    public function saveCart(Request $request)
    {
        $product_id = $request->product_id_hidden;
        $quantity = $request->quantity;
        $product_info = DB::table('tbl_product')->where('product_id', $product_id)->first();
        $data['id'] = $product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = '123';
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);
        // //get % of price
        $percent = $product_info->product_price * 0.1;
        //set taxt
        Cart::tax($percent);
       //Cart::destroy();
        return Redirect::to('/show-cart');
    }

    public function showCart()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', 1)->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', 1)->get();
        return view('pages.cart.show_cart')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }

    public function deleteCart($rowId)
    {
        Cart::update($rowId, 0);
        return Redirect::to('/show-cart');
    }

    public function updateCartQuantity(Request $request)
    {
        $rowId = $request->id_product;
        $qty = $request->quantity;
        Cart::update($rowId, $qty);
        return Redirect::to('/show-cart');
    }

}
