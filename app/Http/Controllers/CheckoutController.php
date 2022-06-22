<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
class CheckoutController extends Controller
{
    
    public function loginCheckOut(Request $request)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', 1)->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', 1)->get();

        return view('pages.checkout.login_checkout')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }

    public function addCustomer(Request $request)
    {
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_address'] = $request->customer_address;
        $data['created_at'] = date('Y-m-d');
        $customer_id = DB::table('tbl_customer')->insert($data);
        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);
        return Redirect::to('/show-checkout');
    }

    public function CheckOut(){
        $cate_product = DB::table('tbl_category_product')->where('category_status', 1)->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', 1)->get();
        //getuser by session
        $customer_id = Session::get('customer_id');
        $customer = DB::table('tbl_customer')->where('customer_id', $customer_id)->first();
        
        return view('pages.checkout.show_checkout')->with('cate_product', $cate_product)->with('brand_product', $brand_product)->with('customer', $customer)
        ->with('customer_id', $customer_id);
    }

    public function saveCheckOut(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_note'] = $request->shipping_note;
        if(Session::get('customer_id') == NULL ){
            $data['customer_id'] = NULL;
        } else {
            $data['customer_id'] = Session::get('customer_id');
        }
    
        $data['created_at'] = date('Y-m-d');
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id', $shipping_id);
        return Redirect::to('/payment');
    }

    public function payment()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', 1)->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', 1)->get();
        $shipping_id = Session::get('shipping_id');
        $shipping = DB::table('tbl_shipping')->where('shipping_id', $shipping_id)->first();
        $customer_id = Session::get('customer_id');
        $customer = DB::table('tbl_customer')->where('customer_id', $customer_id)->first();
        return view('pages.checkout.payment')->with('cate_product', $cate_product)->with('brand_product', $brand_product)->with('shipping', $shipping)->with('customer', $customer);
    }

    public function logoutCheckOut()
    {
        Session::forget('customer_id');
        Session::forget('customer_name');
        return Redirect::to('/login-checkout');
    }

    public function loginCustomer(Request $request)
    {
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customer')->where('customer_email', $email)->where('customer_password', $password)->first();
        if($result){
            Session::put('customer_id', $result->customer_id);
            Session::put('customer_name', $result->customer_name);
            return Redirect::to('/show-checkout');
        } else {
            $message = "Wrong email or password";
            Session::put('message', $message);
            return Redirect::to('/login-checkout');
        }
    }

    public function orderPlace(Request $request)
    {
        $content = Cart::content();
        // echo "<pre>";
        // print_r($content);
        // echo "</pre>";
        $data = array();
        //payment_method
        $data['payment_method'] = $request->paymnet_option;
        $data['payment_status'] = 'In progress';
        $data['created_at'] = date('Y-m-d');
        $payment_id = DB::table('tbl_payment')->insertGetId($data);
        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'In progress';
        $order_data['created_at'] = date('Y-m-d');
        $order_id = DB::table('tbl_order')->insertGetId($order_data);
        foreach($content as $v_content){
            $order_details_data = array();
            $order_details_data['order_id'] = $order_id;
            $order_details_data['product_id'] = $v_content->id;
            $order_details_data['product_name'] = $v_content->name;
            $order_details_data['product_price'] = $v_content->price;
            $order_details_data['product_sales_quantity'] = $v_content->qty;
            //$order_details_data['created_at'] = date('Y-m-d');
            $order_details_data = DB::table('tbl_order_details')->insert($order_details_data);
        }
        if($data['payment_method'] == 3){
            echo "Thanh toán trực tuyến";
            //return Redirect::to('/momo');
        } else if($data['payment_method'] == 2){
            echo "Thanh toán qua thẻ";
            //return Redirect::to('/cash');
        } else {
            echo "Thanh toán tiền mặt";
            //return Redirect::to('/bank');
        }
        //return Redirect::to('/payment');
    }

}