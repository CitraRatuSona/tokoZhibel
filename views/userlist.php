    <?php
include 'header.php';
?>
<div class="container-fluid">
<div class="row">
    <div class="col-md-12 text-right">
    <button type="button" class="btn btn-primary my-1" data-toggle="modal" data-target="#adduser"><i class="fas fa-plus"></i> Karyawan</button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="adduserLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adduserLabel">Tambah Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../controllers/Userolah.php" method="POST">
                <div class="form-group">
                    <label for="nama">Nama User</label>
                    <input type="text" class="form-control" id="nama" name="nama">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <input type="hidden" name="status" value="Karyawan"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success" name="tambahuser">Simpan</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>

    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>Data User </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <?php
                    if($_SESSION['error']){
                        echo '<div class="alert alert-warning" role="alert">
                        A simple warning alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
                        </div>';
                        unset($_SESSION['error']);
                    }
                    ?>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            include '../models/ClassUser.php';
                            $p = new User;
                            $data = $p->tampilUser();
                            $i = 1;
                            foreach($data as $d){
                            ?>
                            <tr>
                                <td><?= $i++?></td>
                                <td><?= $d['userNama'];?></td>
                                <td><?= $d['userUsername'];?></td>
                                <td><?= $d['userStatus'];?></td>
                                <td>
                                <a class="btn btn-danger" href="../controllers/Userolah.php?hapususerid=<?= $d['userId']?>" role="button"><i class="fas fa-trash-alt" data-toggle="tooltip" title="Hapus" onclick="return confirm('Apakah yakin untuk menghapus Penjualan?');"></i></a>
                                </td>
                            </tr>          
                            <?php } ?>                  
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</div>


<?php
include 'footer.php';
?>