<?php

namespace App\Http\Controllers;

use App\Models\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//Socialite
//use Socialite
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Login;
use App\Models\Social;
use Illuminate\Support\Facades\Log;

use phpDocumentor\Reflection\Types\This;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use App\Models\City;
use App\Models\Province;
use App\Models\Ward;
use App\Models\Feeship;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shipping;
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
        $customer_id = DB::table('tbl_customer')->insertGetId($data);
        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);
        return Redirect::to('/show-checkout')->with('customer_name', $request->customer_name);
    }

    public function CheckOut(){
        $cate_product = DB::table('tbl_category_product')->where('category_status', 1)->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', 1)->get();
        //getuser by session
        $customer_id = Session::get('customer_id');
        $customer = DB::table('tbl_customer')->where('customer_id', $customer_id)->first();
        $cities = DB::table('devvn_tinhthanhpho')->orderBy('matp','asc')->get();
        return view('pages.checkout.show_checkout')->with('cate_product', $cate_product)->with('brand_product', $brand_product)->with('customer', $customer)
        ->with('customer_id', $customer_id)->with('cities', $cities);
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
        $data = $request->all();
        $customer_email = $data['customer_email'];
        $customer_password = md5($data['customer_password']);
        $customer = new Customer();
        Session::put('customer_email', $customer_email);
        Session::save() ;
        return $customer->getCustomerByEmailPassword($customer_email, $customer_password);
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


    public function Authenticate()
    {
        $admin_id = Session::get('name');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function manageOrder(){
        $this->Authenticate();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
        ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
        ->join('tbl_payment', 'tbl_order.payment_id', '=', 'tbl_payment.payment_id')
        ->select('tbl_order.*', 'tbl_customer.*', 'tbl_shipping.*', 'tbl_payment.*')
        ->orderBy('tbl_order.order_id', 'desc')->get();
    
        $manage_order = view('admin.order.manage_order')->with('all_order', $all_order);
        return view('admin_layout')->with('admin.manage_order', $manage_order);
    }

    public function viewOrder($order_id){
        $this->Authenticate();
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
        ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
        ->join('tbl_payment', 'tbl_order.payment_id', '=', 'tbl_payment.payment_id')
        ->join('tbl_order_details', 'tbl_order.order_id', '=', 'tbl_order_details.order_id')
        ->join('tbl_product', 'tbl_order_details.product_id', '=', 'tbl_product.product_id')
        ->select('tbl_order.*', 'tbl_customer.*', 'tbl_shipping.*', 'tbl_payment.*', 'tbl_order_details.*', 'tbl_product.*')
        ->where('tbl_order.order_id', $order_id)
        ->first();
        // /print_r($order_by_id);
        $view_order = view('admin.order.view_order')->with('order_by_id', $order_by_id);
        return view('admin_layout')->with('admin.view_order', $view_order);
    }

    public function getDistrictsCustomer(Request $request){
        $data = $request->all();
        if($data['action']){
                $output = '';
                if($data['action'] == 'city'){
                    $output= '<option>Choose Province</option>';
                    $districts = Province::where('matp', $data['ma_id'])->orderby('maqh','ASC')->get();
                    foreach ($districts as $district) {
                        $output = '<option value="'.$district->maqh.'">'.$district->nameprovince.'</option>';
                        echo $output;
                    }
                    
                } else {
                    $output = '<option value="">Choose Ward</option>';
                    $wards = Ward::where('maqh', $data['ma_id'])->orderby('xaid','ASC')->get();;
                    foreach ($wards as $ward) {
                        $output = '<option value="'.$ward->xaid.'">'.$ward->nameward.'</option>';
                        echo $output;
                    }

                }
                
        }
    }

    public function calFeeship(Request $request){
        $data = $request->all();
        if($data['city']){
            $city = $data['city'];
            $district = $data['province'];
            $ward = $data['ward'];
            $feeship = Feeship::where('feeship_matp', $city)->where('feeship_maqh', $district)->where('feeship_xaid', $ward)->get();
            if($feeship){
                foreach ($feeship as $v_feeship) {
                    Session::put('feeship', $v_feeship->feeship_price);
                    Session::save();
                }
            } else {
                Session::put('feeship', 0);
                Session::save();
            }
        }
        // return $data;
       
    }

    public function confirmOrder(Request $request){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data = $request->all();
        $shipping = new Shipping;
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_note = $data['shipping_note'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->created_at = now();
        $shipping->updated_at = NULL;
        $shipping->save();
        $shipping_id = $shipping->shipping_id;
        $order = new Order;
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping->shipping_id;
        $order->order_status = 1;
        $code = substr(md5(microtime()), rand(0, 26), 5);
        $order->order_code = $code;
        $order->created_at = now();
        $order->updated_at = NULL;
        $order->save();

    
        if(Session::get('cart')){
            $cart = Session::get('cart');
            foreach ($cart as $key => $value) {
                $order_detail = new OrderDetail;
                $order_detail->order_code = $code;
                $order_detail->product_id = $cart[$key]['product_id'];
                $order_detail->product_name = $cart[$key]['product_name'];
                $order_detail->product_price = $cart[$key]['product_price'];
                $order_detail->product_voucher = $data['voucher_code'];
                $order_detail->product_sales_quantity = $cart[$key]['product_qty'];
                $order_detail->created_at = now();
                $order_detail->updated_at = NULL;
                $order_detail->save();
            }
        } 
    }



}
