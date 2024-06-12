<?php
class Supplier{
    function __construct(){
        $con =mysqli_connect("localhost","root","","suryajaya");
        $this->con=$con;
        }

    function tampilSupplier(){
        $query = mysqli_query($this->con,"SELECT * FROM supplier");
        while($d = mysqli_fetch_assoc($query)){
            $data[] = $d;
        }
        return $data;
    }
    
    function tambahSupplier($nama, $alamat, $telp){
        $query = mysqli_query($this->con,"INSERT INTO supplier(supplierNama, supplierAlamat, supplierTelp) VALUES('$nama','$alamat','$telp')");
    }

    function editSupplier($id, $nama, $alamat, $telp){
        mysqli_query($this->con,"UPDATE supplier SET 
        supplierNama = '$nama',
        supplierAlamat = '$alamat',
        supplierTelp = '$telp'
        WHERE supplierId = '$id'");
    }

    function detailSupplier($id){
        $query=mysqli_query($this->con,"SELECT * FROM supplier WHERE supplierId = '$id'");
        while($s = mysqli_fetch_assoc($query)){
            $data[] = $s;
        }
        return $data;
    }

    function hapusSupplier($id){
		mysqli_query($this->con, "DELETE FROM supplier WHERE supplierId='$id'");
    }

}