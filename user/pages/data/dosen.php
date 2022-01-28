<div class="tab-content" id="custom-tabs-one-tabContent">
            <div class="tab-pane fade show active" id="home-pending" role="tabpanel" aria-labelledby="pending">
                <ul class="nav nav-tabs" id="tabs-isi" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#magang-tabs" role="tab" aria-controls="magang-tabs" aria-selected="false">Laporan Penelitian </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#skripsi-tabs" role="tab" aria-controls="skripsi-tabs" aria-selected="false">Jurnal </a>
                    </li>
                </ul>
                <div class="tab-content" id="tabs-isiContent">
                    <div class="tab-pane fade show active" id="magang-tabs" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Tipe</th>
                                    <th>Tanggal Upload</th>
                                    <th>Status</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>
                            <?php
                            $id = $_SESSION["login"]["id_author"];

                            $hal = (isset($_GET['hal'])) ? (int) $_GET['hal'] : 1;
                            $limit = 8;
                            $limitStart = ($hal - 1) * $limit;
                            if (isset($_POST['cari'])) {
                                $keyword = $_POST['keyword'];
                                $no = $limitStart + 1;
                                $query = $koneksi->query("SELECT * FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe  WHERE dokumen.id_author = '$id' AND judul LIKE '%$keyword%' OR nama_tipe LIKE '%$keyword%' OR status_doc LIKE '%$keyword%'");
                            } else {
                                $query = $koneksi->query("SELECT * FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe WHERE dokumen.id_author = '$id' ORDER BY dokumen.id_doc DESC LIMIT $limitStart, $limit");
                            }
                            $nomer = 1;
                            while ($data = $query->fetch_assoc()) {
                                $judul = substr($data['judul'], 0, 50) . '[...]';
                            ?>
                                <tbody>
                                    <tr>
                                        <td><?= $nomer; ?></td>
                                        <td><?= $judul; ?></td>
                                        <td><?= $data['nama_tipe']; ?></td>
                                        <td><?= $data['tgl_upload']; ?></td>
                                        <?php
                                        if ($data['status_doc'] == "Pending") {
                                            echo '<td><span class="badge badge-danger">' . $data['status_doc'] . '</span></td>';
                                        } elseif ($data['status_doc'] == "Disetujui") {
                                            echo '<td><span class="badge badge-success">' . $data['status_doc'] . '</span></td>';
                                        } elseif ($data['status_doc'] == "Tidak Disetujui") {
                                            echo '<td><span class="badge badge-warning">' . $data['status_doc'] . '</span></td>';
                                        }
                                        ?>

                                        <!-- <td> -->
                                        <?php
                                        if ($data['status_doc'] == "Pending") {
                                            echo '<td><a href="?page=data&act=detail&id=' . $data['id_info_doc'] . '" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a></td>';
                                        } elseif ($data['status_doc'] == "Disetujui") {
                                            echo '<td><a href="?page=data&act=detail&id=' . $data['id_info_doc'] . '" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a></td>';
                                        } elseif ($data['status_doc'] == "Tidak Disetujui") {
                                            echo '<td><a href="?page=data&act=kirimulang&id=' . $data['id_info_doc'] . '" class="btn btn-primary btn-sm"><i class="fas fa-share-square"></i></a></td>';
                                        }

                                        ?>
                                        <!-- <a href="?page=data&act=detail&id=<?= $data['id_info_doc']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a> -->
                                        <!-- </td> -->
                                    </tr>
                                </tbody>
                                <?php $nomer++; ?>
                            <?php } ?>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="skripsi-tabs" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Tanggal Upload</th>
                    <th>Status</th>
                    <th>Tools</th>
                </tr>
            </thead>
            <?php
            $id = $_SESSION["login"]["id_author"];

            $hal = (isset($_GET['hal'])) ? (int) $_GET['hal'] : 1;
            $limit = 8;
            $limitStart = ($hal - 1) * $limit;
            if (isset($_POST['cari'])) {
                $keyword = $_POST['keyword'];
                $no = $limitStart + 1;
                $query = $koneksi->query("SELECT * FROM jurnal JOIN tipe_jurnal ON jurnal.tipe_jurnal=tipe_jurnal.id_tipe_jurnal JOIN author ON author.id_author=jurnal.id_author WHERE jurnal.id_author = '$id' AND jurnal.judul LIKE '%$keyword%' OR jurnal.status LIKE '%$keyword%'");
            } else {
                $query = $koneksi->query("SELECT * FROM jurnal JOIN tipe_jurnal ON jurnal.tipe_jurnal=tipe_jurnal.id_tipe_jurnal JOIN author ON author.id_author=jurnal.id_author WHERE jurnal.id_author = '$id' ORDER BY jurnal.id_jurnal DESC LIMIT $limitStart, $limit");
            }
            $nomer = 1;
            while ($data = $query->fetch_assoc()) {
                $judul = substr($data['judul'], 0, 50) . '[...]';
            ?>
                <tbody>
                    <tr>
                        <td><?= $nomer; ?></td>
                        <td><?= $judul; ?></td>
                        <td><?= $data['tgl_upload_jurnal']; ?></td>
                        <?php
                        if ($data['status_jurnal'] == "Pending") {
                            echo '<td><span class="badge badge-danger">'.$data['status_jurnal'].'</span></td>';
                        } elseif ($data['status_jurnal'] == "Disetujui") {
                            echo '<td><span class="badge badge-success">' . $data['status_jurnal'] . '</span></td>';
                        } elseif ($data['status_jurnal'] == "Tidak Disetujui") {
                            echo '<td><span class="badge badge-warning">' . $data['status_jurnal'] . '</span></td>';
                        }
                        ?>

                        <!-- <td> -->
                        <?php
                        if ($data['status_jurnal'] == "Pending") {
                            echo '<td><a href="?page=data&act=detail&jurnal=' . $data['id_jurnal'] . '" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a></td>';
                        } elseif ($data['status_jurnal'] == "Disetujui") {
                            echo '<td><a href="?page=data&act=detail&jurnal=' . $data['id_jurnal'] . '" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a></td>';
                        } elseif ($data['status_jurnal'] == "Tidak Disetujui") {
                            echo '<td><a href="?page=data&act=kirimulang&jurnal=' . $data['id_jurnal'] . '" class="btn btn-primary btn-sm"><i class="fas fa-share-square"></i></a></td>';
                        }

                        ?>
                        <!-- <a href="?page=data&act=detail&id=<?= $data['id_info_doc']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a> -->
                        <!-- </td> -->
                    </tr>
                </tbody>
                <?php $nomer++; ?>
            <?php } ?>
        </table>
                    </div>
                    <div class="tab-pane fade" id="tesis-tabs" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                        <?php include "pending/tesis.php"; ?>
                    </div>
                </div>
            </div>
           
        </div>