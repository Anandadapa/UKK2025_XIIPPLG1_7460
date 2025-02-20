<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Mulai session hanya jika belum dimulai
}

$servername = "localhost";
$username = "root"; // Sesuaikan dengan konfigurasi MySQL kamu
$password = ""; // Sesuaikan dengan MySQL kamu
$dbname = "ukk2025";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi database
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
