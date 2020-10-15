<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjualan;
use App\Produk;
use App\Member;
use App\Setting;
use App\PenjualanDetail;
use App\User;
use Redirect;
use Auth;
use PDF;

class PenjualanDetailController extends Controller
{
   public function index(){
      $id_user  = Auth::user()->id;
      $produk   = Produk::where('id_user', '=', $id_user)->where('stok', '>', '0')->get();
      $member   = Member::all();
      $setting  = Setting::first();

     if(!empty(session('idpenjualan'))){
       $idpenjualan = session('idpenjualan');
       $penjualan   = Penjualan::find($idpenjualan);

       if($penjualan->status == "selesai"){
        return Redirect::route('home');
       }else{
        return view('penjualan_detail.index', compact('id_user', 'produk', 'member', 'setting', 'idpenjualan', 'kategori', 'penjualan'));
       }
     }else{
       return Redirect::route('home');  
     }
   }

   public function listData($id)
   {
      $detail    = PenjualanDetail::leftJoin('produk', 'produk.kode_produk', '=', 'penjualan_detail.kode_produk')
                    ->select('penjualan_detail.*', 'produk.*')
                    ->where('id_penjualan', '=', $id)
                    ->get();
     $no         = 0;
     $data       = array();
     $total      = 0;
     $total_item = 0;
     foreach($detail as $list){
       $no ++;
       $row    = array();
       $row[]  = $no;
       $row[]  = $list->kode_produk;
       $row[]  = $list->nama_produk;
       $row[]  = "Rp. ".format_uang($list->harga_jual);
       $row[]  = "<input type='number' class='form-control' id='jumlah' name='jumlah_$list->id_penjualan_detail' value='$list->jumlah' onChange='changeCount($list->id_penjualan_detail, $list->stok)' max='".$list->stok."' min='1'>";
       $row[]  = $list->diskon."%";
       $row[]  = "Rp. ".format_uang($list->sub_total);
       $row[]  = '<div class="btn-group">
                    <a onclick="deleteItem('.$list->id_penjualan_detail.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                  </div>';
       $data[] = $row;

       $total      += $list->harga_jual * $list->jumlah;
       $total_item += $list->jumlah;
     }

     $data[] = array("<span class='hide total'>$total</span><span class='hide totalitem'>$total_item</span>", "", "", "", "", "", "", "");
     $output = array("data" => $data);
     return response()->json($output);
   }

   public function store(Request $request)
   {
        $produk = Produk::where('kode_produk', '=', $request['kode'])->first();
        $detail               = new PenjualanDetail;
        $detail->id_penjualan = $request['idpenjualan'];
        $detail->kode_produk  = $request['kode'];
        $detail->harga_jual   = $produk->harga_jual;
        $detail->jumlah       = 1;
        $detail->diskon       = $produk->diskon;
        $detail->sub_total    = $produk->harga_jual - ($produk->diskon/100 * $produk->harga_jual);
        $detail->save();
   }

   public function update(Request $request, $id)
   {
      $nama_input        = "jumlah_".$id;
      $detail            = PenjualanDetail::find($id);
      $total_harga       = $request[$nama_input] * $detail->harga_jual;
      $detail->jumlah    = $request[$nama_input];
      $detail->sub_total = $total_harga - ($detail->diskon/100 * $total_harga);
      $detail->update();
   }

   public function destroy($id)
   {
      $detail = PenjualanDetail::find($id);
      $detail->delete();
   }

   public function newSession()
   {
      $penjualan              = new Penjualan; 
      $penjualan->kode_member = 0;    
      $penjualan->total_item  = 0;    
      $penjualan->total_harga = 0;    
      $penjualan->diskon      = 0;    
      $penjualan->bayar       = 0;    
      $penjualan->diterima    = 0;    
      $penjualan->id_user     = Auth::user()->id;
      $penjualan->status      = 0;    
      $penjualan->save();
      
      session(['idpenjualan' => $penjualan->id_penjualan]);

      return Redirect::route('transaksi.index');    
   }

   public function saveData(Request $request)
   {
      $penjualan              = Penjualan::find($request['idpenjualan']);
      $penjualan->kode_member = $request['member'];
      $penjualan->total_item  = $request['totalitem'];
      $penjualan->total_harga = $request['total'];
      $penjualan->diskon      = $request['diskon'];
      $penjualan->bayar       = $request['bayar'];
      $penjualan->diterima    = $request['diterima'];
      $penjualan->status      = "selesai";
      $penjualan->update();

      $detail                 = PenjualanDetail::where('id_penjualan', '=', $request['idpenjualan'])->get();
      foreach($detail as $data){
        $produk        = Produk::where('kode_produk', '=', $data->kode_produk)->first();
        $produk->stok -= $data->jumlah;
        $produk->update();
      }
      return Redirect::route('transaksi.cetak');
   }
   
