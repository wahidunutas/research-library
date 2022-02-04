<?php

$id = $_GET['id'];
$jurnal = $_GET['jurnal'];

$sql = $koneksi->query("SELECT * FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe JOIN fakultas ON fakultas.id_fakultas=info_doc.id_fakultas JOIN jurusan ON jurusan.id_jurusan=info_doc.id_jurusan  WHERE info_doc.id_info_doc = '$id'");
$data = $sql->fetch_assoc();

$sqlJurnal = $koneksi->query("SELECT * FROM jurnal JOIN tipe_jurnal ON tipe_jurnal.id_tipe_jurnal=jurnal.tipe_jurnal WHERE jurnal.id_jurnal = '$jurnal'");
$dataJurnal = $sqlJurnal->fetch_assoc();


$datadoc = array();
$sql_doc = $koneksi->query("SELECT * FROM data_dokumen WHERE id_info_doc = '$id'");
while ($dft = $sql_doc->fetch_assoc()) {
    $datadoc[] = $dft;
}

$jml = $koneksi->query("SELECT * FROM komentar JOIN info_doc ON info_doc.id_info_doc=komentar.id_info_doc WHERE komentar.id_info_doc='$id'");
$tampil = $jml->num_rows;
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h6 class="m-0"><a href="?page=data" class="btn btn-danger btn-sm"><i class="fas fa-angle-left"></i> Kembali</a></h6>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <h1 class="m-0">Data</h1>
                </ol>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($id)){
    echo'
    <form method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">FILES</div>
                    <div class="card-body">';
                        $zip = $koneksi->query("SELECT * FROM data_file_project WHERE id_info_doc = '$id'");
                        $result = $zip->fetch_assoc();
                        $Fzip = $result['file_project'];
                        echo'
                        <ul class="list-group list-group-flush">';
                            if(!empty($result['file_database']) && !empty($result['file_project']) ){
                                echo'
                                <a href="#" data-toggle="modal" data-target="#viewZip"> 
                                    <li class="list-group-item">
                                        <i class="fas fa-file-archive"></i> '.$result['file_project'].'
                                    </li>
                                </a>
                                <a href="#"> 
                                <li class="list-group-item">
                                    <i class="fas fa-database"></i> '.$result['file_database'].'
                                </li>
                                </a>';
                            }elseif(!empty($result['file_project']) && empty($result['file_database'])){
                                echo'
                                <a href="#" data-toggle="modal" data-target="#viewZip"> 
                                    <li class="list-group-item">
                                        <i class="fas fa-file-archive"></i> '.$result['file_project'].'
                                    </li>
                                </a>';
                            }elseif(empty($result['file_project']) && !empty($result['file_database'])){
                                echo'
                                <a href="#"> 
                                <li class="list-group-item">
                                    <i class="fas fa-database"></i> '.$result['file_database'].'
                                </li>
                                </a>';
                            }else{
                                echo '';
                            }?>
                            <?php foreach ($datadoc as $key => $value) : ?>
                                <a href="?page=data&act=lihat&id=<?= $value['id_data_dokumen'];?>">
                                    <li class="list-group-item"><i class="fas fa-angle-right"></i> <?= $value['files'];?></li>
                                </a>
                            <?php endforeach ?>
                        <?php 
                        echo'
                        </ul>
                    </div>
                </div>
                <div class="modal fade" id="viewZip" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">'.$Fzip.'</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">';
                    $zips = new ZipArchive();
                    if ($zips->open('dokumen/project/'.$Fzip) === true) {
                        for ($i = 0; $i < $zips->numFiles; $i++) {
                            echo '=> '.$zips->getNameIndex($i).'<br>';        
                            
                        }
                    }
                    echo'
                    </div>
                    </div>
                </div>
                </div>
                <p>
                    <a href="#komen" class="text-sm" data-toggle="collapse">
                        <i class="far fa-comments mr-1"></i> Comments ('.$tampil.')
                    </a>
                </p>
                <div class="';if(isset($_GET['komen'])){echo'collapse in show';}else{echo'collapse';}echo'" id="komen">
                    <div class="card card-body">';?>
                        <?php
                        $sql_komentar = "SELECT * FROM komentar JOIN author ON author.id_author=komentar.id_author JOIN info_doc ON komentar.id_info_doc=info_doc.id_info_doc WHERE info_doc.id_info_doc='$id'";
                        $sql_run = mysqli_query($koneksi, $sql_komentar);
                        if (mysqli_num_rows($sql_run) > 0) {
                            foreach ($sql_run as $cmt) { ?>
                                <blockquote class="quote-secondary">
                                    <small>Oleh: <?= $cmt['nama']; ?> <cite title="Source Title">- <?= $cmt['tgl_komentar']; ?></cite></small>
                                    <p><?= $cmt['isi_komentar']; ?></p>
                                </blockquote>
                        <?php }
                        } else {
                            echo "<span class='text-muted'>Saat ini Tidak Ada Komentar</span>";
                        }
                        ?>
                    <?php
                    echo'
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">';?>
                        <?php
                        $sqladmn = $koneksi->query("SELECT * FROM dokumen JOIN admin ON admin.id_admin=dokumen.id_admin WHERE id_info_doc='$id'");
                        $adm = $sqladmn->fetch_assoc();
                        if ($adm['id_admin'] != 0) {
                            if ($adm['status_doc'] == "Disetujui") {
                                echo "Disetujui Oleh = " . $adm['nama'] . " | Diproses = " . $adm['tgl_acc'] . "";
                            } else {
                                echo "";
                            }
                        }
                        ?>
                    <?php 
                    echo'
                    </div>
                    <div class="card-body">
                        <b>JUDUL';?>
                            <?php
                            if ($data['status_doc'] == "Pending") {
                                echo '<td><span class="badge badge-danger">' . $data['status_doc'] . '</span></td>';
                            } elseif ($data['status_doc'] == "Disetujui") {
                                echo '<td><span class="badge badge-success">' . $data['status_doc'] . '</span></td>';
                            }
    
                            $abs = substr($data['abstrak'], 0, 150) . '..';
                            $dp = substr($data['dafpus'], 0, 150) . '..';
                            ?>
                        <?php echo'
                        </b>
                        <p>'.$data['judul'].'</p>
                        <HR>
                        <b>NAMA PENULIS</b>
                        <p>';
                        if(!empty($data['nama_penulis_2'])){
                            echo '1. '.$data['nama_penulis'].'<br>2. '.$data['nama_penulis_2'];
                        }else{
                            echo $data['nama_penulis'];
                        }
                        echo'
                        </p>
                        <hr>
                        <b>TIPE</b>
                        <p>'.$data['nama_tipe'] .'</p>
                        <hr>
                        <b>Fakultas</b>
                        <p>'.$data['fakul'] .' -> '.$data['jur'] .'</p>
                        ';?>
                        <?php if(!empty($data['dospem'] )){
                            echo '<b>DOSEN PEMBIMBING</b>
                                <p>1. '.$data['dospem'].'<br>';
                                if(!empty($data['dospem_2'])){
                                    echo'2. '.$data['dospem_2'];
                                }else{
                                    echo'';
                                }
                                '</p><hr>';
                        }else{
                            echo '';
                        }
                        ?>
                        <?php echo'
                        <hr>
                        <b>ABSTRAK</b>
                        <p><a href="#" type="button" data-toggle="modal" data-target="#abstrak">Lihat Abstrak</a></p><hr>
                        <b>DAFTAR PUSTAKA</b>
                        <p><a href="#" type="button" data-toggle="modal" data-target="#dafpus">Lihat Daftar Pustaka</a></p>
                    </div>
                    <div class="modal fade" id="abstrak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Abstrak</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    '.$data['abstrak'].'
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="dafpus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Daftar Pustaka</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    '.$data['dafpus'].'
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    ';

}elseif(isset($jurnal)){
    echo'
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <b>Link Jurnal</b><br>
                    <a href="'.$dataJurnal['link'].'" target="_BLANK">'.$dataJurnal['link'].'</a>
                    <hr>
                    <b>File Jurnal</b><br>
                    <a href="?page=data&act=lihat&jurnal='.$dataJurnal['id_jurnal'].'"><img src="../pdf.png" style="width:20px">'.$dataJurnal['name_file'] .'</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Status : ';?>
                    <?php
                        if($dataJurnal['status_jurnal'] == 'Disetujui'){
                            echo '<span class="badge badge-success">Di Setujui</span>';
                        }elseif($dataJurnal['status_jurnal'] == 'Tidak Disetujui'){
                            echo '<span class="badge badge-warning">Di Tolak</span>';
                        }else{
                            echo '<span class="badge badge-danger">Pending</span>';
                        }
                    ?>
                <?php echo'
                </div>
                <div class="card-body">
                    <b>Judul Jurnal</b>
                    <p>'.$dataJurnal['judul'].'</p>
                    <HR>
                    <b>Uploaded</b>
                    <p>';
                    if(!empty($dataJurnal['posted_by2'])){
                        echo '1. '. $dataJurnal['posted_by'].'<br>2. '.$dataJurnal['posted_by2'];
                    }else{
                        echo $dataJurnal['posted_by'];
                    }
                    echo
                    '</p>
                    <hr>
                    <b>Tipe Jurnal</b>
                    <p>'.$dataJurnal['nama_tipe_jurnal'] .'</p>
                    <hr>
                    <b>Deskripsi</b>
                    <p><a href="#" type="button" data-toggle="modal" data-target="#deskripsiJ">Lihat Deskripsi</a></p>
                    <hr>
                    <b>Daftar Pustaka</b>
                    <p><a href="#" type="button" data-toggle="modal" data-target="#dafpusJ">Lihat Daftar Pustaka</a></p>
                </div>
            </div>
            <div class="modal fade" id="deskripsiJ" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Deskripsi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            '.$dataJurnal['deskripsi'].'
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="dafpusJ" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Deskripsi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            '.$dataJurnal['daftar_pustaka'].'
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    ';
}
?>