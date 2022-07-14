<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'tbl_comment';
    protected $primaryKey = 'comment_id';
    protected $fillable = ['comment_name', 'comment_content', 'comment_email', 'comment_date', 'comment_product_id' , 'comment_status', 'comment_parent'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'comment_product_id', 'product_id');
    }
}
