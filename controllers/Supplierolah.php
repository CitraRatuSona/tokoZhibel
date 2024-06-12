<?php
include '../models/ClassSupplier.php';

    if(isset($_POST['ubahsupplierid'])){
        $id = $_POST['idsupplier'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $telp = $_POST['telp'];
        $update = new Supplier;
        $update->editSupplier($id, $nama, $alamat, $telp);
        header('location:../views/supplierlist.php');  
    } 

    if(isset($_POST['tambahsupplier'])){
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $telp = $_POST['telp'];
        $insert = new Supplier();
        $insert->tambahSupplier($nama,$alamat,$telp);
        header("location:../views/supplierlist.php");
    }

    if(isset($_GET['hapussupplierid'])){
        $id = $_GET["hapussupplierid"];
        $delete = new Supplier();
        $delete->hapusSupplier($id);
        header("location:../views/supplierlist.php");
    }


