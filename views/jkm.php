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
                      <th colspan="2" style="font-size: 13px"><center>Debit</center></th>
                      <th colspan="3" style="font-size: 13px"><center>Kredit</center></th>
                        <tr>
                          <th style="font-size: 13px;text-align: center;">Kas</th>
                          <th style="font-size: 13px;text-align: center;">Potongan Penjualan</th>
                          <!-- <th style="font-size: 13px;text-align: center;">HPP</th> -->
                          
                          <th style="font-size: 13px;text-align: center;">Penjualan</th>
                          <th style="font-size: 13px;text-align: center;">Pendapatan Jasa</th>
                          <th style="font-size: 13px;text-align: center;">Piutang Usaha</th>
                          <!-- <th style="font-size: 13px;text-align: center;">Persediaan</th> -->
                        </tr>
                    </tr>
                </thead>
                 <?php
                  $sql = "SELECT * from jurnalkm where DATE_FORMAT(jurnalkmTanggal,'%m')='$bulan' and DATE_FORMAT(jurnalkmTanggal,'%Y')='$tahun'";
                  $hasil = $con->query($sql);
                  if ($hasil->num_rows > 0) { 
                ?>
                <tbody>                
                  <?php
                    include "../models/ClassJurnal.php";
                    $p=new Jurnal;
                    $data=$p->tampilJurnalPenerimaanKas($bulan,$tahun);
                    foreach ($data as $d) {
                  ?>
                  <tr class="odd gradeX">
                    <td style="font-size: 13px"><?= date("d-M-Y", strtotime($d['jurnalkmTanggal'])); ?></td>
                    <td style="font-size: 13px">J-<?= $d['penjualanId'];?></td>
                    <td style="font-size: 13px"><?= $d['jurnalkmKeterangan'];?></td>
                    <td style="font-size: 13px"><?= "Rp. ".number_format( $d['debitKas'],0,',','.') ?></td>
                    <td style="font-size: 13px"><?= "Rp. ".number_format( $d['debitDiskon'],0,',','.') ?></td>
                    <td style="font-size: 13px"><?= "Rp. ".number_format( $d['kreditPenjualan'],0,',','.') ?></td>
                    <td style="font-size: 13px"><?= "Rp. ".number_format( $d['kreditPendapatanjasa'],0,',','.') ?></td>
                    <td style="font-size: 13px"><?= "Rp. ".number_format( $d['kreditPiutangusaha'],0,',','.') ?></td>
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