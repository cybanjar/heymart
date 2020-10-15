<div class="modal" id="modal-retur" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
 
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> &times; </span> </button>
            <a href="riwayat/returpdf/{{$awal}}/{{$akhir}}" target="_blank" class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export PDF</a>
         </div>
            
         <div class="modal-body">
            <h3 class="modal-title">Detail Retur Produk</h3> 
            <table class="table table-striped" id="table-retur">
               <thead>
                  <tr>
                     <th width="15px">No</th>
                     <th>Tanggal</th>
                     <th>Kode Member</th>
                     <th>Total Item</th>
                     <th>Total Harga</th>
                     <th>Diskon</th>
                     <th>Total Bayar</th>
                     <th>Aksi</th>
                  </tr>
               </thead>
               <tbody></tbody>   
            </table>
         </div>

      </div>
   </div>
</div>
