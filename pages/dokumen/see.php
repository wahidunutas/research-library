<?php
$id = $_GET['id'];

$sql = $koneksi->query("SELECT * FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe JOIN fakultas ON fakultas.id_fakultas=info_doc.id_fakultas JOIN jurusan ON jurusan.id_jurusan=info_doc.id_jurusan JOIN admin ON admin.id_admin=dokumen.id_admin WHERE info_doc.id_info_doc='$id' ");
$run = $sql->fetch_assoc();
$dafpus = substr($run['dafpus'], 0, 400) . '...';

if(isset($id)){
    $idv = $id;
    $forview = $run['judul'];
    $views = $koneksi->query("SELECT * FROM views WHERE id_info_doc='$idv'");
    $Rviews = mysqli_num_rows($views);
    
    if($Rviews == 1){
        $koneksi->query("UPDATE views SET jml=jml+1 WHERE id_info_doc='$idv'");
    }else{
        $koneksi->query("INSERT INTO views(id_views, id_info_doc, id_jurnal, judul, jml)VALUES('', '$id', '', '$forview', jml+1)");
    }
}
// $koneksi->query("INSERT FROM views(id_views, id_info_doc, judul, jml)VALUE('', '$id', '', '')")

$hal = (isset($_GET['hal'])) ? (int) $_GET['hal'] : 1;
$limit = 2;
$limitStart = ($hal - 1) * $limit;

$datadoc = array();
$sql_doc = $koneksi->query("SELECT * FROM data_dokumen WHERE id_info_doc = '$id'");
while ($dft = $sql_doc->fetch_assoc()) {
    $datadoc[] = $dft;
}

$data = array();
$sql_not_se = $koneksi->query("SELECT * FROM data_dokumen WHERE id_info_doc = '$id' LIMIT $limitStart,$limit");
while ($not_login = $sql_not_se->fetch_assoc()) {
    $data[] = $not_login;
}

