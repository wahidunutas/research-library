<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Update Data Mahasiswa</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?p=mahasiswa">Home</a></li>
                    <li class="breadcrumb-item active"><?= $page; ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<?php
$id = $_GET['id'];
$sql = $koneksi->query("SELECT * FROM author JOIN fakultas ON fakultas.id_fakultas=author.id_fakultas JOIN akses ON akses.id_author=author.id_author WHERE author.id_author='$id'");
$result = $sql->fetch_assoc();

$data_fakl = array();
$fak = $koneksi->query("SELECT * FROM fakultas");
while ($fakultas = $fak->fetch_assoc()) {
    $data_fakl[] = $fakultas;
}
?>
<form action="" method="post">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="<?= $result['nama']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Nip</label>
                        <input type="text" name="nip" class="form-control" value="<?= $result['nip']; ?>">
                    </div>

                    <div class="form-group">
                        <label>Fakultas</label>
                        <input type="text" name="fakul" class="form-control" value="<?= $result['fakul']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Jurusan</label>
                        <input type="text" name="jurusan" class="form-control" value="<?= $result['jurusan']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>No Telepon</label>
                        <input type="text" name="no" class="form-control" value="<?= $result['no_telepon']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat" rows="3"><?= $result['alamat']; ?></textarea>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" readonly value="<?= $result['email']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Password <span class="fas fa-eye" onclick="show()"></span></label>
                        <input type="password" name="pw" class="form-control" id="pswrd" value="<?= $result['password']; ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit" name="save">Simpan</button>
            <a href="?p=mahasiswa" class="btn btn-danger">Kembali</a>
        </div>
    </div>
</form>
<?php
if (isset($_POST['save'])) {
    $nama = $_POST['nama'];
    $nip = $_POST['nip'];
    $fak = $_POST['fakul'];
    $no = $_POST['no'];
    $almt = $_POST['alamat'];
    $email = $_POST['email'];
    $pw = $_POST['pw'];
    $jrsn = $_POST['jurusan'];
    $ids = $_GET['id'];
    $koneksi->query("UPDATE author SET
        nama = '$nama',
        email = '$email',
        no_telepon = '$no',
        alamat = '$almt'
        WHERE id_author = '$ids'");

    $koneksi->query("UPDATE akses SET
        nip = '$nip',
        password = '$pw'
        WHERE id_author = '$ids'");


    echo "
    <script>
        Swal.fire(
            'Data Berhasil Diubah',
            '',
            'success'
        )
    </script>";
    echo "<meta http-equiv='refresh' content='2;url=?p=mahasiswa'>";
}
?>