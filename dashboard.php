<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h2>Dashboard Admin</h2>
        <a href="logout.php">Logout</a>
    </header>

    <div class="container">
        <div class="card">
            <h3>Total Pengguna</h3>
            <p><?php echo $user_count; ?></p>
        </div>
        <div class="card">
            <h3>Total Produk</h3>
            <p><?php echo $product_count; ?></p>
        </div>
        <div class="card">
            <h3>Total Transaksi</h3>
            <p><?php echo $transaction_count; ?></p>
        </div>
    </div>
