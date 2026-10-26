# MobileSchool Web

Platform e-learning berbasis web untuk mendukung kegiatan belajar mengajar antara **guru** dan **murid**. Sistem ini memiliki pembagian hak akses berdasarkan peran, pengelolaan materi belajar, galeri media, serta unggah ringkasan kegiatan.

> Proyek ini dibuat sebagai bagian dari portofolio pribadi.

---

## Fitur Utama

### 1. Autentikasi Pengguna
- Pendaftaran akun (register) dengan pilihan peran **guru** atau **murid**.
- Login dengan verifikasi nama pengguna, kata sandi, dan peran melalui database MySQL.
- Logout dengan menghancurkan sesi pengguna.

### 2. Dasbor Guru
Antarmuka khusus guru dengan menu:
- Teknik Pembelajaran
- Ragam Media Pembelajaran
- Materi Belajar Interaktif

### 3. Dasbor Murid
Antarmuka khusus murid dengan sapaan berdasarkan nama pengguna dan menu:
- Tugas dan Kegiatan Mingguan
- Refleksi Pembelajaran
- Materi Belajar Interaktif

### 4. Materi Belajar Interaktif
- Kotak pencarian materi.
- Form unggah materi berformat dokumen (PDF, DOC, PPTX, XLS) yang disimpan di folder `materi/`.

### 5. Galeri Media
- Unggah gambar (JPG, PNG, GIF, WEBP) dan video (MP4, WEBM, OGG).
- Batas ukuran file maksimal **50 MB**.
- File disimpan di folder `media/` dan langsung ditampilkan di galeri.

### 6. Manajemen Ringkasan Kegiatan (Teknik Pembelajaran)
- Unggah file ringkasan aktivitas (PDF, DOC, DOCX, TXT) ke folder `uploads/`.
- Daftar file lengkap dengan waktu unggah.
- Buka file melalui tautan, atau hapus file langsung dari daftar.

---

## Teknologi yang Digunakan

| Bagian | Teknologi |
|--------|-----------|
| Backend | PHP (native) |
| Database | MySQL (nama database: `MobileSchool`) |
| Frontend | HTML, CSS, JavaScript |
| Server lokal | XAMPP (Apache + MySQL) |

---

## Struktur Folder

```
MobileSchoolWeb/
├── materi/                    # Tempat file materi yang diunggah
├── media/                     # Tempat gambar dan video galeri
├── uploads/                   # Tempat file ringkasan kegiatan
├── login.html / login.php     # Halaman dan proses login
├── register.html / register.php   # Halaman dan proses pendaftaran
├── logout.php                 # Proses logout
├── guru_dashboard.php         # Dasbor guru
├── murid_dashboard.php        # Dasbor murid
├── materi-interaktif.php      # Materi belajar interaktif
├── media-gallery.php          # Galeri media
├── ringkasan-kegiatan.html    # Halaman ringkasan kegiatan
├── upload-ringkasan.php       # Proses unggah ringkasan
├── list-ringkasan.php         # Daftar ringkasan yang telah diunggah
├── dashboard.js               # Skrip dasbor
├── style*.css                 # Stylesheet tiap halaman
└── database.sql               # Struktur database
```

---

## Cara Menjalankan di Komputer Lokal

1. **Instal XAMPP** dari [apachefriends.org](https://www.apachefriends.org), lalu jalankan **Apache** dan **MySQL**.
2. **Salin proyek** ke folder `htdocs`:
   ```
   C:\xampp\htdocs\MobileSchoolWeb
   ```
3. **Buat database**: buka `http://localhost/phpmyadmin`, buat database baru bernama `MobileSchool`.
4. **Impor struktur database**: pilih database `MobileSchool`, klik **Import**, lalu pilih file `database.sql`.
5. **Sesuaikan koneksi database** pada file PHP (host, username, password, dan nama database `MobileSchool`). Pengaturan bawaan XAMPP biasanya `localhost`, user `root`, dan password kosong.
6. **Pastikan folder upload ada**: `materi/`, `media/`, dan `uploads/`.
7. **Buka di browser**:
   ```
   http://localhost/MobileSchoolWeb/login.html
   ```

---

## Tangkapan Layar

> Tambahkan screenshot di folder `screenshots/`, lalu tampilkan di sini.

<!--
![Halaman Login](screenshots/login.png)
![Dasbor Guru](screenshots/dashboard-guru.png)
![Dasbor Murid](screenshots/dashboard-murid.png)
![Galeri Media](screenshots/galeri-media.png)
-->

---

## Demo

> Tambahkan tautan video demo (misalnya YouTube) di sini jika tersedia.

---

## Rencana Pengembangan

Beberapa hal yang ingin ditingkatkan pada versi berikutnya:

- [ ] Mengganti enkripsi kata sandi dari MD5 ke `password_hash()` dan `password_verify()` yang lebih aman.
- [ ] Menggunakan *prepared statements* untuk semua query database guna mencegah SQL injection.
- [ ] Memisahkan konfigurasi koneksi database ke satu file terpisah.
- [ ] Validasi tipe dan isi file unggahan yang lebih ketat.
- [ ] Fitur tugas dan refleksi pembelajaran yang lebih lengkap untuk murid.

---

## Catatan

- Proyek ini dibuat untuk tujuan pembelajaran dan portofolio, belum ditujukan untuk penggunaan produksi.
- Folder `materi/`, `media/`, dan `uploads/` pada repository ini tidak berisi data pengguna asli.

---

## Pembuat

**[Nama Anda]**
GitHub: [@username-anda](https://github.com/username-anda)
