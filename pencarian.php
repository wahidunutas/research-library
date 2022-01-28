<?php
include "template/template2/header.php";
$keyword = $_GET['keyword'];
?>
<div class="container mt-4">
    <h4 class="mb-3 text-uppercase">HASIL PENCARIAN <?= $keyword; ?></h4>
    <?php
    if (isset($_GET['cari']) && ($_GET['keyword'] <> "")) {
        $query = $koneksi->query("SELECT * FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe JOIN fakultas ON fakultas.id_fakultas=info_doc.id_fakultas JOIN jurusan ON jurusan.id_jurusan=info_doc.id_jurusan WHERE dokumen.status_doc='Disetujui' AND judul LIKE '%$keyword%' OR dospem LIKE '%$keyword%' OR nama_penulis LIKE '%$keyword%' OR nama_tipe LIKE '%$keyword%' OR fakul LIKE '%$keyword%'  OR jur LIKE '%$keyword%'");

        if (mysqli_num_rows($query) > 0) {
            foreach ($query as $data) { ?>

                <li class="list-group-item shadow">
                    <a href="index.php?p=dokumen&id=<?= $data['id_info_doc']; ?>">
                        <h6 class="mt-0 text-capitalize"><i class="fas fa-angle-right"></i> <?= $data['judul']; ?></h6>
                    </a>
                    <small><?= $data['nama_penulis']; ?> | <?= $data['nama_tipe']; ?> | <?= $data['tgl_upload']; ?> | <?= $data['fakul']; ?> > <?= $data['jur']; ?>
                        <?php
                        if (!empty($data['dospem'])) {
                            echo '| 1. ' . $data['dospem'] . ',&nbsp;&nbsp;';
                            if (!empty($data['dospem_2'])) {
                                echo '2. ' . $data['dospem_2'];
                            } else {
                                echo '';
                            }
                        } else {
                            echo '';
                        }
                        ?>
                    </small>
                </li>
                <?php
            }
        } else {
            $query2 = $koneksi->query("SELECT * FROM jurnal JOIN tipe_jurnal ON jurnal.tipe_jurnal=tipe_jurnal.id_tipe_jurnal WHERE judul LIKE '%$keyword%'");

            if (mysqli_num_rows($query2) > 0) {
                foreach ($query2 as $data2) {
                    $abstrak = substr($data2['deskripsi'], 0, 170); ?>
                    <li class="list-group-item shadow">
                        <a href="index.php?p=bacajurnal&id=<?= $data2['id_jurnal']; ?>">
                            <h6 class="mt-0 text-capitalize"><i class="fas fa-angle-right"></i> <?= $data2['judul']; ?></h6>
                        </a>
                        <small><?= $data2['nama_tipe_jurnal']; ?> | <?= $data2['tgl_upload_jurnal']; ?> | <?= $data2['posted_by']; ?>
                        </small>
                    </li>
    <?php
                }
            } else {
                echo '<div class="alert alert-warning alert-dismissible shadow">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                Data Yang Anda Cari Saat Ini Tidak Tersedia
                </div>';
            }
        }
    } ?>
</div>
</div>
<?php include 'template/template2/footer.php'; ?>