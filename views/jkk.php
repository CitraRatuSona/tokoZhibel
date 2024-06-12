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
                      <th rowspan="2" style="text-align: center; font-size: 13px;">Faktur</th>
                      <th rowspan="2" style="text-align: center; font-size: 13px;">Keterangan</th>
                      <th colspan="3" style="font-size: 13px"><center>Debit</center></th>
                      <th colspan="2" style="font-size: 13px"><center>Kredit</center></th>
                        <tr>
                          <th style="font-size: 13px;text-align: center;">Persediaan</th>
                          <th style="font-size: 13px;text-align: center;">Utang Usaha</th>
                          <th style="font-size: 13px;text-align: center;">Serba Serbi</th>
                          <!-- <th style="font-size: 13px;text-align: center;">HPP</th> -->
                          
                          <th style="font-size: 13px;text-align: center;">Kas</th>
                          <th style="font-size: 13px;text-align: center;">Persediaan</th>
                          <!-- <th style="font-size: 13px;text-align: center;">Persediaan</th> -->
                        </tr>
                    </tr>
                </thead>
                 <?php
                  $sql = "SELECT * from jurnalkk where DATE_FORMAT(jurnalkkTanggal,'%m')='$bulan' and DATE_FORMAT(jurnalkkTanggal,'%Y')='$tahun'";
                  $hasil = $con->query($sql);
                  if ($hasil->num_rows > 0) { 
                ?>
                <tbody>                
                  <?php
                    include "../models/ClassJurnal.php";
                    $p=new Jurnal;
                    $data=$p->tampilJurnalPengeluaranKas($bulan,$tahun);
                    foreach ($data as $d) {
                  ?>
                  <tr class="odd gradeX">
                    <td style="font-size: 13px"><?= date("d-M-Y", strtotime($d['jurnalkkTanggal'])); ?></td>
                    <td style="font-size: 13px"><?= $d['jurnalkkFaktur'];?></td>
                    <td style="font-size: 13px"><?= $d['jurnalkkKeterangan'];?></td>
                    <td style="font-size: 13px"><?= "Rp. ".number_format( $d['debitPersediaan'],0,',','.') ?></td>
                    <td style="font-size: 13px"><?= "Rp. ".number_format( $d['debitUtangusaha'],0,',','.') ?></td>
                    <td style="font-size: 13px"><?= "Rp. ".number_format( $d['debitSerbaserbi'],0,',','.') ?></td>
                    <td style="font-size: 13px"><?= "Rp. ".number_format( $d['kreditKas'],0,',','.') ?></td>
                    <td style="font-size: 13px"><?= "Rp. ".number_format( $d['kreditPersediaan'],0,',','.') ?></td>
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