   public function loadForm($diskon, $total, $diterima){
     $bayar   = $total - ($diskon / 100 * $total);
     $kembali = ($diterima != 0) ? $diterima - $bayar : 0;

     $data    = array(
                "totalrp"          => format_uang($total),
                "bayar"            => $bayar,
                "bayarrp"          => format_uang($bayar),
                "terbilang"        => ucwords(terbilang($bayar))." Rupiah",
                "kembalirp"        => format_uang($kembali),
                "kembaliterbilang" => ucwords(terbilang($kembali))." Rupiah"
      );
     return response()->json($data);
   }

   public function printNota()
   {
      $detail    = PenjualanDetail::leftJoin('produk', 'produk.kode_produk', '=', 'penjualan_detail.kode_produk')
                    ->where('id_penjualan', '=', session('idpenjualan'))
                    ->get();

      $penjualan = Penjualan::find(session('idpenjualan'));
      $setting   = Setting::find(1);
      
      if($setting->tipe_nota == 0){
        $handle  = printer_open(); 
        printer_start_doc($handle, "Nota");
        printer_start_page($handle);

        $font    = printer_create_font("Consolas", 100, 80, 600, false, false, false, 0);
        printer_select_font($handle, $font);
        
        printer_draw_text($handle, $setting->nama_perusahaan, 400, 100);

        $font    = printer_create_font("Consolas", 72, 48, 400, false, false, false, 0);
        printer_select_font($handle, $font);
        printer_draw_text($handle, $setting->alamat, 50, 200);

        printer_draw_text($handle, date('Y-m-d'), 0, 400);
        printer_draw_text($handle, substr("             ".Auth::user()->name, -15), 600, 400);

        printer_draw_text($handle, "No : ".substr("00000000".$penjualan->id_penjualan, -8), 0, 500);

        printer_draw_text($handle, "============================", 0, 600);
        
        $y = 700;
        
        foreach($detail as $list){           
           printer_draw_text($handle, $list->kode_produk." ".$list->nama_produk, 0, $y+=100);
           printer_draw_text($handle, $list->jumlah." x ".format_uang($list->harga_jual), 0, $y+=100);
           printer_draw_text($handle, substr("                ".format_uang($list->harga_jual*$list->jumlah), -10), 850, $y);

           if($list->diskon != 0){
              printer_draw_text($handle, "Diskon", 0, $y+=100);
              printer_draw_text($handle, substr("                      -".format_uang($list->diskon/100*$list->sub_total), -10),  850, $y);
           }
        }
        
        printer_draw_text($handle, "----------------------------", 0, $y+=100);

        printer_draw_text($handle, "Total Harga: ", 0, $y+=100);
        printer_draw_text($handle, substr("           ".format_uang($penjualan->total_harga), -10), 850, $y);

        printer_draw_text($handle, "Total Item: ", 0, $y+=100);
        printer_draw_text($handle, substr("           ".$penjualan->total_item, -10), 850, $y);

        printer_draw_text($handle, "Diskon Member: ", 0, $y+=100);
        printer_draw_text($handle, substr("           ".$penjualan->diskon."%", -10), 850, $y);

        printer_draw_text($handle, "Total Bayar: ", 0, $y+=100);
        printer_draw_text($handle, substr("            ".format_uang($penjualan->bayar), -10), 850, $y);

        printer_draw_text($handle, "Diterima: ", 0, $y+=100);
        printer_draw_text($handle, substr("            ".format_uang($penjualan->diterima), -10), 850, $y);

        printer_draw_text($handle, "Kembali: ", 0, $y+=100);
        printer_draw_text($handle, substr("            ".format_uang($penjualan->diterima-$penjualan->bayar), -10), 850, $y);
        

        printer_draw_text($handle, "============================", 0, $y+=100);
        printer_draw_text($handle, "-= TERIMA KASIH =-", 250, $y+=100);
        printer_delete_font($font);
        
        printer_end_page($handle);
        printer_end_doc($handle);
        printer_close($handle);
      }
      return view('penjualan_detail.selesai', compact('setting'));
   }

   public function notaPDF(){
     $detail     = PenjualanDetail::leftJoin('produk', 'produk.kode_produk', '=', 'penjualan_detail.kode_produk')
                    ->where('id_penjualan', '=', session('idpenjualan'))
                    ->get();
     $penjualan  = Penjualan::leftJoin('member', 'member.kode_member', '=', 'penjualan.kode_member')
                    ->find(session('idpenjualan'));
     $setting    = Setting::find(1);
     $no         = 0;
     
     $pdf        = PDF::loadView('penjualan_detail.notapdf', compact('detail', 'penjualan', 'setting', 'no'));
     $pdf->setPaper(array(0,0,550,440), 'potrait');      
      return $pdf->stream();
   }
}
