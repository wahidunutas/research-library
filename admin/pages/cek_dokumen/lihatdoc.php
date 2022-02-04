<?php
$id = $_GET['id'];
$jurnal = $_GET['jurnal'];
$sql = $koneksi->query("SELECT * FROM info_doc JOIN dokumen ON info_doc.id_info_doc=dokumen.id_info_doc JOIN author ON author.id_author=dokumen.id_author JOIN tipe ON tipe.id_tipe=info_doc.id_tipe JOIN fakultas ON fakultas.id_fakultas=info_doc.id_fakultas JOIN jurusan ON jurusan.id_jurusan=info_doc.id_jurusan  WHERE dokumen.id_info_doc = '$id'");
$data = $sql->fetch_assoc();

$jrnl = $koneksi->query("SELECT * FROM jurnal WHERE id_jurnal = '$jurnal'");
$datajurnal = $jrnl->fetch_assoc();

$datadoc = array();
$sql_doc = $koneksi->query("SELECT * FROM data_dokumen WHERE id_info_doc = '$id'");
while ($dft = $sql_doc->fetch_assoc()) {
    $datadoc[] = $dft;
}
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0">Detail <br>
                    <?php
                    if ($jurnal) {
                        echo '<h5 class="text-uppercase"><b>' . $datajurnal['judul'] . '</b></h5>';
                    } else {
                        echo '<h5 class="text-uppercase"><b>' . $data['judul'] . '</b></h5>';
                    }
                    ?>
                </h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<?php
