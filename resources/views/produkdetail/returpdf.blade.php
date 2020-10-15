<!DOCTYPE html>
<html>
<head>  
  <title>PDF</title>
  <link rel="stylesheet" href="{{ asset('public/adminLTE/bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
 
<h3 class="text-center">Laporan Retur Produk : <b><i>{{Auth::user()->name}}</i></b></h3>
         
<table class="table table-striped">
<thead>
   <tr>
      <th width="30">No</th>
      <th>Kode Produk</th>
      <th>Nama Produk</th>
      <th>Kategori</th>
      <th>Jumlah Retur</th>
   </tr>

   <tbody>
    @foreach($data as $row)    
    <tr>
    @foreach($row as $col)
     <td>{{ $col }}</td>
    @endforeach
    </tr>
    @endforeach
   </tbody>
</table>

</body>
</html>