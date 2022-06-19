<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function addProduct()
    {
        $cate = DB::table('tbl_category_product')->where('category_status', 1)->get();
        $brand = DB::table('tbl_brand_product')->where('brand_status', 1)->get();
        return view('admin.add_product')->with('cate', $cate)->with('brand', $brand);       
    }

    //all product
    public function allProduct()
    {
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product')->where('tbl_product.category_id', '=', 'tbl_category_product.category_id')
        ->join('tbl_brand_product')->where('tbl_product.brand_id', '=', 'tbl_brand_product.brand_id')->orderByDesc('tbl_product.product_id')->get();
        $manager_product = view('admin.all_product')->with('all_product', $all_product);
        return view('admin_layout')->with('admin.all_product', $manager_product);
    }

    public function saveProduct(Request $request)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_status'] = $request->product_status;
        $data['category_id'] = $request->product_category;
        $data['brand_id'] = $request->product_brand;
        $data['product_image'] = $request->product_image;
        //get image address from folder
        //created at
        $data['created_at'] = new \DateTime();
        $image = $request->file('product_image');
        if ($image) {
            //$image_name = $image->getClientOriginalName();
            //$name_image = current(explode('.', $image_name));
            $new_name = rand(123456789, 923456789) . rand( 0, time() ) . '.' . $image->getClientOriginalExtension(); 
            $image->move(public_path('/uploads/product'), $new_name);
            $data['product_image'] = $new_name;
            $product_id = DB::table('tbl_product')->insertGetId($data);
            Session::put('message', 'Add Product Successfully');
            return Redirect::to('/add-product');
        } 
    }

    public function editProduct($product_id)
    {
        $cate = DB::table('tbl_category_product')->where('category_status', 1)->get();
        $brand = DB::table('tbl_brand_product')->where('brand_status', 1)->get();
        $product = DB::table('tbl_product')->where('product_id', $product_id)->get();
        return view('admin.edit_product')->with('cate', $cate)->with('brand', $brand)->with('product', $product);
    }

    // public function updateProduct(Request $request, $product_id)
    // {
    //     $data = array();
    //     $data['product_name'] = $request->product_name;
    //     $data['product_price'] = $request->product_price;
    //     $data['product_desc'] = $request->product_desc;
    //     $data['product_content'] = $request->product_content;
    //     $data['product_status'] = $request->product_status;
    //     $data['category_id'] = $request->product_category;
    //     $data['brand_id'] = $request->product_brand;
    //     $data['product_image'] = $request->product_image;
    //     //get image address from folder
    //     //created at
    //     $data['created_at'] = new \DateTime();
    //     $image = $request->file('product_image');
    // }
}
