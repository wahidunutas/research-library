<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Berita</h1>
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
        <h3 class="card-title"><a href="?p=berita&aksi=upload" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>
                Upload Berita
            </a>
        </h3>
        <div class="card-tools">

            <form method="post">
                <div class="input-group input-group-sm" style="width: 180px;">
                    <input type="text" name="keyword" class="form-control float-right" placeholder="Search Keyword">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default" name="cari">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Tanggal Upload</th>
                    <th>Tools</th>
                </tr>
            </thead>
            <?php

            $hal = (isset($_GET['hal'])) ? (int) $_GET['hal'] : 1;
            $limit = 6;
            $limitStart = ($hal - 1) * $limit;
            if (isset($_POST['cari'])) {
                $keyword = $_POST['keyword'];
                $no = $limitStart + 1;
                $query = $koneksi->query("SELECT * FROM berita WHERE judul_berita LIKE '%$keyword%' OR tgl_upload LIKE '%$keyword%' ORDER BY id_berita DESC");
            } else {
                $query = $koneksi->query("SELECT * FROM berita ORDER BY id_berita DESC LIMIT $limitStart, $limit");
            }
            $nomer = 1;
            while ($data = $query->fetch_assoc()) {
            ?>
                <tbody>
                    <tr>
                        <td><?= $nomer; ?></td>
                        <td><?= $data['judul_berita']; ?></td>
                        <td><?= $data['tgl_upload']; ?></td>
                        <td>
                            <a href="?p=berita&aksi=update&id=<?= $data['id_berita']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="?p=berita&act=del&id=<?= $data['id_berita']; ?>" class="btn btn-danger btn-sm btn-del" data-toggle="tooltip" title="delete" data-placement="bottom"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
                <?php $nomer++; ?>
            <?php } ?>
        </table>
    </div>
    <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-right">
            <?php
            if ($hal == 1) {
            ?>
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <?php
            } else {
                $LinkPrev = ($hal > 1) ? $hal - 1 : 1;
            ?>
                <li class="page-item"><a class="page-link" href="?p=berita&hal=<?php echo $LinkPrev; ?>">Previous</a></li>
            <?php } ?>

            <?php
            $SqlQuery = mysqli_query($koneksi, "SELECT * FROM berita ");

            $JumlahData = mysqli_num_rows($SqlQuery);

            $jumlahPage = ceil($JumlahData / $limit);
            $jumlahNumber = 1;
            $startNumber = ($hal > $jumlahNumber) ? $hal - $jumlahNumber : 1;
            $endNumber = ($hal < ($jumlahPage - $jumlahNumber)) ? $hal + $jumlahNumber : $jumlahPage;

            for ($i = $startNumber; $i <= $endNumber; $i++) {
                $linkActive = ($hal == $i) ? ' class="active"' : '';
            ?>
                <li class="page-item" <?php echo $linkActive; ?>><a class="page-link" href="?p=berita&hal=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php
            }
            ?>

            <!-- link Next Page -->
            <?php
            if ($hal == $jumlahPage) {
            ?>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            <?php
            } else {
                $linkNext = ($hal < $jumlahPage) ? $hal + 1 : $jumlahPage;
            ?>
                <li class="page-item"><a class="page-link" href="?p=berita&hal=<?php echo $linkNext; ?>">Next</a></li>
            <?php
            }
            ?>
        </ul>
    </div>
</div>

<?php
if (isset($_GET['id']) && isset($_GET['act'])) {

    $id = $_GET['id'];

    $koneksi->query("DELETE FROM berita WHERE id_berita = '$id'");
    echo "<script>location='?p=berita';</script>";
}
?>