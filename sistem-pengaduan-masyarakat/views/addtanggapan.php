<?php
// PINDAHKAN REQUIRE KE PALING ATAS
require "../controller/pintasan.php";
include('../template/link.php');
include('../template/head.php');
?>

<body>
    <?php include('../template/topbar.php'); ?>
    <?php include('../template/sidebar.php'); ?>

    <?php
    $idGet = strip_tags($_GET['id']);
    $hasil = $proses->tampil_data_id('t_pengaduan', 'id_pengaduan', $idGet);
    ?>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Tanggapan</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Berikan Tanggapan</h5>

                            <form class="row g-3 needs-validation" novalidate action="<?php echo $url['base_url'] ?>controller/crud.php?aksi=tanggapan" method="POST">
                                <input type="hidden" name="id_user" value="<?php echo $user['id_user'] ?>">
                                <input type="hidden" name="id_pengaduan" value="<?php echo $hasil['id_pengaduan'] ?>">

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Waktu Pengaduan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?php echo date('d M Y H:i', strtotime($hasil['tgl_pengaduan'])); ?>" disabled>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Tanggal Tanggapan</label>
                                    <div class="col-sm-10">
                                        <input type="datetime-local" name="tgl_tanggapan" class="form-control" value="<?php echo date('Y-m-d\TH:i'); ?>" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Isi Tanggapan</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="tanggapan" style="height: 100px" required></textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Status Tindakan</label>
                                    <div class="col-sm-10 mt-2">
                                        <input class="form-check-input" type="radio" name="status_tanggapan" value="1" checked> Terima & Selesaikan
                                        <input class="form-check-input ms-3" type="radio" name="status_tanggapan" value="2"> Tolak Laporan
                                    </div>
                                </div>

                                <div class="row mb-3 mt-4">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button type="submit" class="btn btn-primary">Simpan Tanggapan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include('../template/footer.php') ?>
</body>

</html>