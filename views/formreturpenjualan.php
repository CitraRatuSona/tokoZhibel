<?php 
include 'header.php';
include '../models/ClassPenjualan.php';
$iditem = $_GET['iditem'];
$idfaktur = $_GET['idfaktur'];
$re = new Penjualan;
$data = $re->detailItem($iditem);
?>
<div class="container-fluid">
    <div class="jumbotron">
        <form action="../controllers/Penjualanolah.php" method="POST">
        <?php foreach($data as $re): ?>
                    <input type="hidden" name="idfaktur" value="<?= $idfaktur ?>"/>
                    <input type="hidden" name="idbarang" value="<?= $re['barangId'] ?>"/>
                    <?php
                    $total = $re['dpenjualanTotal'];
                    $jumlah = $re['dpenjualanJumlah'];
                    $hargaakhir = $total/$jumlah;
                    ?>
                    <h1><?= $re['dpenjualanBarang'] ?></h1>
                    <input type="hidden" name="namabarang" value="<?= $re['dpenjualanBarang'] ?>"/>
                <div class="form-group">
                    <label for="jumlahpembelian">Jumlah Pembelian</label>
                    <input type="number" class="form-control" id="jumlahpembelian" name="jumlahpembelian" value="<?= $re['dpenjualanJumlah'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="hargajual">Harga Penjualan/Item</label>
                    <input type="number" class="form-control" id="hargajual" name="hargajual" value="<?= $hargaakhir ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="jumlahretur">Jumlah Retur</label>
                    <input type="number" class="form-control" id="jumlahretur" name="jumlahretur">
                </div>
                    <input type="hidden" name="hargabarang" value="<?= $re['dpenjualanHarga'] ?>"/>
                <div class="form-group">
                    <label for="tanggalretur">Tanggal Retur</label>
                    <input type="date" class="form-control" id="tanggalretur" name="tanggalretur" value="<?= date('Y-m-d'); ?>">
                </div>
        <a class="btn btn-dark" href="penjualanlist.php" role="button">Kembali</a>
        <button type="submit" class="btn btn-primary" name="returpenjualan">Retur</button>
        <?php endforeach; ?>
        </form>
    </div>
</div>

<?php
include 'footer.php';
?>