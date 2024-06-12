<?php 
include 'header.php';
include '../models/ClassPembelian.php';
$pe = new Pembelian;
$data = $pe->detailPembelian($_GET['ubahpembelianid']);
?>
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
            <li class="breadcrumb-item"><a href="pembelianlist.php">Daftar Pembelian</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Pembelian</li>
        </ol>
    </nav>
    <div class="jumbotron">
        <form action="http://localhost/suryajaya/controllers/Pembelianolah.php" method="POST">
        <?php foreach($data as $pe): ?>
            <div class="form-group">
                    <label for="tanggalbeli">Tanggal Beli</label>
                    <input type="date" class="form-control" id="tanggalbeli" name="tanggalbeli" value="<?= $pe['pembelianTanggal'] ?>">
                </div>
                <div class="form-group">
                    <label for="jatuhtempo">Jatuh Tempo</label>
                    <input type="date" class="form-control" id="jatuhtempo" name="jatuhtempo" value="<?= $pe['pembelianJatuhtempo'] ?>">
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="carabayar" id="Tunai" value="Tunai" <?php if($pe['pembelianCara']=="Tunai"){ echo "checked"; }?>>
                    <label class="form-check-label" for="Tunai">Tunai</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="carabayar" id="Kredit" value="Kredit" <?php if($pe['pembelianCara']=="Kredit"){ echo "checked"; }?>>
                    <label class="form-check-label" for="Kredit">Kredit</label>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="varchar" class="form-control" id="keterangan" name="keterangan" value="<?= $pe['pembelianKeterangan'] ?>">
                </div>
        <input type="hidden" name="idpembelian" value="<?= $_GET['ubahpembelianid'];?>"/>
        <a class="btn btn-dark" href="pembelianlist.php" role="button">Kembali</a>
        <button type="submit" class="btn btn-primary" name="ubahpembelianid">Ubah</button>
        <?php endforeach; ?>
        </form>
    </div>
</div>

<?php
include 'footer.php';
?>