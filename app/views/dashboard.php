<?php
session_start();

// Cek apakah user sudah login, jika belum lempar kembali ke form login
if(!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Utama</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container" style="width: 500px; text-align: center;">
        <h2>Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p>Anda telah berhasil masuk ke halaman utama sistem.</p>
        
        <form action="../controllers/logout_process.php" method="POST">
            <button type="submit" class="btn btn-cancel" style="width: auto; padding: 10px 20px;">Logout</button>
        </form>
    </div>
</body>
</html>