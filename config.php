<?php
$servername = "localhost"; // Ganti jika bukan localhost
$username = "root"; // Ganti sesuai MySQL Anda
$password = ""; // Ganti jika ada password
$database = "login_system"; // Nama database

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
