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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/fontawesome-free/css/all.min.css" rel="stylesheet" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css"> -->
    <link rel="stylesheet" type="text/css" href="assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <script src="assets/dist/css/sweetalert2/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>

<body id="page-top">
    <div class="preloader">
        <div class="loading">
            <img src="assets/logo-title.png" width="80">
            <p>Harap Tunggu</p>
        </div>
    </div>
    <!-- <a class="menu-toggle rounded" href="#"><i class="fas fa-bars"></i></a> -->
    <nav class="navbar navbar-t navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="index.php"><img src="assets/img/logo1.png" width="320" height="180" alt=""></a>
            <!-- menu -->
            <?php include "template/menu.php"; ?>
            <hr class="line">
            <h2 class="text-kiri text-white text-capitalize"><?= $p; ?></h2>
            <div class="konten-kanan">
                <form action="pencarian.php" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control search-index" autofocus="on" placeholder="Cari Berdasarkan Judul Dokumen, Nama Penulis, Fakultas, Dll" name="keyword" required>
                        <div class="input-group-append">
                            <button class="btn btn-dark btn-search-index" type="submit" name="cari">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    <div class="content">
        <div class="container-fluid mt-4">
            <?php
            include "user/pages/koneksi.php";
            $p = $_GET['p'];
            $a = $_GET['act'];
            if ($p == "masuk") {
                include "pages/login.php";
            } elseif ($p == "daftar") {
                if ($a == "") {
                    include "pages/daftar/daftar.php";
                } elseif ($a == "proses") {
                    include "pages/daftar/daftarProses.php";
                } elseif ($a == "confirm") {
                    include "pages/daftar/confirm.php";
                }
            } elseif ($p == "berita") {
                if ($a == "") {
                    include "pages/info/info.php";
                } elseif ($a == "read") {
                    include "pages/info/bacaInfo.php";
                }
            }
            ?>
        </div>
    </div>

    <footer class="page-footer font-small fixed-bottom bg-dark">
        <div class="footer-copyright text-white ml-3 py-3">© 2021
            <a class="text-white" href="index.php">Research Library.</a>
            All Rights Reserved
        </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <!-- Core theme JS-->
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        $(document).ready(function() {
            var app = {
                show: function() {
                    $.ajax({
                        url: "pages/daftar/get_fakultas.php",
                        method: "POST",
                        success: function(data) {
                            $("#fakultasDaftar").html(data)
                        }
                    })
                },
                tampil: function() {
                    var fakultas = $(this).val();
                    $.ajax({
                        url: "pages/daftar/get_jurusan.php",
                        method: "POST",
                        data: {
                            fakultas: fakultas
                        },
                        cache: false,
                        success: function(data) {
                            $("#jurusanDaftar").html(data)
                        }
                    })
                }
            }
            app.show();
            $(document).on("change", "#fakultasDaftar", app.tampil)
        })
    </script>
</body>

</html>