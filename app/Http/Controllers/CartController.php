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



    public function addCart(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session::get('cart');
        if ($cart==true) {
           $is_available = 0;
                foreach ($cart as $key => $value) {
                    if ($value['product_id'] == $data['cart_product_id']) {
                        $is_available++;
                        $cart[$key]['product_quantity'] = $cart[$key]['product_quantity'] + $data['cart_product_quantity'];
                        $cart[$key]['product_price'] = $cart[$key]['product_price'] + $data['cart_product_price'];
                        $cart[$key]['product_total'] = $cart[$key]['product_total'] + $data['cart_product_total'];
                        //tax = price
                        
                    }
                }
                if ($is_available == 0) {
                    $cart[] = array(
                        'session_id' => $session_id,
                        'product_id' => $data['cart_product_id'],
                        'product_name' => $data['cart_product_name'],
                        'product_price' => $data['cart_product_price'],
                        'product_qty' => $data['cart_product_qty'],
                        'product_image' => $data['cart_product_image'],
                        'product_total' => 0
                    
                );
                Session::put('cart', $cart);
               
            }
        } 
        else {
            $cart[] = array(
                'session_id' => $session_id,
                'product_id' => $data['cart_product_id'],
                'product_name' => $data['cart_product_name'],
                'product_price' => $data['cart_product_price'],
                'product_qty' => $data['cart_product_qty'],
                'product_image' => $data['cart_product_image'],
                'product_total' => 0
            
            );
          
        }
        Session::put('cart', $cart);
        Session::save();
        
        // echo '<script>alert("Thêm sản phẩm thành công")</script>';
        // echo '<pre>';
        // print_r(Session::get('cart'));
        // echo '</pre>';
        // Cart::destroy();    
    }
    public function AuthCart(){
        $cart = Session::get('cart');
        if ($cart) {
            return Redirect::to('/show-cart');
        } else {
            return Redirect::to('/');
        }
    }

    public function showCarts(){
        $this->AuthCart();
        $cart = Session::get('cart');
        $cate_product = DB::table('tbl_category_product')->where('category_status', 1)->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', 1)->get();
        return view('pages.cart.show_carts', compact('cart'))->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }

    // public function showCart()
    // {
    //     $cate_product = DB::table('tbl_category_product')->where('category_status', 1)->get();
    //     $brand_product = DB::table('tbl_brand_product')->where('brand_status', 1)->get();
    //     //Cart::destroy();
        
    //     return view('pages.cart.show_carts')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    // }

    public function deleteCart($rowId)
    {
        Cart::update($rowId, 0);
        Session::forget('voucher');
        return Redirect::to('/show-cart');
    }

    public function updateCartQuantity(Request $request)
    {
        $rowId = $request->id_product;
        $qty = $request->quantity;
        Cart::update($rowId, $qty);
        $priceTotal = $qty * Cart::get($rowId)->price;
        Cart::update($rowId, ['priceTotal' => $priceTotal]);
        return Redirect::to('/show-cart');
    }

    public function deleteAllCart()
    {
        Cart::destroy();
        //forget session cart
        Session::forget('cart');
        Session::forget('voucher');
        return Redirect::to('/show-cart');
    }

    public function deleteItem($session_id){
        $cart = Session::get('cart');
        if($cart==true){
            foreach ($cart as $key => $value) {
                if ($value['session_id'] == $session_id) {
                    unset($cart[$key]);
                }
                Session::put('cart', $cart);
                return redirect()->back()->with('message', 'Delete item success');
            }
        } else {
            return redirect()->back()->with('message', 'Delete item failed');
        }
    }

    public function updateCartQuantities(Request $request)
    {
        $data = $request->all();
        $cart = Session::get('cart');
        if ($cart==true) {
            foreach ($data['cart_quantity'] as $key => $qty) {
                foreach ($cart as $session => $val){
                    if($val['session_id'] == $key){
                        $cart[$session]['product_qty'] = $qty;
                        $cart[$session]['product_total'] = $qty * $val['product_price'];
                        

                    }

                }
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('message', 'Update quantity success');
        }
          
    }

    
}



