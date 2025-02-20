<?php
include 'database.php';

$q_select_deleted = "SELECT * FROM tasks WHERE deleted_at IS NOT NULL ORDER BY deleted_at DESC";
$run_q_select_deleted = mysqli_query($conn, $q_select_deleted);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Tugas Terhapus</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Riwayat Tugas Terhapus</h2>
        <a href="index.php" class="btn btn-primary mb-3">Kembali ke Beranda</a>
        
        <?php if (mysqli_num_rows($run_q_select_deleted) > 0) { ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Tugas</th>
                        <th>Kategori</th>
                        <th>Tanggal Dihapus</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; while ($row = mysqli_fetch_assoc($run_q_select_deleted)) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['tasklabel']) ?></td>
                            <td><?= htmlspecialchars($row['category']) ?></td>
                            <td><?= $row['deleted_at'] ?></td>
                            <td>
                                <a href="restore.php?id=<?= $row['taskid'] ?>" class="btn btn-success btn-sm">Pulihkan</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>Tidak ada tugas yang dihapus.</p>
        <?php } ?>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
