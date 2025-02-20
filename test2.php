<?php
session_start();
include 'config.php'; // Sesuaikan dengan koneksi database Anda

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: loginn.php');
    exit;
}

// Ambil informasi pengguna dari database
$user_id = $_SESSION['user_id'];
$query = "SELECT username, email, profile_picture, created_at FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
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
            max-width: 400px;
        }
        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Profil Saya</h2>
    <img src="uploads/<?= htmlspecialchars($user['profile_picture']) ?>" class="profile-img" alt="Foto Profil">
    <h4 class="mt-3"><?= htmlspecialchars($user['username']) ?></h4>
    <p><?= htmlspecialchars($user['email']) ?></p>
    <p><small>Bergabung sejak: <?= date("d M Y", strtotime($user['created_at'])) ?></small></p>
    <a href="edit_profil.php" class="btn btn-warning">Edit Profil</a>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>

</body>
</html>
