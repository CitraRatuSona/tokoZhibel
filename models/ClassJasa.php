<?php 

Class Jasa{
    function __construct(){
        $con = mysqli_connect("localhost","root","","suryajaya");
        $this->con=$con;
        }

        function tampilJasa(){
            $query = mysqli_query($this->con,"SELECT * FROM jasa");
            while($b = mysqli_fetch_assoc($query)){
                $data[] = $b;
            }
            return $data;
        }

        function tambahJasa($idjasa,$kode,$nama,$hargajual){
            mysqli_query($this->con,"INSERT INTO jasa(jasaId,jasaKode,jasaNama,jasaHarga) 
                                            VALUES('$idjasa','$kode','$nama','$hargajual')");
        }

        function editJasa($id,$kode,$nama,$hargajual){
            mysqli_query($this->con,"UPDATE jasa SET 
            jasaNama = '$nama',
            jasaHarga = '$hargajual'
            WHERE jasaId = '$id'");
        }
    
        function detailJasa($id){
            $query=mysqli_query($this->con,"SELECT * FROM jasa WHERE jasaId = '$id'");
            while($a = mysqli_fetch_assoc($query)){
                $data[] = $a;
            }
            return $data;
        }

        function hapusJasa($id){
            mysqli_query($this->con,"DELETE FROM jasa WHERE jasaId='$id'");
        }
}