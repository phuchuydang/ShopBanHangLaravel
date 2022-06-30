<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    //public $timestamps = false;
    protected $fillable = [
        'brand_name',
        'brand_desc',
        'brand_status',
        'created_at',
        'updated_at',
    ];

    protected $primaryKey = 'brand_id';
    protected $table = 'tbl_brand_product';
    //get brand by id
    // public function getBrandById($id)
    // {
    //     $brand = Brand::where('brand_id', $id)->get();
    //     return $brand;
    // }
}
