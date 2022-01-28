<h5>Filter By Fakultas</h5><hr>
<div class="card shadow">
    <div class="card-body">
        <?php
            $sql = "SELECT * FROM fakultas ";
            $result = mysqli_query($koneksi,$sql);
            if(mysqli_num_rows($result) > 0){
                echo '<ul>';
                while($row = mysqli_fetch_assoc($result)){
                    $kat_id = $row['id_fakultas'];
                    $sql2 = $koneksi->query("SELECT * FROM jurusan WHERE id_fakultas='$kat_id'");

                    echo '<li><i class="fas fa-chevron-circle-right"></i> <a href="karya-ilmiah.php?fakultas='.$row['fakul'].'">'.$row['fakul'].'</a>';
                        echo '<ul>';
                            while($row2 = mysqli_fetch_assoc($sql2)){
                                echo '<li><i class="fas fa-angle-right"></i> <a href="karya-ilmiah.php?jurusan='.$row2['jur'].'">'.$row2['jur'].'</a></li>';
                            }
                        echo '</ul>';
                    echo '</li>';
                }
                echo '</ul>';
            }
        ?>

    </div>
</div>