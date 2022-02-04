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

if($abj){
    // sql penulis 1
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' AND nama_penulis LIKE '$abj%' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);

    // sql penulis 2
    $sql2 = "SELECT DISTINCT nama_penulis_2 FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui'  AND nama_penulis_2 LIKE '$abj%'";
    $result2 = mysqli_query($koneksi,$sql2);
    
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
            <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
            <?php
        }
    }
    if(mysqli_num_rows($result2) > 0){
        foreach($result2 as $data2){
            if(!empty($data2['nama_penulis_2'])){
                echo'
                <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author2='.$data2['nama_penulis_2'].'">'.$data2['nama_penulis_2'].'</a>&nbsp;&nbsp;&nbsp';
            }
        }   
    }
    if(mysqli_num_rows($result) !== 1 && mysqli_num_rows($result2) !== 1){
        echo 'Data tidak ada';
    }
    
}else{
    $sql = "SELECT DISTINCT nama_penulis FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' ORDER BY nama_penulis ASC";
    $result = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){?>
            <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author=<?= $data['nama_penulis'];?>"><?= $data['nama_penulis'];?></a>&nbsp;&nbsp;&nbsp;
            <?php
        }
        $sql2 = $koneksi->query("SELECT DISTINCT nama_penulis_2 FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc WHERE status_doc='Disetujui' ");
        while($pen2 = $sql2->fetch_assoc()){
            if(!empty($pen2['nama_penulis_2'])){
                echo'
                <i class="fas fa-angle-right"></i>&nbsp;<a href="karya-ilmiah.php?author2='.$pen2['nama_penulis_2'].'">'.$pen2['nama_penulis_2'].'</a>&nbsp;&nbsp;&nbsp';
            }else{
                echo'';
            }
        }
    }else{
        echo'Data tidak ada';
    }
}




?>