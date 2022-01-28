<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Status</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=">Home</a></li>
                    <li class="breadcrumb-item active"><?= $page; ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><a href="?page=upload" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>
                Upload Files
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
        <?php
            if($_SESSION['role'] == 'dosen'){
               include "pages/data/dosen.php";
            }else{
                include "pages/data/mahasiswa.php";
            }
        ?>
        
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
                <li class="page-item"><a class="page-link" href="?page=data&hal=<?php echo $LinkPrev; ?>">Previous</a></li>
            <?php } ?>

            <?php
            $SqlQuery = mysqli_query($koneksi, "SELECT * FROM dokumen JOIN info_doc ON dokumen.id_info_doc=info_doc.id_info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe WHERE dokumen.id_author = '$id' ");

            $JumlahData = mysqli_num_rows($SqlQuery);

            $jumlahPage = ceil($JumlahData / $limit);
            $jumlahNumber = 1;
            $startNumber = ($hal > $jumlahNumber) ? $hal - $jumlahNumber : 1;
            $endNumber = ($hal < ($jumlahPage - $jumlahNumber)) ? $hal + $jumlahNumber : $jumlahPage;

            for ($i = $startNumber; $i <= $endNumber; $i++) {
                $linkActive = ($hal == $i) ? ' class="active"' : '';
            ?>
                <li class="page-item" <?php echo $linkActive; ?>><a class="page-link" href="?page=data&hal=<?php echo $i; ?>"><?php echo $i; ?></a></li>
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
                <li class="page-item"><a class="page-link" href="?page=data&hal=<?php echo $linkNext; ?>">Next</a></li>
            <?php
            }
            ?>
        </ul>
    </div>
</div>


<?php
if (isset($_GET['id']) && isset($_GET['aks'])) {

    $id = $_GET['id'];
    $ambil = $koneksi->query("SELECT * FROM dokumen WHERE id_info_doc = '$id'");
    $dp = $ambil->fetch_assoc();
    $file = $dp['file'];
    if (file_exists("dokumen/$file")) {
        unlink("dokumen/$file");
    }

    $ambil = $koneksi->query("SELECT * FROM data_dokumen WHERE id_info_doc = '$id'");
    $dp = $ambil->fetch_assoc();
    $files = $dp['files'];
    if (file_exists("dokumen/$files")) {
        unlink("dokumen/$files");
    }

    $koneksi->query("DELETE FROM dokumen WHERE id_info_doc = '$id'");
    $koneksi->query("DELETE FROM data_dokumen WHERE id_info_doc = '$id'");
    $koneksi->query("DELETE FROM info_doc WHERE id_info_doc = '$id'");
    echo "<script>location='?page=data';</script>";
}
?>