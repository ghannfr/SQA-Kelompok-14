<?php
$host = "localhost";
$user = "root";
$pass = ""; // Biarkan kosong jika Anda menggunakan default XAMPP
$db   = "sqa_project";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>