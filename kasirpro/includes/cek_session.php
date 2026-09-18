<?php
// Memulai session
session_start();

// Mengecek apakah user sudah login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}
?>