<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head><title>Admin Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h2>Admin Login</h2>
    <form method="POST">
        Username: <input type="text" name="username"><br><br>
        Password: <input type="password" name="password"><br><br>
        <input type="submit" name="login" value="Login">
    </form>

    <?php
    include '../db.php';

    if (isset($_POST['login'])) {
        $user = $_POST['username'];
        $pass = md5($_POST['password']);

        $result = $conn->query("SELECT * FROM admin WHERE username='$user' AND password='$pass'");
        if ($result->num_rows > 0) {
            $_SESSION['admin'] = $user;
            header("Location: dashboard.php");
        } else {
            echo "Invalid login.";
        }
    }
    ?>
</body>
</html>
