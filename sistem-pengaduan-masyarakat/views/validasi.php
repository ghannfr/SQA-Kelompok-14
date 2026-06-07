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
        <h1>Validasi Pengaduan</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Validasi</li>
            </ol>
        </nav>
        </div>

        <section class="section">
        <div class="row">
            <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Daftar Pengaduan Masuk (Belum Ditanggapi)</h5>

              <table class="table table-hover align-middle">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">ID Laporan</th>
                    <th scope="col">Pengirim</th> <!-- TAMBAHAN KOLOM PENGIRIM -->
                    <th scope="col">Tanggal</th>
                    <th scope="col">Isi Laporan</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    $no=1;
                    $hasil = $proses->tampil_data_pengaduan('t_pengaduan', $user['id_user']);

                    foreach($hasil as $isi){
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        
                        <!-- Format ID Laporan -->
                        <td>
                            <span class="badge bg-primary">
                                <i class="bi bi-file-earmark-text"></i> PGD-<?php echo sprintf("%03d", $isi['id_pengaduan']); ?>
                            </span>
                        </td>
                        
                        <!-- MENAMPILKAN DATA PENGIRIM -->
                        <td>
                            <span class="fw-bold"><?php echo $isi['nama']; ?></span><br>
                            <span class="text-muted small">NIK: <?php echo $isi['nik']; ?></span>
                        </td>
                        
                        <td><?php echo date('d M Y', strtotime($isi['tgl_pengaduan'])); ?></td>
                        
                        <td>
                            <?php 
                                echo strlen($isi['isi_laporan']) > 40 ? substr($isi['isi_laporan'], 0, 40) . '...' : $isi['isi_laporan'];
                            ?>
                        </td>
                        
                        <td><img src="<?php echo "../upload/".$isi['foto'];?>" width="70px" height="70px" class="rounded shadow-sm" style="object-fit: cover;" /></td>
                        
                        <td style="text-align: left;">
                            <!-- PERBAIKAN LINK KE addtanggapan.php -->
                            <a href="addtanggapan.php?id=<?php echo $isi['id_pengaduan'];?>" class="btn btn-success btn-sm">
                                <span class="bi bi-reply-fill"></span> Tanggapi
                            </a>
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

    </main>
    <?php include('../template/footer.php') ?>