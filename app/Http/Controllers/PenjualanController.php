<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjualan;
use App\PenjualanDetail;
use App\Kategori;
use App\Member;
use App\Produk;
use App\UserModel;
use App\Setting;
use Redirect;
use PDF;

class PenjualanController extends Controller
{
   public function index()
   {
      $users   = UserModel::all()->where('level', '==', '2');
      $awal    = date('Y-m-d', mktime(0,0,0, date('m'), 1, date('Y')));
      $akhir   = date('Y-m-d');
      $user    = 0;
      $setting = Setting::find(1);
      return view('penjualan.index', compact('users', 'awal', 'akhir', 'user', 'setting')); 
   }

   protected function getData($awal, $akhir, $user)
   {
      if($user==0){
        $penjualan = Penjualan::leftJoin('users', 'users.id', '=', 'penjualan.id_user')
                    ->select('users.*', 'penjualan.*', 'penjualan.created_at as penjualan_created_at')
                    ->whereBetween('penjualan.created_at', [$awal, $akhir  = date('Y-m-d', strtotime("+1 day", strtotime($akhir)))])
                    ->where('status', '!=', 'retur')
                    ->get();
      }else{
        $penjualan = Penjualan::leftJoin('users', 'users.id', '=', 'penjualan.id_user')
                    ->select('users.*', 'penjualan.*', 'penjualan.created_at as penjualan_created_at')
                    ->whereBetween('penjualan.created_at', [$awal, $akhir = date('Y-m-d', strtotime("+1 day", strtotime($akhir)))])
                    ->where('users.id', '=', $user)
                    ->where('status', '!=', 'retur')
                    ->get();
      }

       $no         = 0;
       $data       = array();
       foreach($penjualan as $list){
         $no ++;
         $row    = array();
         $row[]  = $no;
         $row[]  = tanggal_indonesia($list->penjualan_created_at, false);
         $row[]  = $list->kode_member;
         $row[]  = $list->total_item;
         $row[]  = "Rp. ".format_uang($list->total_harga);
         $row[]  = $list->diskon."%";
         $row[]  = "Rp. ".format_uang($list->bayar);
         $row[]  = $list->name;
         $row[]  = '<div class="btn-group">
                    <a onclick="showDetail('.$list->id_penjualan.')" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                    <a onclick="destroyData('.$list->id_penjualan.')" class="btn btn-warning btn-sm"><i class="fa fa-mail-reply"></i></a>
                   </div>';
         $data[] = $row;
       }
       return $data;
   }

   public function listData($awal, $akhir, $user)
   {   
     $data   = $this->getData($awal, $akhir, $user);
     $output = array("data" => $data);
     return response()->json($output);
   }

   public function refresh(Request $request)
   {
     $users   = UserModel::all()->where('level', '==', '2');
     $awal    = $request['awal'];
     $akhir   = $request['akhir'];
     $user    = $request['user'];
     $setting = Setting::find(1);
     return view('penjualan.index', compact('users', 'awal', 'akhir', 'user', 'setting')); 
   }

   public function exportPDF($awal, $akhir, $user)
   {
    if($user==0){
      $penjualan = Penjualan::leftJoin('users', 'users.id', '=', 'penjualan.id_user')
                    ->select('users.*', 'penjualan.*', 'penjualan.created_at as penjualan_created_at')
                    ->whereBetween('penjualan.created_at', [$awal, $akhir  = date('Y-m-d', strtotime("+1 day", strtotime($akhir)))])
                    ->get();
    }else{
      $penjualan = Penjualan::leftJoin('users', 'users.id', '=', 'penjualan.id_user')
                    ->select('users.*', 'penjualan.*', 'penjualan.created_at as penjualan_created_at')
                    ->whereBetween('penjualan.created_at', [$awal, $akhir  = date('Y-m-d', strtotime("+1 day", strtotime($akhir)))])
                    ->where('users.id', '=', $user)
                    ->get();
    }

       $no       = 0;
       $data     = array();
       foreach($penjualan as $list){
         $no ++;
         $row    = array();
         $row[]  = $no;
         $row[]  = tanggal_indonesia($list->penjualan_created_at, false);
         $row[]  = $list->kode_member;
         $row[]  = $list->total_item;
         $row[]  = "Rp. ".format_uang($list->total_harga);
         $row[]  = $list->diskon."%";
         $row[]  = "Rp. ".format_uang($list->bayar);
         $row[]  = $list->name;
         $data[] = $row;
       }
     $pdf        = PDF::loadView('penjualan.pdf', compact('awal', 'akhir', 'user', 'data'));
     $pdf->setPaper('a4', 'potrait');
     return $pdf->stream();
   }

//AksiController

