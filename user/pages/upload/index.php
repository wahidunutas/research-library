<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Upload Karya Ilmiah</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=data">Home</a></li>
                    <li class="breadcrumb-item active"><?= $page; ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<form method="post" enctype="multipart/form-data">
    <?php
    $x = $_SESSION['login']['id_author'];
    $sql = $koneksi->query("SELECT *  FROM author JOIN akses ON akses.id_author=author.id_author WHERE author.id_author='$x'");
    $nama = $sql->fetch_assoc();
    ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                    <input type="hidden" class="form-control" name="status" value="Pending">
                    <h4><b><em>Informasi</b></em></h4>
                    <hr>
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" name="judul">
                    </div>
                    <div class="form-group">
                        <!-- <input type="text" class="form-control" name="nama" > -->
                        <label>Nama Penulis</label>
                        <div class="row g-0 my-0">
                            <div class="col-11">
                                <input type="text" class="form-control" name="nama" placeholder="Nama Penulis" required> 
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary" id="btn-namaPenulis">+</button>
                            </div>
                        </div>
                        <div class="nama-show mt-2" style="display:none;">
                            <div class="row g-0 my-0">
                                <div class="col-11">
                                    <input type="text" class="form-control" name="nama2" placeholder="Nama Penulis 2"> 
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-danger" id="btn-nm-hidden">x</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- tipe -->
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Tipe</label>
                        <select class="form-control" id="tipe" name="tipe">
                            <option value="">-Pilih Satu-</option>
                            <?php
                            if ($_SESSION["role"] == "dosen") {
                                $sql = $koneksi->query("SELECT * FROM tipe WHERE nama_tipe = 'Laporan Penelitian' OR nama_tipe = 'Jurnal'");
                                while ($type = $sql->fetch_assoc()) {
                                    $datatype[] = $type;
                                }
                                foreach ($datatype as $key => $value) : ?>
                                    <option value="<?= $value['id_tipe']; ?>" data-named='<?= $value['nama_tipe']; ?>'>
                                        <?= $value['nama_tipe']; ?>
                                    </option>
                                <?php
                                endforeach;
                            } else {
                                $sql = $koneksi->query("SELECT * FROM tipe WHERE nama_tipe != 'Laporan Penelitian' ");
                                while ($tipe = $sql->fetch_assoc()) {
                                    $datatipe[] = $tipe;
                                }
                                foreach ($datatipe as $key => $value) : ?>
                                    <option value="<?= $value['id_tipe']; ?>" data-named='<?= $value['nama_tipe']; ?>'>
                                        <?= $value['nama_tipe']; ?>
                                    </option>
                            <?php
                                endforeach;
                            }
                            ?>
                        </select>
                        <input type="hidden" name="names" readonly />

                    </div>
                    <div id="master">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Fakultas</label>
                                    <select class="form-control form-control-sm" name="fakultas" id="fakultas">
                                        <option></option>
                                    </select>
                                </div>

                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Jurusan</label>
                                    <select id="jurusan" name="jurusan" class="form-control form-control-sm">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Abstrak</label>
                            <textarea class="ckeditor" id="ckedtor" name="abstrak"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Daftar Pustaka</label>
                            <textarea class="ckeditor" id="ckedtor" name="dafpus"></textarea>
                        </div>

                        <div class="form-group dsn">
                            <?php 
                            $sql = $koneksi->query("SELECT * FROM tipe ");
                            $return = $sql->fetch_assoc();
                            if ($_SESSION["role"] == "dosen") {
                                echo '';
                            } else {
                                echo '
                                <label>Dosen Pembimbing</label>
                                <div class="row g-0 my-0">
                                    <div class="col-11">
                                        <input type="text" class="form-control" name="dospem1" placeholder="Sertakan Gelar"> 
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-primary" id="btn-dsn">+</button>
                                    </div>
                                </div>
                                <div class="dsn-show mt-2" style="display:none;">
                                    <div class="row g-0 my-0">
                                        <div class="col-11">
                                            <input type="text" class="form-control" name="dospem2" placeholder="Sertakan Gelar"> 
                                        </div>
                                        <div class="col">
                                            <button type="button" class="btn btn-danger" id="btn-dsn-hidden">x</button>
                                        </div>
                                    </div>
                                </div>
                                ';
                            } ?>
                        </div>
                    </div>
                    <!-- Jurnal Element -->
                    <div id="jurnal" style="display:none">
                        <label for="exampleFormControlSelect1">Tipe Jurnal</label>
                        <select class="form-control" id="tipe" name="tipejurnal">
                            <option value="">-Pilih Satu-</option>
                            <?php
                            $sql = $koneksi->query("SELECT * FROM tipe_jurnal");
                            while ($tipejurnal = $sql->fetch_assoc()) {
                                $datatipejurnal[] = $tipejurnal;
                            }
                            foreach ($datatipejurnal as $key => $value) : ?>
                                <option value="<?= $value['id_tipe_jurnal']; ?>" data-named='<?= $value['nama_tipe_jurnal']; ?>'>
                                    <?= $value['nama_tipe_jurnal']; ?>
                                </option>
                            <?php endforeach;
                            ?>
                        </select><br>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="ckeditor" id="ckedtor" name="deskripsi"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Daftar Pustaka</label>
                            <textarea class="ckeditor" id="ckedtor" name="dafpusj"></textarea>
                        </div>
                    </div>

                </div>
                <div class="card-footer">

                    <button type="submit" class="btn btn-primary btn-sm" id="btn-def" name="save">Upload</button>
                    <button type="submit" class="btn btn-primary btn-sm" id="btn-jur" style="display:none" name="saveJurnal">Upload</button>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header"><b>Upload File
                    <div class="bouncing-arrow">
                        <i class="fas fa-question-circle" type="button" data-toggle="modal" data-target="#question"></i>
                    </b>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group" id="upf">
                        <div class="letak-input mb-2">
                            <!-- <input type="file" class="form-control" name="doc[]"> -->
                        </div>
                        <button type="button" class="btn btn-primary btn-sm btn-tambah" id="dis" onclick="myFunction()">
                            <i class="fas fa-plus"> Upload Files</i>
                        </button>
                    </div>
                    <div class="mb-3" id="showtipe" style="display:none;">
                        <input type='file' class='form-control mt-1' name='file'>
                        <div class="form-group">
                            <label for="">Link Jurnal</label>
                            <input type="text" name="link" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" id="upf2">
                <div class="card-header"><b>Upload File Projects
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label><small>File Project [.zip]</small><label>
                        <input type="file" class="form-control" name="file-projek" >

                        <label class="mt-3"><small>File Database <i>[kosongkan jika tidak ada]</i></small></label>
                        <input type="file" class="form-control " name="file-database" >
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</form>


