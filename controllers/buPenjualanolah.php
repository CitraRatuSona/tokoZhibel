<?php
include '../models/ClassPenjualan.php';
include '../config/koneksi.php';

$namabarang = $_GET['namabarang'];
$namajasa = $_GET['namajasa'];
$aksi = $_GET['aksi'];

    if(!empty($namabarang)) {
        $query = mysqli_query($con,"SELECT * FROM barang WHERE barangNama = '$namabarang'");
        $d=mysqli_fetch_array($query);
        echo $d['barangNama']."|".$d['barangHargabeli']."|".$d['hargaJual']."|".$d['barangStok']."|".$d['barangId'];
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
        $total = $jumlah * $harga;
        $afterdisc = $total - $diskon;

        $insert = new Penjualan();
        $hasil = $insert->sale($id,$kodebarang,$nama,$harga,$stok,$diskon,$total,$afterdisc);
        // $hasil = $insert->tambahdetailPenjualan($id, $kodebarang, $nama, $jumlah, $harga, $diskon, $stok, $afterdisc);
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
        $hasil = $insert->tambahdetailPenjualanJasa($id, $kodejasa, $nama, $jumlah, $harga, $total);
        echo $hasil;

        // $cek = mysqli_query($con,"SELECT penjualanCara FROM penjualan WHERE penjualanId = '$id'");
        // $cekk = mysqli_fetch_assoc($cek);
        // $status = $cekk['penjualanCara'];

        // $cekdetailjual = mysqli_query($con,"SELECT djasaId FROM detailpenjualanjasa ORDER BY djasaId DESC LIMIT 1");
        // $row = mysqli_fetch_assoc($cekdetailjual);
        // $djasaId = $row['djasaId'];
        // $tgl = mysqli_query($con,"SELECT penjualanTanggal FROM penjualan WHERE penjualanId = '$id'");
        // $t = mysqli_fetch_assoc($tgl);
        // $tanggal = $t['penjualanTanggal'];
        // $keterangan = "Penjualan Tunai J-".$id;

        // if($status == "Tunai"){
        // $jkm = new Penjualan();
        // $jkm->insertJKMJasa($tanggal, $keterangan, $id, $total, $djasaId);
        // }else if($status == "Kredit"){
        //     $penj = new Penjualan();
        //     $penj->insertJurnalPenjJasa($tanggal, $keterangan, $id, $total, $djasaId);
        // }
        
    }

    if($aksi == 'hapusItem') {
        $iditem = $_GET['iditem'];
        $kodebarang = $_GET['kodebarang'];
        $hapus = new Penjualan();
        $hasil = $hapus->hapusItemJual($iditem, $kodebarang);
        echo $hasil;
    }

    if($aksi == 'hapusJasa') {
        $iditem = $_GET['iditem'];
        $kodejasa = $_GET['kodejasa'];
        $hapus = new Penjualan();
        $hasil = $hapus->hapusJasaJual($iditem, $kodejasa);
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
        $data = mysqli_query($con,"SELECT * FROM penjualan ORDER BY penjualanId DESC LIMIT 0,1");
        $i = mysqli_fetch_assoc($data);
        // ID OTOMATIS//***************************************************
        $kodeawal1 = $i['penjualanId'];
        $kodeawal = (int)$kodeawal1 + 1;
        $idfaktur = $kodeawal;

        $karyawan = $_POST['karyawan'];
        $customer = $_POST['namacustomer'];
        $tanggaljual = $_POST['tanggaljual'];
        $carabayar = $_POST['carabayar'];
        if ($carabayar == "Tunai"){
            $jatuhtempo = $tanggaljual;
        } else{
            $jatuhtempo = $_POST['jatuhtempo'];
        }
        $keterangan = $_POST['keterangan'];
        if($carabayar == "Kredit"){
            $status = "Belum Bayar";
        }else if($carabayar == "Tunai"){
            $status = "Sukses";
        }
        $insert = new Penjualan();
        $insert->tambahPenjualan($idfaktur,$karyawan,$customer,$tanggaljual,$jatuhtempo,$carabayar,$keterangan,$status);


        // $cekdetailjual = mysqli_query($con,"SELECT dpenjualanId FROM detailpenjualan ORDER BY dpenjualanId DESC LIMIT 1");
        // $row = mysqli_fetch_assoc($cekdetailjual);
        // $dpenjualanId = $row['dpenjualanId'];
        // $b = mysqli_query($con,"SELECT hargaBeli FROM barang WHERE barangNama = '$nama'");
        // $barang = mysqli_fetch_assoc($b);
        // $hpp = $barang['hargaBeli'] * $jumlah;
        // $tgl = mysqli_query($con,"SELECT penjualanTanggal FROM penjualan WHERE penjualanId = '$id'");
        // $t = mysqli_fetch_assoc($tgl);
        // $tanggal = $t['penjualanTanggal'];
        // $keterangan = "Penjualan Tunai J-".$id;

        // if($carabayar == "Tunai"){
        //     $jkm = new Penjualan();
        //     $jkm->insertJKMBarang($tanggal, $keterangan, $id, $afterdisc, $diskon, $hpp, $total, $dpenjualanId);
        // }else if($carabayar == "Kredit"){
        //     $penb = new Penjualan();
        //     $penb->insertJurnalPenjBarang($tanggal, $keterangan, $id, $afterdisc, $diskon, $hpp, $total, $dpenjualanId);
        // }

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
        $update = new Penjualan();
        $update->prosesPiutang($idfaktur);
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


