<?php
// File: register.php

// Konfigurasi koneksi database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'MobileSchool';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

// Validasi sederhana
if (empty($username) || empty($password) || empty($role)) {
  echo "<script>alert('Semua field wajib diisi.'); window.location.href='register.html';</script>";
  exit();
}

// Cek apakah username sudah ada
$check = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($check);

if ($result->num_rows > 0) {
  echo "<script>alert('Username sudah digunakan. Silakan pilih username lain.'); window.location.href='register.html';</script>";
  exit();
}

// Simpan data dengan password terenkripsi MD5 (untuk testing saja)
$sql = "INSERT INTO users (username, password, role) VALUES ('$username', MD5('$password'), '$role')";

if ($conn->query($sql) === TRUE) {
  echo "<script>alert('Akun berhasil didaftarkan. Silakan login.'); window.location.href='login.html';</script>";
} else {
  echo "<script>alert('Terjadi kesalahan saat mendaftar.'); window.location.href='register.html';</script>";
}

$conn->close();
?>
