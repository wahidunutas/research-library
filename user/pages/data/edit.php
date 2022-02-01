<?php
$id = $_GET['id'];
$sql = $koneksi->query("SELECT * FROM data_dokumen JOIN info_doc ON info_doc.id_info_doc=data_dokumen.id_info_doc WHERE id_data_dokumen = '$id'");
$data = $sql->fetch_assoc();

$zip = $_GET['zip'];
$sqlZip = $koneksi->query("SELECT * FROM data_file_project WHERE id_data_file='$zip'");
$dataZip = $sqlZip->fetch_assoc();

$db = $_GET['sql'];
$sqlDb = $koneksi->query("SELECT * FROM data_file_project WHERE id_data_file ='$db'");
$dataDb = $sqlDb->fetch_assoc();

$jurnal = $_GET['jurnal'];
$sqlJurnal = $koneksi->query("SELECT * FROM jurnal WHERE id_jurnal = '$jurnal'");
$dataJurnal = $sqlJurnal->fetch_assoc();
?>
<div class="content-header">
</div>
<?php
if(isset($id)){
    echo'
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" readonly value="'.$data['files'].'" name="file_lama" class="form-control">
                        <input type="hidden" readonly value="'.$data['named_file'].'" name="nama_file_lama" class="form-control">
                        <input type="hidden" value="'.$data['id_data_dokumen'].'" name="idx">
                        <input type="hidden" value="'.$data['id_info_doc'].'" name="idi">
                    </div>
                    <div class="form-group">
                        <input type="file" name="isi">
                    </div>      
                        <button type="submit" class="btn btn-primary btn-sm" name="yes">Ubah</button>
                        <a href="?page=data&act=kirimulang&id='.$data['id_info_doc'].'" class="btn btn-danger btn-sm">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            <h4>File Sebelumnya</h4>
            <embed src="dokumen/'.$data['named_file'].'#toolbar=0" type="application/pdf" width="100%" height="500px">
        </div>
    </div>
    ';
}elseif(isset($zip)){
     echo '
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" readonly value="'.$dataZip['file_project'].'" name="d" class="form-control">
                        <input type="text" hidden value="'.$dataZip['file_project'].'" name="nama_zip_lama" class="form-control">
                        <input type="hidden" value="'.$dataZip['id_data_file'].'" name="idZip">
                    </div>
                    <div class="form-group">
                        <input type="file" name="fileZip" required>
                    </div>      
                        <button type="submit" class="btn btn-primary btn-sm" name="zip">Ubah</button>
                        <a href="?page=data&act=kirimulang&id='.$dataZip['id_info_doc'].'" class="btn btn-danger btn-sm">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            <h4>File Sebelumnya</h4>'.$dataZip['file_project'].'<br>';
            $zips = new ZipArchive();
            $Fzip = $dataZip['file_project'];
            if ($zips->open('dokumen/project/'.$Fzip) === true) {
                for ($i = 0; $i < $zips->numFiles; $i++) {
                    echo '=> '.$zips->getNameIndex($i).'<br>';     
                }
            }
            echo'
        </div>
    </div>
    ';
}else{
    echo '
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" readonly value="'.$dataJurnal['name_file'].'" name="file_lama" class="form-control">
                         <input type="hidden" readonly value="'.$dataJurnal['file'].'" name="files_lama" class="form-control">
                        <input type="hidden" value="'.$dataJurnal['id_jurnal'].'" name="idj">
                    </div>
                    <div class="form-group">
                        <input type="file" name="filejurnal">
                    </div>      
                        <button type="submit" class="btn btn-primary btn-sm" name="jurnal">Ubah</button>
                        <a href="?page=data&act=kirimulang&jurnal='.$dataJurnal['id_jurnal'].'" class="btn btn-danger btn-sm">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            <h4>File Sebelumnya</h4>
            <embed src="dokumen/jurnal/'.$dataJurnal['file'].'#toolbar=0" type="application/pdf" width="100%" height="500px">
        </div>
    </div>
    ';

}
?>
<?php
if(isset($_POST['yes'])){
    $idi = $_POST['idi'];
    $loc = $_FILES['isi']['tmp_name'];
    $isi = $_FILES['isi']['name'];
    $file_lama = $_POST['file_lama'];
    $lama = $_POST['nama_file_lama'];

    $ekstensiValid = ['pdf'];
    $ekstensiFile = explode('.', $isi);
    $ekstensiFile = strtolower(end($ekstensiFile));
    $namedFile = uniqid();
    $namedFile .= '.';
    $namedFile .= $ekstensiFile;
    if(!empty($loc))
    {
        if( !in_array($ekstensiFile, $ekstensiValid) ){
            echo"
            <script>
            Swal.fire(
                'Opss!',
                'Pastikan File Berekstensi PDF',
                'error'
                )
            </script>
            ";
            return false;
        }
        move_uploaded_file($loc, "dokumen/".$namedFile);
        // unlink("dokumen/$foto_lama"); 
        $koneksi->query("UPDATE data_dokumen SET 
            files       = '$isi',
            named_file  = '$namedFile'
            WHERE id_data_dokumen = '$id'");

    }else{
        $koneksi->query("UPDATE data_dokumen SET 
            files       = '$fileLama',
            named_file  = '$lama'
            WHERE id_data_dokumen = '$id'
        ");
    }
    if (file_exists("dokumen/". $lama)) {
        unlink("dokumen/". $lama);
    }
    echo"
    <script>
        Swal.fire(
            'Data Berhasil Diubah',
            '',
            'success'
        );
    </script>";
    echo"<meta http-equiv='refresh' content='2;url=?page=data&act=kirimulang&id=$data[id_info_doc]'>";
}

if(isset($_POST['jurnal'])){
    $loc = $_FILES['filejurnal']['tmp_name'];
    $isiJ = $_FILES['filejurnal']['name'];
    $file_lama = $_POST['file_lama'];
    $filesLm = $_POST['files_lama'];

    $ekstensiValid = ['pdf'];
    $ekstensiFile = explode('.', $isiJ);
    $ekstensiFile = strtolower(end($ekstensiFile));
    $named = uniqid();
    $named .= '.';
    $named .= $ekstensiFile;

    if(!empty($loc))
    {
        if( !in_array($ekstensiFile, $ekstensiValid) ){
            echo"
            <script>
            Swal.fire(
                'Opss!',
                'Pastikan File Berekstensi PDF',
                'error'
                )
            </script>
            ";
            return false;
        }
        move_uploaded_file($loc, "dokumen/jurnal/".$named);
        // unlink("dokumen/$foto_lama"); 
        $koneksi->query("UPDATE jurnal SET 
            file       = '$named',
            name_file  = '$isiJ'
            WHERE id_jurnal = '$jurnal'");
        if (file_exists("dokumen/jurnal/". $filesLm)) {
            unlink("dokumen/jurnal/". $filesLm);
        }
    }else{
        $koneksi->query("UPDATE jurnal SET 
            file       = '$file_lama',
            name_file  = '$filesLm'
            WHERE id_jurnal = '$jurnal'
        ");
    }
    echo"
    <script>
        Swal.fire(
            'Data Berhasil Diubah',
            '',
            'success'
        );
    </script>";
    echo"<meta http-equiv='refresh' content='2;url=?page=data&act=kirimulang&jurnal=$dataJurnal[id_jurnal]'>";
}

if(isset($_POST['zip'])){
    $lcZip = $_FILES['fileZip']['tmp_name'];
    $namaZip = $_FILES['fileZip']['name'];
    $zipLama = $_POST['nama_zip_lama'];
    $id = $_POST['idZip'];

    $ekstensiV = ['zip'];
    $ekstensi = explode('.', $namaZip);
    $ekstensi = strtolower(end($ekstensi));

    if(!empty($lcZip))
    {
        if( !in_array($ekstensi, $ekstensiV) ){
            echo"
            <script>
            Swal.fire(
                'Opss!',
                'Pastikan Ekstensi Yang Di Upload ZIP',
                'error'
                )
            </script>
            ";
            return false;
        }
        move_uploaded_file($lcZip, "dokumen/project/".$namaZip);
        // unlink("dokumen/$foto_lama"); 
        $koneksi->query("UPDATE data_file_project SET
            file_project  = '$namaZip'
            WHERE id_data_file = '$id'");

        if (file_exists("dokumen/project/$zipLama")) {
            unlink("dokumen/project/$zipLama");
        }

        echo"
        <script>
            Swal.fire(
                'Data Berhasil Diubah',
                '',
                'success'
            );
        </script>";
        echo"<meta http-equiv='refresh' content='2;url=?page=data&act=kirimulang&id=$dataZip[id_info_doc]'>";
    }


}