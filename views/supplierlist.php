<?php
include 'header.php';
?>
<div class="container-fluid">
    <div class="row">
            <div class="col-md-12 text-right">
            <button type="button" class="btn btn-primary my-1" data-toggle="modal" data-target="#addsupplier"><i class="fas fa-plus"></i> Supplier</button>
            </div>
                <!-- Modal -->
                <div class="modal fade" id="addsupplier" tabindex="-1" role="dialog" aria-labelledby="addsupplierLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addsupplierLabel">Tambah Supplier</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="../controllers/Supplierolah.php" method="POST">
                                <div class="form-group">
                                    <label for="nama">Nama Supplier</label>
                                    <input type="text" class="form-control" id="nama" name="nama">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat">
                                </div>
                                <div class="form-group">
                                    <label for="telp">Nomor Telepon</label>
                                    <input type="tel" class="form-control" id="telp" name="telp">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success" name="tambahsupplier">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    </div>

    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>Data Supplier</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Telp</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            include '../models/ClassSupplier.php';
                            $p = new Supplier;
                            $data = $p->tampilSupplier();
                            $i = 1;
                            foreach($data as $s){
                            ?>
                            <tr>
                                <td><?php print $i++?></td>
                                <td><?php print $s['supplierNama'];?></td>
                                <td><?php print $s['supplierAlamat'];?></td>
                                <td><?php print $s['supplierTelp'];?></td>
                                <td>
                                <a class="btn btn-primary" href="formsupplieredit.php?ubahsupplierid=<?php print $s['supplierId']?>" role="button"><i class="fas fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                                <a class="btn btn-danger" href="../controllers/Supplierolah.php?hapussupplierid=<?php print $s['supplierId']?>" role="button"><i class="fas fa-trash-alt" data-toggle="tooltip" title="Hapus" onclick="return confirm('Apakah yakin untuk menghapus Penjualan?');"></i></a>
                                </td>
                            </tr>          
                            <?php } ?>                  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php
include 'footer.php';
?>