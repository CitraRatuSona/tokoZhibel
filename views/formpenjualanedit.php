<?php 
include 'header.php';
include '../models/ClassPenjualan.php';
$pe = new Penjualan;
$data = $pe->detailPenjualan($_GET['ubahpenjualanid']);
?>
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
            <li class="breadcrumb-item"><a href="penjualanlist.php">Daftar Penjualan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Penjualan</li>
        </ol>
    </nav>
    <div class="jumbotron">
        <form action="http://localhost/suryajaya/controllers/Penjualanolah.php" method="POST">
        <?php foreach($data as $pe): ?>
            <div class="form-group">
                    <label for="tanggaljual">Tanggal Jual</label>
                    <input type="date" class="form-control" id="tanggaljual" name="tanggaljual" value="<?= $pe['penjualanTanggal'] ?>">
                </div>
                <div class="form-group">
                    <label for="jatuhtempo">Jatuh Tempo</label>
                    <input type="date" class="form-control" id="jatuhtempo" name="jatuhtempo" value="<?= $pe['penjualanJatuhtempo'] ?>">
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="carabayar" id="Tunai" value="Tunai" <?php if($pe['penjualanCara']=="Tunai"){ echo "checked"; }?>>
                    <label class="form-check-label" for="Tunai">Tunai</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="carabayar" id="Kredit" value="Kredit" <?php if($pe['penjualanCara']=="Kredit"){ echo "checked"; }?>>
                    <label class="form-check-label" for="Kredit">Kredit</label>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="varchar" class="form-control" id="keterangan" name="keterangan" value="<?= $pe['penjualanKeterangan'] ?>">
                </div>
        <input type="hidden" name="idpenjualan" value="<?= $_GET['ubahpenjualanid'];?>"/>
        <a class="btn btn-dark" href="penjualanlist.php" role="button">Kembali</a>
        <button type="submit" class="btn btn-primary" name="ubahpenjualanid">Ubah</button>
        <?php endforeach; ?>
        </form>
    </div>
</div>

<?php
include 'footer.php';
?>