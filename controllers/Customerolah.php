<?php
include '../models/ClassCustomer.php';

    if(isset($_POST['ubahcustomerid'])){
        $id = $_POST['idcustomer'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $telp = $_POST['telp'];
        $update = new Customer;
        $update->editCustomer($id, $nama, $alamat, $telp);
        header('location:../views/customerlist.php');  
    } 

    if(isset($_POST['tambahcustomer'])){
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $telp = $_POST['telp'];
        $insert = new Customer();
        $insert->tambahCustomer($nama,$alamat,$telp);
        header("location:../views/customerlist.php");
    }

    if(isset($_GET['hapuscustomerid'])){
        $id = $_GET["hapuscustomerid"];
        $delete = new Customer();
        $delete->hapusCustomer($id);
        header("location:../views/customerlist.php");
    }


