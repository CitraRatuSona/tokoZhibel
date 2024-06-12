<?php
class Akun{
    function __construct(){
        $con = mysqli_connect("localhost","root","","suryajaya");
        $this->con=$con;
    }

    function tampilAkun($jenisakun){
        $query = mysqli_query($this->con,"SELECT akunId, akunNama, akunSaldoNormal, concat('Rp ', format(akunSaldoAwal, 0)) as saldo_awal FROM akun WHERE akunJenis='$jenisakun'");
        while($a = mysqli_fetch_assoc($query)){
            $data[] = $a;
        }
        return $data;
    }

    function tambahAkun($idakun,$namaakun,$jenisakun,$saldonormal,$saldoawal){
        $query = mysqli_query($this->con,"INSERT INTO akun(akunId, akunNama, akunJenis, akunSaldoNormal, akunSaldoAwal) 
        VALUES('$idakun','$namaakun','$jenisakun','$saldonormal','$saldoawal')");
    }

    function editAkun($idakun,$namaakun,$jenisakun,$saldonormal,$saldoawal){
        mysqli_query($this->con,"UPDATE akun SET 
        akunNama = '$namaakun',
        akunJenis = '$jenisakun',
        akunSaldoNormal = '$saldonormal',
        akunSaldoAwal = '$saldoawal'
        WHERE akunId = '$idakun'");
    }

    function hapusAkun($idakun){
		mysqli_query($this->con, "DELETE FROM akun WHERE akunId='$idakun'");
    }

    function detailAkun($idakun){
        $query=mysqli_query($this->con,"SELECT * FROM akun WHERE akunId = '$idakun'");
        while($a = mysqli_fetch_assoc($query)){
            $data[] = $a;
        }
        return $data;
    }

}