   public function show($id)
   {
     $detail  = PenjualanDetail::leftJoin('produk', 'produk.kode_produk', '=', 'penjualan_detail.kode_produk')
                  ->leftJoin('kategori', 'produk.id_kategori', '=', 'kategori.id_kategori')
                  ->select('produk.*', 'kategori.*', 'penjualan_detail.*')
                  ->where('id_penjualan', '=', $id)
                  ->get();
     $no      = 0;
     $data    = array();
     foreach($detail as $list){
      if($list->sertifikat == 'Ya'){
        $aksi  = '<div class="btn-group">
                    <a href="riwayat/pdf/'.$list->id_penjualan_detail.'" target="_blank" class="btn btn-primary btn-sm">
                      <i class="fa fa-file-pdf-o"></i>
                    </a>
                 </div>';
      }else{
        $aksi  = "Tidak Garansi";
      }
       $no ++;
       $row    = array();
       $row[]  = $no;
       $row[]  = $list->kode_produk;
       $row[]  = $list->nama_produk;
       $row[]  = $list->nama_kategori;
       $row[]  = "Rp. ".format_uang($list->harga_jual);
       $row[]  = $list->jumlah;
       $row[]  = $list->diskon."%";
       $row[]  = "Rp. ".format_uang($list->sub_total);
       $row[]  = $aksi;
       $data[] = $row;
     }
     $output   = array("data" => $data);
     return response()->json($output);
   }

   public function detailpdf($id)
   {
    $penjualan = PenjualanDetail::leftJoin('penjualan', 'penjualan.id_penjualan', '=', 'penjualan_detail.id_penjualan')
                   ->leftJoin('member', 'member.kode_member', '=', 'penjualan.kode_member')
                   ->leftJoin('produk', 'produk.kode_produk', '=', 'penjualan_detail.kode_produk')
                   ->leftJoin('kategori', 'produk.id_kategori', '=', 'kategori.id_kategori')
                   ->select('penjualan.*', 'member.*', 'produk.*', 'kategori.*', 'penjualan.created_at as tanggal')
                   ->where('penjualan_detail.id_penjualan_detail', '=', $id)
                   ->first();
    $data      = $penjualan;
    $setting   = Setting::find(1);
    $pdf       = PDF::loadView('penjualan.sertifikat', compact('data', 'setting'));
    $pdf->setPaper('a4', 'landscape');
     
    return $pdf->stream();
   }

   public function destroy($id)
   {
      $penjualan         = Penjualan::find($id);
      $penjualan->status = "retur";
      $penjualan->update();

      $detail = PenjualanDetail::where('id_penjualan', '=', $id)->get();
      foreach($detail as $data){
        $produk        = Produk::where('kode_produk', '=', $data->kode_produk)->first();
        $produk->retur = $data->jumlah;
        $produk->update();
        $data->delete();
        echo json_encode(array('msg' => 'success'));
      }
   }

   public function hapus($id)
   {
    $penjualan = Penjualan::find($id);
    $penjualan->delete();
   }

   public function returData($awal, $akhir)
   {
     $penjualan = Penjualan::leftJoin('users', 'users.id', '=', 'penjualan.id_user')
                    ->select('users.*', 'penjualan.*', 'penjualan.created_at as penjualan_created_at')
                    ->whereBetween('penjualan.created_at', [$awal, $akhir  = date('Y-m-d', strtotime("+1 day", strtotime($akhir)))])
                    ->where('status', '=', 'retur')
                    ->get();

       $no      = 0;
       $data    = array();
       foreach($penjualan as $list){
         $no ++;
         $row    = array();
         $row[]  = $no;
         $row[]  = tanggal_indonesia($list->penjualan_created_at, false);
         $row[]  = $list->kode_member;
         $row[]  = $list->total_item;
         $row[]  = "Rp. ".format_uang($list->total_harga);
         $row[]  = $list->diskon."%";
         $row[]  = "Rp. ".format_uang($list->bayar);
         $row[]  = $list->name;
         $row[]  = '<div class="btn-group">
                      <a onclick="deleteData('.$list->id_penjualan.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                    </div>';
         $data[] = $row;
        }
       $output   = array("data" => $data);
     return response()->json($output);
   }

   public function returPDF($awal, $akhir)
   {
    $penjualan = Penjualan::leftJoin('users', 'users.id', '=', 'penjualan.id_user')
                  ->select('users.*', 'penjualan.*', 'penjualan.created_at as penjualan_created_at')
                  ->whereBetween('penjualan.created_at', [$awal, $akhir  = date('Y-m-d', strtotime("+1 day", strtotime($akhir)))])
                  ->where('status', '=', 'retur')
                  ->get();

       $no     = 0;
       $data   = array();
       foreach($penjualan as $list){
         $no ++;
         $row    = array();
         $row[]  = $no;
         $row[]  = tanggal_indonesia($list->penjualan_created_at, false);
         $row[]  = $list->kode_member;
         $row[]  = $list->total_item;
         $row[]  = "Rp. ".format_uang($list->total_harga);
         $row[]  = $list->diskon."%";
         $row[]  = "Rp. ".format_uang($list->bayar);
         $row[]  = $list->name;
         $data[] = $row;
       }
     $pdf        = PDF::loadView('penjualan.returpdf', compact('awal', 'akhir', 'data'));
     $pdf->setPaper('a4', 'potrait');
     return $pdf->stream();
   }

}
