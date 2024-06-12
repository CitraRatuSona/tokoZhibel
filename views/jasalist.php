<?php 
include 'header.php';
?>
<div class="container-fluid">
    <div class="row">
            <div class="col-md-12 text-right">
            <button type="button" class="btn btn-primary my-1" data-toggle="modal" data-target="#addjasa"><i class="fas fa-plus"></i> Jasa</button>
            </div>
                <!-- Modal -->
                <div class="modal fade" id="addjasa" tabindex="-1" role="dialog" aria-labelledby="addjasaLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addjasaLabel">Tambah Jasa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="../controllers/Jasaolah.php" method="POST">
                                <div class="form-group">
                                    <label for="namajasa">Nama Jasa</label>
                                    <input type="text" class="form-control" id="namajasa" name="namajasa">
                                </div>
                                <div class="form-group">
                                    <label for="hargajual">Harga Jual</label>
                                    <input type="number" class="form-control" id="hargajual" name="hargajual">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success" name="tambahjasa">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    </div>

    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>Data Jasa</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kode Jasa</th>
                                <th>Nama</th>
                                <th>Harga Jual</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            include '../models/ClassJasa.php';
                            $p = new Jasa;
                            $data = $p->tampilJasa();
                            foreach($data as $j){
                            ?>
                            <tr>
                                <td><?= $j['jasaKode'];?></td>
                                <td><?= $j['jasaNama'];?></td>
                                <td><?= "Rp.".number_format( $j['jasaHarga'],2,',','.') ?></td>
                                <td>
                                <a class="btn btn-primary" href="formjasaedit.php?ubahjasaid=<?= $j['jasaId']?>" role="button"><i class="fas fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                                <a class="btn btn-danger" href="../controllers/jasaolah.php?hapusjasaid=<?= $j['jasaId']?>" role="button"><i class="fas fa-trash-alt" data-toggle="tooltip" title="Hapus" onclick="return confirm('Apakah yakin untuk menghapus Jasa?');"></i></a>
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