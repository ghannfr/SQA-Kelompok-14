<?php 
  require "../controller/pintasan.php";
  include('../template/link.php');
  include('../template/head.php');
?>

<body>
    <?php include('../template/topbar.php'); include('../template/sidebar.php'); ?>
    
    <?php 
        // Mengambil ID user dari URL
        $id_user_get = strip_tags($_GET['id']);
        $profil = $proses->tampil_data_id('t_user', 'id_user', $id_user_get);
    ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Profil Masyarakat</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item">Detail Laporan</li>
                    <li class="breadcrumb-item active">Profil</li>
                </ol>
            </nav>
        </div>

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card shadow-sm">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($profil['nama']); ?>&background=random&color=fff&rounded=true&size=120" alt="Profile" class="mb-3 shadow-sm">
                            <h2 class="fw-bold text-center"><?php echo $profil['nama'];?></h2>
                            <h3 class="text-muted text-center mt-1">
                                <?php 
                                    if($profil['level'] == 1) { 
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
                    <div class="card shadow-sm">
                        <div class="card-body pt-4">
                            <h5 class="card-title pb-3 border-bottom">Informasi Lengkap Akun</h5>
                            
                            <div class="row mb-3 mt-3">
                                <div class="col-lg-4 col-md-4 label fw-bold text-muted">Username</div>
                                <div class="col-lg-8 col-md-8"><?php echo $profil['username'];?></div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-4 col-md-4 label fw-bold text-muted">Nama Lengkap</div>
                                <div class="col-lg-8 col-md-8"><?php echo $profil['nama'];?></div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-4 col-md-4 label fw-bold text-muted">Email</div>
                                <div class="col-lg-8 col-md-8"><?php echo isset($profil['email']) ? $profil['email'] : '-'; ?></div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-4 col-md-4 label fw-bold text-muted">NIK</div>
                                <div class="col-lg-8 col-md-8"><?php echo $profil['nik'];?></div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-4 col-md-4 label fw-bold text-muted">No. Telepon</div>
                                <div class="col-lg-8 col-md-8"><?php echo $profil['no_tlp'];?></div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-4 col-md-4 label fw-bold text-muted">Alamat Lengkap</div>
                                <div class="col-lg-8 col-md-8"><?php echo isset($profil['alamat']) ? nl2br($profil['alamat']) : '-'; ?></div>
                            </div>
                            
                            <div class="row mt-4">
                                <div class="col-12 text-end">
                                    <button onclick="history.back()" class="btn btn-secondary shadow-sm"><i class="bi bi-arrow-left"></i> Kembali</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include('../template/footer.php') ?>