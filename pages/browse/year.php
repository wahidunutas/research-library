<h5>Filter By Year</h5><hr>
<div class="card shadow">
    <div class="card-body">
        <?php
        $qry = mysqli_query($koneksi, "SELECT tgl_upload, count(tgl_upload) as jml FROM dokumen  WHERE status_doc='Disetujui' GROUP BY year(tgl_upload)");
        while($t = mysqli_fetch_array($qry)){
            $data = explode('-',$t['tgl_upload']);
            $tahun = $data[0];
            ?>
                <li><i class="fas fa-angle-right"></i> <a href="karya-ilmiah.php?tahun=<?= $tahun;?>"><?= $tahun;?></a> (<?= $t['jml'];?>)</li>
            <?php
        }
        ?>
    </div>
</div>