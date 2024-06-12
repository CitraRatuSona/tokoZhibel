<?php
include '../models/ClassPembelian.php';
include '../config/koneksi.php';

$namabarang = $_GET['namabarang'];
$aksi = $_GET['aksi'];
    if(!empty($namabarang)) {
        $query = mysqli_query($con,"SELECT * FROM barang WHERE barangNama = '$namabarang'");
        $d=mysqli_fetch_array($query);
        echo $d['barangNama']."|".$d['barangHargabeli']."|".$d['hargaBeli']."|".$d['barangStok']."|".$d['barangId'];
    }

    if($aksi == 'tambahItem') {
        $id = $_GET['id'];
        $kodebarang = $_GET['kodebarang'];
        $nama = $_GET['nama'];
        $jumlah = $_GET['jumlah'];
        $harga = $_GET['harga'];
        $total = $jumlah * $harga;

        $insert = new Pembelian();
        $hasil = $insert->buyBarang($id, $kodebarang, $nama, $jumlah, $harga, $total);
        echo $hasil;
    }

    if($aksi == 'hapusItem') {
        $iditem = $_GET['iditem'];
        $kodebarang = $_GET['kodebarang'];
        $hapus = new Pembelian();
        $hasil = $hapus->hapusItemBeli($iditem, $kodebarang);
        echo $hasil;
    }

    if(isset($_POST['ubahpembelianid'])){
        $id = $_POST['idpembelian'];
        $tanggalebli = $_POST['tanggalbeli'];
        $carabayar = $_POST['carabayar'];
        if ($carabayar == "Tunai"){
            $jatuhtempo = $tanggalebli;
        }else{
            $jatuhtempo = $_POST['jatuhtempo'];
        }
        $keterangan = $_POST['keterangan'];
        $update = new Pembelian;
        $update->editPembelian($id,$tanggalebli,$jatuhtempo,$carabayar,$keterangan);
        header('location:../views/pembelianlist.php');  
    } 

    if(isset($_POST['tambahpembelian'])){
        $idfaktur = $_POST['idfaktur'];
        $karyawan = $_POST['karyawan'];
        $supplier = $_POST['namasupplier'];
        $tanggalbeli = $_POST['tanggalbeli'];
        $carabayar = $_POST['carabayar'];
        if ($carabayar == "Tunai"){
            $status = "Sukses";
            $jatuhtempo = $tanggalbeli;
        } else if($carabayar == "Kredit"){
            $status = "Belum Bayar";
            $jatuhtempo = $_POST['jatuhtempo'];
        }

        $keterangan = $_POST['keterangan'];
        $insert = new Pembelian();
        $insert->tambahPembelian($idfaktur,$karyawan,$supplier,$tanggalbeli,$jatuhtempo,$carabayar,$keterangan,$status);
        $insert->tambahdetailPembelian($idfaktur,$tanggalbeli,$carabayar);
        header("location:../views/pembelianlist.php");
    }

    if(isset($_GET['hapuspembelianid'])){
        $id = $_GET["hapuspembelianid"];
        $q = mysqli_query($con,"SELECT * FROM detailpembelian WHERE pembelianId ='$id'");
        $item = mysqli_num_rows($q);
        if($item>0){
            echo "<script>
            window.alert('Kosongkan keranjang belanja dari faktur tersebut');
            document.location.href='../views/pembelianlist.php';
            </script>";
        }else{
            $delete = new Pembelian();
            $delete->hapusPembelian($id);
            header("location:../views/pembelianlist.php");
        }
        
    }

    if(isset($_POST['updatebeli'])) {
        $idfaktur = $_POST['idfaktur'];
        $update = new Pembelian();
        $update->prosesPembelian($idfaktur);
        header('location:../views/pembelianlist.php');
    }

    if(isset($_POST['updatehutang'])) {
        $idfaktur = $_POST['idfaktur'];
        $tanggalbayar = $_POST['tanggalbayar'];
        $query = mysqli_query($con,"SELECT * FROM jurnalpemb WHERE pembelianId = '$idfaktur'");
        $ambil = mysqli_fetch_assoc($query);
        $total = $ambil['kreditUtangusaha'];
        $update = new Pembelian();
        $update->prosesHutang($idfaktur,$tanggalbayar,$total);
        header('location:../views/pembelianlist.php');


    }

    if(isset($_POST['returpembelian'])){
        $idfaktur = $_POST['idfaktur'];
        $idbarang = $_POST['idbarang'];
        $namabarang = $_POST['namabarang'];
        $jumlahretur = $_POST['jumlahretur'];
        $hargabeli = $_POST['hargabeli'];
        $tanggalretur = $_POST['tanggalretur'];
        $hargatotal = $hargabeli * $jumlahretur;
        $retur = new Pembelian();
        $retur->returPembelian($idfaktur,$idbarang,$namabarang,$jumlahretur,$hargabeli,$hargatotal,$tanggalretur);

        $cek = mysqli_query($con,"SELECT pembelianCara FROM pembelian WHERE pembelianId = '$idfaktur'");
        $cekk = mysqli_fetch_assoc($cek);
        $status = $cekk['pembelianCara'];

        $cekdetailbeli = mysqli_query($con,"SELECT dpembelianId FROM detailpembelian ORDER BY dpembelianId DESC LIMIT 1");
        $row = mysqli_fetch_assoc($cekdetailbeli);
        $iddetail = $row['dpembelianId'];
        $tgl = mysqli_query($con,"SELECT pembelianTanggal FROM pembelian WHERE pembelianId = '$idfaktur'");
        $t = mysqli_fetch_assoc($tgl);
        $tanggal = $t['pembelianTanggal'];
        $keterangan = "Retur Pembelian";
        if($status == "Tunai"){
            $jurumt = new Pembelian();
            $jurumt->jurnalUmumReturTunai($tanggal,$idfaktur,$hargatotal,$iddetail);
        }else if($status == "Kredit"){
            $jurumk = new Pembelian();
            $jurumk->jurnalUmumReturKredit($tanggal,$idfaktur,$hargatotal,$iddetail);
        }
        

        header("location:../views/pembelianhasil.php?idfaktur=".$idfaktur);
    }

    if(isset($_POST['hapusretur'])){
        $iditem = $_POST['iditem'];
        $idfaktur = $_POST['idfaktur'];
        $retur = new Pembelian();
        $retur->hapusRetur($iditem);
        header("location:../views/pembelianhasil.php?idfaktur=".$idfaktur);
    }



