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
    <link href="assets/css/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script> -->
    <!-- Simple line xicons-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="assets/dist/css/sweetalert2/sweetalert2.all.min.js"></script>
</head>

<body id="page-top">
    <div class="preloader">
        <div class="loading">
            <img src="assets/logo-title.png" width="80">
            <p>Harap Tunggu</p>
        </div>
    </div>


    <nav class="navbar navbar-index navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand text-white" href="#"><img src="assets/img/logo1.png" width="380" height="200" alt=""></a>
        </div>
        <?php include "template/menu.php"; ?>
    </nav>

    <div class="bg">
        <!-- <img src="assets/img/book.jpg" class="d-block" alt="..."> -->
    </div>
    <header class="masthead d-flex align-items-center ">
        <div class="main">
            <form action="pencarian.php" method="get">
                <div class="input-group shadow">
                    <input type="text" class="form-control search-index" name="keyword" autofocus="on" placeholder="Cari Berdasarkan Judul Dokumen, Penulis, Dosen Pembimbing, Fakultas, Dll" required>
                    <div class="input-group-append">
                        <button class="btn btn-dark btn-search-index" name="cari" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </header>

    <footer class="page-footer font-small fixed-bottom bg-dark">
        <div class="footer-copyright text-white ml-3 py-3">© 2021
            <a class="text-white" href="index.php"> Research Library.</a>
            All Rights Reserved
        </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <!-- Core theme JS-->
    <script src="assets/js/scripts.js"></script>
</body>

</html>