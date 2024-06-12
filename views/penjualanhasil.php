<?php 
include 'header.php';
include '../config/koneksi.php';
$idfaktur = $_GET['idfaktur'];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        <!-- <p id="total"> </p> -->
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
                    <?php if($d['dpenjualanRetur'] == 0){ ?>
                    <td>
                    <a class="btn btn-primary" href="formreturpenjualan.php?iditem=<?=$d['dpenjualanId'] ?>&idfaktur=<?=$d['penjualanId'] ?>" role="button" data-toggle="tooltip" title="Retur">Retur</a>
                    </td>
                    <?php }?>
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
                <?php endforeach; 
                $j = mysqli_query($con,"SELECT SUM(djasaTotal) AS TotalHarga, SUM(djasaDiskon) AS TotalDiskon FROM detailpenjualanjasa WHERE penjualanId = '$idfaktur'");
                $jj = mysqli_fetch_assoc($j);
                $totalhargajasa = $jj['TotalHarga'];
                $totaldiskonjasa = $jj['TotalDiskon'];
                $totalbayarjasa = $totalhargajasa - $totaldiskonjasa;

                $b = mysqli_query($con,"SELECT SUM(dpenjualanTotal) AS TotalHarga, SUM(dpenjualanDiskon) AS TotalDiskon FROM detailpenjualan WHERE penjualanId = '$idfaktur'");
                $bb = mysqli_fetch_assoc($b);
                $totalhargabarang = $bb['TotalHarga'];
                $totaldiskonbarang = $bb['TotalDiskon'];
                $totalbayarbarang = $totalhargabarang - $totaldiskonbarang;

                $totalharga = $totalhargabarang + $totalhargajasa;
                $totaldiskon = $totaldiskonbarang + $totaldiskonjasa;
                $totalbayar = $totalbayarbarang + $totalbayarjasa;
                ?>
                <td></td>
                <td></td>
                <td></td>
                <td><?= "Rp.".number_format( $totalharga,2,',','.') ?></td>
                <td><?= "Rp.".number_format( $totaldiskon,2,',','.') ?></td>
                <td><?= "Rp.".number_format( $totalbayar,2,',','.') ?></td>
                </tbody>
            </table>
            <a class="btn btn-primary my-5" href="penjualanlist.php" role="button">Kembali</a>
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
            $r = new Penjualan;
            $retur = $r->dataRetur($idfaktur);
            foreach($retur as $r):
            ?>
                <tr>
                <td><?= $r['dpenjualanBarang'];?> </td>
                <td><?= $r['dpenjualanJumlah'];?> </td>
                <td><?= $r['dpenjualanHarga'];?> </td>
                <td><?= date("d-M-Y", strtotime($r['dpenjualanReturTanggal'])); ?></td>
                <td><?= $r['pembelianKeterangan'];?></td>
                <td><?= "Rp.".number_format( $r['HargaAkhir'],2,',','.') ?></td>
                <td>
                <form action="../controllers/Penjualanolah.php" method="POST">
                <input type="hidden" name="idfaktur" id="idfaktur" value="<?= $idfaktur;?>"/>
                <input type="hidden" name="iditem" id="iditem" value="<?= $r['dpenjualanId'];?>"/>
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