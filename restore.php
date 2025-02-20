<?php
include 'database.php';

if (isset($_GET['id'])) {
    $taskid = $_GET['id'];

    $q_restore = "UPDATE tasks SET deleted_at = NULL WHERE taskid = '$taskid'";
    mysqli_query($conn, $q_restore);

    header('Location: history.php');
}
?>
