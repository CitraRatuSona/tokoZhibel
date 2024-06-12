<?php
include "../config/koneksi.php";
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
?>
<div class="row">
        <div class="col-md-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th rowspan="2" style="text-align: center; font-size: 13px;">Tanggal</th>
                      <th rowspan="2" style="text-align: center; font-size: 13px;">Keterangan</th>
                      <th rowspan="2" style="text-align: center; font-size: 13px;">Debit</th>
                      <th rowspan="2" style="text-align: center; font-size: 13px;">Kredit</th>
                      <th rowspan="2" style="text-align: center; font-size: 13px;">Kode</th>
                    </tr>
                </thead>
                 <?php  
                  $sql = "SELECT * from jurnalpenyesuaian WHERE DATE_FORMAT(jurnalpenyesuaianTanggal,'%m')='$bulan' and DATE_FORMAT(jurnalpenyesuaianTanggal,'%Y')='$tahun'";
                  $hasil = $con->query($sql);
                  if ($hasil->num_rows > 0) { 
                ?>
                <tbody>                
                  <?php
                    include "../models/ClassJurnal.php";
                    $p=new Jurnal;
                    $data=$p->tampilJurnalPenyesuaian($bulan,$tahun);
                    foreach ($data as $d) {
                  ?>
                  <tr class="odd gradeX">
                    <td style="font-size: 13px"><?= date("d-M-Y", strtotime($d['jurnalpenyesuaianTanggal'])); ?></td>
                    <td style="font-size: 13px"><?= $d['jurnalpenyesuaianKeterangan'];?></td>
                    <td style="font-size: 13px"><?= "Rp. ".number_format( $d['jurnalpenyesuaianDebit'],0,',','.') ?></td>
                    <td style="font-size: 13px"><?= "Rp. ".number_format( $d['jurnalpenyesuaianKredit'],0,',','.') ?></td>
                    <td style="font-size: 13px"><?= "BB-".$d['bebanKode'] ?></td>
                  </tr>
                  <?php
                  }
                  ?>
                </tbody>
                <?php
                  }
                ?>
             </table>
              </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->