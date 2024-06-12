<?php 
include 'header.php';
$data = mysqli_query($con,"SELECT * FROM penjualan ORDER BY penjualanId DESC LIMIT 0,1");
        $i = mysqli_fetch_assoc($data);
        // ID OTOMATIS//***************************************************
        $kodeawal = substr($i['penjualanId'], 2, 10) + 1;
        if ($kodeawal < 10) {
            $kode = 000 . $kodeawal;
        } elseif ($kodeawal > 9 && $kodeawal <= 99) {
            $kode = 00 . $kodeawal;
        } else {
            $kode = 0 . $kodeawal;
        }
        $idfaktur = $i['penjualanId'] + 1;
?>
<!-- <h1 class="mx-4">Data Penjualan</h1> -->
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Penjualan</li>
        </ol>
    </nav>
            <div class="col-md-12">
                <div class="col-md-12 text-right">
                    <a class="btn btn-primary" href="penjualan.php?idfaktur=<?= $idfaktur ?>" role="button"><i class="fas fa-plus"></i> Penjualan</a>
                    <!-- <button type="button" class="btn btn-primary my-1" data-toggle="modal" data-target="#addpenjualan"><i class="fas fa-plus"></i> Penjualan</button> -->
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Data Histori Penjualan</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Data Piutang</a>
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
                                        <th>Cara Jual</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Keterangan</th>
                                        <th>Customer</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    include '../models/ClassPenjualan.php';
                                    $ps = new Penjualan;
                                    $data = $ps->tampilPenjualanSukses();
                                    foreach($data as $ps):
                                    ?>
                                    <tr>
                                        <td><?='J-'. $ps['penjualanId'];?></td>
                                        <td><?= $ps['userNama'];?></td>
                                        <td><?= date("d-M-Y", strtotime($ps['penjualanTanggal'])); ?></td>
                                        <td><?= $ps['penjualanCara'];?></td>
                                        <td><?= date("d-M-Y", strtotime($ps['penjualanJatuhtempo'])); ?></td>
                                        <td><?= $ps['penjualanKeterangan'];?></td>
                                        <td><?= $ps['customerNama'];?></td>
                                        <td>
                                        <a class="btn btn-primary" href="formpenjualanedit.php?ubahpenjualanid=<?= $ps['penjualanId']?>" role="button"><i class="fas fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                                        <a class="btn btn-danger" href="../controllers/penjualanolah.php?hapuspenjualanid=<?= $ps['penjualanId']?>" role="button"><i class="fas fa-trash-alt" data-toggle="tooltip" title="Hapus" onclick="return confirm('Apakah yakin untuk menghapus Penjualan?');"></i></a>
                                        <a class="btn btn-info" href="penjualanhasil.php?idfaktur=<?= $ps['penjualanId'] ?>" role="button"><i class="fas fa-search"></i></a>
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
                                        <th>Tanggal Jual</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Keterangan</th>
                                        <th>Customer</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $p = new Penjualan;
                                    $data = $p->detailPenjualanKredit();
                                    foreach($data as $d):
                                        ?>
                                    <tr>
                                    <td><?= 'J-'. $d['penjualanId'];?> </td>
                                    <td><?= date("d-M-Y", strtotime($d['penjualanTanggal'])); ?></td>
                                    <td><?= date("d-M-Y", strtotime($d['penjualanJatuhtempo'])); ?></td>
                                    <td><?= $d['penjualanKeterangan'];?></td>
                                    <td><?= $d['customerNama'];?></td>
                                    <td>
                                    <a class="btn btn-info" href="piutangdetail.php?idfaktur=<?= $d['penjualanId'] ?>" role="button" data-toggle="tooltip" title="Detail"><i class="fas fa-search"></i></a>
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
            <div class="modal fade" id="addpenjualan" tabindex="-1" role="dialog" aria-labelledby="addpenjualanLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addpenjualanLabel">Form Tambah Penjualan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="../controllers/Penjualanolah.php" method="POST">
                            <div class="form-group">
                                <label for="tanggaljual">Tanggal Penjualan</label>
                                <input type="date" class="form-control" id="tanggaljual" name="tanggaljual" value="<?= date('Y-m-d'); ?>">
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" value="-">
                            </div>
                            <div class="form-group">
                            <label for="namacustomer">Nama Item</label>
                            <select class="form-control" id="namacustomer" name="namacustomer">
                            <option value="Customer Harian">Pilih Customer</option>
                            <?php
                            include '../models/ClassCustomer.php';
                            $c = new Customer;
                            $data = $c->tampilCustomer();
                            foreach($data as $c):
                            ?>
                                <option value="<?= $c['customerNama'];?>"><?= $c['customerNama'];?></option>
                            <?php endforeach; ?>
                            </select>
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
                            <button type="submit" class="btn btn-success" name="tambahpenjualan">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
</div>



<?php
include 'footer.php';
?>
<script>
$(function() {
    $("input[name='carabayar']").click(function() {
        if ($("#Kredit").is(":checked")) {
        $("#jatuhtempo").show();
        } else {
        $("#jatuhtempo").hide();
        }
    });
});
</script>