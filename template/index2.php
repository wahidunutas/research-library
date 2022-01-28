<?php include "template/head.php";?>
<div id="container">
    <div class="preloader">
        <div class="loading">
            <img src="assets/logo-title.png" width="80">
            <p>Harap Tunggu</p>
        </div>
    </div> 
    <nav class="navbar nav-i2 navbar-expand-lg navbar-light bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="index.php"><img src="assets/img/logo1.png" alt="" width="220" height="100"></a>
            <!-- menu -->
            <?php include "template/menu.php";?>
        </div>
    </nav>

    <div class="content">
        <div class="container-fluid mt-4">
            <?php
                $p = $_GET['p'];

                if($p == "dokumen"){
                    include "pages/dokumen/see.php";
                }elseif($p == "jurnal"){
                    include "pages/jurnal/jurnal.php";
                }elseif($p == "tipe-jurnal"){
                    include "pages/jurnal/tipejurnal.php";
                }elseif($p == "bacajurnal"){
                    include "pages/dokumen/seeujurnal.php";
                }
            ?>
        </div>
    </div>
</div>
<?php include "template/footer.php";?>