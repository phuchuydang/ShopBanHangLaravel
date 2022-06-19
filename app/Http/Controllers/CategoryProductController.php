<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryProductController extends Controller
{
    public function addCategoryProduct()
    {
        return view('admin.add_category_product');
    }

    public function allCategoryProduct()
    {
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product', $all_category_product);
        return view('admin_layout')->with('admin.all_category_product', $manager_category_product);
    }

    public function saveCategoryProduct(Request $request)
    {
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;
        $data['created_at'] = date('Y-m-d H:i:s');
        $result = DB::table('tbl_category_product')->insert($data);
        if ($result) {
            $message = "Category Product Added Successfully";
            Session::put('message', $message);
            return Redirect::to('/add-category-product');
        } else {
            $message = "Category Product Not Added Fail";
            Session::put('message', $message);
            return Redirect::to('/add-category-product');
        }
    }

    public function activeCategoryProduct($category_product_id)
    {
        $result = DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status' => 0]);
        if ($result) {
            $message = "Category Product Unactive Successfully";
            Session::put('message', $message);
            return Redirect::to('/all-category-product');
        } else {
            $message = "Category Product Unactive Fail";
            Session::put('message', $message);
            return Redirect::to('/all-category-product');
        }
    }

    public function unactiveCategoryProduct($category_product_id)
    {
        $result = DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status' => 1]);
        if ($result) {
            $message = "Category Product Active Successfully";
            Session::put('message', $message);
            return Redirect::to('/all-category-product');
        } else {
            $message = "Category Product Active Fail";
            Session::put('message', $message);
            return Redirect::to('/all-category-product');
        }
    }

    public function editCategoryProduct($category_product_id)
    {
        $edit_category_product = DB::table('tbl_category_product')->where('category_id', $category_product_id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product', $edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }

    public function updateCategoryProduct(Request $request, $category_product_id)
    {
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
       // $data['category_status'] = $request->category_product_status;
        $data['updated_at'] = date('Y-m-d H:i:s');
        $result = DB::table('tbl_category_product')->where('category_id', $category_product_id)->update($data);
        if ($result) {
            $message = "Category Product Update Successfully";
            Session::put('message', $message);
            return Redirect::to('/all-category-product');
        } else {
            $message = "Category Product Update Fail";
            Session::put('message', $message);
            return Redirect::to('/all-category-product');
        }
    }

    public function deleteCategoryProduct($category_product_id)
    {
        $result = DB::table('tbl_category_product')->where('category_id', $category_product_id)->delete();
        if ($result) {
            $message = "Category Product Delete Successfully";
            Session::put('message', $message);
            return Redirect::to('/all-category-product');
        } else {
            $message = "Category Product Delete Fail";
            Session::put('message', $message);
            return Redirect::to('/all-category-product');
        }
    }
}
