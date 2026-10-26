<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar File Teknik Pembelajaran</title>
  <link rel="stylesheet" href="style-feedback.css">
  <style>
    .file-list-container {
      background-color: white;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      max-width: 700px;
      width: 90%;
      margin: 50px auto;
    }
    .file-list-container h2 {
      color: #2c3e50;
      margin-bottom: 20px;
    }
    .back-button {
      display: inline-block;
      margin-bottom: 20px;
      padding: 8px 14px;
      background-color: #3498db;
      color: white;
      border: none;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
    }
    .back-button:hover {
      background-color: #2980b9;
    }
    ul.file-list {
      list-style: none;
      padding-left: 0;
    }
    ul.file-list li {
      padding: 15px;
      margin: 10px 0;
      background: #f0f4f8;
      border-radius: 8px;
      border-left: 4px solid #2196f3;
      font-weight: bold;
      word-wrap: break-word;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }
    .file-info {
      flex-grow: 1;
      margin-right: 10px;
    }
    .file-info a {
      text-decoration: none;
      color: #1565c0;
    }
    .file-info a:hover {
      text-decoration: underline;
    }
    .file-actions {
      display: flex;
      gap: 10px;
    }
    .file-date {
      font-size: 0.85rem;
      color: #555;
    }
    .delete-btn {
      background-color: #e74c3c;
      border: none;
      color: white;
      padding: 5px 10px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 0.85rem;
    }
    .delete-btn:hover {
      background-color: #c0392b;
    }
  </style>
</head>
<body>
  <div class="file-list-container">
    <a href="ringkasan-kegiatan.html" class="back-button">&larr; Kembali ke Dashboard</a>
    <h2>Daftar Teknik Pembelajaran yang tersedia saat ini:</h2>
    <ul class="file-list">
      <?php
      $dir = "uploads/";
      if (is_dir($dir)) {
          $files = array_diff(scandir($dir), array('.', '..'));
          if (count($files) > 0) {
              foreach ($files as $file) {
                  $filePath = $dir . $file;
                  $uploadDate = date("d-m-Y H:i", filemtime($filePath));
                  echo '<li>
                          <div class="file-info">
                            <a href="' . $filePath . '" target="_blank">' . htmlspecialchars($file) . '</a>
                            <div class="file-date">Diunggah pada: ' . $uploadDate . '</div>
                          </div>
                          <div class="file-actions">
                            <form method="post" onsubmit="return confirm(\'Yakin ingin menghapus file ini?\');">
                              <input type="hidden" name="delete" value="' . htmlspecialchars($file) . '">
                              <button type="submit" class="delete-btn">Hapus</button>
                            </form>
                          </div>
                        </li>';
              }
          } else {
              echo '<li>Tidak ada file yang diunggah.</li>';
          }
      } else {
          echo '<li>Folder upload belum dibuat.</li>';
      }

      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
          $fileToDelete = basename($_POST['delete']);
          $fullPath = $dir . $fileToDelete;
          if (file_exists($fullPath)) {
              unlink($fullPath);
              echo "<script>window.location.href = window.location.href;</script>";
          }
      }
      ?>
    </ul>
  </div>
</body>
</html>
