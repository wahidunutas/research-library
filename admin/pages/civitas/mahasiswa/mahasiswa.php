<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Mahasiswa</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active"><?= $page; ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data
        </h3>


        <div class="card-tools">

            <form method="post">
                <div class="input-group input-group-sm" style="width: 180px;">
                    <input type="text" name="keyword" class="form-control float-right" placeholder="Search Keyword" required>

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default" name="cari">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nip</th>
                    <th>Email</th>
                    <th>Tools</th>
                </tr>
            </thead>
            <?php

            $hal = (isset($_GET['hal'])) ? (int) $_GET['hal'] : 1;
            $limit = 10;
            $limitStart = ($hal - 1) * $limit;
            if (isset($_POST['cari'])) {
                $keyword = $_POST['keyword'];
                $no = $limitStart + 1;
                $query = $koneksi->query("SELECT * FROM akses JOIN author ON akses.id_author=author.id_author JOIN fakultas ON fakultas.id_fakultas=author.id_fakultas WHERE author.nama LIKE '%$keyword%' OR akses.nip LIKE '%$keyword%' AND  author.status='Mahasiswa' ORDER BY author.id_author DESC");
            } else {
                $query = $koneksi->query("SELECT * FROM akses JOIN author ON akses.id_author=author.id_author JOIN fakultas ON fakultas.id_fakultas=author.id_fakultas  WHERE author.status='Mahasiswa' ORDER BY author.id_author DESC LIMIT $limitStart, $limit");
            }
            $nomer = 1;
            while ($data = $query->fetch_assoc()) {
            ?>
                <tbody>
                    <tr>
                        <td><?= $nomer; ?></td>
                        <td><?= $data['nama']; ?></td>
                        <td><?= $data['nip']; ?></td>
                        <td><?= $data['email']; ?></td>
                        <td>
                            <?php
                            if($data['is_confirm'] !== '1'){
                                echo'
                                <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailmhs'.$data['id_author'].'"><i class="fas fa-eye"></i></a>
                                ';
                            }else{
                                echo'
                                    <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailmhs'.$data['id_author'].'"><i class="fas fa-eye"></i></a>
                                    <a href="?p=mahasiswa&aksi=updatemhs&id='.$data['id_author'].'" class="btn btn-primary btn-sm"><i class="fas fa-user-edit"></i></a>
        
                                    <a href="?p=mahasiswa&act=del&id='.$data['id_author'].'" class="btn btn-danger btn-sm btn-del"><i class="fas fa-trash"></i></a>
                                ';
                            }
                            ?>
                        </td>
                    </tr>
                </tbody>
                <!-- Modal Update mahasiswa-->
                <div class="modal fade" id="detailmhs<?= $data['id_author']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Detail</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Nama <small>
                                                    <?php if ($data['is_verif'] == 1) {
                                                        echo "Verifed";
                                                    } else {
                                                        echo "Non-Verifed";
                                                    }
                                                    ?>
                                                </small></label>
                                            <p><?= $data['nama']; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>NIP</label>
                                            <p><?= $data['nip']; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <p><?= $data['email']; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Fakultas</label>
                                            <p><?= $data['fakul']; ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Jurusan</label>
                                            <p><?= $data['jurusan']; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>No Telepon</label>
                                            <p><?= $data['no_telepon']; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Alamat</label>
                                            <p><?= $data['alamat']; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <?php
                                        if (!$data['img']) {
                                            echo ' <img src="dist/img/no image.jpg" alt="" style="width:240px;" id="uploadPreviewDB">';
                                        } else {
                                            echo ' <img src="../user/image_user/' . $data['img'] . '" alt="" style="width:240px;" id="uploadPreviewDB">';
                                        }

                                        if($data['is_confirm'] !== '1'){
                                            echo '
                                            <a href="../pages/daftar/daftarProses.php?idConfirm='.$data['id_akses'].'" class="btn btn-primary">Confirmasi</a>
                                            ';
                                        }else{
                                            echo'';
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $nomer++; ?>
            <?php } ?>
        </table>
    </div>
    <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-right">
            <?php
            if ($hal == 1) {
            ?>
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <?php
            } else {
                $LinkPrev = ($hal > 1) ? $hal - 1 : 1;
            ?>
                <li class="page-item"><a class="page-link" href="?p=mahasiswa&hal=<?php echo $LinkPrev; ?>">Previous</a></li>
            <?php } ?>

            <?php
            $SqlQuery = mysqli_query($koneksi, "SELECT * FROM author WHERE status='mahasiswa' ORDER BY id_author DESC ");

            $JumlahData = mysqli_num_rows($SqlQuery);

            $jumlahPage = ceil($JumlahData / $limit);
            $jumlahNumber = 1;
            $startNumber = ($hal > $jumlahNumber) ? $hal - $jumlahNumber : 1;
            $endNumber = ($hal < ($jumlahPage - $jumlahNumber)) ? $hal + $jumlahNumber : $jumlahPage;

            for ($i = $startNumber; $i <= $endNumber; $i++) {
                $linkActive = ($hal == $i) ? ' class="active"' : '';
            ?>
                <li class="page-item" <?php echo $linkActive; ?>><a class="page-link" href="?p=mahasiswa&hal=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php
            }
            ?>

            <!-- link Next Page -->
            <?php
            if ($hal == $jumlahPage) {
            ?>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            <?php
            } else {
                $linkNext = ($hal < $jumlahPage) ? $hal + 1 : $jumlahPage;
            ?>
                <li class="page-item"><a class="page-link" href="?p=mahasiswa&hal=<?php echo $linkNext; ?>">Next</a></li>
            <?php
            }
            ?>
        </ul>
    </div>
</div>

<?php
if (isset($_GET['id']) && isset($_GET['act'])) {

    $id = $_GET['id'];

    $koneksi->query("DELETE FROM author WHERE id_author = '$id'");
    $koneksi->query("DELETE FROM akses WHERE id_author = '$id'");
    echo "<script>location='?p=mahasiswa';</script>";
}
?>