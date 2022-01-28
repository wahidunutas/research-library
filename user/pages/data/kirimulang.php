<?php 

$id = $_GET['id'];
$sql = $koneksi->query("SELECT * FROM info_doc JOIN dokumen ON dokumen.id_info_doc=info_doc.id_info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe JOIN fakultas ON fakultas.id_fakultas=info_doc.id_fakultas JOIN jurusan ON jurusan.id_jurusan=info_doc.id_jurusan WHERE info_doc.id_info_doc = '$id'");
$data = $sql->fetch_assoc();

$jurnal = $_GET['jurnal'];
$sqlJurnal = $koneksi->query("SELECT * FROM jurnal JOIN tipe_jurnal ON jurnal.tipe_jurnal=tipe_jurnal.id_tipe_jurnal WHERE jurnal.id_jurnal = '$jurnal'");
$dataJurnal = $sqlJurnal->fetch_assoc();

$jml = $koneksi->query("SELECT * FROM komentar JOIN info_doc ON info_doc.id_info_doc=komentar.id_info_doc WHERE komentar.id_info_doc='$id'");
$tampil = $jml->num_rows;
?>

<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h6 class="m-0"><a href="?page=data" class="btn btn-danger btn-sm"><i class="fas fa-angle-left "></i> Kembali</a></h6>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <h1 class="m-0">KIRIM ULANG</h1>
        </ol>
        </div>
    </div>
    </div>
</div>
<?php
if(isset($id)){
    echo '
        <div class="row">
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header bg-warning"><i class="fas fa-exclamation-triangle"></i> Notes</div>
                    <div class="card-body ">
                        '.$data['notes'].'
                    </div>
                </div><hr>
                <div class="card">
                    <div class="card-header">FILES</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">';?>
                            <?php 
                            $sql_data = $koneksi->query("SELECT *  FROM info_Doc JOIN data_dokumen ON data_dokumen.id_info_doc=info_doc.id_info_doc WHERE data_dokumen.id_info_doc = '$id'");
                            while($tampil = $sql_data->fetch_assoc()){
                            ?>
                                <li class="list-group-item"><?= $tampil['files'];?>
                                    <a href="?page=data&act=edit&id=<?= $tampil['id_data_dokumen'];?>">edit</a>
                                </li>  
                            <?php } ?>
                        <?php echo'
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">';?>
                    <?php
                        if($data['status_doc'] == "Pending"){
                            echo'<td><span class="badge badge-danger">'.$data['status_doc'].'</span></td>';
                        }elseif($data['status_doc']=="Disetujui"){
                            echo'<td><span class="badge badge-success">'.$data['status_doc'].'</span></td>';
                        }elseif($data['status_doc']=="Tidak Disetujui"){
                            echo'<td><span class="badge badge-warning">'.$data['status_doc'].'</span></td>';
                        }
                    ?>
                    <?php echo'
                    </div>
                    <form method="post">
                    <div class="card-body">
                        <b>JUDUL 
                        </b>
                        <div class="form-group">
                            <input type="text" class="form-control" name="judul" value="'.$data['judul'].'">
                        </div>
                        <HR>
                        <b>NAMA PENULIS</b>
                        <div class="form-group">
                            <input type="text" class="form-control" name="penulis" value="'.$data['nama_penulis'].'">
                        </div>
                        <hr>
                        <b>TIPE</b>';?>
                        <?php
                        $sql = $koneksi->query("SELECT * FROM tipe");
                        while ($tipe = $sql->fetch_assoc())
                        {
                            $datatipe[] = $tipe;
                        }
                        ?>
                        <?php echo'
                        <div class="form-group">
                            <select class="form-control" name="tipe" disabled="true">
                            <option value="" >-Pilih Satu-</option>';?>
                                <?php foreach($datatipe as $key => $value):?>
                                    <option value="<?= $value['id_tipe'];?>" <?php if ($data["nama_tipe"]==$value["nama_tipe"]){ echo "selected" ; }?>>
                                    <?= $value['nama_tipe'];?>
                                </option>
                                <?php endforeach ?>
                            <?php echo'
                            </select>
                        </div>
                        <hr>
                        <b>Fakultas</b>
                        <p>'.$data['fakul'].' -> '.$data['jur'].'</p>
                        <hr>';?>
                        <?php
                        if(!empty($data['dospem'])){
                            echo '
                            <b>DOSEM PEMBIMBING</b>
                            <div class="form-group">
                                <input type="text" class="form-control" name="dospem" value="'. $data['dospem'].'">
                            </div>
                            <hr>
                            ';
                        }else{
                            echo '';
                        }
                        ?>
                        <?php echo'
                        <b>ABSTRAK</b>
                        <div class="form-group">
                            <textarea id="summernote" name="abstrak" placeholder="isi abstrak" required>'. $data['abstrak'].'</textarea>
                        </div>
                        <b>DAFTAR PUSTAKA</b>
                        <div class="form-group">
                            <textarea id="summernote2" name="dafpus" placeholder="isi abstrak" required>'. $data['dafpus'].'</textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="ubah-file" class="btn btn-primary">Kirim Ulang</button>
                    </div>  
                </form>
                </div>
            </div>
        </div>
    
    ';
}else{
    echo '
     <div class="row">
        <div class="col-md-4">
        <form method="post">
            <div class="card ">
                <div class="card-header bg-warning"><i class="fas fa-exclamation-triangle"></i> Notes</div>
                <div class="card-body ">
                    '.$dataJurnal['note'].'
                </div>
            </div><hr>
            <div class="card">
                <div class="card-header">FILES</div>
                <div class="card-body">
                    <b>Link Jurnal</b>
                    <div class="form-group">
                        <input type="text" name="link" value="'.$dataJurnal['link'].'" class="form-control">
                    </div>
                    <b>File Jurnal</b>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">'.$dataJurnal['name_file'].'
                            <a href="?page=data&act=edit&jurnal='.$dataJurnal['id_jurnal'].'">edit</a>
                        </li> 
                    </ul>
                </div>
            </div>
        </div>
        <div class="col">
                <div class="card">
                    <div class="card-header">';?>
                    <?php
                        if($dataJurnal['status'] == "Pending"){
                            echo'<td><span class="badge badge-danger">'.$dataJurnal['status'].'</span></td>';
                        }elseif($dataJurnal['status']=="aprv"){
                            echo'<td><span class="badge badge-success">'.$dataJurnal['status'].'</span></td>';
                        }elseif($dataJurnal['status']=="Tidak Disetujui"){
                            echo'<td><span class="badge badge-warning">'.$dataJurnal['status'].'</span></td>';
                        }
                    ?>
                    <?php echo'
                    </div>
                    
                    <div class="card-body">
                        <b>JUDUL 
                        </b>
                        <div class="form-group">
                            <input type="text" class="form-control" name="judul" value="'.$dataJurnal['judul'].'">
                        </div>
                        <HR>
                        <b>PENULIS</b>
                        <div class="form-group">
                            <input type="text" class="form-control" name="penulis" value="'.$dataJurnal['posted_by'].'" readonly>
                        </div>
                        <hr>';?>
                        <?php
                            $SQL = $koneksi->query("SELECT * FROM tipe_jurnal");
                            while($sqldata = $SQL->fetch_assoc()){
                                $tipe_data[] = $sqldata;
                            }
                            echo'
                            <div class="form-group">
                                <select class="form-control" name="tipe_jurnal">';?>
                                    <?php foreach($tipe_data as $tipe):?>
                                    <option value="<?= $tipe['id_tipe_jurnal'];?>" 
                                    <?php
                                    if($dataJurnal['nama_tipe_jurnal']==$tipe['nama_tipe_jurnal']){
                                        echo 'selected';
                                    }
                                    ?>
                                    ><?= $tipe['nama_tipe_jurnal'];?>
                                    <?php endforeach?>
                                    <?php echo'
                                </select>
                            </div>
                        <b>DESKRIPSI</b>
                        <div class="form-group">
                            <textarea class="ckeditor" id="ckedtor" name="deskripsi">'. $dataJurnal['deskripsi'].'</textarea>
                        </div>
                        <b>DAFTAR PUSTAKA</b>
                        <div class="form-group">
                             <textarea class="ckeditor" id="ckedtor" name="dafpus">'. $dataJurnal['daftar_pustaka'].'</textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="ubah-file-jurnal" class="btn btn-primary">Kirim Ulang</button>
                    </div>  
                </form>
                </div>
            </div>
    </div>
    ';
}
?>

