<?php
error_reporting(0);
include "user/pages/koneksi.php";
$id = $_GET['id'];
$sql = $koneksi->query("SELECT * FROM data_dokumen WHERE id_data_dokumen = '$id'");
$data = $sql->fetch_assoc();

$jurnal = $_GET['jurnal'];
$sql_jurnal = $koneksi->query("SELECT * FROM jurnal WHERE id_jurnal = '$jurnal'");
$data_jurnal = $sql_jurnal->fetch_assoc();
?>
    <link rel="icon" type="image/x-icon" href="assets/logo-title.png" />
    <title>Academic Production</title>
<?php 
if($id){
    echo'
    <embed src="user/dokumen/'.$data['named_file'].' #navpanes=0&scrollbar=0&toolbar=0" type="application/pdf" width="100%" height="100%">
    ';
}elseif($jurnal){
    echo'
    <embed src="user/dokumen/jurnal/'.$data_jurnal['file'].'#toolbar=0" type="application/pdf" width="100%" height="100%">
    ';
}
?>
