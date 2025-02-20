<?php
include 'database.php';

// Ambil daftar kategori dari database
$q_categories = "SELECT * FROM categories ORDER BY category_name ASC";
$run_q_categories = mysqli_query($conn, $q_categories);

// Tambah tugas baru
if (isset($_POST['add'])) {
    $task = $_POST['task'];
    $category = $_POST['category'];
    $created_at = date('Y-m-d H:i:s');

    $q_insert = "INSERT INTO tasks (tasklabel, taskstatus, category, created_at) VALUES ('$task', 'open', '$category', '$created_at')";
    mysqli_query($conn, $q_insert);
    header('Location: index.php');
    exit;
}

// Pencarian
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $q_select = "SELECT * FROM tasks WHERE (tasklabel LIKE '%$search%' OR category LIKE '%$search%') AND deleted_at IS NULL ORDER BY taskid DESC";
} else {
    $q_select = "SELECT * FROM tasks WHERE deleted_at IS NULL ORDER BY taskid DESC";
}
$run_q_select = mysqli_query($conn, $q_select);

// Hapus tugas (Soft Delete)
if (isset($_GET['delete'])) {
    $taskid = $_GET['delete'];
    $deleted_at = date('Y-m-d H:i:s');

    $q_delete = "UPDATE tasks SET deleted_at = '$deleted_at' WHERE taskid = '$taskid'";
    mysqli_query($conn, $q_delete);
    header('Location: index.php');
    exit;
}

// Tandai tugas selesai
if (isset($_GET['done'])) {
    $taskid = $_GET['done'];
    $status = $_GET['status'] == 'open' ? 'close' : 'open';
    $completed_at = $status == 'close' ? date('Y-m-d H:i:s') : NULL;

    $q_update = "UPDATE tasks SET taskstatus = '$status', completed_at = '$completed_at' WHERE taskid = '$taskid'";
    mysqli_query($conn, $q_update);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
        }
        .card {
            background: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>
    <div class="container p-4">
        <h2 class="text-center">To-Do List</h2>
        <p class="text-center text-light"> <?= date("l, d M Y") ?> </p>

        <!-- Form Pencarian -->
        <form action="" method="get" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search task..." value="<?= htmlspecialchars($search) ?>">
                <button type="submit" class="btn btn-secondary">Search</button>
                <a href="index.php" class="btn btn-danger">Reset</a>
            </div>
        </form>

        <!-- Form Tambah Tugas -->
        <div class="card p-3 mb-3">
            <form action="" method="post">
                <input type="text" name="task" class="form-control mb-2" placeholder="Add task" required>
                <select name="category" class="form-control mb-2">
                    <?php if (mysqli_num_rows($run_q_categories) > 0) { ?>
                        <?php while ($cat = mysqli_fetch_array($run_q_categories)) { ?>
                            <option value="<?= $cat['category_name'] ?>"><?= $cat['category_name'] ?></option>
                        <?php } ?>
                    <?php } else { ?>
                        <option value="">No categories available</option>
                    <?php } ?>
                </select>
                <button type="submit" name="add" class="btn btn-primary">Add Task</button>
            </form>
        </div>

        <!-- List Tugas -->
        <?php if (mysqli_num_rows($run_q_select) > 0) { ?>
            <?php while ($r = mysqli_fetch_array($run_q_select)) { ?>
            <div class="card p-3 mb-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <input type="checkbox" onclick="window.location.href='?done=<?= $r['taskid'] ?>&status=<?= $r['taskstatus'] ?>'" <?= $r['taskstatus'] == 'close' ? 'checked' : '' ?>>
                        <span class="<?= $r['taskstatus'] == 'close' ? 'text-decoration-line-through' : '' ?>">
                            <?= $r['tasklabel'] ?> (<?= $r['category'] ?>)
                        </span>
                        <small class="d-block text-secondary">Created: <?= $r['created_at'] ?></small>
                        <?php if ($r['taskstatus'] == 'close') { ?>
                            <small class="d-block text-success">Completed: <?= $r['completed_at'] ?></small>
                        <?php } ?>
                    </div>
                    <div>
                        <a href="edit.php?id=<?= $r['taskid'] ?>" class="text-warning me-2">
                            <i class='bx bx-edit'></i> Edit
                        </a>
                        <a href="?delete=<?= $r['taskid'] ?>" class="text-danger" onclick="return confirm('Are you sure?')">
                            <i class='bx bx-trash'></i> Delete
                        </a>
                    </div>
                </div>
            </div>
            <?php } ?>
        <?php } else { ?>
            <div class="alert alert-warning text-center">No tasks found.</div>
        <?php } ?>
    </div>
</body>
</html>
