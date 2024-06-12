<?php
include '../models/ClassPenjualan.php';
include '../config/koneksi.php';

$namabarang = $_GET['namabarang'];
$namajasa = $_GET['namajasa'];
$aksi = $_GET['aksi'];

    if(!empty($namabarang)) {
        $query = mysqli_query($con,"SELECT * FROM barang WHERE barangNama = '$namabarang'");
        $d=mysqli_fetch_array($query);
        echo $d['barangNama']."|".$d['hargaBeli']."|".$d['hargaJual']."|".$d['barangStok']."|".$d['barangId'];
    }

    if(!empty($namajasa)) {
        $query = mysqli_query($con,"SELECT * FROM jasa WHERE jasaNama = '$namajasa'");
        $j=mysqli_fetch_array($query);
        echo $j['jasaHarga']."|".$j['jasaId'];
    }

    if($aksi == 'tambahItem') {
        $id = $_GET['id'];
        $kodebarang = $_GET['kodebarang'];
        $nama = $_GET['nama'];
        $jumlah = $_GET['jumlah'];
        $harga = $_GET['harga'];
        $stok = $_GET['stok'];
        $diskon = $_GET['diskon'];
        $hargabeli = $_GET['hargabeli'];
        $hpp = $hargabeli * $jumlah;
        $total = $jumlah * $harga;
        $afterdisc = $total - $diskon;

        $insert = new Penjualan();
        $hasil = $insert->saleBarang($id,$kodebarang,$nama,$jumlah,$harga,$diskon,$afterdisc,$stok,$hpp);
        echo $hasil;
    }

    if($aksi == 'tambahJasa') {
        $id = $_GET['id'];
        $kodejasa = $_GET['kodejasa'];
        $nama = $_GET['nama'];
        $jumlah = $_GET['jumlah'];
        $harga = $_GET['harga'];
        $total = ($jumlah * $harga);

        $insert = new Penjualan();
        $hasil = $insert->saleJasa($id,$kodejasa,$nama,$jumlah,$harga,$total);
        echo $hasil;
    }

    if($aksi == 'hapusItem') {
        $idsale = $_GET['idsale'];
        $hapus = new Penjualan();
        $hasil = $hapus->hapusItemJual($idsale);
        echo $hasil;
    }

    if(isset($_POST['ubahpenjualanid'])){
        $id = $_POST['idpenjualan'];
        $tanggaljual = $_POST['tanggaljual'];
        $carabayar = $_POST['carabayar'];
        if ($carabayar == "Tunai"){
            $jatuhtempo = $tanggaljual;
        }else{
            $jatuhtempo = $_POST['jatuhtempo'];
        }
        $keterangan = $_POST['keterangan'];
        $update = new Penjualan;
        $update->editPenjualan($id,$tanggaljual,$jatuhtempo,$carabayar,$keterangan);
        header('location:../views/penjualanlist.php');  
    } 

    if(isset($_POST['tambahpenjualan'])){
        $idfaktur = $_POST['idfaktur'];

        $karyawan = $_POST['karyawan'];
        $customer = $_POST['namacustomer'];
        $tanggaljual = $_POST['tanggaljual'];
        $carabayar = $_POST['carabayar'];
        if ($carabayar == "Tunai"){
            $status = "Sukses";
            $jatuhtempo = $tanggaljual;
        } else if($carabayar == "Kredit"){
            $status = "Belum Bayar";
            $jatuhtempo = $_POST['jatuhtempo'];
        }
        $keterangan = $_POST['keterangan'];

        $insert = new Penjualan();
        $insert->tambahPenjualan($idfaktur,$karyawan,$customer,$tanggaljual,$jatuhtempo,$carabayar,$keterangan,$status);
        $insert->tambahdetailPenjualan($idfaktur,$tanggaljual,$carabayar);
        header("location:../views/penjualanlist.php");
    }

    if(isset($_GET['hapuspenjualanid'])){
        $id = $_GET["hapuspenjualanid"];
        $q = mysqli_query($con,"SELECT * FROM detailpenjualan WHERE penjualanId ='$id' AND penjualanStatus = 'Waiting'");
        $item = mysqli_num_rows($q);
        if($item>0){
            echo "<script>
            window.alert('Kosongkan keranjang belanja dari faktur tersebut');
            document.location.href='../views/penjualanlist.php';
            </script>";
        }else{
            $delete = new Penjualan();
            $delete->hapusPenjualan($id);
            header("location:../views/penjualanlist.php");
        }
    }

    if(isset($_POST['updatejual'])) {
        $idfaktur = $_POST['idfaktur'];
        $update = new Penjualan();
        $update->prosesPenjualan($idfaktur);
        header('location:../views/penjualanlist.php');
    }

    if(isset($_POST['updatepiutang'])) {
        $idfaktur = $_POST['idfaktur'];
        $tanggalbayar = $_POST['tanggalbayar'];
        $query = mysqli_query($con,"SELECT *, SUM(debitPiutangusaha) AS PiutangUsaha FROM jurnalpenj WHERE penjualanId = '$idfaktur'");
        $ambil = mysqli_fetch_assoc($query);
        $total = $ambil['PiutangUsaha'];
        $update = new Penjualan();
        $update->prosesPiutang($idfaktur,$tanggalbayar,$total);
        header('location:../views/penjualanlist.php');
    }

    if(isset($_POST['returpenjualan'])){
        $idfaktur = $_POST['idfaktur'];
        $idbarang = $_POST['idbarang'];
        $namabarang = $_POST['namabarang'];
        $jumlahretur = $_POST['jumlahretur'];
        $hargabarang = $_POST['hargajual'];
        $tanggalretur = $_POST['tanggalretur'];
        $totalharga = $hargabarang * $jumlahretur;

        $cek = mysqli_query($con,"SELECT penjualanCara FROM penjualan WHERE penjualanId = '$idfaktur'");
        $cekk = mysqli_fetch_assoc($cek);
        $status = $cekk['penjualanCara'];

        $retur = new Penjualan();
        $retur->returPenjualan($idfaktur,$idbarang,$namabarang,$jumlahretur,$hargabarang,$tanggalretur,$totalharga);

        $b = mysqli_query($con,"SELECT hargaBeli FROM barang WHERE barangId = '$idbarang'");
        $ba = mysqli_fetch_assoc($b);
        $hpp = $ba['hargaBeli'] * $jumlahretur;

        $cekdetailjual = mysqli_query($con,"SELECT dpenjualanId FROM detailpenjualan ORDER BY dpenjualanId DESC LIMIT 1");
        $row = mysqli_fetch_assoc($cekdetailjual);
        $iddetail = $row['dpenjualanId'];
        $tgl = mysqli_query($con,"SELECT penjualanTanggal FROM penjualan WHERE penjualanId = '$idfaktur'");
        $t = mysqli_fetch_assoc($tgl);
        $tanggal = $t['penjualanTanggal'];
        $keterangan = "Retur Penjualan";

        if($status == "Tunai"){
            $jurumt = new Penjualan();
            $jurumt->jurnalUmumReturPenjualanTunai($tanggal,$idfaktur,$totalharga,$hpp,$iddetail);
        }else if($status == "Kredit"){
            $jurumk = new Penjualan();
            $jurumk->jurnalUmumReturPenjualanKredit($tanggal,$idfaktur,$totalharga,$hpp,$iddetail);
        }

        header("location:../views/penjualanhasil.php?idfaktur=".$idfaktur);
    }

    if(isset($_POST['hapusretur'])){
        $iditem = $_POST['iditem'];
        $idfaktur = $_POST['idfaktur'];
        $retur = new Penjualan();
        $retur->hapusRetur($iditem);
        header("location:../views/penjualanhasil.php?idfaktur=".$idfaktur);
    }


