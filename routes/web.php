 <?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::group(['middleware' => 'web'], function(){
   Route::get('user/profil', 'UserController@profil')->name('user.profil');
   Route::patch('user/{id}/change', 'UserController@changeProfil');

   Route::get('transaksi/baru', 'PenjualanDetailController@newSession')->name('transaksi.new');
   Route::get('transaksi/{id}/data', 'PenjualanDetailController@listData')->name('transaksi.data');
   Route::get('transaksi/cetaknota', 'PenjualanDetailController@printNota')->name('transaksi.cetak');
   Route::get('transaksi/notapdf', 'PenjualanDetailController@notaPDF')->name('transaksi.pdf');
   Route::post('transaksi/simpan', 'PenjualanDetailController@saveData');
   Route::get('transaksi/loadform/{diskon}/{total}/{diterima}', 'PenjualanDetailController@loadForm');
   Route::resource('transaksi', 'PenjualanDetailController');

   Route::get('riwayat', 'RiwayatController@index')->name('riwayat.index');
   Route::post('riwayat', 'RiwayatController@refresh')->name('riwayat.refresh');
   Route::get('riwayat/data/{awal}/{akhir}/{id_users}', 'RiwayatController@listData')->name('riwayat.data');
   Route::get('riwayat/pdf/{awal}/{akhir}/{id_users}', 'RiwayatController@exportPDF');
   Route::get('riwayat/{id}/lihat', 'RiwayatController@show');
   Route::get('riwayat/pdf/{id}', 'RiwayatController@detailpdf')->name('riwayat.cetak');
   Route::get('riwayat/{id}', 'RiwayatController@destroy');
   Route::get('riwayat/retur/{awal}/{akhir}', 'RiwayatController@returData');
   Route::get('riwayat/returpdf/{awal}/{akhir}', 'RiwayatController@returPDF');
   Route::get('riwayat/{id}/hapus', 'RiwayatController@hapus');

   Route::get('produkdetail/data/{users}', 'ProdukDetailController@listData')->name('produkdetail.data');
   Route::post('produkdetail/hapus', 'ProdukDetailController@deleteSelected');
   Route::post('produkdetail/cetak', 'ProdukDetailController@printBarcode');
   Route::get('produkdetail/retur', 'ProdukDetailController@retur');
   Route::get('produkdetail/returpdf', 'ProdukDetailController@returPDF');
   Route::resource('produkdetail', 'ProdukDetailController');

   Route::get('pembeliankasir', 'PembelianKasirController@index')->name('pembeliankasir.index');
   Route::post('pembeliankasir', 'PembelianKasirController@refresh')->name('pembeliankasir.refresh');
   Route::get('pembeliankasir/data/{awal}/{akhir}/{id_users}', 'PembelianKasirController@listData')->name('pembeliankasir.data');
   Route::get('pembeliankasir/pdf/{awal}/{akhir}/{id_users}', 'PembelianKasirController@exportPDF')->name('pembeliankasir.pdf');
   Route::get('pembeliankasir/{id}/tambah', 'PembelianKasirController@create')->name('pembeliankasir.create');
   Route::get('pembeliankasir/{id}/lihat', 'PembelianKasirController@show');
   Route::get('pembeliankasir/{id}/hapus', 'PembelianKasirController@destroy');
   Route::resource('pembelian_kasir', 'PembelianKasirController');

   Route::get('pembelian_detail_kasir/{id}/data', 'PembelianDetailKasirController@listData')->name('pembelian_detail_kasir.data');
   Route::get('pembelian_detail_kasir/loadform/{diskon}/{total}', 'PembelianDetailKasirController@loadForm');
   Route::resource('pembelian_detail_kasir', 'PembelianDetailKasirController');    

});

Route::group(['middleware' => ['web', 'cekuser:1' ]], function(){
   Route::get('kategori/data', 'KategoriController@listData')->name('kategori.data');
   Route::resource('kategori', 'KategoriController');

   Route::get('produk/data', 'ProdukController@listData')->name('produk.data');
   Route::post('produk/hapus', 'ProdukController@deleteSelected');
   Route::post('produk/cetak', 'ProdukController@printBarcode');
   Route::get('produk/retur', 'ProdukController@retur');
   Route::get('produk/returpdf', 'ProdukController@returPDF');
   Route::get('produk/{id}/detail', 'ProdukController@show');
   Route::resource('produk', 'ProdukController');

   Route::get('supplier/data', 'SupplierController@listData')->name('supplier.data');
   Route::resource('supplier', 'SupplierController');

   Route::get('member/data', 'MemberController@listData')->name('member.data');
   Route::post('member/cetak', 'MemberController@printCard');
   Route::resource('member', 'MemberController');

   Route::get('pengeluaran/data', 'PengeluaranController@listData')->name('pengeluaran.data');
   Route::resource('pengeluaran', 'PengeluaranController');


   Route::get('user/data', 'UserController@listData')->name('user.data');
   Route::resource('user', 'UserController');

   Route::get('pembelian', 'PembelianController@index')->name('pembelian.index');
   Route::post('pembelian', 'PembelianController@refresh')->name('pembelian.refresh');
   Route::get('pembelian/data/{awal}/{akhir}/{user}', 'PembelianController@listData')->name('pembelian.data');
   Route::get('pembelian/pdf/{awal}/{akhir}/{user}', 'PembelianController@exportPDF');
   Route::get('pembelian/{id}/lihat', 'PembelianController@show');
   Route::get('pembelian/{id}/hapus', 'PembelianController@destroy');
   // Route::get('pembelian/{id}/tambah', 'PembelianController@create');
   // Route::resource('pembelian', 'PembelianController');   

   // Route::get('pembelian_detail/{id}/data', 'PembelianDetailController@listData')->name('pembelian_detail.data');
   // Route::get('pembelian_detail/loadform/{diskon}/{total}', 'PembelianDetailController@loadForm');
   // Route::resource('pembelian_detail', 'PembelianDetailController');   

   Route::get('penjualan', 'PenjualanController@index')->name('penjualan.index');
   Route::post('penjualan', 'PenjualanController@refresh')->name('penjualan.refresh');
   Route::get('penjualan/data/{awal}/{akhir}/{user}', 'PenjualanController@listData')->name('penjualan.data');
   Route::get('penjualan/pdf/{awal}/{akhir}/{user}', 'PenjualanController@exportPDF');
   Route::get('penjualan/{id}/lihat', 'PenjualanController@show');
   Route::get('penjualan/detailpdf/{id}', 'PenjualanController@detailpdf')->name('penjualan.cetak');
   Route::get('penjualan/{id}', 'PenjualanController@destroy');
   Route::get('penjualan/retur/{awal}/{akhir}', 'PenjualanController@returData');
   Route::get('penjualan/returpdf/{awal}/{akhir}', 'PenjualanController@returPDF');
   Route::get('penjualan/{id}/hapus', 'PenjualanController@hapus');

   Route::get('laporan', 'LaporanController@index')->name('laporan.index');
   Route::post('laporan', 'LaporanController@refresh')->name('laporan.refresh');
   Route::get('laporan/data/{awal}/{akhir}', 'LaporanController@listData')->name('laporan.data'); 
   Route::get('laporan/pdf/{awal}/{akhir}', 'LaporanController@exportPDF');

   Route::resource('setting', 'SettingController');
});

