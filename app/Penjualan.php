<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan';
	protected $primaryKey = 'id_penjualan';

	public function users(){
		return $this->belongTo('App\UserModel');
	}

	public function penjualan_detail(){
		return $this->hasMany('App\PenjualanDetail', 'id_penjualan');
	}
}
