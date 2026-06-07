<?php
class crud
{
    protected $db;
    function __construct($db)
    {
        $this->db = $db;
    }

    // FUNGSI BARU: Mengecek apakah email sudah dipakai
    public function cek_email_terdaftar($email)
    {
        $row = $this->db->prepare("SELECT email FROM t_user WHERE email = ?");
        $row->execute(array($email));
        return $row->rowCount() > 0;
    }

    //model daftar
    public function daftar($tabel, $data)
    {
        $nik = $data['nik'];
        $username = $data['username'];
        $password = md5($data['password']);
        $nama = $data['nama'];
        $no_tlp = $data['no_tlp'];
        $alamat = $data['alamat']; // Data alamat masuk
        $level = $data['level'];
        $email = $data['email'];
        $otp = $data['otp'];

        // Query SQL diupdate untuk memasukkan alamat
        $sql = "INSERT INTO $tabel (nik, username, password, nama, no_tlp, alamat, level, email, otp, is_verified) 
            VALUES ('$nik', '$username', '$password', '$nama', '$no_tlp', '$alamat', '$level', '$email', '$otp', 0)";

        $save = $this->db->prepare($sql);
        return $save->execute();
    }

    //model verifikasi otp
    public function verifikasi_otp($email, $otp)
    {
        $row = $this->db->prepare('SELECT * FROM t_user WHERE email=? AND otp=?');
        $row->execute(array($email, $otp));
        $count = $row->rowCount();

        if ($count > 0) {
            $update = $this->db->prepare("UPDATE t_user SET is_verified = 1 WHERE email = ?");
            return $update->execute(array($email));
        } else {
            return false;
        }
    }

    //model login 
    function proses_login($username, $password)
    {
        $password_hash = md5($password);
        $row = $this->db->prepare('SELECT * FROM t_user WHERE username=? AND password=?');
        $row->execute(array($username, $password_hash));
        $count = $row->rowCount();

        if ($count > 0) {
            $hasil = $row->fetch();
            if ($hasil['is_verified'] == 0) {
                return 'belum_verifikasi';
            }
            return $hasil;
        } else {
            return 'gagal';
        }
    }

    // Di dalam fungsi tambah_data pada model/crud.php
    public function tambah_data($tabel, $data)
    {
        $id_user = $data['id_user'];
        $kategori = $data['kategori'];

        // Tambahkan 7 jam (25200 detik) ke waktu saat ini
        $tgl_pengaduan = date('Y-m-d H:i:s');

        $isi_laporan = $data['isi_laporan'];
        $ft = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        move_uploaded_file($tmp, '../upload/' . $ft);

        $sql = "INSERT INTO $tabel (id_user, kategori, tgl_pengaduan, isi_laporan, foto, status) 
            VALUES ('$id_user', '$kategori', '$tgl_pengaduan', '$isi_laporan', '$ft', 0)";

        $save = $this->db->prepare($sql);
        return $save->execute();
    }

    //hapus data
    function hapus_data($tabel, $where, $id)
    {
        $sql = "DELETE FROM $tabel WHERE $where = ?";
        $row = $this->db->prepare($sql);
        return $row->execute(array($id));
    }

    //hapus akun
    function hapus_akun($tabel, $where, $id)
    {
        $sql = "DELETE FROM $tabel WHERE $where = ?";
        $row = $this->db->prepare($sql);
        return $row->execute(array($id));
    }

    //tampil data berdasarkan id
    function tampil_data_id($tabel, $where, $id)
    {
        $row = $this->db->prepare("SELECT * FROM $tabel WHERE $where = ?");
        $row->execute(array($id));
        return $hasil = $row->fetch();
    }

    //edit (UPDATE: Ditambahkan Kategori)
    public function edit_data($data = array(), $tabel, $where, $id)
    {
        $tgl_pengaduan = date('Y-m-d H:i:s');
        $kategori = $data['kategori']; // Tambahan kategori
        $isi_laporan = $data['isi_laporan'];

        // Cek apakah user mengunggah foto baru
        if ($_FILES['foto']['name'] != '') {
            $ft = $_FILES['foto']['name'];
            $tmp = $_FILES['foto']['tmp_name'];
            move_uploaded_file($tmp, '../upload/' . $ft);
        } else {
            $ft = $_POST['foto_lama'];
        }

        $sql = "UPDATE $tabel SET tgl_pengaduan = '$tgl_pengaduan', kategori = '$kategori', isi_laporan = '$isi_laporan', foto = '$ft' WHERE $where = '$id'";
        $result = $this->db->prepare($sql);
        return $result->execute();
    }

