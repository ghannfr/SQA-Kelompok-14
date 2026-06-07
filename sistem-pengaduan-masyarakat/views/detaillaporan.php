<?php 
  require "../controller/pintasan.php";
  include('../template/link.php');
  include('../template/head.php');
?>

<body>
    <?php include('../template/topbar.php'); include('../template/sidebar.php'); ?>
    
    <?php 
        // Mengambil ID pengaduan dari URL
        $idGet = strip_tags($_GET['id']);
        
        // Memanggil data dari fungsi yang sudah ada di model
        $pengaduan = $proses->tampil_data_id('t_pengaduan', 'id_pengaduan', $idGet);
        $tanggapan = $proses->tampil_data_tanggapan('t_tanggapan', 'id_pengaduan', $idGet);
        $pengirim = $proses->tampil_data_id('t_user', 'id_user', $pengaduan['id_user']);
    ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Rincian Detail Laporan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item">Laporan</li>
                    <li class="breadcrumb-item active">Detail Laporan</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                
                <div class="col-12 mb-4">
                    <div class="card border-primary border-top border-3 shadow-sm mb-0">
                        <div class="card-body d-flex justify-content-between align-items-center py-3">
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($pengirim['nama']); ?>&background=random&color=fff&rounded=true" alt="Profile" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                                <div>
                                    <h5 class="mb-0 fw-bold"><?php echo $pengirim['nama']; ?></h5>
                                    <small class="text-muted">NIK: <?php echo $pengirim['nik']; ?></small>
                                </div>
                            </div>
                            <a href="detailprofil.php?id=<?php echo $pengirim['id_user']; ?>" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-person-lines-fill"></i> Lihat Profil Pengirim
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body pt-4">
                            <h5 class="card-title pt-0">
                                Isi Pengaduan
                                <span class="badge bg-primary float-end">PGD-<?php echo sprintf("%03d", $pengaduan['id_pengaduan']); ?></span>
                            </h5>
                            
                            <span class="text-muted small mb-2 d-block"><i class="bi bi-calendar-event"></i> Dikirim pada: <?php echo date('d M Y, H:i', strtotime($pengaduan['tgl_pengaduan'])); ?> WIB</span>
                            
                            <span class="badge bg-secondary mb-3"><i class="bi bi-tag-fill me-1"></i> <?php echo $pengaduan['kategori']; ?></span>
                            
                            <div class="p-3 bg-light rounded mb-3" style="min-height: 100px;">
                                <?php echo nl2br($pengaduan['isi_laporan']); ?>
                            </div>

                            <h6 class="fw-bold text-muted mt-2">Lampiran Foto:</h6>
                            <?php if($pengaduan['foto'] != '') { ?>
                                <img src="../upload/<?php echo $pengaduan['foto']; ?>" class="img-fluid rounded shadow-sm" alt="Bukti Laporan">
                            <?php } else { ?>
                                <span class="text-muted fst-italic">Tidak ada lampiran foto.</span>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body pt-4">
                            <?php if($tanggapan) { ?>
                                <h5 class="card-title text-success pt-0">
                                    Tanggapan
                                    <span class="badge bg-success float-end">TGP-<?php echo sprintf("%03d", $tanggapan['id_tanggapan']); ?></span>
                                </h5>
                                
                                <span class="text-muted small mb-3 d-block"><i class="bi bi-calendar-check"></i> Ditanggapi pada: <?php echo date('d M Y, H:i', strtotime($tanggapan['tgl_tanggapan'])); ?> WIB</span>
                                
                                <div class="p-3 border border-success border-opacity-50 rounded bg-success bg-opacity-10" style="min-height: 150px;">
                                    <?php echo nl2br($tanggapan['tanggapan']); ?>
                                </div>
                            <?php } else { ?>
                                <h5 class="card-title text-warning pt-0">Belum Ditanggapi</h5>
                                <div class="text-center py-5">
                                    <i class="bi bi-clock-history text-warning" style="font-size: 4rem;"></i>
                                    <p class="mt-3 text-muted">Laporan ini masih berstatus pending dan belum mendapat balasan.</p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 mt-3">
                    <button onclick="history.back()" class="btn btn-secondary shadow-sm"><i class="bi bi-arrow-left"></i> Kembali ke Halaman Sebelumnya</button>
                </div>
                
            </div>
        </section>
    </main>
    <?php include('../template/footer.php') ?>