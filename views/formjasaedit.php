<?php 
include 'header.php';
include '../models/ClassJasa.php';
$be = new Jasa;
$data = $be->detailJasa($_GET['ubahjasaid']);
?>
<div class="container-fluid">
    <div class="jumbotron">
        <form action="../controllers/Jasaolah.php" method="POST">
        <?php foreach($data as $be): ?>
            <div class="form-group">
                    <label for="namajasa">Nama Jasa</label>
                    <input type="text" class="form-control" id="namajasa" name="namajasa" value="<?= $be['jasaNama'] ?>">
                </div>
                <div class="form-group">
                    <label for="hargajual">Harga Jual</label>
                    <input type="number" class="form-control" id="hargajual" name="hargajual" value="<?= $be['jasaHarga'] ?>">
                </div>
        <input type="hidden" name="idjasa" value="<?= $_GET['ubahjasaid'];?>"/>
        <a class="btn btn-dark" href="jasalist.php" role="button">Kembali</a>
        <button type="submit" class="btn btn-primary" name="ubahjasaid">Ubah</button>
        <?php endforeach; ?>
        </form>
    </div>
</div>

<?php
include 'footer.php';
?>