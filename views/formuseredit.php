<?php 
include 'header.php';
include '../models/ClassUser.php';
$user = new User;
$data = $user->detailUser($_GET['ubahuserid']);
?>
<div class="container-fluid">
    <div class="jumbotron">
        <form action="../controllers/Userolah.php" method="POST">
        <?php foreach($data as $us): ?>
        <div class="form-group">
            <label for="nama">Nama Customer</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $us['userNama'];?>">
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $us['userAlamat'];?>">
        </div>
        <div class="form-group">
            <label for="telp">Telp</label>
            <input type="tel" class="form-control" id="telp" name="telp" value="<?= $us['userTelp'];?>">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= $us['userUsername'];?>" readonly>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <input type="hidden" name="id" value="<?= $us['userId'];?>"/>
        <a class="btn btn-dark" href="customerlist.php" role="button">Kembali</a>
        <button type="submit" class="btn btn-primary" name="ubahuser">Simpan</button>
        <?php endforeach; ?>
        </form>
    </div>
</div>  


<?php
include 'footer.php';
?>