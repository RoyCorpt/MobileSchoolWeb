<?php
$folder = 'media'; // folder tempat media disimpan
$allowed_images = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
$allowed_videos = ['mp4', 'webm', 'ogg'];

// Proses upload jika ada file yang dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['media'])) {
    if (!is_dir($folder)) mkdir($folder, 0777, true);

    $file = $_FILES['media'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $isAllowed = in_array($ext, array_merge($allowed_images, $allowed_videos));
    $maxSize = 200 * 1024 * 1024;

    if (!$isAllowed) {
        $error = "Format file tidak didukung.";
    } elseif ($file['size'] > $maxSize) {
        $error = "Ukuran file terlalu besar (maks 50MB).";
    } elseif (in_array($ext, $allowed_images) && !@getimagesize($file['tmp_name'])) {
        $error = "File gambar tidak valid.";
    } elseif ($file['error'] === 0) {
        $safeName = time() . '-' . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $file['name']);
        $destination = $folder . '/' . $safeName;
        move_uploaded_file($file['tmp_name'], $destination);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $error = "Gagal mengunggah file.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Galeri Media</title>
  <link rel="stylesheet" href="style-media.css">
</head>
<body>
  <h1>Galeri Media</h1>

  <!-- Kontainer Flex untuk Back dan Upload -->
  <div class="top-bar">
    <a href="guru_dashboard.php" class="back-button">← Kembali ke Dashboard</a>

  <div class="upload-form">
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="media" accept="image/*,video/*" required>
        <button type="submit">Unggah filemu disini.</button>
    </form>
  </div>
</div>

  <!-- Galeri -->
  <div class="gallery">
    <?php
    $files = scandir($folder);
    foreach ($files as $file) {
        $path = $folder . '/' . $file;
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        $judul = htmlspecialchars(pathinfo($file, PATHINFO_FILENAME)); // Hapus ekstensi & amankan output

    if (in_array($ext, $allowed_images)) {
        echo "<div class='item'>
                <img src='$path' alt='$judul'>
                <p class='caption'>$judul</p>
            </div>";
    } elseif (in_array($ext, $allowed_videos)) {
        echo "<div class='item'>
                <video controls src='$path'></video>
                <p id='caption'>$judul</p>
            </div>";
    }

    }
    ?>
  </div>
</body>
</html>
