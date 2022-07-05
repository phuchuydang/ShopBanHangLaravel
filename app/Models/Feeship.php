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

    public function getInfor(){
        $feeship = Feeship::join('devvn_xaphuongthitran', 'devvn_xaphuongthitran.xaid', '=', 'tbl_feeship.feeship_xaid')
        ->join('devvn_quanhuyen', 'devvn_quanhuyen.maqh', '=', 'devvn_xaphuongthitran.maqh')
        ->join('devvn_tinhthanhpho', 'devvn_tinhthanhpho.matp', '=', 'devvn_quanhuyen.matp')
        ->select('tbl_feeship.*', 'devvn_tinhthanhpho.*', 'devvn_quanhuyen.*', 'devvn_xaphuongthitran.*')
        ->get();
        return $feeship;
    }

    public function getInforWithCondition($id){
        $feeship = Feeship::join('devvn_xaphuongthitran', 'devvn_xaphuongthitran.xaid', '=', 'tbl_feeship.feeship_xaid')
        ->join('devvn_quanhuyen', 'devvn_quanhuyen.maqh', '=', 'devvn_xaphuongthitran.maqh')
        ->join('devvn_tinhthanhpho', 'devvn_tinhthanhpho.matp', '=', 'devvn_quanhuyen.matp')
        ->where('tbl_feeship.feeship_id', $id)
        ->select('tbl_feeship.*', 'devvn_tinhthanhpho.*', 'devvn_quanhuyen.*', 'devvn_xaphuongthitran.*')
        ->get();
        return $feeship;
    }

}
