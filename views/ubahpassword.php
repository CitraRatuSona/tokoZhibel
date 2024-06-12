<?php 
include 'header.php';
?>
<div class="container-fluid">
    <div class="jumbotron">
            <form action="../controllers/Userolah.php" method="POST">
                <div class="form-group">
                    <label for="passwordlama">Password Lama</label>
                    <input type="password" class="form-control" id="passwordlama" name="passwordlama" required>
                </div>
                <div class="form-group">
                    <label for="passwordbaru">Password Baru</label>
                    <input type="password" class="form-control" id="passwordbaru" name="passwordbaru" required>
                </div>
                <div class="form-group">
                    <label for="konfirmasipassword">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" id="konfirmasipassword" name="konfirmasipassword" required>
                </div>
                <input type="hidden" name="iduser" value="<?= $_SESSION['id'];?>"/>
                <button type="submit" class="btn btn-primary" name="ubahpassword">Simpan</button>
            </form>
    </div>
</div>


<?php
include 'footer.php';
?>