@extends('layouts.app')

@section('title')
  Daftar Pembelian
@endsection

@section('breadcrumb')
   @parent
   <li>pembelian</li>
@endsection

@section('content')     
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <!-- <a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle"></i> Transaksi Baru</a>
        @if(!empty(session('idpembelian')))
        <a href="{{ route('pembelian_detail.index') }}" class="btn btn-info"><i class="fa fa-plus-circle"></i> Transaksi Aktif</a>
        @endif -->

        <a onclick="parameterForm()" class="btn btn-success"><i class="fa fa-plus-circle"></i> Ubah Parameter</a>
        <a href="pembelian/pdf/{{$awal}}/{{$akhir}}/{{$user}}" target="_blank" class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export PDF</a>

      </div>
      <div class="box-body">  

        <table class="table table-striped tabel-pembelian">
          <thead>
           <tr>
              <th width="30">No</th>
              <th>Tanggal</th>
              <th>Users</th>
              <th>Supplier</th>
              <th>Nama Produk</th>
              <th>Total Item</th>
              <th>Total Harga</th>
              <th>Diskon</th>
              <th>Total Bayar</th>
              <th width="100">Aksi</th>
           </tr>
          </thead>
          <tbody></tbody>
        </table>

      </div>
    </div>
  </div>
</div>

@include('pembelian.detail')
@include('pembelian.form')
<!-- @include('pembelian.supplier') -->
@endsection

@section('script')
<script type="text/javascript">
var table, save_method, table1;
$(function(){
   table = $('.tabel-pembelian').DataTable({
     "processing" : true,
     "serverside" : true,
     "ajax" : {
       "url" : "pembelian/data/{{ $awal }}/{{ $akhir }}/{{ $user }}",
       "type" : "GET"
     }
   }); 
   
   table1 = $('.tabel-detail').DataTable({
     "dom" : 'Brt',
     "bSort" : false,
     "processing" : true
    });

   $('#awal, #akhir').datepicker({
     format: 'yyyy-mm-dd',
     autoclose: true
   });

   // $('.tabel-supplier').DataTable();
});

// function addForm(){
//    $('#modal-supplier').modal('show');        
// }

function showDetail(id){
    $('#modal-detail').modal('show');

    table1.ajax.url("pembelian/"+id+"/lihat");
    table1.ajax.reload();
}

function parameterForm(id){
    $('#modal-form-parameter-pembelian').modal('show');
}

function deleteData(id){
   if(confirm("Apakah yakin data akan dihapus?")){
     $.ajax({
       url : "pembelian/"+id+"/hapus",
       type : "GET",
       data : {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
       success : function(data){
         table.ajax.reload();
       },
       error : function(){
         alert("Tidak dapat menghapus data!");
       }
     });
   }
}
</script>
@endsection