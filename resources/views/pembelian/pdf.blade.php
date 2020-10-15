<!DOCTYPE html>
<html>
<head>  
  <title>PDF</title>
  <link rel="stylesheet" href="{{ asset('public/adminLTE/bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
 
<h3 class="text-center">Laporan Pembelian</h3>
<h4 class="text-center">Tanggal  {{ tanggal_indonesia($awal) }} s/d {{ tanggal_indonesia($akhir) }} </h4>

         
<table class="table table-striped">
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