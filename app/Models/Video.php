<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tbl_video';
    protected $primaryKey = 'video_id';
    protected $fillable = ['video_title', 'video_link', 'video_image', 'video_desc'];

}
