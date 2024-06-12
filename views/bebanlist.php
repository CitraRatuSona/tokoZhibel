<?php
include 'header.php';
?>
<div class="container-fluid">
<div class="row">
    <div class="col-md-12 text-right">
    <button type="button" class="btn btn-primary my-1" data-toggle="modal" data-target="#addbeban"><i class="fas fa-plus"></i> Beban</button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addbeban" tabindex="-1" role="dialog" aria-labelledby="addbebanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addbebanLabel">Tambah Beban</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../controllers/Bebanolah.php" method="POST">
                <div class="form-group">
                    <label for="tanggalbeban">Tanggal Beban</label>
                    <input type="date" class="form-control" id="tanggalbeban" name="tanggalbeban" value="<?= date('Y-m-d'); ?>">
                </div>
                <div class="form-group">
                    <label for="serbaserbi">Serba Serbi</label>
                    <select class="form-control" name="serbaserbi" onchange={handleChangeBeban(this.value)}>
                        <option value="" disable>Pilih Serba Serbi</option>
                        <option value="Beban Gaji">Beban Gaji</option>
                        <option value="Beban Listrik">Beban Listrik</option>
                        <option value="Beban Penyusutan Peralatan Toko">Beban Penyusutan Peralatan Toko</option>
                        <option value="Beban Sewa">Beban Sewa</option>
                        <option value="Prive">Prive</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nominalbeban">Nominal Beban</label>
                    <input type="number" class="form-control" id="nominalbeban" name="nominalbeban">
                </div>
                <div class="form-group">
                    <label for="keteranganbeban">Keterangan Beban</label>
                    <input type="text" class="form-control" id="keteranganbeban" name="keteranganbeban">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success" name="tambahbeban">Simpan</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>

    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>Data Beban</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Beban</th>
                                <th>Tanggal Beban</th>
                                <th>Serba Serbi</th>
                                <th>Nominal</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            include '../models/ClassBeban.php';
                            $p = new Beban;
                            $data = $p->tampilBeban();
                            $i = 1;
                            foreach($data as $b){
                            ?>
                            <tr>
                                <td><?= $i++?></td>
                                <td><?= "BB-".$b['bebanKode'];?></td>
                                <td><?= date("d-M-Y", strtotime($b['bebanTanggal'])); ?></td>
                                <td><?= $b['bebanSerba'];?></td>
                                <td><?= "Rp. ".number_format( $b['bebanNominal'],0,',','.') ?></td>
                                <td><?= $b['bebanKeterangan'];?></td>
                                <td>
                                <a class="btn btn-primary" href="formbebanedit.php?ubahbebanid=<?= $b['bebanId']?>" role="button"><i class="fas fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                                <a class="btn btn-danger" href="../controllers/bebanolah.php?hapusbebanid=<?= $b['bebanId']?>&bebankode=<?= $b['bebanKode']?>" role="button"><i class="fas fa-trash-alt" data-toggle="tooltip" title="Hapus" onclick="return confirm('Apakah yakin untuk menghapus Beban?');"></i></a>
                                </td>
                            </tr>          
                            <?php } ?>                  
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</div>
<script>
function handleChangeBeban(val) {
    
    var tanggal = document.getElementById("tanggalbeban").value;
    // document.getElementById("total").innerHTML = val;
    $.ajax({
        url:"../controllers/Bebanolah.php",
        data:"serbaserbi="+val+"&tanggal="+tanggal,
        cache:false,
        success:function(msg){
            data=msg.split("|");
            
            //masukan isi data ke masing - masing field
            document.getElementById("nominalbeban").value = data[0];
        }
    });
}
</script>

<?php
include 'footer.php';
?>