<?php 
  require "../controller/pintasan.php";
  include('../template/link.php');
  include('../template/head.php');
?>

<body>
    <?php include('../template/topbar.php'); include('../template/sidebar.php'); ?>
    
    <?php 
        $profil = $proses->tampil_data_id('t_user', 'id_user', $user['id_user']);
        $foto_src = (!empty($profil['foto_profil'])) ? "../upload/" . $profil['foto_profil'] : "https://ui-avatars.com/api/?name=" . urlencode($profil['nama']) . "&background=random&color=fff&rounded=true&size=120";
    ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Edit Profil</h1>
            <nav><ol class="breadcrumb"><li class="breadcrumb-item"><a href="dashboard.php">Home</a></li><li class="breadcrumb-item"><a href="profil.php">Profil</a></li><li class="breadcrumb-item active">Edit</li></ol></nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-body pt-4">
                            
                            <form action="<?php echo $url['base_url'];?>controller/crud.php?aksi=editprofil" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                <input type="hidden" name="id_user" value="<?php echo $profil['id_user']; ?>">

                                <div class="row mb-4 text-center">
                                    <div class="col-12">
                                        <img id="preview_foto" src="<?php echo $foto_src; ?>" class="rounded-circle mb-3 shadow-sm border border-3 border-primary" style="width: 120px; height: 120px; object-fit: cover;"><br>
                                        <label for="foto_profil" class="btn btn-outline-primary btn-sm"><i class="bi bi-camera"></i> Ganti Foto Profil</label>
                                        <input class="form-control d-none" type="file" id="foto_profil" name="foto_profil" accept="image/*" onchange="document.getElementById('preview_foto').src = window.URL.createObjectURL(this.files[0])">
                                        <small class="d-block mt-2 text-muted">*Format JPG/PNG. Kosongkan jika tidak ingin mengubah foto.</small>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label fw-bold">NIK</label>
                                    <div class="col-sm-9">
                                        <input type="tel" name="nik" class="form-control" value="<?php echo $profil['nik']; ?>" required minlength="16" maxlength="16" pattern="^[0-9]{16}$"
                                            oninput="
                                                this.value = this.value.replace(/[^0-9]/g, '');
                                                let pesan = '';
                                                if (this.value === '') {
                                                    pesan = 'NIK tidak boleh kosong!';
                                                } else if (this.value.length < 16) {
                                                    pesan = 'NIK kurang lengkap! NIK harus pas 16 angka.';
                                                }
                                                this.setCustomValidity(pesan);
                                                if (pesan) this.nextElementSibling.innerText = pesan;
                                            "
                                            oninvalid="
                                                if (this.value === '') {
                                                    this.setCustomValidity('kosong');
                                                    this.nextElementSibling.innerText = 'NIK tidak boleh kosong!';
                                                }
                                            ">
                                        <div class="invalid-feedback">NIK tidak boleh kosong!</div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label fw-bold">Username</label>
                                    <div class="col-sm-9"><input type="text" name="username" class="form-control bg-light" value="<?php echo $profil['username']; ?>" readonly></div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label fw-bold">Nama Lengkap</label>
                                    <div class="col-sm-9"><input type="text" name="nama" class="form-control" value="<?php echo $profil['nama']; ?>" required></div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label fw-bold">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" class="form-control bg-light" value="<?php echo $profil['email']; ?>" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label fw-bold">No. Telepon</label>
                                    <div class="col-sm-9">
                                        <input type="tel" name="no_tlp" class="form-control" value="<?php echo $profil['no_tlp']; ?>" required maxlength="13" pattern="^08[0-9]{8,11}$"
                                            oninput="
                                                this.value = this.value.replace(/[^0-9]/g, '');
                                                let pesan = '';
                                                if (this.value === '') pesan = 'Nomor telepon tidak boleh kosong!';
                                                else if (!/^08/.test(this.value)) pesan = 'Nomor telepon harus diawali dengan angka 08!';
                                                else if (this.value.length < 10) pesan = 'Nomor terlalu pendek (minimal 10 angka)!';

                                                this.setCustomValidity(pesan);
                                                if (pesan) this.nextElementSibling.innerText = pesan;
                                            "
                                            oninvalid="
                                                if (this.value === '') {
                                                    this.setCustomValidity('kosong');
                                                    this.nextElementSibling.innerText = 'Nomor telepon tidak boleh kosong!';
                                                }
                                            ">
                                        <div class="invalid-feedback">Nomor telepon tidak boleh kosong!</div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label fw-bold">Alamat Lengkap</label>
                                    <div class="col-sm-9"><textarea name="alamat" class="form-control" style="height: 100px" required><?php echo $profil['alamat']; ?></textarea></div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-sm-12 text-end">
                                        <a href="profil.php" class="btn btn-secondary me-2"><i class="bi bi-x-circle"></i> Batal</a>
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan Perubahan</button>
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