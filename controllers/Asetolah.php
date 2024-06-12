<?php
include '../models/ClassAset.php';

    if(isset($_POST['ubahasetid'])){
        $id = $_POST['idaset'];
        $nama = $_POST['namaaset'];
        $tanggal = $_POST['tanggalaset'];
        $jumlah = $_POST['jumlahaset'];
        $harga = $_POST['hargaaset'];
        $masa = $_POST['masamanfaat'];
        $update = new Aset;
        $update->editAset($id,$nama,$tanggal,$jumlah,$harga,$masa);
        header('location:../views/asetlist.php');  
    } 

    if(isset($_POST['tambahaset'])){
        $nama = $_POST['namaaset'];
        $tanggal = $_POST['tanggalaset'];
        $jumlah = $_POST['jumlahaset'];
        $harga = $_POST['hargaaset'];
        $masa = $_POST['masamanfaat'];
        if($masa == '4'){
            $perbulan = ($harga * $jumlah) / 48;
        }else if($masa == '8'){
            $perbulan = ($harga * $jumlah) / 96;
        }
        $insert = new Aset();
        $insert->tambahAset($nama,$tanggal,$jumlah,$harga,$masa);
        header("location:../views/asetlist.php");
    }

    if(isset($_GET['hapusasetid'])){
        $id = $_GET["hapusasetid"];
        $delete = new Aset();
        $delete->hapusAset($id);
        header("location:../views/asetlist.php");
    }


