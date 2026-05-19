<?php 
  require "../controller/pintasan.php";
  include('../template/link.php');
  include('../template/head.php');
?>
<body>
    <?php include('../template/topbar.php'); include('../template/sidebar.php'); ?>
    <main id="main" class="main">
        <div class="pagetitle"><h1>Pengaduan Mingguan</h1></div>

        <section class="section">
        <div class="row"><div class="col-lg-12"><div class="card"><div class="card-body">
            <h5 class="card-title">Filter Laporan Mingguan</h5>
            
            <form method="GET" action="mingguan.php" class="row g-3 mb-4">
                <div class="col-auto">
                    <select name="minggu" class="form-select" required>
                        <option value="">-- Pilih Minggu --</option>
                        <option value="1" <?php if(isset($_GET['minggu']) && $_GET['minggu']=='1') echo 'selected'; ?>>Minggu Ke-1</option>
                        <option value="2" <?php if(isset($_GET['minggu']) && $_GET['minggu']=='2') echo 'selected'; ?>>Minggu Ke-2</option>
                        <option value="3" <?php if(isset($_GET['minggu']) && $_GET['minggu']=='3') echo 'selected'; ?>>Minggu Ke-3</option>
                        <option value="4" <?php if(isset($_GET['minggu']) && $_GET['minggu']=='4') echo 'selected'; ?>>Minggu Ke-4</option>
                        <option value="5" <?php if(isset($_GET['minggu']) && $_GET['minggu']=='5') echo 'selected'; ?>>Minggu Ke-5</option>
                    </select>
                </div>
                <div class="col-auto">
                    <select name="bulan" class="form-select" required>
                        <option value="">-- Pilih Bulan --</option>
                        <?php 
                        $bulanArr = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];
                        foreach($bulanArr as $k => $v){
                            $sel = (isset($_GET['bulan']) && $_GET['bulan']==$k) ? 'selected' : '';
                            echo "<option value='$k' $sel>$v</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-auto">
                    <input type="number" name="tahun" class="form-control" placeholder="Tahun" value="<?php echo isset($_GET['tahun']) ? $_GET['tahun'] : date('Y'); ?>" required>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Tampilkan</button>
                    <a href="mingguan.php" class="btn btn-secondary">Reset</a>
                </div>
            </form>

            <table class="table">
                <thead><tr><th>No</th><th>Tanggal</th><th>Isi Laporan</th><th>Foto</th><th>Status</th></tr></thead>
                <tbody>
                    <?php
                    $no=1;
                    $m = isset($_GET['minggu']) ? $_GET['minggu'] : null;
                    $b = isset($_GET['bulan']) ? $_GET['bulan'] : null;
                    $t = isset($_GET['tahun']) ? $_GET['tahun'] : null;
                    
                    $hasil = $proses->tampil_data_mingguan('t_pengaduan', $user['id_user'], $m, $b, $t);

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