?>
<!-- <div class="container"> -->
<div class="row">
    <div class="col-md-9">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="text-uppercase" style="color:blue; text-align:center;"><?= $run['judul']; ?></h4>
                <!-- <span>
                        <small>
                            <?= $run['nama_penulis']; ?> | <?= $run['nama_tipe']; ?> | <?= $run['fakultas']; ?> | <?= $run['dospem']; ?> | <?= $run['tgl_upload']; ?>
                        </small>
                    </span> -->
                <hr>
                <h5><b>Abstrak</b></h5>
                <p><?= $run['abstrak']; ?></p>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <h5><b>Daftar Pustaka</b></h5>
                <hr>
                <p><?= $dafpus; ?> <a href="#" data-toggle="modal" data-target="#dafpus">[Tampilkan Semua Daftar Pustaka]</a></p>
                <div class="modal fade" id="dafpus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Daftar Pustaka</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><?= $run['dafpus']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header"><i class="fas fa-info"></i> Information</div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Author</th>
                                    <td><?= $run['nama_penulis']; ?></td>
                                </tr>
                                <tr>
                                    <th>Type</th>
                                    <td><?= $run['nama_tipe']; ?></td>
                                </tr>
                                <tr>
                                    <th>Fakultas</th>
                                    <td><?= $run['fakul']; ?></td>
                                </tr>
                                <tr>
                                    <th>Jurusan</th>
                                    <td><?= $run['jur']; ?></td>
                                </tr>
                                <?php
                                if (!empty($run['dospem'])) {
                                    echo '<tr><th>Pembimbing</th>
                                            <td>1. ' . $run['dospem'] . ', <br>';
                                    if (!empty($run['dospem_2'])) {
                                        echo '2. ' . $run['dospem_2'];
                                    } else {
                                        echo '';
                                    }
                                    '</td></tr>';
                                } else {
                                    echo '';
                                }
                                ?>
                                <tr>
                                    <th>Tgl Upload</th>
                                    <td><?= $run['tgl_upload']; ?></td>
                                </tr>
                                <tr>
                                    <th>Depositing user</th>
                                    <td><?= $run['nama']; ?></td>
                                </tr>
                                <tr>
                                    <th>Di Proses</th>
                                    <td><?= $run['tgl_acc']; ?></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="icons">
                    <?php
                    $sql_c = $koneksi->query("SELECT * FROM komentar WHERE id_info_doc ='$id'");
                    $komen = $sql_c->num_rows;
                    ?>

                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <i class="far fa-comment icn ml-4"></i><span><?= $komen; ?> Komentar</span>
                    </a>
                </div>
                <!-- incon komentar -->
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <!-- KOMENTAR -->
                        <?php
                        $sql_komentar = "SELECT * FROM komentar JOIN author ON author.id_author=komentar.id_author JOIN info_doc ON komentar.id_info_doc=info_doc.id_info_doc WHERE info_doc.id_info_doc='$id' ORDER BY komentar.id_komen DESC";
                        $sql_run = mysqli_query($koneksi, $sql_komentar);
                        if (mysqli_num_rows($sql_run) > 0) {
                            foreach ($sql_run as $cmt) { ?>

                                <blockquote class="quote-secondary mb-0 mt-1">
                                    <div class="text-capitalize"><?= $cmt['nama']; ?> <cite title="Source Title"></cite></div>
                                    <div><?= $cmt['isi_komentar']; ?></div>
                                </blockquote>

                        <?php }
                        } else {
                            echo "<span class='text-muted'>Saat ini Tidak Ada Komentar</span>";
                        }
                        ?>
                        <hr>
                        <!-- BOX KOMENTAR -->
                        <p>Tulis Komentar</p>
                        <form action="" method="post">
                            <div class="form-group">
                                <textarea class="form-control" name="komentar" rows="3" placeholder="Ketikan Komenetar Anda Disini"></textarea>
                                <button class="btn btn-primary btn-sm mt-1" name="kirim" type="submit">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col">
                <ul class="list-group shadow mb-3">
                    <?php if (!isset($_SESSION['login']) && !isset($_SESSION['admin'])) { ?>
                        <blockquote class="quote-secondary">
                            <p><a href="?p=masuk">Login</a> untuk mengakses semua file</p>
                        </blockquote>

                        <li class="list-group-item "><button id="tombol"><img src="pdf.png" style="width:40px"> View Items <i class="fas fa-search"></i></button></li>

                    <?php } else { ?>
                        <li class="list-group-item "><i class="fas fa-file-pdf"></i> FILES</li>
                        <?php foreach ($datadoc as $value) { ?>
                            <a href="pdf.php?id=<?= $value['id_data_dokumen']; ?>" target="_BLANK">
                                <li class="list-group-item"><img src="pdf.png" style="width:30px"> <?= $value['files']; ?>
                            </a> |
                            <a href="pages/dokumen/download.php?filename=<?= $value['files']; ?>&id=<?= $value['id_info_doc']; ?>&named=<?= $value['named_file']; ?>&judul=<?= $run['judul']; ?>"><i class="fas fa-download"></i> Download </a></li>
                        <?php } ?>
                    <?php } ?>
                </ul>

            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow">
            <div class="card-body">
                <form action="karya-ilmiah.php" method="get" class="form-inline my-4 my-lg-0">
                    <input class="form-control mr-sm-1" style="width:83%" type="search" placeholder="Search" name="keyword" aria-label="Search">
                    <button class="btn btn-primary my-2 my-sm-0" name="cari" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-header">Paling Banyak Didownload</div>
            <div class="card-body">
                <!-- <ul> -->
                <?php
                $sql_don = $koneksi->query("SELECT id_info_doc, id_jurnal, judul, sum(jml) as jml FROM downloads GROUP BY id ORDER BY jml DESC");
                while ($top = $sql_don->fetch_assoc()) {
                    $jdl = substr($top['judul'], 0, 40) . '..';
                    echo '
                            <li class="text-capitalize"> <i class="fas fa-angle-right"></i>';
                    if ($top['id_jurnal'] == 0) {
                        echo ' <a href="index.php?p=dokumen&id=' . $top['id_info_doc'] . '">' . $jdl . ' (' . $top['jml'] . ')</a>';
                    } elseif ($top['id_info_doc'] == 0) {
                        echo '
                                 <a href="index.php?p=bacajurnal&id=' . $top['id_jurnal'] . '">' . $jdl . ' (' . $top['jml'] . ')</a>
                                ';
                    }
                    echo '
                            </li>
                            ';
                } ?>
                <!-- </ul> -->
            </div>
        </div>
        <div class="card shadow mt-4">
            <div class="card-header">Paling Banyak Dibaca</div>
            <div class="card-body">
                <?php 
                $sql_don = $koneksi->query("SELECT id_info_doc, id_jurnal, judul, sum(jml) as jml FROM views GROUP BY id_views ORDER BY jml DESC");
                while($top = $sql_don->fetch_assoc()){
                    $jdl = substr($top['judul'], 0, 40).'...';
                    echo'
                    <li class="text-capitalize"> <i class="fas fa-angle-right"></i>'; 
                    if($top['id_jurnal'] == 0){
                        echo' <a href="index.php?p=dokumen&id='.$top['id_info_doc'].'">'.$jdl.'</a>';
                    }elseif($top['id_info_doc'] == 0){
                        echo'
                            <a href="index.php?p=bacajurnal&id='.$top['id_jurnal'].'">'.$jdl.'</a>
                        ';
                    }
                    echo'
                    </li>
                    ';
                }
            
                ?>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-header">
                Tahun
            </div>
            <div class="card-body">
                <?php
                $qry = mysqli_query($koneksi, "SELECT tgl_upload, count(tgl_upload) as jml FROM dokumen  WHERE status_doc='Disetujui' GROUP BY year(tgl_upload)");
                while ($t = mysqli_fetch_array($qry)) {
                    $data = explode('-', $t['tgl_upload']);
                    $tahun = $data[0];
                ?>
                    <li><i class="fas fa-angle-right"></i> <a href="karya-ilmiah.php?tahun=<?= $tahun; ?>"><?= $tahun; ?></a> (<?= $t['jml']; ?>)</li>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="card shadow mt-4">
            <div class="card-header">Tautan</div>
            <div class="card-body">
                <a href="https://trilogi.ac.id/universitas/" target="_BLANK">Universitas Trilogi</a>
            </div>
        </div>
    </div>
</div>
<!-- </div> -->

<?php
if (isset($_POST['kirim'])) {
    if (!isset($_SESSION['login'])) {
        echo "
        <script>
            Swal.fire(
                'Anda Harus Login',
                'Untuk Memberikan Komentar',
                'error'
            );
        </script>";
    } else {
        $komen = $_POST['komentar'];
        $tgl = date("Y-m-d");
        $idA = $_SESSION['login']['id_author'];

        $koneksi->query("INSERT INTO komentar(id_komen, id_info_doc, id_author, isi_komentar, tgl_komentar)VALUES('', '$id', '$idA', '$komen', '$tgl')");

        echo "
        <script>
            Swal.fire(
                'Komentar Anda Telah Terkirim',
                '',
                'success'
            );
        </script>
        ";
        echo "<meta http-equiv='refresh' content='1;url=?p=dokumen&act=see&id=$id'>";
    }
}
?>
<script>
    const tombol = document.querySelector('#tombol');
    tombol.addEventListener('click', function() {
        Swal.fire({
            title: 'Silahkan Login',
            text: "Anda Belum Login, Silahkan Login Untuk Mengakses File",
            icon: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Login'
        }).then((result) => {
            if (result.value) {
                document.location.href = '?p=masuk'
            }
        })
    })
</script>