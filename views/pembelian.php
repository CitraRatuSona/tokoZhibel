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
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                include '../models/ClassPembelian.php';
                $d = new Pembelian;
                $data = $d->tampilBuy($idfaktur);
                $i = 1;
                foreach($data as $d):
                ?>
                    <tr>
                    <td><?= $i++?></td>
                    <td><?=$d['buyNama'];?></td>
                    <td><?=$d['buyJumlah'];?></td>
                    <td><?= "Rp.".number_format( $d['buyHarga'],0,',','.') ?></td>
                    <td>
                    <button class="btn btn-danger" onClick={handleDelete(<?= $d["buyId"]; ?>)}><i class="fas fa-trash-alt" data-toggle="tooltip" title="Hapus"></i></button>
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
                    $b = mysqli_query($con,"SELECT *, SUM(buyTotal) AS TotalHarga FROM buy WHERE pembelianId = '$idfaktur'");
                    $bb = mysqli_fetch_assoc($b);
                    $totalharga = $bb['TotalHarga'];

                    ?>
                        <h4 class="card-title">Total Belanja <?= "Rp. ".number_format( $totalharga,0,',','.') ?></h4>
                        <button type="button" class="btn btn-primary my-1" data-toggle="modal" data-target="#addpembelian"><i class="fas fa-plus"></i> Proses</button>
                        <!-- Modal -->
                        <div class="modal fade" id="addpembelian" tabindex="-1" role="dialog" aria-labelledby="addpembelianLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addpembelianLabel">Form Tambah Pembelian</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="../controllers/Pembelianolah.php" method="POST">
                                        <div class="form-group">
                                            <!-- <label for="tanggaljual">Tanggal Pembelian</label> -->
                                            <input type="hidden" class="form-control" id="tanggalbeli" name="tanggalbeli" value="<?= date('Y-m-d'); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <input type="text" class="form-control" id="keterangan" name="keterangan" value="-">
                                        </div>
                                        <div class="form-group">
                                        <label for="namasupplier">Dibeli dari</label>
                                        <select class="form-control" id="namasupplier" name="namasupplier">
                                        <option value="Customer Harian">Pilih Supplier</option>
                                        <?php
                                        include '../models/ClassSupplier.php';
                                        $c = new Supplier;
                                        $data = $c->tampilSupplier();
                                        foreach($data as $c):
                                        ?>
                                            <option value="<?= $c['supplierNama'];?>"><?= $c['supplierNama'];?></option>
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
                                            <input type="number" class="form-control" id="jumlahbelanja" name="jumlahbelanja" readonly value="<?= $totalharga?>">
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
                                        <input type="hidden" name="idfaktur" value="<?= $idfaktur ?>"/>
                                        <input type="hidden" name="karyawan" value="<?= ucwords($nama) ?>"/>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success" name="tambahpembelian">Simpan</button>
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
        data:"aksi=tambahItem&id="+id+"&kodebarang="+kodebarang+"&nama="+nama+"&jumlah="+jumlah+"&harga="+harga,
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