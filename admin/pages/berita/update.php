<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Update Berita</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?p=berita">Home</a></li>
                    <li class="breadcrumb-item active"><?= $page; ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<?php
$id = $_GET['id'];
$sql = $koneksi->query("SELECT * FROM berita WHERE id_berita = '$id'");
$berita = $sql->fetch_assoc();
?>
<div class="card">
    <div class="card-header"></div>
    <form action="" method="post">
        <div class="card-body">
            <div class="form-group">
                <label>Judul</label>
                <input type="text" class="form-control" name="judul" value="<?= $berita['judul_berita']; ?>">
            </div>
            <div class="form-group">
                <label>Isi Berita</label>
                <textarea id="ckeditor" class="ckeditor" name="isi" required>
                <?= $berita['isi_berita']; ?>
            </textarea>
            </div>
        </div>
        <div class="card-footer">

            <button type="submit" class="btn btn-primary btn-sm" name="save">Update</button>
            <a href="?p=berita" class="btn btn-danger btn-sm">Kembali</a>
        </div>
    </form>
</div>
<?php
if (isset($_POST['save'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tgl = date('Y-m-d');

    $koneksi->query("UPDATE berita SET
    judul_berita = '$judul',
    isi_berita = '$isi'
    WHERE id_berita = '$id'");
    echo "<script>
        Swal.fire(
            'Berita Berhasil Diupdate',
            '',
            'success'
            )
            </script>";
    echo "<meta http-equiv='refresh' content='2;url=?p=berita'>";
}
