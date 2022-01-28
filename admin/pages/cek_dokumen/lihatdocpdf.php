<?php
$id = $_GET['id'];
$sql = $koneksi->query("SELECT * FROM data_dokumen WHERE id_data_dokumen = '$id'");
$data = $sql->fetch_assoc();

$idj = $_GET['jurnal'];
$sqlj = $koneksi->query("SELECT * FROM jurnal WHERE id_jurnal = '$idj'");
$dataj = $sqlj->fetch_assoc();


?>

<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <?php
        if($idj){
            echo'
            <a href="?p=dokumen&aksi=lihatdoc&jurnal='.$dataj['id_jurnal'].'" class="btn btn-danger btn-sm">Kembali</a>
            ';
        }else{
             echo'
            <a href="?p=dokumen&aksi=lihatdoc&id='.$data['id_info_doc'].'" class="btn btn-danger btn-sm">Kembali</a>
            ';
        }
        ?>
        <!-- <a href="?p=dokumen&aksi=lihatdoc&id=<?= $data['id_info_doc'];?>" class="btn btn-danger btn-sm">Kembali</a> -->
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><?= $page;?></li>
        </ol>
        </div>
    </div>
    </div>
</div>
<?php
if($idj){
    echo '
    <embed src="../user/dokumen/jurnal/'.$dataj['file'].'#toolbar=0" type="application/pdf" width="100%" height="500px">
    ';
}else{
    echo'
    <embed src="../user/dokumen/'.$data['named_file'].'#toolbar=0" type="application/pdf" width="100%" height="500px">
    ';
}