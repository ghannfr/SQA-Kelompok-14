<?php
session_start();
require '../config/db.php'; // Memanggil koneksi database

if(isset($_POST['verify'])) {
    $kode = $_POST['kode_verifikasi'];
    
    // Untuk simulasi tugas SQA ini, kita asumsikan kodenya selalu benar
    // Cek apakah ada data registrasi yang sedang menunggu verifikasi
    if(isset($_SESSION['temp_register'])) {
        $data = $_SESSION['temp_register'];
        
        $nama     = $data['nama'];
        $email    = $data['email'];
        $alamat   = $data['alamat'];
        $telepon  = $data['telepon'];
        $username = $data['username'];
        $password = $data['password'];
        
        // Kriteria 7: Sistem menyimpan data user ke dalam database customer
        $query = "INSERT INTO users (nama, email, alamat, telepon, username, password) 
                  VALUES ('$nama', '$email', '$alamat', '$telepon', '$username', '$password')";
                  
        if(mysqli_query($conn, $query)) {
            // Bersihkan data sementara
            unset($_SESSION['temp_register']);
            
            // Sistem menampilkan halaman login pada website
            echo "<script>
                    alert('Verifikasi berhasil! Data telah disimpan di database. Silahkan Login.');
                    window.location.href = '../index.php';
                  </script>";
            exit();
        } else {
            // Jika username sudah ada di database (karena kolom username sifatnya UNIQUE)
            echo "<script>
                    alert('Gagal menyimpan: Username atau Email mungkin sudah digunakan!');
                    window.location.href = '../views/register.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Sesi registrasi habis, silahkan daftar ulang.');
                window.location.href = '../views/register.php';
              </script>";
    }
}
?>