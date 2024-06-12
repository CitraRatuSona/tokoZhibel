<?php
include '../models/ClassJasa.php';
include '../config/koneksi.php';

    if(isset($_POST['ubahjasaid'])){
        $id = $_POST['idjasa'];
        $nama = $_POST['namajasa'];
        $hargajual = $_POST['hargajual'];
        $update = new Jasa;
        $update->editJasa($id,$nama,$hargajual);
        header('location:../views/jasalist.php');  
    } 

    if(isset($_POST['tambahjasa'])){
        $data = mysqli_query($con,"SELECT * FROM jasa ORDER BY jasaId DESC LIMIT 0,1");
        $i = mysqli_fetch_assoc($data);
        // ID OTOMATIS//***************************************************
        $kodeawal = substr($i['jasaKode'], 2, 10) + 1;
        if ($kodeawal < 10) {
            $kode = 'S-000' . $kodeawal;
        } elseif ($kodeawal > 9 && $kodeawal <= 99) {
            $kode = 'S-00' . $kodeawal;
        } else {
            $kode = 'S-0' . $kodeawal;
        }
        $idjasa = $i['jasaId'] + 1;

        $nama = $_POST['namajasa'];
        $nb = mysqli_query($con,"SELECT * FROM jasa WHERE jasaNama = '$nama'");
        $hnb = mysqli_num_rows($nb);
        if($hnb > 0){
            echo "<script>
            alert('Jasa sudah ada di DB!');
            document.location.href='../views/jasalist.php';
            </script>"; 
            exit;
        }
        $hargajual = $_POST['hargajual'];
        $insert = new Jasa();
        $insert->tambahJasa($idjasa,$kode,$nama,$hargajual);
        header("location:../views/jasalist.php");
    }

    if(isset($_GET['hapusjasaid'])){
        $id = $_GET["hapusjasaid"];
        $delete = new Jasa();
        $delete->hapusJasa($id);
        header("location:../views/jasalist.php");
    }


