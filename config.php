<?php
$host = "localhost";
$user = "root"; // Sesuaikan dengan username MySQL
$password = ""; // Kosongkan jika pakai XAMPP
$database = "ukk_2025";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}else {
}
?>
