<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "kasirpro";

// Membuat koneksi
$koneksi = mysqli_connect(
    $host,
    $username,
    $password,
    $database
);

// Mengecek koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Mengatur karakter
mysqli_set_charset($koneksi, "utf8mb4");

?>