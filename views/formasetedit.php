<?php 
include 'header.php';
include '../models/ClassAset.php';
$as = new Aset;
$data = $as->detailAset($_GET['ubahasetid']);
?>
<div class="container-fluid">
    <div class="jumbotron">
        <form action="../controllers/Asetolah.php" method="POST">
        <?php foreach($data as $as): ?>
            <div class="form-group">
                    <label for="namaaset">Nama Aset</label>
                    <input type="text" class="form-control" id="namaaset" name="namaaset" value="<?= $as['asetNama'] ?>">
                </div>
                <div class="form-group">
                    <label for="tanggalaset">Tanggal Pembelian Aset</label>
                    <input type="date" class="form-control" id="tanggalaset" name="tanggalaset" value="<?= $as['asetTanggal'] ?>">
                </div>
                <div class="form-group">
                    <label for="jumlahaset">Jumlah Aset</label>
                    <input type="number" class="form-control" id="jumlahaset" name="jumlahaset" value="<?= $as['asetJumlah'] ?>">
                </div>
                <div class="form-group">
                    <label for="hargaaset">Harga Aset</label>
                    <input type="number" class="form-control" id="hargaaset" name="hargaaset" value="<?= $as['asetHarga'] ?>">
                </div>
                <div class="form-group">
                    <label for="masamanfaat">Masa Manfaat Aset</label>
                    <select class="form-control" name="masamanfaat">
                        <option value="" disable>Pilih Masa Manfaat</option>
                        <option value="4" <?php if($as['asetManfaat']=="4"){ echo "selected"; }?>>4 Tahun (48 Bulan)</option>
                        <option value="8" <?php if($as['asetManfaat']=="8"){ echo "selected"; }?>>8 Tahun (96 Bulan)</option>
                        <option value="20" <?php if($as['asetManfaat']=="20"){ echo "selected"; }?>>20 Tahun (240 Bulan)</option>
                    </select>
                </div>
        <input type="hidden" name="idaset" value="<?= $_GET['ubahasetid'];?>"/>
        <a class="btn btn-dark" href="asetlist.php" role="button">Kembali</a>
        <button type="submit" class="btn btn-primary" name="ubahasetid">Ubah</button>
        <?php endforeach; ?>
        </form>
    </div>
</div>

<?php
include 'footer.php';
?>