<?php
session_start();

include "koneksi.php";

if(!isset($_SESSION["admin"])){
  header("location:../?p=masuk");
}

error_reporting(0);
$page = $_GET['p'];
$act = $_GET['aksi'];

$sql1= $koneksi->query("SELECT * FROM author");
$data_mhs= mysqli_num_rows($sql1);
$sql2 = $koneksi->query("SELECT * FROM jurnal;");
$data_jurnal = mysqli_num_rows($sql2);
$sql3 = $koneksi->query("SELECT * FROM dokumen WHERE status_doc='Disetujui'");
$data_app = mysqli_num_rows($sql3);
$sql4 = $koneksi->query("SELECT * FROM dokumen WHERE status_doc = 'Pending'");
$data_pend = mysqli_num_rows($sql4);

?>
<?php include "template/header.php";?>
<?php include "template/sidebar.php";?>
<?php
$timeout = 1; // setting timeout dalam menit
$logout = "../?p=masuk"; // redirect halaman logout

$timeout = $timeout * 900; // 15 menit
if (isset($_SESSION['start_session'])) {
    $elapsed_time = time() - $_SESSION['start_session'];
    if ($elapsed_time >= $timeout) {
        session_destroy();
        echo "<script type='text/javascript'>Swal.fire('Session Telah Berakhir','Login Ulang','error')</script>";
        echo"<meta http-equiv='refresh' content='2;url=$logout'>";
    }
}
$_SESSION['start_session'] = time();
?>
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php
        // dashboard
          if($page == ""){
            if($act == ""){
                include "pages/dashboard.php";
            }
            // Berita
          }elseif($page == "berita"){
            if($act == ""){
              include "pages/berita/index.php";
            }elseif($act == "upload"){
              include "pages/berita/upload.php";
            }elseif($act == "update"){
              include "pages/berita/update.php";
            }
            // Civitas - Dosen
          }elseif($page == "dosen"){
            if($act == ""){
              include "pages/civitas/dosen/dosen.php";
            }if($act == "updatedsn"){
              include "pages/civitas/dosen/updatedosen.php";
            }
            // Civitas - Mahasiswa
          }elseif($page == "mahasiswa"){
            if($act == ""){
              include "pages/civitas/mahasiswa/mahasiswa.php";
            }elseif($act == "updatemhs"){
              include "pages/civitas/mahasiswa/updatemhs.php";
            }
            // Dokumen (cek, dettail, proses)
          }elseif($page == "dokumen"){
            if($act == ""){
              include "pages/cek_dokumen/dokumencek.php";
            }elseif($act == "proses"){
              include "pages/cek_dokumen/proses.php";
            }elseif($act == "prosesJurnal"){
              include "pages/cek_dokumen/prosesJurnal.php";
            }elseif($act == "seepdf"){
              include "pages/cek_dokumen/see.php";
            }elseif($act == "seeall"){
              include "pages/cek_dokumen/semuadata.php";
            }elseif($act == "lihatdoc"){
              include "pages/cek_dokumen/lihatdoc.php";
            }elseif($act == "lihatpdf"){
              include "pages/cek_dokumen/lihatdocpdf.php";
            }
            // tipe
          }elseif($page == "tipe"){
            if($act == ""){
              include "pages/data_lainya/tipe.php";
            }
            // visi misi
          }elseif($page == "visi"){
            if($act == ""){
              include "pages/data_lainya/visi.php";
            }elseif($act == "edit"){
              include "pages/data_lainya/edit_visi.php";
            }
            // fakultas
          }elseif($page == "fakultas"){
            include "pages/data_lainya/fakultas.php";
            // Add Admin
          }elseif($page == "addadmin"){
            include "pages/data_admin/tambah_admin/addNewAdmin.php";
          }elseif($page == "dataadmin"){
            if($act == ""){
              include "pages/data_admin/_data_admin.php";
            }elseif($act == "updateadmin"){
              include "pages/data_admin/_update_admin.php";
            }
            // profile admin
          }elseif($page == "tipejurnal"){
            include "pages/data_lainya/tipejurnal.php";
          }elseif($page == "profile"){
            include "pages/profile.php";
            // Jurusan
          }elseif($page == "jurusan"){
            include "pages/data_lainya/jurusan.php";
          }
        ?>
        
      </div>
    </section>
  </div>
  
<?php include "template/footer.php";?>