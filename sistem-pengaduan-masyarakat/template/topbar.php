<?php
$user = $_SESSION['login'];
?>
<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center">
  <i class="bi bi-list toggle-sidebar-btn me-3"></i>

  <a href="<?php echo $url['base_url'];?>views/dashboard.php" class="logo d-flex align-items-center">
    <img src="<?php echo $url['base_url'];?>assets/img/logo.png" alt="Logo" class="me-2">
    <span>SiPM</span>
  </a>
</div><nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <li class="nav-item dropdown pe-3">

      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user['nama']); ?>&background=random&color=fff&rounded=true" alt="Profile" class="rounded-circle">
        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $user['username'];?></span>
      </a><ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
          <h6><?php echo $user['nama'];?></h6>
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

      </ul></li></ul>
</nav></header>