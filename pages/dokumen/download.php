<?php
include "../../user/pages/koneksi.php";
$id = $_GET['id'];
$filename = $_GET['filename'];
$zip = $_GET['zip'];
$sql = $_GET['sql'];
$named = $_GET['named'];
$judul = $_GET['judul'];
$date = date('Y-m-d');

if($filename){ 
    $back_dir    = "../../user/dokumen/";
    $file = $back_dir.$named;
    $nameFile = basename($filename);
    
    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Content-Disposition: attachment; filename=$nameFile");
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: private');
        header('Pragma: private');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
    } 
    else {
        $_SESSION['pesan'] = "Oops! File - $file - not found ...";
        header("location:index.php");
    }
}elseif($zip){
    $back_dir    = "../../user/dokumen/project/";
    $file = $back_dir.$zip;
    $nameFile = basename($zip);

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header("Content-Disposition: attachment; filename=$nameFile");
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: private');
    header('Pragma: private');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
}else{
    $back_dir    = "../../user/dokumen/project/";
    $file = $back_dir.$sql;
    $nameFile = basename($sql);

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header("Content-Disposition: attachment; filename=$nameFile");
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: private');
    header('Pragma: private');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
}

$sql = $koneksi->query("SELECT * FROM downloads WHERE id_info_doc='$id' AND date='$date'");
$sqls = mysqli_num_rows($sql);

if($sqls == 1){
    $koneksi->query("UPDATE downloads SET jml=jml+1 WHERE id_info_doc='$id'");
}else{
    $koneksi->query("INSERT INTO downloads(id, id_info_doc, judul, jml, date)VALUES('', '$id', '$judul', jml+1, '$date')");
}