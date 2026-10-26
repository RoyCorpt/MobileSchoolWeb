<?php
// File: login.php

session_start();

// Konfigurasi koneksi ke database
$host = 'localhost';
$user = 'root';
$password = ''; // Ganti dengan password database Anda jika ada
$database = 'mobileschool';

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

// Hindari SQL Injection
$username = $conn->real_escape_string($username);
$password = $conn->real_escape_string($password);
$role = $conn->real_escape_string($role);

// Query untuk verifikasi login
$sql = "SELECT * FROM users WHERE username='$username' AND password=MD5('$password') AND role='$role'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role;

    if ($role == 'guru') {
        header("Location: guru_dashboard.php");
    } elseif ($role == 'murid') {
        header("Location: murid_dashboard.php");
    }
} else {
    echo "<script>alert('Login gagal. Periksa kembali username, password, dan peran.'); window.location.href='index.html';</script>";
}

$conn->close();
?>
