<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id'];
$course_id = $_POST['course_id'];

$conn->query("INSERT INTO user_courses (user_id, course_id) VALUES ($user_id, $course_id)");
header("Location: dashboard.php");
?>
