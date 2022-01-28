<?php
$id = $_GET['id'];
$sql = $koneksi->query("SELECT * FROM berita WHERE id_berita = '$id'");
$berita = $sql->fetch_assoc();
?>
<div class="container">
    <div class="media">
        <div class="media-body mb-5">
            <h1 class="mt-0"><?= $berita['judul_berita']; ?></h1>
            <small><em><?= $berita['tgl_upload']; ?></em></small>
            <p><?= $berita['isi_berita']; ?></p>
        </div>
    </div>

</div>