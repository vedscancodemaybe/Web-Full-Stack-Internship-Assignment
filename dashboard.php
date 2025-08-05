<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'db.php';
$user_id = $_SESSION['user_id'];

$user = $conn->query("SELECT * FROM users WHERE id = $user_id")->fetch_assoc();
$app = $conn->query("SELECT status FROM applications WHERE user_id = $user_id")->fetch_assoc();

echo "<h2>Welcome, {$user['name']}!</h2>";
echo "<p>Your Application Status: <strong>{$app['status']}</strong></p>";

echo "<a href='courses.php'>Browse Courses</a> | <a href='logout.php'>Logout</a>";
?>
</html>