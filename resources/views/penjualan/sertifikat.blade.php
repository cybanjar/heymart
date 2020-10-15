<!DOCTYPE html>
<html>
<head>  
  <title>PDF</title>
  <link rel="stylesheet" href="{{ asset('public/adminLTE/bootstrap/css/bootstrap.min.css') }}">
  <style type="text/css">
    * {
      margin  : 0px auto;
      padding : 0px auto;
    }
  </style>
</head>
<body>

  <img src="../public/images/{{$setting->sertifikat}}" style="z-index: 0; position: absolute; width: 1130px; height: 795px;"/>
  <div style="z-index: 1; margin-top: 230px; margin-left: 320px;">
    <h1><b>No : {{$data->id_penjualan}} </b></h1>
    <br>
    <table style="z-index: 1; font-size: 30px; margin-top: 75px; margin-left: 0px;">
      <tr>
       <td>Kode Produk </td>
       <td> : </td>
       <td>{{$data->kode_produk}}</p></td>
      </tr>
      
      <tr>
       <td>Nama Produk </td>
       <td> : </td>
       <td>{{$data->nama_produk}}</td>
      </tr>

      <tr>
       <td>Kategori </td>
       <td> : </td>
       <td>{{$data->nama_kategori}}</td>
      </tr>

      <tr>
       <td>Kode Member </td>
       <td> : </td>
       <td>{{$data->kode_member}}</td>
      </tr>

      <tr>
       <td>Nama Member </td>
       <td> : </td>
       <td>{{$data->nama}}</td>
      </tr>

      <tr>
       <td>Alamat </td>
       <td> : </td>
       <td>{{$data->alamat}}</td>
      </tr>

      <tr>
       <td>No-Telepon </td>
       <td> : </td>
       <td>{{$data->telpon}}</td>
      </tr>

      <tr>
       <td>Tanggal Pembelian </td>
       <td> : </td>
       <td>{{$data->created_at}}</td>
      </tr>
    </table>
  </div>

</body>
</html>