<?php 
include 'header.php';
include '../models/ClassCustomer.php';
$cus = new Customer;
$data = $cus->detailCustomer($_GET['ubahcustomerid']);
?>
<div class="container-fluid">
    <div class="jumbotron">
        <form action="../controllers/Customerolah.php" method="POST">
        <?php foreach($data as $c): ?>
        <div class="form-group">
            <label for="nama">Nama Customer</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $c['customerNama'];?>">
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $c['customerAlamat'];?>">
        </div>
        <div class="form-group">
            <label for="telp">Telp</label>
            <input type="tel" class="form-control" id="telp" name="telp" value="<?= $c['customerTelp'];?>">
        </div>
        <input type="hidden" name="idcustomer" value="<?= $_GET['ubahcustomerid'];?>"/>
        <a class="btn btn-dark" href="customerlist.php" role="button">Kembali</a>
        <button type="submit" class="btn btn-primary" name="ubahcustomerid">Ubah</button>
        <?php endforeach; ?>
        </form>
    </div>
</div>


<?php
include 'footer.php';
?>