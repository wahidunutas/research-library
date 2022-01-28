<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Jurusan</h1>
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
        <h3 class="card-title"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i> Tambah Data</button></h3>
    </div>
    <div class="card-body">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jurusan</th>
                    <th>Fakultas</th>
                    <th>Tools</th>
                </tr>
            </thead>
            <?php
            $no = 1;
            $batas = 8;
            $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
            $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

            $data_fakl = array();
            $fak = $koneksi->query("SELECT * FROM fakultas");
            while ($fakultas = $fak->fetch_assoc()) {
                $data_fakl[] = $fakultas;
            }

            $previous = $halaman - 1;
            $next = $halaman + 1;
            $data = $koneksi->query("SELECT * FROM jurusan JOIN fakultas ON fakultas.id_fakultas=jurusan.id_fakultas");
            $jumlah_data = mysqli_num_rows($data);
            $total_halaman = ceil($jumlah_data / $batas);

            $sql = $koneksi->query("SELECT * FROM jurusan JOIN fakultas ON fakultas.id_fakultas=jurusan.id_fakultas LIMIT $halaman_awal,$batas");
            while ($result = $sql->fetch_assoc()) {
            ?>
                <tbody>
                    <td><?= $no; ?></td>
                    <td><?= $result['jur']; ?></td>
                    <td><?= $result['fakul']; ?></td>
                    <td>
                        <a href="" data-toggle="modal" data-target="#dtl<?= $result['id_jurusan']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                        <a href="?p=jurusan&act=delet&id=<?= $result['id_jurusan']; ?>" class="btn btn-danger btn-del btn-sm"><i class="fas fa-trash"></i></a>
                    </td>
                </tbody>
                <!-- Modal Edit-->
                <div class="modal fade" id="dtl<?= $result['id_jurusan']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Ubah Jurusan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="" method="post">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Fakultas</label>
                                        <select class="form-control" name="fakultass">
                                            <option value="">-select-</option>
                                            <?php foreach ($data_fakl as $key => $value) : ?>
                                                <option value="<?= $value['id_fakultas']; ?>" <?php if ($result["fakul"] == $value["fakul"]) {
                                                                                                    echo "selected";
                                                                                                } ?>>
                                                    <?= $value['fakul']; ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Name Jurusan</label>
                                        <input type="text" value="<?= $result['jur']; ?>" class="form-control" name="jurusan" placeholder="Input Jurusan" required>
                                        <input type="hidden" value="<?= $result['id_jurusan']; ?>" class="form-control" name="id" placeholder="Input Jurusan" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="edit" class="btn btn-secondary">Simpan</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
                <?php $no++; ?>
            <?php } ?>
        </table>
    </div>
    <div class="card-footer">
        <ul class="pagination mt-2 pagination-sm">
            <li class="page-item">
                <a class="page-link" <?php if ($halaman > 1) {
                                            echo "href='?p=jurusan&halaman=$Previous'";
                                        } ?>>Previous</a>
            </li>
            <?php
            for ($x = 1; $x <= $total_halaman; $x++) {
            ?>
                <li class="page-item"><a class="page-link" href="?p=jurusan&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
            <?php
            }
            ?>
            <li class="page-item">
                <a class="page-link" <?php if ($halaman < $total_halaman) {
                                            echo "href='?p=jurusan&halaman=$next'";
                                        } ?>>Next</a>
            </li>
        </ul>
    </div>
</div>
<!-- Modal Tambah Data-->
<div class="modal fade" id="add" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <select class="form-control " name="data" required>
                        <option <?= $ket; ?> value="">-Pilih Fakultas-</option>
                        <?php

                        $sql = "SELECT * FROM fakultas ";

                        $hasil = mysqli_query($koneksi, $sql);
                        $no = 0;
                        while ($data = mysqli_fetch_array($hasil)) {
                            $no++;

                            $ket = "";
                            if (isset($_POST['data'])) {
                                $id = trim($_POST['data']);

                                if ($id == $data['id_fakultas']) {
                                    $ket = "selected";
                                }
                            }
                        ?>

                            <option <?= $ket; ?> value="<?php echo $data['id_fakultas']; ?>"> <?php echo $data['fakul']; ?></option>
                        <?php } ?>
                    </select>
                    <div class="form-group">
                        <label>Name Jurusan</label>
                        <input type="text" class="form-control" name="jur" placeholder="Input Jurusan" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="simpan" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
if (isset($_POST['simpan'])) {
    $data = $_POST['data'];
    $jur = $_POST['jur'];

    $koneksi->query("INSERT INTO jurusan(id_fakultas, jur)VALUES('$data', '$jur')");
    echo "
    <script>
    Swal.fire(
        'Data Berhasil Ditambah',
        '',
        'success'
    )
    </script>";
    echo "<meta http-equiv='refresh' content='2;url=?p=jurusan'>";
}

if (isset($_POST['edit'])) {
    $fakultas = $_POST['fakultass'];
    $jurusan = $_POST['jurusan'];
    $id = $_POST['id'];
    $koneksi->query("UPDATE jurusan SET
        id_fakultas = '$fakultas',
        jur = '$jurusan'
        WHERE id_jurusan = '$id'");

    echo "
    <script>
    Swal.fire(
        'Data Berhasil Diubah',
        '',
        'success'
    )
    </script>";
    echo "<meta http-equiv='refresh' content='2;url=?p=jurusan'>";
}

if (isset($_GET['id']) && isset($_GET['act'])) {

    $ids = $_GET['id'];

    $koneksi->query("DELETE FROM jurusan WHERE id_jurusan = '$ids'");
    echo "<script>location='?p=jurusan';</script>";
}
