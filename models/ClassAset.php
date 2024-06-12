<?php 

Class Aset{
    function __construct(){
        $con =mysqli_connect("localhost","root","","suryajaya");
        $this->con=$con;
        }

        function tampilAset(){
            $query = mysqli_query($this->con,"SELECT *, asetPenyBulan * TIMESTAMPDIFF(MONTH,asetTanggal,CURDATE()) AS TotalPeny,
            asetTotalharga - (asetPenyBulan * TIMESTAMPDIFF(MONTH,asetTanggal,CURDATE())) AS NilaiBuku
            FROM aset");
            while($a = mysqli_fetch_assoc($query)){
                $data[] = $a;
            }
            return $data;
        }

        function tambahAset($nama,$tanggal,$jumlah,$harga,$masa){
            mysqli_query($this->con,"INSERT INTO aset(asetNama, asetTanggal, asetJumlah, asetHarga, asetManfaat, asetPenyBulan) 
                                            VALUES('$nama','$tanggal','$jumlah','$harga','$masa','$perbulan')");
        }

        function editAset($id,$nama,$tanggal,$jumlah,$harga,$masa){
            if($masa == '4'){
                $perbulan = ($harga * $jumlah) / 48;
            }else if($masa == '8'){
                $perbulan = ($harga * $jumlah) / 96;
            }else if($masa == '20'){
                $perbulan = ($harga * $jumlah) / 240;
            }
            $pertahun = $perbulan * 12;
            mysqli_query($this->con,"UPDATE aset SET 
            asetNama = '$nama',
            asetTanggal = '$tanggal',
            asetJumlah = '$jumlah',
            asetHarga = '$harga',
            asetManfaat = '$masa',
            asetPenyBulan = '$perbulan',
            asetPenyTahun = '$pertahun'
            WHERE asetId = '$id'");
        }
    
        function detailAset($id){
            $query=mysqli_query($this->con,"SELECT * FROM aset WHERE asetId = '$id'");
            while($a = mysqli_fetch_assoc($query)){
                $data[] = $a;
            }
            return $data;
        }

        function hapusAset($id){
            mysqli_query($this->con, "DELETE FROM aset WHERE asetId='$id'");
        }
}