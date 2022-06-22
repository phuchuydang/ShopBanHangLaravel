<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class BrandProductController extends Controller
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

    public function addBrandProduct()
    {
        $this->Authenticate();
        return view('admin.add_brand_product');
    }

    public function saveBrandProduct(Request $request)
    {
        $this->Authenticate();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;
        $data['created_at'] = date('Y-m-d H:i:s');
        $result = DB::table('tbl_brand_product')->insert($data);
        if ($result) {
            $message = "Brand Product Added Successfully";
            Session::put('message', $message);
            return Redirect::to('/add-brand-product');
        } else {
            $message = "Brand Product Not Added Fail";
            Session::put('message', $message);
            return Redirect::to('/add-brand-product');
        }
      
    }

    public function allBrandProduct()
    {
        $this->Authenticate();
        $all_brand_product = DB::table('tbl_brand_product')->get();
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product', $manager_brand_product);
    }

    public function editBrandProduct($brand_product_id)
    {
        $this->Authenticate();
        $edit_brand_product = DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->get();
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product', $edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product', $manager_brand_product);
    }

    public function updateBrandProduct(Request $request, $brand_product_id)
    {
        $this->Authenticate();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
       // $data['brand_status'] = $request->brand_product_status;
        $data['updated_at'] = date('Y-m-d H:i:s');
        DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->update($data);
        Session::put('message', 'Cập nhật thương hiệu thành công');
        return Redirect::to('/all-brand-product');
    }

    public function deleteBrandProduct($brand_product_id)
    {
        $this->Authenticate();
        DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->delete();
        Session::put('message', 'Xóa thương hiệu thành công');
        return Redirect::to('/all-brand-product');
    }

    public function unactiveBrandProduct($brand_product_id)
    {
        $this->Authenticate();
        $result = DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->update(['brand_status' => 0]);
        if ($result) {
            $message = "Brand Product Unactive Successfully";
            Session::put('message', $message);
            return Redirect::to('/all-brand-product');
        } else {
            $message = "Brand Product Unactive Fail";
            Session::put('message', $message);
            return Redirect::to('/all-brand-product');
        }
    }

    public function activeBrandProduct($brand_product_id)
    {
        $this->Authenticate();
        $result = DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->update(['brand_status' => 1]);
        if ($result) {
            $message = "Brand Product Active Successfully";
            Session::put('message', $message);
            return Redirect::to('/all-brand-product');
        } else {
            $message = "Brand Product Active Fail";
            Session::put('message', $message);
            return Redirect::to('/all-brand-product');
        }
    }

    public function showBrandProduct($brand_id)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', 1)->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', 1)->get();
        $brand_name = DB::table('tbl_brand_product')->where('brand_id', $brand_id)->limit(1)->get();
        $brand_by_id = DB::table('tbl_product')->join('tbl_brand_product', 'tbl_product.brand_id', '=', 'tbl_brand_product.brand_id')
        ->where('tbl_product.brand_id', $brand_id)->get();
        return view('pages.brand.show_brand')->with('cate_product', $cate_product)->with('brand_product', $brand_product)
        ->with('brand_by_id', $brand_by_id)->with('brand_name', $brand_name);
        
    }
}
