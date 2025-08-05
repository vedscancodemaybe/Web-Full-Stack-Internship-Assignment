<?php
session_start();
include 'db.php';
$user_id = $_SESSION['user_id'];

$res = $conn->query("SELECT * FROM courses");
echo "<h2>Available Courses</h2><ul>";
while ($row = $res->fetch_assoc()) {
    echo "<li>{$row['title']} - {$row['domain']}
    <form action='course_enroll.php' method='POST' style='display:inline;'>
        <input type='hidden' name='course_id' value='{$row['id']}'>
        <input type='submit' value='Enroll'>
    </form></li>";
}
echo "</ul>";
?>
