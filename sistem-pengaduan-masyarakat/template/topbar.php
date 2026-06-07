<?php
$user = $_SESSION['login'];

// 1. SOLUSI ADMIN: Beri nama cadangan jika kolom nama di database ternyata kosong
$nama_avatar = "User"; 
if (!empty($user['nama'])) {
    $nama_avatar = $user['nama'];
} elseif (!empty($user['username'])) {
    $nama_avatar = $user['username'];
}

// 2. SOLUSI MASYARAKAT: Logika cerdas sinkronisasi foto
$punya_foto = false;
$file_foto = "";

// Cek apakah sistem database ($proses) sedang dimuat (seperti saat berada di halaman profil.php)
if (isset($proses)) {
    // Tarik data paling baru langsung dari database
    $profil_fresh = $proses->tampil_data_id('t_user', 'id_user', $user['id_user']);
    
    if (!empty($profil_fresh['foto_profil']) && $profil_fresh['foto_profil'] != "") {
        $punya_foto = true;
        $file_foto = $profil_fresh['foto_profil'];
        // Diam-diam perbarui memori Session Anda agar sinkron di semua halaman
        $_SESSION['login']['foto_profil'] = $file_foto;
    }
} 
// Jika berada di dashboard (yang databasenya belum dimuat), panggil dari Session yang sudah di-update
else {
    if (!empty($_SESSION['login']['foto_profil']) && $_SESSION['login']['foto_profil'] != "") {
        $punya_foto = true;
        $file_foto = $_SESSION['login']['foto_profil'];
    }
}

// 3. Tampilkan Hasil
if ($punya_foto) {
    $foto_topbar = $url['base_url'] . "upload/" . $file_foto;
} else {
    // Jika tidak ada foto, tampilkan huruf inisial dengan aman
    $foto_topbar = "https://ui-avatars.com/api/?name=" . urlencode($nama_avatar) . "&background=random&color=fff&rounded=true&size=120";
}
?>
<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center">
  <i class="bi bi-list toggle-sidebar-btn me-3"></i>

  <a href="<?php echo $url['base_url'];?>views/dashboard.php" class="logo d-flex align-items-center">
    <img src="<?php echo $url['base_url'];?>assets/img/logo.png" alt="Logo" class="me-2">
    <span>SiPM</span>
  </a>
</div>

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <li class="nav-item dropdown pe-3">

      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <img src="<?php echo $foto_topbar; ?>" alt="Profile" class="rounded-circle shadow-sm border" style="width: 35px; height: 35px; object-fit: cover;">
        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $user['username'];?></span>
      </a>
      
      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
          <h6><?php echo !empty($user['nama']) ? $user['nama'] : $user['username']; ?></h6>
          <span>
            <?php 
              if($user['level'] == 1) echo "Admin";
              else echo "Masyarakat";
            ?>
          </span>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="<?php echo $url['base_url'];?>views/profil.php">
            <i class="bi bi-person"></i>
            <span>My Profile</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="<?php echo $url['base_url'];?>controller/crud.php?aksi=logout">
            <i class="bi bi-box-arrow-right"></i>
            <span>Sign Out</span>
          </a>
        </li>

      </ul>
    </li>
  </ul>
</nav>

</header>