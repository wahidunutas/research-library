<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Admin</h1>
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
                $query = $koneksi->query("SELECT * FROM admin JOIN akses ON akses.id_admin=admin.id_admin WHERE jabatan LIKE '%$keyword%' OR nip LIKE '%$keyword%' OR nama LIKE '%$keyword%'");
            } else {
                $query = $koneksi->query("SELECT * FROM admin JOIN akses ON akses.id_admin=admin.id_admin WHERE role='admin' LIMIT $limitStart, $limit");
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
                            if ($data['jabatan'] == 'AdminDefault') {
                                echo '
                        <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detaildosen' . $data['id_admin'] . '"><i class="fas fa-info"></i></a>
                        ';
                            } else {
                                echo ' 
                        <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detaildosen' . $data['id_admin'] . '"><i class="fas fa-info"></i></a>
                        <a href="?p=dataadmin&aksi=updateadmin&id=' . $data['id_admin'] . '" class="btn btn-primary btn-sm"><i class="fas fa-user-edit"></i></a>
                        <a href="?p=dataadmin&act=del&id=' . $data['id_admin'] . '" class="btn btn-danger btn-sm btn-del"><i class="fas fa-trash"></i></a>';
                            }
                            ?>

                            <!-- <a href="?p=dataadmin&aksi=dtl_admin&id=<?= $data['id_admin']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-user-edit"></i></a>

                    <a href="?p=dosen&act=del&id=<?= $data['id_author']; ?>" class="btn btn-danger btn-sm btn-del"><i class="fas fa-trash"></i></a> -->


                        </td>
                    </tr>
                </tbody>
                <!-- Modal Detail Dosen-->
                <div class="modal fade" id="detaildosen<?= $data['id_admin']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                            <label>Nama
                                            </label>
                                            <p><?= $data['nama']; ?>

                                            </p>
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
                                            <label>Jabatan</label>
                                            <p><?= $data['jabatan']; ?></p>
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

                                        <input type="hidden" name="status" value="Dosen" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <?php
                                        if (!$data['profile']) {
                                            echo ' <img src="dist/img/no image.jpg" alt="" style="width:240px;" id="uploadPreviewDB">';
                                        } else {
                                            echo ' <img src="profile_admin/' . $data['profile'] . '" alt="" style="width:240px;" id="uploadPreviewDB">';
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
                <li class="page-item"><a class="page-link" href="?p=dosen&hal=<?php echo $LinkPrev; ?>">Previous</a></li>
            <?php } ?>

            <?php
            $SqlQuery = mysqli_query($koneksi, "SELECT * FROM author JOIN fakultas ON fakultas.id_fakultas=author.id_fakultas JOIN akses ON akses.id_author=author.id_author WHERE status='Dosen' ORDER BY author.id_author DESC");

            $JumlahData = mysqli_num_rows($SqlQuery);

            $jumlahPage = ceil($JumlahData / $limit);
            $jumlahNumber = 1;
            $startNumber = ($hal > $jumlahNumber) ? $hal - $jumlahNumber : 1;
            $endNumber = ($hal < ($jumlahPage - $jumlahNumber)) ? $hal + $jumlahNumber : $jumlahPage;

            for ($i = $startNumber; $i <= $endNumber; $i++) {
                $linkActive = ($hal == $i) ? ' class="active"' : '';
            ?>
                <li class="page-item" <?php echo $linkActive; ?>><a class="page-link" href="?p=dosen&hal=<?php echo $i; ?>"><?php echo $i; ?></a></li>
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
                <li class="page-item"><a class="page-link" href="?p=dosen&hal=<?php echo $linkNext; ?>">Next</a></li>
            <?php
            }
            ?>
        </ul>
    </div>
</div>

<?php
if (isset($_GET['id']) && isset($_GET['act'])) {

    $id = $_GET['id'];

    $koneksi->query("DELETE FROM admin WHERE id_admin = '$id'");
    $koneksi->query("DELETE FROM akses WHERE id_admin = '$id'");
    echo "<script>location='?p=dataadmin';</script>";
}
?>