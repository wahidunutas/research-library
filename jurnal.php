<?php include "template/template2/header.php"; ?>
<div class="content">
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <!-- SEARCH -->
                        <form class="form-inline my-2 my-lg-0" method="get" action="">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
                        </form>
                        <hr>
                        <!-- TAHUN -->
                        <form action="jurnal.php" method="get">
                            <div class="row">
                                <div class="col">
                                    <select name="tahun" class="form-control form-control-sm">
                                        <option value="">-Select Tahun-</option>
                                        <?php
                                        $mulai = date('Y') - 25;
                                        for ($i = $mulai; $i < $mulai + 50; $i++) {
                                            $sel = $i == date('Y') ?: '';
                                            echo '<option value="' . $i . '"' . $sel . '>' . $i . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary btn-sm" type="submit">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card shadow mt-4">
                    <div class="card-header">Tautan</div>
                    <div class="card-body">
                        <a href="https://trilogi.ac.id/universitas/" target="_BLANK">Universitas Trilogi</a>
                    </div>
                </div>
            </div>
            <!-- col1 -->
            <div class="col-md-6">
                <?php
                error_reporting(0);
                $tahun = $_GET['tahun'];
                $keyword = $_GET['keyword'];

                $batas = 10;
                $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                $previous = $halaman - 1;
                $next = $halaman + 1;


                ?>

                <?php
                if ($tahun) {
                    $data = mysqli_query($koneksi, "SELECT * FROM jurnal WHERE DATE_FORMAT(tgl_upload_jurnal, '%Y')='$tahun'");
                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data / $batas);
                    $sql_thn = "SELECT * FROM jurnal JOIN tipe_jurnal ON jurnal.tipe_jurnal=tipe_jurnal.id_tipe_jurnal WHERE DATE_FORMAT(tgl_upload_jurnal, '%Y')='$tahun' AND status_jurnal='Disetujui' ORDER BY jurnal.id_jurnal DESC LIMIT $halaman_awal,$batas";
                    $sql_thn_run = mysqli_query($koneksi, $sql_thn);

                    if (mysqli_num_rows($sql_thn_run) > 0) { ?>
                        <?php
                        echo '
                        <h5><a href="jurnal.php"><i class="fas fa-arrow-left"></i></a> Jurnal Tahun ' . $tahun . '</h5><hr>';
                        foreach ($sql_thn_run as $thn) {
                            $abstrak = substr($thn['deskripsi'], 0, 170);
                        ?>
                            <div class="card">
                                <div class="card-body">
                                    <a href="index.php?p=bacajurnal&id=<?= $thn['id_jurnal']; ?>"><b class="text-uppercase"><?= $thn['judul']; ?></b></a><br>
                                    <span><small><?= $thn['nama_tipe_jurnal']; ?> | <?= $thn['tgl_upload_jurnal']; ?> |
                                            <?= $thn['posted_by']; ?></small></span>
                                    <p><?= $abstrak; ?> <a href="index.php?p=bacajurnal&id=<?= $thn['id_jurnal']; ?>">[selengkapnya]</a></p>

                                </div>
                            </div>
                        <?php } ?>
                        <ul class="pagination ">
                            <li class="page-item">
                                <a class="page-link" <?php if ($halaman > 1) {
                                                            echo "href='?tahun=$tahun&halaman=$Previous'";
                                                        } ?>>Previous</a>
                            </li>
                            <?php
                            for ($x = 1; $x <= $total_halaman; $x++) {
                            ?>
                                <li class="page-item"><a class="page-link" href="?tahun=<?= $tahun; ?>&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                            <?php
                            }
                            ?>
                            <li class="page-item">
                                <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                            echo "href='?tahun=$tahun&halaman=$next'";
                                                        } ?>>Next</a>
                            </li>
                        </ul>
                    <?php
                    } else {
                        echo '
                        <div class="row">
                            <div class="col">
                                <div class="alert alert-warning alert-dismissible shadow">
                                <a href="jurnal.php" type="button" class="close"  aria-hidden="true">&times;</a>
                                <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                                Data Jurnal Tahun ' . $tahun . ' Saat Ini Tidak Tersedia
                                </div>
                            </div>
                        </div>';
                    }
                } elseif ($keyword) {
                    $data = mysqli_query($koneksi, "SELECT * FROM jurnal JOIN tipe_jurnal ON jurnal.tipe_jurnal=tipe_jurnal.id_tipe_jurnal WHERE jurnal.judul LIKE '%$keyword%' AND jurnal.status_jurnal='Disetujui'");
                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data / $batas);
                    $sql_key = "SELECT * FROM jurnal JOIN tipe_jurnal ON jurnal.tipe_jurnal=tipe_jurnal.id_tipe_jurnal WHERE jurnal.judul LIKE '%$keyword%' AND jurnal.status_jurnal='Disetujui' ORDER BY jurnal.id_jurnal DESC LIMIT $halaman_awal,$batas";
                    $sql_run_key = mysqli_query($koneksi, $sql_key);

                    if (mysqli_num_rows($sql_run_key) > 0) { ?>
                        <?php
                        echo '
                        <h5><a href="jurnal.php"><i class="fas fa-arrow-left"></i></a> Pencarian ' . $keyword . '</h5><hr>';
                        foreach ($sql_run_key as $data) {
                            $abstrak = substr($data['deskripsi'], 0, 170);
                        ?>
                            <div class="card">
                                <div class="card-body">
                                    <a href="index.php?p=bacajurnal&id=<?= $data['id_jurnal']; ?>"><b class="text-uppercase"><?= $data['judul']; ?></b></a><br>
                                    <span><small><?= $data['nama_tipe_jurnal']; ?> | <?= $data['tgl_upload_jurnal']; ?> |
                                            <?= $data['posted_by']; ?></small></span>
                                    <p><?= $abstrak; ?> <a href="index.php?p=bacajurnal&id=<?= $data['id_jurnal']; ?>">[selengkapnya]</a></p>

                                </div>
                            </div>
                        <?php
                        } ?>
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" <?php if ($halaman > 1) {
                                                            echo "href='?keyword=$keyword&halaman=$Previous'";
                                                        } ?>>Previous</a>
                            </li>
                            <?php
                            for ($x = 1; $x <= $total_halaman; $x++) {
                            ?>
                                <li class="page-item"><a class="page-link" href="?keyword=<?= $keyword; ?>&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                            <?php
                            }
                            ?>
                            <li class="page-item">
                                <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                            echo "href='?keyword=$keyword&halaman=$next'";
                                                        } ?>>Next</a>
                            </li>
                        </ul>
                    <?php
                    } else {
                        echo '
                            <div class="row">
                            <div class="col">
                                <div class="alert alert-warning alert-dismissible shadow">
                                <a href="jurnal.php" type="button" class="close"  aria-hidden="true">&times;</a>
                                <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                                Data Yang Anda Cari Saat Ini Tidak Tersedia
                                </div>
                            </div>
                            </div>';
                    }
                } else {
                    echo '
                    <ul class="list-group list-group-flush shadow">
                        <li class="list-group-item"><h5 class="text-center">KATEGORI JURNAL</h5></li>'; ?>
                    <?php
                    $sqltp = $koneksi->query("SELECT * FROM tipe_jurnal");
                    while ($tpj = $sqltp->fetch_assoc()) {
                        echo '
                                <li class="list-group-item"><a href="index.php?p=tipe-jurnal&id=' . $tpj['id_tipe_jurnal'] . '">' . $tpj['nama_tipe_jurnal'] . $jml . '</a></li>
                                ';
                    }
                    ?>
                <?php echo '
                    </ul>';
                }
                ?>

            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">Karya Ilmiah Terbaru</div>
                    <div class="card-body">
                        <?php
                        $hal = (isset($_GET['hal'])) ? (int) $_GET['hal'] : 1;
                        $limit = 5;
                        $limitStart = ($hal - 1) * $limit;
                        $ki = $koneksi->query("SELECT * FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE dokumen.status_doc='Disetujui' ORDER BY dokumen.id_doc DESC LIMIT $limitStart,$limit");
                        while ($kidata = $ki->fetch_assoc()) {
                        ?>
                            <li><a href="index.php?p=dokumen&id=<?= $kidata['id_info_doc']; ?>" class="karya-ilmiah-jurnal text-capitalize"><i class="fas fa-angle-right"></i> <?= $kidata['judul']; ?></li></a>

                        <?php } ?>
                    </div>
                </div>
            </div>
            <!-- end col1 -->
        </div>
    </div>
</div>
</div>



<?php include "template/template2/footer.php"; ?>