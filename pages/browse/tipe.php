<h5>Filter By Tipe</h5><hr>
<div class="card shadow">
    <div class="card-body">
        <?php
            $sql = "SELECT * FROM tipe WHERE nama_tipe != 'Jurnal'";
            $result = mysqli_query($koneksi,$sql);
            if(mysqli_num_rows($result) > 0){
                echo '<ul>';
                while($row = mysqli_fetch_assoc($result)){

                    echo '<li><i class="fas fa-angle-right"></i> <a href="karya-ilmiah.php?tipe='.$row['nama_tipe'].'">'.$row['nama_tipe'].'</a></li>';
                }
                echo '</ul>';
            }
        ?>
    </div>
</div>