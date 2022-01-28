<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Update Jurnal</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?p=jurnal">Home</a></li>
                    <li class="breadcrumb-item active"><?= $page; ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<?php
$id = $_GET['id'];
$sql = $koneksi->query("SELECT * FROM jurnal WHERE id_jurnal='$id'");
$data = $sql->fetch_assoc();
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" name="judul" value="<?= $data['judul']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea id="summernote" name="deskripsi" required><?= $data['deskripsi']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Link Jurnal</label>
                        <input type="text" class="form-control" name="link" required value="<?= $data['link']; ?>">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" name="save" type="submit">Simpan</button>
                    <a href="?p=jurnal" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                    <img src="pages/jurnal/cover/<?= $data['cover']; ?>" alt="" style="width:270px;" id="uploadPreviewDB">
                    <div class="form-group">
                        <label>Upload Cover</label>
                        <input type="file" class="form-control" id="uploadImageDB" onchange="PreviewImageDB();" name="cover">
                        <input type="hidden" class="form-control" value="<?= $data['cover']; ?>" name="cover_lama">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
if (isset($_POST['save'])) {
    $judul = $_POST['judul'];
    $desc = $_POST['deskripsi'];
    $link = $_POST['link'];

    $file = $_FILES['cover']['tmp_name'];
    $cover = $_FILES['cover']['name'];
    $cvr = $_POST['cover_lama'];

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $cover);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!empty($file)) {
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "
            <script>
            Swal.fire(
                'Opss!',
                'Pastikan Foto Yang Anda Upload Berekstensi JPG, JPEG, PNG',
                'error'
                )
            </script>
            ";
            return false;
        }
        move_uploaded_file($file, "pages/jurnal/cover/$cover");
        unlink("pages/jurnal/cover/$cvr");

        $koneksi->query("UPDATE jurnal SET 
            judul = '$judul',
            deskripsi    = '$desc',
            cover       = '$cover',
            link = '$link'
            WHERE id_jurnal = '$id'
        ");
    } else {
        $koneksi->query("UPDATE jurnal SET 
            judul = '$judul',
            deskripsi    = '$desc',
            cover       = '$cvr',
            link = '$link'
            WHERE id_jurnal = '$id'
        ");
    }
    echo "
        <script>
            Swal.fire(
                'Data Berhasil Diubah',
                '',
                'success'
            );
        </script>";
    echo "<meta http-equiv='refresh' content='2;url=?p=jurnal'>";
}
?>