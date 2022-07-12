<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
session_start();
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {   
        $slider = DB::table('tbl_sliders')->orderByDesc('slider_id')->take(4)->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status', 1)->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', 1)->orderby('brand_id', 'desc')->get();
        $all_product = DB::table('tbl_product')->where('product_status', 1)->orderby('product_id', 'desc')->get();
        return view('pages.home')->with('cate_product', $cate_product)->with('brand_product', $brand_product)->with('all_product', $all_product)->with('slider', $slider);
    }
    public function search (Request $request)
    {
        $keyword = $request->keyword;
        $cate_product = DB::table('tbl_category_product')->where('category_status', 1)->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', 1)->orderby('brand_id', 'desc')->get();
        $all_product = DB::table('tbl_product')->where('product_name', 'like', '%'.$keyword.'%')->where('product_status', 1)->orderby('product_id', 'desc')->get();
        return view('pages.product.search_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product)
        ->with('all_product', $all_product);
    }

    // public function sendMail(){
    //     $to_name = "Dang Phuc Huy";
    //     //get email from oderid table order
    //     // $order_id = Session::get('order_id');
    //     // $order = DB::table('tbl_order')->where('order_id', $order_id)->first();
    //     // $email = $order->order_email;
    //     $to_email = "dphuytdt@gmail.com";
    //     $data = array("name" => "Mail from E Shopper", "body" => "Thank you for choosing us!");
    //     Mail::send('pages.send_mail', $data, function($message) use ($to_name, $to_email) {
    //         $message->to($to_email)->subject('Mail from E Shopper');
    //         $message->from($to_email, $to_name);
    //     });
    //     return redirect('/')->with('message','');
    // }
}
