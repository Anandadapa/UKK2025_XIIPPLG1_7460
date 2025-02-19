<?php
include 'database.php'; // Panggil koneksi database

// Tambah kategori baru
if (isset($_POST['add_category'])) {
    $category = $_POST['category'];
    $query = "INSERT INTO categories (category_name) VALUES ('$category')";
    mysqli_query($conn, $query);
    header("Location: category.php");
    exit;
}

// Hapus kategori
if (isset($_GET['delete'])) {
    $category_id = $_GET['delete'];
    $query = "DELETE FROM categories WHERE id = $category_id";
    mysqli_query($conn, $query);
    header("Location: category.php");
    exit;
}

// Ambil daftar kategori
$query = "SELECT * FROM categories";
$run_query = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: #f4f4f4;
        }
        .container {
            max-width: 600px;
            background: white;
            padding: 20px;
            margin: auto;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        .input-control {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background: #4e54c8;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .text-red {
            color: red;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Manage Categories</h2>

    <form method="POST">
        <input type="text" name="category" class="input-control" placeholder="New Category" required>
        <button type="submit" name="add_category">Add Category</button>
    </form>

    <table>
        <tr>
            <th>Category</th>
            <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($run_query)) { ?>
            <tr>
                <td><?= $row['category_name'] ?></td>
                <td><a href="?delete=<?= $row['id'] ?>" class="text-red" onclick="return confirm('Delete this category?')">Delete</a></td>
            </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