    // 1. Laporan Harian
    function tampil_data_harian($tabel, $user, $tanggal = null)
    {
        // Jika tidak ada tanggal yang dikirim, paksa gunakan tanggal hari ini
        if ($tanggal == null || $tanggal == '') {
            $tanggal = date('Y-m-d');
        }

        // Menggunakan DATE(p.tgl_pengaduan) untuk berjaga-jaga jika tipe datanya DATETIME
        $sql = "SELECT p.*, u.nama, u.nik 
                    FROM $tabel p 
                    LEFT JOIN t_user u ON p.id_user = u.id_user 
                    WHERE DATE(p.tgl_pengaduan) = '$tanggal' 
                    ORDER BY p.tgl_pengaduan DESC";

        $row = $this->db->prepare($sql);
        $row->execute();
        return $row->fetchAll();
    }

    // 2. Laporan Mingguan
    function tampil_data_mingguan($tabel, $user, $minggu = null, $bulan = null, $tahun = null)
    {
        if ($minggu != null && $bulan != null && $tahun != null) {
            $start_day = ($minggu - 1) * 7 + 1;
            $end_day = $minggu * 7;
            $batas_hari_bulan = date('t', strtotime("$tahun-$bulan-01"));

            if ($end_day > $batas_hari_bulan) {
                $end_day = $batas_hari_bulan;
            }

            $start = "$tahun-$bulan-" . sprintf("%02d", $start_day);
            $end = "$tahun-$bulan-" . sprintf("%02d", $end_day);

            $row = $this->db->prepare("SELECT p.*, u.nama, u.nik FROM $tabel p LEFT JOIN t_user u ON p.id_user = u.id_user WHERE p.tgl_pengaduan BETWEEN '$start' AND '$end' ORDER BY p.tgl_pengaduan DESC");
        } else {
            $nows = strtotime(date('Y-m-d'));
            $start = date('Y-m-d', strtotime('-7 day', $nows));
            $end = date('Y-m-d');
            $row = $this->db->prepare("SELECT p.*, u.nama, u.nik FROM $tabel p LEFT JOIN t_user u ON p.id_user = u.id_user WHERE p.tgl_pengaduan BETWEEN '$start' AND '$end' ORDER BY p.tgl_pengaduan DESC");
        }
        $row->execute();
        return $row->fetchAll();
    }

    // 3. Laporan Bulanan
    function tampil_data_bulanan($tabel, $user, $bulan = null, $tahun = null)
    {
        if ($bulan != null && $tahun != null) {
            $row = $this->db->prepare("SELECT p.*, u.nama, u.nik FROM $tabel p LEFT JOIN t_user u ON p.id_user = u.id_user WHERE MONTH(p.tgl_pengaduan) = '$bulan' AND YEAR(p.tgl_pengaduan) = '$tahun' ORDER BY p.tgl_pengaduan DESC");
        } else {
            $start = date('Y-m-01');
            $end = date('Y-m-t');
            $row = $this->db->prepare("SELECT p.*, u.nama, u.nik FROM $tabel p LEFT JOIN t_user u ON p.id_user = u.id_user WHERE p.tgl_pengaduan BETWEEN '$start' AND '$end' ORDER BY p.tgl_pengaduan DESC");
        }
        $row->execute();
        return $row->fetchAll();
    }

    // 4. Laporan Tahunan
    function tampil_data_tahunan($tabel, $user, $tahun = null)
    {
        if ($tahun != null) {
            $row = $this->db->prepare("SELECT p.*, u.nama, u.nik FROM $tabel p LEFT JOIN t_user u ON p.id_user = u.id_user WHERE YEAR(p.tgl_pengaduan) = '$tahun' ORDER BY p.tgl_pengaduan DESC");
        } else {
            $row = $this->db->prepare("SELECT p.*, u.nama, u.nik FROM $tabel p LEFT JOIN t_user u ON p.id_user = u.id_user WHERE YEAR(p.tgl_pengaduan) = YEAR(NOW()) ORDER BY p.tgl_pengaduan DESC");
        }
        $row->execute();
        return $row->fetchAll();
    }

    //tampil data seluruhnya
    // Tampil data pengaduan masuk (Untuk halaman validasi)
    function tampil_data_pengaduan($tabel, $user)
    {
        // Menggabungkan tabel pengaduan dengan tabel user untuk mengambil Nama dan NIK
        $sql = "SELECT p.*, u.nama, u.nik 
                    FROM $tabel p 
                    LEFT JOIN t_user u ON p.id_user = u.id_user 
                    WHERE p.status = 0 
                    ORDER BY p.tgl_pengaduan DESC";

        $row = $this->db->prepare($sql);
        $row->execute();
        return $hasil = $row->fetchAll();
    }

