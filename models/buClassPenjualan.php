<?php 

Class Penjualan{
    function __construct(){
        $con = mysqli_connect("localhost","root","","suryajaya");
        $this->con=$con;
        }

        function tampilPenjualanProses(){
            $query = mysqli_query($this->con,"SELECT * FROM penjualan WHERE penjualanStatus = 'Waiting' ");
            while($p = mysqli_fetch_assoc($query)){
                $data[] = $p;
            }
            return $data;
        }

        function tampilPenjualanSukses(){
            $query = mysqli_query($this->con,"SELECT * FROM penjualan WHERE penjualanStatus = 'Sukses' ORDER BY penjualanId DESC");
            while($p = mysqli_fetch_assoc($query)){
                $data[] = $p;
            }
            return $data;
        }

        function tambahPenjualan($idfaktur,$karyawan,$customer,$tanggal,$jatuhtempo,$carabayar,$keterangan,$status){
            mysqli_query($this->con,"INSERT INTO penjualan(penjualanId, userNama, customerNama,penjualanTanggal, penjualanJatuhtempo, penjualanCara, penjualanKeterangan, penjualanStatus) 
            VALUES('$idfaktur','$karyawan','$customer','$tanggal','$jatuhtempo','$carabayar','$keterangan','$status')"); 
        }

        function sale($id,$kodebarang,$nama,$harga,$stok,$diskon,$total,$afterdisc){
            $barang = mysqli_query($this->con,"INSERT INTO sale(penjualanId, barangId, saleNama, saleJumlah, saleHarga, saleDiskon, saleKeterangan)
                                    VALUES($id,$kodebarang,)");
            $jasa = mysqli_query($this->con,"INSERT INTO sale(penjualanId, jasaId, saleNama, saleJumlah, saleHarga, saleDiskon, saleKeterangan)
                                    VALUES($id,$kodebarang,)");
        }

        function tambahdetailPenjualan($id, $kodebarang, $nama, $jumlah, $harga, $diskon, $stok, $afterdisc){
            $tambah = mysqli_query($this->con,"INSERT INTO detailpenjualan(penjualanId, barangId, dpenjualanBarang, dpenjualanJumlah, dpenjualanHarga, dpenjualanDiskon, dpenjualanTotal, dpenjualanRetur) 
            VALUES('$id','$kodebarang','$nama','$jumlah','$harga','$diskon','$afterdisc','0')"); 
            $stokbaru = $stok - $jumlah;
            $update = mysqli_query($this->con,"UPDATE barang SET barangStok = '$stokbaru' WHERE barangNama = '$nama'");
            
            if($tambah && $update) {
                return "Item berhasil ditambahkan!";
            } else {
                return "Item gagal ditambahkan!";
            }
        }

        function tambahdetailPenjualanJasa($id, $kodejasa, $nama, $jumlah, $harga, $total){
            $tambah = mysqli_query($this->con,"INSERT INTO detailpenjualanjasa(penjualanId, jasaId, djasaNama, djasaJumlah, djasaHarga, djasaTotal) 
            VALUES('$id','$kodejasa','$nama','$jumlah','$harga','$total')"); 
            if($tambah) {
                return "Jasa berhasil ditambahkan!";
            } else {
                return "Jasa gagal ditambahkan!";
            }
        }

        // function insertJKMBarang($tanggal, $keterangan, $id, $afterdisc, $diskon, $hpp, $total, $dpenjualanId){

        //     $jkm = mysqli_query($this->con,"INSERT INTO jurnalkm(jurnalkmTanggal, jurnalkmKeterangan, penjualanId, debitKas, debitDiskon, debitHpp, kreditPenjualan, kreditPersediaan, dpenjualanId) VALUES('$tanggal','$keterangan','$id','$afterdisc','$diskon','$hpp','$total','$hpp','$dpenjualanId')");
        // }

        // function insertJKMJasa($tanggal, $keterangan, $id, $total, $djasaId){
        //     $jkm = mysqli_query($this->con,"INSERT INTO jurnalkm(jurnalkmTanggal, jurnalkmKeterangan, penjualanId, debitKas, kreditPendapatanjasa, djasaId) 
        //     VALUES('$tanggal','$keterangan','$id','$total','$total','$djasaId')");
        // }

        // function insertJurnalPenjBarang($tanggal, $keterangan, $id, $afterdisc, $diskon, $hpp, $total, $dpenjualanId){
        //     $jpen = mysqli_query($this->con,"INSERT INTO 
        //     jurnalpenj(jurnalpenjTanggal, jurnalpenjKeterangan, penjualanId, debitPiutangusaha, debitDiskon, debitHpp, kreditPenjualan, kreditPersediaan, dpenjualanId)
        //     VALUES('$tanggal','$keterangan','$id','$afterdisc','$diskon','$hpp','$total','$hpp','$dpenjualanId')");
        // }

        // function insertJurnalPenjJasa($tanggal, $keterangan, $id, $total, $totalafterdisc, $djasaId){
        //     $jpenj = mysqli_query($this->con,"INSERT INTO 
        //     jurnalpenj(jurnalpenjTanggal, jurnalpenjKeterangan, penjualanId, debitPiutangusaha, kreditPendapatanjasa, djasaId)
        //     VALUES('$tanggal','$keterangan','$id','$total','$totalafterdisc','$djasaId')");
        // }

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
        }

        function hapusItemJual($iditem, $kodebarang){
            $w= mysqli_query($this->con,"SELECT * FROM detailpenjualan WHERE dpenjualanId = '$iditem'");
            $ww = mysqli_fetch_assoc($w);
            $q = mysqli_query($this->con,"SELECT * FROM barang WHERE barangId = '$kodebarang'");
            $qq = mysqli_fetch_assoc($q);
            $stokitem = $ww["dpenjualanJumlah"];
            $stoklama = $qq["barangStok"];
            $stokbaru = $stokitem + $stoklama;
            $update = mysqli_query($this->con,"UPDATE barang SET barangStok = '$stokbaru' WHERE barangId = '$kodebarang'");

            $hapus = mysqli_query($this->con,"DELETE FROM detailpenjualan WHERE dpenjualanId='$iditem'");
            // $hapusjkm = mysqli_query($this->con,"DELETE FROM jurnalkm WHERE dpenjualanId='$iditem'");
            if($update && $hapus) {
                return "Item Berhasil di hapus!";
            } else {
                return "Item Gagal di hapus!";
            }
        }

        function hapusJasaJual($iditem, $kodebarang){
            $hapus = mysqli_query($this->con,"DELETE FROM detailpenjualanjasa WHERE djasaId='$iditem'");

            if($hapus) {
                return "Jasa Berhasil di hapus!";
            } else {
                return "Jasa Gagal di hapus!";
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
            // $jkm = mysqli_query($this->con,"INSERT into jurnalkm(jurnalkmTanggal, penjualanId, debitKas, debitDiskon, debitHpp, kreditPenjualan, kreditPendapatanjasa, kreditPiutangusaha, kreditPersediaan, dpenjualanId, jasaId)");

        }

        function prosesPiutang($idfaktur){
            mysqli_query($this->con,"UPDATE penjualan SET penjualanStatus = 'Sukses' WHERE penjualanId = '$idfaktur'");
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