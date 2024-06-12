<?php
class User{
    function __construct(){
        $con =mysqli_connect("localhost","root","","suryajaya");
        $this->con=$con;
    }
        
    function login($username, $password){

            $sql = mysqli_query($this->con,"SELECT * FROM user WHERE userUsername = '$username' AND userPassword=sha1('$password')");
            $cek = mysqli_num_rows($sql);
            if($cek>0){
                while($u = mysqli_fetch_assoc($sql)){
                    $id = $u['userId'];
                    $name = $u['userNama'];
                    $uname = $u['userUsername'];
                    $pass = $u['userPassword'];
                    $status = $u['userStatus'];
                }
                session_start();
                $_SESSION["id"] = $id;
                $_SESSION["nama"] = $name;
                $_SESSION["uname"] = $uname;
                $_SESSION["status"] = $status;
            }else{
                header("location:../views/login.php?gagal");
                exit;
            }
    }

    function logout(){
        session_start();
        session_destroy();
    }

    function tampilUser(){
        $query = mysqli_query($this->con,"SELECT * FROM user WHERE userStatus = 'Karyawan'");
        while($d = mysqli_fetch_assoc($query)){
            $data[] = $d;
        }
        return $data;
    }

    function tampilCustomer(){
        $query = mysqli_query($this->con,"SELECT * FROM user WHERE userStatus = 'Customer'");
        while($c = mysqli_fetch_assoc($query)){
            $data[] = $c;
        }
        return $data;
    }

    function tambahUser($nama, $username, $password, $status){
        $query = mysqli_query($this->con,"INSERT INTO user(userNama, userUsername, userPassword, userStatus) 
                            VALUES('$nama','$username',sha1('$password'), '$status')");
    
    }

    function hapusUser($id){
		mysqli_query($this->con, "DELETE FROM user WHERE userId='$id'");
    }

    function detailUser($id){
        $query=mysqli_query($this->con,"SELECT * FROM user WHERE userId = '$id'");
        while($d = mysqli_fetch_assoc($query)){
            $data[] = $d;
        }
        return $data;
    }

    function ubahPassword($id,$lama,$baru,$konfirmasi){
        $qpwlama = mysqli_query($this->con, "SELECT * FROM user WHERE userId = '$id'");
        $pwlama = mysqli_fetch_assoc($qpwlama);

        if($lama != $pwlama) echo "Password Lama Salah";
        
        if($baru != $konfirmasi) echo "Konfirmasi Password Salah";
        
        if($lama == $baru) echo "Tidak bisa menggunakan password yang lama";
        
        
        $ubah = mysqli_query($this->con,"UPDATE user SET userPassword = sha1('$baru') WHERE userId = '$id'");  
        
    }

    function editUser($id, $nama, $alamat, $telp, $password){
            mysqli_query($this->con,"UPDATE user SET 
            userNama = '$nama',
            userAlamat = '$alamat',
            userTelp = '$telp',
            userPassword = sha1('$password'),
            WHERE userId = '$id'");
        
    }

}