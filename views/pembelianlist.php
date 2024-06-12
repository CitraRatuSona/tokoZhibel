<?php 
include 'header.php';
$data = mysqli_query($con,"SELECT * FROM pembelian ORDER BY pembelianId DESC LIMIT 0,1");
        $i = mysqli_fetch_assoc($data);
        // ID OTOMATIS//***************************************************
        $kodeawal = substr($i['pembelianId'], 2, 10) + 1;
        if ($kodeawal < 10) {
            $kode = 000 . $kodeawal;
        } elseif ($kodeawal > 9 && $kodeawal <= 99) {
            $kode = 00 . $kodeawal;
        } else {
            $kode = 0 . $kodeawal;
        }
        $idfaktur = $i['pembelianId'] + 1;
?>
<!-- <h1 class="mx-4">Data Pembelian</h1> -->
<div class="container-fluid">
    <nav aria-label="breadcrumb">   
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Pembelian</li>
        </ol>
    </nav>
            <div class="col-md-12">
                <div class="col-md-12 text-right">
                    <!-- <button type="button" class="btn btn-primary my-1" data-toggle="modal" data-target="#addpembelian"><i class="fas fa-plus"></i> Pembelian</button> -->
                    <a class="btn btn-primary" href="pembelian.php?idfaktur=<?= $idfaktur ?>" role="button"><i class="fas fa-plus"></i> Pembelian</a>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Data Histori Pembelian</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Data Hutang</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="table-responsive" style="margin-top: 20px">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No Faktur</th>
                                        <th>Karyawan</th>
                                        <th>Tanggal Jual</th>
                                        <th>Cara Beli</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Supplier</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    include '../models/ClassPembelian.php';
                                    $p = new Pembelian;
                                    $data = $p->tampilPembelianSukses();
                                    foreach($data as $p):
                                    ?>
                                    <tr>
                                        <td><?="B-". $p['pembelianId'];?></td>
                                        <td><?= $p['userNama'];?></td>
                                        <td><?= date("d-M-Y", strtotime($p['pembelianTanggal'])); ?></td>
                                        <td><?= $p['pembelianCara'];?></td>
                                        <td><?= date("d-M-Y", strtotime($p['pembelianJatuhtempo'])); ?></td>
                                        <td><?= $p['supplierNama'];?></td>
                                        <td><?= $p['pembelianKeterangan'];?></td>
                                        <td>
                                        <a class="btn btn-primary" href="formpembelianedit.php?ubahpembelianid=<?= $p['pembelianId']?>" role="button"><i class="fas fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                                        <a class="btn btn-danger" href="../controllers/pembelianolah.php?hapuspembelianid=<?= $p['pembelianId']?>" role="button"><i class="fas fa-trash-alt" data-toggle="tooltip" title="Hapus" onclick="return confirm('Apakah yakin untuk menghapus Pembelian?');"></i></a>
                                        <a class="btn btn-info" href="pembelianhasil.php?idfaktur=<?= $p['pembelianId'] ?>" role="button"><i class="fas fa-search"></i></a>
                                        </td>
                                    </tr>          
                                    <?php endforeach; ?>                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="table-responsive" style="margin-top: 20px">
                            <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No Faktur</th>
                                        <th>Tanggal Beli</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Dibeli Oleh</th>
                                        <th>Supplier</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $d = new Pembelian;
                                    $data = $d->detailPembelianKredit();
                                    foreach($data as $d):
                                    ?>
                                        <tr>
                                        <td><?= 'J-'. $d['pembelianId'];?> </td>
                                        <td><?= date("d-M-Y", strtotime($d['pembelianTanggal'])); ?></td>
                                        <td><?= date("d-M-Y", strtotime($d['pembelianJatuhtempo'])); ?></td>
                                        <td><?= $d['supplierNama'];?></td>
                                        <td><?= $d['userNama'];?></td>
                                        <td><?= $d['pembelianKeterangan'];?></td>
                                        <td>
                                        <a class="btn btn-info" href="hutangdetail.php?idfaktur=<?= $d['pembelianId'] ?>" role="button" data-toggle="tooltip" title="Detail"><i class="fas fa-search"></i></a>
                                        </td>
                                        </tr>
                                    <?php endforeach;?>               
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="addpembelian" tabindex="-1" role="dialog" aria-labelledby="addpembelianLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addpembelianLabel">Form Tambah Pembelian</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="../controllers/Pembelianolah.php" method="POST">
                            <div class="form-group">
                                <label for="tanggalbeli">Tanggal Pembelian</label>
                                <input type="date" class="form-control" id="tanggalbeli" name="tanggalbeli" value="<?= date('Y-m-d'); ?>">
                            </div>
                            <label for="namasupplier">Nama Supplier</label>
                            <select class="form-control" id="namasupplier" name="namasupplier">
                            <option value="Supplier">Pilih Supplier</option>
                            <?php
                            include '../models/ClassSupplier.php';
                            $d = new Supplier;
                            $data = $d->tampilSupplier();
                            foreach($data as $d):
                            ?>
                                <option value="<?= $d['supplierNama'];?>"><?= $d['supplierNama'];?></option>
                            <?php endforeach; ?>
                            </select>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" value="-">
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="carabayar" id="Tunai" value="Tunai" checked>
                                <label class="form-check-label" for="Tunai">Tunai</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="carabayar" id="Kredit" value="Kredit">
                                <label class="form-check-label" for="Kredit">Kredit</label>
                            </div>
                            <div id="jatuhtempo" style="display: none">
                            <div class="form-group">
                                <label for="jatuhtempo">Jatuh Tempo</label>
                                <input type="date" class="form-control" id="jatuhtempo" name="jatuhtempo">
                            </div>
                            </div>
                            <input type="hidden" name="karyawan" value="<?= $nama ?>"/>
                            <input type="hidden" name="status" value="Waiting"/>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success" name="tambahpembelian">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
</div>



<?php
include 'footer.php';
?>