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
            <div class="col">
                <div class="row">
                    <div class="col-md-7 ">
                        <?php
                        error_reporting(0);
                        $id = $_GET['id'];
                        $tahun = $_GET['tahun'];
                        $keyword = $_GET['keyword'];

                        $batas = 10;
                        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                        $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                        $previous = $halaman - 1;
                        $next = $halaman + 1;
                        $dataX = mysqli_query($koneksi, "SELECT * FROM jurnal JOIN tipe_jurnal ON jurnal.tipe_jurnal=tipe_jurnal.id_tipe_jurnal WHERE tipe_jurnal.id_tipe_jurnal ='$id'  ORDER BY id_jurnal DESC");
                        $jumlah_data = mysqli_num_rows($dataX);
                        $total_halaman = ceil($jumlah_data / $batas);

                        $data = $koneksi->query("SELECT * FROM jurnal JOIN tipe_jurnal ON jurnal.tipe_jurnal=tipe_jurnal.id_tipe_jurnal WHERE tipe_jurnal.id_tipe_jurnal ='$id' ORDER BY id_jurnal DESC LIMIT $halaman_awal,$batas");
                        ?>
                        <?php
                        if (mysqli_num_rows($data) > 0) {
                            $data1 = $data->fetch_assoc();
                            echo '<h5><a href="jurnal.php"><i class="fas fa-arrow-left"></i></a> ' . $data1['nama_tipe_jurnal'] . '</h5>';
                            foreach ($data as $value) {
                                $desc = substr($value['deskripsi'], 0, 200);
                        ?>
                                <div class="card mb-0 mt-1">
                                    <div class="card-body">
                                        <a href="index.php?p=bacajurnal&id=<?= $value['id_jurnal']; ?>"><b class="text-uppercase"><?= $value['judul']; ?></b></a><br>
                                        <span><small><?= $value['nama_tipe_jurnal']; ?> | <?= $value['tgl_upload_jurnal']; ?> |
                                                <?= $value['posted_by']; ?></small></span><br><br />
                                        <small><b>Deskripsi</small></b>
                                        <h6><?= $desc; ?> <a href="index.php?p=bacajurnal&id=<?= $value['id_jurnal']; ?>">[selengkapnya]</a></h6>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php
                        } else {
                            echo '
                             <div class="row">
                                <div class="col">
                                    <div class="alert alert-secondary alert-dismissible shadow">
                                    <a href="jurnal.php" type="button" class="close"  aria-hidden="true">&times;</a>
                                    <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                                    Data Yang Anda Cari Saat Ini Tidak Tersedia
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                        ?>
                        <ul class="pagination mt-2">
                            <li class="page-item">
                                <a class="page-link" <?php if ($halaman > 1) {
                                                            echo "href='?p=tipe-jurnal&id=$id&halaman=$Previous'";
                                                        } ?>>Previous</a>
                            </li>
                            <?php
                            for ($x = 1; $x <= $total_halaman; $x++) {
                            ?>
                                <li class="page-item"><a class="page-link" href="?p=tipe-jurnal&id=<?= $id; ?>&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                            <?php
                            }
                            ?>
                            <li class="page-item">
                                <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                            echo "href='?p=tipe-jurnal&id=$id&$tahun&halaman=$next'";
                                                        } ?>>Next</a>
                            </li>
                        </ul>
                    </div>
                    <!-- row col -->
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
                </div>
            </div>
            <!-- end col1 -->
        </div>
    </div>
</div>