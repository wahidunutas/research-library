<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Jurnal</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active"><?= $page; ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <a href="?p=jurnal&aksi=uploadJurnal" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Upload Jurnal</a>
        <div class="card-tools">

            <form method="post">
                <div class="input-group input-group-sm" style="width: 180px;">
                    <input type="text" name="keyword" class="form-control float-right" placeholder="Search Keyword" required>

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default" name="cari">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Tanggal upload</th>
                    <th>Deskripsi</th>
                    <th>Tools</th>
                </tr>
            </thead>
            <?php
            $no = 1;
            $batas = 10;
            $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
            $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

            $previous = $halaman - 1;
            $next = $halaman + 1;

            $data = mysqli_query($koneksi, "SELECT * FROM jurnal WHERE posted_by='admin' ");
            $jumlah_data = mysqli_num_rows($data);
            $total_halaman = ceil($jumlah_data / $batas);
            $sql = "SELECT * FROM jurnal WHERE posted_by='admin' LIMIT $halaman_awal,$batas";
            $sql_run = mysqli_query($koneksi, $sql);

            if (mysqli_num_rows($sql_run) > 0) {
                foreach ($sql_run as $data) {
                    $judul = substr($data['judul'], 0, 50);
                    $deskripsi = substr($data['deskripsi'], 0, 110) . '[..]';
            ?>
                    <tbody>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $judul; ?></td>
                            <td style="width:190px"><?= $data['tgl_upload_jurnal']; ?></td>
                            <td><?= $deskripsi; ?></td>
                            <td>
                                <!-- <a href="?p=jurnal&aksi=see&id=<?= $data['id_jurnal']; ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a> -->
                                <a href="?p=jurnal&aksi=update&id=<?= $data['id_jurnal']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="?p=jurnal&act=del&id=<?= $data['id_jurnal']; ?>" class="btn btn-danger btn-del btn-sm"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
            <?php
                    $no++;
                }
            } else {
            }
            ?>
            <tfoot>
            </tfoot>
        </table>
    </div>
    <div class="card-footer">
        <ul class="pagination mt-2 pagination-sm">
            <li class="page-item">
                <a class="page-link" <?php if ($halaman > 1) {
                                            echo "href='?p=jurnal&halaman=$Previous'";
                                        } ?>>Previous</a>
            </li>
            <?php
            for ($x = 1; $x <= $total_halaman; $x++) {
            ?>
                <li class="page-item"><a class="page-link" href="?p=jurnal&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
            <?php
            }
            ?>
            <li class="page-item">
                <a class="page-link" <?php if ($halaman < $total_halaman) {
                                            echo "href='?p=jurnal&halaman=$next'";
                                        } ?>>Next</a>
            </li>
        </ul>
    </div>
</div>

<?php
if (isset($_GET['id']) && isset($_GET['act'])) {

    $id = $_GET['id'];
    $ambil = $koneksi->query("SELECT * FROM jurnal WHERE id_jurnal = '$id'");
    $dp = $ambil->fetch_assoc();
    $cover = $dp['cover'];
    $file = $dp['file_jurnal'];
    if (file_exists("pages/jurnal/cover/$cover")) {
        unlink("pages/jurnal/cover/$cover");
    }
    if (file_exists("pages/jurnal/dokumen/$file")) {
        unlink("pages/jurnal/dokumen/$file");
    }

    $koneksi->query("DELETE FROM jurnal WHERE id_jurnal = '$id'");
    echo "<script>location='?p=jurnal';</script>";
}
?>