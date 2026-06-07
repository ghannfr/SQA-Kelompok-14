<?php
require "../controller/pintasan.php";
include('../template/link.php');
include('../template/head.php');
?>

<body>
    <?php include('../template/topbar.php'); ?>
    <?php include('../template/sidebar.php'); ?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Status Pengaduan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Data</li>
                    <li class="breadcrumb-item active">Pengaduan</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Status Pengaduan Anda</h5>

                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">ID Tiket</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Isi Laporan</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Aksi | Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $hasil = $proses->tampil_pengaduan_tanggapan_user($user['id_user']);

                                    foreach ($hasil as $isi) {
                                        // LOGIKA STATUS DITAMBAHKAN
                                        if ($isi['status'] == 0) {
                                            $ver = "Belum Verifikasi";
                                        } elseif ($isi['status'] == 1) {
                                            $ver = "Sudah Verifikasi";
                                        } else {
                                            $ver = "Ditolak";
                                        }
                                    ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>

                                            <td>
                                                <span class="badge bg-primary mb-1" title="ID Pengaduan">
                                                    <i class="bi bi-file-earmark-text"></i> PGD-<?php echo sprintf("%03d", $isi['id_pengaduan']); ?>
                                                </span>

                                                <?php if ($isi['id_tanggapan'] != null) { ?>
                                                    <br>
                                                    <span class="badge bg-success" title="ID Tanggapan">
                                                        <i class="bi bi-reply"></i> TGP-<?php echo sprintf("%03d", $isi['id_tanggapan']); ?>
                                                    </span>
                                                <?php } else { ?>
                                                    <br>
                                                    <span class="badge bg-secondary opacity-50" style="font-size: 0.7em;">Belum ada tanggapan</span>
                                                <?php } ?>
                                            </td>

                                            <td><?php echo date('d M Y H:i', strtotime($isi['tgl_pengaduan'])); ?></td>
                                            <td>
                                                <?php
                                                echo strlen($isi['isi_laporan']) > 50 ? substr($isi['isi_laporan'], 0, 50) . '...' : $isi['isi_laporan'];
                                                ?>
                                            </td>
                                            <td><img src="<?php echo "../upload/" . $isi['foto']; ?>" width="80px" height="80px" class="rounded shadow-sm" style="object-fit: cover;" /></td>

                                            <td style="text-align: left;">
                                                <?php if ($ver == "Belum Verifikasi") { ?>
                                                    <a href="editpengaduan.php?id=<?php echo $isi['id_pengaduan']; ?>" class="btn btn-primary btn-sm" title="Edit Laporan">
                                                        <span class="bi bi-pencil-square"></span>
                                                    </a>
                                                    <a onclick="return confirm('Apakah yakin data akan di hapus?')" href="<?php echo $url['base_url']; ?>controller/crud.php?aksi=hapus&hapusid=<?php echo $isi['id_pengaduan']; ?>" class="btn btn-danger btn-sm" title="Hapus Laporan">
                                                        <span class="bi bi-trash"></span>
                                                    </a>
                                                    <button class="btn btn-warning btn-sm" title="Menunggu Proses"><span class="bi bi-clock"></span> Pending</button>

                                                <?php } elseif ($ver == "Sudah Verifikasi") { ?>
                                                    <button class="btn btn-success btn-sm"><span class="bi bi-check-square"></span> Selesai</button>
                                                    <a href="detailpengaduan.php?id=<?php echo $isi['id_pengaduan']; ?>" class="btn btn-info btn-sm text-white" title="Lihat Tanggapan">
                                                        <span class="bi bi-eye"></span> Detail
                                                    </a>

                                                <?php } else { ?>
                                                    <button class="btn btn-danger btn-sm"><span class="bi bi-x-circle"></span> Ditolak</button>
                                                    <a href="detailpengaduan.php?id=<?php echo $isi['id_pengaduan']; ?>" class="btn btn-info btn-sm text-white" title="Lihat Tanggapan">
                                                        <span class="bi bi-eye"></span> Detail
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php
                                        $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><?php include('../template/footer.php') ?>
</body>

</html>