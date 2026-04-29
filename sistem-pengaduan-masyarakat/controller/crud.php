<?php
require "pintasan.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

//pendaftaran
if (!empty($_GET['aksi'] == "daftar")) {
    $tabel = 't_user';
    $email = $_POST['email'];

    // Cek apakah email sudah terdaftar
    if ($proses->cek_email_terdaftar($email)) {
        echo '<script>alert("Pendaftaran Gagal! Email tersebut sudah digunakan.");window.location="../index.php"</script>';
        exit;
    }

    $otp = rand(100000, 999999);

    $data = array(
        'nik'        => $_POST['nik'],
        'username'    => $_POST['username'],
        'password'    => $_POST['password'],
        'nama'        => $_POST['nama'],
        'no_tlp'    => $_POST['no_tlp'],
        'alamat'    => $_POST['alamat'], // Menangkap data alamat
        'level'        => $_POST['level'],
        'email'     => $email,
        'otp'       => $otp
    );
    $proses->daftar($tabel, $data);

    // Proses Kirim Email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'adminsipm@gmail.com'; // GANTI INI
        $mail->Password   = 'clzn hnnh hlps xxbm';    // GANTI INI
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('adminsipm@gmail.com', 'Admin SiPM'); // GANTI INI
        $mail->addAddress($_POST['email'], $_POST['nama']);

        $mail->isHTML(true);
        $mail->Subject = 'Kode Verifikasi OTP SiPM';
        $mail->Body    = "Halo " . $_POST['nama'] . ",<br><br>Terima kasih telah mendaftar. Kode OTP Anda adalah: <b>" . $otp . "</b><br>Jangan berikan kode ini kepada siapa pun.";

        $mail->send();

        session_start();
        $_SESSION['temp_email'] = $_POST['email'];

        echo '<script>alert("Daftar berhasil! Silahkan cek email untuk kode OTP.");window.location="../views/verifikasi_otp.php"</script>';
    } catch (Exception $e) {
        echo '<script>alert("Daftar berhasil, tapi email gagal terkirim.");window.location="../index.php"</script>';
    }
}

//verifikasi OTP
if (!empty($_GET['aksi'] == "verifikasi")) {
    $email = $_POST['email'];
    $otp = $_POST['otp'];

    $result = $proses->verifikasi_otp($email, $otp);

    if ($result) {
        session_start();
        unset($_SESSION['temp_email']);
        echo '<script>alert("Verifikasi Berhasil! Silahkan Login.");window.location="../index.php"</script>';
    } else {
        echo '<script>alert("Kode OTP Salah!");window.location="../views/verifikasi_otp.php"</script>';
    }
}

//login
if (!empty($_GET['aksi'] == "login")) {
    $username = strip_tags($_POST['username']);
    $password = strip_tags($_POST['password']);

    $result = $proses->proses_login($username, $password);
    if ($result == 'gagal') {
        echo '<script>alert("Login Gagal! Username atau password salah.");window.location="../index.php"</script>';
    } else if ($result == 'belum_verifikasi') {
        echo '<script>alert("Akun Anda belum diverifikasi. Silahkan cek email Anda.");window.location="../index.php"</script>';
    } else {
        session_start();
        $_SESSION['login'] = $result;
        echo '<script>alert("Login Berhasil");window.location="../views/dashboard.php"</script>';
    }
}

//logout
if (!empty($_GET['aksi'] == 'logout')) {
    session_start();
    require('../template/link.php');
    session_destroy();
    header('Location: ' . $url['base_url']);
}

//tambah pengaduan
if (!empty($_GET['aksi'] == "tambah")) {
    $tabel = 't_pengaduan';
    $data = array(
        'id_user'        => $_POST['id_user'],
        'tgl_pengaduan'    => $_POST['tgl_pengaduan'],
        'isi_laporan'    => $_POST['isi_laporan']
    );
    $proses->tambah_data($tabel, $data);
    echo '<script>alert("Tambah Data Berhasil");window.location="../views/dashboard.php"</script>';
}

// hapus data
if (!empty($_GET['aksi'] == "hapus")) {
    $tabel = 't_pengaduan';
    $where = 'id_pengaduan';
    $id = strip_tags($_GET['hapusid']);
    $proses->hapus_data($tabel, $where, $id);
    echo '<script>alert("Hapus Data Berhasil");window.location="../views/dashboard.php"</script>';
}

// proses edit
if (!empty($_GET['aksi'] == 'edit')) {
    $data = array(
        'tgl_pengaduan'    => $_POST['tgl_pengaduan'],
        'isi_laporan'    => $_POST['isi_laporan']
    );
    $tabel = 't_pengaduan';
    $where = 'id_pengaduan';
    $id = strip_tags($_POST['id_pengaduan']);
    $proses->edit_data($data, $tabel, $where, $id);
    echo '<script>alert("Edit Data Berhasil");window.location="../views/dashboard.php"</script>';
}

//tambah tanggapan
if (!empty($_GET['aksi'] == "tanggapan")) {
    $tabel = 't_tanggapan';
    $tabelubah = 't_pengaduan';
    $data = array(
        'tanggapan'        => $_POST['tanggapan'],
        'id_pengaduan'    => $_POST['id_pengaduan'],
        'id_user'        => $_POST['id_user']
    );
    $where = 'id_pengaduan';
    $id = strip_tags($_POST['id_pengaduan']);
    $proses->tambah_tanggapan($tabel, $data);
    $proses->editstatus($tabelubah, $where, $id);
    echo '<script>alert("Tambah Tanggapan Berhasil");window.location="../views/validasi.php"</script>';
}

// hapus akun
if (!empty($_GET['aksi'] == "hapus_akun")) {
    $tabel = 't_user';
    $where = 'id_user';
    $id = strip_tags($_GET['hapusid']);
    session_start();
    session_destroy();
    $proses->hapus_akun($tabel, $where, $id);
    echo '<script>alert("Hapus Akun Berhasil");window.location="../index.php"</script>';
}
