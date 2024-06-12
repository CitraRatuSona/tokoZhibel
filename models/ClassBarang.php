<?php 

Class Barang{
    function __construct(){
        $con = mysqli_connect("localhost","root","","suryajaya");
        $this->con=$con;
        }

        function tampilBarang(){
            $query = mysqli_query($this->con,"SELECT * FROM barang");
            while($b = mysqli_fetch_assoc($query)){
                $data[] = $b;
            }
            return $data;
        }

        function tambahBarang($idbarang,$kode,$nama,$hargabeli,$hargajual){
            mysqli_query($this->con,"INSERT INTO barang(barangId,barangKode,barangNama, barangStok, hargaBeli, hargaJual) 
                                            VALUES('$idbarang','$kode','$nama','0','$hargabeli','$hargajual')");
        }

        function editBarang($id,$nama,$stok,$hargabeli,$hargajual){
            mysqli_query($this->con,"UPDATE barang SET 
            barangNama = '$nama',
            barangStok = '$stok',
            hargaBeli = '$hargabeli',
            hargaJual = '$hargajual'
            WHERE barangId = '$id'");
        }
    
        function detailBarang($id){
            $query=mysqli_query($this->con,"SELECT * FROM barang WHERE barangId = '$id'");
            while($a = mysqli_fetch_assoc($query)){
                $data[] = $a;
            }
            return $data;
        }

        function hapusBarang($id){
            $delete = mysqli_query($this->con,"DELETE FROM barang WHERE barangId='$id'");
            if($delete){
                return "Barang Berhasil di hapus";
            }else{
                return "Barang sudah pernah terjual dan tidak dapat dihapus";
            }
            
        }
}