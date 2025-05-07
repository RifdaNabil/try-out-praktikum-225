<?php
session_start();

// Cek apakah user sudah login
$user = $_SESSION['fullname'] ?? null;
if (!$user) {
    header("Location: login.php"); // Redirect ke login jika belum login
    exit;
}

require '../config/connection.php';

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    // Validasi input
    if (empty($title) || empty($content)) {
        $error = "Judul dan Konten harus diisi!";
    } else {
        // Masukkan data ke database
        $stmt = $connect->prepare("INSERT INTO posts (user_id, title, content, create_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iss", $_SESSION['user_id'], $title, $content);

        if ($stmt->execute()) {
            header("Location: beranda.php"); // Redirect ke halaman beranda setelah berhasil
            exit;
        } else {
            $error = "Gagal menambahkan post, coba lagi!";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Post - WithBlog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;600;700&display=swap" rel="stylesheet">
    <link href="../assets/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg py-3 shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="beranda.php">
      <span class="fw-bold fs-4 text-secondary">WithBlog</span>
    </a>
    <ul class="navbar-nav d-flex align-items-center gap-3 mb-0">
      <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav>

<div class="container mt-5">
    <h2>Tambah Post Baru</h2>
    <form method="POST" action="create.php">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <div class="mb-3">
            <label for="title" class="form-label">Judul Postingan</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Konten Postingan</label>
            <textarea id="content" name="content" class="form-control" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-secondary">Tambah Post</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
