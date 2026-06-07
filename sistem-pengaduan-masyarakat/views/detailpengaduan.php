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
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                Laporan Anda 
                                <span class="badge bg-primary float-end">PGD-<?php echo sprintf("%03d", $pengaduan['id_pengaduan']); ?></span>
                            </h5>
                            
                            <div class="d-flex flex-column">
                                <span class="text-muted small mb-2"><i class="bi bi-calendar-event"></i> Dikirim pada: <?php echo date('d F Y', strtotime($pengaduan['tgl_pengaduan'])); ?></span>
                                
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
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <?php if($tanggapan) { ?>
                                <h5 class="card-title text-success">
                                    Tanggapan Petugas
                                    <span class="badge bg-success float-end">TGP-<?php echo sprintf("%03d", $tanggapan['id_tanggapan']); ?></span>
                                </h5>
                                
                                <div class="d-flex flex-column">
                                    <span class="text-muted small mb-2"><i class="bi bi-calendar-check"></i> Ditanggapi pada: <?php echo date('d F Y', strtotime($tanggapan['tgl_tanggapan'])); ?></span>
                                    
                                    <div class="p-3 border border-success border-opacity-50 rounded bg-success bg-opacity-10" style="min-height: 150px;">
                                        <?php echo nl2br($tanggapan['tanggapan']); ?>
                                    </div>
                                    
                                    <div class="mt-4 text-end">
                                        <a href="statuspengaduan.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <h5 class="card-title text-warning">Menunggu Tanggapan</h5>
                                <div class="text-center py-5">
                                    <i class="bi bi-clock-history text-warning" style="font-size: 4rem;"></i>
                                    <p class="mt-3 text-muted">Laporan Anda sedang dalam antrean dan akan segera diproses oleh petugas kami.</p>
                                    <a href="statuspengaduan.php" class="btn btn-secondary mt-2"><i class="bi bi-arrow-left"></i> Kembali</a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
    </main>

    <?php include('../template/footer.php') ?>