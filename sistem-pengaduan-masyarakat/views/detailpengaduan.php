<?php 
  require "../controller/pintasan.php";
  include('../template/link.php');
  include('../template/head.php');
?>

<body>
    <?php include('../template/topbar.php'); ?>
    <?php include('../template/sidebar.php'); ?>
    
    <?php 
        // Mengambil ID dari URL
        $idGet = strip_tags($_GET['id']);
        
        // Menarik data pengaduan dan data tanggapan
        $pengaduan = $proses->tampil_data_id('t_pengaduan', 'id_pengaduan', $idGet);
        $tanggapan = $proses->tampil_data_tanggapan('t_tanggapan', 'id_pengaduan', $idGet);
    ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Detail Pengaduan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="statuspengaduan.php">Status</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                
                <div class="col-lg-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body pt-4">
                            <h5 class="card-title pt-0">
                                Laporan Anda 
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
                                    Tanggapan Petugas
                                    <span class="badge bg-success float-end">TGP-<?php echo sprintf("%03d", $tanggapan['id_tanggapan']); ?></span>
                                </h5>
                                
                                <span class="text-muted small mb-3 d-block"><i class="bi bi-calendar-check"></i> Ditanggapi pada: <?php echo date('d M Y, H:i', strtotime($tanggapan['tgl_tanggapan'])); ?> WIB</span>
                                
                                <div class="p-3 border border-success border-opacity-50 rounded bg-success bg-opacity-10" style="min-height: 150px;">
                                    <?php echo nl2br($tanggapan['tanggapan']); ?>
                                </div>
                                
                            <?php } else { ?>
                                <h5 class="card-title text-warning pt-0">Menunggu Tanggapan</h5>
                                <div class="text-center py-5">
                                    <i class="bi bi-clock-history text-warning" style="font-size: 4rem;"></i>
                                    <p class="mt-3 text-muted">Laporan Anda sedang dalam antrean dan akan segera diproses oleh petugas kami.</p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 mt-3">
                    <a href="statuspengaduan.php" class="btn btn-secondary shadow-sm"><i class="bi bi-arrow-left"></i> Kembali ke Status Pengaduan</a>
                </div>

            </div>
        </section>
    </main>

    <?php include('../template/footer.php') ?>