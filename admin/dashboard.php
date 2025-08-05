<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include '../db.php';

$applications = $conn->query("SELECT users.id, users.name, users.email, users.resume, applications.status, applications.app_id 
FROM users JOIN applications ON users.id = applications.user_id");
?>
<h2>Welcome, Admin</h2>
<a href="logout.php">Logout</a>
<table border="1" cellpadding="10">
    <tr>
        <th>Name</th><th>Email</th><th>Resume</th><th>Status</th><th>Action</th>
    </tr>
    <?php while($row = $applications->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['name'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><a href="../<?= $row['resume'] ?>" target="_blank">View Resume</a></td>
        <td><?= $row['status'] ?></td>
        <td>
            <form action="../update_status.php" method="POST">
                <input type="hidden" name="app_id" value="<?= $row['app_id'] ?>">
                <select name="status">
                    <option value="Pending">Pending</option>
                    <option value="Selected">Selected</option>
                    <option value="Rejected">Rejected</option>
                </select>
                <button type="submit" name="update">Update</button>
            </form>
        </td>
    </tr>
    <?php } ?>
</table>
