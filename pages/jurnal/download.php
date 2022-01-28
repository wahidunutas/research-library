<?php
include "../../user/pages/koneksi.php";
$filename = $_GET['filename'];
$id = $_GET['id'];
$named = $_GET['named'];
$judul = $_GET['judul'];
$date = date('Y-m-d');
if($filename){ 
    $back_dir    ="../../user/dokumen/jurnal/";
    $file = $back_dir.$named;
    
    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($filename));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: private');
        header('Pragma: private');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        
        $sql2 = $koneksi->query("SELECT * FROM downloads WHERE id_jurnal='$id' AND date='$date'");
        $sqls2 = mysqli_num_rows($sql2);
        
        if($sqls2 == 1){
            $koneksi->query("UPDATE downloads SET jml=jml+1 WHERE id_jurnal='$id'");
        }else{
            $koneksi->query("INSERT INTO downloads(id, id_info_doc, id_jurnal, judul, jml, date)VALUES('', '-', '$id', '$judul', jml+1, '$date')");
        }


        exit;
    } 
    else {
        $_SESSION['pesan'] = "Oops! File - $file - not found ...";
        header("location:index.php");
    }
}