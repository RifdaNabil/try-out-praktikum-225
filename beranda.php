<?php
session_start();
$fullname = $_SESSION['fullname'] ?? null;
require './config/connection.php';

// Ambil semua post dari database (dengan nama user-nya)
$query = "SELECT posts.*, users.fullname FROM posts 
          JOIN users ON posts.user_id = users.id 
          ORDER BY posts.create_at DESC";

$result = $connect->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>With Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;600;700&display=swap" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg py-3 shadow-sm">
  <div class="container">
    <!-- Logo -->
    <a class="navbar-brand d-flex align-items-center" href="beranda.php">
    <span class="fw-bold fs-4 text-secondary">WithBlog</span>
    </a>

    <!-- Toggler for mobile -->
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
  <span class="navbar-toggler-icon"></span>
</button>

    <!-- Bagian kanan: Akun/Login/Logout -->
    <ul class="navbar-nav d-flex align-items-center gap-3 mb-0">
  <?php if ($fullname): ?>
    <li class="nav-item d-flex align-items-center">
      <a class="nav-link px-2" href="admin/dashboard.php">Halo, <?= htmlspecialchars($fullname) ?></a>
    </li>
    <li class="nav-item d-flex align-items-center">
      <a class="nav-link px-2" href="admin/logout.php">Logout</a>
    </li>
  <?php else: ?>
    <li class="nav-item d-flex align-items-center">
      <a class="nav-link px-2" href="login.php">Login</a>
    </li>
  <?php endif; ?>
</ul>

</div>
</nav>

<div class="container mt-4">
  <h2 class="mb-4">Postingan Terbaru</h2>

  <?php while ($row = $result->fetch_assoc()): ?>
    <div class="mb-4 border-bottom pb-3">
      <h4>
        <a href="post.php?id=<?= $row['id'] ?>">
          <?= htmlspecialchars($row['title']) ?>
        </a>
      </h4>
      <p class="text-muted mb-1">
        Ditulis oleh <?= htmlspecialchars($row['fullname']) ?> |
        <?= date('d M Y H:i', strtotime($row['create_at'])) ?>
      </p>
      <p><?= nl2br(htmlspecialchars(substr($row['content'], 0, 100))) ?>...</p>
    </div>
  <?php endwhile; ?>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>