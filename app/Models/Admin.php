<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Admin extends Authenticatable
{
    use HasFactory;
    protected $table = 'tbl_admin';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'email', 'password'];
    public $timestamps = false;

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function getAuthPassword()
    {
        return $this->password;
    }
}
