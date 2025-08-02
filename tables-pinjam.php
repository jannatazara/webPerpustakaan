<?php
session_start ();
if (!isset($_SESSION["login"])) {
   header("location:index.php"); 
   exit;
}
// Koneksi Ke database memanggil pada halaman function.php 
require 'functions.php';

//pagination (halaman/page)
$jml_data_perhalaman = 3;
$jml_data = count(query("SELECT 8 FROM tbl_pinjam"));
$jml_halaman = ceil($jml_data / $jml_data_perhalaman);
$halaman_prioritas = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$data_awal = ($jml_data_perhalaman * $halaman_prioritas) - $jml_data_perhalaman;

$siswa = query ("SELECT * from tbl_pinjam LIMIT $data_awal,
$jml_data_perhalaman");



//Tombol Cari di klik
if (isset ($_POST["cari"]) ) {
    $siswa= cari3($_POST["keyword"]);

}
//Ambil data dari tabel siswa/ query data siswa
// $result = mysqli_query($conn, "SELECT * FROM tbl_pinjam");




?>

<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Tables | Tabel Buku</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="../assets/vendor/fonts/materialdesignicons.css" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="../assets/vendor/libs/node-waves/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo me-1">
                <span style="color: var(--bs-primary)">
                  <svg width="30" height="24" viewBox="0 0 250 196" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M12.3002 1.25469L56.655 28.6432C59.0349 30.1128 60.4839 32.711 60.4839 35.5089V160.63C60.4839 163.468 58.9941 166.097 56.5603 167.553L12.2055 194.107C8.3836 196.395 3.43136 195.15 1.14435 191.327C0.395485 190.075 0 188.643 0 187.184V8.12039C0 3.66447 3.61061 0.0522461 8.06452 0.0522461C9.56056 0.0522461 11.0271 0.468577 12.3002 1.25469Z"
                      fill="currentColor" />
                    <path
                      opacity="0.077704"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M0 65.2656L60.4839 99.9629V133.979L0 65.2656Z"
                      fill="black" />
                    <path
                      opacity="0.077704"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M0 65.2656L60.4839 99.0795V119.859L0 65.2656Z"
                      fill="black" />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M237.71 1.22393L193.355 28.5207C190.97 29.9889 189.516 32.5905 189.516 35.3927V160.631C189.516 163.469 191.006 166.098 193.44 167.555L237.794 194.108C241.616 196.396 246.569 195.151 248.856 191.328C249.605 190.076 250 188.644 250 187.185V8.09597C250 3.64006 246.389 0.027832 241.935 0.027832C240.444 0.027832 238.981 0.441882 237.71 1.22393Z"
                      fill="currentColor" />
                    <path
                      opacity="0.077704"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M250 65.2656L189.516 99.8897V135.006L250 65.2656Z"
                      fill="black" />
                    <path
                      opacity="0.077704"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M250 65.2656L189.516 99.0497V120.886L250 65.2656Z"
                      fill="black" />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z"
                      fill="currentColor" />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z"
                      fill="white"
                      fill-opacity="0.15" />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z"
                      fill="currentColor" />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z"
                      fill="white"
                      fill-opacity="0.3" />
                  </svg>
                </span>
              </span>
              <span class="app-brand-text demo menu-text fw-semibold ms-2">Mandala</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboards -->
            <li class="menu-item">
              <a href="../index1.php" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                <div data-i18n="Dashboards">Home</div>
              </a>
            </li>
            <!-- Forms & Tables -->
            <li class="menu-header fw-medium mt-4"><span class="menu-header-text">Forms &amp; Tables</span></li>
            <!-- Forms -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-form-select"></i>
                <div data-i18n="Form Elements">Forms Tambah </div>
              </a>
              <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="formtambah-siswa.php" class="menu-link">
                      <div data-i18n="Horizontal Form">Data Siswa</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="formtambah-user.php" class="menu-link">
                      <div data-i18n="Horizontal Form">Data User</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="formtambah-buku.php" class="menu-link">
                      <div data-i18n="Horizontal Form">Data Buku</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="formtambah-pinjam.php" class="menu-link">
                      <div data-i18n="Horizontal Form">Data Pinjam</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="formtambah-kembali.php" class="menu-link">
                      <div data-i18n="Horizontal Form">Data Kembali</div>
                    </a>
                  </li>
                </ul>
            </li>
            <!-- Tables -->
            <li class="menu-item active open">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons mdi mdi-table"></i>
                  <div data-i18n="Tables">Tables </div>
                </a>
            <ul class="menu-sub">
                 <li class="menu-item">
                    <a href="tables-siswa.php" class="menu-link">
                      <div data-i18n="Tables">Tabel Siswa</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="tables-user.php" class="menu-link">
                      <div data-i18n="Tables">Tabel User</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="tables-buku.php" class="menu-link">
                      <div data-i18n="Tables">Tabel Buku</div>
                    </a>
                  </li>
                  <li class="menu-item active">
                    <a href="tables-pinjam.php" class="menu-link">
                      <div data-i18n="Tables">Tabel Pinjam</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="tables-kembali.php" class="menu-link">
                      <div data-i18n="Tables">Tabel Kembali</div>
                    </a>
                  </li>
                </ul>
              </li>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="mdi mdi-menu mdi-24px"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index1.php">Home</a>
                      </li>
                      <li class="nav-item dropdown">
                        <a
                          class="nav-link dropdown-toggle"
                          href="javascript:void(0)"
                          id="navbarDropdown"
                          role="button"
                          data-bs-toggle="dropdown"
                          aria-expanded="false">
                          Forms
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="formtambah-siswa.php">Tambah Data Siswa</a></li>
                          <li><a class="dropdown-item" href="formtambah-user.php">Tambah Data User</a></li>
                          <li><a class="dropdown-item" href="formtambah-buku.php">Tambah Data Buku</a></li>
                          <li><a class="dropdown-item" href="formtambah-pinjam.php">Tambah Data Pinjam</a></li>
                          <li><a class="dropdown-item" href="formtambah-kembali.php">Tambah Data Kembali</a></li>
                        </ul>
                      </li>
                      <li class="nav-item dropdown">
                        <a
                          class="nav-link dropdown-toggle"
                          href="javascript:void(0)"
                          id="navbarDropdown"
                          role="button"
                          data-bs-toggle="dropdown"
                          aria-expanded="false">
                          Tables
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="tables-siswa.php">Tabel Siswa</a></li>
                          <li><a class="dropdown-item" href="tables-user.php">Tabel User</a></li>
                          <li><a class="dropdown-item" href="tables-buku.php">Tabel Buku</a></li>
                          <li><a class="dropdown-item" href="tables-pinjam.php">Tabel Pinjam</a></li>
                          <li><a class="dropdown-item" href="tables-kembali.php">Tabel Kembali</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a
                    class="nav-link dropdown-toggle hide-arrow p-0"
                    href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="../assets/img/avatars/1.jpg" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
                    <li>
                      <a class="dropdown-item pb-2 mb-1" href="#">
                        <div class="d-flex align-items-center">
                          <div class="flex-shrink-0 me-2 pe-1">
                            <div class="avatar avatar-online">
                              <img src="../assets/img/avatars/1.jpg" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-0">Janna Tazara</h6>
                            <small class="text-muted">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider my-1"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="mdi mdi-account-outline me-1 mdi-20px"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="mdi mdi-cog-outline me-1 mdi-20px"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider my-1"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="../logout.php">
                        <i class="mdi mdi-power me-1 mdi-20px"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Data Pinjam</h4>
              <!-- Bordered Table -->
              <div class="card">
                <h4 class="card-header">Tabel Pinjam</h4>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                  <a href="formtambah-pinjam.php">Tambah Data</a><br>
                  <a href="cetaklaporan-pinjam.php">Cetak Laporan Pinjam</a>
                  <form action="" method="post" class="d-flex">
                      <input type="text" name="keyword" class="form-control me-2"  placeholder="Masukan Kata Kunci" aria-label="Search" />
                      <button type="submit" name="cari" class="btn btn-sm btn-outline-primary"  >Search</button>
                  </form>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>NIS</th>
                          <th>Tanggal Pinjam</th>
                          <th>Kode Buku</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                         $i = 1 ;
                         ?>
                         <?php
                         foreach($siswa as $row):
                         ?>
                         <tr>
                            <td><?=$i;?></td>
                            <td> <?= $row ["nis"]; ?></td>
                            <td> <?= $row ["tgl_pinjam"]; ?></td>
                            <td> <?= $row["kode_buku"];?></td>
                                <td>
                            <div class="dropdown">
                              <button
                                type="button"
                                class="btn p-0 dropdown-toggle hide-arrow"
                                data-bs-toggle="dropdown">
                                <i class="mdi mdi-dots-vertical"></i>
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="ubah-pinjam.php?Id=<?= $row["Id"];?>"
                                  ><i class="mdi mdi-pencil-outline me-1"></i> Ubah</a
                                >
                                <a class="dropdown-item" href="hapus-pinjam.php?Id=<?= $row["Id"];?>"
                                  ><i class="mdi mdi-trash-can-outline me-1"></i> Hapus</a
                                >
                              </div>
                            </div>
                            </td>
                         </tr>
                         <?php $i++;?>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- Navigasi Halaman -->
                  <?php if ($halaman_prioritas > 1) : ?>
                    <a href="?halaman=<?= $halaman_prioritas - 1; ?>">&laquo;</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $jml_halaman; $i++) : ?>
                    <?php if ($i == $halaman_prioritas) : ?>
                    <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color: #9055fd;"><?=
                    $i;?></a>
                    <?php else : ?>
                    <a href="?halaman=<?=$i ; ?>"><?= $i ; ?></a>
                    <?php endif; ?>

                    <?php endfor;?>

                    <?php if ($halaman_prioritas < $jml_halaman) : ?>
                    <a href="?halaman=<?= $halaman_prioritas + 1; ?>">&raquo;</a>
                    <?php endif; ?>
                </div>
              </div>
              <!--/ Bordered Table -->
            <!-- / Content -->
</div>
            <!-- Footer -->
            <footer class="footer bg-lighter">
              <div
                class="container-fluid d-flex flex-md-row flex-column justify-content-between align-items-md-center gap-1 container-p-x py-3">
                <div>
                  <a
                    href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/html/vertical-menu-template/"
                    target="_blank"
                    class="footer-text fw-bold"
                    >UasWeb2</a
                  >
                  ©
                  <script>
                  document.write(new Date().getFullYear());
                  </script>
                  , made by
                <a href="#" target="_blank" class="footer-link fw-medium"
                  >JannaTazara</a
                >
                </div>
                  <a href="../logout.php" class="btn btn-sm btn-outline-primary"
                    ><i class="mdi mdi-logout me-1"></i>Logout</a
                  >
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
