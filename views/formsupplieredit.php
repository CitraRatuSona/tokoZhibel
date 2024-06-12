<?php 
include 'header.php';
include '../models/ClassSupplier.php';
$cus = new Supplier;
$data = $cus->detailsupplier($_GET['ubahsupplierid']);
?>
<div class="container-fluid">
    <div class="jumbotron">
        <form action="../controllers/supplierolah.php" method="POST">
        <?php foreach($data as $c): ?>
        <div class="form-group">
            <label for="nama">Nama Supplier</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $c['supplierNama'];?>">
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $c['supplierAlamat'];?>">
        </div>
        <div class="form-group">
            <label for="telp">Telp</label>
            <input type="tel" class="form-control" id="telp" name="telp" value="<?= $c['supplierTelp'];?>">
        </div>
        <input type="hidden" name="id" value="<?= $_GET['ubahsupplierid'];?>"/>
        <a class="btn btn-dark" href="supplierlist.php" role="button">Kembali</a>
        <button type="submit" class="btn btn-primary" name="ubahsupplierid">Ubah</button>
        <?php endforeach; ?>
        </form>
    </div>
</div>


<?php
include 'footer.php';
?>