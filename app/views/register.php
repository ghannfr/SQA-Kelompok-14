<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi - SQA Project</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Registrasi Akun</h2>
        <form action="../controllers/auth_process.php" method="POST">
            <div class="form-group"><label>Nama Lengkap</label><input type="text" name="nama" required></div>
            <div class="form-group"><label>Email</label><input type="email" name="email" required></div>
            <div class="form-group"><label>Lokasi / Alamat</label><input type="text" name="alamat" required></div>
            <div class="form-group"><label>Nomor Telepon</label><input type="tel" name="telepon" required></div>
            <div class="form-group"><label>Username</label><input type="text" name="username" required></div>
            <div class="form-group"><label>Password</label><input type="password" name="password" required></div>
            
            <button type="submit" name="register" class="btn">Create Akun</button>
            
            <a href="../index.php"><button type="button" class="btn btn-cancel">Cancel</button></a>
        </form>
    </div>
</body>
</html>