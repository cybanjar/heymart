@extends('layouts.app')

@section('title')
  Daftar Penjualan
@endsection

@section('breadcrumb')
   @parent
   <li>penjualan</li>
@endsection

@section('content')     
<div class="row">
  <div class="col-xs-12">
    <div class="box">

      <div class="box-header">
        <a onclick="parameterForm()" class="btn btn-success"><i class="fa fa-plus-circle"></i> Ubah Parameter</a>
        <a href="penjualan/pdf/{{$awal}}/{{$akhir}}/{{$user}}" target="_blank" class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export PDF</a>

        <a onclick="returDetail()" class="btn btn-info" style="float:right;"><i class="fa fa-mail-reply"></i> Detail Retur Produk</a>
      </div>

      <div class="box-body">    

        <table class="table table-striped tabel-penjualan">
          <thead>
             <tr>
                <th width="30">No</th>
                <th>Tanggal</th>
                <th>Kode Member</th>
                <th>Total Item</th>
                <th>Total Harga</th>
                <th>Diskon</th>
                <th>Total Bayar</th>
                <th>Users</th>
                <th width="100">Aksi</th>
             </tr>
          </thead>
          <tbody></tbody>
        </table>

      </div>
    </div>
  </div>
</div>

@include('penjualan.detail')
@include('penjualan.form')
@include('penjualan.retur')
@endsection

@section('script')
<script type="text/javascript">
var table, save_method, table1, table2;
$(function(){
   table = $('.tabel-penjualan').DataTable({
     "processing" : true,
     "serverside" : true,
     "dom" : 'Brtp',
     "ajax" : {
       "url" : "penjualan/data/{{ $awal }}/{{ $akhir }}/{{ $user }}",
       "type" : "GET"
     }
   }); 
   
   table1 = $('.tabel-detail').DataTable({
     "dom" : 'Brt',
     "bSort" : false,
     "processing" : true
    });

   table2 = $('#table-retur').DataTable({
    "dom" : 'Brtp',
    "processing" : true,
    "serverside" : true
   });

   $('#awal, #akhir').datepicker({
     format: 'yyyy-mm-dd',
     autoclose: true
   });

   $('.tabel-supplier').DataTable();
});

function addForm(){
   $('#modal-supplier').modal('show');        
}

function parameterForm(){
  $('#modal-form-parameter-penjualan').modal('show');
}

function showDetail(id){
    $('#modal-detail').modal('show');

    table1.ajax.url("penjualan/"+id+"/lihat");
    table1.ajax.reload();
}

function returDetail(){
  $('#modal-retur').modal('show');

  table2.ajax.url("penjualan/retur/{{$awal}}/{{$akhir}}");
  table2.ajax.reload();
}

function destroyData(id){
  if(confirm("Apakah yakin data akan dimasukkan kedalam retur data?")){
    $.ajax({
      url : "penjualan/"+id,
      type: "GET",
      success : function(){
        table.ajax.reload();
      },
      error   : function(){
        alert('Tidak dapat menghapus data!');
      }
    });
  }
}

function deleteData(id){
   if(confirm("Apakah yakin data akan dihapus?")){
     $.ajax({
       url : "penjualan/"+id+"/hapus",
       type : "GET",
       data : {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
       success : function(data){
         table2.ajax.reload();
       },
       error : function(){
         alert("Tidak dapat menghapus data!");
       }
     });
   }
}
</script>
@endsection