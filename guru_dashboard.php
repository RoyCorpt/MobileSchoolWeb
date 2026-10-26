<?php
// File: guru_dashboard.php

session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'guru') {
  header("Location: login.html");
  exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Guru</title>
  <link rel="stylesheet" href="style-dashboard.css" />
</head>
<body>
  <div class="dashboard-wrapper">
    <!-- Tombol Hamburger -->
    <button class="menu-toggle">
      <span></span>
      <span></span>
      <span></span>
    </button>

    <!-- Pesan Selamat Datang -->
    <div class="center-message">
      <h2>Selamat datang, <?php echo $_SESSION['username']; ?>!</h2>
    </div>

    <!-- Sidebar Guru -->
    <div class="sidebar" id="sidebar">
      <h3>Menu Guru</h3>
      <ul>
        <li><a href="ringkasan-kegiatan.html">Teknik Pembelajaran</a></li>
        <li><a href="media-gallery.php">Ragam Media Pembelajaran</a></li>
        <li><a href="materi-interaktif.php">Materi Belajar Interaktif</a></li>
        </ul>
    <a href="logout.php" class="logout">Logout</a>
    </div>

    <!-- Konten Dinamis -->
    <div id="kegiatan" class="content-area">
      <h4>Ringkasan Kegiatan Mingguan</h4>
      <p>Berisi laporan dan pencapaian kegiatan pembelajaran minggu ini.</p>
      <button class="close-btn" onclick="tutupKonten()">&times;</button>
    </div>

    <div id="refleksi" class="content-area">
      <button class="close-btn" onclick="tutupKonten()">&times;</button>
      <h4>Status Refleksi Pembelajaran</h4>
      <p>Guru dapat melihat ringkasan hasil refleksi siswa terhadap proses pembelajaran.</p>
    </div>

    <div id="metode" class="content-area">
      <button class="close-btn" onclick="tutupKonten()">&times;</button>
      <h4>Akses Bank Metode Mengajar</h4>
      <p>Referensi berbagai metode mengajar yang dapat digunakan dan diadaptasi oleh guru.</p>
    </div>
  </div>

  <script>
    const menuBtn = document.querySelector('.menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const contentAreas = document.querySelectorAll('.content-area');

    menuBtn.addEventListener('click', () => {
      sidebar.classList.toggle('active');
    });

    document.addEventListener('click', (e) => {
      if (!sidebar.contains(e.target) && !menuBtn.contains(e.target)) {
        sidebar.classList.remove('active');
      }
    });

    function tampilkanKonten(id) {
      contentAreas.forEach(area => {
        if (area.id === id) {
          area.classList.add('active');
        } else {
          area.classList.remove('active');
        }
      });
    }

    function tutupKonten() {
      contentAreas.forEach(area => area.classList.remove('active'));
    }
  </script>
</body>
</html>
