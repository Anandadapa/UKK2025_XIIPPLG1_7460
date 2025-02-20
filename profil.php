<?php
session_start();
include 'config.php'; // Pastikan ini benar

// Debugging: Cek isi session
var_dump($_SESSION); 
exit;

// Periksa apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: loginn.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
        }
        .btn {
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Profil Pengguna</h2>
        <img src="uploads/<?= htmlspecialchars($user['profile_picture']) ?>" alt="Foto Profil">
        <h4><?= htmlspecialchars($user['username']) ?></h4>
        <p>Email: <?= htmlspecialchars($user['email']) ?></p>
        <p>Bergabung sejak: <?= date("d M Y", strtotime($user['created_at'])) ?></p>
        
        <a href="edit_profil.php" class="btn btn-warning">Edit Profil</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

</body>
</html>
