<?php 
include 'header.php';
$idfaktur = $_GET['idfaktur'];
?>
<div class="container-fluid">
    <nav aria-label="breadcrumb">   
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Hutang</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover" id="dataTable">
                <thead>
                    <tr>
                    <th>No Faktur</th>
                    <th>Tanggal Beli</th>
                    <th>Jatuh Tempo</th>
                    <th>Dibeli oleh</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                include '../models/ClassPembelian.php';
                $d = new Pembelian;
                $data = $d->detailPembelianKredit();
                foreach($data as $d):
                ?>
                    <tr>
                    <td><?= 'J-'. $d['pembelianId'];?> </td>
                    <td><?= date("d-M-Y", strtotime($d['pembelianTanggal'])); ?></td>
                    <td><?= date("d-M-Y", strtotime($d['pembelianJatuhtempo'])); ?></td>
                    <td><?= $d['pembelianKaryawan'];?></td>
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
<?php
include 'footer.php';
?>