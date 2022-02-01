<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Proses Jurnal</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
        </ol>
        </div>
    </div>
    </div>
</div>
<?php 
$id = $_GET['id'];
$sql = $koneksi->query("SELECT * FROM jurnal JOIN tipe_jurnal ON jurnal.tipe_jurnal=tipe_jurnal.id_tipe_jurnal WHERE id_jurnal = '$id'");
$data = $sql->fetch_assoc();

?>
<div class="card shadow">
    <div class="card-body">
        <table class="table">
            <tr>
                <th>Upload BY</th>
                <td>
                    <?php
                    if(!empty($data['posted_by2'])){
                        echo '1. '.$data['posted_by'].'<br>2. '.$data['posted_by2'];
                    }else{
                        echo $data['posted_by'];
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th>Judul</th>
                <td><?= $data['judul'];?></td>
            </tr>
             <tr>
                <th>Tipe Jurnal</th>
                <td><?= $data['nama_tipe_jurnal'];?></td>
            </tr>
            <tr>
                <th>Link Jurnal</th>
                <td><a href="<?= $data['link'];?>" target="_BLANK"><?= $data['link'];?></a></td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td><a href="#" type="button" data-toggle="modal" data-target="#desc">Lihat Deskripsi</a></td>
            </tr>
            <tr>
                <th>Daftar Pustaka</th>
                <td><a href="#" type="button" data-toggle="modal" data-target="#dafpus">Lihat Daftar Pustaka</a></td>
            </tr>
        </table>
        <div class="modal fade" id="desc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Deskripsi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?= $data['deskripsi'];?>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        <!-- modal daftar pustaka -->
        <div class="modal fade" id="dafpus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Daftar Pustaka</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?= $data['daftar_pustaka'];?>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            Lihat Files
        </a>
        <div class="collapse" id="collapseExample">
            <!-- <div class="card card-body"> -->
                <ul class="list-group list-group-flush">
                    <a href="?p=dokumen&aksi=seepdf&jurnal=<?= $data['id_jurnal'];?>"><li class="list-group-item"><i class="fas fa-angle-right"></i> <?= $data['name_file'];?></li></a>
                </ul>
            <!-- </div> -->
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-header">Proses</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <form action="" method="post">
                <div class="form-group">
                    <label >Status</label>
                    <select class="form-control" name="status" required>
                        <option value="">-Pilih Status-</option>
                        <option value="Disetujui">Setujui</option>
                        <option value="Tidak Disetujui">Tolak</option>
                    </select>
                </div>
                <small><p>Cantumkan Notes Jika Dokumen Di Tolak</p></small>
                <div class="form-group">
                    <textarea class="form-control" name="note" rows="3"></textarea>
                </div>
                <button type="submit" name="proses" class="btn btn-primary btn-sm">Proses</button>
                <a href="?p=dokumen" class="btn btn-danger btn-sm">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($_POST['proses'])){
    $sts = $_POST['status'];
    $note = $_POST['note'];
    $admin = $_SESSION['admin']['id_admin'];
    $date = date("Y-m-d");
    if($sts == "Tidak Disetujui" && $note == ""){
        echo "
        <script>
        Swal.fire(
            '',
            'BERIKAN NOTES JIKA DOKUMEN DI TOLAK',
            'error'
        )
        </script>";
    }else{
        $koneksi->query("UPDATE jurnal SET
        status_jurnal = '$sts',
        note = '$note'
        WHERE id_jurnal = '$id'");
        echo "
        <script>
        Swal.fire(
            'Sukses',
            'Data Telah Diproses',
            'success'
        )
        </script>";
        echo"<meta http-equiv='refresh' content='2;url=?p=dokumen'>";

    }
}