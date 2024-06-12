<?php 
include 'header.php';
include '../models/ClassBeban.php';
$be = new Beban;
$data = $be->detailBeban($_GET['ubahbebanid']);
?>
<div class="container-fluid">
    <div class="jumbotron">
        <form action="../controllers/Bebanolah.php" method="POST">
        <?php foreach($data as $be): ?>
                <div class="form-group">
                    <label for="tanggalbeban">Tanggal Beban</label>
                    <input type="date" class="form-control" id="tanggalbeban" name="tanggalbeban" value="<?= $be['bebanTanggal'] ?>">
                </div>
                <div class="form-group">
                    <label for="serbaserbi">Serba Serbi</label>
                    <select class="form-control" name="serbaserbi">
                        <option value="" disable>Pilih Serba Serbi</option>
                        <option value="Beban Gaji" <?php if($be['bebanSerba']=="Beban Gaji") echo "selected"; ?>>Beban Gaji</option>
                        <option value="Beban Listrik" <?php if($be['bebanSerba']=="Beban Listrik") echo "selected"; ?>>Beban Listrik</option>
                        <option value="Beban Penyusutan Peralatan Toko" <?php if($be['bebanSerba']=="Beban Penyusutan Peralatan Toko") echo "selected"; ?>>Beban Penyusutan Peralatan Toko</option>
                        <option value="Beban Sewa" <?php if($be['bebanSerba']=="Beban Sewa") echo "selected"; ?>>Beban Sewa</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nominalbeban">Nominal Beban</label>
                    <input type="number" class="form-control" id="nominalbeban" name="nominalbeban" value="<?= $be['bebanNominal'] ?>">
                </div>
                <div class="form-group">
                    <label for="keteranganbbeban">Keterangan Beban</label>
                    <input type="text" class="form-control" id="keteranganbbeban" name="keteranganbbeban" value="<?= $be['bebanKeterangan'] ?>">
                </div>
        <input type="hidden" name="idbeban" value="<?= $_GET['ubahbebanid'];?>"/>
        <a class="btn btn-dark" href="bebanlist.php" role="button">Kembali</a>
        <button type="submit" class="btn btn-primary" name="ubahbebanid">Ubah</button>
        <?php endforeach; ?>
        </form>
    </div>
</div>

<?php
include 'footer.php';
?>