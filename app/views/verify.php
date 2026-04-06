<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email - SQA Project</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Verifikasi Email</h2>
        <p style="text-align:center; font-size:13px; color:#555;">
            Kode verifikasi telah dikirimkan ke email Anda.
        </p>
        
        <form action="../controllers/verify_process.php" method="POST">
            <div class="form-group">
                <label>Masukkan Kode Verifikasi</label>
                <input type="text" name="kode_verifikasi" required>
            </div>
            <button type="submit" name="verify" class="btn">Verifikasi & Simpan</button>
            
            <a href="../index.php"><button type="button" class="btn btn-cancel">Cancel</button></a>
        </form>
    </div>
</body>
</html>