<?php
$id = $_GET['id'];
$jurnal = $_GET['jurnal'];

$sql = $koneksi->query("SELECT * FROM data_dokumen WHERE id_data_dokumen = '$id'");
$data = $sql->fetch_assoc();
$sqlJ = $koneksi->query("SELECT * FROM jurnal WHERE id_jurnal = '$jurnal'");
$dataJ = $sqlJ->fetch_assoc();

?>

<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <?php 
        if($id){
            echo'<a href="?page=data&act=detail&id='.$data['id_info_doc'].'" class="btn btn-danger btn-sm">Kembali</a>';
        }else{
            echo'<a href="?page=data&act=detail&jurnal='.$dataJ['id_jurnal'].'" class="btn btn-danger btn-sm">Kembali</a>';
        }
        ?>
        
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
if($id){
    echo'
    <embed src="dokumen/'.$data['named_file'].'#toolbar=0" type="application/pdf" width="100%" height="500px">
    ';
}else{
    echo'
    <embed src="dokumen/jurnal/'.$dataJ['file'].'#toolbar=0" type="application/pdf" width="100%" height="500px">
    ';
}