# Software Test Plan (STP)
**Proyek:** Simple Multi-Vendor Website
**Versi:** 1.0
**Tanggal:** [Masukkan Tanggal Hari Ini]

## 1. Pendahuluan
### 1.1 Tujuan
Tujuan dari dokumen *Software Test Plan* ini adalah untuk mendefinisikan strategi, ruang lingkup, dan pendekatan yang akan digunakan dalam menguji aplikasi *Simple Multi-Vendor Website*. Pengujian ini bertujuan untuk memastikan bahwa seluruh fitur fungsional berjalan sesuai dengan *Software Requirements Specification* (SRS) dan bebas dari *bug* kritis sebelum dirilis.

### 1.2 Latar Belakang
Aplikasi *Simple Multi-Vendor Website* adalah platform *e-commerce* berbasis Django yang melibatkan transaksi keuangan menggunakan *payment gateway* Stripe. Mengingat adanya aliran dana dan pengelolaan data dari berbagai penjual (Vendor), pengujian yang ketat sangat diperlukan untuk menjamin keamanan transaksi dan akurasi manajemen pesanan.

### 1.3 Ruang Lingkup
Ruang lingkup pengujian pada tahap ini difokuskan pada pengujian fungsional (*Functional Testing*) dan pengujian antarmuka pengguna (*UI Testing*). Area utama yang akan diuji meliputi:
1. Pendaftaran dan Autentikasi Pengguna (Admin, Vendor, User).
2. Modul manajemen produk oleh Vendor dan Admin.
3. Proses *Add to Cart* dan kelancaran *Checkout* oleh User.
4. Integrasi pembayaran menggunakan kartu tes Stripe.
5. Sistem pengiriman notifikasi email.

---

## 2. Lingkungan Pengujian Perangkat Lunak
### 2.1 Material Pengujian
Untuk menjalankan skenario pengujian, perangkat dan material berikut telah disiapkan:
- **Perangkat Keras:** PC/Laptop standar dengan spesifikasi minimal RAM 4GB.
- **Sistem Operasi:** Windows 10/11, macOS, atau Linux.
- **Peramban Web (*Browser*):** Google Chrome (versi terbaru) dan Mozilla Firefox.
- **Alat Pendukung:** Akun email pengujian (untuk mengecek notifikasi) dan nomor kartu kredit *dummy* (disediakan oleh dokumentasi Stripe untuk mode *testing*).
- **Server:** Django Development Server (berjalan di *localhost* / `127.0.0.1:8000`).

### 2.2 Teknik Pengujian
Teknik utama yang digunakan adalah **Black Box Testing** secara manual. Tim SQA akan memposisikan diri sebagai pengguna akhir (Admin, Vendor, atau Pembeli) dan menjalankan sistem tanpa melihat struktur kode di dalamnya (*backend*). Pengujian akan memvalidasi apakah input tertentu menghasilkan *output* yang diharapkan sesuai spesifikasi.

---

## 3. Rencana Pengujian
Berikut adalah skenario pengujian utama yang direncanakan untuk dieksekusi:

**Skenario 1: Modul Vendor (Manajemen Produk)**
- **ID Test:** TC-01
- **Deskripsi:** Menguji kemampuan Vendor untuk menambahkan produk baru.
- **Langkah:** Login sebagai Vendor -> Masuk ke Dasbor -> Isi form Tambah Produk (Nama, Harga, Kategori, Foto) -> Klik Simpan.
- **Ekspektasi Hasil:** Sistem menampilkan pesan sukses dan produk baru muncul di halaman etalase toko.

**Skenario 2: Modul User (Checkout & Pembayaran)**
- **ID Test:** TC-02
- **Deskripsi:** Menguji proses pembayaran menggunakan Stripe.
- **Langkah:** Login sebagai User -> Tambahkan produk ke keranjang -> Masuk ke halaman *Checkout* -> Isi alamat pengiriman -> Masukkan detail kartu kredit *dummy* Stripe -> Klik Bayar.
- **Ekspektasi Hasil:** Transaksi berhasil, pesanan tercatat di *database*, saldo tidak terpotong (karena *mode test*), dan email konfirmasi pesanan terkirim.

**Skenario 3: Modul Admin (Manajemen Kategori)**
- **ID Test:** TC-03
- **Deskripsi:** Menguji hak akses Admin dalam menghapus kategori produk.
- **Langkah:** Login sebagai Admin (Superuser) -> Masuk ke panel Admin -> Pilih salah satu kategori -> Klik Hapus.
- **Ekspektasi Hasil:** Kategori berhasil dihapus dari sistem dan opsi kategori tersebut hilang dari menu pencarian pengunjung.

---

## 4. Hasil Pengujian
*(Catatan: Bagian ini akan diisi oleh tim QA setelah skenario pada bagian "3. Rencana Pengujian" selesai dieksekusi. Di bawah ini adalah format tabel pelaporan hasil).*

| ID Test | Modul yang Diuji | Status Eksekusi | Catatan / Temuan Bug | Penguji |
| :--- | :--- | :--- | :--- | :--- |
| TC-01 | Tambah Produk (Vendor) | [Menunggu Eksekusi] | - | [Nama Anggota] |
| TC-02 | Checkout & Pembayaran (User) | [Menunggu Eksekusi] | - | [Nama Anggota] |
| TC-03 | Hapus Kategori (Admin) | [Menunggu Eksekusi] | - | [Nama Anggota] |
