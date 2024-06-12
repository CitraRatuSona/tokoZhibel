-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2020 at 09:43 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `suryajaya`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `akunId` int(11) NOT NULL,
  `akunNama` varchar(255) NOT NULL,
  `akunJenis` varchar(255) NOT NULL,
  `akunSaldoNormal` varchar(255) NOT NULL,
  `akunSaldoAwal` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`akunId`, `akunNama`, `akunJenis`, `akunSaldoNormal`, `akunSaldoAwal`) VALUES
(1101, 'Kas', 'Aset', 'Debit', 40000000),
(1102, 'Piutang Usaha', 'Aset', 'Debit', 0),
(1103, 'Persediaan Barang Dagang', 'Aset', 'Debit', 2500000),
(1201, 'Peralatan Toko', 'Aset', 'Debit', 98550000),
(1202, 'Akumulasi Penyusutan - Peralatan Toko', 'Aset', 'Kredit', 21596875),
(2101, 'Utang Usaha', 'Utang', 'Kredit', 0),
(2102, 'Utang Gaji', 'Utang', 'Kredit', 0),
(3101, 'Modal', 'Ekuitas', 'Kredit', 141050000),
(3102, 'Prive', 'Ekuitas', 'Kredit', 0),
(3103, 'Ikhtisar Laba Rugi', 'Ekuitas', 'Kredit', 0),
(4101, 'Penjualan', 'Pendapatan', 'Kredit', 0),
(4102, 'Retur dan Diskon Penjualan', 'Pendapatan', 'Debit', 0),
(4201, 'Pendapatan Jasa', 'Pendapatan', 'Debit', 0),
(5101, 'Harga Pokok Penjualan', 'Harga Pokok Penjualan', 'Debit', 0),
(6101, 'Beban Gaji', 'Biaya dan Beban', 'Debit', 0),
(6102, 'Beban Listrik', 'Biaya dan Beban', 'Debit', 0),
(6103, 'Beban Penyusutan Peralatan Toko', 'Biaya dan Beban', 'Debit', 0),
(6104, 'Beban Sewa', 'Biaya dan Beban', 'Debit', 0);

-- --------------------------------------------------------

--
-- Table structure for table `aset`
--

