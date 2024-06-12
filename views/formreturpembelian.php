<?php 
include 'header.php';
include '../models/ClassPembelian.php';
$iditem = $_GET['iditem'];
$idfaktur = $_GET['idfaktur'];
$re = new Pembelian;
$data = $re->detailItem($iditem);
?>
<div class="container-fluid">
    <div class="jumbotron">
        <form action="../controllers/Pembelianolah.php" method="POST">
        <?php foreach($data as $re): ?>
                    <input type="hidden" name="idfaktur" value="<?= $idfaktur ?>"/>
                    <input type="hidden" name="idbarang" value="<?= $re['barangId'] ?>"/>
                    <?php
                    $total = $re['dpembelianTotal'];
                    $jumlah = $re['dpembelianJumlah'];
                    $hargaakhir = $total/$jumlah;
                    ?>
                    <h1><?= $re['dpembelianBarang'] ?></h1>
                    <input type="hidden" name="namabarang" value="<?= $re['dpembelianBarang'] ?>"/>
                <div class="form-group">
                    <label for="jumlahbeli">Jumlah Pembelian</label>
                    <input type="number" class="form-control" id="jumlahbeli" name="jumlahbeli" value="<?= $re['dpembelianJumlah'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="hargabeli">Harga Pembelian/Item</label>
                    <input type="number" class="form-control" id="hargabeli" name="hargabeli" value="<?= $hargaakhir ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="tanggalretur">Tanggal Retur</label>
                    <input type="date" class="form-control" id="tanggalretur" name="tanggalretur" value="<?= date('Y-m-d'); ?>">
                </div>
                <div class="form-group">
                    <label for="jumlahretur">Jumlah Retur</label>
                    <input type="number" class="form-control" id="jumlahretur" name="jumlahretur">
                </div>
                    <input type="hidden" name="hargabarang" value="<?= $re['dpembelianHarga'] ?>"/>
        <a class="btn btn-dark" href="pembelianlist.php" role="button">Kembali</a>
        <button type="submit" class="btn btn-primary" name="returpembelian">Retur</button>
        <?php endforeach; ?>
        </form>
    </div>
</div>

<?php
include 'footer.php';
?>