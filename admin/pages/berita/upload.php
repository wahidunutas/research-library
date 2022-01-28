<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Berita</h1>
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
<div class="card">
    <div class="card-header"></div>
    <form action="" method="post">
        <div class="card-body">
            <div class="form-group">
                <label>Judul</label>
                <input type="text" class="form-control" name="judul" required>
            </div>
            <div class="form-group">
                <label>Isi Berita</label>
                <textarea class="ckeditor" id="ckedtor" name="isi" required></textarea>
            </div>
        </div>
        <div class="card-footer">

            <button type="submit" class="btn btn-primary btn-sm" name="save">Simpan</button>
            <a href="?p=berita" class="btn btn-danger btn-sm">Kembali</a>
        </div>
    </form>
</div>
<?php
if (isset($_POST['save'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tgl = date('Y-m-d');

    $koneksi->query("INSERT INTO berita(id_berita, judul_berita, isi_berita, tgl_upload)VALUE('', '$judul', '$isi', '$tgl')");
    echo "<script>
        Swal.fire(
            'Berita Berhasil Diupload',
            '',
            'success'
            )
            </script>";
    echo "<meta http-equiv='refresh' content='2;url=?p=berita'>";
}