CREATE TABLE `aset` (
  `asetId` int(11) NOT NULL,
  `asetNama` varchar(255) NOT NULL,
  `asetTanggal` date NOT NULL,
  `asetJumlah` int(11) NOT NULL,
  `asetHarga` int(11) NOT NULL,
  `asetTotalharga` int(11) NOT NULL,
  `asetManfaat` int(11) NOT NULL,
  `asetPenyBulan` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aset`
--

INSERT INTO `aset` (`asetId`, `asetNama`, `asetTanggal`, `asetJumlah`, `asetHarga`, `asetTotalharga`, `asetManfaat`, `asetPenyBulan`) VALUES
(1, 'Mesin Foto Copy', '2016-01-04', 1, 35000000, 35000000, 96, 364583),
(2, 'Mesin Potong Kecil', '2016-02-06', 1, 1500000, 1500000, 96, 15625),
(3, 'Mesin Potong Besar', '2016-02-06', 1, 7500000, 7500000, 96, 78125),
(4, 'Mesin Cetak', '2016-01-04', 1, 15000000, 15000000, 96, 156250),
(5, 'File Cabinet', '2016-01-04', 1, 3500000, 3500000, 96, 36458),
(6, 'Mesin Press', '2016-01-04', 2, 1700000, 3400000, 96, 35417),
(7, 'Mesin Jilid Spiral', '2016-01-04', 1, 1200000, 1200000, 96, 12500),
(8, 'Etalase Kaca Kecil', '2017-02-06', 4, 1500000, 6000000, 96, 62500),
(9, 'Etalase Kaca Besar', '2017-02-06', 4, 3500000, 14000000, 96, 145833),
(10, 'Etalase Kayu Menengah', '2017-02-06', 2, 1200000, 2400000, 48, 50000),
(11, 'Etalase Kayu Besar', '2017-02-06', 2, 2700000, 5400000, 48, 112500),
(12, 'Meja Kayu', '2017-02-06', 2, 700000, 1400000, 48, 29167),
(13, 'Meja Kasir', '2017-02-06', 1, 1300000, 1300000, 48, 27083),
(14, 'Meja Kayu Panjang', '2017-02-06', 1, 950000, 950000, 48, 19792),
(15, 'Laptop', '2018-06-08', 1, 1500000, 1500000, 96, 15625),
(16, 'Printer', '2018-06-08', 1, 450000, 450000, 96, 4688);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `barangId` int(11) NOT NULL,
  `barangKode` varchar(255) NOT NULL,
  `barangNama` varchar(255) NOT NULL,
  `barangStok` int(11) NOT NULL,
  `hargaBeli` int(11) NOT NULL,
  `hargaJual` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`barangId`, `barangKode`, `barangNama`, `barangStok`, `hargaBeli`, `hargaJual`) VALUES
(1, 'I-0001', 'Amplop Coklat Kecil', 0, 2000, 2000),
(2, 'I-0002', 'Amplop Putih Panjang', 0, 500, 500),
(3, 'I-0003', 'Amplop Putih Pendek', 0, 250, 250),
(4, 'I-0004', 'Anak Pisau (Besar)', 5, 9000, 10000),
(5, 'I-0005', 'Baterai (Besar)', 0, 8000, 10000),
(6, 'I-0006', 'Baterai (Sedang)', 20, 2000, 3000),
(7, 'I-0007', 'Buku Gambar A3', 90, 4000, 5000),
(8, 'I-0008', 'Buku Gambar A4', 0, 2500, 3000),
(9, 'I-0009', 'Buku Gambar F4', 85, 2000, 3000),
(10, 'I-0010', 'Buku Tulis', 0, 2500, 3000),
(11, 'I-0011', 'Hekter Joyko HD-10', 0, 5000, 7000),
(12, 'I-0012', 'Isi Cutter (Besar)', 0, 6000, 8000),
(13, 'I-0013', 'Isi Cutter L-500', 0, 4000, 5000),
(14, 'I-0014', 'Isi Hekter (24/6-1m)', 0, 3000, 3000),
(15, 'I-0015', 'Isi Hekter (No.10)', 0, 2000, 2000),
(16, 'I-0016', 'Isi Hekter No 10', 0, 2000, 2000),
(17, 'I-0017', 'Isi Hekter No 3', 0, 3000, 5000),
(18, 'I-0018', 'Isi Pena Signo (Kotak)', 0, 150000, 150000),
(19, 'I-0019', 'Isolasi Ban Hitam (Besar)', 0, 18000, 18000),
(20, 'I-0020', 'Isolasi Bening (Besar)', 0, 15000, 15000),
(21, 'I-0021', 'Isolasi Hitam (Besar)', 0, 18000, 18000),
(22, 'I-0022', 'Isolasi Hitam (Sedang)', 0, 6000, 8000),
(23, 'I-0023', 'Kertas A4 (Rim)', 0, 38000, 45000),
(24, 'I-0024', 'Kertas Double Folio', 0, 300, 500),
(25, 'I-0025', 'Kertas F4 (Rim)', 0, 40000, 50000),
(26, 'I-0026', 'Kwitansi (Besar)', 0, 15000, 15000),
(27, 'I-0027', 'Lem Fox', 0, 8000, 10000),
(28, 'I-0028', 'Lem Hokinal', 0, 2000, 3000),
(29, 'I-0029', 'Lem Setan', 0, 5000, 6000),
(30, 'I-0030', 'Map Biola ', 0, 2000, 2500),
(31, 'I-0031', 'Map Biola (Kotak)', 0, 150000, 150000),
(32, 'I-0032', 'Map Biola Putih', 0, 2500, 3000),
(33, 'I-0033', 'Map Box File 401', 0, 300000, 300000),
(34, 'I-0034', 'Map Plastik ', 0, 5000, 6000),
(35, 'I-0035', 'Map Plastik Tali', 0, 6000, 7000),
(36, 'I-0036', 'Map Putih (Kotak)', 0, 150000, 150000),
(37, 'I-0037', 'Map Tali', 0, 2000, 2000),
(38, 'I-0038', 'Map Tali (Kotak)', 0, 200000, 200000),
(39, 'I-0039', 'Materai 3000', 0, 3000, 4000),
(40, 'I-0040', 'Materai 6000', 0, 6000, 7000),
(41, 'I-0041', 'Nota Kontan 2 Ply (Besar)', 0, 8000, 10000),
(42, 'I-0042', 'Nota Kontan 2 Ply (Kecil)', 0, 3000, 4000),
(43, 'I-0043', 'Nota Kontan 3 Ply (Besar)', 0, 10000, 12000),
(44, 'I-0044', 'Nota Kontan 3 Ply (Kecil)', 0, 5000, 6000),
(45, 'I-0045', 'Paper Clips', 0, 3000, 4000),
(46, 'I-0046', 'Pena Deko Z-Z', 0, 5000, 5500),
(47, 'I-0047', 'Pena Gel Ink (Biru)', 0, 15000, 15000),
(48, 'I-0048', 'Pena Gel Ink (Hitam)', 0, 15000, 15000),
(49, 'I-0049', 'Pena Kenko', 0, 4500, 5000),
(50, 'I-0050', 'Pena Kenko (Kotak)', 0, 84000, 84000),
(51, 'I-0051', 'Pena Pilot', 0, 2000, 2000),
(52, 'I-0052', 'Pena Signo', 0, 17000, 17000),
(53, 'I-0053', 'Pena Signo (Kotak)', 0, 240000, 240000),
(54, 'I-0054', 'Pena Snowan (Merah)', 0, 2500, 3000),
(55, 'I-0055', 'Pena Snowman', 0, 3000, 3000),
(56, 'I-0056', 'Pena Snowman (Biru)', 0, 2500, 3000),
(57, 'I-0057', 'Pena Snowman (Hitam)', 0, 2500, 3000),
(58, 'I-0058', 'Pena Snowman (Kotak)', 0, 36000, 36000),
(59, 'I-0059', 'Pena Standard AE7', 0, 2000, 2000),
(60, 'I-0060', 'Penggaris', 0, 2000, 3000),
(61, 'I-0061', 'Penggaris Besi', 0, 4000, 5000),
(62, 'I-0062', 'Penghapus ', 0, 2000, 2000),
(63, 'I-0063', 'Pensil 2B', 0, 2000, 2500),
(64, 'I-0064', 'Pensil Faber Castle', 0, 2500, 2500),
(65, 'I-0065', 'Peruncing', 0, 1000, 1000),
(66, 'I-0066', 'Pisau Cutter (Besar)', 0, 6500, 7000),
(67, 'I-0067', 'Pisau Cutter (Kotak) Besar', 0, 60000, 60000),
(68, 'I-0068', 'Pisau Cutter Kenko L-500', 0, 12000, 13000),
(69, 'I-0069', 'Pisau Cutter L-500', 0, 15000, 17000),
(70, 'I-0070', 'Plastik Laminating Folio (Kotak)', 0, 140000, 140000),
(71, 'I-0071', 'Plastik Laminating KTP (Kotak)', 0, 30000, 45000),
(72, 'I-0072', 'Spidol Board Marker', 0, 5000, 6000),
(73, 'I-0073', 'Spidol Board Marker (Kotak)', 0, 72000, 72000),
(74, 'I-0074', 'Spidol Permanent', 0, 4000, 5000),
(75, 'I-0075', 'Spidol Permanent (Kotak)', 0, 60000, 60000),
(76, 'I-0076', 'Tinta Photo Copy Canon (Botol)', 0, 250000, 250000),
(77, 'I-0077', 'Tinta Spidol WFB', 0, 15000, 15000),
(78, 'I-0078', 'Tinta Spidol WFB (Kotak)', 0, 270000, 270000),
(79, 'I-0079', 'Tinta Stempel (Ungu)', 0, 35000, 35000),
(80, 'I-0080', 'Tipe-X', 0, 4000, 5000),
(81, 'I-0081', 'Twinpen', 0, 6000, 6000),
(82, 'I-0082', 'barang coba', 2, 123, 321);

-- --------------------------------------------------------

--
-- Table structure for table `beban`
--

CREATE TABLE `beban` (
  `bebanId` int(11) NOT NULL,
  `bebanKode` int(11) NOT NULL,
  `bebanTanggal` date NOT NULL,
  `bebanSerba` varchar(255) NOT NULL,
  `bebanNominal` int(11) NOT NULL,
  `bebanKeterangan` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `buy`
--

CREATE TABLE `buy` (
  `buyId` int(11) NOT NULL,
  `pembelianId` int(11) NOT NULL,
  `barangId` int(11) NOT NULL,
  `buyNama` varchar(255) NOT NULL,
  `buyJumlah` int(11) NOT NULL,
  `buyHarga` int(11) NOT NULL,
  `buyTotal` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `customerNama` varchar(255) NOT NULL,
  `customerAlamat` varchar(255) NOT NULL,
  `customerTelp` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `customerNama`, `customerAlamat`, `customerTelp`) VALUES
(1, 'SMPN 16 Pekanbaru', 'Jl. Cempaka', '081268545793');

-- --------------------------------------------------------

--
-- Table structure for table `detailpembelian`
--

CREATE TABLE `detailpembelian` (
  `dpembelianId` int(11) NOT NULL,
  `pembelianId` int(11) NOT NULL,
  `barangId` int(11) NOT NULL,
  `dpembelianBarang` varchar(255) NOT NULL,
  `dpembelianJumlah` int(11) NOT NULL,
  `dpembelianHarga` int(11) NOT NULL,
  `dpembelianTotal` int(11) NOT NULL,
  `dpembelianRetur` int(11) NOT NULL,
  `dpembelianReturTanggal` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `detailpenjualan`
--

CREATE TABLE `detailpenjualan` (
  `dpenjualanId` int(11) NOT NULL,
  `penjualanId` int(11) NOT NULL,
  `barangId` int(11) NOT NULL,
  `dpenjualanBarang` varchar(255) NOT NULL,
  `dpenjualanJumlah` int(11) NOT NULL,
  `dpenjualanHarga` int(11) NOT NULL,
  `dpenjualanDiskon` int(11) NOT NULL,
  `dpenjualanTotal` int(11) NOT NULL,
  `dpenjualanRetur` int(11) NOT NULL,
  `dpenjualanReturTanggal` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `detailpenjualanjasa`
--

CREATE TABLE `detailpenjualanjasa` (
  `djasaId` int(11) NOT NULL,
  `penjualanId` int(11) NOT NULL,
  `jasaId` int(11) NOT NULL,
  `djasaNama` varchar(255) NOT NULL,
  `djasaJumlah` int(11) NOT NULL,
  `djasaHarga` int(11) NOT NULL,
  `djasaTotal` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jasa`
--

CREATE TABLE `jasa` (
  `jasaId` int(11) NOT NULL,
  `jasaKode` varchar(255) NOT NULL,
  `jasaNama` varchar(255) NOT NULL,
  `jasaHarga` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jasa`
--

INSERT INTO `jasa` (`jasaId`, `jasaKode`, `jasaNama`, `jasaHarga`) VALUES
(1, 'S-0001', 'Foto Copy A3', 500),
(2, 'S-0002', 'Foto Copy A4', 200),
(3, 'S-0003', 'Foto Copy F4', 200),
(4, 'S-0004', 'Jilid A4', 3000),
(5, 'S-0005', 'Jilid Buku A4', 3000),
(6, 'S-0006', 'Jilid F4', 3000),
(7, 'S-0007', 'Laminating F4', 5000),
(8, 'S-0008', 'Laminating KTP', 3000),
(9, 'S-0009', 'Press', 7000);

-- --------------------------------------------------------

--
-- Table structure for table `jurnalkk`
--

CREATE TABLE `jurnalkk` (
  `jurnalkkId` int(11) NOT NULL,
  `jurnalkkTanggal` date NOT NULL,
  `jurnalkkKeterangan` varchar(255) NOT NULL,
  `jurnalkkFaktur` varchar(255) NOT NULL,
  `debitPersediaan` int(11) NOT NULL,
  `debitUtangusaha` int(11) NOT NULL,
  `debitSerbaserbi` int(11) NOT NULL,
  `kreditKas` int(11) NOT NULL,
  `kreditPersediaan` int(11) NOT NULL,
  `dpembelianId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jurnalkm`
--

CREATE TABLE `jurnalkm` (
  `jurnalkmId` int(11) NOT NULL,
  `jurnalkmTanggal` date NOT NULL,
  `jurnalkmKeterangan` varchar(255) NOT NULL,
  `penjualanId` int(11) NOT NULL,
  `debitKas` int(11) NOT NULL,
  `debitDiskon` int(11) NOT NULL,
  `debitHpp` int(11) NOT NULL,
  `kreditPenjualan` int(11) NOT NULL,
  `kreditPendapatanjasa` int(11) NOT NULL,
  `kreditPiutangusaha` int(11) NOT NULL,
  `kreditPersediaan` int(11) NOT NULL,
  `dpenjualanId` int(11) NOT NULL,
  `djasaId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jurnalpemb`
--

CREATE TABLE `jurnalpemb` (
  `jurnalpembId` int(11) NOT NULL,
  `jurnalpembTanggal` date NOT NULL,
  `jurnalpembKeterangan` varchar(255) NOT NULL,
  `pembelianId` int(11) NOT NULL,
  `debitPersediaan` int(11) NOT NULL,
  `kreditUtangusaha` int(11) NOT NULL,
  `kreditPersediaan` int(11) NOT NULL,
  `dpembelianId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jurnalpenj`
--

CREATE TABLE `jurnalpenj` (
  `jurnalpenjId` int(11) NOT NULL,
  `jurnalpenjTanggal` date NOT NULL,
  `jurnalpenjKeterangan` varchar(255) NOT NULL,
  `penjualanId` int(11) NOT NULL,
  `debitPiutangusaha` int(11) NOT NULL,
  `debitDiskon` int(11) NOT NULL,
  `debitHpp` int(11) NOT NULL,
  `kreditPenjualan` int(11) NOT NULL,
  `kreditPersediaan` int(11) NOT NULL,
  `kreditPendapatanjasa` int(11) NOT NULL,
  `dpenjualanId` int(11) NOT NULL,
  `djasaId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jurnalpeny`
--

CREATE TABLE `jurnalpeny` (
  `jurnalpenyId` int(11) NOT NULL,
  `jurnalpenyTanggal` date NOT NULL,
  `jurnalpenyKeterangan` varchar(255) NOT NULL,
  `jurnalpenyDebit` int(11) NOT NULL,
  `jurnalpenyKredit` int(11) NOT NULL,
  `bebanKode` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jurnalumum`
--

CREATE TABLE `jurnalumum` (
  `jurnalumumId` int(11) NOT NULL,
  `jurnalumumTanggal` date NOT NULL,
  `jurnalumumFaktur` varchar(255) NOT NULL,
  `jurnalumumAkun` varchar(255) NOT NULL,
  `jurnalumumKeterangan` varchar(255) NOT NULL,
  `jurnalumumDebit` int(11) NOT NULL,
  `jurnalumumKredit` int(11) NOT NULL,
  `iddetail` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `pembelianId` int(11) NOT NULL,
  `userNama` varchar(255) NOT NULL,
  `supplierNama` varchar(255) NOT NULL,
  `pembelianTanggal` date NOT NULL,
  `pembelianJatuhtempo` date NOT NULL,
  `pembelianCara` varchar(255) NOT NULL,
  `pembelianKeterangan` varchar(255) NOT NULL,
  `pembelianStatus` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `penjualanId` int(11) NOT NULL,
  `userNama` varchar(255) NOT NULL,
  `customerNama` varchar(255) NOT NULL,
  `penjualanTanggal` date NOT NULL,
  `penjualanJatuhtempo` date NOT NULL,
  `penjualanCara` varchar(255) NOT NULL,
  `penjualanKeterangan` varchar(255) NOT NULL,
  `penjualanStatus` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `saleId` int(11) NOT NULL,
  `penjualanId` int(11) NOT NULL,
  `barangId` int(11) NOT NULL,
  `jasaId` int(11) NOT NULL,
  `saleNama` varchar(255) NOT NULL,
  `saleJumlah` int(11) NOT NULL,
  `saleHarga` int(11) NOT NULL,
  `saleHpp` int(11) NOT NULL,
  `saleDiskon` int(11) NOT NULL,
  `saleTotal` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplierId` int(11) NOT NULL,
  `supplierNama` varchar(255) NOT NULL,
  `supplierAlamat` varchar(255) NOT NULL,
  `supplierTelp` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplierId`, `supplierNama`, `supplierAlamat`, `supplierTelp`) VALUES
(3, 'supplier 1', 'jl ehe', '098231321');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `userNama` varchar(255) NOT NULL,
  `userUsername` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `userStatus` enum('Karyawan','Customer','Admin') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `userNama`, `userUsername`, `userPassword`, `userStatus`) VALUES
(1, 'Admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Admin'),
(21, 'benny', 'benny', 'aff35f5394498c05a7bdb8185f997e99c121dff1', 'Karyawan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`akunId`);

--
-- Indexes for table `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`asetId`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`barangId`);

--
-- Indexes for table `beban`
--
ALTER TABLE `beban`
  ADD PRIMARY KEY (`bebanId`);

--
-- Indexes for table `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`buyId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`);

--
-- Indexes for table `detailpembelian`
--
ALTER TABLE `detailpembelian`
  ADD PRIMARY KEY (`dpembelianId`),
  ADD KEY `pembelianId` (`pembelianId`),
  ADD KEY `barangId` (`barangId`);

--
-- Indexes for table `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  ADD PRIMARY KEY (`dpenjualanId`),
  ADD KEY `penjualanId` (`penjualanId`),
  ADD KEY `barangId` (`barangId`);

--
-- Indexes for table `detailpenjualanjasa`
--
ALTER TABLE `detailpenjualanjasa`
  ADD PRIMARY KEY (`djasaId`);

--
-- Indexes for table `jasa`
--
ALTER TABLE `jasa`
  ADD PRIMARY KEY (`jasaId`);

--
-- Indexes for table `jurnalkk`
--
ALTER TABLE `jurnalkk`
  ADD PRIMARY KEY (`jurnalkkId`),
  ADD KEY `dpembelianId` (`dpembelianId`);

--
-- Indexes for table `jurnalkm`
--
ALTER TABLE `jurnalkm`
  ADD PRIMARY KEY (`jurnalkmId`),
  ADD KEY `penjualanId` (`penjualanId`),
  ADD KEY `dpenjualanId` (`dpenjualanId`),
  ADD KEY `jasaId` (`djasaId`);

--
-- Indexes for table `jurnalpemb`
--
ALTER TABLE `jurnalpemb`
  ADD PRIMARY KEY (`jurnalpembId`),
  ADD KEY `pembelianId` (`pembelianId`),
  ADD KEY `dpembelianId` (`dpembelianId`);

--
-- Indexes for table `jurnalpenj`
--
ALTER TABLE `jurnalpenj`
  ADD PRIMARY KEY (`jurnalpenjId`),
  ADD KEY `penjualanId` (`penjualanId`),
  ADD KEY `dpenjualanId` (`dpenjualanId`),
  ADD KEY `djasaId` (`djasaId`);

--
-- Indexes for table `jurnalpeny`
--
ALTER TABLE `jurnalpeny`
  ADD PRIMARY KEY (`jurnalpenyId`),
  ADD KEY `bebanKode` (`bebanKode`);

--
-- Indexes for table `jurnalumum`
--
ALTER TABLE `jurnalumum`
  ADD PRIMARY KEY (`jurnalumumId`),
  ADD KEY `dpenjualanId` (`iddetail`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`pembelianId`),
  ADD KEY `userNama` (`userNama`),
  ADD KEY `supplierNama` (`supplierNama`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`penjualanId`),
  ADD KEY `customerNama` (`customerNama`),
  ADD KEY `userNama` (`userNama`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`saleId`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplierId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aset`
--
ALTER TABLE `aset`
  MODIFY `asetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `beban`
--
ALTER TABLE `beban`
  MODIFY `bebanId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buy`
--
ALTER TABLE `buy`
  MODIFY `buyId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detailpembelian`
--
ALTER TABLE `detailpembelian`
  MODIFY `dpembelianId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  MODIFY `dpenjualanId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detailpenjualanjasa`
--
ALTER TABLE `detailpenjualanjasa`
  MODIFY `djasaId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurnalkk`
--
ALTER TABLE `jurnalkk`
  MODIFY `jurnalkkId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurnalkm`
--
ALTER TABLE `jurnalkm`
  MODIFY `jurnalkmId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurnalpemb`
--
ALTER TABLE `jurnalpemb`
  MODIFY `jurnalpembId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurnalpenj`
--
ALTER TABLE `jurnalpenj`
  MODIFY `jurnalpenjId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurnalpeny`
--
ALTER TABLE `jurnalpeny`
  MODIFY `jurnalpenyId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurnalumum`
--
ALTER TABLE `jurnalumum`
  MODIFY `jurnalumumId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `pembelianId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `penjualanId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `saleId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplierId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
