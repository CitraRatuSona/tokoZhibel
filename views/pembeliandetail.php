<?php 
include 'header.php';
$idfaktur = $_GET['idfaktur'];
?>
<h1 class="mx-4">Form Pembelian</h1>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-tools pull-right">
                        <div class="form-group">
                        <label for="namabarang">Nama Item</label>
                        <select class="form-control" id="namabarang" name="namabarang" onchange={handleChange(this.value)}>
                        <option></option>
                        <?php
                        include '../models/ClassBarang.php';
                        $b = new Barang;
                        $data = $b->tampilBarang();
                        foreach($data as $b):
                        ?>
                            <option value="<?= $b['barangNama'];?>"><?= $b['barangNama'];?></option>
                        <?php endforeach; ?>
                        </select>
                        </div>
                        <!-- <label for="kodebarang">Kode Barang : </label> -->
                        <input type="hidden" class="form-control" id="kodebarang" name="kodebarang" readonly>
                    </div>
                </div>
                <div class="box-body">
                <input type="hidden" id="idfaktur" value="<?= $idfaktur;?>"/>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="stokbarang">Stok Barang : </label>
                            <input type="number" class="form-control" id="stokbarang" name="stokbarang" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="hargabeli">Harga Pembelian : </label>
                            <input type="number" class="form-control" id="hargabeli" name="hargabeli" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="jumlahbeli">Jumlah : </label>
                            <input type="number" class="form-control" id="jumlahbeli" name="jumlahbeli">
                        </div>
                        <div class="col-md-6">
                            <label for="diskonbeli">Diskon (%) : </label>
                            <input type="number" class="form-control" id="diskonbeli" name="diskonbeli">
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-primary my-3" name="tambahbeli" onClick={handleSubmit()}>Tambah</button>
                    <input class="btn btn-warning" type="reset" value="Reset">
                </div>
            </div>
        </div>
        <div class="col-md-6">
        <p id="total"> </p>
        <h1>Detail Pembelian</h1>
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
                    <td><?= "Rp.".number_format( $d['dpembelianHarga'],0,',','.') ?></td>
                    <td><?= "Rp.".number_format( $d['dpembelianDiskon'],0,',','.') ?></td>
                    <td>
                    <button class="btn btn-danger" onClick={handleDelete(<?= $d["dpembelianId"].','.$d['dpembelianKodebarang']; ?>)}><i class="fas fa-trash-alt" data-toggle="tooltip" title="Hapus"></i></button>
                    </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Pembayaran
                    </div>
                    <div class="card-body">
                    <?php
                    $b = mysqli_query($con,"SELECT *, SUM(dpembelianTotal) AS TotalHarga, SUM(dpembelianDiskon) AS TotalDiskon FROM detailpembelian WHERE pembelianId = '$idfaktur'");
                    $bb = mysqli_fetch_assoc($b);
                    $totalharga = $bb['TotalHarga'];
                    $totaldiskon = $bb['TotalDiskon'];
                    $totalbayar = $totalharga - $totaldiskon;

                    ?>
                        <h4 class="card-title">Total Harga <?= "Rp. ".number_format( $totalharga,0,',','.') ?></h4>
                        <h4 class="card-title">Total Diskon <?= "Rp. ".number_format( $totaldiskon,0,',','.') ?></h4>
                        <h4 class="card-title">Total Bayar <?= "Rp. ".number_format( $totalbayar,0,',','.') ?></h4>
                        <form method="POST" action="../controllers/Pembelianolah.php">
                        <input type="hidden" name="idfaktur" id="idfaktur" value="<?= $idfaktur;?>"/>
                        <button class="btn btn-primary" type="submit" name="updatebeli">Proses</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>
<script>
function handleChange(val) {
    // document.getElementById("total").innerHTML = val;
    $.ajax({
        url:"../controllers/Pembelianolah.php",
        data:"namabarang="+val,
        cache:false,
        success:function(msg){
            data=msg.split("|");
            
            //masukan isi data ke masing - masing field
            document.getElementById("stokbarang").value = data[3];
            document.getElementById("hargabeli").value = data[2];
            document.getElementById("kodebarang").value = data[4];
        }
    });
}

function handleSubmit() {
    var id = document.getElementById("idfaktur").value;
    var nama = document.getElementById("namabarang").value;
    var jumlah = document.getElementById("jumlahbeli").value;
    var harga = document.getElementById("hargabeli").value;
    var diskon = document.getElementById("diskonbeli").value;
    var stok = document.getElementById("stokbarang").value;
    var kodebarang = document.getElementById("kodebarang").value;

    // var parsedJumlah = parseInt(jumlah, 10);
    // var parsedStok = parseInt(stok, 10);

    if(nama == '') {
        alert('Pilih Nama Barang');
        exit();
    }else if(jumlah == 0) {
        alert('Isi Jumlah Barang');
        exit();
    }

    $.ajax({
        url:"../controllers/Pembelianolah.php",
        data:"aksi=tambahItem&id="+id+"&kodebarang="+kodebarang+"&nama="+nama+"&jumlah="+jumlah+"&harga="+harga+"&diskon="+diskon+"&stok="+stok,
        cache:false,
        success:function(msg){
            alert(msg);
            window.location.reload();
        }
    });
}

function handleDelete(iditem, kodebarang) {
    $.ajax({
        url:"../controllers/Pembelianolah.php",
        data:"aksi=hapusItem&iditem="+iditem+"&kodebarang="+kodebarang,
        cache:false,
        success:function(msg){
            alert(msg);
            window.location.reload();
        }
    });
}
</script>


<?php
include 'footer.php';
?>