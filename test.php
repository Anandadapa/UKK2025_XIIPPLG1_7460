<?php
include 'database.php';

// Tambahkan tugas baru
if (isset($_POST['add'])) {
    $task = $_POST['task'];
    $category = $_POST['category'];
    $created_at = date('Y-m-d H:i:s');
    
    $q_insert = "INSERT INTO tasks (tasklabel, taskstatus, category, created_at) VALUES ('$task', 'open', '$category', '$created_at')";
    $run_q_insert = mysqli_query($conn, $q_insert);
    
    if ($run_q_insert) {
        header('Refresh:0; url=index.php');
    }
}

// Ambil daftar tugas
$q_select = "SELECT * FROM tasks ORDER BY taskid DESC";
$run_q_select = mysqli_query($conn, $q_select);

// Hapus tugas
if (isset($_GET['delete'])) {
    $taskid = $_GET['delete'];
    $q_delete = "DELETE FROM tasks WHERE taskid = '$taskid'";
    mysqli_query($conn, $q_delete);
    header('Refresh:0; url=index.php');
}

// Perbarui status tugas
if (isset($_GET['done'])) {
    $taskid = $_GET['done'];
    $status = $_GET['status'] == 'open' ? 'close' : 'open';
    $completed_at = $status == 'close' ? date('Y-m-d H:i:s') : NULL;
    
    $q_update = "UPDATE tasks SET taskstatus = '$status', completed_at = '$completed_at' WHERE taskid = '$taskid'";
    mysqli_query($conn, $q_update);
    header('Refresh:0; url=index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>To-Do List</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="text-white mt-3">To-Do List</h2>
        <p class="text-white"><?= date("l, d M Y") ?></p>
        <div class="card p-3">
            <form action="" method="post">
                <input type="text" name="task" class="form-control mb-2" placeholder="Add task" required>
                <select name="category" class="form-control mb-2">
                    <option value="Work">Work</option>
                    <option value="Personal">Personal</option>
                    <option value="Shopping">Shopping</option>
                </select>
                <button type="submit" name="add" class="btn btn-primary">Add</button>
            </form>
        </div>
        
        <?php while ($r = mysqli_fetch_array($run_q_select)) { ?>
        <div class="card p-3 mt-2">
            <div class="d-flex justify-content-between">
                <div>
                    <input type="checkbox" onclick="window.location.href='?done=<?= $r['taskid'] ?>&status=<?= $r['taskstatus'] ?>'" <?= $r['taskstatus'] == 'close' ? 'checked' : '' ?>>
                    <span class="<?= $r['taskstatus'] == 'close' ? 'text-muted text-decoration-line-through' : '' ?>">
                        <?= $r['tasklabel'] ?> (<?= $r['category'] ?>)
                    </span>
                    <small class="d-block text-secondary">Created: <?= $r['created_at'] ?></small>
                    <?php if ($r['taskstatus'] == 'close') { ?>
                        <small class="d-block text-success">Completed: <?= $r['completed_at'] ?></small>
                    <?php } ?>
                </div>
                <div>
                    <span class="badge badge-<?= $r['taskstatus'] == 'close' ? 'success' : 'warning' ?>">
                        <?= $r['taskstatus'] == 'close' ? 'Complete' : 'Not Complete' ?>
                    </span>
                    <a href="?delete=<?= $r['taskid'] ?>" class="text-danger ml-2" onclick="return confirm('Are you sure?')">
                        <i class="bx bx-trash"></i>
                    </a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<a class="btn btn-danger ml-3" href="logout.php" onclick="return confirm('yakin ingin logout?')">Logout</a>
<a href="history.php" class="btn btn-info mb-3">history</a>
<a href="index.php" class="btn btn-primary mb-3">Back to To-Do List</a>


