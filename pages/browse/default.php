<?php
$batas = 15;
$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;
$previous = $halaman - 1;
$next = $halaman + 1;

$data = mysqli_query($koneksi,"SELECT * FROM info_doc");
$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);

$sql_def = "SELECT * FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe JOIN fakultas ON fakultas.id_fakultas=info_doc.id_fakultas JOIN jurusan ON jurusan.id_jurusan=info_doc.id_jurusan WHERE dokumen.status_doc='Disetujui' ORDER BY dokumen.id_doc DESC limit $halaman_awal, $batas";
$sql_def_run = mysqli_query($koneksi,$sql_def);?>

<div class="card shadow">
    <div class="card-body">
        <ul class="list-group list-group-flush">
        <?php
        if(mysqli_num_rows($sql_def_run) > 0){
            foreach($sql_def_run as $default){?>
            <li class="list-group-item">
                <a href="index.php?p=dokumen&id=<?= $default['id_info_doc'];?>"><h6 class="mt-0 text-capitalize"><i class="fas fa-angle-right"></i> <?= $default['judul'];?></h6></a>
                <small><?php
                        if(empty($default['nama_penulis_2'])){
                            echo $default['nama_penulis'];
                        }else{
                            echo '1. '.$default['nama_penulis'].', 2. '.$default['nama_penulis_2'];
                        }
                        ?> | <?=$default['nama_tipe'];?> | <?=$default['tgl_upload'];?> | <?= $default['fakul'];?> > <?= $default['jur'];?> 
                <?php 
                if(!empty($default['dospem'] )){
                    echo '| 1. '.$default['dospem'].',&nbsp;&nbsp;';
                    if(!empty($default['dospem_2'])){
                        echo'2. '.$default['dospem_2'];
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
        <a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$Previous'"; } ?>>Previous</a>
    </li>
    <?php 
    for($x=1;$x<=$total_halaman;$x++){
        ?> 
        <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
        <?php
    }
    ?>				
    <li class="page-item">
        <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
    </li>
</ul>
<?php
}else{
   echo'
    <div class="row">
        <div class="col">
            <div class="alert alert-warning alert-dismissible shadow">
                <a href="karya-ilmiah.php" type="button" class="close" aria-hidden="true">&times;</a>
                <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                Saat Ini Data Tidak Tersedia
            </div>
        </div>
    </div>'; 
}