<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Fakultas</h1>
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
        <h3 class="card-title"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#fak"><i class="fas fa-plus"></i> Tambah Data</button></h3>

    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Fakultas</th>
                    <th>Jurusan</th>
                    <th>Tools</th>
                </tr>
            </thead>
            <?php
            $nomer = 1;
            $sql = $koneksi->query("SELECT * FROM fakultas ORDER BY id_fakultas DESC");
            while ($doc = $sql->fetch_assoc()) {
            ?>
                <tbody>
                    <tr>
                        <td><?= $nomer; ?></td>
                        <td><?= $doc['fakul']; ?></td>
                        <td> <input type="button" name="view" value="View" data-id="<?php echo $doc["id_fakultas"]; ?>" class="btn btn-info btn-xs view_data"></td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit<?= $doc['id_fakultas']; ?>"><i class="fas fa-edit"></i></a>

                            <a href="?p=fakultas&act=del&id=<?= $doc['id_fakultas']; ?>" class="btn btn-danger btn-sm btn-del"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
                <!-- Modal Edit-->
                <div class="modal fade" id="edit<?= $doc['id_fakultas']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Update Fakultas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Fakultas</label>
                                        <input type="text" class="form-control" name="fakultass" value="<?= $doc['fakul']; ?>">
                                    </div>
                                    <input type="hidden" value="<?= $doc['id_fakultas']; ?>" class="form-control" name="id" required autocomplete="off">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" name="edit">Save</button>
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
<!-- Modal jurusan-->
<div class="modal fade" id="dataJur" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Data Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="jur">
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Data-->
<div class="modal fade" id="fak" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                        <label>Name Fakultas</label>
                        <input type="text" class="form-control" name="fakultas" placeholder="Input Fakultas" required>

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
    $fak = $_POST['fakultas'];
    $koneksi->query("INSERT INTO fakultas(id_fakultas, fakul)VALUE('','$fak')");

    echo "
    <script>
    Swal.fire(
        'Data Berhasil Ditambah',
        '',
        'success'
    )
    </script>";
    echo "<meta http-equiv='refresh' content='2;url=?p=fakultas'>";
}

if (isset($_POST['edit'])) {
    $fk = $_POST['fakultass'];
    $id = $_POST['id'];
    $koneksi->query("UPDATE fakultas SET
                fakul = '$fk'
                WHERE id_fakultas = '$id'");
    echo "
    <script>
    Swal.fire(
        'Data Berhasil Diubah',
        '',
        'success'
    )
    </script>";
    echo "<meta http-equiv='refresh' content='2;url=?p=fakultas'>";
}

if (isset($_GET['id']) && isset($_GET['act'])) {

    $id = $_GET['id'];

    $koneksi->query("DELETE FROM fakultas WHERE id_fakultas = '$id'");
    echo "<script>location='?p=fakultas';</script>";
}
