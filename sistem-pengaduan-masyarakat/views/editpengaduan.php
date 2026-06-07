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
            <h1>Edit Pengaduan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Forms</li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Pengaduan</h5>

                            <form class="row g-3 needs-validation" novalidate action="<?php echo $url['base_url'] ?>controller/crud.php?aksi=edit" method="POST" enctype="multipart/form-data">
                                <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?php echo $user['id_user'] ?>">
                                <input type="hidden" class="form-control" id="id_catatan" name="id_pengaduan" value="<?php echo $hasil['id_pengaduan'] ?>">

                                <div class="row mb-3">
                                    <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?php echo $user['id_user'] ?>">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Pengaduan</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="tgl_pengaduan" class="form-control" value="<?php echo $hasil['tgl_pengaduan'] ?>">
                                        <div class="invalid-feedback">Silahkan masukan tanggal pengaduan!</div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Kategori</label>
                                    <div class="col-sm-10">
                                        <select name="kategori" class="form-select" required>
                                            <option value="Infrastruktur & Fasilitas Umum" <?php if (isset($hasil['kategori']) && $hasil['kategori'] == 'Infrastruktur & Fasilitas Umum') echo 'selected'; ?>>Infrastruktur & Fasilitas Umum</option>
                                            <option value="Kebersihan & Lingkungan" <?php if (isset($hasil['kategori']) && $hasil['kategori'] == 'Kebersihan & Lingkungan') echo 'selected'; ?>>Kebersihan & Lingkungan</option>
                                            <option value="Ketertiban & Keamanan" <?php if (isset($hasil['kategori']) && $hasil['kategori'] == 'Ketertiban & Keamanan') echo 'selected'; ?>>Ketertiban & Keamanan</option>
                                            <option value="Pelayanan Administrasi" <?php if (isset($hasil['kategori']) && $hasil['kategori'] == 'Pelayanan Administrasi') echo 'selected'; ?>>Pelayanan Administrasi</option>
                                            <option value="Bantuan Sosial" <?php if (isset($hasil['kategori']) && $hasil['kategori'] == 'Bantuan Sosial') echo 'selected'; ?>>Bantuan Sosial</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Isi Laporan</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="isi_laporan" style="height: 100px"><?php echo $hasil['isi_laporan'] ?></textarea>
                                        <div class="invalid-feedback">Silahkan masukan isi laporan!</div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">File Foto</label>
                                    <div class="col-sm-10">
                                        <div class="col-md-4"><img src="<?php echo "../upload/" . $hasil['foto']; ?>" width="80px" height="80px" /></div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Upload Ulang Foto</label>
                                    <div class="col-sm-10">
                                        <input type="hidden" name="foto_lama" value="<?php echo $hasil['foto']; ?>">

                                        <input class="form-control" type="file" id="formFile" name="foto">
                                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                                    </div>
                                </div>

                                <div class="row mb-3 mt-4">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                                        <a href="javascript:history.back()" class="btn btn-danger"><i class="bi bi-x-circle"></i> Cancel</a>
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