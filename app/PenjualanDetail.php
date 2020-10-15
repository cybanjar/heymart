<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    protected $table = 'penjualan_detail';
	protected $primaryKey = 'id_penjualan_detail';

	public function kategori(){
      return $this->belongsTo('App\Kategori');
    }

    public function penjualan(){
		return $this->belongTo('App\Penjualan');
	}
}
