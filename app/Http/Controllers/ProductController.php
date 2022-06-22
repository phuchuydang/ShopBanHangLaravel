<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
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

    public function addProduct()
    {
        $this->Authenticate();
        $cate = DB::table('tbl_category_product')->where('category_status', 1)->get();
        $brand = DB::table('tbl_brand_product')->where('brand_status', 1)->get();
        return view('admin.add_product')->with('cate', $cate)->with('brand', $brand);       
    }

    //all product
    public function allProduct()
    {
        $this->Authenticate();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
        ->join('tbl_brand_product', 'tbl_product.brand_id', '=', 'tbl_brand_product.brand_id')->orderBy('product_id','asc')->get();
        $manager_product = view('admin.all_product')->with('all_product', $all_product);
        return view('admin_layout')->with('admin.all_product', $manager_product);
    }

    public function saveProduct(Request $request)
    {
        $this->Authenticate();
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
        $this->Authenticate();
        $cate = DB::table('tbl_category_product')->where('category_status', 1)->get();
        $brand = DB::table('tbl_brand_product')->where('brand_status', 1)->get();
        $product = DB::table('tbl_product')->where('product_id', $product_id)->get();
        $edit_product = view('admin.edit_product')->with('product', $product)->with('cate', $cate)->with('brand', $brand);
        return view('admin_layout')->with('admin.edit_product', $edit_product);

    }

    public function updateProduct(Request $request, $product_id)
    {
        $this->Authenticate();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        //$data['product_status'] = $request->product_status;
        $data['category_id'] = $request->product_category;
        $data['brand_id'] = $request->product_brand;
        $data['product_image'] = $request->product_image;
        //get image address from folder
        //created at
        $data['created_at'] = new \DateTime();
        $image = $request->file('product_image');
        if($image) {
            //$image_name = $image->getClientOriginalName();
            //$name_image = current(explode('.', $image_name));
            $new_name = rand(123456789, 923456789) . rand( 0, time() ) . '.' . $image->getClientOriginalExtension(); 
            $image->move(public_path('/uploads/product'), $new_name);
            $data['product_image'] = $new_name;
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            Session::put('message', 'Update Product Successfully');
            return Redirect::to('/all-product');
        } else {
            $old_image = DB::table('tbl_product')->where('product_id', $product_id)->first();
            $old_image_name = $old_image->product_image;
            $data['product_image'] = $old_image_name;
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            Session::put('message', 'Update Product Successfully');
            return Redirect::to('/all-product');
        }
        
    }

    public function deleteProduct($product_id)
    {
        $this->Authenticate();
        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        Session::put('message', 'Delete Product Successfully');
        return Redirect::to('/all-product');
    }

    //active product
    public function activeProduct($product_id)
    {
        $this->Authenticate();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 1]);
        Session::put('message', 'Active Product Successfully');
        return Redirect::to('/all-product');
    }

    //unactive product
    public function unactiveProduct($product_id)
    {
        $this->Authenticate();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 0]);
        Session::put('message', 'Unactive Product Successfully');
        return Redirect::to('/all-product');
    }

    //product detail
    public function productDetail($product_id)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', 1)->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', 1)->get();
        $product_detail = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
        ->join('tbl_brand_product', 'tbl_product.brand_id', '=', 'tbl_brand_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get();
        foreach($product_detail as $key => $value){
            $category_id = $value->category_id;
        }
        $relative_product = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
        ->join('tbl_brand_product', 'tbl_product.brand_id', '=', 'tbl_brand_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();
        return view('pages.product.show_detail')->with('cate_product', $cate_product)
        ->with('brand_product', $brand_product)
        ->with('product_detail', $product_detail)
        ->with('relative_product', $relative_product);
    }
}
