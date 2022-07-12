<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Gallery;
use Illuminate\Support\Facades\File;
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
        $cate = Category::all();
        $brand = Brand::all();
        return view('admin.product.add_product')->with('cate', $cate)->with('brand', $brand);       
    }

    //all product
    public function allProduct()
    {

        $this->Authenticate();
        $all_product = Product::all();
        $manager_product = view('admin.product.all_product')->with('all_product', $all_product);
        return view('admin_layout')->with('admin.product.all_product', $manager_product);
    }

    public function saveProduct(Request $request)
    {
        $this->Authenticate();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_sold'] = 0;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_status'] = $request->product_status;
        $data['category_id'] = $request->product_category;
        $data['brand_id'] = $request->product_brand;
        $data['product_image'] = $request->product_image;
        //get image address from folder
        //created at
        $path = '/uploads/product';
        $path_gal = '/uploads/gallery';
        $data['created_at'] = new \DateTime();
        $image = $request->file('product_image');
        if ($image) {
            $image_name = $image->getClientOriginalName();
            $name_image = current(explode('.', $image_name));
            $new_name = rand(123456789, 923456789) . rand( 0, time() ) . '.' . $image->getClientOriginalExtension(); 
            $image->move(public_path($path), $new_name);
            File::copy(public_path($path . '/' . $new_name), public_path($path_gal . '/' . $new_name));
            $data['product_image'] = $new_name;
          
        } 
        $pro_id = DB::table('tbl_product')->insertGetId($data);
        $gallery = new Gallery();
        $gallery->gallery_image = $new_name;
        $gallery->gallery_name = $name_image;
        $gallery->product_id = $pro_id;
        $gallery->save();
        Session::put('message', 'Add Product Successfully');
        return Redirect::to('/add-product');
    }

    public function editProduct($product_id)
    {
        $this->Authenticate();
        $cate = DB::table('tbl_category_product')->where('category_status', 1)->get();
        $brand = DB::table('tbl_brand_product')->where('brand_status', 1)->get();
        $product = DB::table('tbl_product')->where('product_id', $product_id)->get();
        $edit_product = view('admin.product.edit_product')->with('product', $product)->with('cate', $cate)->with('brand', $brand);
        return view('admin_layout')->with('admin.product.edit_product', $edit_product);

    }

    public function updateProduct(Request $request, $product_id)
    {
        $this->Authenticate();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
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

    public function deleteProduct(Request $request)
    {
        $this->Authenticate();
        $data = $request->all();
        $product_id = $data['product_id'];
        $isDeleteProduct = Product::find($product_id);
        $isDeleteProduct->delete();
       
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
        $slider = DB::table('tbl_sliders')->orderByDesc('slider_id')->take(4)->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status', 1)->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', 1)->get();
       
        $product_detail = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
        ->join('tbl_brand_product', 'tbl_product.brand_id', '=', 'tbl_brand_product.brand_id')
        ->join('tbl_gallery', 'tbl_product.product_id', '=', 'tbl_gallery.product_id')
        ->where('tbl_product.product_id',$product_id)->get();

        $product_details = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
        ->join('tbl_brand_product', 'tbl_product.brand_id', '=', 'tbl_brand_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get();
        
        
        foreach($product_detail as $key => $value){
            $category_id = $value->category_id;
            $product_id = $value->product_id;
            $brand_id = $value->brand_id;
        }
        //get category_id from
        $category_id = Product::where('product_id', $product_id)->first();
        $galery = DB::table('tbl_gallery')->where('product_id', $product_id)->get();
        $relative_product = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
        ->join('tbl_brand_product', 'tbl_product.brand_id', '=', 'tbl_brand_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])
        ->orderBy(DB::raw('RAND()'))->take(4)->get();
        
        
        return view('pages.product.show_detail')->with('cate_product', $cate_product)
        ->with('brand_product', $brand_product)
        ->with('gallery', $galery)
        ->with('product_detail', $product_detail)
        ->with('relative_product', $relative_product)
        ->with('product_details', $product_details)
        ->with('slider', $slider);
    }
}
