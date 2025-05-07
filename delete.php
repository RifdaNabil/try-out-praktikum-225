<?php
session_start();
require '../config/connection.php';

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$post_id = $_GET['id'] ?? null;

if (!$post_id) {
    echo "ID postingan tidak ditemukan.";
    exit;
}

// Pastikan postingan milik user
$query = "SELECT * FROM posts WHERE id = ? AND user_id = ?";
$stmt = mysqli_prepare($connect, $query);
mysqli_stmt_bind_param($stmt, "ii", $post_id, $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$post = mysqli_fetch_assoc($result);

if (!$post) {
    echo "Postingan tidak ditemukan atau bukan milik kamu.";
    exit;
}

// Hapus postingan
$delete = "DELETE FROM posts WHERE id = ? AND user_id = ?";
$stmt = mysqli_prepare($connect, $delete);
mysqli_stmt_bind_param($stmt, "ii", $post_id, $user_id);
mysqli_stmt_execute($stmt);

// Redirect ke dashboard
header("Location: dashboard.php");
exit;
?>
