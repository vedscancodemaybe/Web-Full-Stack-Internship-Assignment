<!DOCTYPE html>
<html>
<head>
    <title>Internship Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <h2>Apply for Internship</h2>
    <form action="register.php" method="POST" enctype="multipart/form-data">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    Upload Resume: <input type="file" name="resume" accept=".pdf,.doc,.docx" required><br><br>
    <input type="submit" name="submit" value="Register">
</form>

</body>
</html>
