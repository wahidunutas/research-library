<?php
session_start();
include "user/pages/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Research Library</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/logo-title.png" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Simple line icons-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- bootstrap css -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="assets/css/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/util.css">
        <link rel="stylesheet" type="text/css" href="assets/css/main.css">
        <script src="assets/dist/css/sweetalert2/sweetalert2.all.min.js"></script>
    </head>
    <body id="page-top">
        <div id="container">
            <div class="preloader">
                <div class="loading">
                    <img src="assets/logo-title.png" width="80">
                    <p>Harap Tunggu</p>
                </div>
            </div> 
            <!-- HEADER -->
            <nav class="navbar nav-i2 navbar-expand-lg navbar-light bg-primary">
                <div class="container-fluid">
                    <a class="navbar-brand text-white" href="index.php"><img src="assets/img/logo1.png" width="220" height="100" alt=""></a>
                    <!-- menu -->
                    <a class="menu-toggle rounded" href="#"><i class="fas fa-bars"></i></a>
                    <ul class="sidebar-nav" id="sidebar-wrapper">
                        <li class="sidebar-brand"><a href="#page-top">Menu</a></li>
                        <li class="sidebar-nav-item"><a href="index.php">Home</a></li>
                        <li class="sidebar-nav-item"><a href="index.php?p=berita">Berita</a></li>
                        <li class="sidebar-nav-item"><a href="jurnal.php">Jurnal</a></li>
                        <li class="sidebar-nav-item"><a href="karya-ilmiah.php">Karya Ilmiah</a></li><hr>
                        <?php if(isset($_SESSION['login']['id_author'])){
                            echo "<li class='sidebar-nav-item'><a href='user/index.php'>Profile</a></li>";
                        }elseif(isset($_SESSION['admin']['id_admin'])){
                            echo"<li class='sidebar-nav-item'><a href='admin/index.php'>Admin Panel</a></li>";
                        }else{
                            echo"<li class='sidebar-nav-item'><a href='index.php?p=masuk'>Masuk</a></li>";
                        }
                        ?>
                    </ul>
                </div>
            </nav>