if ($jurnal) {
    echo '
    <div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <label>Link Jurnal</label><br>
                <a href="' . $datajurnal['link'] . '" target="_BLANK">' . $datajurnal['link'] . '</a><hr>
                <label>File Jurnal</label><br>
                <a href="?p=dokumen&aksi=lihatpdf&jurnal=' . $datajurnal['id_jurnal'] . '"><img src="../pdf.png" alt="" style="width:30px"> ' . $datajurnal['name_file'] . '</a>
            </div>
            <div class="card-footer">
            <a href="?p=dokumen&aksi=seeall" class="btn btn-danger btn-sm">Kembali</a>
        </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>Judul</th>
                        <td>' . $datajurnal['judul'] . '</td>
                    </tr>
                    <tr>
                        <th>Posted By</th>
                        <td>';
                        if(!empty($datajurnal['posted_by2'] )){
                            echo '1. '.$datajurnal['posted_by'].'<br>2. '.$datajurnal['posted_by2'];
                        }else{
                            echo $datajurnal['posted_by'] ;
                        }
                        echo
                        '</td>
                    </tr>
                    <tr>
                        <th>Tanggal Upload</th>
                        <td>' . $datajurnal['tgl_upload_jurnal'] . '</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td><a href="#" type="button" data-toggle="modal" data-target="#deskripsi">Lihat Deskripsi</a></td>
                    </tr>
                    <tr>
                        <th>Daftar Pustaka</th>
                        <td><a href="#" type="button" data-toggle="modal" data-target="#dafpus">Lihat Daftar  Pustaka</a></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>' . $datajurnal['status_jurnal'] . '</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="modal fade" id="deskripsi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Deskripsi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ' . $datajurnal['deskripsi'] . '
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
                        ' . $datajurnal['daftar_pustaka'] . '
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    ';
} else {
    echo '
    <div class="card shadow">
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Nama Penulis</th>
                    <td>';
                    if(!empty($data['nama_penulis_2'])){
                        echo'1. '. $data['nama_penulis'].'<br>2. '.$data['nama_penulis_2'];
                    }else{
                        echo $data['nama_penulis'];
                    }
                    echo'
                    </td>
                </tr>
                <tr>
                    <th>Judul</th>
                    <td>' . $data['judul'] . '</td>
                </tr>
                <tr>
                    <th>Tipe</th>
                    <td>' . $data['nama_tipe'] . '</td>
                </tr>
                <tr>
                    <th>Fakultas</th>
                    <td>' . $data['fakul'] . ' > ' . $data['jur'] . '</td>
                </tr>
                <tr>
                    <th>Tanggal Upload</th>
                    <td>' . $data['tgl_upload'] . '</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><i>' . $data['status_doc'] . '</i>'; ?>
            <?php
            if ($data['status_doc'] == "Disetujui") {
                echo '| <b>Tanggal Acc</b>&nbsp;<i>' . $data['tgl_acc'] . '</i>';
            } else {
                echo '';
            }
            echo '
                            </td>
                        </tr>'; ?>
            <?php
            if (!empty($data['dospem'])) {
                echo '<tr><th>Dosen Pembimbing</th>
                                <td>1. ' . $data['dospem'] . ', <br>';
                if (!empty($data['dospem_2'])) {
                    echo '2.' . $data['dospem_2'];
                } else {
                    echo '';
                }
                '</td></tr><hr>';
            } else {
                echo '';
            }
            ?>
            <?php
            echo '
                <tr>
                    <th>Abstrak</th>
                    <td><a href="#" type="button" data-toggle="modal" data-target="#abstrak">Lihat Abstrak</a></td>
                </tr>
                <tr>
                    <th>Daftar Pustaka</th>
                    <td><a href="#" type="button" data-toggle="modal" data-target="#dafpuski">Lihat Daftar Pustaka</a></td>
                </tr>
            </table>
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
                            ' . $data['abstrak'] . '
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="dafpuski" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Daftar Pustaka</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ' . $data['dafpus'] . '
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
            <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                Lihat Files
            </a>
            <div class="collapse" id="collapseExample">
                <ul class="list-group list-group-flush">'; 
                $Fproject = $koneksi->query("SELECT * FROM data_file_project WHERE id_info_doc = '$id'");
                $dataProject = $Fproject->fetch_assoc();

                if(!empty($dataProject['file_database']) && !empty($dataProject['file_project']) ){
                    echo'
                    <a href="#" data-toggle="modal" data-target="#viewZip"> 
                        <li class="list-group-item">
                            <i class="fas fa-file-archive"></i> '.$dataProject['file_project'].'
                        </li>
                    </a>
                    <a href="#"> 
                    <li class="list-group-item">
                        <i class="fas fa-database"></i> '.$dataProject['file_database'].'
                    </li>
                    </a>';
                }elseif(!empty($dataProject['file_project']) && empty($dataProject['file_database'])){
                    echo'
                    <a href="#" data-toggle="modal" data-target="#viewZip"> 
                        <li class="list-group-item">
                            <i class="fas fa-file-archive"></i> '.$dataProject['file_project'].'
                        </li>
                    </a>';
                }elseif(empty($dataProject['file_project']) && !empty($dataProject['file_database'])){
                    echo'
                    <a href="#"> 
                    <li class="list-group-item">
                        <i class="fas fa-database"></i> '.$dataProject['file_database'].'
                    </li>
                    </a>';
                }else{
                    echo '';
                }
                ?>
                <?php foreach ($datadoc as $key => $value) : ?>
                    <a href="?p=dokumen&aksi=lihatpdf&id=<?= $value['id_data_dokumen']; ?>">
                        <li class="list-group-item"><i class="fas fa-angle-right"></i> <?= $value['files']; ?></li>
                    </a>
                <?php endforeach; ?>
                <?php echo '
                </ul>
                <!-- view Zip -->
                <div class="modal fade" id="viewZip" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">'.$dataProject['file_project'].'</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">';
                            $zips = new ZipArchive();
                            if ($zips->open('../user/dokumen/project/'.$dataProject['file_project']) === true) {
                                for ($i = 0; $i < $zips->numFiles; $i++) {
                                    echo '=> '.$zips->getNameIndex($i).'<br>';        
                                    
                                }
                            }
                        echo'
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="?p=dokumen&aksi=seeall" class="btn btn-danger btn-sm">Kembali</a>
        </div>
    </div>
    ';
}
