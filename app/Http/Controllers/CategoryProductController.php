<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryProductController extends Controller
{

    //admin
    public function Authenticate()
    {
        $admin_id = Session::get('name');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function addCategoryProduct()
    {
        return view('admin.category.add_category_product');
    }

    public function allCategoryProduct()
    {
        $this->Authenticate();
        $all_category_product = Category::all();
        $manager_category_product = view('admin.category.all_category_product')->with('all_category_product', $all_category_product);
        return view('admin_layout')->with('admin.category.all_category_product', $manager_category_product);
    }

    public function saveCategoryProduct(Request $request)
    {
        $data = $request->all();
        $category = new Category();
        $category->category_name = $data['category_product_name'];
        $category->category_desc = $data['category_product_desc'];
        $category->category_status = $data['category_product_status'];
        $category->created_at = date('Y-m-d H:i:s');
        //update data
        $category->updated_at = NULL;
        $category->save();
        if ($category) {
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
        $this->Authenticate();
        $category_product = Category::find($category_product_id);
        $category_product->category_status = 1;
        $category_product->save();
        if ($category_product) {
            $message = "Category Product Active Successfully";
            Session::put('message', $message);
            return Redirect::to('/all-category-product');
        } else {
            $message = "Category Product Active Fail";
            Session::put('message', $message);
            return Redirect::to('/all-category-product');
        }
    }

    public function unactiveCategoryProduct($category_product_id)
    {
        $this->Authenticate();
        $category_product = Category::find($category_product_id);
        $category_product->category_status = 0;
        $category_product->save();
        if ($category_product) {
            $message = "Category Product Unactive Successfully";
            Session::put('message', $message);
            return Redirect::to('/all-category-product');
        } else {
            $message = "Category Product Unactive Fail";
            Session::put('message', $message);
            return Redirect::to('/all-category-product');
        }
    }

    public function editCategoryProduct($category_product_id)
    {
        $this->Authenticate();
        $edit_category_product = Category::find($category_product_id);
        $manager_category_product = view('admin.category.edit_category_product')->with('edit_category_product', $edit_category_product);
        return view('admin_layout')->with('admin.category.edit_category_product', $manager_category_product);
    }

    public function updateCategoryProduct(Request $request, $category_product_id)
    {
        $this->Authenticate();
        $data = $request->all();
        $category_product = Category::find($category_product_id);
        $category_product->category_name = $data['category_product_name'];
        $category_product->category_desc = $data['category_product_desc'];
        $category_product->updated_at = date('Y-m-d H:i:s');
        $category_product->save();
        if ($category_product) {
            $message = "Category Product Update Successfully";
            Session::put('message', $message);
            return Redirect::to('/all-category-product');
        } else {
            $message = "Category Product Update Fail";
            Session::put('message', $message);
            return Redirect::to('/all-category-product');
        }
    }

    public function deleteCategoryProduct(Request $request)
    {
        $this->Authenticate();
        $data = $request->all();
        $category_product_id = $data['cate_id'];
        $category_product = Category::find($category_product_id);
        $category_product->delete();
        if ($category_product) {
            $message = "Category Product Delete Successfully";
            Session::put('message', $message);
            return Redirect::to('/all-category-product');
        } else {
            $message = "Category Product Delete Fail";
            Session::put('message', $message);
            return Redirect::to('/all-category-product');
        }
    }
    //User
    //show all category product
   
    public function showCategoryProduct($category_id)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', 1)->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', 1)->orderby('brand_id', 'desc')->get();
        $category_by_id = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
        ->where('tbl_product.category_id', $category_id)->get();
        //get category name
        $category_name = DB::table('tbl_category_product')->where('category_id', $category_id)->limit(1)->get();
        return view('pages.category.show_category')
        ->with('cate_product', $cate_product)->with('brand_product', $brand_product)
        ->with('category_by_id', $category_by_id)->with('category_name', $category_name);
    }
}
