<?php
// File: murid_dashboard.php

session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'murid') {
  header("Location: login.html");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Murid</title>
  <link rel="stylesheet" href="style-dashboard.css">
</head>
<body>
  <div class="dashboard-wrapper">
    <!-- Tombol Hamburger -->
    <button class="menu-toggle">
      <span></span>
      <span></span>
      <span></span>
    </button>

    <!-- Pesan Selamat Datang di Tengah -->
    <div class="center-message">
      <h2>Selamat datang, <?php echo $_SESSION['username']; ?>!</h2>
    </div>

    <!-- Sidebar Menu -->
    <div class="sidebar" id="sidebar">
      <h3>Menu Murid</h3>
      <ul>
        <li><a href="#">Tugas dan Kegiatan Mingguan</a></li>
        <li><a href="#">Refleksi Pembelajaran</a></li>
        <li><a href="#">Materi Belajar Interaktif</a></li>
      </ul>
      <a href="logout.php" class="logout">Logout</a>
    </div>
  </div>

  <script src="dashboard.js"></script>

</body>
</html>
