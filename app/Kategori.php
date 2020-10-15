<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
	protected $primaryKey = 'id_kategori';
	
	public function produk(){
		return $this->hasMany('App\Produk', 'id_kategori');
	}

	public function penjualan_detail(){
		return $this->hasMany('App\PenjualanDetail', 'id_kategori');
	}
}
