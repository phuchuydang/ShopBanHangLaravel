<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'devvn_xaphuongthitran';
    
    protected $primaryKey = 'xaid';
    protected $fillable = ['nameward', 'type','maqh'];

    public function district()
    {
        return $this->belongsTo('App\Models\Province', 'maqh', 'maqh');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City', 'matp', 'matp');
    }

    public function feeship()
    {
        return $this->hasMany('App\Models\Feeship', 'feeship_xaid', 'xaid');
    }

    
}
