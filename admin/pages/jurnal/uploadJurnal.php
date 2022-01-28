<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Upload Jurnal</h1>
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
<form action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" name="judul" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea id="summernote" name="deskripsi" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Link Jurnal</label>
                        <input type="text" class="form-control" name="link" required>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="?p=jurnal" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                    <img src="../assets/dist/img/no image.jpg" alt="" style="width:270px;" id="uploadPreviewDB">
                    <div class="form-group">
                        <label>Upload Cover</label>
                        <input type="file" class="form-control" id="uploadImageDB" onchange="PreviewImageDB();" name="cover" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<?php
if (isset($_POST['simpan'])) {
    
    $a = $_SESSION['admin']['id_admin'];
    $b = $koneksi->query("SELECT * FROM admin WHERE id_admin = '$a'");
    $c = $b->fetch_assoc();
    $d = $c['nama'];
    var_dump($d);
    $judul = $_POST['judul'];
    $desc = $_POST['deskripsi'];
    $link = $_POST['link'];
    $tgl = date('Y-m-d');

    $cover = $_FILES['cover']['name'];
    $lokasicover = $_FILES['cover']['tmp_name'];
    move_uploaded_file($lokasicover, "pages/jurnal/cover/" . $cover);

    $koneksi->query("INSERT INTO jurnal(id_jurnal, judul, tgl_upload_jurnal, deskripsi, cover, link, posted_by, status)VALUES('', '$judul', '$tgl', '$desc', '$cover', '$link', '$d', 'Disetujui')");

    echo "
    <script>
    Swal.fire(
        'Data Berhasil Ditambahkan',
        '',
        'success'
    )
    </script>
    ";
    echo "<meta http-equiv='refresh' content='2;url=?p=jurnal'>";
}
?>