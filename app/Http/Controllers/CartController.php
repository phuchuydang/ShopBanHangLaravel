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
        //update cart::total = product * quantity where id = $product_id
        //Cart::update($product_id, array('price' => $product_info->product_price, 'quantity' => $quantity));
       //Cart::destroy();
        return Redirect::to('/show-cart');
    }

    public function showCart()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', 1)->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', 1)->get();
        //Cart::destroy();
        
        return view('pages.cart.show_cart')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }

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
        Session::forget('cart');
        Session::forget('voucher');
        return Redirect::to('/show-cart');
    }
}




    // Dung Ajax va Swal
    // public function saveCart(Request $request)
    // {
    //     // $data = $request->all();
    //     // $session_id = substr(md5(microtime()), 0, 20);
    //     // $cart = Session::get('cart');
    //     // if ($cart) {
    //     //    $is_available = 0;
    //     //       foreach ($cart as $key => $value) {
    //     //         if ($value['product_id'] == $data['product_id']) {
    //     //              $is_available++;
    //     //              $cart[$key]['product_quantity'] = $cart[$key]['product_quantity'] + $data['product_quantity'];
    //     //              $cart[$key]['product_price'] = $cart[$key]['product_price'] + $data['product_price'];
    //     //              $cart[$key]['product_total'] = $cart[$key]['product_total'] + $data['product_total'];
    //     //         }
    //     //       }
    //     //         if ($is_available == 0) {
    //     //             $cart[] = array(
    //     //                 'session_id' => $session_id,
    //     //                 'product_id' => $data['cart_product_id'],
    //     //                 'product_name' => $data['cart_product_name'],
    //     //                 'product_price' => $data['cart_product_price'],
    //     //                 'product_qty' => $data['cart_product_qty'],
    //     //                 'product_image' => $data['cart_product_image'],
                    
    //     //             );
    //     //             Session::put('cart', $cart);
    //     //         }
    //     // } else {
    //     //     $cart[] = array(
    //     //         'session_id' => $session_id,
    //     //         'product_id' => $data['cart_product_id'],
    //     //         'product_name' => $data['cart_product_name'],
    //     //         'product_price' => $data['cart_product_price'],
    //     //         'product_qty' => $data['cart_product_qty'],
    //     //         'product_image' => $data['cart_product_image'],
            
    //     //     );
    //     //     Session::put('cart', $cart);
    //     // }
    //     // Session::save();
    //     //echo '<script>alert("Thêm sản phẩm thành công")</script>';
    //     // echo '<pre>';
    //     // print_r(Session::get('cart'));
    //     // echo '</pre>';
    //     Cart::destroy();
    // }

