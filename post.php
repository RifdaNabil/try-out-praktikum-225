<?php
require 'config/connection.php'; // file koneksi database

// Ambil ID dari URL
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "Post tidak ditemukan.";
    exit;
}

// Ambil data post dari database
$stmt = $connect->prepare("SELECT posts.*, users.fullname FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

$post = $result->fetch_assoc();

if (!$post) {
    echo "Post tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title><?= htmlspecialchars($post['title']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

  <h1><?= htmlspecialchars($post['title']) ?></h1>
  <p class="text-muted">
    Ditulis oleh <strong><?= htmlspecialchars($post['fullname']) ?></strong> pada <?= date('d M Y H:i', strtotime($post['create_at'])) ?>
  </p>

  <div class="mt-4">
    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
  </div>

  <a href="beranda.php" class="btn btn-secondary mt-4">← Kembali ke Beranda</a>

</body>
</html>
