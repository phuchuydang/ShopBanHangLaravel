<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
class Product extends Model
{
    use HasFactory;
    //public $timestamps = false;
    protected $fillable = [
        'product_name',
        'category_id',
        'brand_id',
        'product_desc',
        'product_content',
        'product_price',
        'product_image',
        'product_status',
        'created_at',
        'updated_at',
    ];

    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';

    public function getProductByCategoryAndBrand()
    {
        //get category name and brand name as product name
        $product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
            ->join('tbl_brand_product', 'tbl_product.brand_id', '=', 'tbl_brand_product.brand_id')
            ->orderBy('product_id','asc')
            ->get();
        return $product;
    }

   public function saveProduct($request){
    
   }

   public function editProduct($request){
        //get category where category_status = 1
        $cate= Category::where('category_status', 1)->get();
        $brand= Brand::where('brand_status', 1)->get();
        $product = Product::find($request);
        $data = array();
        $data['cate'] = $cate;
        $data['brand'] = $brand;
        $data['product'] = $product;
        return $data;
   }
}
