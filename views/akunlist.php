<?php
include 'header.php';
?>
<div class="container-fluid">
<div class="row">
    <div class="col-md-12 text-right">
    <button type="button" class="btn btn-primary my-1" data-toggle="modal" data-target="#addakun"><i class="fas fa-plus"></i> Akun</button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addakun" tabindex="-1" role="dialog" aria-labelledby="addakunLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addakunLabel">Tambah Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../controllers/Akunolah.php" method="POST">
                <div class="form-group">
                    <label for="jenisakun">Jenis Akun</label>
                    <select class="form-control" name="jenisakun">
                        <option value="" disable>Pilih Jenis Akun</option>
                        <option value="Aset">Aset</option>
                        <option value="Utang">Utang</option>
                        <option value="Modal">Ekuitas</option>
                        <option value="Pendapatan">Pendapatan</option>
                        <option value="Biaya dan Beban">Biaya dan Beban</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="idakun">Id Akun</label>
                    <input type="text" class="form-control" id="idakun" name="idakun">
                </div>
                <div class="form-group">
                    <label for="namaakun">Nama Akun</label>
                    <input type="text" class="form-control" id="namaakun" name="namaakun">
                </div>
                <div class="form-group">
                    <label for="saldonormal">Saldo Normal</label>
                    <select class="form-control" name="saldonormal">
                        <option value="" disable>Pilih Saldo Normal</option>
                        <option value="Debit">Debit</option>
                        <option value="Kredit">Kredit</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="saldoawal">Saldo Awal</label>
                    <input type="number" class="form-control" id="saldoawal" name="saldoawal">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success" name="tambahakun">Simpan</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>

    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>Data Akun </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kode Akun</th>
                                <th>Nama Akun</th>
                                <th>Saldo Normal</th>
                                <th>Saldo Awal</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            include '../models/ClassAkun.php';
                            $jenisakun = "Aset";
                            $p = new Akun;
                            $data = $p->tampilAkun($jenisakun);
                            echo "<tr><td colspan='6'><b> 1 - ".$jenisakun."</b></td></tr>";
                            foreach($data as $a):
                            ?>
                            <tr>
                                <td><?= $a['akunId'];?></td>
                                <td><?= $a['akunNama'];?></td>
                                <td><?= $a['akunSaldoNormal'];?></td>
                                <td><?= $a['saldo_awal'];?></td>
                                <td>
                                <a class="btn btn-primary" href="formakunedit.php?ubahakunid=<?= $a['akunId']?>" role="button"><i class="fas fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                                <a class="btn btn-danger" href="../controllers/Akunolah.php?hapusakunid=<?= $a['akunId']?>" role="button"><i class="fas fa-trash-alt" data-toggle="tooltip" title="Hapus" onclick="return confirm('Apakah yakin untuk menghapus Akun?');"></i></a>
                                </td>
                            </tr>          
                            <?php endforeach;

                            $jenisakun = "Utang";
                            $p = new Akun;
                            $data = $p->tampilAkun($jenisakun);
                            echo "<tr><td colspan='6'><b> 2 - ".$jenisakun."</b></td></tr>";
                            foreach($data as $a):
                            ?>
                            <tr>
                                <td><?= $a['akunId'];?></td>
                                <td><?= $a['akunNama'];?></td>
                                <td><?= $a['akunSaldoNormal'];?></td>
                                <td><?= $a['saldo_awal'];?></td>
                                <td>
                                <a class="btn btn-primary" href="formakunedit.php?ubahakunid=<?= $a['akunId']?>" role="button"><i class="fas fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                                <a class="btn btn-danger" href="../controllers/Akunolah.php?hapusakunid=<?= $a['akunId']?>" role="button"><i class="fas fa-trash-alt" data-toggle="tooltip" title="Hapus" onclick="return confirm('Apakah yakin untuk menghapus Akun?');"></i></a>
                                </td>
                            </tr>          
                            <?php endforeach;
                            $jenisakun = "Ekuitas";
                            $p = new Akun;
                            $data = $p->tampilAkun($jenisakun);
                            echo "<tr><td colspan='6'><b> 3 - ".$jenisakun."</b></td></tr>";
                            foreach($data as $a):
                            ?>
                            <tr>
                                <td><?= $a['akunId'];?></td>
                                <td><?= $a['akunNama'];?></td>
                                <td><?= $a['akunSaldoNormal'];?></td>
                                <td><?= $a['saldo_awal'];?></td>
                                <td>
                                <a class="btn btn-primary" href="formakunedit.php?ubahakunid=<?= $a['akunId']?>" role="button"><i class="fas fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                                <a class="btn btn-danger" href="../controllers/Akunolah.php?hapusakunid=<?= $a['akunId']?>" role="button"><i class="fas fa-trash-alt" data-toggle="tooltip" title="Hapus" onclick="return confirm('Apakah yakin untuk menghapus Akun?');"></i></a>
                                </td>
                            </tr>
                            <?php
                            endforeach;
                            $jenisakun = "Pendapatan";
                            $p = new Akun;
                            $data = $p->tampilAkun($jenisakun);
                            echo "<tr><td colspan='6'><b> 4 - ".$jenisakun."</b></td></tr>";
                            foreach($data as $a):
                            ?>
                            <tr>
                                <td><?= $a['akunId'];?></td>
                                <td><?= $a['akunNama'];?></td>
                                <td><?= $a['akunSaldoNormal'];?></td>
                                <td><?= $a['saldo_awal'];?></td>
                                <td>
                                <a class="btn btn-primary" href="formakunedit.php?ubahakunid=<?= $a['akunId']?>" role="button"><i class="fas fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                                <a class="btn btn-danger" href="../controllers/Akunolah.php?hapusakunid=<?= $a['akunId']?>" role="button"><i class="fas fa-trash-alt" data-toggle="tooltip" title="Hapus" onclick="return confirm('Apakah yakin untuk menghapus Akun?');"></i></a>
                                </td>
                            </tr>
                            <?php
                            endforeach;
                            $jenisakun = "Harga Pokok Penjualan";
                            $p = new Akun;
                            $data = $p->tampilAkun($jenisakun);
                            echo "<tr><td colspan='6'><b> 5 - ".$jenisakun."</b></td></tr>";
                            foreach($data as $a):
                            ?>
                            <tr>
                                <td><?= $a['akunId'];?></td>
                                <td><?= $a['akunNama'];?></td>
                                <td><?= $a['akunSaldoNormal'];?></td>
                                <td><?= $a['saldo_awal'];?></td>
                                <td>
                                <a class="btn btn-primary" href="formakunedit.php?ubahakunid=<?= $a['akunId']?>" role="button"><i class="fas fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                                <a class="btn btn-danger" href="../controllers/Akunolah.php?hapusakunid=<?= $a['akunId']?>" role="button"><i class="fas fa-trash-alt" data-toggle="tooltip" title="Hapus" onclick="return confirm('Apakah yakin untuk menghapus Akun?');"></i></a>
                                </td>
                            </tr>
                            <?php
                            endforeach;
                            $jenisakun = "Biaya dan Beban";
                            $p = new Akun;
                            $data = $p->tampilAkun($jenisakun);
                            echo "<tr><td colspan='6'><b> 6 - ".$jenisakun."</b></td></tr>";
                            foreach($data as $a):
                            ?>
                            <tr>
                                <td><?= $a['akunId'];?></td>
                                <td><?= $a['akunNama'];?></td>
                                <td><?= $a['akunSaldoNormal'];?></td>
                                <td><?= $a['saldo_awal'];?></td>
                                <td>
                                <a class="btn btn-primary" href="formakunedit.php?ubahakunid=<?= $a['akunId']?>" role="button"><i class="fas fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                                <a class="btn btn-danger" href="../controllers/Akunolah.php?hapusakunid=<?= $a['akunId']?>" role="button"><i class="fas fa-trash-alt" data-toggle="tooltip" title="Hapus" onclick="return confirm('Apakah yakin untuk menghapus Akun?');"></i></a>
                                </td>
                            </tr>
                            <?php
                            endforeach;
                            ?>                          
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</div>


<?php
include 'footer.php';
?>