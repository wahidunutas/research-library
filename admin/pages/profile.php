<?php
$id = $_SESSION['admin']['id_admin'];
$sql = $koneksi->query("SELECT * FROM admin JOIN akses ON admin.id_admin=akses.id_admin WHERE admin.id_admin='$id'");
$profile = $sql->fetch_assoc();

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
                                <input type="text" class="form-control" name="nama" value="<?= $profile['nama'];?>">
                            </div>
                            <div class="form-group">
                                <label>Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" value="<?= $profile['jabatan'];?>">
                            </div>
                            <div class="form-group">
                                <label>Nip</label>
                                <input type="text" class="form-control" name="nip" value="<?= $profile['nip'];?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="3"><?= $profile['alamat'];?></textarea>
                            </div>
                            <div class="form-group">
                                <label>No Telepon</label>
                                <input type="text" class="form-control" name="no" value="<?= $profile['no_telepon'];?>">
                            </div>
                            <!-- <button type="submit" name="save" class="btn btn-primary">Simpan</button> -->

                        </div>
                        <div class="col-md-6">
                            <?php
                                if(!$profile['profile']){
                                    echo' <img class="profile-user-img img-fluid img-circle img-prof" src="../assets/dist/img/user.png" alt="User profile picture" id="uploadPreviewDB">';
                                }else{
                                    echo '<img class="profile-user-img img-fluid img-circle img-prof" src="profile_admin/'.$profile['profile'].'"  alt="User profile picture" id="uploadPreviewDB">';
                                }
                            ?>
                            <!-- <img class="profile-user-img img-fluid img-circle img-prof" src="dist/img/user.png" alt="" id="uploadPreviewDB"> -->
                            <input type="hidden" name="fotolama" value="<?= $profile['profile'];?>"/>
                            <input type="file" class="form-control-foto" id="uploadImageDB" name="image" onchange="PreviewImageDB();">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="save" class="btn btn-primary">Simpan</button>
                </div>
            </form>
                <?php
                    if(isset($_POST['save'])){
                        $nama = $_POST['nama'];
                        $alamat = $_POST['alamat'];
                        $jabatan = $_POST['jabatan'];
                        $no = $_POST['no'];
                        $file = $_FILES['image']['tmp_name'];
                        $foto = $_FILES['image']['name'];
                        $foto_lama = $_POST['fotolama'];
                        if(!empty($file))
                        {
                            move_uploaded_file($file, "profile_admin/".$foto);
                            unlink("profile_admin/$foto_lama"); 
                            $koneksi->query("UPDATE admin SET
                                            nama       = '$nama',
                                            jabatan    = '$jabatan',
                                            alamat     = '$alamat',
                                            no_telepon = '$no',
                                            profile        = '$foto'
                                            WHERE id_admin = '$id'");
                        }else{
                            $koneksi->query("UPDATE admin SET
                                            nama       = '$nama',
                                            jabatan    = '$jabatan',
                                            alamat     = '$alamat',
                                            no_telepon = '$no',
                                            profile        = '$foto_lama'
                                            WHERE id_admin = '$id'");
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
                            <input type="text" class="form-control" name="nip" readonly value="<?= $profile['nip'];?>">
                        </div>
                        <div class="form-group">
                            <label>Password <span class="fas fa-eye" onclick="show()"></span></label>
                            <input type="password" class="form-control" name="pw" id="pswrd" value="<?= $profile['password'];?>">
                            
                        </div>
                        <button type="submit" name="saved" class="btn btn-primary">Simpan</button>
                    </form>
                    <?php
                    if(isset($_POST['saved'])){
                        $koneksi->query("UPDATE akses SET
                        password = '$_POST[pw]'
                        WHERE id_admin = '$id';
                        ");
                        echo"<script>Swal.fire('Password Berhasil Diubah','', 'success')</script>";
                        echo"<meta http-equiv='refresh' content='2;url=?p='>";
                    }
                    ?>
                </div>
            </div>

        </div>
        <!-- /.tab-content -->
    </div><!-- /.card-body -->
</div>