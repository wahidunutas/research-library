<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=">Home</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <?php
                $id = $_SESSION['login']['id_akses'];
                $sql = $koneksi->query("SELECT * FROM author JOIN fakultas ON author.id_fakultas=fakultas.id_fakultas JOIN akses ON author.id_author=akses.id_author WHERE akses.id_akses = '$id'");
                $profile = $sql->fetch_assoc();
                ?>
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <?php
                            if (!$profile['img']) {
                                echo ' <img class="profile-user-img img-fluid img-circle" src="../assets/dist/img/user.png" alt="User profile picture">';
                            } else {
                                echo '<img class="profile-user-img img-fluid img-circle" src="image_user/' . $profile['img'] . '" alt="User profile picture" style="width:105px;height:105px;">';
                            }
                            ?>
                        </div>
                        <h3 class="profile-username text-center"><?= $profile['nama']; ?></h3>

                        <p class="text-muted text-center"><?= $_SESSION['role']; ?></p>

                        <ul class="list-group list-group-unbordered mb-3">

                            <?php
                            if ($_SESSION['role'] == 'Mahasiswa') {
                                echo '
                            <li class="list-group-item">
                            <b>Jurusan</b> <a class="float-right">' . $profile['jurusan'] . '</a>
                            </li>';
                            } else {
                                echo '';
                            }
                            ?>

                            <li class="list-group-item">
                                <b>Nip</b> <a class="float-right"><?= $profile['nip']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Fakultas</b> <a class="float-right"><?= $profile['fakul']; ?></a>
                            </li>
                        </ul>

                        <a href="?page=profile" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
                    </div>
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Email</strong>
                        <p class="text-muted">
                            <?= $profile['email']; ?>
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                        <p class="text-muted"><?= $profile['alamat']; ?></p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> No Telepon</strong>
                        <p class="text-muted">
                            <?= $profile['no_telepon']; ?>
                        </p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity Terbaru</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <!-- Post -->
                                <?php
                                $id_auth = $_SESSION['login']['id_author'];
                                $hal = (isset($_GET['hal'])) ? (int) $_GET['hal'] : 1;
                                $limit = 3;
                                $limitStart = ($hal - 1) * $limit;
                                $sql = "SELECT * FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe WHERE dokumen.id_author='$id_auth' ORDER BY id_doc DESC LIMIT $limitStart,$limit";
                                $sql_run = mysqli_query($koneksi, $sql);
                                if (mysqli_num_rows($sql_run) > 0) {
                                    foreach ($sql_run as $data) {
                                        $abstrak = substr($data['abstrak'], 0, 150) . '..';
                                ?>
                                        <div class="post">
                                            <div class="user-block">
                                                <!-- <span class="username"> -->
                                                <a href="?page=data&act=detail&id=<?= $data['id_info_doc']; ?>"><?= $data['judul']; ?></a>
                                                <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                                <br>
                                                <!-- </span> -->
                                                <span class="deskripsi">Tanggal Upload - <?= $data['tgl_upload']; ?> | Status - <?= $data['status_doc']; ?> | Tipe - <?= $data['nama_tipe']; ?></span>
                                            </div>
                                            <!-- /.user-block -->
                                            <p>
                                                <?= $abstrak; ?> <a href="?page=data&act=detail&id=<?= $data['id_info_doc']; ?>">Selengkapnya</a>
                                            </p>
                                            <br>
                                            <p>
                                                <?php
                                                $id = $data['id_info_doc'];
                                                $jml = $koneksi->query("SELECT * FROM komentar JOIN info_doc ON info_doc.id_info_doc=komentar.id_info_doc WHERE komentar.id_info_doc='$id'");
                                                $jmlk = mysqli_num_rows($jml);?>
                                                <span class="float-right">
                                                    <a href="?page=data&act=detail&id=<?= $data['id_info_doc']; ?>&komen=komen" class="link-black text-sm" >
                                                        <i class="far fa-comments mr-1"></i> Comments (<?= $jmlk;?>)
                                                    </a>
                                                </span>
                                            </p>

                                        </div>

                                <?php
                                    }
                                } else {
                                    echo "Saat Ini Tidak Ada Activity";
                                }
                                ?>
                                <!-- /.post -->


                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>