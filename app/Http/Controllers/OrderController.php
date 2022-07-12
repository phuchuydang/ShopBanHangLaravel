<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//Socialite
//use Socialite
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;
use App\Models\Login;
use App\Models\Social;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use phpDocumentor\Reflection\Types\This;
use App\Rules\Captcha;
use Dotenv\Validator;
use App\Models\City;
use App\Models\Province;
use App\Models\Ward;
use App\Models\Feeship;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shipping;
use App\Models\Customer;
use App\Models\Voucher;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
session_start();

class OrderController extends Controller
{
    public function Authenticate()
    {
        $admin_id = Session::get('name');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function manageOrder()
    {
        $this->Authenticate();
        $order = Order::orderby('created_at', 'desc')->get();
        return view('admin.order.manage_order')->with(compact('order'));
    }

    public function viewOrder($order_code)
    {
       
       
        $order = Order::where('order_code', $order_code)->get();
        if(count($order) > 0){
            foreach ($order as $key => $orders) {
                $customer_id = $orders->customer_id;
                $shiping_id = $orders->shipping_id;
    
            }
        }
        $customer = Customer::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shiping_id)->first();
        $order_detail = OrderDetail::with('product')->where('order_code', $order_code)->get();

        // echo '<pre>';
        // print_r($order_detail);
        // echo '</pre>';
        return view('admin.order.view_order')->with(compact('order_detail', 'order', 'customer', 'shipping'));
        
    }

    public function printOrder($order_code)
    {
        $pdf = App::make('dompdf.wrapper');
 
        $pdf->loadHTML($this->print_order_convert($order_code));
        return $pdf->stream();
    }
 
    public function print_order_convert($order_code){
        $order = Order::where('order_code', $order_code)->get();
        if(count($order) > 0){
            foreach ($order as $key => $orders) {
                $customer_id = $orders->customer_id;
                $shiping_id = $orders->shipping_id;
    
            }
        }
        $customer = Customer::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shiping_id)->first();
        $order_detail = OrderDetail::with('product')->where('order_code', $order_code)->get();
        $html = '';

        $html .= '<style>
                    body {
                        font-family: DejaVu Sans, sans-serif;
                    }
                </style>';
        $html .= '<title>Bill_'.$order_code.'.pdf</title>';
        $html .= '<h1 style="text-align: center;">Bill For Shopping</h1>';
        $html .= '<h3 style="text-align: center;">(Odrer Code: '.$order_code.')</h3>';
        $html .= '<div>';
        $html .= '<div>';
        $html .= '<b>Customer';
        $html .= '</div>';
        $html .= '<p>Customer Name: '.$customer->customer_name.'</p>';
        $html .= '<p>Customer Address: '.$customer->customer_address.'</p>';
        $html .= '<p>Customer Phone: '.$customer->customer_phone.'</p>';
        $html .= '<p>Customer Email: '.$customer->customer_email.'</p>';
        $html .= '<div>';
        $html .= '<p><b>Shipping</p>';
        $html .= '</div>';
        $html .= '<p>Shipping Name: '.$shipping->shipping_name.'</p>';
        $html .= '<p>Shipping Address: '.$shipping->shipping_address.'</p>';
        $html .= '<p>Shipping Phone: '.$shipping->shipping_phone.'</p>';
        $html .= '<p>Shipping Email: '.$shipping->shipping_email.'</p>';
        $html .= '</div>';
        $html .= '<div>';
        $html .= '<p><b>Product Detail</p>';
        $html .= '</div>';
        $html .= '<table border="1" style="width: 100%; border-collapse: collapse;">';
        $html .= '<tr>';
        $html .= '<th style="padding: 10px;">Product Name</th>';
        $html .= '<th style="padding: 10px;">Product Image</th>';
        $html .= '<th style="padding: 10px;">Product Price</th>';
        $html .= '<th style="padding: 10px;">Product Quantity</th>';
        $html .= '<th style="padding: 10px;">Product Total</th>';
        $html .= '</tr>';
        $subtotal = 0;
        foreach ($order_detail as $key => $order_details) {
            $html .= '<tr>';
            $html .= '<td style="padding: 10px;">'.$order_details->product->product_name.'</td>';
            $html .= '<td style="padding: 10px;"><img src="'.asset('public/uploads/product/'.$order_details->product->product_image).'" 
            style="width: 100px;"></td>';
            $html .= '<td style="padding: 10px;">'.$order_details->product->product_price.'</td>';
            $html .= '<td style="padding: 10px;">'.$order_details->product_sales_quantity.'</td>';
            $html .= '<td style="padding: 10px;">'.$order_details->product_price * $order_details->product_sales_quantity .'</td>';
            $html .= '</tr>';
            $subtotal += $order_details->product_price * $order_details->product_sales_quantity;
            //get couvher code from table voucher
            $voucher_code = $order_details->product_voucher;
        }
        $html .= '</table>';
        //subtotal
    
        $html .= '<div style="text-align: right;">';
        $html .= '<p>Subtotal: '.$subtotal.'</p>';
        $html .= '<p>Vat: '.$subtotal * 0.1.'</p>';
        $html .= '<p>Shipping Fee: Free</p>';
        $totaltax = $subtotal * 0.1;
        $total = ($subtotal + $totaltax) ;
        if($voucher_code > 0){
            $html .= '<p>Voucher: '.$order_details->product_voucher .'</p>';
            //TOTAL
            //get voucher code from voucher
            $voucher = Voucher::where('voucher_code', $voucher_code)->first();
            $voucher_percent_discount = $voucher->voucher_percent_discount;
            $total+= ($subtotal - ($voucher_percent_discount*0.1));
            $html .= '<p>Total: '.$total.'</p>';
        } else {
            $html .= '<p>Voucher: N/A</p>';
            $html .= '<p>Subtotal: '.$total.'</p>';
        }
        //voucher percent discount from table voucher
        
        $html .= '</div>';

        return $html;


    }

    public function changeQuanity(Request $request){
        $data = $request->all();
        $oder = Order::find($data['id']);
        $oder->order_status = $data['status'];
        $oder->save();
        if($data['status'] == '2'){
           foreach ($data['order_product_id'] as $key1 => $product_id) {
                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
                foreach ($data['order_product_quanity'] as $key2 => $quantity) {
                    if($key1 == $key2){
                        $product_remain = $product_quantity - $quantity;
                        $product->product_quantity = $product_remain;
                        $product->product_sold += $quantity;
                        $product->save();
                    }
                }
            }
        } else if($data['status'] == '3'){
            foreach ($data['order_product_id'] as $key1 => $product_id) {
                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
                foreach ($data['order_product_quanity'] as $key2 => $quantity) {
                    if($key1 == $key2){
                        $product_remain = $product_quantity + $quantity;
                        $product->product_quantity = $product_remain;
                        $product->product_sold -= $quantity;
                        $product->save();
                    }
                }
            }
        }
    }
}
