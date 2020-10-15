<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'users';
   	protected $primaryKey = 'id';

   	public function produk(){
		return $this->hasMany('App\Produk', 'id_user');
	}

	public function penjualan(){
		return $this->hasMany('App\Penjualan', 'id_user');
	}
}