<?php
if(isset($_POST['ubah-file'])){

    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $dopem = $_POST['dospem'];
    $abstrak = $_POST['abstrak'];
    $dafpus = $_POST['dafpus'];
    

    $koneksi->query("UPDATE info_doc SET
        judul = '$judul',
        nama_penulis = '$penulis',
        dospem = '$dopem',
        abstrak = '$abstrak',
        dafpus = '$dafpus'
        WHERE id_info_doc = '$id'
    ");

    $koneksi->query("UPDATE dokumen SET
        status_doc = 'Pending',
        notes = ''
        WHERE id_info_doc = '$id'
    ");
    
    echo"
    <script>
        Swal.fire(
            'Data Berhasil Dikirim Ulang',
            '',
            'success'
        );
    </script>";
    echo"<meta http-equiv='refresh' content='2;url=?page=data'>";
}
if(isset($_POST['ubah-file-jurnal'])){

    $link = $_POST['link'];
    $judul = $_POST['judul'];
    $desc = $_POST['deskripsi'];
    $dafpus = $_POST['dafpus'];
    $tipeJurnal = $_POST['tipe_jurnal'];
    

    $koneksi->query("UPDATE jurnal SET
        tipe_jurnal = '$tipeJurnal',
        judul = '$judul',
        deskripsi = '$desc',
        daftar_pustaka = '$dafpus',
        link = '$link',
        status_jurnal = 'Pending',
        note = ''
        WHERE id_jurnal = '$jurnal'
    ");
    
    echo"
    <script>
        Swal.fire(
            'Data Berhasil Dikirim Ulang',
            '',
            'success'
        );
    </script>";
    echo"<meta http-equiv='refresh' content='2;url=?page=data'>";
}
?>