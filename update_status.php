<?php
include 'db.php';

if (isset($_POST['update'])) {
    $app_id = $_POST['app_id'];
    $status = $_POST['status'];

    $conn->query("UPDATE applications SET status='$status' WHERE app_id=$app_id");
    header("Location: admin/dashboard.php");
}
?>
