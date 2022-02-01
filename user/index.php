<?php
session_start();

include "pages/koneksi.php";

if(!isset($_SESSION['login'])){
  header("location:../?p=masuk");
}
error_reporting(0);
$page = $_GET['page'];
$act = $_GET['act'];
$jns = $_GET['jns'];
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
        echo "<script type='text/javascript'>Swal.fire('Opss!','Session Telah Berakhir','error')</script>";
        echo"<meta http-equiv='refresh' content='2;url=$logout'>";
    }
}
$_SESSION['start_session'] = time();
?>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <?php
          
          if($page == ""){
            if($act == ""){
              include "pages/dashboard.php";
            }
          }elseif($page == "upload"){
            if($act == ""){
              include "pages/upload/index.php";
            }
          }elseif($page == "profile"){
            include "pages/editprofile.php";
          }elseif($page == "data"){
            if($act == ""){
              include "pages/data/data.php";
            }elseif($act == "detail"){
              include "pages/data/detail.php";
            }elseif($act == "lihat"){
              include "pages/data/seepdf.php";
            }elseif($act == "kirimulang"){
              include "pages/data/kirimulang.php";
            }elseif($act == "edit"){
              include "pages/data/edit.php";
            }
          }elseif($jns == "sulit"){
            $fak_id = $_POST['fak_id'];
            $getcity = $koneksi->query("SELECT  * FROM jurusan JOIN fakultas ON fakultas.id_fakultas=jurusan.id_fakultas WHERE jurusan.id_fakultas ='$fak_id'");
            while($data = mysqli_fetch_assoc($getcity)){
                echo '<option type="hidden" value="'.$data['id_jurusan'].'">'.$data['jur'].'</option>';
            }
          }
        ?>
        
      </div>
    </section>
  </div>
  
<?php include "template/footer.php";?>
<script>
  for($x=1;$x<=8; $x++){
    // multi upload file
    $(document).ready(function(){
        $(".btn-tambah").on("click", function(){
            $(".letak-input").append("<input type='file' class='form-control mt-1' name='doc[]' required/> ");
        })
    })
  }

  // multi upload foto
  $(document).ready(function(){
      $(".btn-x").on("click", function(){
          $(".letak").append("<input type='file' class='form-control mt-1' name='doc[]' required/> ");
      })
  })

  function myFunction() {
      var x = document.getElementById("dis");
      x.disabled = true;
  }
  
  $(document).ready(function(){
    $("#btn-dsn").on('click',function(){
      $(".dsn-show").slideDown();
      var x = document.getElementById("btn-dsn");
      x.hidden = true;
    });
    $("#btn-dsn-hidden").on('click', function(){
      $(".dsn-show").slideUp();
      var x = document.getElementById("btn-dsn");
      x.hidden = false;
    });
  })

  $(document).ready(function(){
    $('#btn-namaPenulis').on('click', function(){
      $('.nama-show').slideDown();
      var btn = document.getElementById("btn-namaPenulis");
      btn.hidden = true;
    });
    $("#btn-nm-hidden").on('click', function(){
      $(".nama-show").slideUp();
      var btn = document.getElementById("btn-namaPenulis");
      btn.hidden = false;
    });
  })
  
  $(document).ready(function(){
    $("#tipe").on('change', function(){
        const named = $('#tipe option:selected').data('named');
        $('[name=names]').val(named); 
        if($('[name=names]').val() == 'Jurnal'){
          $("#showtipe").show("fast");
          $("#upf").hide("fast"); 
          $("#upf2").hide("fast");
          $("#master").hide("fast"); 
          $("#jurnal").show("fast"); 
          $("#showCover").show("fast");
          $("#btn-jur").show("fast");
          $("#btn-def").hide("fast");
        }else{
          $("#showtipe").slideUp("fast");
          $("#upf").show("fast");
          $("#upf2").show("fast");
          $("#master").show("fast"); 
          $("#jurnal").hide("fast"); 
          $("#showCover").hide("fast");
          $("#btn-jur").hide("fast");
          $("#btn-def").show("fast");

        }

    });

  });
</script>