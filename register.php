<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $username, $password, $role);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "Registrasi berhasil! <a href='login.php'>Login</a>";
    } else {
        echo "Gagal mendaftar.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <link rel="stylesheet" href="styless.css">
</head>
<body>
    <div class="register-container">
        <div class="register-box">
            <h2>Registrasi</h2>
            <form action="#" method="POST">
                <div class="input-box">
                    <input type="text" name="username" required>
                    <label for="username">Username</label>
                </div>
                <div class="input-box">
                    <input type="email" name="email" required>
                    <label for="email">Email</label>
                </div>
                <div class="input-box">
                    <input type="password" name="password" required>
                    <label for="password">Password</label>
                </div>
                <div class="input-box">
                    <input type="password" name="confirm_password" required>
                    <label for="confirm_password">Konfirmasi Password</label>
                </div>
                <button type="submit" class="btn">Daftar</button>
                <div class="login-link">
                    Sudah punya akun? <a href="login.html">Login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
