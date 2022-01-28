<?php
    session_start();
    include "user/pages/koneksi.php";
    error_reporting(0); 
    $p = $_GET['p'];
    $a = $_GET['act'];

    if($p == ""){
        include "pages/home.php";
    }elseif($p == "masuk"){
        include "template/index.php";
    }elseif($p == "daftar"){
        if($a == ""){
            include "template/index.php";
        }elseif($a == "proses"){
            include "template/index.php";
        }
    }elseif($p == "berita"){
        if($a == ""){
            include "template/index.php";
        }elseif($a == "read"){
            include "template/index.php";
        }
    }elseif($p == "dokumen"){
        include "template/index2.php";
    }elseif($p == "tipe-jurnal"){
        include "template/index2.php";
    }elseif($p == "bacajurnal"){
        include "template/index2.php";
    }
?>
