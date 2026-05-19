<?php
include 'template/link.php';
include 'template/head.php';
?>

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
            </div><!-- End Logo -->

            <div class="card mb-3">

              <div class="card-body">

                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Login Akun SiPM</h5>
                  <p class="text-center small">Masukan username & password untuk login</p>
                </div>

                <form class="row g-3 needs-validation" action="<?php echo $url['base_url']; ?>controller/crud.php?aksi=login" method="POST">

                  <div class="col-12">
                    <label for="yourUsername" class="form-label">Username</label>
                    <div class="input-group has-validation">
                      <input type="text" name="username" class="form-control" id="yourUsername" required>
                      <div class="invalid-feedback">masukan username.</div>
                    </div>
                  </div>

                  <div class="col-12">
                    <label for="yourPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="yourPassword" required minlength="8"
                      oninput="this.nextElementSibling.innerText = this.value === '' ? 'Password tidak boleh kosong!' : 'Password minimal 8 karakter!'"
                      oninvalid="this.nextElementSibling.innerText = this.value === '' ? 'Password tidak boleh kosong!' : 'Password minimal 8 karakter!'">
                    <div class="invalid-feedback">Password tidak boleh kosong!</div>
                  </div>

                  <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Login</button>
                  </div>
                  <div class="col-12">
                    <p class="small mb-0">Belum punya akun? <a href="<?php echo $url['base_url']; ?>views/register.php">Daftar</a></p>
                  </div>
                </form>

              </div>
            </div>


          </div>
        </div>
      </div>

    </section>

  </div>
</main><!-- End #main -->
<?php include 'template/footer.php'; ?>