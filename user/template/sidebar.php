<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <img src="../assets/logo-title.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">User Panel</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <?php
        $id = $_SESSION['login']['id_author'];
        $sql = $koneksi->query("SELECT * FROM author WHERE id_author = '$id'");
        $profile = $sql->fetch_assoc();
        if (!$profile['img']) {
          echo ' <img class="profile-user-img img-fluid img-circle" src="../assets/dist/img/user.png" alt="User profile picture">';
        } else {
          echo '<img class="profile-user-img img-fluid img-circle" src="image_user/' . $profile['img'] . '" alt="User profile picture" style="width:40px;height:40px;;">';
        }
        ?>
      </div>
      <div class="info">
        <a href="?page=profile" class="d-block">
          <?php
          $id = $_SESSION["login"]["id_author"];
          $sql = $koneksi->query("SELECT * FROM author JOIN akses ON author.id_author=akses.id_author WHERE author.id_author = '$id'");
          $x = $sql->fetch_assoc();
          $a = $x['nama'];
          echo "$a";
          ?>
        </a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item ">
          <a href="?page=" class="nav-link <?php if ($page == '') {
                                              echo 'active';
                                            } ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item ">
          <a href="?page=upload" class="nav-link <?php if ($page == 'upload') {
                                                    echo 'active';
                                                  } ?>">
            <i class="nav-icon fas fa-upload"></i>
            <p>
              Upload Karya Ilmiah
            </p>
          </a>
        </li>
        <li class="nav-item ">
          <a href="?page=data" class="nav-link <?php if ($page == 'data') {
                                                  echo 'active';
                                                } ?>">
            <i class="nav-icon fas fa-spinner"></i>
            <p>
              Status
            </p>
          </a>
        </li>
        <li class="nav-header">EXAMPLES</li>
        <li class="nav-item">
          <a href="../index.php" class="nav-link">
            <i class="nav-icon fas fa-angle-left"></i>
            <p>
              Home Site
            </p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>