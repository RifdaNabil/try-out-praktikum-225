<?php
session_start();
require "../config/connection.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Validasi input kosong
    if (empty($email) || empty($password)) {
        $_SESSION['login_error'] = "Email dan password wajib diisi.";
        header("Location: ../login.php");
        exit();
    }

    // Cek pengguna berdasarkan email
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Cek password
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['fullname'] = $user['fullname'];
        header("Location: admin/dashboard.php"); // Lokasi dashboard kamu
        exit();
    } else {
        $_SESSION['login_error'] = "Email atau password salah.";
        header("Location: ../login.php");
        exit();
    }
}
