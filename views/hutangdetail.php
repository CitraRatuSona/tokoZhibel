<?php 
include 'header.php';
$idfaktur = $_GET['idfaktur'];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        <a class="btn btn-primary" href="hutanglist.php" role="button">Kembali</a>
        <h1>Detail Pembelian Faktur <?= "B-".$idfaktur ?></h1>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Diskon</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                include '../models/ClassPembelian.php';
                $d = new Pembelian;
                $data = $d->detailPembelianFaktur($idfaktur);
                $i = 1;
                foreach($data as $d):
                ?>
                    <tr>
                    <td><?= $i++?></td>
                    <td><?=$d['dpembelianBarang'];?></td>
                    <td><?=$d['dpembelianJumlah'];?></td>
                    <td><?= "Rp.".number_format( $d['dpembelianHarga'],2,',','.') ?></td>
                    <td><?= "Rp.".number_format( $d['dpembelianDiskon'],2,',','.') ?></td>
                    <td>
                    <a class="btn btn-primary" href="formreturpembelian.php?iditem=<?=$d['dpembelianId'] ?>&idfaktur=<?=$d['pembelianId'] ?>" role="button" data-toggle="tooltip" title="Retur">Retur</a>
                    </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <form method="POST" action="../controllers/Pembelianolah.php">
            <input type="hidden" name="idfaktur" id="idfaktur" value="<?= $idfaktur;?>"/>
            <input type="hidden" name="tanggalbayar" id="tanggalbayar" value="<?= date('Y-m-d');?>"/>
            <button class="btn btn-primary" type="submit" name="updatehutang" onClick="return confirm('Apakah yakin membayar hutang?');">Bayar</button>
            </form>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>