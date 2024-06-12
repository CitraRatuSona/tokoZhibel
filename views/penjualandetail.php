<?php 
include 'header.php';
include '../config/koneksi.php';
$idfaktur = $_GET['idfaktur'];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
        <h1>Form Penjualan Barang</h1>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-tools pull-right">
                        <label for="namabarang">Nama Barang</label>
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
                        <!-- <label for="kodebarang">Kode Barang : </label> -->
                        <input type="hidden" class="form-control" id="kodebarang" name="kodebarang" readonly>
                    </div>
                </div>
                <div class="box-body">
                <input type="hidden" id="idfaktur" value="<?= $idfaktur;?>"/>
                <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="stokjual">Stok Barang : </label>
                            <input type="number" class="form-control" id="stokjual" name="stokjual" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="hargajual">Harga Jual</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="number" class="form-control" id="hargajual" name="hargajual">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="jumlahjual">Jumlah : </label>
                            <input type="number" class="form-control" id="jumlahjual" name="jumlahjual">
                        </div>
                        <div class="col-md-6">
                            <label for="diskonjual">Diskon Jual</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="number" class="form-control" id="diskonjual" name="diskonjual">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-primary my-3" name="tambahjual" onClick={handleSubmit()}>Tambah</button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h1>Form Penjualan Jasa</h1>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-tools pull-right">
                    <div class="form-group">
                        <label for="namajasa">Nama Jasa</label>
                        <select class="form-control" id="namajasa" name="namajasa" onchange={handleChangeJasa(this.value)}>
                        <option></option>    
                        <?php
                        include '../models/ClassJasa.php';
                        $j = new Jasa;
                        $data = $j->tampilJasa();
                        foreach($data as $j):
                        ?>
                        <option value="<?= $j['jasaNama'];?>"><?= $j['jasaNama'];?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="hargajasa">Harga Jasa</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="number" class="form-control" id="hargajasa" name="hargajasa" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="jumlahjasa">Jumlah : </label>
                            <input type="number" class="form-control" id="jumlahjasa" name="jumlahjasa">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                                <label for="diskonjasa">Diskon Jasa</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" class="form-control" id="diskonjasa" name="diskonjasa">
                                </div>
                        </div>
                        <input type="hidden" class="form-control" id="kodejasa" name="kodejasa" readonly>
                        <div class="col-md-6">
                            <label for="keteranganjasa">Keterangan</label>
                            <input type="text" class="form-control" id="keteranganjasa" name="keteranganjasa">
                        </div>
                    </div>
                    <button class="btn btn-primary my-3" name="tambahjasa" id="tambahjasa" onClick={handleSubmitJasa()}>Tambah</button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-9">
        <!-- <p id="total"> </p> -->
        <h1>Detail Penjualan</h1>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total Harga</th>
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
                    <td><?= "Rp. ".number_format( $d['dpenjualanHarga'],0,',','.') ?></td>
                    <td><?= "Rp. ".number_format( $d['TotalHargaItem'],0,',','.') ?></td>
                    <td><?= "Rp. ".number_format( $d['dpenjualanDiskon'],0,',','.') ?></td>
                    <td>
                    <button class="btn btn-danger" onClick={handleDelete(<?= $d["dpenjualanId"].','.$d['barangId']; ?>)}><i class="fas fa-trash-alt" data-toggle="tooltip" title="Hapus"></i></button>
                    </td>
                    </tr>
                </tbody>
                <?php endforeach; ?>
                
                <tbody>
                <?php
                $d = new Penjualan;
                $data = $d->detailPenjualanJasa($idfaktur);
                foreach($data as $j):
                ?>
                    <tr>
                    <td><?= $i++?></td>
                    <td><?=$j['djasaNama'];?></td>
                    <td><?=$j['djasaJumlah'];?></td>
                    <td><?= "Rp. ".number_format( $j['djasaHarga'],0,',','.') ?></td>
                    <td><?= "Rp. ".number_format( $j['TotalHargaJasa'],0,',','.') ?></td>
                    <td><?= "Rp. ".number_format( $j['djasaDiskon'],0,',','.') ?></td>
                    <td>
                    <button class="btn btn-danger" onClick={handleDeleteJasa(<?= $j["djasaId"].','.$j['jasaId']; ?>)}><i class="fas fa-trash-alt" data-toggle="tooltip" title="Hapus"></i></button>
                    </td>
                    </tr>
                </tbody>
                <?php endforeach;  ?>
            </table>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    Pembayaran
                </div>
                <div class="card-body">
                <?php
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
                    <h4 class="card-title">Total Harga <?= "Rp. ".number_format( $totalharga,0,',','.') ?></h4>
                    <h4 class="card-title">Total Diskon <?= "Rp. ".number_format( $totaldiskon,0,',','.') ?></h4>
                    <h4 class="card-title">Total Bayar <?= "Rp. ".number_format( $totalbayar,0,',','.') ?></h4>
                    <form method="POST" action="../controllers/Penjualanolah.php">
                    <input type="hidden" name="idfaktur" id="idfaktur" value="<?= $idfaktur;?>"/>
                    <button class="btn btn-primary" type="submit" name="updatejual" onClick="return confirm('Apakah yakin untuk Proses Penjualan?');">Proses</button>
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
        url:"../controllers/Penjualanolah.php",
        data:"namabarang="+val,
        cache:false,
        success:function(msg){
            data=msg.split("|");
            
            //masukan isi data ke masing - masing field
            document.getElementById("stokjual").value = data[3];
            document.getElementById("hargajual").value = data[2];
            document.getElementById("kodebarang").value = data[4];
        }
    });
}

