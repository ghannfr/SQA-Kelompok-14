<?php 
  require "../controller/pintasan.php";
  include('../template/link.php');
  include('../template/head.php');
?>
<body>
    <?php include('../template/topbar.php'); include('../template/sidebar.php'); ?>
    <main id="main" class="main">
        <div class="pagetitle"><h1>Pengaduan Harian</h1></div>

        <section class="section">
        <div class="row"><div class="col-lg-12"><div class="card"><div class="card-body">
            <h5 class="card-title">Filter Laporan Harian</h5>
            
            <form method="GET" action="harian.php" class="row g-3 mb-4">
                <div class="col-auto">
                    <input type="date" class="form-control" name="tanggal" value="<?php echo isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d'); ?>" onchange="this.form.submit()" required>
                </div>
                <div class="col-auto">
                    <a href="harian.php" class="btn btn-secondary"><i class="bi bi-arrow-clockwise"></i> Reset</a>
                </div>
            </form>

            <table class="table table-hover align-middle">
                <thead><tr><th>No</th><th>ID Laporan</th><th>Pengirim</th><th>Tanggal</th><th>Isi Laporan</th><th>Foto</th><th>Status</th><th>Aksi</th></tr></thead>
                <tbody>
                    <?php
                    $no=1;
                    
                    // 1. Tangkap tanggal dari URL (jika ada)
                    // 2. Jika URL kosong, gunakan tanggal komputer saat ini (hari ini)
                    $tanggal_filter = (isset($_GET['tanggal']) && $_GET['tanggal'] != '') ? $_GET['tanggal'] : date('Y-m-d');
                    
                    // 3. Masukkan tanggal tersebut ke dalam fungsi model
                    $hasil = $proses->tampil_data_harian('t_pengaduan', $user['id_user'], $tanggal_filter);

                    foreach($hasil as $isi){
                        $ver = ($isi['status']==0) ? "Belum Verifikasi" : "Sudah Verifikasi";
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><span class="badge bg-primary"><i class="bi bi-file-earmark-text"></i> PGD-<?php echo sprintf("%03d", $isi['id_pengaduan']); ?></span></td>
                        <!-- Kolom Pengirim -->
                        <td>
                            <span class="fw-bold"><?php echo $isi['nama']; ?></span><br>
                            <span class="text-muted small">NIK: <?php echo $isi['nik']; ?></span>
                        </td>
                        <td><?php echo date('d M Y', strtotime($isi['tgl_pengaduan'])); ?></td>
                        <td><?php echo strlen($isi['isi_laporan']) > 40 ? substr($isi['isi_laporan'], 0, 40) . '...' : $isi['isi_laporan']; ?></td>
                        <td><img src="../upload/<?php echo $isi['foto'];?>" width="70px" height="70px" class="rounded shadow-sm" style="object-fit: cover;"/></td>
                        <td>
                            <button class="btn <?php echo ($ver == "Belum Verifikasi") ? 'btn-warning' : 'btn-success'; ?> btn-sm">
                                <span class="bi <?php echo ($ver == "Belum Verifikasi") ? 'bi-clock' : 'bi-check-square'; ?>"></span>
                                <?php echo ($ver == "Belum Verifikasi") ? 'Pending' : 'Selesai'; ?>
                            </button>
                        </td>
                        <td>
                            <a href="detaillaporan.php?id=<?php echo $isi['id_pengaduan']; ?>" class="btn btn-info btn-sm text-white" title="Lihat Detail Selengkapnya">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div></div></div></div>
        </section>
    </main>
    <?php include('../template/footer.php') ?>