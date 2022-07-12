<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'tbl_feeship';
    protected $fillable = ['feeship_matp', 'feeship_maqh', 'feeship_xaid', 'feeship_price'];
    protected $primaryKey = 'feeship_id';

    public function city()
    {
        return $this->belongsTo(City::class, 'feeship_matp', 'matp');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'feeship_maqh', 'maqh');
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class, 'feeship_xaid', 'xaid');
    }

}
