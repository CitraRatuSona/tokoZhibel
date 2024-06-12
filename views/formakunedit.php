<?php 
include 'header.php';
include '../models/ClassAkun.php';
$ak = new Akun;
$data = $ak->detailAkun($_GET['ubahakunid']);
?>
<div class="container-fluid">
    <div class="jumbotron">
        <form action="../controllers/Akunolah.php" method="POST">
        <?php foreach($data as $a): ?>
        <div class="form-group">
            <label for="nama">Nama Akun</label>
            <input type="text" class="form-control" id="namaakun" name="namaakun" value="<?= $a['akunNama'];?>">
        </div>
        <div class="form-group">
        <label for="jenisakun">Jenis Akun</label>
            <select class="form-control" name="jenisakun">
                <option value="" disable>Pilih Jenis Akun</option>
                <option value="Aset" <?php if($a['akunJenis']=="Aset") echo "selected"; ?>>Aset</option>        
                <option value="Utang" <?php if($a['akunJenis']=="Utang") echo "selected"; ?>>Utang</option>
                <option value="Modal" <?php if($a['akunJenis']=="Modal") echo "selected"; ?>>Modal</option>
                <option value="Pendapatan" <?php if($a['akunJenis']=="Pendapatan") echo "selected"; ?>>Pendapatan</option>
                <option value="Biaya dan Beban" <?php if($a['akunJenis']=="Biaya dan Beban") echo "selected"; ?>>Biaya dan Beban</option>
            </select>
        </div>
        <div class="form-group">
            <label for="saldonormal">Saldo Normal</label>
            <select class="form-control" name="saldonormal">
                <option value="" disable>Pilih Saldo Normal</option>
                <option value="Debit" <?php if($a['akunSaldoNormal']=="Debit") echo "selected"; ?>>Debit</option>
                <option value="Kredit" <?php if($a['akunSaldoNormal']=="Kredit") echo "selected"; ?>>Kredit</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nama">Saldo Awal</label>
            <input type="number" class="form-control" id="saldoawal" name="saldoawal" value="<?= $a['akunSaldoAwal'];?>">
        </div>
        <input type="hidden" name="idakun" value="<?= $_GET['ubahakunid'];?>"/>
        <a class="btn btn-dark" href="akunlist.php" role="button">Kembali</a>
        <button type="submit" class="btn btn-primary" name="ubahakunid">Ubah</button>
        <?php endforeach; ?>
        </form>
    </div>
</div>

<?php
include 'footer.php';
?>