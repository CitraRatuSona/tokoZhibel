<?php 
include 'header.php';
?>
<div class="container-fluid">
    <div class="row">
            <div class="col-md-12 text-right">
            <button type="button" class="btn btn-primary my-1" data-toggle="modal" data-target="#addbarang"><i class="fas fa-plus"></i> Barang</button>
            </div>
                <!-- Modal -->
                <div class="modal fade" id="addbarang" tabindex="-1" role="dialog" aria-labelledby="addbarangLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addbarangLabel">Tambah Barang</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="../controllers/Barangolah.php" method="POST">
                                <div class="form-group">
                                    <label for="namabarang">Nama Barang</label>
                                    <input type="text" class="form-control" id="namabarang" name="namabarang">
                                </div>
                                <div class="form-group">
                                    <label for="hargabeli">Harga Beli</label>
                                    <input type="number" class="form-control" id="hargabeli" name="hargabeli">
                                </div>
                                <div class="form-group">
                                    <label for="hargajual">Harga Jual</label>
                                    <input type="number" class="form-control" id="hargajual" name="hargajual">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success" name="tambahbarang">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    </div>

    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>Data Barang</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama</th>
                                <th>Stok</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            include '../models/ClassBarang.php';
                            $p = new Barang;
                            $data = $p->tampilBarang();
                            foreach($data as $b){
                            ?>
                            <tr>
                                <td><?= $b['barangKode'];?></td>
                                <td><?= $b['barangNama'];?></td>
                                <td><?= $b['barangStok'];?></td>
                                <td><?= "Rp.".number_format( $b['hargaBeli'],2,',','.') ?></td>
                                <td><?= "Rp.".number_format( $b['hargaJual'],2,',','.') ?></td>
                                <td>
                                <a class="btn btn-primary" href="formbarangedit.php?ubahbarangid=<?= $b['barangId']?>" role="button"><i class="fas fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                                <button class="btn btn-danger" onClick={handleDelete(<?= $b['barangId']; ?>)}><i class="fas fa-trash-alt" data-toggle="tooltip" title="Hapus"></i></button>
                                <!-- <a class="btn btn-danger" href="../controllers/barangolah.php?hapusbarangid=" role="button"><i class="fas fa-trash-alt" data-toggle="tooltip" title="Hapus" onclick="return confirm('Apakah yakin untuk menghapus Penjualan?');"></i></a> -->
                                </td>
                            </tr>          
                            <?php } ?>                  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<script>
function handleDelete(kodebarang) {
    $.ajax({
        url:"../controllers/Barangolah.php",
        data:"aksi=hapusBarang&kodebarang="+kodebarang,
        cache:false,
        success:function(msg){
            alert(msg);
            window.location.reload();
        }
    });
}
</script>
<?php
include 'footer.php';
?>