<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <img src="../assets/logo-title.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Admin Panel</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <?php
        $id = $_SESSION['admin']['id_admin'];
        $sql = $koneksi->query("SELECT * FROM admin WHERE id_admin = '$id'");
        $profile = $sql->fetch_assoc();
        if (!$profile['profile']) {
          echo ' <img class="profile-user-img img-fluid img-circle" src="../assets/dist/img/user.png" alt="User profile picture">';
        } else {
          echo '<img class="profile-user-img img-fluid img-circle" src="profile_admin/' . $profile['profile'] . '" alt="User profile picture" style="width:40px;height:40px;;">';
        }
        ?>
      </div>
      <div class="info">
        <a href="?page=profile" class="d-block">
          <?php
          $id = $_SESSION["admin"]["id_admin"];
          $sql = $koneksi->query("SELECT * FROM admin JOIN akses ON admin.id_admin=akses.id_admin WHERE admin.id_admin = '$id'");
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
          <a href="?p=" class="nav-link <?php if ($page == '') {
                                          echo 'active';
                                        } ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item ">
          <a href="?p=berita" class="nav-link <?php if ($page == "berita") {
                                                echo 'active';
                                              } ?>">
            <i class="nav-icon fas fa-newspaper"></i>
            <p>
              Berita
            </p>
          </a>
        </li>
        <li class="nav-item <?php if ($page == "dosen") {
                              echo "menu-open";
                            } elseif ($page == "mahasiswa") {
                              echo "menu-open";
                            } ?>">
          <a href="#" class="nav-link <?php if ($page == "dosen") {
                                        echo "active";
                                      } elseif ($page == "mahasiswa") {
                                        echo "active";
                                      } ?>">
            <i class="nav-icon fas fa-user-tie"></i>
            <p>
              Civitas Akademik
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?p=dosen" class="nav-link <?php if ($page == "dosen") {
                                                    echo 'active';
                                                  } ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Dosen</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?p=mahasiswa" class="nav-link <?php if ($page == "mahasiswa") {
                                                        echo 'active';
                                                      } ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Mahasiswa</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item ">
          <a href="?p=dokumen" class="nav-link <?php if ($page == "dokumen") {
                                                  echo 'active';
                                                } ?>">
            <i class="nav-icon fas fa-file-pdf"></i>
            <?php
            $sql = $koneksi->query("SELECT * FROM dokumen WHERE status_doc='Pending'");
            $sqlj = $koneksi->query("SELECT * FROM jurnal WHERE status_jurnal='Pending'");
            $badge = $sql->num_rows;
            $jrnl = $sqlj->num_rows;
            $notif = $badge + $jrnl;
            ?>
            <p>
              Karya Ilmiah <sup><span class="badge badge-danger"><?= $notif; ?></span></sup>
            </p>
          </a>
        </li>
        <li class="nav-item <?php if ($page == "tipe") {
                              echo "menu-open";
                            } elseif ($page == "fakultas") {
                              echo "menu-open";
                            } elseif ($page == "jurusan") {
                              echo "menu-open";
                            }elseif ($page == "visi") {
                              echo "menu-open";
                            } elseif ($page == "tipejurnal") {
                              echo "menu-open";
                            } ?>">
          <a href="#" class="nav-link <?php if ($page == "tipe") {
                                        echo "active";
                                      } elseif ($page == "fakultas") {
                                        echo "active";
                                      }elseif ($page == "jurusan") {
                                        echo "menu-open";
                                      }elseif ($page == "visi") {
                                        echo "menu-open";
                                      } elseif ($page == "tipejurnal") {
                                        echo "menu-open";
                                      }?>">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Data Lainya
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?p=tipe" class="nav-link <?php if ($page == "tipe") {
                                                  echo 'active';
                                                } ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Tipe</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?p=tipejurnal" class="nav-link <?php if ($page == "tipejurnal") {
                                                  echo 'active';
                                                } ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Tipe Jurnal</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?p=fakultas" class="nav-link <?php if ($page == "fakultas") {
                                                      echo 'active';
                                                    } ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Fakultas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?p=jurusan" class="nav-link <?php if ($page == "jurusan") {
                                                      echo 'active';
                                                    } ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Jurusan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?p=visi" class="nav-link <?php if ($page == "visi") {
                                                      echo 'active';
                                                    } ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Visi Misi</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-header">LAINYA</li>
        <!-- <li class="nav-item" > -->
        <?php
        //  $sqls = $koneksi->query("SELECT * FROM admin");
        //  $rsl = $sqls->fetch_assoc();
        if ($x['jabatan'] == 'AdminDefault') {
          echo '
                <li class="nav-item ">
                <a href="#" class="nav-link ">
                  <i class="nav-icon fas fa-user-shield"></i>
                  <p>
                    Admin
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="?p=addadmin" class="nav-link ">
                    <i class="nav-icon fas fa-user-plus"></i>
                      <p>Add New Admin</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="?p=dataadmin" class="nav-link ">
                      <i class="fas fa-table nav-icon"></i>
                      <p>Data Admin</p>
                    </a>
                  </li>
                </ul>
              </li>
                ';
        } else {
        }
        ?>

        <!-- <a href="?p=addadmin" class="nav-link">
              <i class="nav-icon fas fa-user-plus"></i>
              <p>
                Add New Admin
              </p>
            </a>
          </li> -->
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