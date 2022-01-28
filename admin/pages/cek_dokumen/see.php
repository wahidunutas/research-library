<?php
$id = $_GET['id'];
$sql1 = $koneksi->query("SELECT * FROM data_dokumen WHERE id_data_dokumen = '$id'");
$data = $sql1->fetch_assoc();

$jurnal = $_GET['jurnal'];
$sql = $koneksi->query("SELECT * FROM jurnal WHERE id_jurnal = '$jurnal'");
$dataJurnal = $sql->fetch_assoc();

?>
<?php
if(isset($id)){
    echo'
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <a href="?p=dokumen&aksi=proses&id='.$data['id_doc'].'" class="btn btn-danger btn-sm">Kembali</a>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">'.$page.'</li>
            </ol>
            </div>
        </div>
        </div>
    </div>
    <embed src="../user/dokumen/'.$data['named_file'].'#toolbar=0" type="application/pdf" width="100%" height="500px">
    
    ';
}else{
    echo'
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <a href="?p=dokumen&aksi=prosesJurnal&id='.$dataJurnal['id_jurnal'].'" class="btn btn-danger btn-sm">Kembali</a>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">'.$page.'</li>
            </ol>
            </div>
        </div>
        </div>
    </div>
    <embed src="../user/dokumen/jurnal/'.$dataJurnal['file'].'#toolbar=0" type="application/pdf" width="100%" height="500px">';
}