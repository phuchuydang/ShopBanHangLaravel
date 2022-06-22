<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
session_start();
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', 1)->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', 1)->orderby('brand_id', 'desc')->get();
        $all_product = DB::table('tbl_product')->where('product_status', 1)->orderby('product_id', 'desc')->limit(3)->get();
        return view('pages.home')->with('cate_product', $cate_product)->with('brand_product', $brand_product)->with('all_product', $all_product);
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
}
