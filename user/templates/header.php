<?php
if (isset($_POST['masuk'])) {
    masuk($_POST);
}

$totalCart = count(ambilCart()['carts']);


?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/custom.css" crossorigin="anonymous">

    <title><?= $judul ?? 'LW Fashion' ?></title>
</head>
<div class="topbar fixed-top">

    <?php  if (isset($_SESSION['nama'])) : ?>
        <p class="text-right pr-2 bg-white">
            <!-- <a href="../user/profil.php?tab=cart">
                <i class="fa fa-shopping-cart"></i>
                Keranjang
            </a>
            &nbsp;|&nbsp; -->
            <a href="../user/profil.php" class="text-secondary">
                <i class="fa fa-user"></i>
                <?= $_SESSION['nama'] ?>
            </a> 
            &nbsp;|&nbsp;
            <a href="../user/keluar.php">
                <i class="fa fa-sign-out"></i>
                <!-- Keluar -->
            </a>
        </p>
    <?php  else : ?>
        <p class="text-right pr-2 bg-white">
            <a href="../user/masuk.php" class="text-secondary" style="cursor: pointer" data-toggle="modal" data-target="#masuk">
                <i class="fa fa-sign-in"></i>
                Masuk
            </a> 
            &nbsp;|&nbsp;
            <a href="../user/daftar.php">
                <i class="fa fa-user"></i>
                Daftar
            </a>
        </p>
    <?php  endif; ?>

    

    <nav class="navbar navbar-expand-lg shadow-sm bg-white ">
        <div id="nav-btn" class="navbar-toggler m-auto" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false">
            <i id="icon" class="fa fa-bars"></i>
        </div>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav col-6">
                <li class="nav-item">
                    <a class="nav-link" href="../user/index.php">
                        <i class="fa fa-home"></i>
                        Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../user/produk.php">
                        <i class="fa fa-shopping-bag"></i>
                        Produk
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../user/tentang.php">
                        <i class="fa fa-info-circle"></i>
                        Tentang
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../user/kontak.php">
                        <i class="fa fa-phone"></i>
                        Kontak
                    </a>
                </li>
                <?php  if (isset($_SESSION['nama'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../user/profil.php?tab=cart">
                            <i class="fa fa-shopping-cart"></i>
                            Keranjang
                            <?php if ($totalCart > 0) : ?>
                                <span class="badge badge-danger"><?= $totalCart ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                <?php  endif; ?>

                <li class="nav-item">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#masuk" </button> <a class="nav-link" href="../daftar.php">Daftar</a>
                </li>
            </ul>
            <div class="cari col-6">
                <form class="form-inline float-right" action="../user/produk.php?cari=">
                    <input name="cari" class="form-control mr-sm-2 " type="search" placeholder="Cari" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </nav>

    <?php if (isset($_SESSION['pesan'])) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['pesan'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_SESSION['pesan']) ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['sukses'])) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['sukses'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_SESSION['sukses']) ?>
    <?php endif; ?>
</div>

<body class="bg-light">
    <div class="container  bg-white p-5">