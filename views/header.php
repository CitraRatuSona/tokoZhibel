<?php 
if(!session_id()) session_start();
include '../config/koneksi.php';
$nama = $_SESSION['nama'];
if(empty($_SESSION['uname'])){
    header("location:http://localhost/suryajaya/views/login.php");
}
?>          
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Toko Zhibel </title>
        <link rel="icon" type="image/png" href="http://localhost/suryajaya/assets/img/bookstore.jpg"/>
        <link href="http://localhost/suryajaya/assets/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
        <link href="http://localhost/suryajaya/assets/css/styles.css" rel="stylesheet" />
        <script src="http://localhost/suryajaya/assets/js/all.min.js"></script>    

        
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="home.php">Toko Zhibel</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button
            ><!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <!-- <input class="form-control" type="text" placeholder="   for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div> -->
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="ubahpassword.php">Ubah Password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../controllers/userolah.php?logout">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <!-- <div class="sb-sidenav-menu-heading">Core</div> -->
                            <a class="nav-link" href="home.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard</a>

                            <?php
                            if($_SESSION['status'] == "Admin"){
                            ?>

                            <a class="nav-link" href="penjualanlist.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-money-bill"></i></div>
                                Data Penjualan</a>

                            <a class="nav-link" href="pembelianlist.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-money-bill"></i></div>
                                Data Pembelian</a>

                            <!-- <div class="sb-sidenav-menu-heading">Daftar Penjualan</div> -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#daflainnya" aria-expanded="false" aria-controls="daflainnya"
                                >
                                <div class="sb-nav-link-icon"><i class="fas fa-money-bill"></i></div>
                                Daftar Transaksi Lainnya
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="daflainnya" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="bebanlist.php">Data Beban</a>
                                <a class="nav-link" href="asetlist.php">Data Peralatan</a>
                            </div>

                            <!-- <div class="sb-sidenav-menu-heading">Laporan Keuangan</div> -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#lapkeuangan" aria-expanded="false" aria-controls="lapkeuangan"
                                >
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Laporan Keuangan
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="lapkeuangan" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="labarugi.php">Laba Rugi</a>
                                <a class="nav-link" href="perubahanmodal.php">Perubahan Modal</a>
                                <a class="nav-link" href="neraca.php">Neraca</a>
                            </div>

                            <!-- <div class="sb-sidenav-menu-heading">Jurnal</div> -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#jurnal" aria-expanded="false" aria-controls="jurnal"
                                >
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Jurnal
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="jurnal" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="jurnalpembelian.php">Pembelian</a>
                                <a class="nav-link" href="jurnalpengeluarankas.php">Pengeluaran Kas</a>
                                <a class="nav-link" href="jurnalpenjualan.php">Penjualan</a>
                                <a class="nav-link" href="jurnalpenerimaankas.php">Penerimaan Kas</a>
                                <a class="nav-link" href="jurnalpenyesuaian.php">Penyesuaian</a>
                            </div>

                            <!-- <div class="sb-sidenav-menu-heading">Buku Besar</div> -->
                            <a class="nav-link" href="bukubesar.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                                Buku Besar
                                </a>
                                
                            <a class="nav-link" href="akunlist.php">
                            <div class="sb-nav-link-icon"><i class="far fa-file-alt"></i></div>
                            Daftar Akun
                            </a>

                            <!-- <div class="sb-sidenav-menu-heading">Daftar Orang</div> -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#daforang" aria-expanded="false" aria-controls="daforang"
                                >
                                <div class="sb-nav-link-icon"><i class="fas fa-money-bill"></i></div>
                                Daftar Stakeholder
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="daforang" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="userlist.php">Data Karyawan</a>
                                <a class="nav-link" href="customerlist.php">Data Customer</a>
                                <a class="nav-link" href="supplierlist.php">Data Supplier</a>
                            </div>

                            <!-- <div class="sb-sidenav-menu-heading">Daftar Penjualan</div> -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dafjualan" aria-expanded="false" aria-controls="dafjualan"
                                >
                                <div class="sb-nav-link-icon"><i class="fas fa-money-bill"></i></div>
                                Daftar Jual
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="dafjualan" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="baranglist.php">Data Barang</a>
                                <a class="nav-link" href="jasalist.php">Data Jasa</a>
                            </div>

                            <?php
                            } else if($_SESSION['status'] == "Karyawan"){
                            ?>
                            <!-- <div class="sb-sidenav-menu-heading">Core</div> -->
                            <a class="nav-link" href="penjualanlist.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-money-bill"></i></div>
                                Daftar Penjualan</a>

                            <?php
                            }
                            ?>
                            
                            <!-- <div class="sb-sidenav-menu-heading">Penjualan</div> -->
                            <!-- <a class="nav-link" href="penjualanlist.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-money-bill"></i></div>
                                Penjualan
                                </a> -->
                                
                            </div>
                        </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Login sebagai :</div>
                        <?= ucwords($nama);  ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <!-- <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">Toko Zhibel </li>
                            <li class="breadcrumb-item active">Charts</li>
                        </ol> -->
                    </div>
                </main>