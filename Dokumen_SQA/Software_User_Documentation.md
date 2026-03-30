# Software User Documentation (SUD)
**Proyek:** Simple Multi-Vendor Website
**Versi:** 1.0
**Tanggal:** [Masukkan Tanggal Hari Ini]

## 1. Pendahuluan
### 1.1 Tujuan
Dokumen ini disusun sebagai panduan resmi (buku manual) bagi pengguna untuk memahami cara mengoperasikan fitur-fitur yang ada pada *Simple Multi-Vendor Website*. Panduan ini dirancang agar pengguna dapat melakukan aktivitas seperti berbelanja, mengelola toko, hingga mengelola sistem dengan mudah dan lancar.

### 1.2 Karakteristik User
Sistem ini dirancang untuk tiga kategori pengguna utama:
1. **User (Pembeli):** Pengguna publik yang ingin mencari, memilih, dan membeli produk dari berbagai toko.
2. **Vendor (Penjual):** Pemilik toko yang menggunakan platform ini untuk menjajakan produk mereka dan menerima pesanan.
3. **Admin:** Pengelola utama situs web yang bertugas menjaga kelancaran operasional dan mengelola master data.

### 1.3 System Requirements
Untuk dapat menggunakan website ini dengan optimal, pengguna membutuhkan:
- Perangkat (PC/Laptop/Smartphone) yang terhubung dengan jaringan internet yang stabil.
- Peramban web (*Web Browser*) modern seperti Google Chrome, Mozilla Firefox, Safari, atau Microsoft Edge versi terbaru.
- Alamat email yang aktif untuk keperluan registrasi dan penerimaan notifikasi pesanan.

---

## 2. Deskripsi Umum
### 2.1 Perspektif Produk
*Simple Multi-Vendor Website* adalah sebuah platform pasar digital (*marketplace*) mandiri. Aplikasi ini tidak memerlukan instalasi perangkat lunak khusus di perangkat pengguna, karena seluruh interaksi dilakukan secara *online* melalui antarmuka web yang responsif.

### 2.2 Manfaat Produk
Bagi pengguna, platform ini memberikan kemudahan untuk berbelanja dari berbagai toko berbeda dalam satu kali proses *checkout*. Pembayaran dijamin aman karena terintegrasi dengan layanan *payment gateway* Stripe. Bagi penjual, platform ini menyediakan etalase digital instan tanpa perlu memikirkan biaya pembuatan dan perawatan server website sendiri.

---

## 3. Penggunaan Simple Multi-Vendor Website
*(Bagian ini menjelaskan langkah-langkah penggunaan berdasarkan peran pengguna).*

### 3.1 Panduan untuk User (Pembeli)
**A. Mencari dan Memilih Produk:**
1. Buka halaman utama (*Homepage*) website.
2. Jelajahi produk berdasarkan Kategori yang tersedia di menu navigasi, atau gulir ke bawah untuk melihat daftar produk terbaru.
3. Klik pada gambar atau nama produk untuk melihat detail deskripsi dan harga.

**B. Melakukan Pembelian (Checkout):**
1. Pada halaman detail produk, klik tombol **Add to Cart** (Masukkan ke Keranjang).
2. Jika sudah selesai memilih barang, buka ikon Keranjang Belanja di sudut atas layar.
3. Periksa kembali daftar pesanan Anda, lalu klik **Proceed to Checkout**.
4. Isi formulir alamat pengiriman dengan lengkap dan benar.
5. Masukkan informasi detail Kartu Kredit/Debit Anda pada kolom pembayaran Stripe yang aman.
6. Klik **Pay and Order**. Jika berhasil, Anda akan menerima email notifikasi konfirmasi pesanan.

### 3.2 Panduan untuk Vendor (Penjual)
**A. Menambahkan Produk ke Etalase:**
1. Pastikan Anda sudah *login* menggunakan akun Vendor Anda.
2. Masuk ke halaman **Vendor Dashboard**.
3. Pilih menu **Add Product**.
4. Lengkapi formulir produk: masukkan nama produk, pilih kategori, isi deskripsi, tentukan harga, dan unggah foto produk yang menarik.
5. Klik tombol **Save** atau **Submit**. Produk akan otomatis tayang di halaman depan website.

**B. Mengelola Pesanan Masuk:**
1. Anda akan menerima email notifikasi setiap kali ada Pembeli yang memesan produk Anda.
2. Masuk ke **Vendor Dashboard** dan pilih menu **Orders** (Pesanan).
3. Anda dapat melihat detail pesanan (nama pembeli, produk, dan alamat pengiriman) untuk segera memproses pengiriman barang.

### 3.3 Panduan untuk Admin (Pengelola Sistem)
**A. Mengelola Master Data:**
1. *Login* menggunakan akun berstatus *Superuser* (Admin).
2. Anda akan diarahkan ke panel administrasi khusus (Django Admin Panel).
3. Untuk mengelola Kategori, klik menu **Categories**. Anda dapat menambah kategori baru, atau menghapus kategori yang sudah tidak relevan.
4. Untuk mengelola Pengguna, klik menu **Users**. Anda dapat melihat daftar seluruh Vendor dan Pembeli, serta memiliki hak untuk memblokir atau menghapus akun jika terjadi pelanggaran aturan.
