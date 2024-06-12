<?php 

Class Customer{
    function __construct(){
        $con = mysqli_connect("localhost","root","","suryajaya");
        $this->con=$con;
        }

        function tampilCustomer(){
            $query = mysqli_query($this->con,"SELECT * FROM customer");
            while($c = mysqli_fetch_assoc($query)){
                $data[] = $c;
            }
            return $data;
        }

        function tambahCustomer($nama,$alamat,$telp){
            mysqli_query($this->con,"INSERT INTO customer(customerNama, customerAlamat, customerTelp) 
                                            VALUES('$nama','$alamat','$telp')");
        }

        function editCustomer($id,$nama,$alamat,$telp){
            mysqli_query($this->con,"UPDATE customer SET 
            customerNama = '$nama',
            customerAlamat = '$alamat',
            customerTelp = '$telp'
            WHERE customerId = '$id'");
        }
    
        function detailCustomer($id){
            $query=mysqli_query($this->con,"SELECT * FROM customer WHERE customerId = '$id'");
            while($c = mysqli_fetch_assoc($query)){
                $data[] = $c;
            }
            return $data;
        }

        function hapusCustomer($id){
            mysqli_query($this->con,"DELETE FROM customer WHERE customerId='$id'");
        }
}