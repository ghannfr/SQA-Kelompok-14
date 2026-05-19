<?php 
  require "../controller/pintasan.php";
  include('../template/link.php');
  include('../template/head.php');
?>
<body>
    <?php include('../template/topbar.php'); include('../template/sidebar.php'); ?>
    <main id="main" class="main">
        <div class="pagetitle"><h1>Pengaduan Tahunan</h1></div>

        <section class="section">
        <div class="row"><div class="col-lg-12"><div class="card"><div class="card-body">
            <h5 class="card-title">Filter Laporan Tahunan</h5>
            
            <form method="GET" action="tahunan.php" class="row g-3 mb-4">
                <div class="col-auto">
                    <input type="number" name="tahun" class="form-control" placeholder="Tahun (contoh: 2026)" value="<?php echo isset($_GET['tahun']) ? $_GET['tahun'] : date('Y'); ?>" required>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Tampilkan</button>
                    <a href="tahunan.php" class="btn btn-secondary">Reset</a>
                </div>
            </form>

            <table class="table">
                <thead><tr><th>No</th><th>Tanggal</th><th>Isi Laporan</th><th>Foto</th><th>Status</th></tr></thead>
                <tbody>
                    <?php
                    $no=1;
                    $t = isset($_GET['tahun']) ? $_GET['tahun'] : null;
                    
                    // Memanggil fungsi Tahunan yang baru kita buat
                    $hasil = $proses->tampil_data_tahunan('t_pengaduan', $user['id_user'], $t);

                    foreach($hasil as $isi){
                        $ver = ($isi['status']==0) ? "Belum Verifikasi" : "Sudah Verifikasi";
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo date('d M Y', strtotime($isi['tgl_pengaduan'])); ?></td>
                        <td><?php echo $isi['isi_laporan'];?></td>
                        <td><img src="../upload/<?php echo $isi['foto'];?>" width="80px" height="80px" /></td>
                        <td>
                            <button class="btn <?php echo ($ver == "Belum Verifikasi") ? 'btn-warning' : 'btn-success'; ?> btn-md">
                                <span class="bi <?php echo ($ver == "Belum Verifikasi") ? 'bi-clock' : 'bi-check-square'; ?>"></span>
                            </button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div></div></div></div>
        </section>
    </main>
    <?php include('../template/footer.php') ?>