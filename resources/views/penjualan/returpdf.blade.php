<!DOCTYPE html>
<html>
<head>  
  <title>PDF</title>
  <link rel="stylesheet" href="{{ asset('public/adminLTE/bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
 
<h3 class="text-center">Laporan Retur Penjualan</h3>
         
<table class="table table-striped">
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