<div class="modal fade" id="question" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Panduan Upload File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item">File pertama adalah: Cover, Abstrak, Lembar Pengesahan (hasil scan), Lembar Originalitas (hasil scan), Surat Pernyataan Persetujuan Publikasi (hasil scan), Kata Pengantar dan Daftar Isi. Nama file adalah COVER.pdf </li>
                    <li class="list-group-item">File kedua adalah: Bab 1 Pendahuluan. Nama file adalah BAB 1.pdf </li>
                    <li class="list-group-item">File ketiga adalah: Bab 2 Landasan Teori. Nama file adalah BAB 2.pdf </li>
                    <li class="list-group-item">File keempat adalah: Bab 3 Metodologi. Nama file adalah BAB 3.pdf </li>
                    <li class="list-group-item">File kelima adalah: Bab 4 Hasil/Pembahasan. Nama file adalah BAB 4.pdf </li>
                    <li class="list-group-item">File keenam adalah: Bab 5 Kesimpulan dan Saran. Nama file adalah BAB 5.pdf </li>
                    <li class="list-group-item">File ketujuh adalah: Daftar Pustaka. Nama file adalah DAFTAR PUSTAKA.pdf </li>
                    <li class="list-group-item">File terakhir adalah: Lampiran dan Daftar Riwayat Hidup. Nama file adalah LAMPIRAN.pdf </li>
                </ul>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>


