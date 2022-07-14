<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tbl_contact';
    protected $primaryKey = 'contact_id';
    protected $fillable = ['contact_info', 'contact_info_map', 'contact_image', 'contact_fanpage'];
}
