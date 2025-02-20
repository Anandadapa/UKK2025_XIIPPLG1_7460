<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

   
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $check_sql = "SELECT * FROM users WHERE username=? OR email=?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Username atau email sudah digunakan!'); window.location='register.php';</script>";
    } else {
   
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='loginn.php';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>
