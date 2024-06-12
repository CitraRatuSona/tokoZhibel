<?php
include "../models/ClassUser.php";

    if(isset($_POST['login'])){
        $username=$_POST['username'];
        $password=$_POST['password'];	

        $checking = new User();
        $checking->login($username,$password);
        header("location:../views/home.php");
    }

    if(isset($_GET['logout'])){
        $logout = new User();
        $logout->logout();
        header("location:../views/login.php");
    }

    if(isset($_POST['tambahuser'])){
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $password = $_POST['password'];	
        $status = $_POST['status'];
        $insert = new User();
        $insert->tambahUser($nama,$username,$password,$status);
        if($status == "Karyawan"){
        header("location:../views/userlist.php");
        }
    }

    if(isset($_GET['hapususerid'])){
        $id = $_GET["hapususerid"];
        $delete = new User();
        $delete->hapusUser($id);
        header("location:../views/userlist.php");
    }

    if(isset($_POST["ubahpassword"])){
        $id = $_POST["iduser"];
        $lama = $_POST["passwordlama"];
        $baru = $_POST["passwordbaru"];
        $konfirmasi = $_POST["konfirmasipassword"];

        $ubah = new User();
        $ubah->ubahPassword($id,$lama,$baru,$konfirmasi);
        echo "<script>
		alert('Password berhasil diubah!');
		document.location.href='../views/home.php';
		</script>"; 
    }
