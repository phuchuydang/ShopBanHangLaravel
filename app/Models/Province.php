<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'devvn_quanhuyen';
    protected $primaryKey = 'maqh';
    protected $fillable = ['nameprovincde', 'type','matp'];

    public function city()
    {
        return $this->belongsTo('App\Models\City', 'matp', 'matp');
    }

    public function ward()
    {
        return $this->hasMany('App\Models\Ward', 'maqh', 'maqh');
    }

    public function feeship()
    {
        return $this->hasMany('App\Models\Feeship', 'feeship_maqh', 'maqh');
    }
}
