<?php
  // Pastikan session menyala agar data $user terbaca
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }
  include('../template/link.php');
  include('../template/head.php');
  
  // Mengambil data user dari session
  $user = $_SESSION['login'];
?>

<body>
    <?php include('../template/topbar.php'); ?>
    <?php include('../template/sidebar.php'); ?>
    
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Profil Saya</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Profil</li>
                </ol>
            </nav>
        </div><section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user['nama']); ?>&background=random&color=fff&rounded=true&size=120" alt="Profile" class="mb-3 shadow-sm">
                            
                            <h2 class="fw-bold text-center"><?php echo $user['nama'];?></h2>
                            <h3 class="text-muted text-center mt-1">
                                <?php 
                                    if($user['level'] == 1) { 
                                        echo "Admin"; 
                                    } else { 
                                        echo "Masyarakat"; 
                                    }
                                ?>
                            </h3>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Detail Informasi</button>
                                </li>
                            </ul>
                            
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title mt-2 mb-4">Informasi Akun Anda</h5>
                                    
                                    <div class="row mb-3">
                                        <div class="col-lg-4 col-md-4 label fw-bold text-muted">Username</div>
                                        <div class="col-lg-8 col-md-8"><?php echo $user['username'];?></div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-4 col-md-4 label fw-bold text-muted">Nama Lengkap</div>
                                        <div class="col-lg-8 col-md-8"><?php echo $user['nama'];?></div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-4 col-md-4 label fw-bold text-muted">Email</div>
                                        <div class="col-lg-8 col-md-8"><?php echo isset($user['email']) ? $user['email'] : '-'; ?></div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-4 col-md-4 label fw-bold text-muted">NIK</div>
                                        <div class="col-lg-8 col-md-8"><?php echo $user['nik'];?></div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-4 col-md-4 label fw-bold text-muted">No. Telepon</div>
                                        <div class="col-lg-8 col-md-8"><?php echo $user['no_tlp'];?></div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-4 col-md-4 label fw-bold text-muted">Alamat Lengkap</div>
                                        <div class="col-lg-8 col-md-8"><?php echo isset($user['alamat']) ? $user['alamat'] : '-'; ?></div>
                                    </div>

                                    <div class="row mt-5">
                                        <div class="col-12 text-end border-top pt-3">
                                            <form action="<?php echo $url['base_url'];?>controller/crud.php?aksi=hapus_akun&hapusid=<?php echo $user['id_user']; ?>" method="POST">
                                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Peringatan: Apakah Anda yakin ingin menghapus akun secara permanen? Data tidak dapat dikembalikan.')">
                                                    <i class="bi bi-trash me-1"></i> Hapus Akun
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div></div>
                    </div>
                </div>
            </div>
        </section>
    </main><?php include('../template/footer.php') ?>
</body>
</html>