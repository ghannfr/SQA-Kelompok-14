<?php
session_start();
require '../config/db.php'; // Memanggil koneksi database

// --- PROSES LOGIN ---
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Cari user di database
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    
    if(mysqli_num_rows($query) > 0) {
        $data_user = mysqli_fetch_assoc($query);
        
        // Cek password (menggunakan password_verify karena kita akan men-enkripsi password saat registrasi)
        if(password_verify($password, $data_user['password'])) {
            $_SESSION['username'] = $data_user['username'];
            header("Location: ../views/dashboard.php"); 
            exit();
        } else {
            echo "<script>alert('Password salah!'); window.location.href='../index.php';</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!'); window.location.href='../index.php';</script>";
    }
}

// --- PROSES REGISTRASI ---
if(isset($_POST['register'])) {
    // Kriteria 2 & 3: Ambil semua data dari form
    // Kita simpan ke dalam session sementara, karena harus melewati tahap verifikasi (Kriteria 5 & 6) 
    // sebelum benar-benar masuk ke database (Kriteria 7).
    
    $_SESSION['temp_register'] = [
        'nama'     => $_POST['nama'],
        'email'    => $_POST['email'],
        'alamat'   => $_POST['alamat'],
        'telepon'  => $_POST['telepon'],
        'username' => $_POST['username'],
        // Enkripsi password untuk keamanan (Best Practice)
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT) 
    ];
    
    // Arahkan ke halaman verifikasi email
    header("Location: ../views/verify.php");
    exit();
}
?>