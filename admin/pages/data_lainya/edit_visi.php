<?php

$id = $_GET['id'];
$data = $koneksi->query("SELECT * FROM visi_misi JOIN fakultas ON fakultas.id_fakultas=visi_misi.id_fakultas WHERE id_vm = '$id'");
$data = $data->fetch_assoc();

$data_fakl = array();
$fak = $koneksi->query("SELECT * FROM fakultas");
while ($fakultas = $fak->fetch_assoc()) {
    $data_fakl[] = $fakultas;
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Update Visi Misi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?p=berita">Home</a></li>
                    <li class="breadcrumb-item active"><?= $page; ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header"></div>
    <form action="" method="post">
        <div class="card-body">
            <div class="form-group">
                <label>Judul</label>
                <select class="form-control" name="fakultas">
                    <option value="">-select-</option>
                    <?php foreach ($data_fakl as $key => $value) : ?>
                        <option value="<?= $value['id_fakultas']; ?>" <?php if ($data["fakul"] == $value["fakul"]) {echo "selected"; } ?>>
                            <?= $data['fakul']; ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label>Visi Misi</label>
                <textarea class="ckeditor" id="ckedtor" name="vm">
                    <?= $data['visi']; ?>
                </textarea>
            </div>
        </div>
        <div class="card-footer">

            <button type="submit" class="btn btn-primary btn-sm" name="save">Update</button>
            <a href="?p=visi" class="btn btn-danger btn-sm">Kembali</a>
        </div>
    </form>
</div>

<?php
if (isset($_POST['save'])) {
    $fakultas = $_POST['fakultas'];
    $vm = $_POST['vm'];

    $koneksi->query("UPDATE visi_misi SET
    visi = '$vm',
    id_fakultas = '$fakultas'
    WHERE id_vm = '$id'");
    echo "<script>
        Swal.fire(
            'Data Berhasil Diupdate',
            '',
            'success'
            )
            </script>";
    echo "<meta http-equiv='refresh' content='2;url=?p=visi'>";
}
?>