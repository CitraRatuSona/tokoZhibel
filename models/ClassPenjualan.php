<?php 

Class Penjualan{
    function __construct(){
        $con = mysqli_connect("localhost","root","","suryajaya");
        $this->con=$con;
        }

        function tampilPenjualanSukses(){
            $query = mysqli_query($this->con,"SELECT * FROM penjualan WHERE penjualanStatus = 'Sukses' ORDER BY penjualanId DESC");
            while($p = mysqli_fetch_assoc($query)){
                $data[] = $p;
            }
            return $data;
        }

        function tampilSale($idfaktur){
            $query = mysqli_query($this->con,"SELECT *, (saleJumlah * saleHarga) AS TotalHarga FROM sale WHERE penjualanId = '$idfaktur'");
            while($s = mysqli_fetch_assoc($query)){
                $data[] = $s;
            }
            return $data;
        }

        function saleBarang($id,$kodebarang,$nama,$jumlah,$harga,$diskon,$afterdisc,$stok,$hpp){
            $barang = mysqli_query($this->con,"INSERT INTO sale(penjualanId, barangId, saleNama, saleJumlah, saleHarga, saleDiskon, saleTotal, saleHpp)
                                    VALUES('$id','$kodebarang','$nama','$jumlah','$harga','$diskon','$afterdisc','$hpp')");
            $stokbaru = $stok - $jumlah;
            $update = mysqli_query($this->con,"UPDATE barang SET barangStok = '$stokbaru' WHERE barangNama = '$nama'");
        
            if($barang && $update) {
                return "Item berhasil ditambahkan!";
            } else {
                return "Item gagal ditambahkan!";
            }                        
        }

        function saleJasa($id,$kodejasa,$nama,$jumlah,$harga,$total){
            $jasa = mysqli_query($this->con,"INSERT INTO sale(penjualanId, jasaId, saleNama, saleJumlah, saleHarga, saleTotal)
                                    VALUES('$id','$kodejasa','$nama','$jumlah','$harga','$total')");
            $stokbaru = $stok - $jumlah;
            if($jasa) {
                return "Jasa berhasil ditambahkan!";
            } else {
                return "Jasa gagal ditambahkan!";
            }                        
        }

        function tambahPenjualan($idfaktur,$karyawan,$customer,$tanggal,$jatuhtempo,$carabayar,$keterangan,$status){
            mysqli_query($this->con,"INSERT INTO penjualan(penjualanId, userNama, customerNama,penjualanTanggal, penjualanJatuhtempo, penjualanCara, penjualanKeterangan, penjualanStatus) 
            VALUES('$idfaktur','$karyawan','$customer','$tanggal','$jatuhtempo','$carabayar','$keterangan','$status')"); 
        }

        function tambahdetailPenjualan($idfaktur, $tanggaljual, $carabayar){
            $query = mysqli_query($this->con,"SELECT * FROM sale WHERE penjualanId = '$idfaktur'");
            while($s = mysqli_fetch_assoc($query)){
                $penjualanid = $s['penjualanId'];
                $idbarang = $s['barangId'];
                $idjasa = $s['jasaId'];
                $nama = $s['saleNama'];
                $jumlah = $s['saleJumlah'];
                $harga = $s['saleHarga'];
                $hpp = $s['saleHpp'];
                $diskon = $s['saleDiskon'];
                $total = $s['saleTotal'];
                $afterdisc = $total;
                $beforedisc = $total + $diskon;
                if($idbarang != 0 ){
                    mysqli_query($this->con,"INSERT INTO detailpenjualan(penjualanId, barangId, dpenjualanBarang, dpenjualanJumlah, dpenjualanHarga, dpenjualanDiskon, dpenjualanTotal)
                    VALUES('$penjualanid','$idbarang','$nama','$jumlah','$harga','$diskon','$total')");
                    if($carabayar == "Tunai"){
                        $keterangan = "Penjualan Tunai J-".$idfaktur;
                        $jkm = mysqli_query($this->con,"INSERT INTO jurnalkm(jurnalkmTanggal, jurnalkmKeterangan, penjualanId, debitKas, debitDiskon, debitHpp, kreditPenjualan, kreditPersediaan) 
                        VALUES('$tanggaljual','$keterangan','$idfaktur','$total','$diskon','$hpp','$beforedisc','$hpp')");
                    }else if($carabayar = "Kredit"){
                        $keterangan = "Penjualan Kredit J-".$idfaktur;
                        mysqli_query($this->con,"INSERT INTO 
                        jurnalpenj(jurnalpenjTanggal, jurnalpenjKeterangan, penjualanId, debitPiutangusaha, debitDiskon, debitHpp, kreditPenjualan, kreditPersediaan)
                        VALUES('$tanggaljual','$keterangan','$idfaktur','$afterdisc','$diskon','$hpp','$beforedisc','$hpp')");
                    }
                }else if($idjasa != 0){
                    mysqli_query($this->con,"INSERT INTO detailpenjualanjasa(penjualanId, jasaId, djasaNama, djasaJumlah, djasaHarga, djasaTotal)
                    VALUES('$penjualanid','$idjasa','$nama','$jumlah','$harga','$total')");
                    if($carabayar == "Tunai"){
                        $keterangan = "Penjualan Tunai J-".$idfaktur;
                        mysqli_query($this->con,"INSERT INTO jurnalkm(jurnalkmTanggal, jurnalkmKeterangan, penjualanId, debitKas, kreditPendapatanjasa) 
                        VALUES('$tanggaljual','$keterangan','$idfaktur','$total','$total')");
                    }else if($carabayar = "Kredit"){
                        $keterangan = "Penjualan Kredit J-".$idfaktur;
                        mysqli_query($this->con,"INSERT INTO 
                        jurnalpenj(jurnalpenjTanggal, jurnalpenjKeterangan, penjualanId, debitPiutangusaha, kreditPendapatanjasa)
                        VALUES('$tanggaljual','$keterangan','$idfaktur','$total','$total')");
                    }
                    
                }
            }
            // mysqli_query($this->con,"TRUNCATE TABLE sale");
        }

        function insertJKM($tanggaljual, $keteranganjkm, $idfaktur, $total, $djasaId){
            $jkm = mysqli_query($this->con,"INSERT INTO jurnalkm(jurnalkmTanggal, jurnalkmKeterangan, penjualanId, debitKas, kreditPendapatanjasa, djasaId) 
            VALUES('$tanggaljual','$keteranganjkm','$idfaktur','$total','$total','$djasaId')");
        }

        function insertJurnalPenjJasa($tanggal, $keterangan, $id, $total, $totalafterdisc, $djasaId){
            $jpenj = mysqli_query($this->con,"INSERT INTO 
            jurnalpenj(jurnalpenjTanggal, jurnalpenjKeterangan, penjualanId, debitPiutangusaha, kreditPendapatanjasa, djasaId)
            VALUES('$tanggal','$keterangan','$id','$total','$totalafterdisc','$djasaId')");
        }

        function detailItem($iditem){
            $query = mysqli_query($this->con,"SELECT * FROM detailpenjualan WHERE dpenjualanId = '$iditem'");
            while($p = mysqli_fetch_assoc($query)){
                $data[] = $p;
            }
            return $data;
        }

        function editPenjualan($id,$tanggaljual,$jatuhtempo,$carabayar,$keterangan){
            mysqli_query($this->con,"UPDATE penjualan SET 
            penjualanTanggal = '$tanggaljual',
            penjualanJatuhtempo = '$jatuhtempo',
            PenjualanCara = '$carabayar',
            penjualanKeterangan = '$keterangan'
            WHERE penjualanId = '$id'");
        }
    
        function detailPenjualan($id){
            $query=mysqli_query($this->con,"SELECT * FROM penjualan WHERE penjualanId = '$id'");
            while($a = mysqli_fetch_assoc($query)){
                $data[] = $a;
            }
            return $data;
        }

        function detailPenjualanBarang($idfaktur){
            $query=mysqli_query($this->con,"SELECT *, dpenjualanHarga * dpenjualanJumlah AS TotalHargaItem FROM detailpenjualan WHERE penjualanId = '$idfaktur'");
            while($d = mysqli_fetch_assoc($query)){
                $data[] = $d;
            }
            return $data;
        }

        function detailPenjualanJasa($idfaktur){
            $query=mysqli_query($this->con,"SELECT *, djasaHarga * djasaJumlah AS TotalHargaJasa FROM detailpenjualanjasa WHERE penjualanId = '$idfaktur'");
            while($j = mysqli_fetch_assoc($query)){
                $data[] = $j;
            }
            return $data;
        }

        function detailPenjualanKredit(){
            $query=mysqli_query($this->con,"SELECT * FROM penjualan WHERE penjualanStatus = 'Belum Bayar'");
            while($j = mysqli_fetch_assoc($query)){
                $data[] = $j;
            }
            return $data;
        }

        function hapusPenjualan($id){
            mysqli_query($this->con,"DELETE FROM penjualan WHERE penjualanId='$id'");
            mysqli_query($this->con,"DELETE FROM detailpenjualan WHERE penjualanId='$id'");
            mysqli_query($this->con,"DELETE FROM detailpenjualanjasa WHERE penjualanId='$id'");
        }

        function hapusItemJual($idsale){
            $hapus = mysqli_query($this->con,"DELETE FROM sale WHERE saleId = '$idsale'");

            if($hapus) {
                return "Item Berhasil di hapus!";
            } else {
                return "Item Gagal di hapus!";
            }
        }

        function prosesPenjualan($idfaktur){
            $query = mysqli_query($this->con,"SELECT * FROM penjualan WHERE penjualanId = '$idfaktur'");
            $status = mysqli_fetch_assoc($query);
            if($status['penjualanCara'] == 'Kredit'){
                mysqli_query($this->con,"UPDATE penjualan SET penjualanStatus = 'Belum Bayar' WHERE penjualanId='$idfaktur'");    
            }else{
                mysqli_query($this->con,"UPDATE penjualan SET penjualanStatus = 'Sukses' WHERE penjualanId='$idfaktur'");    
            }
        }

        function prosesPiutang($idfaktur,$tanggalbayar,$total){
            mysqli_query($this->con,"UPDATE penjualan SET penjualanStatus = 'Sukses' WHERE penjualanId = '$idfaktur'");
            $keterangan = "Penerimaan Piutang J-".$idfaktur;
            mysqli_query($this->con,"INSERT INTO 
                    jurnalkm(jurnalkmTanggal, jurnalkmKeterangan, penjualanId, debitKas, kreditPiutangusaha)
                    VALUES('$tanggalbayar','$keterangan','$idfaktur','$total','$total')");
        }

        function returPenjualan($idfaktur,$idbarang,$namabarang,$jumlahretur,$hargabarang,$tanggalretur,$hargatotal){
            $retur = mysqli_query($this->con,"INSERT INTO detailpenjualan(penjualanId, barangId, dpenjualanBarang, dpenjualanJumlah, dpenjualanHarga, dpenjualanTotal, dpenjualanRetur, dpenjualanReturTanggal)
            VALUES('$idfaktur','$idbarang','$namabarang','$jumlahretur','$hargabarang','$hargatotal',1,'$tanggalretur')");
            if($retur){
                return "Sukses";
            }else{
                return "Gagal";
            }
        }

        function dataRetur($idfaktur){
            $query=mysqli_query($this->con,"SELECT *, (dpenjualanHarga * dpenjualanJumlah) AS HargaAkhir FROM detailpenjualan WHERE dpenjualanRetur = '1' AND penjualanId = '$idfaktur'");
            while($r = mysqli_fetch_assoc($query)){
                $data[] = $r;
            }
            return $data;
        }

        function hapusRetur($iditem){
            mysqli_query($this->con,"DELETE FROM detailpenjualan WHERE dpenjualanId = '$iditem' AND dpenjualanRetur = 1");
            mysqli_query($this->con,"DELETE FROM jurnalumum WHERE iddetail = '$iditem'");
        }

        function jurnalUmumReturPenjualanTunai($tanggal,$idfaktur,$totalharga,$hpp, $iddetail){
            mysqli_query($this->con,"INSERT INTO jurnalumum(jurnalumumTanggal, jurnalumumFaktur, jurnalumumAkun, jurnalumumKeterangan, jurnalumumDebit,iddetail)
            VALUES('$tanggal','$idfaktur','Retur dan Diskon Penjualan','Retur Penjualan','$totalharga','$iddetail')");
            mysqli_query($this->con,"INSERT INTO jurnalumum(jurnalumumTanggal, jurnalumumFaktur, jurnalumumAkun, jurnalumumKeterangan, jurnalumumKredit,iddetail)
            VALUES('$tanggal','$idfaktur','Kas','Retur Penjualan','$totalharga','$iddetail')");
            mysqli_query($this->con,"INSERT INTO jurnalumum(jurnalumumTanggal, jurnalumumFaktur, jurnalumumAkun, jurnalumumKeterangan, jurnalumumDebit,iddetail)
            VALUES('$tanggal','$idfaktur','Persediaan','Retur Penjualan','$hpp','$iddetail')");
            mysqli_query($this->con,"INSERT INTO jurnalumum(jurnalumumTanggal, jurnalumumFaktur, jurnalumumAkun, jurnalumumKeterangan, jurnalumumKredit,iddetail)
            VALUES('$tanggal','$idfaktur','Harga Pokok Penjualan','Retur Penjualan','$hpp','$iddetail')");
        }

        function jurnalUmumReturPenjualanKredit($tanggal,$idfaktur,$totalharga,$hpp, $iddetail){
            mysqli_query($this->con,"INSERT INTO jurnalumum(jurnalumumTanggal, jurnalumumFaktur, jurnalumumAkun, jurnalumumKeterangan, jurnalumumDebit,iddetail)
            VALUES('$tanggal','$idfaktur','Retur dan Diskon Penjualan','Retur Penjualan','$totalharga','$iddetail')");
            mysqli_query($this->con,"INSERT INTO jurnalumum(jurnalumumTanggal, jurnalumumFaktur, jurnalumumAkun, jurnalumumKeterangan, jurnalumumKredit,iddetail)
            VALUES('$tanggal','$idfaktur','Piutang Usaha','Retur Penjualan','$totalharga','$iddetail')");
            mysqli_query($this->con,"INSERT INTO jurnalumum(jurnalumumTanggal, jurnalumumFaktur, jurnalumumAkun, jurnalumumKeterangan, jurnalumumDebit,iddetail)
            VALUES('$tanggal','$idfaktur','Persediaan','Retur Penjualan','$hpp','$iddetail')");
            mysqli_query($this->con,"INSERT INTO jurnalumum(jurnalumumTanggal, jurnalumumFaktur, jurnalumumAkun, jurnalumumKeterangan, jurnalumumKredit,iddetail)
            VALUES('$tanggal','$idfaktur','Harga Pokok Penjualan','Retur Penjualan','$hpp','$iddetail')");
        }
}