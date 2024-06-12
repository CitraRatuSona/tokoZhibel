<?php
include '../models/ClassBarang.php';
include '../config/koneksi.php';

    $aksi = $_GET['aksi'];

    if(isset($_POST['ubahbarangid'])){
        $id = $_POST['idbarang'];
        $nama = $_POST['namabarang'];
        $stok = $_POST['stok'];
        $hargabeli = $_POST['hargabeli'];
        $hargajual = $_POST['hargajual'];
        $update = new Barang;
        $update->editBarang($id,$nama,$stok,$hargabeli,$hargajual);
        header('location:../views/baranglist.php');  
    } 

    if(isset($_POST['tambahbarang'])){
        $data = mysqli_query($con,"SELECT * FROM barang ORDER BY barangId DESC LIMIT 0,1");
        $i = mysqli_fetch_assoc($data);
        // ID OTOMATIS//***************************************************
        $kodeawal = substr($i['barangKode'], 2, 10) + 1;
        if ($kodeawal < 10) {
            $kode = 'I-000' . $kodeawal;
        } elseif ($kodeawal > 9 && $kodeawal <= 99) {
            $kode = 'I-00' . $kodeawal;
        } else {
            $kode = 'I-0' . $kodeawal;
        }
        $idbarang = $i['barangId'] + 1;

        $nama = $_POST['namabarang'];
        $nb = mysqli_query($con,"SELECT * FROM barang WHERE barangNama = '$nama'");
        $hnb = mysqli_num_rows($nb);
        if($hnb > 0){
            echo "<script>
            alert('Barang sudah ada di DB!');
            document.location.href='../views/baranglist.php';
            </script>"; 
            exit;
        }
        $hargabeli = $_POST['hargabeli'];
        $hargajual = $_POST['hargajual'];
        $insert = new Barang();
        $insert->tambahBarang($idbarang,$kode,$nama,$hargabeli,$hargajual);
        header("location:../views/baranglist.php");
    }

    if($aksi == "hapusBarang"){
        $id = $_GET['kodebarang'];
        $l = mysqli_query($con,"SELECT * FROM detailpenjualan dp, barang b WHERE dp.barangId = b.barangId AND b.barangId = '$id'");
        if($l->num_rows < 1){
            $delete = new Barang();
            $hasil = $delete->hapusBarang($id);
            echo $hasil;
        }
    }

    // if(isset($_GET['hapusbarangid'])){
    //     $id = $_GET["hapusbarangid"];
    //     $l = mysqli_query($con,"SELECT * FROM detailpenjualan dp, barang b WHERE dp.barangId = b.barangId AND b.barangId = '$id'");
    //     if($l->num_rows = 0){
    //         $delete = new Barang();
    //         $delete->hapusBarang($id);
    //         header("location:../views/baranglist.php");
    //     }else{
    //         echo "<script>
    //         alert('Barang tidak dapat dihapus!');
    //         document.location.href='../views/baranglist.php';
    //         </script>";
    //         exit;
    //     }
    // }


