<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Kategori;
use App\User;
use App\Setting;
use Datatables;
use Auth;
use PDF;


class ProdukDetailController extends Controller
{
    public function index()
    {
       $kategori    = Kategori::all();
       $users       = Auth::user()->id;
       $setting = Setting::find(1); 
       return view('produkdetail.index', compact('kategori', 'users', 'setting'));
    }

    public function listData($users)
    {
      $produk    = Produk::leftJoin('users','users.id','=','produk.id_user')
      ->leftJoin('kategori', 'kategori.id_kategori', '=', 'produk.id_kategori')
      ->where('id', '=', $users)
      ->orderBy('id_produk', 'desc')
      ->get();
        $no      = 0;
        $data    = array();
        foreach($produk as $list){
          $no ++;
          $row   = array();
          $row[] = "<input type='checkbox' name='id[]'' value='".$list->id_produk."'>";
          $row[] = $no;
          $row[] = $list->kode_produk;
          $row[] = $list->nama_produk;
          $row[] = $list->nama_kategori;
          $row[] = $list->merk;
          $row[] = "Rp. ".format_uang($list->harga_beli);
          $row[] = "Rp. ".format_uang($list->harga_jual);
          $row[] = $list->diskon."%";
          $row[] = $list->stok;
          $row[] = $list->sertifikat;
          $row[] = "<div class='btn-group'>
                     <a onclick='editForm(".$list->id_produk.")' class='btn btn-primary btn-sm'><i class='fa fa-pencil'></i></a>
                    </div>";
          $data[]= $row;
        }
        $output  = array("data" => $data);
      return response()->json($output);
    }

    public function store(Request $request)
    {
        $jml = Produk::where('kode_produk', '=', $request['kode_produk'])->count();
        if($jml < 1){
            $produk                 = new Produk;
            $produk->kode_produk    = date('dmYHis');
            $produk->nama_produk    = $request['nama_produk'];
            $produk->id_kategori    = $request['kategori'];
            $produk->id_user        = $request['users'];
            $produk->merk           = $request['merk'];
            $produk->harga_beli     = $request['harga_beli'];
            $produk->diskon         = $request['diskon'];
            $produk->harga_jual     = $request['harga_jual'];
            $produk->stok           = $request['stok'];
            $produk->sertifikat     = $request['sertifikat'];
            $produk->save();
            echo json_encode(array('msg'=>'success'));
        }else{
            echo json_encode(array('msg'=>'error'));
        }
    }

    public function edit($id)
    {
      $produk = Produk::find($id);
      echo json_encode($produk);
    }

    public function update(Request $request, $id)
    {
        $produk                 = Produk::find($id);
        $produk->nama_produk    = $request['nama_produk'];
        $produk->id_kategori    = $request['kategori'];
        $produk->id_user        = $request['users'];
        $produk->merk           = $request['merk'];
        $produk->harga_beli     = $request['harga_beli'];
        $produk->diskon         = $request['diskon'];
        $produk->harga_jual     = $request['harga_jual'];
        $produk->stok           = $request['stok'];
        $produk->sertifikat     = $request['sertifikat'];
        $produk->update();
        echo json_encode(array('msg'=>'success'));
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();
    }

    public function deleteSelected(Request $request)
    {
        foreach($request['id'] as $id){
            $produk = Produk::find($id);
            $produk->delete();
        }
    }

    public function printBarcode(Request $request)
    {
        $dataprodukdetail       = array();
        foreach($request['id'] as $id){
            $produk             = Produk::find($id);
            $dataprodukdetail[] = $produk;
        }
        $no   = 1;
        $pdf  = PDF::loadView('produkdetail.barcode', compact('dataprodukdetail', 'no'));
        $pdf->setPaper('a4', 'potrait');      
        return $pdf->stream();
    }

    public function retur()
    {
      $produk = Produk::leftJoin('kategori', 'kategori.id_kategori', '=', 'produk.id_kategori')
                ->leftJoin('users', 'produk.id_user', '=', 'users.id')
                ->orderBy('produk.id_produk', 'desc')
                ->where('produk.retur', '>', 0)
                ->where('id_user', '=', Auth::user()->id)
                ->get();
      $no     = 0;
      $data   = array();
      foreach ($produk as $list) {
        $no ++;
        $row   = array();
        $row[] = $no;
        $row[] = $list->kode_produk;
        $row[] = $list->nama_produk;
        $row[] = $list->nama_kategori;
        $row[] = $list->retur;
        $data[]= $row;
      }
      $output  = array('data' => $data);
      return response()->json($output);
    }

    public function returPDF()
    {
     $produk = Produk::leftJoin('kategori', 'kategori.id_kategori', '=', 'produk.id_kategori')
                ->leftJoin('users', 'produk.id_user', '=', 'users.id')
                ->orderBy('produk.id_produk', 'desc')
                ->where('produk.retur', '>', 0)
                ->where('id_user', '=', Auth::user()->id)
                ->get();
      $no     = 0;
      $data   = array();
      foreach ($produk as $list) {
        $no ++;
        $row   = array();
        $row[] = $no;
        $row[] = $list->kode_produk;
        $row[] = $list->nama_produk;
        $row[] = $list->nama_kategori;
        $row[] = $list->retur;
        $data[]= $row;
      }
     $pdf = PDF::loadView('produkdetail.returpdf', compact('data'));
     $pdf->setPaper('a4', 'potrait');
     
     return $pdf->stream();
    }
}