    //tampil data pengaduan per id
    function tampil_data_pengaduan_id($tabel, $user)
    {
        $row = $this->db->prepare("SELECT * FROM $tabel WHERE id_user=$user");
        $row->execute();
        return $hasil = $row->fetchAll();
    }

    //tambah data tanggapan
    public function tambah_tanggapan($tabel, $data)
    {
        $id_user = $data['id_user'];
        $id_pengaduan = $data['id_pengaduan'];
        $tgl_tanggapan = date('Y-m-d H:i:s');
        $tanggapan = $data['tanggapan'];

        $sql = "INSERT INTO $tabel (tgl_tanggapan, tanggapan, id_pengaduan, id_user) 
            VALUES ('$tgl_tanggapan', '$tanggapan', '$id_pengaduan', '$id_user')";

        $save = $this->db->prepare($sql);
        return $save->execute();
    }

    // UPDATE: Status dinamis (Terima=1, Tolak=2)
    public function editstatus($tabelubah, $where, $id, $status_baru)
    {
        $sql = "UPDATE $tabelubah SET status = $status_baru WHERE $where = '$id'";
        $save = $this->db->prepare($sql);
        return $save->execute();
    }

    //tampil data tanggapan per id
    function tampil_data_tanggapan($tabel, $where, $id)
    {
        $row = $this->db->prepare("SELECT * FROM $tabel WHERE $where = ?");
        $row->execute(array($id));
        return $hasil = $row->fetch();
    }

    function tampil_data_tang($tabel, $user)
    {
        $row = $this->db->prepare("SELECT * FROM $tabel WHERE id_user=$user");
        $row->execute();
        return $hasil = $row->fetchAll();
    }

    // FUNGSI DASHBOARD
    public function hitung_total_pengaduan()
    {
        $row = $this->db->prepare("SELECT COUNT(id_pengaduan) as total FROM t_pengaduan");
        $row->execute();
        $hasil = $row->fetch();
        return $hasil['total'];
    }

    public function hitung_pengaduan_pending()
    {
        $row = $this->db->prepare("SELECT COUNT(id_pengaduan) as total FROM t_pengaduan WHERE status = 0");
        $row->execute();
        $hasil = $row->fetch();
        return $hasil['total'];
    }

    public function hitung_total_masyarakat()
    {
        $row = $this->db->prepare("SELECT COUNT(id_user) as total FROM t_user WHERE level = 2");
        $row->execute();
        $hasil = $row->fetch();
        return $hasil['total'];
    }

    // FUNGSI BARU: Menampilkan pengaduan dan tanggapan yang sinkron (LEFT JOIN)
    public function tampil_pengaduan_tanggapan_user($id_user)
    {
        $sql = "SELECT p.*, t.id_tanggapan, t.tgl_tanggapan 
                    FROM t_pengaduan p 
                    LEFT JOIN t_tanggapan t ON p.id_pengaduan = t.id_pengaduan 
                    WHERE p.id_user = ? 
                    ORDER BY p.id_pengaduan ASC"; // Diurutkan berdasarkan ID supaya urutan 1, 2, 3, 4, 5

        $row = $this->db->prepare($sql);
        $row->execute(array($id_user));
        return $row->fetchAll();
    }
    // FUNGSI BARU: Edit Profil User
    // FUNGSI: Edit Profil User
    public function edit_profil($data = array(), $id_user)
    {
        $username = $data['username']; // <-- Ambil username
        $email = $data['email'];
        $no_tlp = $data['no_tlp'];
        $alamat = $data['alamat'];

        // Cek apakah user mengunggah foto profil baru
        if ($_FILES['foto_profil']['name'] != '') {
            $foto = $_FILES['foto_profil']['name'];
            $tmp = $_FILES['foto_profil']['tmp_name'];

            // Upload ke folder upload
            move_uploaded_file($tmp, '../upload/' . $foto);

            // Query UPDATE menggunakan username (bukan NIK/Nama)
            $sql = "UPDATE t_user SET username = ?, email = ?, no_tlp = ?, alamat = ?, foto_profil = ? WHERE id_user = ?";
            $result = $this->db->prepare($sql);
            return $result->execute(array($username, $email, $no_tlp, $alamat, $foto, $id_user));
        } else {
            // Jika foto tidak diubah
            $sql = "UPDATE t_user SET username = ?, email = ?, no_tlp = ?, alamat = ? WHERE id_user = ?";
            $result = $this->db->prepare($sql);
            return $result->execute(array($username, $email, $no_tlp, $alamat, $id_user));
        }
    }
}
