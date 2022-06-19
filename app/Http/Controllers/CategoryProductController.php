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
        return view('admin.all_category_product');
    }

    public function saveCategoryProduct(Request $request)
    {
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;
        $result = DB::table('tbl_category_product')->insert($data);
        if ($result) {
            $message = "Category Product Added Successfully";
            Session::put('Notification', $message);
            return Redirect::to('/add-category-product');
        } else {
            $$message = "Category Product Not Added Fail";
            return Redirect::to('/add-category-product');
        }
    }
}
