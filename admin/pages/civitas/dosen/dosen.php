<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Dosen</h1>
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
        <h3 class="card-title"><a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#dosen"><i class="fas fa-plus"></i>
                Daftarkan Dosen
            </a>
        </h3>

        <!-- Modal -->
        <div class="modal fade" id="dosen" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Daftar Dosen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" enctype="multipart/form-data" action="pages/civitas/dosen/daftarDosen.php">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Nama <small>Beserta Gelar</small></label>
                                        <input type="text" name="nama" class="form-control" placeholder="Enter Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label>NIP</label>
                                        <input type="text" name="nip" class="form-control" placeholder="Enter NIP" required>
                                    </div>
                                    <?php
                                    $data_fakl = array();
                                    $fak = $koneksi->query("SELECT * FROM fakultas");
                                    while ($fakultas = $fak->fetch_assoc()) {
                                        $data_fakl[] = $fakultas;
                                    }
                                    ?>
                                    <div class="form-group">
                                        <label>Fakultas</label>
                                        <select class="form-control" name="fakultas" required>
                                            <option>-Pilih-</option>
                                            <?php foreach ($data_fakl as $key => $value) : ?>
                                                <option value="<?= $value['id_fakultas']; ?>">
                                                    <?= $value['fakul']; ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                                    </div>
                                    <div class="form-group">
                                        <label>No Telepon</label>
                                        <input type="text" name="no" class="form-control" placeholder="08xx">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Alamat</label>
                                        <textarea name="alamat" class="form-control" rows="4"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Password</label>
                                        <input type="password" name="pw" class="form-control" placeholder="Enter Password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Ulangi Password</label>
                                        <input type="password" name="pw2" class="form-control" placeholder="Ulangi Password" required>
                                    </div>
                                    <input type="hidden" name="status" value="Dosen" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <img src="dist/img/no image.jpg" alt="" style="width:240px;" id="uploadPreviewDB">
                                    <small><em>*Kosongkan jika belum memiliki</em></small>
                                    <input type="file" class="form-control mt-3" id="uploadImageDB" name="image" onchange="PreviewImageDB();">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="daftar" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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
                $query = $koneksi->query("SELECT * FROM author JOIN fakultas ON fakultas.id_fakultas=author.id_fakultas JOIN akses ON author.id_author=akses.id_author WHERE author.nama LIKE '%$keyword%' OR akses.nip LIKE '%$keyword%' AND author.status='Dosen' ORDER BY author.id_author DESC");
            } else {
                $query = $koneksi->query("SELECT * FROM author JOIN fakultas ON fakultas.id_fakultas=author.id_fakultas JOIN akses ON akses.id_author=author.id_author WHERE status='Dosen' ORDER BY author.id_author DESC LIMIT $limitStart, $limit");
            }
            $nomer = 1;
            if(mysqli_num_rows($query) > 0) {
                foreach($query as $data){
            ?>
                <tbody>
                    <tr>
                        <td><?= $nomer; ?></td>
                        <td><?= $data['nama']; ?></td>
                        <td><?= $data['nip']; ?></td>
                        <td><?= $data['email']; ?></td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detaildosen<?= $data['id_author']; ?>"><i class="fas fa-eye"></i></a>

                            <a href="?p=dosen&aksi=updatedsn&id=<?= $data['id_author']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-user-edit"></i></a>

                            <a href="?p=dosen&act=del&id=<?= $data['id_author']; ?>" class="btn btn-danger btn-sm btn-del"><i class="fas fa-trash"></i></a>


                        </td>
                    </tr>
                </tbody>
                <!-- Modal Detail Dosen-->
                <div class="modal fade" id="detaildosen<?= $data['id_author']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                <small>
                                                    <?php if ($data['is_verif'] == 1) {
                                                        echo "Verifed";
                                                    } else {
                                                        echo "Non-Verifed";
                                                    }
                                                    ?>
                                                </small>
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
                                            <label>Fakultas</label>
                                            <p><?= $data['fakul']; ?></p>
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
                                        if (!$data['img']) {
                                            echo ' <img src="dist/img/no image.jpg" alt="" style="width:240px;" id="uploadPreviewDB">';
                                        } else {
                                            echo ' <img src="../user/image_user/' . $data['img'] . '" alt="" style="width:240px;" id="uploadPreviewDB">';
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
                <?php 
            }else{
                echo "<td>Tidak Ada Data</td>";
            } ?>
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

    $koneksi->query("DELETE FROM author WHERE id_author = '$id'");
    $koneksi->query("DELETE FROM akses WHERE id_author = '$id'");
    echo "<script>location='?p=dosen';</script>";
}
?>