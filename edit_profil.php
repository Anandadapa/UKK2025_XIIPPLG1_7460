<?php
session_start();
include 'config.php';

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: loginn.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil data pengguna
$query = "SELECT username, email, profile_picture FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];

    // Upload foto profil baru jika ada
    if (!empty($_FILES['profile_picture']['name'])) {
        $file_name = time() . "_" . basename($_FILES["profile_picture"]["name"]);
        $target_dir = "uploads/";
        $target_file = $target_dir . $file_name;
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);

        // Update database dengan foto baru
        $update_query = "UPDATE users SET username = ?, profile_picture = ? WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ssi", $username, $file_name, $user_id);
    } else {
        // Update tanpa mengubah foto
        $update_query = "UPDATE users SET username = ? WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("si", $username, $user_id);
    }

    if ($stmt->execute()) {
        header("Location: profil.php");
        exit;
    } else {
        echo "Gagal memperbarui profil!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Profil</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Foto Profil</label><br>
                <img src="uploads/<?= htmlspecialchars($user['profile_picture']) ?>" width="100" class="mb-2">
                <input type="file" name="profile_picture" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="profil.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
