<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hasil Upload Teknik Pembelajaran</title>
  <link rel="stylesheet" href="style-feedback.css">
</head>
<body>
  <div class="upload-container">
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_FILES['ringkasan_file']) && $_FILES['ringkasan_file']['error'] === UPLOAD_ERR_OK) {

            $targetDir = "uploads/";
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $fileName = basename($_FILES["ringkasan_file"]["name"]);
            $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedTypes = ["pdf", "doc", "docx", "txt"];

            if (!in_array($fileType, $allowedTypes)) {
                echo '<div class="upload-message error">❌ Jenis file tidak diperbolehkan. Hanya PDF, DOC, DOCX, atau TXT.</div>';
            } else {
                $targetFile = $targetDir . time() . "-" . $fileName;
                if (move_uploaded_file($_FILES["ringkasan_file"]["tmp_name"], $targetFile)) {
                    echo '<div class="upload-message success">✅ File berhasil diunggah: <strong>' . htmlspecialchars($fileName) . '</strong></div>';
                } else {
                    echo '<div class="upload-message error">❌ Gagal memindahkan file. Coba lagi nanti.</div>';
                }
            }
        } else {
            echo '<div class="upload-message error">⚠️ Tidak ada file dikirim atau terjadi error saat upload.</div>';
        }
    } else {
        echo '<div class="upload-message warning">🚫 Akses tidak valid. Harap unggah melalui form.</div>';
    }
    ?>
    <div class="back-link">
      <a href="ringkasan-kegiatan.html">⬅️ Kembali ke halaman sebelumnya</a>
    </div>
  </div>
</body>
</html>
