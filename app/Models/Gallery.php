<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $table = 'tbl_gallery';
    protected $primaryKey = 'gallery_id';
    protected $fillable = ['gallery_name', 'gallery_image', 'product_id'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
