<?php
$id = $_SESSION['login']['id_author'];
$sql = $koneksi->query("SELECT * FROM author JOIN akses ON author.id_author=akses.id_author JOIN fakultas ON fakultas.id_fakultas=author.id_fakultas WHERE author.id_author='$id'");
$profile = $sql->fetch_assoc();

$data_fakl = array();
$fak = $koneksi->query("SELECT * FROM fakultas");
while ($fakultas = $fak->fetch_assoc()) {
    $data_fakl[] = $fakultas;
}

// $data_jur = array();
// $jur = $koneksi->query("SELECT * FROM jurusan");
// while ($jurusan = $jur->fetch_assoc()) {
//     $data_jur[] = $jurusan;
// }
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header p-2">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Basic</a></li>
            <li class="nav-item"><a class="nav-link" href="#login" data-toggle="tab">Login Akses</a></li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="post">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama" value="<?= $profile['nama']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Nip</label>
                                    <input type="text" class="form-control" name="nip" value="<?= $profile['nip']; ?>" readonly>
                                </div>


                                <div class="form-group">
                                    <label>Fakultas</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="fakultas" value="<?= $profile["fakul"]; ?>" readonly>
                                    </div>
                                </div>
                                <?php
                                if ($_SESSION['role'] == 'Mahasiswa') {
                                    echo '<div class="form-group">
                                    <label>Jurusan</label>
                                    <input type="text" class="form-control" name="jurusan" value="' . $profile["jurusan"] . '" readonly>                                   
                                    </div>'; ?>
                                <?php
                                } else {
                                    echo '';
                                }
                                ?>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="3"><?= $profile['alamat']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>No Telepon</label>
                                    <input type="text" class="form-control" name="no" value="<?= $profile['no_telepon']; ?>">
                                </div>
                                <!-- <button type="submit" name="save" class="btn btn-primary">Simpan</button> -->

                        </div>
                        <div class="col-md-6">
                            <?php
                            if (!$profile['img']) {
                                echo ' <img class="profile-user-img img-fluid img-circle img-prof" src="../assets/dist/img/user.png" alt="User profile picture" id="uploadPreviewDB">';
                            } else {
                                echo '<img class="profile-user-img img-fluid img-circle img-prof" src="image_user/' . $profile['img'] . '"  alt="User profile picture" id="uploadPreviewDB">';
                            }
                            ?>
                            <!-- <img class="profile-user-img img-fluid img-circle img-prof" src="dist/img/user.png" alt="" id="uploadPreviewDB"> -->
                            <input type="hidden" name="fotolama" value="<?= $profile['img']; ?>" />
                            <input type="file" class="form-control-foto" id="uploadImageDB" name="image" onchange="PreviewImageDB();">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="save" class="btn btn-primary">Simpan</button>
                </div>
                </form>
                <?php
                if (isset($_POST['save'])) {
                    $nama = $_POST['nama'];
                    $nip = $_POST['nip'];
                    $fak = $_POST['fakultas'];
                    $jrsn = $_POST['jurusan'];
                    $alamat = $_POST['alamat'];
                    $no = $_POST['no'];
                    $file = $_FILES['image']['tmp_name'];
                    $foto = $_FILES['image']['name'];
                    $foto_lama = $_POST['fotolama'];
                    if (!empty($file)) {
                        move_uploaded_file($file, "image_user/" . $foto);
                        unlink("image_user/$foto_lama");
                        $koneksi->query("UPDATE author SET
                                            nama       = '$nama',
                                            alamat     = '$alamat',
                                            no_telepon = '$no',
                                            img        = '$foto'
                                            WHERE id_author = '$id'");
                    } else {
                        $koneksi->query("UPDATE author SET
                                            nama       = '$nama',
                                            alamat     = '$alamat',
                                            no_telepon = '$no',
                                            img        = '$foto_lama'
                                            WHERE id_author = '$id'");
                    }
                    echo "<script>
                        Swal.fire(
                            'Data Profile Berhasil Di Update',
                            '',
                            'success'
                            )
                            </script>";
                    echo "<meta http-equiv='refresh' content='2;url=?page='>";
                }
                ?>
            </div>
            <div class="tab-pane" id="login">
                <div class="post">
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Nip</label>
                            <input type="text" class="form-control" name="nip" readonly value="<?= $profile['nip']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Password <span class="fas fa-eye" onclick="show()"></span></label>
                            <input type="password" class="form-control" name="pw" id="pswrd" value="<?= $profile['password']; ?>">

                        </div>
                        <button type="submit" name="saved" class="btn btn-primary">Simpan</button>
                    </form>
                    <?php
                    if (isset($_POST['saved'])) {
                        $koneksi->query("UPDATE akses SET
                        password = '$_POST[pw]'
                        WHERE id_author = '$id';
                        ");
                        echo "<script>Swal.fire('Password Berhasil Diubah','', 'success')</script>";
                        echo "<meta http-equiv='refresh' content='1;url=?p='>";
                    }
                    ?>
                </div>
            </div>

        </div>
        <!-- /.tab-content -->
    </div><!-- /.card-body -->
</div>