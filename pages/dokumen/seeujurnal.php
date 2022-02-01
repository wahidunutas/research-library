<?php
$id = $_GET['id'];
$sql = $koneksi->query("SELECT * FROM jurnal JOIN tipe_jurnal ON tipe_jurnal.id_tipe_jurnal=jurnal.tipe_jurnal WHERE jurnal.id_jurnal = '$id'");
$tampil = $sql->fetch_assoc();
$dafpus = substr($tampil['daftar_pustaka'], 0, 300);

if(isset($id)){
    $forview = $tampil['judul'];
    $views = $koneksi->query("SELECT * FROM views WHERE id_jurnal='$id'");
    $Rviews = mysqli_num_rows($views);
    
    if($Rviews == 1){
        $koneksi->query("UPDATE views SET jml=jml+1 WHERE id_jurnal='$id'");
    }else{
        $koneksi->query("INSERT INTO views(id_views, id_jurnal, judul, jml)VALUES('', '$id','$forview', jml+1)");
    }
}

?>


<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <!-- SEARCH -->
                <form class="form-inline my-2 my-lg-0" method="get" action="jurnal.php">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
                </form>
                <hr>
                <!-- TAHUN -->
                <form action="jurnal.php" method="get">
                    <div class="row">
                        <div class="col">
                            <select name="tahun" class="form-control form-control-sm">
                                <option value="">-Select Tahun-</option>
                                <?php
                                $mulai = date('Y') - 25;
                                for ($i = $mulai; $i < $mulai + 50; $i++) {
                                    $sel = $i == date('Y') ?: '';
                                    echo '<option value="' . $i . '"' . $sel . '>' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary btn-sm" type="submit">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">Jurnal Lainya</div>
            <div class="card-body">
                <?php
                $hal = (isset($_GET['hal'])) ? (int) $_GET['hal'] : 1;
                $limit = 5;
                $limitStart = ($hal - 1) * $limit;
                $ki = $koneksi->query("SELECT * FROM jurnal WHERE status_jurnal='Disetujui' ORDER BY id_jurnal DESC LIMIT $limitStart,$limit");
                while ($kidata = $ki->fetch_assoc()) {
                ?>
                    
                <li><a href="index.php?p=bacajurnal&id=<?= $kidata['id_jurnal'];?>" target="_BLANK" class="karya-ilmiah-jurnal text-capitalized"><i class="fas fa-angle-right"></i> <?= $kidata['judul'];?></li></a>

                <?php } ?>
            </div>
        </div>
        
    </div>
    <!-- Content -->
    <div class="col">
        <div class="card">
            <div class="card-header"><h4 class="text-uppercase text-center text-bold"><?= $tampil['judul'];?></h4>
            <small>
                <center>
                <b>Tipe Jurnal :</b> <?= $tampil['nama_tipe_jurnal'];?> | 
                <b>By :</b> 
                    <?php
                    if(!empty($tampil['posted_by2'])){
                        echo $tampil['posted_by'].', '.$tampil['posted_by2'];
                    }else{
                        echo $tampil['posted_by'];
                    }
                    ?> | 
                <b>Tanggal :</b> <?= $tampil['tgl_upload_jurnal'];?>
                </center>
            </small>
            </div>
            <div class="card-body">
                <h6> File Jurnal : <a href="pdf.php?jurnal=<?= $id;?>" target="_BLANK"><img src="pdf.png" style="width:20px"> <?= $tampil['name_file'];?></a> | <a href="pages/jurnal/download.php?filename=<?= $tampil['name_file'];?>&id=<?= $tampil['id_jurnal'];?>&named=<?= $tampil['file'];?>&judul=<?= $tampil['judul'];?>"><i class="fas fa-download"> </i>Download Jurnal</a> </h6>
                <h6> Link Jurnal : <a href="<?= $tampil['link'];?>" target="_BLANK" class="text-uppercase"><i class="fas fa-link"></i> <?= $tampil['judul'];?></a></h6>
                <hr>
                <h6><b>Deskripsi</b></h6>
                <p><?= $tampil['deskripsi'];?></p>
                <hr>
                <h6><b>Daftar Pustaka</b></h6>
                <p><?= $dafpus;?> <a href="#" data-toggle="modal" data-target="#dafpus">[Lihat Semua Daftar Pustaka]</a></p>
                <!-- Modal -->
                <div class="modal fade" id="dafpus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Daftar Pustaka</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p><?= $tampil['daftar_pustaka'];?></p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>