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
                        <input type="hidden" class="form-control" id="hargabeli" name="hargabeli" readonly>
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
                    <button class="btn btn-primary my-3" name="tambahjual" onClick={handleSubmitBarang()}>Tambah</button>
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
        <h1>Detail Penjualan <?="J-".$idfaktur ?> pada Tanggal <?= date('d-M-Y'); ?></h1>
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
                $data = $d->tampilSale($idfaktur);
                $i = 1;
                foreach($data as $d):
                ?>
                    <tr>
                    <td><?= $i++?></td>
                    <td><?=$d['saleNama'];?></td>
                    <td><?=$d['saleJumlah'];?></td>
                    <td><?= "Rp. ".number_format( $d['saleHarga'],0,',','.') ?></td>
                    <td><?= "Rp. ".number_format( $d['TotalHarga'],0,',','.') ?></td>
                    <td><?= "Rp. ".number_format( $d['saleDiskon'],0,',','.') ?></td>
                    <td>
                    <button class="btn btn-danger" onClick={handleDelete(<?= $d["saleId"]; ?>)}><i class="fas fa-trash-alt" data-toggle="tooltip" title="Hapus"></i></button>
                    </td>
                    </tr>
                </tbody>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    Pembayaran
                </div>
                <div class="card-body">
                <?php
                $s = mysqli_query($con,"SELECT SUM(saleHarga * saleJumlah) AS TotalHarga, SUM(saleDiskon) AS TotalDiskon FROM sale WHERE penjualanId = '$idfaktur'");
                $sa = mysqli_fetch_assoc($s);
                $totalharga = $sa['TotalHarga'];
                $totaldiskon = $sa['TotalDiskon'];
                $totalbayar = $totalharga - $totaldiskon;

                ?>
                    <h4 class="card-title">Total Harga <?= "Rp. ".number_format( $totalharga,0,',','.') ?></h4>
                    <h4 class="card-title">Total Diskon <?= "Rp. ".number_format( $totaldiskon,0,',','.') ?></h4>
                    <h4 class="card-title">Total Belanja <?= "Rp. ".number_format( $totalbayar,0,',','.') ?></h4>
                    <button type="button" class="btn btn-primary my-1" data-toggle="modal" data-target="#addpenjualan">Proses</button>
                    <!-- Modal -->
                    <div class="modal fade" id="addpenjualan" tabindex="-1" role="dialog" aria-labelledby="addpenjualanLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addpenjualanLabel">Form Tambah Penjualan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="../controllers/Penjualanolah.php" method="POST">
                                    <div class="form-group">
                                        <!-- <label for="tanggaljual">Tanggal Penjualan</label> -->
                                        <input type="hidden" class="form-control" id="tanggaljual" name="tanggaljual" value="<?= date('Y-m-d'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="-">
                                    </div>
                                    <div class="form-group">
                                    <label for="namacustomer">Dijual kepada</label>
                                    <select class="form-control" id="namacustomer" name="namacustomer">
                                    <option value="Customer Harian">Pilih Customer</option>
                                    <?php
                                    include '../models/ClassCustomer.php';
                                    $c = new Customer;
                                    $data = $c->tampilCustomer();
                                    foreach($data as $c):
                                    ?>
                                        <option value="<?= $c['customerNama'];?>"><?= $c['customerNama'];?></option>
                                    <?php endforeach; ?>
                                    </select>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="carabayar" id="Tunai" value="Tunai" checked>
                                        <label class="form-check-label" for="Tunai">Tunai</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="carabayar" id="Kredit" value="Kredit">
                                        <label class="form-check-label" for="Kredit">Kredit</label>
                                    </div>
                                    <div id="jatuhtempo" style="display: none">
                                        <div class="form-group">
                                            <label for="jatuhtempo">Jatuh Tempo</label>
                                            <input type="date" class="form-control" id="jatuhtempo" name="jatuhtempo">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlahbelanja">Jumlah Belanja</label>
                                        <input type="number" class="form-control" id="jumlahbelanja" name="jumlahbelanja" readonly value="<?= $totalbayar?>">
                                    </div>
                                    <div class="row" id="uang">   
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="uangbayar">yang dibayar</label>
                                                <input type="number" class="form-control" id="uangbayar" name="uangbayar">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="uangkembalian">Kembalian</label>
                                                <input type="number" class="form-control" id="uangkembalian" name="uangkembalian" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="karyawan" value="<?= ucwords($nama) ?>"/>
                                    <input type="hidden" name="idfaktur" value="<?= $idfaktur ?>"/>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success" name="tambahpenjualan">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
            document.getElementById("hargabeli").value = data[1];
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

function handleSubmitBarang() {
    var id = document.getElementById("idfaktur").value;
    var nama = document.getElementById("namabarang").value;
    var jumlah = document.getElementById("jumlahjual").value;
    var harga = document.getElementById("hargajual").value;
    var diskon = document.getElementById("diskonjual").value;
    var stok = document.getElementById("stokjual").value;
    var kodebarang = document.getElementById("kodebarang").value;
    var hargabeli = document.getElementById("hargabeli").value;

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
        data:"aksi=tambahItem&id="+id+"&kodebarang="+kodebarang+"&nama="+nama+"&jumlah="+jumlah+"&harga="+harga+"&diskon="+diskon+"&stok="+stok+"&hargabeli="+hargabeli,
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
    var kodejasa = document.getElementById("kodejasa").value;

    if(nama == '') {
        alert('nama kosong');
        exit();
    }
    $.ajax({
        url:"../controllers/Penjualanolah.php",
        data:"aksi=tambahJasa&id="+id+"&kodejasa="+kodejasa+"&nama="+nama+"&jumlah="+jumlah+"&harga="+harga,
        cache:false,
        success:function(msg){
            alert(msg);
            window.location.reload();
        }
    });
}

function handleDelete(idsale) {
    $.ajax({
        url:"../controllers/Penjualanolah.php",
        data:"aksi=hapusItem&idsale="+idsale,
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
<script>
$(function() {
    $("input[name='carabayar']").click(function() {
        if ($("#Kredit").is(":checked")) {
        $("#jatuhtempo").show();
        $("#uang").hide();
        } else {
        $("#jatuhtempo").hide();
        $("#uang").show();
        }
    });
});

$('#uangbayar').keyup(function(){
        var uangbayar=parseInt($('#uangbayar').val());
        var jumlahbelanja=parseInt($('#jumlahbelanja').val());
        var hasil=uangbayar-jumlahbelanja;
        $('#uangkembalian').attr('value',hasil);
});
</script>