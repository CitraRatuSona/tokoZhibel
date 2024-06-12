<?php
include '../models/ClassBeban.php';
include '../config/koneksi.php';

    $serbaa = $_GET['serbaserbi'];

    if($serbaa == "Beban Penyusutan Peralatan Toko") {
        $tanggal = $_GET['tanggal'];
        $query = mysqli_query($con,"SELECT SUM(asetPenyBulan * TIMESTAMPDIFF(MONTH,asetTanggal,'$tanggal')) AS TotalPeny
        FROM aset 
        WHERE asetTanggal BETWEEN '2010-01-01' AND '$tanggal'");
        $d=mysqli_fetch_array($query);
        echo $d['TotalPeny'];
    }

    if(isset($_POST['ubahbebanid'])){
        $id = $_POST['idbeban'];
        $keterangan = $_POST['keteranganbeban'];
        $tanggal = $_POST['tanggalbeban'];
        $serba = $_POST['serbaserbi'];
        $nominal = $_POST['nominalbeban'];
        $update = new Beban;
        $update->editBeban($id,$keterangan,$tanggal,$serba,$nominal);
        header('location:../views/bebanlist.php');  
    } 

    if(isset($_POST['tambahbeban'])){
        $keterangan = $_POST['keteranganbeban'];
        $tanggal = $_POST['tanggalbeban'];
        $serba = $_POST['serbaserbi'];
        $nominal = $_POST['nominalbeban'];
        $data = mysqli_query($con,"SELECT * FROM beban ORDER BY bebanKode DESC LIMIT 0,1");
        $i = mysqli_fetch_array($data);
        // ID OTOMATIS//***************************************************
        $kodeawal1 = $i['bebanKode'];
        $kodeawal = (int)$kodeawal1 + 1;
        $kodebeban = $kodeawal;

        $insert = new Beban();
        $insert->tambahBeban($kodebeban,$tanggal,$serba,$nominal,$keterangan);

        $q = mysqli_query($con,"SELECT bebanSerba FROM beban WHERE bebanKode = '$kodebeban'");
        $qq = mysqli_fetch_assoc($q);
        $serba = $qq['bebanSerba'];

        if($serba == "Beban Gaji" OR $serba == "Beban Listrik" OR $serba == "Beban Sewa" OR $serba == "Prive"){
            $jkk = new Beban();
            $jkk->insertJKKBeban($tanggal, $serba, $kodebeban, $nominal);
        }else if($serba == "Beban Penyusutan Peralatan Toko"){
            $jpenyusut = new Beban();
            $jpenyusut->insertBebanPeny($tanggal,$nominal,$kodebeban);
        }
        header("location:../views/bebanlist.php");
    }

    if(isset($_GET['hapusbebanid'])){
        $id = $_GET["hapusbebanid"];
        $kode = $_GET["kodebeban"];
        $delete = new Beban();
        $delete->hapusBeban($id);
        header("location:../views/bebanlist.php");
    }


