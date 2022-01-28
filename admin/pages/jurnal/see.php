<!-- <?php
$id = $_GET['id'];
$sql = $koneksi->query("SELECT * FROM jurnal WHERE id_jurnal = '$id'");
$data = $sql->fetch_assoc();

?>
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0"><?= $data['judul'];?></h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="?p=jurnal" class="btn btn-primary btn-sm"><i class="fas fa-angle-left"></i> Kembali</a></li>
        </ol>
        </div>
    </div>
    </div>
</div>
<div class="card mb-3">
    <div class="card-body">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#cover">
        Lihat Cover
        </button>

        <?= $data['deskripsi'];?>
    </div>
</div>
<embed src="pages/jurnal/dokumen/<?= $data['file_jurnal'];?>#toolbar=0" type="application/pdf" width="100%" height="500px">



<div class="modal fade" id="cover"  data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    
    <img src="pages/jurnal/cover/<?= $data['cover'];?>" alt="img-responsive" style="max-width:350px;">
   
  </div>
</div> -->