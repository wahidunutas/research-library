<div class="container">
    <div class="row mt-3">
        <div class="col-md-4">
            <ul class="list-group list-group-flush">
                <?php
                $sql = "SELECT * FROM berita ORDER BY id_berita DESC";
                $sql_run = mysqli_query($koneksi, $sql);

                if (mysqli_num_rows($sql_run) > 0) {
                    foreach ($sql_run as $value) { ?>
                        <li class="list-group-item"><a href="?p=berita&act=read&id=<?= $value['id_berita']; ?>"><i class="fas fa-angle-right"></i> <?= $value['judul_berita']; ?></a></li>
                <?php
                    }
                } else {
                    echo ' <div class="alert alert-warning alert-dismissible shadow">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                        Saat Ini Tidak Ada Informasi
                        </div>';
                }
                ?>
            </ul>
        </div>
        <div class="col-md-5 col-info">
            <h4><em>Gunakan opsi pencarian untuk menemukan dokumen dengan cepat</em></h4>
        </div>
    </div>
</div>