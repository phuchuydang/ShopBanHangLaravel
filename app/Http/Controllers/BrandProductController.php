<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Brand;
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
        return view('admin.brand.add_brand_product');
    }

    public function saveBrandProduct(Request $request)
    {
        $this->Authenticate();
        $data = $request->all();
        $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->created_at = date('Y-m-d H:i:s');
        //update data
        $brand->updated_at = NULL;
        $brand->save();
        if ($brand) {
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
        $all_brand_product = Brand::all();
        $manager_brand_product = view('admin.brand.all_brand_product')->with('all_brand_product', $all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product', $manager_brand_product);
    }

    public function editBrandProduct($brand_product_id)
    {
        $this->Authenticate();
        $edit_brand_product = Brand::find($brand_product_id);
        $manager_brand_product = view('admin.brand.edit_brand_product')->with('edit_brand_product', $edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product', $manager_brand_product);
    }

    public function updateBrandProduct(Request $request, $brand_product_id)
    {
        $this->Authenticate();
        $data = $request->all();
        $brand = Brand::find($brand_product_id);
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        //$brand->brand_status = $data['brand_product_status'];
        $brand->updated_at = date('Y-m-d H:i:s');
        $brand->save();
        if ($brand) {
            $message = "Brand Product Updated Successfully";
            Session::put('message', $message);
            return Redirect::to('/all-brand-product');
        } else {
            $message = "Brand Product Not Updated Fail";
            Session::put('message', $message);
            return Redirect::to('/all-brand-product');
        }
    }

    public function deleteBrandProduct(Request $request)
    {
        $this->Authenticate();
        $data = $request->all();
        $brand_product_id = $data['brand_id'];
        $brand = Brand::find($brand_product_id);
        $brand->delete();
    }

    public function unactiveBrandProduct($brand_product_id)
    {
        $this->Authenticate();
        $brand = Brand::find($brand_product_id);
        $brand->brand_status = 0;
        $brand->save();
        if ($brand) {
            $message = "Brand Product Unactive Successfully";
            Session::put('message', $message);
            return Redirect::to('/all-brand-product');
        } else {
            $message = "Brand Product Not Unactive Fail";
            Session::put('message', $message);
            return Redirect::to('/all-brand-product');
        }
    }

    public function activeBrandProduct($brand_product_id)
    {
        $this->Authenticate();
        $brand = Brand::find($brand_product_id);
        $brand->brand_status = 1;
        $brand->save();
        if ($brand) {
            $message = "Brand Product Active Successfully";
            Session::put('message', $message);
            return Redirect::to('/all-brand-product');
        } else {
            $message = "Brand Product Not Active Fail";
            Session::put('message', $message);
            return Redirect::to('/all-brand-product');
        }
    }

    public function showBrandProduct($brand_id)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', 1)->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_id', $brand_id)->get();
        $brand_name = DB::table('tbl_brand_product')->where('brand_id', $brand_id)->limit(1)->get();
        $brand_by_id = DB::table('tbl_product')->join('tbl_brand_product', 'tbl_product.brand_id', '=', 'tbl_brand_product.brand_id')
        ->where('tbl_product.brand_id', $brand_id)->get();
        return view('pages.brand.show_brand')->with('cate_product', $cate_product)->with('brand_product', $brand_product)
        ->with('brand_by_id', $brand_by_id)->with('brand_name', $brand_name);
        
    }
}
