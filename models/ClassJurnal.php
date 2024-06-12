<?php

class Jurnal{
    function __construct(){
        $con = mysqli_connect("localhost","root","","suryajaya");
        $this->con=$con;
    }

    function tampilJurnalPenerimaanKas($bulan,$tahun){
        $query = mysqli_query($this->con,"SELECT * FROM jurnalkm
        WHERE DATE_FORMAT(jurnalkmTanggal,'%m')='$bulan' and DATE_FORMAT(jurnalkmTanggal,'%Y')='$tahun'");
        while($j = mysqli_fetch_assoc($query)){
            $data[] = $j;
        }
        return $data;
    }

    function tampilJurnalPengeluaranKas($bulan,$tahun){
        $query = mysqli_query($this->con,"SELECT * FROM jurnalkk
        WHERE DATE_FORMAT(jurnalkkTanggal,'%m')='$bulan' and DATE_FORMAT(jurnalkkTanggal,'%Y')='$tahun'");
        while($j = mysqli_fetch_assoc($query)){
            $data[] = $j;
        }
        return $data;
    }

    function tampilJurnalPembelian($bulan,$tahun){
        $query = mysqli_query($this->con,"SELECT * FROM jurnalpemb
        WHERE DATE_FORMAT(jurnalpembTanggal,'%m')='$bulan' and DATE_FORMAT(jurnalpembTanggal,'%Y')='$tahun'");
        while($j = mysqli_fetch_assoc($query)){
            $data[] = $j;
        }
        return $data;
    }

    function tampilJurnalPenjualan($bulan,$tahun){
        $query = mysqli_query($this->con,"SELECT * FROM jurnalpenj
        WHERE DATE_FORMAT(jurnalpenjTanggal,'%m')='$bulan' and DATE_FORMAT(jurnalpenjTanggal,'%Y')='$tahun'");
        while($j = mysqli_fetch_assoc($query)){
            $data[] = $j;
        }
        return $data;
    }

    function tampilJurnalPenyesuaian($bulan,$tahun){
        $query = mysqli_query($this->con,"SELECT * FROM jurnalpenyesuaian
        WHERE DATE_FORMAT(jurnalpenyesuaianTanggal,'%m')='$bulan' and DATE_FORMAT(jurnalpenyesuaianTanggal,'%Y')='$tahun'");
        while($j = mysqli_fetch_assoc($query)){
            $data[] = $j;
        }
        return $data;
    }

}