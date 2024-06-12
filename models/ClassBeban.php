<?php 

Class Beban{
    function __construct(){
        $con = mysqli_connect("localhost","root","","suryajaya");
        $this->con=$con;
        }

        function tampilBeban(){
            $query = mysqli_query($this->con,"SELECT * FROM beban");
            while($b = mysqli_fetch_assoc($query)){
                $data[] = $b;
            }
            return $data;
        }

        function tambahBeban($kodebeban,$tanggal,$serba,$nominal,$keterangan){
            mysqli_query($this->con,"INSERT INTO beban(bebanKode, bebanTanggal, bebanSerba, bebanNominal, bebanKeterangan) 
                                    VALUES('$kodebeban','$tanggal','$serba','$nominal','$keterangan')");
        }

        function insertJKKBeban($tanggal, $serba, $kodebeban, $nominal){
            mysqli_query($this->con,"INSERT INTO jurnalkk(jurnalkkTanggal, jurnalkkKeterangan, jurnalkkFaktur, debitSerbaserbi, kreditKas)
                                    VALUES('$tanggal','$serba','BB-$kodebeban','$nominal','$nominal')");
        }

        function insertBebanPeny($tanggal,$nominal,$kodebeban){
            mysqli_query($this->con,"INSERT INTO jurnalpeny(jurnalpenyTanggal, jurnalpenyKeterangan, jurnalpenyDebit, bebanKode)
                                    VALUES('$tanggal','Beban Penyusutan Peralatan Toko','$nominal','$kodebeban')");
            mysqli_query($this->con,"INSERT INTO jurnalpeny(jurnalpenyTanggal, jurnalpenyKeterangan, jurnalpenyKredit, bebanKode)
                                    VALUES('$tanggal','Akum Penyusutan Peralatan Toko','$nominal','$kodebeban')");                        
        }

        function editBeban($id,$nama,$tanggal,$serba,$nominal){
            mysqli_query($this->con,"UPDATE beban SET 
            bebanNama = '$nama',
            bebanTanggal = '$tanggal',
            bebanSerba = '$serba',
            bebanNominal = '$nominal'
            WHERE bebanId = '$id'");
        }
    
        function detailBeban($id){
            $query=mysqli_query($this->con,"SELECT * FROM beban WHERE bebanId = '$id'");
            while($a = mysqli_fetch_assoc($query)){
                $data[] = $a;
            }
            return $data;
        }

        function hapusBeban($id){
            mysqli_query($this->con,"DELETE FROM beban WHERE bebanId='$id'");
        }
}