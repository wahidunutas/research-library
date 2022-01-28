 <ul class="nav nav-tabs" id="acc-isi" role="tablist">

     <?php
        foreach ($datatipe as $key => $value) : ?>
         <li class="nav-item">
             <a class="nav-link <?php if ($value['nama_tipe'] == 'Thesis') {
                                    echo 'active';
                                } else {
                                    echo '';
                                } ?>" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#<?= str_replace(" ", "-", $value['nama_tipe']); ?>-acc" role="tab" aria-controls="<?= $value['nama_tipe'] ?>" aria-selected="false"><?= $value['nama_tipe']; ?> [
                 <?php
                    if ($value['nama_tipe'] == 'Jurnal') {
                        $sqljrnl = $koneksi->query("SELECT * FROM jurnal WHERE status_jurnal='Disetujui'");
                        $pend = $sqljrnl->num_rows;
                        echo $pend;
                    } else {
                        $typ = $value['nama_tipe'];
                        $sql1 = $koneksi->query("SELECT * FROM dokumen JOIN info_doc ON info_doc.id_info_doc=dokumen.id_info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe WHERE nama_tipe = '$typ' AND status_doc ='Disetujui'");
                        $pending = $sql1->num_rows;
                        echo $pending;
                    }
                    ?>
                 ]</a>
         </li>
     <?php endforeach; ?>

 </ul>
 <div class="tab-content" id="acc-isiContent">
     <?php foreach ($datatipe as $key => $value) : ?>
         <div class="tab-pane fade <?php if ($value['nama_tipe'] == 'Thesis') {
                                        echo 'show active';
                                    } else {
                                        echo '';
                                    } ?>" id="<?= str_replace(" ", "-", $value['nama_tipe']) ?>-acc" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
             <?php
                if ($value['nama_tipe'] !== "Jurnal") {
                    echo '
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Penulis</th>
                                <th>Tanggal Upload</th>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Lihat</th>
                            </tr>
                            </thead> '; ?>
                 <?php
                    $x = $value['nama_tipe'];
                    $sql = "SELECT * FROM dokumen JOIN info_doc ON info_doc.id_info_doc=dokumen.id_info_doc JOIN author ON author.id_author=dokumen.id_author JOIN tipe ON tipe.id_tipe=info_doc.id_tipe WHERE dokumen.status_doc='Disetujui' AND nama_tipe='$x' ";
                    $sql_run = mysqli_query($koneksi, $sql);

                    if (mysqli_num_rows($sql_run) > 0) {
                        $no = 1;
                        foreach ($sql_run as $doc) {
                            $art = substr($doc['judul'], 0, 50) . '...';
                    ?>
                         <?php
                            echo '
                                <tbody>
                                <tr>
                                    <td>' . $no . '</td>
                                    <td>' . $doc['nama_penulis'] . '</td>
                                    <td>' . $doc['tgl_upload'] . '</td>
                                    <td>' . $art . '</td>
                                    <td>' . $doc['status_doc'] . '</td>
                                    <td>
                                    <a href="?p=dokumen&aksi=seeall" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                                </tbody>'; ?>
                         <?php $no++; ?>
                 <?php
                        }
                    } else {
                        echo "<td>Tidak Ada Data</td>";
                    }
                    ?>
                 <?php echo '
                        </table>
                        </div>
                    </div>
                    '; ?>
             <?php
                } else {
                    echo '
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>No</th>
                                 <th>Judul</th>
                                <th>Posted By </th>
                                <th>Tanggal Upload</th>
                                <th>Status</th>
                                <th>Lihat</th>
                            </tr>
                            </thead> '; ?>
                 <?php
                    $x = $value['nama_tipe'] == "Jurnal";
                    $sql = "SELECT * FROM jurnal WHERE status_jurnal='Disetujui'";
                    $sql_run = mysqli_query($koneksi, $sql);

                    if (mysqli_num_rows($sql_run) > 0) {
                        $no = 1;
                        foreach ($sql_run as $doc) {
                            $art = substr($doc['judul'], 0, 50) . '...';
                    ?>
                         <?php
                            echo '
                                <tbody>
                                <tr>
                                    <td>' . $no . '</td>
                                    <td>' . $art . '</td>
                                    <td>' . $doc['posted_by'] . '</td>
                                    <td>' . $doc['tgl_upload_jurnal'] . '</td>
                                    <td>' . $doc['status_jurnal'] . '</td>
                                    <td>
                                   <a href="?p=dokumen&aksi=seeall" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                                </tbody>'; ?>
                         <?php $no++; ?>
                 <?php
                        }
                    } else {
                        echo "<td>Tidak Ada Data</td>";
                    }
                    ?>
             <?php echo '
                        </table>
                        </div>
                    </div>
                    ';
                }
                ?>
         </div>
     <?php endforeach; ?>

 </div>