<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Tipe Jurnal</h1>
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
        <h3 class="card-title"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tipe"><i class="fas fa-plus"></i> Tambah Data</button></h3>

    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tipe</th>
                    <th></th>
                    <th>Tools</th>
                </tr>
            </thead>
            <?php
            $nomer = 1;
            $batas = 5;
            $haljurnal = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
            $halaman_awal = ($haljurnal > 1) ? ($haljurnal * $batas) - $batas : 0;

            $previous = $haljurnal - 1;
            $next = $haljurnal + 1;

            $data = mysqli_query($koneksi, "SELECT * FROM tipe_jurnal");
            $jumlah_data = mysqli_num_rows($data);
            $total_halaman = ceil($jumlah_data / $batas);
            $sql = $koneksi->query("SELECT * FROM tipe_jurnal LIMIT $halaman_awal,$batas");
            while ($doc = $sql->fetch_assoc()) {
            ?>

                <tbody>
                    <tr>
                        <td><?= $nomer; ?></td>
                        <td><?= $doc['nama_tipe_jurnal']; ?></td>
                        <td></td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ubah<?= $doc['id_tipe_jurnal']; ?>"><i class="fas fa-edit"></i></a>
                            <a href="?p=tipejurnal&act=del&id=<?= $doc['id_tipe_jurnal']; ?>" class="btn btn-danger btn-sm btn-del"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>

                <!-- Modal Edit Data-->
                <div class="modal fade" id="ubah<?= $doc['id_tipe_jurnal']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Ubah Data Tipe</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Name Tipe</label>
                                        <input type="text" class="form-control" name="ubhtipe" value="<?= $doc['nama_tipe_jurnal']; ?>" required>
                                        <input type="hidden" value="<?= $doc['id_tipe_jurnal']; ?>" class="form-control" name="id" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="update" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php $nomer++; ?>
            <?php } ?>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <ul class="pagination mt-2 pagination-sm">
            <li class="page-item">
                <a class="page-link" <?php if ($haljurnal > 1) {
                                            echo "href='?p=tipejurnal&halaman=$Previous'";
                                        } ?>>Previous</a>
            </li>
            <?php
            for ($x = 1; $x <= $total_halaman; $x++) {
            ?>
                <li class="page-item"><a class="page-link" href="?p=tipejurnal&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
            <?php
            }
            ?>
            <li class="page-item">
                <a class="page-link" data-toggle="custom-tabs-one-profile" <?php if ($haljurnal < $total_halaman) {
                                                                                echo "href='?p=tipejurnal&halaman=$next'";
                                                                            } ?>>Next</a>
            </li>
        </ul>
    </div>
</div>
<!-- /.card -->


<!-- Modal Tambah Data-->
<div class="modal fade" id="tipe" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Tipe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name Tipe Jurnal</label>
                        <input type="text" class="form-control" name="tipe" placeholder="Input Tipe" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="tambah" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['tambah'])) {
    $tipe = $_POST['tipe'];

    $koneksi->query("INSERT INTO tipe_jurnal(id_tipe_jurnal, nama_tipe_jurnal)VALUE('','$tipe')");

    echo "
    <script>
    Swal.fire(
        'Data Berhasil Ditambah',
        '',
        'success'
    )
    </script>";
    echo "<meta http-equiv='refresh' content='2;url=?p=tipejurnal'>";
}

if (isset($_POST['update'])) {
    $tp = $_POST['ubhtipe'];
    $id = $_POST['id'];
    $koneksi->query("UPDATE tipe_jurnal SET
                    nama_tipe_jurnal = '$tp'
                    WHERE id_tipe_jurnal = '$id'");
    echo "
    <script>
    Swal.fire(
        'Data Berhasil Diubah',
        '',
        'success'
    )
    </script>";
    echo "<meta http-equiv='refresh' content='2;url=?p=tipejurnal'>";
}

if (isset($_GET['id']) && isset($_GET['act'])) {

    $id = $_GET['id'];

    $koneksi->query("DELETE FROM tipe_jurnal WHERE id_tipe_jurnal = '$id'");
    echo "<script>location='?p=tipejurnal';</script>";
}
