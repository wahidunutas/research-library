<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <a href="?p=dokumen" class="btn btn-danger btn-sm"><i class="fas fa-angle-left"></i> Kembali</a>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="card card-tabs">
    <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
           <li class="nav-item">
                <a class="
                <?php 
                if(!$_GET["haljrnl"]){
                    echo "nav-link active";
                }else{
                    echo "nav-link";
                } ?> id="pending" data-toggle="pill" href="#home-pending" role="tab" aria-controls="home-pending" aria-selected="true">Karya Ilmiah</a>
            </li>
            <li class="nav-item">
                <a class="
                <?php 
                if($_GET['haljrnl']){
                    echo 'nav-link active';
                }else{
                    echo 'nav-link';
                }
                ?> id="acc" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="true">Jurnal</a>
            </li>
            

        </ul>
        
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-one-tabContent">
            <div class="<?php 
            if(!$_GET['haljrnl']){
                echo "tab-pane fade show active";
            }else{
                echo "tab-pane fade";
            }
            ?>" id="home-pending" role="tabpanel" aria-labelledby="pending">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Data Karya Ilmiah
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
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Penulis</th>
                                    <th>Tanggal Upload</th>
                                    <th>Judul</th>
                                    <th>Tipe</th>
                                    <th>Fakultas</th>
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

                            $data = mysqli_query($koneksi, "SELECT * FROM info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc JOIN fakultas ON fakultas.id_fakultas=info_doc.id_fakultas ORDER BY info_doc.id_info_doc DESC");
                            $jumlah_data = mysqli_num_rows($data);
                            $total_halaman = ceil($jumlah_data / $batas);
                            
                            if (isset($_POST['cari'])) {
                                $key = $_POST['keyword'];
                                $sql = $koneksi->query("SELECT * FROM info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe JOIN fakultas ON fakultas.id_fakultas=info_doc.id_fakultas WHERE info_doc.judul LIKE '%$key%' OR info_doc.dospem LIKE '%$key%' OR info_doc.nama_penulis LIKE '%$key%' OR tipe.nama_tipe LIKE '%$key%'  ORDER BY info_doc.id_info_doc DESC LIMIT $halaman_awal, $batas");
                            } else {
                                $sql = $koneksi->query("SELECT * FROM info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc JOIN fakultas ON fakultas.id_fakultas=info_doc.id_fakultas ORDER BY info_doc.id_info_doc DESC LIMIT $halaman_awal,$batas ");
                            }

                            while ($data = $sql->fetch_assoc()) {
                                $jdl = substr($data['judul'], 0, 20) . '...';
                            ?>
                                <tbody>
                                    <td><?= $no; ?></td>
                                    <td ><?= $data['nama_penulis']; ?></td>
                                    <td ><?= $data['tgl_upload']; ?></td>
                                    <td><?= $jdl; ?></td>
                                    <td><?= $data['nama_tipe']; ?></td>
                                    <td><?= $data['fakul']; ?></td>
                                    <td style="width:93px">
                                        <a href="?p=dokumen&aksi=lihatdoc&id=<?= $data['id_info_doc']; ?>" class="btn btn-info btn-sm"><i class="fas fa-info"></i></a>
                                        <a href="?p=dokumen&aksi=seeall&act=delet&id=<?= $data['id_info_doc']; ?>" class="btn btn-danger btn-del btn-sm"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tbody>
                            <?php $no++;
                            } ?>
                        </table>
                    </div>
                    <div class="card-footer">
                        <ul class="pagination mt-2 pagination-sm">
                            <li class="page-item">
                                <a class="page-link" <?php if ($halaman > 1) {
                                                            echo "href='?p=dokumen&aksi=seeall&halaman=$Previous'";
                                                        } ?>>Previous</a>
                            </li>
                            <?php
                            for ($x = 1; $x <= $total_halaman; $x++) {
                            ?>
                                <li class="page-item"><a class="page-link" href="?p=dokumen&aksi=seeall&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                            <?php
                            }
                            ?>
                            <li class="page-item">
                                <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                            echo "href='?p=dokumen&aksi=seeall&halaman=$next'";
                                                        } ?>>Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- JURNAL -->
            <div class="<?php 
            if($_GET['haljrnl']){
                echo "tab-pane fade show active";
            }else{
                echo "tab-pane fade";
            }
            ?>" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="acc">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Data Jurnal
                        </h3>
                        <div class="card-tools">

                            <div class="input-group input-group-sm" style="width: 180px;">
                                <input type="text" name="keywordjurnal" class="form-control float-right" placeholder="Search Keyword">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default" name="x">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Posted By</th>
                                    <th>Tanggal Upload</th>
                                    <th>Status</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>
                            <?php
                            $no = 1;
                            $batas = 10;
                            $haljurnal = isset($_GET['haljrnl']) ? (int)$_GET['haljrnl'] : 1;
                            $halaman_awal = ($haljurnal > 1) ? ($haljurnal * $batas) - $batas : 0;

                            $previous = $haljurnal - 1;
                            $next = $haljurnal + 1;

                            $data = mysqli_query($koneksi, "SELECT * FROM jurnal WHERE posted_by != 'admin' ORDER BY id_jurnal DESC");
                            $jumlah_data = mysqli_num_rows($data);
                            $total_halaman = ceil($jumlah_data / $batas);
                            if (isset($_POST['x'])) {
                                $keywordj = $_POST['keywordjurnal'];
                                $sql = $koneksi->query("SELECT * FROM jurnal WHERE posted_by != 'admin' AND posted_by LIKE '%$keywordj%' OR status LIKE '%$keywordj%'  ORDER BY id_jurnal DESC  LIMIT $halaman_awal,$batas");
                            } else {
                                $sql = $koneksi->query("SELECT * FROM jurnal WHERE posted_by != 'admin' ORDER BY id_jurnal DESC LIMIT $halaman_awal,$batas ");
                            }

                            while ($data = $sql->fetch_assoc()) {
                                $jdl = substr($data['judul'], 0, 50) . '...';
                            ?>
                                <tbody>
                                    <td><?= $no; ?></td>
                                    <td><?= $jdl; ?></td>
                                    <td><?= $data['posted_by']; ?></td>
                                    <td style="width:190px"><?= $data['tgl_upload_jurnal']; ?></td>
                                    <td><?= $data['status_jurnal']; ?></td>
                                    <td>
                                        <a href="?p=dokumen&aksi=lihatdoc&jurnal=<?= $data['id_jurnal']; ?>" class="btn btn-info btn-sm"><i class="fas fa-info"></i></a>
                                        <a href="?p=dokumen&aksi=seeall&act=delet&jurnal=<?= $data['id_jurnal']; ?>" class="btn btn-danger btn-del btn-sm"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tbody>
                            <?php $no++;
                            } ?>
                        </table>
                    </div>
                    <div class="card-footer">
                        <ul class="pagination mt-2 pagination-sm">
                            <li class="page-item">
                                <a class="page-link" <?php if ($haljurnal > 1) {
                                                            echo "href='?p=dokumen&aksi=seeall&haljrnl=$Previous'";
                                                        } ?>>Previous</a>
                            </li>
                            <?php
                            for ($x = 1; $x <= $total_halaman; $x++) {
                            ?>
                                <li class="page-item"><a class="page-link" href="?p=dokumen&aksi=seeall&haljrnl=<?php echo $x ?>"><?php echo $x; ?></a></li>
                            <?php
                            }
                            ?>
                            <li class="page-item">
                                <a class="page-link" data-toggle="custom-tabs-one-profile" <?php if ($haljurnal < $total_halaman) {
                                                            echo "href='?p=dokumen&aksi=seeall&haljrnl=$next'";
                                                        } ?>>Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
