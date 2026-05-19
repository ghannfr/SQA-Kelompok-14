
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="<?php echo $url['base_url'];?>views/dashboard.php">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Pengaduan</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <?php
            //$user = $_SESSION['login'];
            //print_r ($user);
            if($user['level'] == '1'){
                
        ?>
      <li>
        <a href="<?php echo $url['base_url'];?>views/validasi.php">
          <i class="bi bi-circle"></i><span>Verifikasi dan Validasi</span>
        </a>
      </li>

      <?php 
            }else if($user['level'] == 2){
        ?>
        <li>
            <a href="<?php echo $url['base_url'];?>views/validasi.php">
            <i class="bi bi-circle"></i><span>Verifikasi dan Validasi</span>
            </a>
        </li>
    <?php
            }else{
    ?>
        <li>
        <a href="<?php echo $url['base_url'];?>views/addpengaduan.php">
          <i class="bi bi-circle"></i><span>Input Pengaduan</span>
        </a>
      </li>
      <li>
        <a href="<?php echo $url['base_url'];?>views/statuspengaduan.php">
          <i class="bi bi-circle"></i><span>Status Pengaduan</span>
        </a>
      </li>
    <?php
            }
      ?>
    </ul>
    
    <?php 
    if($user['level']==1){
    ?>
    
    <a class="nav-link collapsed" data-bs-target="#report-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="report-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?php echo $url['base_url'];?>views/harian.php">
          <i class="bi bi-circle"></i><span>Harian</span>
        </a>
      </li>
      <li>
        <a href="<?php echo $url['base_url']?>views/mingguan.php">
          <i class="bi bi-circle"></i><span>Mingguan</span>
        </a>
      </li>
      <li>
        <a href="<?php echo $url['base_url']?>views/bulanan.php">
          <i class="bi bi-circle"></i><span>Bulanan</span>
        </a>
      </li>
      <li>
        <a href="<?php echo $url['base_url']?>views/tahunan.php">
          <i class="bi bi-circle"></i><span>Tahunan</span>
        </a>
      </li>
    </ul>
    <?php
    }
    ?>
  </li><!-- End Components Nav -->
</ul>

</aside><!-- End Sidebar-->