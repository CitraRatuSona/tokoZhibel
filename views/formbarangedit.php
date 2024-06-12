<?php 
include 'header.php';
include '../models/ClassBarang.php';
$be = new Barang;
$data = $be->detailBarang($_GET['ubahbarangid']);
?>
<div class="container-fluid">
    <div class="jumbotron">
        <form action="../controllers/Barangolah.php" method="POST">
        <?php foreach($data as $be): ?>
            <div class="form-group">
                    <label for="namabarang">Nama Barang</label>
                    <input type="text" class="form-control" id="namabarang" name="namabarang" value="<?= $be['barangNama'] ?>">
                </div>
                <div class="form-group">
                    <label for="stok">Stok Barang</label>
                    <input type="number" class="form-control" id="stok" name="stok" value="<?= $be['barangStok'] ?>">
                </div>
                <div class="form-group">
                    <label for="hargabeli">Harga Beli</label>
                    <input type="number" class="form-control" id="hargabeli" name="hargabeli" value="<?= $be['hargaBeli'] ?>">
                </div>
                <div class="form-group">
                    <label for="hargajual">Harga Jual</label>
                    <input type="number" class="form-control" id="hargajual" name="hargajual" value="<?= $be['hargaJual'] ?>">
                </div>
        <input type="hidden" name="idbarang" value="<?= $_GET['ubahbarangid'];?>"/>
        <a class="btn btn-dark" href="baranglist.php" role="button">Kembali</a>
        <button type="submit" class="btn btn-primary" name="ubahbarangid">Ubah</button>
        <?php endforeach; ?>
        </form>
    </div>
</div>

<?php
include 'footer.php';
?>