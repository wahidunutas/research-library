
<a class="menu-toggle rounded" href="#"><i class="fas fa-bars"></i></a>
<ul class="sidebar-nav" id="sidebar-wrapper">
    <li class="sidebar-brand"><a href="#page-top">Menu</a></li>
    <li class="sidebar-nav-item"><a href="index.php">Home</a></li>
    <!-- <li class="sidebar-nav-item"><a href="?p=dokumen">Dokumen</a></li> -->
    <li class="sidebar-nav-item"><a href="?p=berita">Berita</a></li>
    <li class="sidebar-nav-item"><a href="jurnal.php">Jurnal</a></li>
    <li class="sidebar-nav-item"><a href="karya-ilmiah.php">Karya Ilmiah</a></li>
    <hr>
    <?php 
    if(isset($_SESSION['login']['id_author'])){
        echo "<li class='sidebar-nav-item'><a href='user/index.php'>Profile</a></li>";
    }elseif(isset($_SESSION['admin']['id_admin'])){
        echo"<li class='sidebar-nav-item'><a href='admin/index.php'>Admin Panel</a></li>";
    }else{
        echo"<li class='sidebar-nav-item'><a href='?p=masuk'>Masuk</a></li>";
    }
    ?>
</ul>