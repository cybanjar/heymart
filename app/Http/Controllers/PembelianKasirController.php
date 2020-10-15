<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembelian;
use App\Supplier;
use App\PembelianDetail;
use App\Produk;
use App\Setting;
use App\User;
use Redirect;
use Auth;
use PDF;

class PembelianKasirController extends Controller
{
   public function index()
   {
      $id_users    = Auth::user()->id;
      $awal        = date('Y-m-d', mktime(0,0,0, date('m'), 1, date('Y')));
      $akhir       = date('Y-m-d');
      $supplier    = Supplier::all();
      $setting     = Setting::find(1);
      return view('pembelian_kasir.index', compact('id_users', 'awal', 'akhir', 'supplier', 'setting')); 
   }

   public function listData($awal, $akhir, $id_users)
   {
    $pembelian = Pembelian::leftJoin('supplier', 'supplier.id_supplier', '=', 'pembelian.id_supplier')
                    ->leftJoin('users', 'users.id', '=', 'pembelian.user')
                    ->select('pembelian.*', 'supplier.*', 'users.*', 'pembelian.created_at as tanggal')
                    ->whereBetween('pembelian.created_at', [$awal, $akhir = date('Y-m-d', strtotime("+1 day", strtotime($akhir)))])
                    ->where('id', '=', $id_users)
                    ->orderBy('pembelian.id_pembelian', 'desc')
                    ->get();
     $no        = 0;
     $data      = array();
     foreach($pembelian as $list){
       $no ++;
       $row     = array();
       $row[]   = $no;
       $row[]   = tanggal_indonesia($list->tanggal, false);
       $row[]   = $list->nama;
       $row[]   = $list->total_item;
       $row[]   = "Rp. ".format_uang($list->total_harga);
       $row[]   = $list->diskon."%";
       $row[]   = "Rp. ".format_uang($list->bayar);
       $row[]   = '<div class="btn-group">
                      <a onclick="showDetail('.$list->id_pembelian.')" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                      <a onclick="deleteData('.$list->id_pembelian.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                    </div>';
       $data[]  = $row;
     }
     $output    = array("data" => $data);
     return response()->json($output);
   }

   public function refresh(Request $request)
   {
    $awal       = $request['awal'];
    $akhir      = $request['akhir'];
    $id_users   = Auth::user()->id;
    $supplier    = Supplier::all();
    $setting    = Setting::find(1);
    return view('pembelian_kasir.index', compact('awal', 'akhir', 'id_users', 'supplier', 'setting')); 
   }

   public function exportPDF($awal, $akhir, $id_users)
    {
     $pembelian = Pembelian::leftJoin('supplier', 'supplier.id_supplier', '=', 'pembelian.id_supplier')
                    ->leftJoin('users', 'users.id', '=', 'pembelian.user')
                    ->select('pembelian.*', 'supplier.*', 'users.*', 'pembelian.created_at as tanggal')
                    ->whereBetween('pembelian.created_at', [$awal, $akhir = date('Y-m-d', strtotime("+1 day", strtotime($akhir)))])
                    ->where('id', '=', $id_users)
                    ->orderBy('pembelian.id_pembelian', 'desc')
                    ->get();
      $no        = 0;
      $data      = array();
      foreach($pembelian as $list){
       $no ++;
       $row     = array();
       $row[]   = $no;
       $row[]   = tanggal_indonesia(substr($list->tanggal, 0, 10), false);
       $row[]   = $list->nama;
       $row[]   = $list->total_item;
       $row[]   = "Rp. ".format_uang($list->total_harga);
       $row[]   = $list->diskon."%";
       $row[]   = "Rp. ".format_uang($list->bayar);
       $data[]  = $row;
      }
      $pdf     = PDF::loadView('pembelian_kasir.pdf', compact('awal', 'akhir', 'data'));
      $pdf->setPaper('a4', 'potrait');
       
      return $pdf->stream();
    }

   public function show($id)
   {
     $detail    = PembelianDetail::leftJoin('produk', 'produk.kode_produk', '=', 'pembelian_detail.kode_produk')
                    ->where('id_pembelian', '=', $id)
                    ->get();
     $no        = 0;
     $data      = array();
     foreach($detail as $list){
       $no ++;
       $row     = array();
       $row[]   = $no;
       $row[]   = $list->kode_produk;
       $row[]   = $list->nama_produk;
       $row[]   = "Rp. ".format_uang($list->harga_beli);
       $row[]   = $list->jumlah;
       $row[]   = "Rp. ".format_uang($list->harga_beli * $list->jumlah);
       $data[]  = $row;
     }
    
     $output    = array("data" => $data);
     return response()->json($output);
   }

   public function create($id)
   {
      $pembelian              = new Pembelian;
      $pembelian->id_supplier = $id;     
      $pembelian->total_item  = 0;     
      $pembelian->total_harga = 0;     
      $pembelian->diskon      = 0;     
      $pembelian->bayar       = 0;
      $pembelian->user        = 0;    
      $pembelian->save();

      session(['idpembelian' => $pembelian->id_pembelian]);
      session(['idsupplier'  => $id]);

      return Redirect::route('pembelian_detail_kasir.index');      
   }

   public function store(Request $request)
   {
      $pembelian              = Pembelian::find($request['idpembelian']);
      $pembelian->total_item  = $request['totalitem'];
      $pembelian->total_harga = $request['total'];
      $pembelian->diskon      = $request['diskon'];
      $pembelian->bayar       = $request['bayar'];
      $pembelian->user        = Auth::user()->id;
      $pembelian->update();
      $request->session()->forget('idpembelian');

      $detail          = PembelianDetail::where('id_pembelian', '=', $request['idpembelian'])->get();
      foreach($detail as $data){
        $produk        = Produk::where('kode_produk', '=', $data->kode_produk)->first();
        $produk->stok  += $pembelian->total_item;
        $produk->update();
      }
      return Redirect::route('pembelian_kasir.index');
   }
   
   public function destroy($id)
   {
      $pembelian       = Pembelian::find($id);
      $pembelian->delete();

      $detail          = PembelianDetail::where('id_pembelian', '=', $id)->get();
      foreach($detail as $data){
        $produk        = Produk::where('kode_produk', '=', $data->kode_produk)->first();
        $produk->stok -= $data->jumlah;
        $produk->update();
        $data->delete();
      }
   }
}
