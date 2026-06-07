<?php
include('../template/link.php');
include('../template/head.php');
?>

<body>
    <?php
    include('../template/topbar.php');
    include('../template/sidebar.php');
    require '../controller/Pintasan.php';

    // Memastikan session sudah berjalan dan mengambil data level
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $level_user = $_SESSION['login']['level'];

    // Mengambil data angka HANYA jika yang login adalah Admin (1) atau Petugas (2)
    if ($level_user == 1) {
        $total_pengaduan = $proses->hitung_total_pengaduan();
        $pending_pengaduan = $proses->hitung_pengaduan_pending();
        $total_masyarakat = $proses->hitung_total_masyarakat();
    }
    ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            <div class="row">

                <?php
                // =======================================================
                // TAMPILAN DASHBOARD UNTUK ADMIN DAN PETUGAS
                // =======================================================
                if ($level_user == 1) {
                ?>
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Pengaduan <span>| Keseluruhan</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?php echo $total_pengaduan; ?></h6>
                                        <span class="text-muted small pt-2 ps-1">Laporan Masuk</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Pending <span>| Belum Ditanggapi</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="color: #ff771d; background-color: #ffecdf;">
                                        <i class="bi bi-exclamation-circle"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?php echo $pending_pengaduan; ?></h6>
                                        <span class="text-muted small pt-2 ps-1">Butuh Tindakan</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Masyarakat <span>| Terdaftar</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?php echo $total_masyarakat; ?></h6>
                                        <span class="text-muted small pt-2 ps-1">Akun Aktif</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                    // =======================================================
                    // TAMPILAN DASHBOARD KHUSUS UNTUK MASYARAKAT
                    // =======================================================
                } else if ($level_user == 2) {
                ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center p-5">
                                <img src="../assets/img/logo.png" alt="Ilustrasi Pengaduan" class="img-fluid mb-4" style="max-height: 250px;">

                                <h2 class="fw-bold mb-3">Sistem Pengaduan Masyarakat (SiPM)</h2>
                                <p class="text-muted mb-5 fs-5">Sampaikan laporan, aspirasi, dan keluhan Anda di sini. Kami siap merespon dan menindaklanjuti laporan Anda dengan cepat dan transparan.</p>

                                <a href="<?php echo $url['base_url']; ?>views/addpengaduan.php" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-sm">
                                    <i class="bi bi-pencil-square me-2"></i> Tulis Pengaduan Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </section>
    </main>

    <?php include('../template/footer.php') ?>