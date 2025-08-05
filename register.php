<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $resume   = $_FILES['resume'];

    // File validation
    $allowed_ext = ['pdf', 'doc', 'docx'];
    $ext = strtolower(pathinfo($resume['name'], PATHINFO_EXTENSION));
    $size = $resume['size'];

    if (!in_array($ext, $allowed_ext)) {
        die("❌ Only PDF and DOC files allowed.");
    }

    if ($size > 2 * 1024 * 1024) {
        die("❌ File size must be less than 2MB.");
    }

    // Create upload directory if not exists
    $upload_dir = "upload/";
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $filename = uniqid() . "_" . basename($resume['name']);
    $target_path = $upload_dir . $filename;

    if (move_uploaded_file($resume['tmp_name'], $target_path)) {
        // Check if email exists
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            echo "⚠️ This email is already registered. Please use another one.";
        } else {
            // Insert into users
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, resume) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $password, $target_path);
            if ($stmt->execute()) {
                $user_id = $stmt->insert_id;

                // Insert into applications table
                $conn->query("INSERT INTO applications (user_id) VALUES ($user_id)");

                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Registered Successfully!',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.href='login.php';
                    });
                </script>";
            } else {
                echo "❌ Registration failed. Please try again.";
            }
        }
        $check->close();
    } else {
        echo "❌ Resume upload failed.";
    }
}
?>
