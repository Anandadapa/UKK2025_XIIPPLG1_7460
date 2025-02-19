<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            echo "<script>alert('Login berhasil!'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Password salah!'); window.location='index.html';</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!'); window.location='index.html';</script>";
    }
}
?>
