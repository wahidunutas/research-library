<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Tipe</h1>
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
            $sql = $koneksi->query("SELECT * FROM tipe ORDER BY id_tipe DESC");
            while ($doc = $sql->fetch_assoc()) {
            ?>

                <tbody>
                    <tr>
                        <td><?= $nomer; ?></td>
                        <td><?= $doc['nama_tipe']; ?></td>
                        <td></td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ubah<?= $doc['id_tipe']; ?>"><i class="fas fa-edit"></i></a>
                            <a href="?p=tipe&act=del&id=<?= $doc['id_tipe']; ?>" class="btn btn-danger btn-sm btn-del"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>

                <!-- Modal Edit Data-->
                <div class="modal fade" id="ubah<?= $doc['id_tipe']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                        <input type="text" class="form-control" name="ubhtipe" value="<?= $doc['nama_tipe']; ?>" required>
                                        <input type="hidden" value="<?= $doc['id_tipe']; ?>" class="form-control" name="id" required autocomplete="off">
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
                        <label>Name Tipe</label>
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

    $koneksi->query("INSERT INTO tipe(id_tipe, nama_tipe)VALUE('','$tipe')");

    echo "
    <script>
    Swal.fire(
        'Data Berhasil Ditambah',
        '',
        'success'
    )
    </script>";
    echo "<meta http-equiv='refresh' content='2;url=?p=tipe'>";
}

if (isset($_POST['update'])) {
    $tp = $_POST['ubhtipe'];
    $id = $_POST['id'];
    $koneksi->query("UPDATE tipe SET
                    nama_tipe = '$tp'
                    WHERE id_tipe = '$id'");
    echo "
    <script>
    Swal.fire(
        'Data Berhasil Diubah',
        '',
        'success'
    )
    </script>";
    echo "<meta http-equiv='refresh' content='2;url=?p=tipe'>";
}

if (isset($_GET['id']) && isset($_GET['act'])) {

    $id = $_GET['id'];

    $koneksi->query("DELETE FROM tipe WHERE id_tipe = '$id'");
    echo "<script>location='?p=tipe';</script>";
}
