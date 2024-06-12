<?php
include '../config/koneksi.php';

$namabarang = $_GET['namabarang'];

$query = mysqli_query($con,"SELECT * FROM barang WHERE barangNama = '$namabarang'");
$d=mysqli_fetch_array($query);
echo $d['barangNama']."|".$d['barangHargabeli']."|".$d['hargaJual']."|".$d['barangStok'];
?>