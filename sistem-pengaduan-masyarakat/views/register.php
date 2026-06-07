<?php
include('../template/link.php');
include('../template/head.php');
?>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">SiPM</span>
                </a>
              </div>
              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Buat Akun</h5>
                    <p class="text-center small">Masukan data diri Anda</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate action="<?php echo $url['base_url']; ?>controller/crud.php?aksi=daftar" method="POST">

                    <!-- INPUT TERSEMBUNYI UNTUK LEVEL (Otomatis Masyarakat / Level 2) -->
                    <input type="hidden" name="level" value="2">

                    <div class="col-12">
                      <label for="yourNIK" class="form-label">NIK</label>
                      <input type="tel" name="nik" class="form-control" id="yourNIK" required minlength="16" maxlength="16" pattern="^[0-9]{16}$"
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

                    <div class="col-12">
                      <label for="yourName" class="form-label">Nama Lengkap</label>
                      <input type="text" name="nama" class="form-control" required>
                      <div class="invalid-feedback">Silahkan masukan nama!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Email Aktif</label>
                      <input type="email" name="email" class="form-control" required>
                      <div class="invalid-feedback">Silahkan masukan email yang valid!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Silahkan masukan username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required minlength="8" pattern="(?=.*\d)(?=.*[a-zA-Z]).{8,}"
                        oninput="this.nextElementSibling.innerText = this.value === '' ? 'Password tidak boleh kosong!' : 'Password minimal 8 karakter, dan harus ada huruf & angka!'"
                        oninvalid="this.nextElementSibling.innerText = this.value === '' ? 'Password tidak boleh kosong!' : 'Password minimal 8 karakter, dan harus ada huruf & angka!'">
                      <div class="invalid-feedback">Password tidak boleh kosong!</div>
                    </div>

                    <div class="col-12">
                        <label for="yourTlp" class="form-label">Nomor Telepon</label>
                        <input type="tel" name="no_tlp" class="form-control" id="yourTlp" required maxlength="13" pattern="^08[0-9]{8,11}$"
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

                    <div class="col-12">
                      <label for="yourAddress" class="form-label">Alamat Lengkap</label>
                      <textarea name="alamat" class="form-control" style="height: 80px;" required></textarea>
                      <div class="invalid-feedback">Silahkan masukan alamat lengkap!</div>
                    </div>

                    <div class="col-12 mt-4">
                      <button class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Sudah punya akun? <a href="<?php echo $url['base_url']; ?>">Log in</a></p>
                    </div>

                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main>
  
<?php include('../template/footer.php')  ?>