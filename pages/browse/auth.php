<h5>Browse By Author</h5><hr>
<div class="card shadow">
    <div class="card-body">
        <a href="?p=auth&abj=a"> A </a> |
        <a href="?p=auth&abj=b"> B </a> |
        <a href="?p=auth&abj=c"> C </a> | 
        <a href="?p=auth&abj=d"> D </a> | 
        <a href="?p=auth&abj=e"> E </a> | 
        <a href="?p=auth&abj=f"> F </a> | 
        <a href="?p=auth&abj=g"> G </a> | 
        <a href="?p=auth&abj=h"> H </a> | 
        <a href="?p=auth&abj=i"> I </a> | 
        <a href="?p=auth&abj=j"> J </a> | 
        <a href="?p=auth&abj=k"> K </a> | 
        <a href="?p=auth&abj=l"> L </a> | 
        <a href="?p=auth&abj=m"> M </a> | 
        <a href="?p=auth&abj=n"> N </a> | 
        <a href="?p=auth&abj=o"> O </a> | 
        <a href="?p=auth&abj=p"> P </a> | 
        <a href="?p=auth&abj=q"> Q </a> | 
        <a href="?p=auth&abj=r"> R </a> | 
        <a href="?p=auth&abj=s"> S </a> | 
        <a href="?p=auth&abj=t"> T </a> | 
        <a href="?p=auth&abj=u"> U </a> | 
        <a href="?p=auth&abj=v"> V </a> | 
        <a href="?p=auth&abj=w"> W </a> | 
        <a href="?p=auth&abj=x"> X </a> | 
        <a href="?p=auth&abj=y"> Y </a> | 
        <a href="?p=auth&abj=z"> Z </a> |
        <a href="?p=auth"> < </a>
    </div>
</div><hr>
<?php
$abj = $_GET['abj'];
if($abj == ""){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){?>
        
        <?php
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }
}elseif($abj == "a"){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE 'a%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){?>
        <!-- <i class="fas fa-angle-left"></i> <a href="?p=auth">back</a> <br> -->
        <?php
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }else{
        echo "Tidak Ada Data";
    }
}elseif($abj == "b"){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE 'b%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }else{
        echo "Tidak Ada Data";
    }
}elseif($abj == "c"){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE 'c%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }else{
        echo "Tidak Ada Data";
    }
}elseif($abj == "d"){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE 'd%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }else{
        echo "Tidak Ada Data";
    }
}elseif($abj == "e"){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE 'e%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }else{
        echo "Tidak Ada Data";
    }
}elseif($abj == "f"){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE 'f%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }else{
        echo "Tidak Ada Data";
    }
}elseif($abj == "g"){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE 'g%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }else{
        echo "Tidak Ada Data";
    }
}elseif($abj == "h"){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE 'h%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }else{
        echo "Tidak Ada Data";
    }
}elseif($abj == "i"){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE 'i%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }else{
        echo "Tidak Ada Data";
    }
}elseif($abj == "j"){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE 'j%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }else{
        echo "Tidak Ada Data";
    }
}elseif($abj == "k"){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE 'k%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }else{
        echo "Tidak Ada Data";
    }
}elseif($abj == "l"){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE 'l%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }else{
        echo "Tidak Ada Data";
    }
}elseif($abj == "m"){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE 'm%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }else{
        echo "Tidak Ada Data";
    }
}elseif($abj == "n"){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE 'n%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }else{
        echo "Tidak Ada Data";
    }
}elseif($abj == "o"){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE 'o%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }else{
        echo "Tidak Ada Data";
    }
}elseif($abj == "p"){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE 'p%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }else{
        echo "Tidak Ada Data";
    }
}elseif($abj == "q"){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE 'q%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }else{
        echo "Tidak Ada Data";
    }
}elseif($abj == "r"){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE 'r%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }else{
        echo "Tidak Ada Data";
    }
}elseif($abj == "s"){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE 's%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }else{
        echo "Tidak Ada Data";
    }
}elseif($abj == "t"){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE 't%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }else{
        echo "Tidak Ada Data";
    }
}elseif($abj == "u"){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE 'u%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }else{
        echo "Tidak Ada Data";
    }
}elseif($abj == "v"){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE 'v%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }else{
        echo "Tidak Ada Data";
    }
}elseif($abj == "w"){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE 'w%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }else{
        echo "Tidak Ada Data";
    }
}elseif($abj == "x"){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE 'x%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }else{
        echo "Tidak Ada Data";
    }
}elseif($abj == "y"){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE 'y%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }else{
        echo "Tidak Ada Data";
    }
}elseif($abj == "z"){
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE 'z%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
        <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
        <?php
        }
    }else{
        echo "Tidak Ada Data";
    }
}

?>