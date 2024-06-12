<?php
include '../models/ClassAkun.php';

    if(isset($_POST['ubahakunid'])){
        $idakun = $_POST['idakun'];
        $namaakun = $_POST['namaakun'];
        $jenisakun = $_POST['jenisakun'];
        $saldonormal = $_POST['saldonormal'];
        $saldoawal = $_POST['saldoawal'];
        $update = new Akun;
        $update->editAkun($idakun,$namaakun,$jenisakun,$saldonormal,$saldoawal);
        header('location:../views/akunlist.php');  
    } 

    if(isset($_POST['tambahakun'])){
        $idakun = $_POST['idakun'];
        $namaakun = $_POST['namaakun'];
        $jenisakun = $_POST['jenisakun'];
        $saldonormal = $_POST['saldonormal'];
        $saldoawal = $_POST['saldoawal'];
        $insert = new Akun();
        $insert->tambahAkun($idakun,$namaakun,$jenisakun,$saldonormal,$saldoawal);
        header("location:../views/akunlist.php");
    }

    if(isset($_GET['hapusakunid'])){
        $idakun = $_GET["hapusakunid"];
        $delete = new Akun();
        $delete->hapusAkun($idakun);
        header("location:../views/akunlist.php");
    }

    
