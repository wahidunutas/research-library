<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Proses Dokumen</h1>
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
$id = $_GET['id'];
$sql = $koneksi->query("SELECT * FROM dokumen JOIN info_doc ON info_doc.id_info_doc=dokumen.id_info_doc JOIN author ON author.id_author=dokumen.id_author JOIN tipe ON tipe.id_tipe=info_doc.id_tipe JOIN fakultas ON fakultas.id_fakultas=info_doc.id_fakultas JOIN jurusan ON jurusan.id_jurusan=info_doc.id_jurusan WHERE dokumen.id_doc = '$id'");
$data = $sql->fetch_assoc();

$datadoc = array();
$sql_doc = $koneksi->query("SELECT * FROM data_dokumen WHERE id_info_doc = '$id'");
while ($dft = $sql_doc->fetch_assoc()) {
    $datadoc[] = $dft;
}

$sqlZip = $koneksi->query("SELECT * FROM data_file_project WHERE id_info_doc = '$id'");
$result = $sqlZip->fetch_assoc();
$Fzip = $result['file_project'];

// $datadoc = array();

?>
<div class="card shadow">
    <div class="card-body">
        <table class="table">
            <tr>
                <?php 
                if(!empty($data['nama_penulis'] )){
                    echo '<th>Nama Penulis</th>
                        <td>1. '.$data['nama_penulis'].'<br>';
                        if(!empty($data['nama_penulis_2'])){
                            echo'2. '.$data['nama_penulis_2'];
                        }else{
                            echo'';
                        }
                        '</td>';
                }else{
                    echo '';
                }
                ?> 
            </tr>
            <tr>
                <th>Judul</th>
                <td><?= $data['judul'];?></td>
            </tr>
            <tr>
                <th>Tipe</th>
                <td><?= $data['nama_tipe'];?></td>
            </tr>
            <tr>
                <th>Fakultas</th>
                <td><?= $data['fakul'];?> > <?= $data['jur'];?></td>
            </tr>
            <?php 
            if(!empty($data['dospem'] )){
                echo '<th>DOSEN PEMBIMBING</th>
                    <td>1. '.$data['dospem'].'<br>';
                    if(!empty($data['dospem_2'])){
                        echo'2. '.$data['dospem_2'];
                    }else{
                        echo'';
                    }
                    '</td>';
            }else{
                echo '';
            }
            ?>
            <tr>
                <th>Abstrak</th>
                <td><a href="#" type="button" data-toggle="modal" data-target="#pabs">Lihat Abstrak</a></td>
            </tr>
            <tr>
                <th>Daftar Pustaka</th>
                <td><a href="#" type="button" data-toggle="modal" data-target="#dafpus">Lihat Daftra Pustaka</a></td>
            </tr>
        </table>
        <div class="modal fade" id="pabs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Abstrak</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?= $data['abstrak'];?>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        <!-- ,modal daftar pustaka -->
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
                        <?= $data['dafpus'];?>
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
            <ul class="list-group list-group-flush">
            <a href="#" data-toggle="modal" data-target="#viewZip"><li class="list-group-item"><i class="fas fa-file-archive"></i>  <?= $result['file_project'];?></li></a>
            <!-- file database -->
            <?php
            if(!empty($result['file_database'])){
                echo'<a href="#"><li class="list-group-item"><i class="fas fa-database"></i> '.$result['file_database'].'</li></a>';
            }else{
                echo '';
            }
            ?>
            <?php foreach ($datadoc as $key => $value) : ?>
                <a href="?p=dokumen&aksi=lihatpdf&id=<?= $value['id_data_dokumen']; ?>">
                    <li class="list-group-item"><i class="fas fa-angle-right"></i> <?= $value['files']; ?></li>
                </a>
            <?php endforeach; ?>
            </ul>
        </div>
        <!-- view Zip -->
        <div class="modal fade" id="viewZip" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= $Fzip ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <?php   
                    $zips = new ZipArchive();
                    if ($zips->open('../user/dokumen/project/'.$Fzip) === true) {
                        for ($i = 0; $i < $zips->numFiles; $i++) {
                            echo '=> '.$zips->getNameIndex($i).'<br>';        
                            
                        }
                    }
                ?>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-header">Proses</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <form action="" method="post">
                <div class="form-group">
                    <label >Status</label>
                    <select class="form-control" name="status" required>
                        <option value="">-Pilih Status-</option>
                        <option value="Disetujui">Setujui</option>
                        <option value="Tidak Disetujui">Tolak</option>
                    </select>
                </div>
                <small><p>Cantumkan Notes Jika Dokumen Di Tolak</p></small>
                <div class="form-group">
                    <textarea class="form-control" name="note" rows="3"></textarea>
                </div>
                <button type="submit" name="proses" class="btn btn-primary btn-sm">Proses</button>
                <a href="?p=dokumen" class="btn btn-danger btn-sm">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($_POST['proses'])){
    $sts = $_POST['status'];
    $note = $_POST['note'];
    $admin = $_SESSION['admin']['id_admin'];
    $date = date("Y-m-d");
    if($sts == "Tidak Disetujui" && $note == ""){
        echo "
        <script>
        Swal.fire(
            '',
            'BERIKAN NOTES JIKA DOKUMEN DI TOLAK',
            'error'
        )
        </script>";
    }else{
        $koneksi->query("UPDATE dokumen SET
        status_doc = '$sts',
        id_admin = '$admin',
        notes = '$note',
        tgl_acc = '$date'
        WHERE id_doc = '$id'");
        echo "
        <script>
        Swal.fire(
            'Sukses',
            'Data Telah Diproses',
            'success'
        )
        </script>";
        echo"<meta http-equiv='refresh' content='2;url=?p=dokumen'>";

    }
}