function handleChangeJasa(val) {
    // document.getElementById("total").innerHTML = val;
    $.ajax({
        url:"../controllers/Penjualanolah.php",
        data:"namajasa="+val,
        cache:false,
        success:function(msg){
            data=msg.split("|");
            
            //masukan isi data ke masing - masing field
            document.getElementById("hargajasa").value = data[0];
            document.getElementById("kodejasa").value = data[1];
        }
    });
}

function handleSubmit() {
    var id = document.getElementById("idfaktur").value;
    var nama = document.getElementById("namabarang").value;
    var jumlah = document.getElementById("jumlahjual").value;
    var harga = document.getElementById("hargajual").value;
    var diskon = document.getElementById("diskonjual").value;
    var stok = document.getElementById("stokjual").value;
    var kodebarang = document.getElementById("kodebarang").value;

    var parsedJumlah = parseInt(jumlah, 10);
    var parsedStok = parseInt(stok, 10);

    if(nama == '') {
        alert('Pilih Nama Barang');
        exit();
    }

    if(jumlah == 0) {
        alert('Isi Jumlah Barang');
        exit();
    }

    else if(parsedJumlah > parsedStok){
        alert('Jumlah jual melebihi stok');
        exit();
    }
    $.ajax({
        url:"../controllers/Penjualanolah.php",
        data:"aksi=tambahItem&id="+id+"&kodebarang="+kodebarang+"&nama="+nama+"&jumlah="+jumlah+"&harga="+harga+"&diskon="+diskon+"&stok="+stok,
        cache:false,
        success:function(msg){
            alert(msg);
            window.location.reload();
        }
    });
}

function handleSubmitJasa() {
    var id = document.getElementById("idfaktur").value;
    var nama = document.getElementById("namajasa").value;
    var jumlah = document.getElementById("jumlahjasa").value;
    var harga = document.getElementById("hargajasa").value;
    var diskon = document.getElementById("diskonjasa").value;
    var kodejasa = document.getElementById("kodejasa").value;

    if(nama == '') {
        alert('nama kosong');
        exit();
    }

    $.ajax({
        url:"../controllers/Penjualanolah.php",
        data:"aksi=tambahJasa&id="+id+"&kodejasa="+kodejasa+"&nama="+nama+"&jumlah="+jumlah+"&harga="+harga+"&diskon="+diskon,
        cache:false,
        success:function(msg){
            alert(msg);
            window.location.reload();
        }
    });
}

function handleDelete(iditem, kodebarang) {
    $.ajax({
        url:"../controllers/Penjualanolah.php",
        data:"aksi=hapusItem&iditem="+iditem+"&kodebarang="+kodebarang,
        cache:false,
        success:function(msg){
            alert(msg);
            window.location.reload();
        }
    });
}

function handleDeleteJasa(iditem, kodejasa) {
    $.ajax({
        url:"../controllers/Penjualanolah.php",
        data:"aksi=hapusJasa&iditem="+iditem+"&kodejasa="+kodejasa,
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