<?php
if (isset($_POST['save'])) {

    $id_user = $_SESSION['login']['id_author'];

    // info
    $nama = $_POST['nama'];
    $nama2 = $_POST['nama2'];
    $judul = $_POST['judul'];
    $tipe = $_POST['tipe'];
    $dospem = $_POST['dospem1'];
    $dospem2 = $_POST['dospem2'];
    $fakultas = $_POST['fakultas'];
    $abstrak = $_POST['abstrak'];
    $date = date('Y-m-d');
    $status = $_POST['status'];
    $jurusan = $_POST['jurusan'];
    $dafpus = $_POST['dafpus'];

    // file projects
    $fileProjectName = $_POST['file-projek'];
    $fprojek = $_FILES['file-projek']['name'];
    $locationFile = $_FILES['file-projek']['tmp_name'];
    $fdatabase = $_FILES['file-database']['name'];
    $locationFileD = $_FILES['file-database']['tmp_name'];
    $fileValid = ['zip'];
    $eks = strtolower(end(explode('.', $fprojek)));

    if(!in_array($eks, $fileValid) ){
        echo"
        <script>
        Swal.fire(
            'Opss!',
            'Pastikan File Yang Anda Upload Berekstensi ZIP',
            'error'
            )
        </script>
        ";
    }

    // file karya ilmiah
    $namafile = $_FILES['doc']['name'];
    $lokasifile = $_FILES['doc']['tmp_name'];

    $ekstensiFileValid = ['pdf'];
    $ekstensiFile = explode('.', $namafile[0]);
    $ekstensiFile = strtolower(end($ekstensiFile));

    $namedFile = uniqid();
    $namedFile .= '.';
    $namedFile .= $ekstensiFile;

    $sqltipe = $koneksi->query("SELECT * FROM tipe");
    $result = $sqltipe->fetch_assoc();
    $penelitian = $result['Laporan Penelitian'];

    if (empty($judul && $tipe && $nama && $abstrak && $dafpus && $jurusan && $fakultas )) {
        echo "<script>
        Swal.fire(
            'Pastikan Data Telah Terisi Semua',
            '',
            'error'
        );
        </script>";
        return false;
    } else {
        if (in_array($ekstensiFile, $ekstensiFileValid)) {
            
            $x = $koneksi->query("INSERT INTO info_doc(id_info_doc, judul, nama_penulis, nama_penulis_2, id_tipe, id_fakultas, id_jurusan, dospem, dospem_2, abstrak, dafpus)VALUE('', '$judul', '$nama', '$nama2', '$tipe', '$fakultas', '$jurusan', '$dospem', '$dospem2', '$abstrak', '$dafpus')");

            $id = $koneksi->insert_id;
            $koneksi->query("INSERT INTO dokumen(id_doc, id_info_doc, id_author,  tgl_upload, status_doc)VALUE('', '$id', '$id_user', '$date', '$status')");

            move_uploaded_file($locationFile, "dokumen/project/" . $fprojek);
            move_uploaded_file($locationFileD, "dokumen/project/" . $fdatabase);
            if(!empty($fprojek)){
                $koneksi->query("INSERT INTO data_file_project(id_data_file, id_info_doc, file_project, file_database)VALUE('', '$id', '$fprojek', '$fdatabase')");
                
            }elseif(empty($fprojek) && !empty($fdatabase)){
                $koneksi->query("INSERT INTO data_file_project(id_data_file, id_info_doc, file_project, file_database)VALUE('', '$id', '$fprojek', '$fdatabase')");
            }else{
                '';
            }

            $idnew = $koneksi->insert_id;
            foreach ($namafile as $key => $tiapfile) {
                $tiap_lokasi = $lokasifile[$key];
                $x = uniqid();
                $x .= '.';
                $x .= $ekstensiFile;
                move_uploaded_file($tiap_lokasi, "dokumen/" . $x);
                $koneksi->query("INSERT INTO data_dokumen(id_data_dokumen, id_info_doc, id_doc, files, named_file)VALUES('', '$id', '$idnew', '$tiapfile', '$x')");
            }

            
        }else{
            echo "
            <script>
            Swal.fire(
                'Opss!',
                'Pastikan File Yang Anda Upload Berekstensi PDF',
                'error'
                )
                </script>
                ";
            return true;
        }
        
        
        echo "<script>
            Swal.fire(
                'Data File Berhasil Diunggah',
                'Tunggu Setelah Di Proses Admin',
                'success'
                )
            </script>";
        echo "<meta http-equiv='refresh' content='1;url=?page=data'>";
    }
}
// }


if (isset($_POST['saveJurnal'])) {
    // jurnal
    // $id_user = $_SESSION['login']['id_akses'];
    // $a = $koneksi->query("SELECT * FROM author WHERE id_author = '$test'");
    // $b = $a->fetch_assoc();
    // $c = $b['nama'];
    $test = $_SESSION['login']['id_author'];
    $nama = $_POST['nama'];
    $nama2 = $_POST['nama2'];
    $tp = $_POST['tipejurnal'];
    $jdl = $_POST['judul'];
    $link = $_POST['link'];
    $tgl = date('Y-m-d');
    $des = $_POST['deskripsi'];
    $dfp = $_POST['dafpusj'];

    $namafile = $_FILES['file']['name'];
    $lokasifile = $_FILES['file']['tmp_name'];

    $ekstensiFileValid = ['pdf'];
    $ekstensiFile = explode('.', $namafile);
    $ekstensiFile = strtolower(end($ekstensiFile));

    if (!in_array($ekstensiFile, $ekstensiFileValid)) {
        echo "
        <script>
        Swal.fire(
            'Opss!',
            'Pastikan File Yang Anda Upload Berekstensi PDF',
            'error'
            )
        </script>
        ";
        return false;
    }
    $newname = uniqid();
    $newname .= '.';
    $newname .= $ekstensiFile;

    if (empty($jdl && $namafile && $des && $dfp && $tp && $link)) {
        echo "<script>
        Swal.fire(
        'Pastikan Data Telah Terisi Semua',
        '',
            'error'
        );
        </script>";
        echo "<meta http-equiv='refresh' content='1;url=?page=upload'>";
    } else {
        move_uploaded_file($lokasifile, "dokumen/jurnal/" . $newname);

        $koneksi->query("INSERT INTO jurnal(id_jurnal, id_author, tipe_jurnal, judul, tgl_upload_jurnal, deskripsi, daftar_pustaka, file, name_file, posted_by, posted_by2, link, status_jurnal)VALUES('', '$test', '$tp', '$jdl', '$tgl', '$des', '$dfp', '$newname', '$namafile', '$nama', '$nama2', '$link', 'Pending')");

        echo "<script>
        Swal.fire(
            'Data File Berhasil Diunggah',
            'Tunggu Setelah Di Proses Admin',
            'success'
            )
        </script>";
        echo "<meta http-equiv='refresh' content='1;url=?page=data'>";
    }
}


?>