<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function(Blueprint $table){
            $table->increments('id_produk');          
            $table->bigInteger('kode_produk')->unsigned();           
            $table->integer('id_kategori')->unsigned();
            $table->integer('id_user')->unsigned();              
            $table->string('nama_produk', 100);           
            $table->string('merk', 50);             
            $table->bigInteger('harga_beli')->unsigned();         
            $table->integer('diskon')->unsigned();             
            $table->bigInteger('harga_jual')->unsigned();          
            $table->integer('stok')->unsigned();
            $table->string('sertifikat', 10);
            $table->integer('status', 10);     
            $table->timestamps();         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {        
        Schema::drop('produk');
    }
}
