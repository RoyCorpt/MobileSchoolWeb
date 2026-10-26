<?php
// Proses upload jika form dikirim
$uploadSuccess = "";
$uploadError = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
  $allowed_ext = ['pdf', 'docx', 'doc', 'xls', 'xlsx', 'ppt', 'pptx', 'txt'];
  $target_dir = "materi/";
  $filename = basename($_FILES["file"]["name"]);
  $target_file = $target_dir . $filename;
  $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

  if (!in_array($file_ext, $allowed_ext)) {
    $uploadError = "Jenis file tidak diperbolehkan.";
  } elseif (file_exists($target_file)) {
    $uploadError = "File sudah ada. Ganti nama file terlebih dahulu.";
  } else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
      $uploadSuccess = "File berhasil diunggah.";
    } else {
      $uploadError = "Terjadi kesalahan saat mengunggah file.";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Materi Pembelajaran Interaktif</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #eef7ff;
      padding: 30px;
    }

    h2 {
      color: #2c3e50;
    }

    .search-box input {
      padding: 10px;
      width: 300px;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    ul {
      list-style: none;
      padding-left: 0;
    }

    li {
      margin: 8px 0;
    }

    a {
      text-decoration: none;
      color: #0077cc;
    }

    a:hover {
      text-decoration: underline;
    }

    .upload-section {
      margin-top: 30px;
      padding: 20px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.08);
    }

    input[type="file"] {
      margin-top: 10px;
    }

    button {
      margin-top: 10px;
      padding: 10px 20px;
      background: #2196f3;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    button:hover {
      background: #1976d2;
    }

    .back {
      margin-bottom: 20px;
      display: inline-block;
      color: #555;
      font-weight: bold;
      text-decoration: none;
    }

    .message {
      margin-top: 10px;
      padding: 10px;
      border-radius: 6px;
    }

    .success {
      background-color: #d4edda;
      color: #155724;
    }

    .error {
      background-color: #f8d7da;
      color: #721c24;
    }
    .cards-container {
  display: flex;
  flex-wrap: wrap;
  gap: 15px;
  margin-top: 20px;
}

.card {
  background-color: #ffffff;
  padding: 15px;
  border-radius: 10px;
  border: 1px solid #ddd;
  box-shadow: 0 2px 6px rgba(0,0,0,0.05);
  transition: 0.2s;
  width: 220px;
  word-break: break-all;
}

.card:hover {
  transform: translateY(-4px);
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.card a {
  text-decoration: none;
  color: #0077cc;
  font-weight: bold;
  display: block;
}

  </style>
<link rel="stylesheet" href="style-media.css">
</head>
<body>

  <a href="javascript:history.back()" class="back">← Kembali</a>
  <h2>Materi Pembelajaran Interaktif</h2>

  <div class="search-box">
    <input type="text" id="searchInput" placeholder="Cari materi...">
  </div>

  <div id="materiList" class="cards-container">
    <?php
    $folder = "materi";
    if (is_dir($folder)) {
      $files = scandir($folder);
      $files = array_diff($files, array('.', '..'));
      foreach ($files as $file) {
        echo "
          <div class='card'>
            <a href='$folder/$file' target='_blank'>$file</a>
          </div>
        ";
      }
    } else {
      echo "<div class='card'>Folder 'materi/' tidak ditemukan.</div>";
    }
    ?>
  </div>


  <div class="upload-section">
    <h3>Unggah Materi</h3>
    <form method="POST" enctype="multipart/form-data">
      <input type="file" name="file" required>
      <br>
      <button type="submit">Unggah</button>
    </form>

    <?php if ($uploadSuccess): ?>
      <div class="message success"><?= htmlspecialchars($uploadSuccess) ?></div>
    <?php endif; ?>
    <?php if ($uploadError): ?>
      <div class="message error"><?= htmlspecialchars($uploadError) ?></div>
    <?php endif; ?>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const searchInput = document.getElementById("searchInput");
      const cards = document.querySelectorAll("#materiList .card");

      searchInput.addEventListener("input", function () {
        const filter = searchInput.value.toLowerCase();
        cards.forEach(function (card) {
          const text = card.textContent.toLowerCase();
          card.style.display = text.includes(filter) ? "" : "none";
        });
      });
    });
  </script>


</body>
</html>
