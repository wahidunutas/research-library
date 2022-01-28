<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <!-- SEARCH -->
                <form class="form-inline my-2 my-lg-0" method="get" action="">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
                </form><hr>
                <!-- TAHUN -->
                <form action="" method="get">
                    <div class="row">
                        <div class="col">
                            <select name="tahun" class="form-control form-control-sm">
                                <option value="">-Select Tahun-</option>
                                <?php
                                $mulai= date('Y') - 25;
                                for($i = $mulai;$i<$mulai + 50;$i++){
                                    $sel = $i == date('Y') ?  : '';
                                    echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
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
    </div>
    <!-- col1 -->
    <div class="col">
        <div class="row">
            <div class="col-md-8">
                <?php
                    $tahun = $_GET['tahun'];
                    if($tahun){
                        $sql_thn = "SELECT * FROM jurnal WHERE DATE_FORMAT(tgl_upload_jurnal, '%Y')='$tahun'";
                        $sql_thn_run = mysqli_query($koneksi,$sql_thn);
                        if(mysqli_num_rows($sql_thn_run) > 0)
                        {
                            foreach($sql_thn_run as $thn)
                            {?>
                            <div class="card">
                                <div class="card-body">
                                    <div class="media mb-3">
                                        <div class="media-body">
                                            <h6 class="mt-0"><a href="<?= $thn['link'];?>"><?= $thn['judul'];?></a></h6>
                                            <small><?= $thn['tgl_upload_jurnal'];?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                        }
                    }
                    // if tahun
                ?>
                
            </div>
            <!-- row col -->
            <div class="col">
            <div class="card">
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end col1 -->
</div>