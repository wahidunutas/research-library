<?php include "template/template2/header.php";?>
<?php
error_reporting(0);
$p = $_GET['p'];
$tipe = $_GET['tipe'];
$thn = $_GET['tahun'];
$fakultas = $_GET['fakultas'];
$keyword = $_GET['keyword'];
$jurusan = $_GET['jurusan'];
$author = $_GET['author'];
$author2 = $_GET['author2'];
$hal = (isset($_GET['hal'])) ? (int) $_GET['hal'] : 1;
$limit = 5;
$limitStart = ($hal - 1) * $limit;
// if($_GET['id']){
// }
?>
<!-- KONTEN -->
<div class="content">
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-2">
                <div class="card shadow">
                    <div class="card-header"><i class="fas fa-list"></i> FILTER</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item <?php if($p == 'auth'){echo 'active';}?> "> <i class="fas fa-angle-right"></i><a href="?p=auth  "> By Author</a></li>

                            <li class="list-group-item <?php if($p == 'fak'){echo 'active';}?>"> <i class="fas fa-angle-right"></i><a href="?p=fak  "> By Fakultas</a></li>

                            <li class="list-group-item <?php if($p == 'tipe'){echo 'active';}?>"> <i class="fas fa-angle-right"></i><a href="?p=tipe  "> By Tipe</a></li>

                            <li class="list-group-item <?php if($p == 'years'){echo 'active';}?>"> <i class="fas fa-angle-right"></i><a href="?p=years  "> By Years</a></li>
                        </ul>
                       
                    </div>
                </div>
            </div>
            <div class="col-md-7">

                <?php
                // JIKA ADA VARIABEL $TIPE
                if($tipe){
                    $batas = 15;
                    $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
                    $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	

                    $previous = $halaman - 1;
                    $next = $halaman + 1;
                    
                    $data = mysqli_query($koneksi,"SELECT * FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe WHERE tipe.nama_tipe='$tipe' AND dokumen.status_doc='Disetujui' ORDER BY info_doc.id_info_doc DESC");
                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data / $batas);

                    $doc1 = "SELECT * FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe JOIN fakultas ON fakultas.id_fakultas=info_doc.id_fakultas JOIN jurusan ON jurusan.id_jurusan=info_doc.id_jurusan WHERE tipe.nama_tipe='$tipe' AND dokumen.status_doc='Disetujui' ORDER BY info_doc.id_info_doc DESC LIMIT $halaman_awal, $batas";
                    $query = mysqli_query($koneksi,$doc1);
                    ?>
                    <?php
                    if(mysqli_num_rows($query) > 0){?>
                    <div class="card shadow">
                    <div class="card-body">
                    <ul class="list-group list-group-flush">
                    <?php foreach($query as $ads)
                    { ?>
                        <li class="list-group-item">
                        <h6 class="mt-0 text-capitalize"><a href="index.php?p=dokumen&id=<?= $ads['id_info_doc'];?>"><i class="fas fa-angle-right"></i> <?= $ads['judul'];?></a></h6>
                        <small> 
                        <?php
                        if(empty($ads['nama_penulis_2'])){
                            echo $ads['nama_penulis'];
                        }else{
                            echo '1. '.$ads['nama_penulis'].', 2. '.$ads['nama_penulis_2'];
                        }?> | <?=$ads['nama_tipe'];?> | <?=$ads['tgl_upload'];?> | <?= $ads['fakul'];?> > <?= $ads['jur'];?> 
                         <?php 
                        if(!empty($ads['dospem'] )){
                            echo '| 1. '.$ads['dospem'].',&nbsp;&nbsp;';
                            if(!empty($ads['dospem_2'])){
                                echo'2. '.$ads['dospem_2'];
                            }else{
                                echo'';
                            }
                            
                        }else{
                            echo '';
                        }
                        ?>
                        </small>
                        </li>
                            
                        <?php } ?>  
                    </ul>
                    </div>
                    </div>
                    <ul class="pagination mt-2">
                        <li class="page-item">
                            <a class="page-link" <?php if($halaman > 1){ echo "href='?tipe=$tipe&halaman=$Previous'"; } ?>>Previous</a>
                        </li>
                        <?php 
                        for($x=1;$x<=$total_halaman;$x++){
                            ?> 
                            <li class="page-item"><a class="page-link" href="?tipe=<?= $tipe;?>&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                            <?php
                        }
                        ?>				
                        <li class="page-item">
                            <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?tipe=$tipe&halaman=$next'"; } ?>>Next</a>
                        </li>
                    </ul>
                    <?php }else{
                        echo '
                        <div class="row">
                        <div class="col">
                            <div class="alert alert-warning alert-dismissible shadow">
                            <a href="karya-ilmiah.php?p=tipe" type="button" class="close"  aria-hidden="true">&times;</a>
                            <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                            Data Yang Anda Cari Saat Ini Tidak Tersedia
                            </div>
                        </div>
                        </div>';
                    } ?>  
                    <!-- JIKA ADA VARIABEL TAHUN -->
                <?php }elseif($thn){
                    $batas = 15;
                    $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
                    $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	
    
                    $previous = $halaman - 1;
                    $next = $halaman + 1;
                    
                    $data = mysqli_query($koneksi,"SELECT * FROM dokumen JOIN info_doc ON info_doc.id_info_doc=dokumen.id_info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe WHERE DATE_FORMAT(tgl_upload, '%Y')='$thn' AND dokumen.status_doc='Disetujui'");
                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data / $batas);
    
                    $sql = "SELECT * FROM dokumen JOIN info_doc ON info_doc.id_info_doc=dokumen.id_info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe JOIN fakultas ON fakultas.id_fakultas=info_doc.id_fakultas JOIN jurusan ON jurusan.id_jurusan=info_doc.id_jurusan WHERE DATE_FORMAT(tgl_upload, '%Y')='$thn' AND dokumen.status_doc='Disetujui' ORDER BY dokumen.id_doc DESC limit $halaman_awal, $batas";
                    $thn_run = mysqli_query($koneksi, $sql);
                    ?>
                    <?php
                    if(mysqli_num_rows($thn_run) > 0){ ?>

                    <div class="card shadow">
                    <div class="card-body">
                    <ul class="list-group list-group-flush">

                    <?php foreach($thn_run as $tahun)
                    {   
                    ?>
                    <li class="list-group-item">
                        <h6 class="mt-0 text-capitalize"><a href="index.php?p=dokumen&id=<?= $tahun['id_info_doc'];?>"><i class="fas fa-angle-right"></i> <?= $tahun['judul'];?></a></h6>
                        <small> 
                        <?php
                        if(empty($tahun['nama_penulis_2'])){
                            echo $tahun['nama_penulis'];
                        }else{
                            echo '1. '.$tahun['nama_penulis'].', 2. '.$tahun['nama_penulis_2'];
                        }?> | <?=$tahun['nama_tipe'];?> | <?=$tahun['tgl_upload'];?> | <?=$tahun['fakul'];?> > <?=$tahun['jur'];?> 
                         <?php 
                            if(!empty($tahun['dospem'] )){
                                echo '| 1. '.$tahun['dospem'].',&nbsp;&nbsp;';
                                if(!empty($tahun['dospem_2'])){
                                    echo'2. '.$tahun['dospem_2'];
                                }else{
                                    echo'';
                                }
                                
                            }else{
                                echo '';
                            }
                        ?>
                    </small>
                    </li>        
                    <?php } ?>
                    </ul>
                    </div>
                    </div>
                    <ul class="pagination mt-2">
                        <li class="page-item">
                            <a class="page-link" <?php if($halaman > 1){ echo "href='?tahun=$thn&halaman=$Previous'"; } ?>>Previous</a>
                        </li>
                        <?php 
                        for($x=1;$x<=$total_halaman;$x++){
                            ?> 
                            <li class="page-item"><a class="page-link" href="?tahun=<?= $thn ?>&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                            <?php
                        }
                        ?>				
                        <li class="page-item">
                            <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?tahun=$thn&halaman=$next'"; } ?>>Next</a>
                        </li>
                    </ul>
                    <?php }else{
                        echo'
                        <div class="row">
                        <div class="col">
                            <div class="alert alert-warning alert-dismissible shadow">
                            <a href="karya-ilmiah.php" type="button" class="close"  aria-hidden="true">&times;</a>
                            <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                            Data Yang Anda Cari Saat Ini Tidak Tersedia
                            </div>
                        </div>
                        </div>
                        ';
                    } ?>
                    <!-- FAKULTAS -->
                <?php }elseif($fakultas){
                    $batas = 5;
                    $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
                    $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	

                    $previous = $halaman - 1;
                    $next = $halaman + 1;
                    
                    $data = mysqli_query($koneksi,"SELECT * FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe JOIN fakultas ON fakultas.id_fakultas=info_doc.id_fakultas JOIN jurusan ON jurusan.id_jurusan=info_doc.id_jurusan  WHERE dokumen.status_doc='Disetujui' AND fakultas.fakul='$fakultas' ORDER BY dokumen.id_doc DESC");

                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data / $batas);

                        $fakul = "SELECT * FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe JOIN fakultas ON fakultas.id_fakultas=info_doc.id_fakultas JOIN jurusan ON jurusan.id_jurusan=info_doc.id_jurusan  WHERE dokumen.status_doc='Disetujui' AND fakultas.fakul='$fakultas'  ORDER BY dokumen.id_doc DESC limit $halaman_awal,$batas";
                        $query_fakul = mysqli_query($koneksi,$fakul);
                    ?>
                    <?php
                    if(mysqli_num_rows($query_fakul) > 0){?>
                        <?php $query = $koneksi->query("SELECT * FROM visi_misi JOIN fakultas ON fakultas.id_fakultas=visi_misi.id_vm WHERE fakul='$fakultas'");
                        $data = $query->fetch_assoc();?>

                        <div class="card shadow mb-3">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col">
                                        <b class="text-uppercase">VISI & MISI fakultas <?=$fakultas;?></b>
                                    </div>
                                    <div class="col-1">
                                        <button type="button" class="btn btn-sm" id="btn-minus" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body card-body-minus mr-5" style="display:none;">
                            <?= $data["visi"];?>
                            </div>
                        </div>
                        
                        <div class="card shadow">
                        <div class="card-body">
                        <ul class="list-group list-group-flush">
                        <?php foreach($query_fakul as $fakul){
                        ?>
                            <li class="list-group-item">
                                <h6 class="mt-0 text-capitalize"><a href="index.php?p=dokumen&id=<?= $fakul['id_info_doc'];?>"><i class="fas fa-angle-right"></i> <?= $fakul['judul'];?></a></h6>
                                <small>
                                <?php
                                if(empty($fakul['nama_penulis_2'])){
                                    echo $fakul['nama_penulis'];
                                }else{
                                    echo '1. '.$fakul['nama_penulis'].', 2. '.$fakul['nama_penulis_2'];
                                }?> | <?=$fakul['nama_tipe'];?> | <?=$fakul['tgl_upload'];?> | <?= $fakul['fakul'];?> > <?= $fakul['jur'];?> 
                                <?php 
                                if(!empty($fakul['dospem'] )){
                                    echo '| 1. '.$fakul['dospem'].',&nbsp;&nbsp;';
                                    if(!empty($fakul['dospem_2'])){
                                        echo'2. '.$fakul['dospem_2'];
                                    }else{
                                        echo'';
                                    }
                                    
                                }else{
                                    echo '';
                                }
                                ?>
                                </small>
                            </li>
                            
                        <?php } ?>
                        </ul>
                        </div>
                        </div>
                        <ul class="pagination mt-2">
                            <li class="page-item">
                                <a class="page-link" <?php if($halaman > 1){ echo "href='?fakultas=$fakultas&halaman=$Previous'"; } ?>>Previous</a>
                            </li>
                            <?php 
                            for($x=1;$x<=$total_halaman;$x++){
                                ?> 
                                <li class="page-item"><a class="page-link" href="?fakultas=<?= $fakultas?>&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                                <?php
                            }
                            ?>				
                            <li class="page-item">
                                <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?fakultas=$fakultas&halaman=$next'"; } ?>>Next</a>
                            </li>
                        </ul>
                        <?php
                    }else{
                        $query = $koneksi->query("SELECT * FROM visi_misi JOIN fakultas ON fakultas.id_fakultas=visi_misi.id_vm WHERE fakul='$fakultas'");
                        $data = $query->fetch_assoc();
                        echo '
                        <div class="card shadow mb-3">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col">
                                        <b class="text-uppercase">VISI & MISI fakultas '.$fakultas.'</b>
                                    </div>
                                    <div class="col-1">
                                        <button type="button" class="btn btn-sm" id="btn-minus" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body card-body-minus mr-5">
                            '.$data["visi"].'
                            </div>
                        </div>


                        <div class="row">
                        <div class="col">
                            <div class="alert alert-warning alert-dismissible shadow">
                            <a href="karya-ilmiah.php" type="button" class="close"  aria-hidden="true">&times;</a>
                            <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                            Data Yang Anda Cari Saat Ini Tidak Tersedia
                            </div>
                        </div>
                        </div>
                        ';
                    }
                }elseif($jurusan){
                    $batas = 5;
                    $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
                    $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	

                    $previous = $halaman - 1;
                    $next = $halaman + 1;
                    
                    $data = mysqli_query($koneksi,"SELECT * FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe JOIN fakultas ON fakultas.id_fakultas=info_doc.id_fakultas JOIN jurusan ON jurusan.id_jurusan=info_doc.id_jurusan WHERE dokumen.status_doc='Disetujui' AND jurusan.jur='$jurusan' ORDER BY dokumen.id_doc DESC");
                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data / $batas);

                        $jur = "SELECT * FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe JOIN fakultas ON fakultas.id_fakultas=info_doc.id_fakultas JOIN jurusan ON jurusan.id_jurusan=info_doc.id_jurusan WHERE dokumen.status_doc='Disetujui' AND jurusan.jur='$jurusan'  ORDER BY dokumen.id_doc DESC limit $halaman_awal,$batas";
                        $query_fakul = mysqli_query($koneksi,$jur);
                    ?>
                    <?php
                    if(mysqli_num_rows($query_fakul) > 0){?>
                        
                        <div class="card shadow">
                        <div class="card-body">
                        <ul class="list-group list-group-flush">
                        <?php foreach($query_fakul as $jrsn){
                        ?>
                            <li class="list-group-item">
                                <h6 class="mt-0 text-capitalize"><a href="index.php?p=dokumen&id=<?= $jrsn['id_info_doc'];?>"><i class="fas fa-angle-right"></i> <?= $jrsn['judul'];?></a></h6>
                                <small> 
                                <?php 
                                if(empty($jrsn['nama_penulis_2'])){
                                    echo $jrsn['nama_penulis'];
                                }else{
                                    echo '1. '.$jrsn['nama_penulis'].', 2. '.$jrsn['nama_penulis_2'];
                                }?> | <?=$jrsn['nama_tipe'];?> | <?=$jrsn['tgl_upload'];?> | <?= $jrsn['fakul'];?> > <?= $jrsn['jur'];?> 
                                <?php 
                                if(!empty($jrsn['dospem'] )){
                                    echo '| 1. '.$jrsn['dospem'].',&nbsp;&nbsp;';
                                    if(!empty($jrsn['dospem_2'])){
                                        echo'2. '.$jrsn['dospem_2'];
                                    }else{
                                        echo'';
                                    }
                                    
                                }else{
                                    echo '';
                                }
                                ?>
                                </small>
                            </li>
                            
                        <?php } ?>
                        </ul>
                        </div>
                        </div>
                        <ul class="pagination mt-2">
                            <li class="page-item">
                                <a class="page-link" <?php if($halaman > 1){ echo "href='?jurusan=$jurusan&halaman=$Previous'"; } ?>>Previous</a>
                            </li>
                            <?php 
                            for($x=1;$x<=$total_halaman;$x++){
                                ?> 
                                <li class="page-item"><a class="page-link" href="?jurusan=<?= $jurusan?>&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                                <?php
                            }
                            ?>				
                            <li class="page-item">
                                <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?jurusan=$jurusan&halaman=$next'"; } ?>>Next</a>
                            </li>
                        </ul>
                        <?php
                    }else{
                        echo'
                        <div class="row">
                        <div class="col">
                            <div class="alert alert-warning alert-dismissible shadow">
                            <a href="karya-ilmiah.php?p=fak" type="button" class="close"  aria-hidden="true">&times;</a>
                            <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                            Data Yang Anda Cari Saat Ini Tidak Tersedia
                            </div>
                        </div>
                        </div>
                        ';
                    }

                }elseif($author){
                    $batas = 15;
                    $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
                    $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	

                    $previous = $halaman - 1;
                    $next = $halaman + 1;
                    
                    $data = mysqli_query($koneksi,"SELECT * from  info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe JOIN fakultas ON fakultas.id_fakultas=info_doc.id_fakultas WHERE dokumen.status_doc='Disetujui' AND nama_penulis='$author' ");
                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data / $batas);

                    $sql_cari = "SELECT * FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe JOIN fakultas ON fakultas.id_fakultas=info_doc.id_fakultas JOIN jurusan  ON jurusan.id_jurusan=info_doc.id_jurusan WHERE dokumen.status_doc='Disetujui' AND nama_penulis='$author' ORDER BY info_doc.id_info_doc DESC LIMIT $halaman_awal, $batas";
                    $sql_cari_run = mysqli_query($koneksi,$sql_cari);

                    if(mysqli_num_rows($sql_cari_run) > 0){
                        ?>
                        <div class="card shadow">
                        <div class="card-body">
                        <?php
                        foreach($sql_cari_run as $data){
                        ?>
                        <!-- <div class="col"> -->
                        <ul class="list-group list-group-flush">
                            <?php 
                            if($data['status_doc']=="Disetujui"){
                                echo'
                                <li class="list-group-item"><a href="index.php?p=dokumen&id='. $data['id_info_doc'].'"><h6 class="mt-0 text-capitalize"> <i class="fas fa-angle-right"></i> '. $data['judul'].'</h6></a>
                                <small>'; if(empty($data['nama_penulis_2'])){
                                            echo $data['nama_penulis'];
                                        }else{
                                            echo '1. '.$data['nama_penulis'].', 2. '.$data['nama_penulis_2'];
                                        } 
                                        echo ' | '.$data['nama_tipe'].' | '.$data['tgl_upload'].' | '. $data['fakul'].' > '. $data['jur'].'';

                                if(!empty($data['dospem'] )){
                                    echo '| 1. '.$data['dospem'].',&nbsp;&nbsp;';
                                    if(!empty($data['dospem_2'])){
                                        echo'2. '.$data['dospem_2'];
                                    }else{
                                        echo'';
                                    }
                                    
                                }else{
                                    echo '';
                                }
                                
                                echo'</small>
                                </li>';
                                
                            }elseif($data['status_doc']=="Pending"){
                                echo'
                                
                                ';
                            }
                            ?>
                            <!-- <small><?= $data['nama_penulis'];?> | <?=$data['nama_tipe'];?> | <?=$data['tgl_upload'];?> | <?= $data['fakultas'];?> | <?=$data['dospem'];?></small> -->
                                    
                            <!-- </div> -->
                            <!-- <hr> -->
                            <?php } ?>
                        </ul>
                        </div>
                        </div>
                        <ul class="pagination mt-2">
                            <li class="page-item">
                                <a class="page-link" <?php if($halaman > 1){ echo "href='?keyword=$keyword&halaman=$Previous'"; } ?>>Previous</a>
                            </li>
                            <?php 
                            for($x=1;$x<=$total_halaman;$x++){
                                ?> 
                                <li class="page-item"><a class="page-link" href="?keyword=<?= $keyword?>&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                                <?php
                            }
                            ?>				
                            <li class="page-item">
                                <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?keyword=$keyword&halaman=$next'"; } ?>>Next</a>
                            </li>
                        </ul>
                    <?php }else{
                        echo'
                        <div class="row">
                        <div class="col">
                            <div class="alert alert-warning alert-dismissible shadow">
                            <a href="karya-ilmiah.php" type="button" class="close"  aria-hidden="true">&times;</a>
                            <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                            Data Yang Anda Cari Saat Ini Tidak Tersedia
                            </div>
                        </div>
                        </div>
                        ';
                    } ?>
                
                
                
                
                
                
                
                
                <?php }elseif($author2){
                    $batas = 15;
                    $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
                    $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	

                    $previous = $halaman - 1;
                    $next = $halaman + 1;
                    
                    $data = mysqli_query($koneksi,"SELECT * from  info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe JOIN fakultas ON fakultas.id_fakultas=info_doc.id_fakultas WHERE dokumen.status_doc='Disetujui' AND nama_penulis_2 = '$author2'");
                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data / $batas);

                    $sql_cari = "SELECT * FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe JOIN fakultas ON fakultas.id_fakultas=info_doc.id_fakultas JOIN jurusan  ON jurusan.id_jurusan=info_doc.id_jurusan WHERE dokumen.status_doc='Disetujui' AND nama_penulis_2 = '$author2' ORDER BY info_doc.id_info_doc DESC LIMIT $halaman_awal, $batas";
                    $sql_cari_run = mysqli_query($koneksi,$sql_cari);

                    if(mysqli_num_rows($sql_cari_run) > 0){
                        ?>
                        <div class="card shadow">
                        <div class="card-body">
                        <?php
                        foreach($sql_cari_run as $data){
                        ?>
                        <!-- <div class="col"> -->
                        <ul class="list-group list-group-flush">
                            <?php 
                            if($data['status_doc']=="Disetujui"){
                                echo'
                                <li class="list-group-item"><a href="index.php?p=dokumen&id='. $data['id_info_doc'].'"><h6 class="mt-0 text-capitalize"> <i class="fas fa-angle-right"></i> '. $data['judul'].'</h6></a>
                                <small>'; if(empty($data['nama_penulis_2'])){
                                            echo $data['nama_penulis'];
                                        }else{
                                            echo '1. '.$data['nama_penulis'].', 2. '.$data['nama_penulis_2'];
                                        } 
                                        echo ' | '.$data['nama_tipe'].' | '.$data['tgl_upload'].' | '. $data['fakul'].' > '. $data['jur'].'';

                                if(!empty($data['dospem'] )){
                                    echo '| 1. '.$data['dospem'].',&nbsp;&nbsp;';
                                    if(!empty($data['dospem_2'])){
                                        echo'2. '.$data['dospem_2'];
                                    }else{
                                        echo'';
                                    }
                                    
                                }else{
                                    echo '';
                                }
                                
                                echo'</small>
                                </li>';
                                
                            }elseif($data['status_doc']=="Pending"){
                                echo'
                                
                                ';
                            }
                            ?>
                            <!-- <small><?= $data['nama_penulis'];?> | <?=$data['nama_tipe'];?> | <?=$data['tgl_upload'];?> | <?= $data['fakultas'];?> | <?=$data['dospem'];?></small> -->
                                    
                            <!-- </div> -->
                            <!-- <hr> -->
                            <?php } ?>
                        </ul>
                        </div>
                        </div>
                        <ul class="pagination mt-2">
                            <li class="page-item">
                                <a class="page-link" <?php if($halaman > 1){ echo "href='?keyword=$keyword&halaman=$Previous'"; } ?>>Previous</a>
                            </li>
                            <?php 
                            for($x=1;$x<=$total_halaman;$x++){
                                ?> 
                                <li class="page-item"><a class="page-link" href="?keyword=<?= $keyword?>&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                                <?php
                            }
                            ?>				
                            <li class="page-item">
                                <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?keyword=$keyword&halaman=$next'"; } ?>>Next</a>
                            </li>
                        </ul>
                    <?php }else{
                        echo'
                        <div class="row">
                        <div class="col">
                            <div class="alert alert-warning alert-dismissible shadow">
                            <a href="karya-ilmiah.php" type="button" class="close"  aria-hidden="true">&times;</a>
                            <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                            Data Yang Anda Cari Saat Ini Tidak Tersedia
                            </div>
                        </div>
                        </div>
                        ';
                    } ?>
                    <?php }elseif($keyword){
                        $batas = 15;
                        $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
                        $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	

                        $previous = $halaman - 1;
                        $next = $halaman + 1;
                        
                        $data = mysqli_query($koneksi,"SELECT * from  info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe JOIN fakultas ON fakultas.id_fakultas=info_doc.id_fakultas ");
                        $jumlah_data = mysqli_num_rows($data);
                        $total_halaman = ceil($jumlah_data / $batas);

                        $sql_cari = "SELECT * FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe JOIN fakultas ON fakultas.id_fakultas=info_doc.id_fakultas JOIN jurusan ON jurusan.id_jurusan=info_doc.id_jurusan WHERE dokumen.status_doc='Disetujui' AND judul LIKE '%$keyword%' OR dospem LIKE '%$keyword%' OR nama_penulis LIKE '%$keyword%' OR nama_tipe LIKE '%$keyword%' OR fakul LIKE '%$keyword%'  OR jur LIKE '%$keyword%' ORDER BY info_doc.id_info_doc DESC LIMIT $halaman_awal, $batas";
                        $sql_cari_run = mysqli_query($koneksi,$sql_cari);

                        if(mysqli_num_rows($sql_cari_run) > 0){
                            ?>
                            <div class="card shadow">
                            <div class="card-body">
                            <?php
                            foreach($sql_cari_run as $data){
                            ?>
                            <!-- <div class="col"> -->
                            <ul class="list-group list-group-flush">
                                <?php 
                                if($data['status_doc']=="Disetujui"){
                                    echo'
                                    <li class="list-group-item"><a href="index.php?p=dokumen&id='. $data['id_info_doc'].'"><h6 class="mt-0 text-capitalize"> <i class="fas fa-angle-right"></i> '. $data['judul'].'</h6></a>
                                    <small>';
                                    if(empty($data['nama_penulis_2'])){
                                        echo $data['nama_penulis'];
                                    }else{
                                        echo '1. '.$data['nama_penulis'].', 2. '.$data['nama_penulis_2'];
                                    }
                                    echo
                                    ' | ' .$data['nama_tipe'].' | '.$data['tgl_upload'].' | '. $data['fakul'].' > '. $data['jur'].'';

                                    if(!empty($data['dospem'] )){
                                        echo '| 1. '.$data['dospem'].',&nbsp;&nbsp;';
                                        if(!empty($data['dospem_2'])){
                                            echo'2. '.$data['dospem_2'];
                                        }else{
                                            echo'';
                                        }
                                        
                                    }else{
                                        echo '';
                                    }
                                    echo'</small></li>';
                                }elseif($data['status_doc']=="Pending"){
                                    echo'
                                    ';
                                }
                                ?>
                                <!-- <small><?= $data['nama_penulis'];?> | <?=$data['nama_tipe'];?> | <?=$data['tgl_upload'];?> | <?= $data['fakultas'];?> | <?=$data['dospem'];?></small> -->
                                        
                                <!-- </div> -->
                                <!-- <hr> -->
                                <?php } ?>
                            </ul>
                            </div>
                            </div>
                            <ul class="pagination mt-2">
                                <li class="page-item">
                                    <a class="page-link" <?php if($halaman > 1){ echo "href='?keyword=$keyword&halaman=$Previous'"; } ?>>Previous</a>
                                </li>
                                <?php 
                                for($x=1;$x<=$total_halaman;$x++){
                                    ?> 
                                    <li class="page-item"><a class="page-link" href="?keyword=<?= $keyword?>&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                                    <?php
                                }
                                ?>				
                                <li class="page-item">
                                    <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?keyword=$keyword&halaman=$next'"; } ?>>Next</a>
                                </li>
                            </ul>
                        <?php }else{
                            echo'
                            <div class="row">
                                <div class="col">
                                    <div class="alert alert-warning alert-dismissible shadow">
                                        <a href="karya-ilmiah.php" type="button" class="close"  aria-hidden="true">&times;</a>
                                        <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                                        Data Yang Anda Cari Saat Ini Tidak Tersedia
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                    ?>
                <?php }else{
                    
                    if($p == ""){
                        include "pages/browse/default.php";
                    }elseif($p == "auth"){
                        include "pages/browse/auth.php";
                    }elseif($p == "years"){
                        include "pages/browse/year.php";
                    }elseif($p == "fak"){
                        include "pages/browse/fakultas.php";
                    }elseif($p == "tipe"){
                        include "pages/browse/tipe.php";
                    }
                    
                } ?>
                
            </div>
            <div class="col">
                <div class="card shadow">
                    <div class="card-body">
                        <form action="karya-ilmiah.php" method="get" class="form-inline my-4 my-lg-0">
                            <input class="form-control mr-sm-1" style="width:80%" type="search" placeholder="Search" name="keyword" aria-label="Search">
                            <button class="btn btn-primary my-2 my-sm-0" name="cari" type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="card shadow mt-4">
                    <div class="card-header">Paling Banyak Didownload</div>
                    <div class="card-body">
                        <?php
                        $sql_don = $koneksi->query("SELECT id_info_doc, id_jurnal, judul, sum(jml) as jml FROM downloads GROUP BY id ORDER BY jml DESC LIMIT $limitStart, $limit");
                        while ($top = $sql_don->fetch_assoc()) {
                            echo '
                                    <li class="text-capitalize"> <i class="fas fa-angle-right"></i>';
                            if ($top['id_jurnal'] == 0) {
                                echo ' <a href="index.php?p=dokumen&id=' . $top['id_info_doc'] . '">' . $top['judul'] . ' (' . $top['jml'] . ')</a>';
                            } elseif ($top['id_info_doc'] == 0) {
                                echo '
                                        <a href="index.php?p=bacajurnal&id=' . $top['id_jurnal'] . '">' . $top['judul'] . ' (' . $top['jml'] . ')</a>
                                        ';
                            }
                            echo '
                                    </li>
                                    ';
                        } ?>
                    </div>
                </div>
                <div class="card shadow mt-4">
                    <div class="card-header">Paling Banyak Dibaca</div>
                    <div class="card-body">
                        <?php 
                        
                        $sql_don = $koneksi->query("SELECT id_info_doc, id_jurnal, judul, sum(jml) as jml FROM views GROUP BY id_views ORDER BY jml DESC LIMIT $limitStart,$limit");
                        while($top = $sql_don->fetch_assoc()){
                            echo'
                            <li class="text-capitalize"> <i class="fas fa-angle-right"></i>'; 
                            if($top['id_jurnal'] == 0){
                                echo' <a href="index.php?p=dokumen&id='.$top['id_info_doc'].'">'.$top['judul'].'</a>';
                            }elseif($top['id_info_doc'] == 0){
                                echo'
                                <a href="index.php?p=bacajurnal&id='.$top['id_jurnal'].'">'.$top['judul'].'</a>
                                ';
                            }
                            echo'
                            </li>
                            ';
                        }
                    
                        ?>
                    </div>
                </div>
                <div class="card shadow mt-4">
                    <div class="card-header">Tautan</div>
                    <div class="card-body">
                        <a href="https://trilogi.ac.id/universitas/" target="_BLANK">Universitas Trilogi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php include "template/template2/footer.php";?>