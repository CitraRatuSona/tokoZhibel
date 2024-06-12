<?php 

Class Pembelian{
    function __construct(){
        $con = mysqli_connect("localhost","root","","suryajaya");
        $this->con=$con;
        }

        function tampilPembelianSukses(){
            $query = mysqli_query($this->con,"SELECT * FROM pembelian WHERE pembelianStatus = 'Sukses' ORDER BY pembelianId DESC");
            while($p = mysqli_fetch_assoc($query)){
                $data[] = $p;
            }
            return $data;
        }

        function tampilBuy($idfaktur){
            $query = mysqli_query($this->con,"SELECT *, (buyJumlah * buyHarga) AS TotalHarga FROM buy WHERE pembelianId = '$idfaktur'");
            while($b = mysqli_fetch_assoc($query)){
                $data[] = $b;
            }
            return $data;
        }

        function buyBarang($id, $kodebarang, $nama, $jumlah, $harga, $total){
            $barang = mysqli_query($this->con,"INSERT INTO buy(pembelianId, barangId, buyNama, buyJumlah, buyHarga, buyTotal)
                                    VALUES('$id','$kodebarang','$nama','$jumlah','$harga','$total')");
            if($barang) {
                return "Item berhasil ditambahkan!";
            } else {
                return "Item gagal ditambahkan!";
            }                        
        }

        function tambahPembelian($idfaktur,$karyawan,$supplier,$tanggalbeli,$jatuhtempo,$carabayar,$keterangan,$status){
            mysqli_query($this->con,"INSERT INTO pembelian(pembelianId, userNama, supplierNama, pembelianTanggal, pembelianJatuhtempo, pembelianCara, pembelianKeterangan, pembelianStatus) 
            VALUES('$idfaktur','$karyawan','$supplier','$tanggalbeli','$jatuhtempo','$carabayar','$keterangan','$status')"); 
        }

        function tambahdetailPembelian($idfaktur, $tanggalbeli, $carabayar){
            $query = mysqli_query($this->con,"SELECT * FROM buy WHERE pembelianId = '$idfaktur'");
            while($s = mysqli_fetch_assoc($query)){
                $pembelianid = $s['pembelianId'];
                $idbarang = $s['barangId'];
                $nama = $s['buyNama'];
                $jumlah = $s['buyJumlah'];
                $harga = $s['buyHarga'];
                $total = $s['buyTotal'];
                $afterdisc = $total;
                $beforedisc = $total + $diskon;
                mysqli_query($this->con,"INSERT INTO detailpembelian(pembelianId, barangId, dpembelianBarang, dpembelianJumlah, dpembelianHarga, dpembelianTotal)
                VALUES('$pembelianid','$idbarang','$nama','$jumlah','$harga','$total')");
                if($carabayar == "Tunai"){
                    $keterangan = "Pembelian Tunai B-".$idfaktur;
                    mysqli_query($this->con,"INSERT INTO jurnalkk(jurnalkkTanggal, jurnalkkKeterangan, jurnalkkFaktur, debitPersediaan, kreditKas) 
                    VALUES('$tanggaljual','$keterangan','$idfaktur','$total','$total')");
                }else if($carabayar = "Kredit"){
                    $keterangan = "Pembelian Kredit B-".$idfaktur;
                    mysqli_query($this->con,"INSERT INTO jurnalpemb(jurnalpembTanggal, jurnalpembKeterangan, pembelianId, debitPersediaan, kreditUtangusaha)
                    VALUES('$tanggalbeli','$keterangan','$idfaktur','$total','$total')");
                }
            }
            // mysqli_query($this->con,"TRUNCATE TABLE buy");
        }

        function detailPembelianFaktur($idfaktur){
            $query=mysqli_query($this->con,"SELECT * FROM detailpembelian WHERE pembelianId = '$idfaktur'");
            while($a = mysqli_fetch_assoc($query)){
                $data[] = $a;
            }
            return $data;
        }

        // function insertJKKtunai($tanggal,$keterangan,$faktur,$total,$afterdisc,$diskon,$dpembelianId){
        //     mysqli_query($this->con,"INSERT INTO jurnalkk(jurnalkkTanggal, jurnalkkKeterangan, jurnalkkFaktur, debitPersediaan, kreditKas, kreditPersediaan, dpembelianId)
        //     VALUES('$tanggal','$keterangan','$faktur','$total','$afterdisc','$diskon','$dpembelianId')");
        // }
        // function insertJKKHutang($tanggal,$keterangan,$faktur,$total,$dpembelianId){
        //     mysqli_query($this->con,"INSERT INTO jurnalkk(jurnalkkTanggal, jurnalkkKeterangan, jurnalkkFaktur, debitUtangusaha, kreditKas, dpembelianId)
        //     VALUES('$tanggal','$keterangan','$faktur','$total','$total','$dpembelianId')");
        // }
        // function insertJurnalPemb($tanggal,$keterangan,$id,$total,$afterdisc,$diskon,$dpembelianId){
        //     mysqli_query($this->con,"INSERT INTO jurnalpemb(jurnalpembTanggal, jurnalpembKeterangan, pembelianId, debitPersediaan, kreditUtangusaha, kreditPersediaan, dpembelianId)
        //     VALUES('$tanggal','$keterangan','$id','$total','$afterdisc','$diskon','$dpembelianId')");
        // }

        function detailItem($iditem){
            $query = mysqli_query($this->con,"SELECT * FROM detailpembelian WHERE dpembelianId = '$iditem'");
            while($p = mysqli_fetch_assoc($query)){
                $data[] = $p;
            }
            return $data;
        }

        function totalBayar($idfaktur){
            $lihat = mysqli_query($this->con,"SELECT SUM(dpembelianHarga) AS JumlahHarga, SUM(dpembelianDiskon) AS DiskonJual, SUM(dpembelianHarga)-SUM(dpembelianDiskon) AS TotalBayar FROM detailpembelian WHERE pembelianId = '$idfaktur'");
            while($t = mysqli_fetch_assoc($lihat)){
                $data[] = $t;
            }
            return $data;
        }

        function editPembelian($id,$tanggalbeli,$jatuhtempo,$carabayar,$keterangan){
            mysqli_query($this->con,"UPDATE pembelian SET 
            pembelianTanggal = '$tanggalbeli',
            pembelianJatuhtempo = '$jatuhtempo',
            pembelianCara = '$carabayar',
            pembelianKeterangan = '$keterangan'
            WHERE pembelianId = '$id'");
        }
    
        function detailPembelian($id){
            $query=mysqli_query($this->con,"SELECT * FROM pembelian WHERE pembelianId = '$id'");
            while($a = mysqli_fetch_assoc($query)){
                $data[] = $a;
            }
            return $data;
        }

        function detailPembelianKredit(){
            $query=mysqli_query($this->con,"SELECT * FROM pembelian WHERE pembelianStatus = 'Belum Bayar'");
            while($j = mysqli_fetch_assoc($query)){
                $data[] = $j;
            }
            return $data;
        }


        function hapusPembelian($id){
            mysqli_query($this->con,"DELETE FROM pembelian WHERE pembelianId='$id'");
            mysqli_query($this->con,"DELETE FROM detailpembelian WHERE pembelianId='$id'");
        }

        function hapusItemBeli($iditem){
            $hapus = mysqli_query($this->con,"DELETE FROM buy WHERE buyId='$iditem'");
            if($hapus) {
                return "Item Berhasil di hapus!";
            } else {
                return "Item Gagal di hapus!";
            }
        }

        function prosesPembelian($idfaktur){
            $query = mysqli_query($this->con,"SELECT * FROM pembelian WHERE pembelianId = '$idfaktur'");
            $status = mysqli_fetch_assoc($query);
            if($status['pembelianCara'] == 'Kredit'){
                mysqli_query($this->con,"UPDATE pembelian SET pembelianStatus = 'Belum Bayar' WHERE pembelianId='$idfaktur'");    
            }else{
                mysqli_query($this->con,"UPDATE pembelian SET pembelianStatus = 'Sukses' WHERE pembelianId='$idfaktur'");    
            }
        }

        function prosesHutang($idfaktur,$tanggalbayar,$total){
            mysqli_query($this->con,"UPDATE pembelian SET pembelianStatus = 'Sukses' WHERE pembelianId = '$idfaktur'");
            $keterangan = "Pembayaran Hutang B-".$idfaktur;
            mysqli_query($this->con,"INSERT INTO jurnalkk(jurnalkkTanggal, jurnalkkKeterangan, jurnalkkFaktur, debitUtangusaha, kreditKas)
            VALUES('$tanggalbayar','$keterangan','$idfaktur','$total','$total')");

        }

        function returPembelian($idfaktur,$idbarang,$namabarang,$jumlahretur,$hargabeli,$hargatotal,$tanggalretur){
            $retur = mysqli_query($this->con,"INSERT INTO detailpembelian(pembelianId, barangId, dpembelianBarang, dpembelianJumlah, dpembelianHarga, dpembelianTotal,dpembelianRetur, dpembelianReturTanggal)
            VALUES('$idfaktur','$idbarang','$namabarang','$jumlahretur','$hargabeli','$hargatotal ',1,'$tanggalretur')");
            
            if($retur){
                return "Sukses";
            }else{
                return "Gagal";
            }
        }

        function dataRetur($idfaktur){
            $query=mysqli_query($this->con,"SELECT *, (dpembelianHarga * dpembelianJumlah) AS HargaAkhir FROM detailpembelian WHERE dpembelianRetur = '1' AND pembelianId = '$idfaktur'");
            while($r = mysqli_fetch_assoc($query)){
                $data[] = $r;
            }
            return $data;
        }

        function hapusRetur($iditem){
            mysqli_query($this->con,"DELETE FROM detailpembelian WHERE dpembelianId = '$iditem' AND dpembelianRetur = 1");
            mysqli_query($this->con,"DELETE FROM jurnalumum WHERE iddetail = '$iditem'");
        }

        function jurnalUmumReturTunai($tanggal,$idfaktur,$hargatotal,$iddetail){
            mysqli_query($this->con,"INSERT INTO jurnalumum(jurnalumumTanggal, jurnalumumFaktur, jurnalumumAkun, jurnalumumKeterangan, jurnalumumDebit,iddetail)
            VALUES('$tanggal','$idfaktur','Kas','Retur Pembelian','$hargatotal','$iddetail')");
            mysqli_query($this->con,"INSERT INTO jurnalumum(jurnalumumTanggal, jurnalumumFaktur, jurnalumumAkun, jurnalumumKeterangan, jurnalumumKredit,iddetail)
            VALUES('$tanggal','$idfaktur','Persediaan','Retur Pembelian','$hargatotal','$iddetail')");
        }
        function jurnalUmumReturKredit($tanggal,$idfaktur,$hargatotal,$iddetail){
            mysqli_query($this->con,"INSERT INTO jurnalumum(jurnalumumTanggal, jurnalumumFaktur, jurnalumumAkun, jurnalumumKeterangan, jurnalumumDebit,iddetail)
            VALUES('$tanggal','$idfaktur','Utang Usaha','Retur Pembelian','$hargatotal','$iddetail')");
            mysqli_query($this->con,"INSERT INTO jurnalumum(jurnalumumTanggal, jurnalumumFaktur, jurnalumumAkun, jurnalumumKeterangan, jurnalumumKredit,iddetail)
            VALUES('$tanggal','$idfaktur','Persediaan','Retur Pembelian','$hargatotal','$iddetail')");
        }
}