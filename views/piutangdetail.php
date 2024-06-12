<?php 
include 'header.php';
$idfaktur = $_GET['idfaktur'];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        <a class="btn btn-primary" href="piutanglist.php" role="button">Kembali</a>
        <h1>Detail Penjualan Faktur <?= "J-".$idfaktur ?></h1>
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
                include '../models/ClassPenjualan.php';
                $d = new Penjualan;
                $data = $d->detailPenjualanBarang($idfaktur);
                $i = 1;
                foreach($data as $d):
                ?>
                    <tr>
                    <td><?= $i++?></td>
                    <td><?=$d['dpenjualanBarang'];?></td>
                    <td><?=$d['dpenjualanJumlah'];?></td>
                    <td><?= "Rp.".number_format( $d['dpenjualanHarga'],2,',','.') ?></td>
                    <td><?= "Rp.".number_format( $d['dpenjualanDiskon'],2,',','.') ?></td>
                    <td>
                    <a class="btn btn-primary" href="formreturpenjualan.php?iditem=<?=$d['dpenjualanId'] ?>&idfaktur=<?=$d['penjualanId'] ?>" role="button" data-toggle="tooltip" title="Retur">Retur</a>
                    </td>
                    </tr>
                <?php endforeach;
                $d = new Penjualan;
                $data = $d->detailPenjualanJasa($idfaktur);
                foreach($data as $d):
                ?>
                    <tr>
                    <td><?= $i++?></td>
                    <td><?=$d['djasaNama'];?></td>
                    <td><?=$d['djasaJumlah'];?></td>
                    <td><?= "Rp.".number_format( $d['djasaHarga'],2,',','.') ?></td>
                    <td><?= "Rp.".number_format( $d['djasaDiskon'],2,',','.') ?></td>
                    <td>
                    </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <form method="POST" action="../controllers/Penjualanolah.php">
            <input type="hidden" name="idfaktur" id="idfaktur" value="<?= $idfaktur;?>"/>
            <input type="hidden" name="tanggalbayar" id="tanggalbayar" value="<?= date('Y-m-d') ;?>"/>
            <button class="btn btn-primary" type="submit" name="updatepiutang" onClick="return confirm('Apakah yakin Proses Penjualan?');">Proses</button>
            </form>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>