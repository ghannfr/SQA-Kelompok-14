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
      <h1>Pengaduan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Pengaduan</li>
        </ol>
      </nav>
    </div>
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Input Pengaduan</h5>

              <form action="<?php echo $url['base_url'] ?>controller/crud.php?aksi=tambah" method="POST" enctype="multipart/form-data">
                <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?php echo $user['id_user'] ?>">

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Tanggapan</label>
                  <div class="col-sm-10">
                    <input type="datetime-local" name="tgl_tanggapan" class="form-control"
                      value="<?php echo date('Y-m-d\TH:i'); ?>" readonly>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Kategori</label>
                  <div class="col-sm-10">
                    <select name="kategori" class="form-select" required>
                      <option value="">-- Pilih Kategori --</option>
                      <option value="Infrastruktur & Fasilitas Umum">Infrastruktur & Fasilitas Umum</option>
                      <option value="Kebersihan & Lingkungan">Kebersihan & Lingkungan</option>
                      <option value="Ketertiban & Keamanan">Ketertiban & Keamanan</option>
                      <option value="Pelayanan Administrasi">Pelayanan Administrasi</option>
                      <option value="Bantuan Sosial">Bantuan Sosial</option>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Isi Laporan</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" style="height: 100px" name="isi_laporan" required></textarea>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">File Foto</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile" name="foto" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                  </div>
                </div>

              </form>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><?php include('../template/footer.php') ?>