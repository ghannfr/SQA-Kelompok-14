<?php
include('../template/link.php');
include('../template/head.php');
?>

<body>
    <?php include('../template/topbar.php'); ?>
    <?php include('../template/sidebar.php'); ?>
    <?php require '../controller/Pintasan.php';

    // tampilkan form edit
    $idGet = strip_tags($_GET['id']);
    $hasil = $proses->tampil_data_id('t_pengaduan', 'id_pengaduan', $idGet);
    ?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Tanggapan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Forms</li>
                    <li class="breadcrumb-item active">Tanggapan</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Berikan Tanggapan</h5>

                            <form class="row g-3 needs-validation" novalidate action="<?php echo $url['base_url'] ?>controller/crud.php?aksi=tanggapan" method="POST">
                                <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?php echo $user['id_user'] ?>">
                                <input type="hidden" class="form-control" id="id_catatan" name="id_pengaduan" value="<?php echo $hasil['id_pengaduan'] ?>">

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Tanggal Pengaduan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?php echo date('d M Y, H:i', strtotime($hasil['tgl_pengaduan'])); ?> WIB" disabled>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?php echo $hasil['kategori']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Isi Laporan</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="isi_laporan" style="height: 100px" disabled><?php echo $hasil['isi_laporan'] ?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">File Foto</label>
                                    <div class="col-sm-10">
                                        <div class="col-md-4"><img src="<?php echo "../upload/" . $hasil['foto']; ?>" width="80px" height="80px" /></div>
                                    </div>
                                </div>
                                <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Tanggal Tanggapan</label>
    <div class="col-sm-10">
        <?php date_default_timezone_set('Asia/Jakarta'); ?>
        <input type="text" class="form-control" value="<?php echo date('d M Y, H:i'); ?> WIB" disabled>
    </div>
</div>
                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Isi Tanggapan</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="tanggapan" style="height: 100px" required></textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Status Tindakan</label>
                                    <div class="col-sm-10 mt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_tanggapan" id="terima" value="1" required checked>
                                            <label class="form-check-label text-success fw-bold" for="terima">Terima & Selesaikan</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_tanggapan" id="tolak" value="2" required>
                                            <label class="form-check-label text-danger fw-bold" for="tolak">Tolak Laporan</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3 mt-4">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan Tanggapan</button>
                                        <a href="javascript:history.back()" class="btn btn-danger"><i class="bi bi-x-circle"></i> Batal</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </section>

    </main><?php include('../template/footer.php') ?>
</body>

</html>