<?php 
include 'header.php';
$idfaktur = $_GET['idfaktur'];
?>
<div class="container-fluid">
    <nav aria-label="breadcrumb">   
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Piutang</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover" id="dataTable">
                <thead>
                    <tr>
                    <th>No Faktur</th>
                    <th>Tanggal Jual</th>
                    <th>Jatuh Tempo</th>
                    <th>Dijual oleh</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                include '../models/ClassPenjualan.php';
                $d = new Penjualan;
                $data = $d->detailPenjualanKredit();
                foreach($data as $d):
                ?>
                    <tr>
                    <td><?= 'J-'. $d['penjualanId'];?> </td>
                    <td><?= date("d-M-Y", strtotime($d['penjualanTanggal'])); ?></td>
                    <td><?= date("d-M-Y", strtotime($d['penjualanJatuhtempo'])); ?></td>
                    <td><?= $d['penjualanKaryawan'];?></td>
                    <td><?= $d['penjualanKeterangan'];?></td>
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
<?php
include 'footer.php';
?>