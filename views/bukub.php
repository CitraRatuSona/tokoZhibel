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
                        <th rowspan="2" colspan="3" style="font-size: 13px"><center>Debit</center></th>
                        <th rowspan="2" colspan="3" style="font-size: 13px"><center>Kredit</center></th>
					    <th colspan="2" style="font-size: 13px"><center>Saldo</center></th>
                        <tr>
					        <th style="font-size: 13px"><center>Debit</center></th>
					        <th style="font-size: 13px"><center>Kredit</center></th>
                        </tr>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                  <td colspan="5" style="text-align:center">Saldo Awal</td> 
				          <td colspan="2" style="font-size: 13px">
                  </tr>
                  <?php
                    include "../models/ClassJurnal.php";
                    $p=new Jurnal;
                    $data=$p->tampilBukubesar($bulan,$tahun);
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
             </table>
              </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->