<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'devvn_tinhthanhpho';
    protected $primaryKey = 'matp';
    protected $fillable = ['namecity', 'type'];

    public function province()
    {
        return $this->hasMany(Province::class, 'matp', 'matp');
    }

    public function feeship()
    {
        return $this->hasMany(Feeship::class, 'feeship_matp', 'matp');
    }
    
}
