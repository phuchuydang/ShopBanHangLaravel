<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'password',
        'name',
        'phone',
        'created_at',
        'updated_at',
    ];
    protected $table = 'tbl_admin';
    protected $primaryKey = 'id';
}
