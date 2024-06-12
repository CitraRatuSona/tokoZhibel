<?php
include 'header.php';
?>
<div class="container-fluid">
<div class="row">
    <div class="col-md-12 text-right">
    <button type="button" class="btn btn-primary my-1" data-toggle="modal" data-target="#addaset"><i class="fas fa-plus"></i> Aset</button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addaset" tabindex="-1" role="dialog" aria-labelledby="addasetLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addasetLabel">Tambah Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../controllers/Asetolah.php" method="POST">
                <div class="form-group">
                    <label for="namaaset">Nama Aset</label>
                    <input type="text" class="form-control" id="namaaset" name="namaaset">
                </div>
                <div class="form-group">
                    <label for="tanggalaset">Tanggal Pembelian Aset</label>
                    <input type="date" class="form-control" id="tanggalaset" name="tanggalaset">
                </div>
                <div class="form-group">
                    <label for="jumlahaset">Jumlah Aset</label>
                    <input type="number" class="form-control" id="jumlahaset" name="jumlahaset">
                </div>
                <div class="form-group">
                    <label for="hargaaset">Harga Aset</label>
                    <input type="number" class="form-control" id="hargaaset" name="hargaaset">
                </div>
                <div class="form-group">
                    <label for="masamanfaat">Masa Manfaat Aset</label>
                    <select class="form-control" name="masamanfaat">
                        <option value="" disable>Pilih Masa Manfaat</option>
                        <option value="4">4 Tahun (48 Bulan)</option>
                        <option value="8">8 Tahun (96 Bulan)</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success" name="tambahaset">Simpan</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>

    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>Data Aset</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal Pembelian</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                                <th>Masa Manfaat</th>
                                <th>Penyusutan Perbulan</th>
                                <th>Total Penyusutan</th>
                                <th>Nilai Buku</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            include '../models/ClassAset.php';
                            $p = new Aset;
                            $data = $p->tampilAset();
                            $i = 1;
                            foreach($data as $a){
                            ?>
                            <tr>
                                <td><?= $i++?></td>
                                <td><?= $a['asetNama'];?></td>
                                <td><?= date("d-M-Y", strtotime($a['asetTanggal'])); ?></td>
                                <td><?= $a['asetJumlah'];?></td>
                                <td><?= "Rp. ".number_format( $a['asetHarga'],0,',','.') ?></td>
                                <td><?= "Rp. ".number_format( $a['asetTotalharga'],0,',','.') ?></td>
                                <td><?= $a['asetManfaat']." Tahun";?></td>
                                <td><?= "Rp. ".number_format( $a['asetPenyBulan'],0,',','.') ?></td>
                                <?php 
                                $totalpeny = $a['TotalPeny'];
                                $nilaibuku = $a['asetTotalharga'] - $totalpeny;
                                ?>
                                <td><?= "Rp. ".number_format( $totalpeny,0,',','.')?></td>
                                <td><?= "Rp. ".number_format( $nilaibuku,0,',','.')?></td>
                                <td>
                                <a class="btn btn-primary" href="formasetedit.php?ubahasetid=<?= $a['asetId']?>" role="button"><i class="fas fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                                <a class="btn btn-danger" href="../controllers/asetolah.php?hapusasetid=<?= $a['asetId']?>" role="button"><i class="fas fa-trash-alt" data-toggle="tooltip" title="Hapus" onclick="return confirm('Apakah yakin untuk menghapus Beban?');"></i></a>
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