</div>



<?php
if (isset($_GET['id']) && isset($_GET['act'])) {

    $id = $_GET['id'];
    
    // delete karya ilmiah
    $sql = $koneksi->query("SELECT * FROM data_dokumen WHERE id_info_doc = '$id'");
    $x = $sql->fetch_assoc();
    $files = $x['named_file'];
    if (file_exists("../user/dokumen/". $files)) {
        unlink("../user/dokumen/". $files);
    }

    $koneksi->query("DELETE FROM dokumen WHERE id_info_doc = '$id'");
    $koneksi->query("DELETE FROM data_dokumen WHERE id_info_doc = '$id'");
    $koneksi->query("DELETE FROM info_doc WHERE id_info_doc = '$id'");
    $koneksi->query("DELETE FROM downloads WHERE id_info_doc = '$id'");
    $koneksi->query("DELETE FROM komentar WHERE id_info_doc = '$id'");
    
    echo "<script>location='?p=dokumen&aksi=seeall';</script>";
}

if(isset($_GET['jurnal']) && isset($_GET['act'])){
    $jurnal = $_GET['jurnal'];

    // delete jurnal
    $sqlJurnal = $koneksi->query("SELECT * FROM jurnal WHERE id_jurnal = '$jurnal'");
    $result = $sqlJurnal->fetch_assoc();
    $filejurnal = $result['file'];
    $cover = $result['cover'];
    if (file_exists("../user/dokumen/jurnal/". $filejurnal)) {
        unlink("../user/dokumen/jurnal/". $filejurnal);
    }
    if(file_exists("pages/jurnal/cover/". $cover)){
        unlink("pages/jurnal/cover/". $cover);
    }
    $koneksi->query("DELETE FROM jurnal WHERE id_jurnal = '$jurnal'");
    $koneksi->query("DELETE FROM downloads WHERE id_jurnal = '$jurnal'");
    echo "<script>location='?p=dokumen&aksi=seeall';</script>";
}
?>