<?php 
include 'header.php';
$idfaktur = $_GET['idfaktur'];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        <!-- <p id="total"> </p> -->
        <h1>Detail Pembelian Faktur <?= "J-".$idfaktur ?></h1>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
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
                    <td><?= "Rp.".number_format( $d['dpembelianHarga'],0,',','.') ?></td>
                    <td><?= "Rp.".number_format( $d['dpembelianTotal'],0    ,',','.') ?></td>
                    <?php if($d['dpembelianRetur'] == 0){ ?>
                    <td>
                    <a class="btn btn-primary" href="formreturpembelian.php?iditem=<?=$d['dpembelianId'] ?>&idfaktur=<?=$d['pembelianId'] ?>" role="button" data-toggle="tooltip" title="Retur">Retur</a>
                    </td>
                    <?php } ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <a class="btn btn-primary my-5" href="pembelianlist.php" role="button">Kembali</a>
        </div>
    </div>
    <h1>Data Retur</h1>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Tanggal Retur</th>
                <th>Keterangan</th>
                <th>Total Harga</th>
                <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $r = new Pembelian;
            $retur = $r->dataRetur($idfaktur);
            foreach($retur as $r):
            ?>
                <tr>
                <td><?= $r['dpembelianBarang'];?> </td>
                <td><?= $r['dpembelianJumlah'];?> </td>
                <td><?= $r['dpembelianHarga'];?> </td>
                <td><?= date("d-M-Y", strtotime($r['dpembelianReturTanggal'])); ?></td>
                <td><?= $r['pembelianKeterangan'];?></td>
                <td><?= "Rp.".number_format( $r['HargaAkhir'],2,',','.') ?></td>
                <td>
                <form action="../controllers/Pembelianolah.php" method="POST">
                <input type="hidden" name="idfaktur" id="idfaktur" value="<?= $idfaktur;?>"/>
                <input type="hidden" name="iditem" id="iditem" value="<?= $r['dpembelianId'];?>"/>
                <button type="submit" name="hapusretur" class="btn btn-danger" role="button" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash"></i></button>
                </form>
                </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
</div>
<?php
include 'footer.php';
?>