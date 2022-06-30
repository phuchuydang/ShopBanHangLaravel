<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    //public $timestamps = false;
    protected $fillable = [
        'category_name',
        'category_desc',
        'category_status',
        'created_at',
        'updated_at',
    ];

    protected $primaryKey = 'category_id';
    protected $table = 'tbl_category_product';
}
