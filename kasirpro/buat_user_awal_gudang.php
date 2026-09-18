<?php
include 'config/koneksi.php';

$nama     ='gudang';
$username ='gudang';
$password = password_hash('gudang123',PASSWORD_DEFAULT);
$role     ='gudang';

$sql = "INSERT INTO tbl_user (nama_lengkap, username, password, role)";
$sql .= "VALUES ('$nama','$username','$password','$role')";

if (mysqli_query($koneksi, $sql)) {
    echo 'User admin berhasil dibuat. Silahkan hapus file ini.';
}else {
    echo 'Gagal membuat user: ' . mysqli_error($koneksi);
}
?>